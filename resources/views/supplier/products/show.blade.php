@extends('supplier.layouts.main',[
								'page_header'		=> 'التفاصيل',
								'page_description'	=> 'عرض ',
								'link' => url('supplier/products/show')
								])
@section('content')
<div class="ibox">
    <div class="ibox-title">
        <div class="pull-right">

            @if ($record->status == "accepted")
            <div>
            <a class="btn btn-primary s" data-toggle="modal" data-target="#addQuantity{{$record->id}}" type="submit">
                <i class="fa fa-plus"></i> طلب اضافه كميه
            </a>
            @include('supplier.products.addQuantity.addQuantity')
            </div>
            @if($record->original_quantity)
            <a  class="btn btn-danger s" data-toggle="modal" data-target="#pullQuantity{{$record->id}}" type="submit">
                <i class="fa fa-minus"></i> طلب سحب كميه
            </a>

            @endif
            @endif

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
                           تفعيل قيمه الخصم: {!! \App\MyHelper\Helper::toggleBooleanView($record , route('supplier.products.toggleBoolean',[$record->id,"discountValueStatus"]),'discountValueStatus') !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('نسبة الخصم ')}} : <strong>{{$record->discountPercent}}</strong>
                        </td>
                        <td>
                            تفعيل نسبه الخصم: {!! \App\MyHelper\Helper::toggleBooleanView($record , route('supplier.products.toggleBoolean',[$record->id,"discountPercentStatus"]),'discountPercentStatus') !!}
                         </td>
                    </tr>
                     <tr>
                        <td>
                            {{__('حاله المنتج')}} : <strong>{{$record->product_status}}</strong>

                        </td>
                        <td>
                            {{__('وقت التسليم')}} : <strong>{{$record->product_Received_time}}</strong>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{__('اسم اللون')}} : <strong>{{$record->colorName}}</strong>
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
@include('supplier.products.pullQuantity.pullQuantity')



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
