<div>
    @inject('governs',App\Models\Goverment)
   @php
    $governs = $governs->get();
   @endphp

    <div class="col-lg-12 mt-5">
        <h6 class="fw-bold">عربة التسوق ( {{Cart::count()}} ) @if (count($cartItems)>0) <a href="#"  wire:click.prevent="emptyCart" style="color: #f3b21a"><strong>حذف الكل  </strong></a>@endif</h6>
        <div class="row">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

          </div>
        {{-- <div class="col-lg-12">
          @error('error')
          <div  style="margin:2px" class="alert alert-danger" role="alert">
             <strong>{{ $message }}</strong>
             @enderror

          </div> --}}

    </div>
    <div class="row">
        @if (count($cartItems)>0)

    <div class="col-lg-8 mb-5 ">

             @foreach ($cartItems as $item)
        <div>

            <section id="cart" class="mb-5">
              <article class="product">
             <header>
                    {{-- href='{{route('cart.deleteRow' ,$item->rowId)}}' --}}
                 <a href="#"  wire:click.prevent="deleteRow('{{$item->rowId}}')" class="remove" >
                    <img src="{{asset($item->options->attachments)}}" class="img-fluid" alt="">

                    <h3> حذف المنتج </h3>

                  </a>
                </header>

                <div class="content">

                  <p class="fw-bold color-gray my-2">  اسم المنتج : {{$item->name}}</p>
                  <p> الكود :{{$item->options->code}} </p>
                  <p>اللون : {{$item->options->colorName}}</p>

                </div>

                <footer class="content">
                    <span class="qt-minus"> <a href="#" wire:click.prevent="decQuantity('{{$item->rowId}}')" >-</a></span>
                  <span class="qt">{{$item->qty}}</span>
                  <span class="qt-plus" > <a href="#" wire:click.prevent="incQuantity('{{$item->rowId}}')" >+</a></span>

                  <h2 class="full-price">
                    {{$item->price * $item->qty}} جنيه
                  </h2>

                  <h2 class="price color-gray">
                  {{$item->price}}
                  </h2>
                </footer>
              </article>
            </section>
        </div>
             @endforeach

    </div> 




 {{-- empty cart --}}
        @else
        <div class="col-lg-8 my-5">
        <section id="cart ">
        <h2>لا يوجد منتجات حاليا</h2>
        </section>
         </div>

       @endif
    {{-- empty cart --}}
       <div class="col-lg-4  ">
                  <div class="my-5 p-4 final-price">
                    <p class="color-gray text-center fw-bold">برجاء اختار المحافظه</p>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">المحافظه</label>
                        <div class="col-sm-9">
                            <select class="form-control" wire:model="governId" wire:change="shipping" name="governorate_id" id="govern">
                                <option value=""  selected>يرجى اختيار المحافظة</option>
                                @foreach ($governs as $govern)
                                <option  value="{{$govern->id}}">{{$govern->name}}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('governorate_id'))
                            <span class="help-block">
                                {{ $errors->first('governorate_id') }}
                            </span>
                            @endif                                    </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label"> سعر الشحن</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$shipping}}"   class="form-control" readonly>
                            </div>
                            </div>
                    </div>
                    <div class="my-5 p-4 final-price">
                    <p class="color-gray text-center fw-bold">إدخل كود الخصم</p>
                    <form action="#" method="get" class="form"   wire:submit.prevent="applyCode">
                        <input type="text"  class="form-control my-5"  wire:model="code" id="discountCode" placeholder="إدخل كود الخصم">
                        <div>
                            @if (session()->has('notValidCode'))
                                <div  class="alert alert-danger">
                                    {{ session('notValidCode') }}
                                </div>
                            @endif
                        </div>
                        <div>
                            @if (session()->has('validCode'))
                                <div class="alert alert-success">
                                    {{ session('validCode') }}
                                </div>
                            @endif
                        </div>
                     <button type='submit' class="btn btn-outline-secondary w-100" > استخدم كود الخصم </button>
                    </form>
                    </div>
          
                    
                    
                     <div class="final-price p-4">
           <p class="color-gray text-center fw-bold"> إجمالي الطلب</p>
           <hr>
           @foreach ($cartItems as $item)

           <p class="d-inline ms-4"><span class="color-yellow">{{$item->price}}</span> * <span class="color-yellow">{{$item->qty}}</span> </p>
           <p class="d-inline"> <span>{{$item->name}} </span> - <span>{{$item->options->code}} </span> - <span>{{$item->options->colorName}} </span>  </p>

           <hr>
           @endforeach
           <p class="fw-normal">المجموع : <span class="fw-bold color-gray"> {{Cart::subtotal()}} </span> <span class="color-yellow"> جنيه </span> </p>
           @if($total_after_discount)
           <p id="total_after_discount" class="fw-normal">المجموع بعد الخصم : <span class="fw-bold color-gray"> {{$total_after_discount}} </span> <span class="color-yellow"> جنيه </span> </p>
           @endif
           {{-- <p id="total" class="fw-normal">المجموع الكلي شامل الشحن: <span class="fw-bold color-gray"> {{$total}} </span> <span class="color-yellow"> جنيه </span> </p> --}}
           @if(auth()->user())

           <a href="#" class="btn btn-outline-secondary " data-bs-toggle="modal" data-bs-target="#exampleModal"> إتمام الشراء </a>
           @else
           <a href="{{route('viewLogin')}}" class="btn btn-outline-secondary" > إتمام الشراء </a>

           @endif
           <!-- payment method aria -->
           <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">

            <h5 class="modal-title " id="exampleModalLabel">إتمام الشراء </h5>


             </div>
            <div class="modal-body">
            <!-- cash payment -->
            @if(auth()->user())

            <div class="cash-payment my-5">
         
                    <div id="cash-payment">
                    <div class="card card-body">
                        <form action="{{route('cart.checkout')}}" method="post">
                             @csrf

                                 <input hidden value="{{$code}}" name="code">
                                <input hidden value="{{$governId}}" name="government_id">
                                <input hidden value="{{$total_after_discount}}" name="total_after_discount">
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">الاسم</label>
                                <div class="col-sm-10">

                                    <input type="text"  value="{{auth()->user()->fname." " . auth()->user()->lname}}" name='name'  class="form-control" id="inputPassword">
                                </div>
                                </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">الرقم</label>
                                <div class="col-sm-10">
                                    <input type="number"  value="{{auth()->user()->phone}}" name="phone" class="form-control" id="inputPassword">
                                </div>
                                </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">رقم آخر</label>
                                <div class="col-sm-10">
                                    <input type="number" placeholder="اختياري" name="phone2" class="form-control" id="inputPassword">
                                </div>
                                </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label"> العنوان</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{auth()->user()->address}}"  name="address" class="form-control" placeholder="ادخل العنوان" id="inputPassword">
                                </div>
                                </div>
                                        <button tupe="submit" name="action" value="cash" class="btn btn-secondary w-100 my-2" >    الدفع نقدا <span><i class="fas fa-wallet"></i></span></button>
                                        <button type="submit"  name="action" value="visa" class="btn btn-warning w-100 my-2">  الدفع بالفيزا <span><i class="fab fa-cc-visa"></i></span></button>
                
                        </form>
                    </div>
                    </div>
            </div>
            @endif
             


            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            <button type="button" class="btn btn-warning text-light"> إتمام الشراء </button>
            </div>
            </div>
            </div>
            </div>
                    </div>
                </div>
            </div>
            @section('scripts')
            <script>
                $(document).ready(function(){


                $(".qt-minus").click(function(){

                $(this).parent().children(".full-price").addClass("minused");
                 var el = $(this);

                window.setTimeout(function(){el.parent().children(".full-price").removeClass("minused");}, 150);
                    });
                $(".qt-plus").click(function(){

                $(this).parent().children(".full-price").addClass("added");
                var el = $(this);
                window.setTimeout(function(){el.parent().children(".full-price").removeClass("added");}, 150);
                });



            });
            // $("#discountCode").keyup(function() {

            //     if (!this.value) {
            //         document.getElementById('total_after_discount').innerHTML = '';
            //         $price_after_discount
            //     }

            //     });


             </script>

            @endsection


</div>



