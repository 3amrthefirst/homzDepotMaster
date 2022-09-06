@extends('admin.layouts.main',[
								'page_header'		=> ' الطلبات المطلوبة بالفيزا',
								'page_description'	=> ' عرض ',
								'link' => url('admin/orders')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-right">
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>id</th>
                        <th>order ID </th>                        
                        <th>تاريخ الطلب</th>
                        <th>حالة المعاملة</th>
                        <th>رقم الاوردر</th>
                        <th>عليه استرجاع</th>

                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{optional($record)->id}}</td>
                                <td>{{$record->order_id}}</td>
                                <td>{{optional($record)->created_at}}</td>
                                <td>{{ $record->success == 'true' ? 'مقبولة': 'مرفوضة' }}</td>
                                <td>{{ $record->order }}</td>
                                <td>{{ $record->is_refunded == 'true' ? 'نعم': 'لا' }}</td>
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
