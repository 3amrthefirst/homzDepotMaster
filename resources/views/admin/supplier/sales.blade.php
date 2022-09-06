@extends('admin.layouts.main',[
								'page_header'		=> 'الموردين',
								'page_description'	=> 'عرض المبيعات ',
								'link' => '#'
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            المبيعات
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
                        <th>الكمية</th>
                        <th>تاريخ انشاء العملية </th>
                        <th>تاريخ وصول الطلب </th>
                        <th>المبلغ</th>
                        <th> المبلغ الكلي</th>
                        <th>الحالة</th>
                        <th>الرقم التسلسلي للطلب</th>
                        <th>مرتجعات</th>

                        </thead>
                        <tbody>
                        @php $count = 1; @endphp

                        @foreach ($products as $product)
                            @foreach ($product->orderProducts as $item)
                            <tr>
                                <td>{{$count}}</td>
                                <td> <a href="{{url('admin/product/show/'.$product->id)}}"> {{optional($product)->name}}</a></td>
                                <td>{{optional($product)->code}}</td>
                                <td>{{optional($item)->quantity}}</td>
                                <td>{{optional($item)->created_at}}</td>
                                <td>{{optional($item->order)->receivedDate ?? 'لم يصل بعد'}}</td>
                                <td>{{optional($product)->price_after_discount}}</td>
                                <td>{{optional($product)->price_after_discount * optional($item)->quantity}}</td>
                                <td>{{optional($item->order)->Order_Status}}</td>
                                <td>{{optional($item->order)->id}}</td>
                                <td>{{optional($item->order)->refund == 1 ? 'يوجد استرجاع': 'لا يوجد ' }}</td>
                            </tr>
                            @php $count ++; @endphp
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $products->render() !!}
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
