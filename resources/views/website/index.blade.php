@extends('website.layouts.main')
@section('title','الرئيسيه')
@section('content')

    <!-- header -->
    <!-- first row header  -->
    {{-- <div class="container my-5">
        <div class="row ">
            <!--  -->
            @for ($i=0;$i<4;$i++)
            <div class="col-lg-3 ">
                <a href="#">
                    <img src="{{asset('website/img/header-pic-first-row.jpg')}}" class="img-fluid img-header" alt="homzdepot">
                </a>
            </div>
            @endfor


        </div>
    </div> --}}
    @inject('slides',App\Models\Advertisement)

        <!-- first row header  -->
     <!-- second row header end -->
            <div class="container mt-2">
                <div class="row">
                       <!-- carusal in header -->
                        <div class="col-lg-12">
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                {{-- <div class="carousel-indicators">
                                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div> --}}
                                <div class="carousel-inner">
                                    @foreach($slides->where('type',0)->where('is_active',1)->get() as $key=>$value)
                                        @foreach($value->attachmentRelation as $slide)
                                            <div  class="carousel-item {{$key == 0 ? 'active' : 0}}">
                                                <img src="{{asset($slide->path)}}" class="d-block w-100 carusal-img img-header img-fluid" alt="...">
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                        </div>
                </div>
            </div>
     <!-- second row header end -->


<!-- header end -->

<!-- index offers -->
            <div class="container mb-5">
                <div class="row">
                    @foreach($slides->where('type',1)->where('is_active',1)->get() as $key=>$value)
                        @foreach($value->attachmentRelation as $slide)
                            <div class="col-6 col-lg-3  my-3">
                                <a href="{{$value->link}}" target="_blank">
                                    <img src="{{asset($slide->path)}}" class="img-fluid img-header" alt="homzdepot">
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
<!-- index offers end -->



<!-- index categories -->

@if(count($slides->where('type',2)->where('is_active',1)->get()) > 0)
<div class="container my-5 ">
    <div class="row">
                <div class="col-lg-12 my-3 cate">
                     <h3> الفئات </h3>
                 </div>
    </div>
    <div class="row slider me-5 cate">
        @foreach($slides->where('type',2)->where('is_active',1)->get() as $key=>$value)
            @foreach($value->attachmentRelation as $slide)
            
                <div class=" col-lg-3 col-6 text-center my-2 cate">
                    <a href="{{$value->link}}" class="text-center" target="_blank">
                        <img src="{{ asset($slide->path) }}" class="img-fluid rounded-circle w-100" alt="homzdepot">
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
@endif

<!-- index categories end -->

{{-- @if($slides->where('type',3)->where('is_active',1)->first())
<!-- banner -->
<div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <a href="{{$slides->where('type',3)->where('is_active',1)->first()->link}}" target="_blank">
                <img src="{{ asset($slides->where('type',3)->where('is_active',1)->first()->attachmentRelation->path) }}" alt="homzdepot" class="img-header img-fluid">
            </a>

        </div>
    </div>
</div>
@endif
<!-- banner end --> --}}

<!-- index recentely added -->
<div class="container my-5">
    <div class="row ">
        <div class="col-12 text-center recentely-added ">
            <h3 class="dark"> أضيف حديثا </h3>
            <p> ماتفوتش أكبر عروضنا </p>
            <a href="{{ route('all-products') }}" class="btn btn-dark"> عرض المزيد </a>
        </div>
    </div>
</div>
@livewire('products')
<!-- index recentely added end -->

<!-- last index offers -->
<div class="container my-5">
    <div class="row my-3">
        @foreach($slides->where('type',3)->where('is_active',1)->get() as $key=>$value)
        @foreach($value->attachmentRelation as $slide)
        <div class="col-lg-4">
            <a href="{{$value->link}}" target="_blank">
                <img src="{{ asset($slide->path) }}" alt="homzdepot" class="img-header img-fluid">
            </a>
        </div>
        @endforeach
        @endforeach
    </div>
</div>
<!-- last index offers end -->


@endsection
@section('scripts')

<script>
</script>
@endsection
