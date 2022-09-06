@extends('website.layouts.main')
@section('title',' الصفحه الشخصيه')
@section('content')

<div class="container my-5 ">
    <div class="row">
@error('success')
          <div  style="margin:2px" class="alert alert-success" role="alert">
             <strong>{{ $message }}</strong>
          </div>
      @enderror
      <div class="col-lg-12">
        @error('error')
        <div  style="margin:2px" class="alert alert-danger" role="alert">
           <strong>{{ $message }}</strong>
        </div>
    @enderror
      <div class="col-lg-12 ">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="px-2" role="presentation">
            <button class=" btn btn-warning" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">طلباتي السابقه</button>
          </li>
          <li class="px-2" role="presentation">
            <button class="btn btn-warning" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">حسابي</button>
          </li>
          <li class="px-2" role="presentation">
            <button class="btn btn-warning " id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">العناوين</button>
          </li>
        </ul>
      </div>
      <div class="col-lg-12">
        <!-- my orders  -->
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show my-5 table-responsive" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered border-dark table-hover table-responsive ">
              <thead>
                <tr class="table-dark ">
                    <th scope="col">رقم الطلب </th>
                    <th scope="col">  كود الطلب</th>
                    <th scope="col"> السعر  الكلي</th>
                    <th scope="col"> الشحن </th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">طريقه الدفع</th>
                    <th scope="col"> حاله الطلب</th>
                    <th scope="col"> الغاء الطلب</th>
                    <th scope="col"> التفاصيل</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)

                <tr class="table-light">
                  <th scope="row" >{{ $loop->iteration}}</th>
                  <td>{{$order->code}}</td>
                  @if($order->discount_code_id && $order->total_after_discount)
                  <td>{{$order->total_after_discount}}</td>
                  @else
                  <td>{{$order->totalPrice}}</td>
                  @endif
                  <td>{{$order->shipping}}</td>
                  <td>{{$order->created_at->format('d/m/y')}}</td>
                  <td>{{$order->type}}</td>
                  <td> {{$order->order_status}}  </td>
                  
                  <td>
                    @if($order->status == 'pending'
                        || $order->status == 'storePending'
                        || $order->status == 'inProgress'
                         )
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $order->id }}">
                        الغاء الطلب
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    تأكيد الغاء الطلب</h5>
                                    </h5>

                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('order.cancel',$order->id) }}" method="post">
                                        @csrf
                                        هل انت متأكد من الغاء هذا الطلب ؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-danger">
                                        التأكيد</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else 
                    غير متاح
                    @endif
                </td>


                  <td> <a href="{{ route('order.details',$order->id) }}" class="btn btn-outline-warning"> تفاصيل الطلب </a> </td>
                </tr>
                @endforeach

                <tr>
              </tbody>
            </table>
          </div>


          <!-- my profile -->
          <div class="tab-pane fade my-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <p class="h3 mb-3">حسابي
                      <a data-toggle="modal" data-target="#profileEdit"  class="btn btn-outline-secondary pr-2"> <i class="fa fa-edit"></i> تعديل المعلومات الشخصيه</span></a>

                    </p>
                    <p><span class="fw-bold"> الاسم : </span><span> {{$user->fname .' '. $user->lname}}</span></p>
                    <p><span class="fw-bold"> البريد الالكتروني : </span><span> {{$user->email}} </span></p>
                    <p><span class="fw-bold">  الهاتف المحمول : </span><span> {{$user->phone}} </span></p>

                  </div>



          <!-- my adress -->
          <div class="tab-pane fade my-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <p class="h4"> العنوان </p>
            <a data-toggle="modal" data-target="#address"  class="btn btn-outline-secondary "> <i class="fa fa-edit"></i> تعديل العنوان</span></a>

                      </p>


                            <p><strong>العنوان: </strong>{{auth()->user()->address}} </p>
          </div>
        </div>
        @include('website.profile.address')
        @include('website.profile.profileEdit')

      </div>
    </div>
  </div>
</div>  


<!-- content end -->

@endsection
