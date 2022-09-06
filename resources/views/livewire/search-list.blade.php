<div>
    <div>
        <div class="container">
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
                
                <div class="col-lg-12">
                    @error('success')
                    <div  style="margin:2px" class="alert alert-success" role="alert">
                       <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                @if(count($products))
                @foreach ($products as $product)
                <div class="col-lg-3 col-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{ route('product-detail',$product->id) }}" class="image">
                                <img class="img-hamo" src="{{asset($product->attachmentRelation[0]->path ?? null)}}" class="img-fluid">
                            </a>
                            @if($product->discountPercentStatus == 1)
                            <span class="product-discount-label">-{{ $product->discountPercent }}%</span>
                            @endif
                            <a href="#" wire:click.prevent="addToCart({{$product->id}})" class="add-to-cart">Add to Cart</a>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ route('product-detail',$product->id) }}">{{ $product->name }} </a></h3>
                            @if($product->discountPercentStatus == 1)
                            <div class="price">{{ $product->ProdcutsPriceAfterDiscountPercents }}جنيه  <span>{{ $product->ProductPrice }} جنيه</span></div>
                            @elseif($product->discountValueStatus == 1)
                            <div class="price">{{ $product->ProductPriceAfterDiscountValue }}جنيه <span>{{ $product->ProductPrice }}جنيه</span></div>
                            @else
                            <div class="price">{{ $product->ProductPrice }}جنيه</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-lg-3">
                   <p>لا يوجد منتجات </p>
                </div>

                @endif
                    </div>
                </div>
        
            </div>
        </div></div>
    <br>
    
        {{ $products->appends(request()->except('page'))->links('website.pagination-view') }}

    
</div>
