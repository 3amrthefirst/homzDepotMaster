
    <div class=" my-5">
        
        <div class="col-lg-12">
          <h3 class="color-gray fw-bold me-5"> منتجات مشابهة</h3>
        </div>
        <div class="container my-5">
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
          <div class="row">
              @foreach ($relatedProducts as $prod )
                   <div class="col-lg-3 col-6 my-3">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{ route('product-detail',$prod->id) }}" class="image">
                                <img class="img-hamo " src="{{asset($prod->attachmentRelation[0]->path ?? null)}}">
                            </a>
                            @if($prod->discountPercentStatus == 1)
                            <span class="product-discount-label">-{{ $prod->discountPercent }}%</span>
                            @endif
                            <a href="#" wire:click.prevent="addToCart({{$prod->id}})" class="add-to-cart">Add to Cart</a>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ route('product-detail',$prod->id) }}">{{ $prod->name }} </a></h3>
                            @if($prod->discountPercentStatus == 1)
                            <div class="price">{{ floor($prod->ProdcutsPriceAfterDiscountPercents) }}  جنيه <span>{{ $prod->ProductPrice }} جنيه </span></div>
                            @elseif($prod->discountValueStatus == 1)
                            <div class="price">{{ floor($prod->ProductPriceAfterDiscountValue) }} جنيه <span>{{ $prod->ProductPrice }}جنيه  </span></div>
                            @else
                            <div class="price">{{ $prod->ProductPrice }} جنيه </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
          </div>
      </div>
    </div>

