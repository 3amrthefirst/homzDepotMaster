@extends('supplier.layouts.main',[
								'page_header'		=> 'الطلبات',
								'page_description'	=> 'عرض ',
								'link' => '#'
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-right">

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="ibox-content">
            @if(!empty($products) && count($products)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>الكود</th>
                        <th> كود الطلب</th>
                        <th>السعر </th>
                        <th> الكميه </th>
                        <th> حاله  الطلب</th>

                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($products as $product)
                            @foreach($product->orderProducts as $orderProduct)
                            <tr id="removable{{$orderProduct->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$orderProduct->product->name}} 
                                <td>{{$orderProduct->product->code}}
                                <td>{{optional($orderProduct->order)->code}} 
                                <td>{{$orderProduct->price}} </td>
                                <td>{{$orderProduct->quantity}} </td>
                                <td>{{optional($orderProduct->order)->order_status}} </td>
                            </tr>
                            @php $count ++; @endphp
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
               
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
