@extends('supplier.layouts.main',[
								'page_header'		=> 'التفاصيل',
								'page_description'	=> 'عرض ',
								'link' => url('supplier/products/show')
								])
@section('content')
<div class="ibox">
    <div class="ibox-title">
        <div class="pull-right">

          
            <div>
                <a href="{{route('supplier.products.edit',$record->id)}}" class="btn btn btn-success"><i class="fa fa-edit">أعاده ارسال</i></a>
            </div>
        

        

        </div>

        <div class="clearfix"></div>
    </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <h3 class="">{{__('المنتج')}}</h3>
                <table class="table m-b-xs">
                    <tbody>
                    <tr>
                        <td>
                            {{__('اسم المنتج')}} : <strong>{{$record->name}}</strong>
                        </td>
                        <td>
                            {{__('وصف المنتج')}} : <strong>{{$record->description}}</strong>
                        </td>
                    </tr>
                    <td>
                        {{__(' التصنيف الرئيسي')}} : <strong>{{$record->category->name}}</strong>
                    </td>
                    <td>
                        {{__(' التصنيف الفرعي')}} : <strong>{{optional($record->subCategory)->name  ?? 'لا يوجد'}}</strong>
                    </td>
                    <tr>
                    </tr>
                    <tr>
                        <td>
                            {{__('الكود')}} : <strong>{{$record->code}}</strong>
                        </td>
                        <td>
                            {{__('المورد')}} : <strong>{{optional($record->supplier)->name}}</strong>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            {{__('المقاسات')}} : <strong>{{$record->size ?? 'لا يوجد'}}</strong>
                        </td>
                        <td>
                            {{__('الخامات')}} : <strong>{{$record->material ?? 'لا يوجد'}}</strong>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('الكمية الاصلية')}} : <strong>{{$record->original_quantity}}</strong>
                        </td>
                        <td>
                            {{__('السعر ')}} : <strong>{{$record->price}}</strong>
                        </td>


                    </tr>
                    <tr>
                        <td>
                            {{__('الكمية المباعه')}} : <strong>{{$record->saledQuantity}}</strong>
                        </td>
                        <td>
                            {{__('الكمية المتاحة')}} : <strong>{{$record->availableQuantity}}</strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{__('الكمية المضافة')}} : <strong>{{array_sum($record->addQ()->pluck('quantity')->toArray())}}</strong>
                        </td>
                        <td>
                            {{__('الكمية المسحوبة')}} : <strong>{{array_sum($record->pullQ()->pluck('quantity')->toArray())}}</strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{__('قيمة الخصم')}} : <strong>{{$record->discountValue}}</strong>
                        </td>
                        <td>
                            {{__('نسبة الخصم ')}} : <strong>{{$record->discountPercent}}</strong>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('وقت التسليم')}} : <strong>{{$record->product_Received_time}}</strong>

                        </td>
                        <td>
                            {{__('اسم اللون')}} : <strong>{{$record->colorName}}</strong>

                         </td>
                    </tr>

                    <tr>
                        <td>
                            {{__('حاله المنتج')}} : <strong>{{$record->product_status}}</strong>

                        </td>
                        <td>
                            {{__('سبب الرفض')}} : <strong>{{$record->reason->message}}</strong>

                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>


<div class="container">


    <div class="row">
        @foreach($record->attachmentRelation()->whereNull('usage')->get() as  $attachment)
            <div class="col-sm-3">
                <img id="myImg" src="{{asset($attachment->path)}}"  style="width:100%;max-width:300px">

            </div>
            <br>
        @endforeach
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
