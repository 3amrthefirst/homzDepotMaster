

  @extends('website.layouts.main')
  @section('title',' المنتجات')
  @section('content')
      @inject('slides',App\Models\Advertisement)

<!-- banner -->
 @if($slides->where('type', 4)->where('is_active', 1)->get() != null)
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12 my-5">
                @foreach ($slides->where('type', 4)->where('is_active', 1)->get()
        as $key => $value)
                    @foreach ($value->attachmentRelation as $slide)
                        <a href="{{ $slide->link }}">
                            <img src="{{ asset($slide->path) }}" alt="" class="img-header img-fluid">
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endif  
<!-- banner end -->
<!-- filter -->
<!-- filter end -->
<!-- cards -->
@livewire('category-products')

<!-- cards end -->
@endsection
