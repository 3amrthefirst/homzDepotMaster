@extends('website.layouts.main')
@section('title','تفاصيل المنتج')
@section('zoom')
 <!-- zoom -->
 <link rel="stylesheet" type="text/css" href="{{ asset('website/css/stylezoom.css') }}">
@endsection
@section('content')

<div class="container main my-5 p-5">
  <div class="row">
                <!-- carusal extend -->
            <div class="col-lg-6">
              <!-- Primary carousel image -->

                <div class="showw" href="1.jpg">
                    <img src="{{asset($product->attachmentRelation[0]->path ?? null)}}" id="show-img" class="img-fluid">
                </div>

            <!-- Secondary carousel image thumbnail gallery -->

                <div class="small-img">
                    <div class="small-container">
                        <div id="small-img-roll">
                            @foreach($product->attachmentRelation as $img)
                            <img src="{{asset($img->path)}}" class="show-small-img img-fluid" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- carusal extend end -->
           <div class="col-lg-6">
      <div class="my-3">
            <h5 class="color-gray fw-bold">{{$product->name}} </h5>
            @if($product->discountPercentStatus == 1)
            <h6 class="color-yellow d-inline">{{ $product->prodcuts_price_after_discount_percents }} جنيه</h6> <span class="product-discount-labell d-inline">-{{ $product->discountPercent }}%</span>
            <h6><del>{{ $product->ProductPrice}} جنيه</del></h6>
            @elseif ($product->discountValueStatus == 1)
            <h6 class="color-yellow d-inline">{{ $product->ProductPriceAfterDiscountValue }} جنيه</h6>
            <h6><del>{{ $product->ProductPrice}} جنيه</del></h6>
            @else
            <h6 class="color-yellow d-inline">{{ $product->ProductPrice }} جنيه</h6>
            @endif
      </div>
             <div class="my-3 hyper-links">
         <a href="{{route('cart.add',$product->id)}}" class="btn btn-secondary d-inline">إضافه إلى العربة</a>
          <!--<a href="#" class="btn d-inline" style="color: #00B2FF;"> <span style="color: #00B2FF;"><i class="fab fa-facebook-messenger"></i></span> تحتاج للمساعدة </a>-->
         </div>
    <div class="my-5"></div>
    <hr>
    <h5 class="color-gray fw-bold"> معلومات المنتج </h5>
    <ul>
      <a href="{{route('supplier.products',$product->supplier->id)}}">
          <li class="fw-bold">يباع بواسطة : 
      <span class="fw-normal"> {{ optional($product->supplier)->code }} </span>
      </li></a>
      <li class="fw-bold">اللون :
            <span class="fw-normal"> {{ $product->colorName }}   </span>
      </li>
      <li class="fw-bold">المنتج متاح :
      <span class="fw-normal"> {{$product->ProductReceivedTime}}  </span>
      </li>       
      @if($product->size)
      <li class="fw-bold">المقاسات  :
           <span class="fw-normal"> {{ $product->size ?? 'لايوجد' }} </span>
      </li>
      @endif
      @if($product->material)
      <li class="fw-bold">الخامات  :
                  <span class="fw-normal"> {{$product->material}}  </span>
      </li>
      @endif
    </ul>
    </div>

    </div>

  <div class="row mt-3">
    <div class="col-lg-12">
      <h5 class="color-gray fw-bold"> وصف المنتج </h5>
      {!!  optional($product)->description ?? "لا يوجد وصف"!!}
  </div>

</div>

</div>
    <div class="col-lg-12"> 
      @livewire('related-products', ['productId' => $product->id])
    </div>

@endsection
@section('scripts')
     <!-- zoom script -->


     <script src="https://code.jquery.com/jquery-3.3.1.min.js"
     integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
     crossorigin="anonymous"></script>
  <script src="{{asset('website/scripts/zoom-image.js')}}"></script>
  <script src="{{asset('website/scripts/main.js')}}"></script>
@endsection

