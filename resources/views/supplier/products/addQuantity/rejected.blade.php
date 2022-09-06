@extends('supplier.layouts.main',[
								'page_header'		=> 'طلبات الاضافه المرفوضه',
								'page_description'	=> 'عرض ',
								'link' => '#'
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            
            <div class="clearfix"></div>
        </div>
     
        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>الكود</th>
                        <th> الكميه  المضافه</th>
                        <th> سبب الرفض</th>


                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)

                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record->product)->name}} </td>
                                <td>{{optional($record->product)->code}} </td>
                                <td>{{$record->quantity}} </td>
                                <td>{{optional($record->reason)->message}}</td>
                              










                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $records->render() !!}
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
