@extends('website.layouts.main')
@section('title', ' المنتجات')
@section('content')
    @inject('slides',App\Models\Advertisement)

    <!-- banner -->
    <div class="container ">
        <div class="row">
            <div class="col-lg-4 ">
                @foreach ($slides->where('type', 4)->where('is_active', 1)->get()
        as $key => $value)
                    @foreach ($value->attachmentRelation as $slide)
                        <a href="{{ $slide->link }}">
                            <img src="{{ asset($slide->path) }}" alt="" class=" img-fluid">
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <!-- banner end -->
    <!-- filter -->
    <!-- filter end -->
    <!-- cards -->
    @livewire('all-products')

    <!-- cards end -->
@endsection
