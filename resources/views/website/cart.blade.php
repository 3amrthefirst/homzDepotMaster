@extends('website.layouts.main')
@section('title','العربه')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-12">
          <div class="wrapper mt-sm-5 bg-white">
              <div class="progresses py-4">
                  <ul class="d-flex align-items-center justify-content-between">
                      <li id="step-1" class="blue"></li>
                      <li id="step-2"></li>
                      <li id="step-3"></li>
                  </ul>
                  <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
              </div>
          </div>
      </div>
     
                 <livewire:cart-list />
    </div>

</div>
@endsection
