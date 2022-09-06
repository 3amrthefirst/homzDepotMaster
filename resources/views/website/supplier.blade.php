

  @extends('website.layouts.main')
  @section('title',' المنتجات')
  @section('content')

<!-- banner -->
{{-- <div class="container my-5">
    <div class="row">
        <div class="col-lg-12 my-5">
            <a href="#">
                <img src="{{ asset('website/img/banner.jpg') }}" alt="" class="img-header img-fluid">
            </a>
        </div>
    </div>
</div> --}}
<!-- banner end -->
<!-- filter -->
<!-- filter end -->
<!-- cards -->
@livewire('supplier-products', ['supplierId' => $supplierId])

<!-- cards end -->
@endsection
