@extends('admin.layouts.main',[
                                'page_header'       => __('عرض التفاصيل'),
                                'page_description'  => __('طلب رقم #').$order->id,
                                'link' => url('admin/product')
                                ])
@section('content')

    <style>

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <div class="ibox">
        <div class="ibox-content">
            <div class="table-responsive">
                <h3 class="">{{__('تفاصيل الطلب')}}</h3>


                <table class="table m-b-xs">
                    <tbody>

                    <tr>
                        <td>
                            {{__('اسم العميل')}} : <strong>{{optional($order)->name}}</strong>
                        </td>
                        <td>
                            {{__('المحافظة')}} : <strong>{{optional($order->government)->name}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('العنوان')}} : <strong>{{$order->address}}</strong>
                        </td>
                        <td>
                            {{__('الرقم التسلسلي')}} : <strong>{{$order->id}}</strong>

                        </td>
                    </tr>


                    <tr>
                        <td>
                            {{__('رقم الهاتف')}} : <strong>{{$order->phone}}</strong>
                        </td>
                        <td>
                            {{__(' رقم الهاتف 2')}} : <strong>{{$order->phone2 , 'لايوجد'}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('تاريخ الطلب')}} : <strong>{{$order->created_at}}</strong>
                        </td>
                        <td>
                            {{__('كود الطلب')}} : <strong>{{$order->code}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('السعر الاصلي ')}} : <strong>{{ $order->totalPrice }}</strong>
                        </td>
                        <td>
                            {{__('السعر في حالة وجود كود خصم ')}} : <strong>{{ $order->total_after_discount ?? 'لا يوجد كود خصم' }}</strong>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            {{__(' سعر الشحن')}} : <strong>{{$order->government->price}}</strong>
                        </td>
                        <td>
                            {{__(' السعر الكلي شامل الشحن')}} : <strong>{{$order->total_after_discount ? ($order->total_after_discount + $order->government->price) : ($order->totalPrice + $order->government->price )   }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__(' يوجد كود خصم')}} : <strong>{{$order->discount_code_id != null ? 'يوجد' : 'لا يوجد' }}</strong>
                        </td>

                        <td>
                            <button class="btn btn-success texet-center" data-toggle="modal" data-target="#accepted" type="submit">
                                <i class="fa fa-check"></i>تغيير الحالة
                            </button>
                            </td>
                            @include('admin.orders.pending.accepted')
                        </td>
                    </tr>


                        </tbody>
                    </table>
                </div>

        </div>
    </div>

<hr>
    <div class="clearfix"></div>
            <br>
            <br>
        <div class="ibox">
            <div class="ibox-title">
                <h4>{{__('المنتجات')}}</h4>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="data-table table table-bordered dataTables-example">
                        <thead>
                            <th class="text-center">#</th>
                            <th>اسم المنتج</th>
                            <th>كود المنتج</th>
                            <th>عدد القطع</th>
                            <th> سعر القطعة شامل التصنيف</th>
                            <th>سعر القطعة صافي</th>
                            <th>اللون</th>
                            <th>الصور</th>
                            <th>استرجاع</th>
                        </thead>
                        <tbody>
                            @php $count = 1; @endphp

                            @foreach($products as $product)
                                <tr id="removable{{$product->id}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$product->product->name}}</td>
                                    <td>{{$product->product->code}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->price}}</td>
                                    <td> {{ $product->price - optional($order->government)->price}}</td>

                                    <td>
                                        {{ $product->product->colorName }}
                                    </td>

                                    <td>

                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#exampleModalPhoto{{$product->id}}">
                                            <i class="fa fa-eye" ></i>
                                        </button>

                                        <div class="modal fade" id="exampleModalPhoto{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">الصور</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @foreach($product->product->attachmentRelation()->whereNull('usage')->get() as  $attachment)
                                                                <div class="col">
                                                                    <img id="myImg" src="{{asset($attachment->path)}}"  style="width:100%;max-width:300px">

                                                                </div>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                        <td>

                                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#refund{{$product->id}}">
                                                <i class="fa fa-eye" ></i>
                                            </button>

                                        </td>
                                        @include('admin.orders.received.refunds.refund-modal')

                                </tr>
                            @endforeach
                            @php $count ++; @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@stop

@push('scripts')
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }


    </script>
@endpush
