@extends('admin.layouts.main',[
								'page_header'		=> 'التفاصيل',
								'page_description'	=> 'عرض ',
								'link' => url('admin/products/aceepted')
								])
@section('content')
<div class="ibox">
        <div class="ibox-content">
            <div class="table-responsive">
                <h3 class="">{{__('المنتج')}}</h3>
                <table class="table m-b-xs">
                    <tbody>
                    <tr>
                        <td>
                            {{__('اسم المنتج')}} : <strong>{{$data->name}}</strong>
                        </td>
                        <td>
                            {{__('وصف المنتج')}} : <strong>{{$data->description}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('الكود')}} : <strong>{{$data->code}}</strong>
                        </td>
                        <td>
                            {{__('المورد')}} : <strong>{{optional($data->supplier)->name}}</strong>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('الكمية الاصلية')}} : <strong>{{$data->original_quantity}}</strong>
                        </td>
                        <td>
                            {{__('الكمية المتاحة')}} : <strong>{{$data->availableQuantity}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('السعر الصافي')}} : <strong>{{$data->price}}</strong>
                        </td>
                        <td>
                            {{__(' السعر في الموقع')}} : <strong>{{$data->price + optional($data->category)->price}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('السعر بعد تفعيل قيمة الخصم')}} : <strong>{{$data->discountValue}}</strong>
                        </td>
                        <td>
                            {{__(' السعر بعد تفعيل نسبة الخصم ')}} : <strong>{{$data->ProdcutsPriceAfterDiscountPercents}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('نسبة الخصم')}} : <strong>{{$data->discountPercent}} %</strong>
                        </td>
                        <td>
                            {{__(' الكمية المراد اضافتها')}} : <strong>{{$record->quantity}} </strong>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('اسم اللون')}} : <strong>{{$data->colorName}}</strong>
                        </td>
                        <td>
                            {{__(' اللون')}} : <div style="
                            width: 3rem;
                            height: 3rem;
                            border-radius: 50%;
                            background-color: {{$data->color}};
                            margin: 0 0.05rem;
                          "></div>
                        </td>


                    </tr>
                    @can('اضافات الكميات في المخزن')
                    <tr>
                        
                        <td>
                            {{__('الموافقة')}} :   <button class="btn btn-primary texet-center" data-toggle="modal" data-target="#accepted" type="submit">
                                <i class="fa fa-check"></i> &nbsp;الموافقة
                            </button>
                            @include('admin.store.add-quantity.accepted')
                        </td>
                        <td>
                            {{__('الرفض')}} :  <button class="btn btn-danger" data-toggle="modal" data-target="#rejected" type="submit">
                                <i class="fa fa-ban"></i> &nbsp; الرفض
                                </button>
                                @include('admin.store.add-quantity.rejected')
                        </td>
                    </tr>
                    @endcan

                    </tbody>
                </table>
            </div>
        </div>
    </div>


<div class="container">


    <div class="row">
        @foreach($data->attachmentRelation()->whereNull('usage')->get() as  $attachment)
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
