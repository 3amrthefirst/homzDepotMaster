@extends('admin.layouts.main',[
								'page_header'		=> ' المرتجعات',
								'page_description'	=> ' عرض ',
								'link' => url('admin/reports')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <h3>طلبات الاسترجاع</h3>
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
                        <th>اسم صاحب الطلب</th>
                        <th> رقم الهاتف</th>
                        <th> كود الطلب</th>
                        <th>العنوان</th>
                        <th>تاريخ الطلب</th>
                        <th>المنتج</th>

                       


                        </thead>
                        <tbody>
                            @php $count = 1; @endphp
                        @foreach($records as $record)
                        @php
                        $rowspanNum = count(optional($record->products)->pluck('id')->toArray());
                       
                    @endphp
                                <tr id="removable{{ $record->id }}">
                                    <td class="text-center" rowspan="{{$rowspanNum}}">
                                        {{ $count }}</td>
                                <td rowspan="{{$rowspanNum}}">{{optional($record->order->customer)->fname}}</td>
                                <td rowspan="{{$rowspanNum}}">{{optional($record->order)->phone}}</td>
                                <td rowspan="{{$rowspanNum}}">{{optional($record->order)->code}}</td>
                                <td rowspan="{{$rowspanNum}}"> {{optional($record->order->government)->name}} || {{optional($record->order)->address}} </td>
                                <td rowspan="{{$rowspanNum}}">{{optional($record)->created_at}}</td>
                                @foreach ($record->products as $product )
                                <td >
                                    
                                        {{optional($product->product)->name }} || كمية : {{ $product->quantity }}

                                </td>
                            </tr>


                            @endforeach
                            @php $count++; @endphp

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
