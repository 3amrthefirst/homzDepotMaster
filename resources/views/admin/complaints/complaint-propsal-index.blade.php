@extends('admin.layouts.main',[
								'page_header'		=> 'الشكاوي والمقترحات',
								'page_description'	=> 'عرض ',
								'link' => url('admin/complaints-proposals')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <h3>الشكاوى والمقترحات</h3>
            <div class="pull-right">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم العميل</th>
                        <th>البريد الالكتروني للعميل</th>
                        <th> الهاتف</th>
                        <th>النوع</th>
                        <th>المحتوى</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record->customer)->fname }}  {{ optional($record->customer)->lname}}</td>
                                <td>{{optional($record->customer)->email}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{optional($record->complaint)->type == 'complaint'?'شكوى':'اقتراح'}}</td>
                                <td>{{optional($record)->message}}</td>
                                <td class="text-center">
                                <button
                                            id="{{$record->id}}"
                                            data-token="{{ csrf_token() }}"
                                            data-route="{{route('complaints.destroy',$record->id)}}"
                                            type="button"
                                            class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $records->appends(request()->all())->render() !!}
            @else
                <div>
                    <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
                </div>
            @endif


        </div>
    </div>
@stop

@section('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel':false,

        })
    </script>
@stop
