
  @extends('website.layouts.main')
  @section('title',' نتائج البحث')
  @section('content')
<!-- banner -->
<div class="container my-5">
    <div class="row">
          <h5 class="text-center">نتائج البحث في جميع المنتجات</h5>
    </div>
</div>
<!-- banner end -->
<!-- filter -->
<!-- filter end -->
<!-- cards -->
@livewire('search-list')

<!-- cards end -->
@endsection
