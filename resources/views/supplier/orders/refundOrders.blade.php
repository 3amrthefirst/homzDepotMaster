@extends('supplier.layouts.main',[
								'page_header'		=> ' الطلبات المرتجعه',
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
            @if(!empty($refunds) && count($refunds)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>الكود</th>
                        <th> كود الطلب</th>
                        <th>السعر </th>
                        <th>التاريخ</th>
                        <th> الكميه </th>

                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                            @foreach($refunds as $refundProduct)
                            <tr id="removable{{$refundProduct->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$refundProduct->product->name}} 
                                <td>{{$refundProduct->product->code}}
                                <td>{{optional($refundProduct->refund->order)->code}} 
                                <td>{{$refundProduct->price}} </td>
                                <td>{{$refundProduct->created_at}} </td>

                                <td>{{$refundProduct->quantity}} </td>
                            </tr>
                            @php $count ++; @endphp
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
