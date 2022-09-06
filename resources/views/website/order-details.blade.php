@extends('website.layouts.main')
@section('title','تفاصيل الطلب')
@section('content')

  <div class="container">
      <div class="row">
          <!-- title -->
          <div class="col-lg-12 my-4">
            <section class=" text-dark">
                <h4 class="fw-bolder">تفاصيل الطلب</h4>
            </section>
          </div>

          <!-- title end -->
<!-- table details -->
<div class="col-lg-12">
<table class="table table-bordered border-dark border-rounded text-center ">
    <thead>
      <tr>
        <th scope="col"> صوره المنتج </th>
        <th scope="col">اسم المنتج</th>
        <th scope="col"> اللون </th>
        <th scope="col">العدد</th>
        <th scope="col">السعر</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
      <tr>
        <td> <img src="{{asset(optional($product->product)->attachmentRelation[0]->path ?? null)}}" class="w-25 img-fluid rounded-circle" alt="product pic"></td>
        <td>{{ optional($product->product)->name }}</td>
        <td>
          <strong>{{optional($product->product)->colorName}}</strong>
        </td>
        <td>{{ optional($product)->quantity }}</td>
        <td>{{ optional($product)->price }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
<!-- table details end -->

      </div>
  </div>
  <div class="">
    <section class=" text-dark">
        <h5 class="fw-bolder" style="text-align: left; margin-left: 15%">السعر الكلي : {{ $order->total_after_discount ? ($order->total_after_discount + $order->government->price) : ($order->totalPrice + $order->government->price )    }}</h5>
    </section>
  </div>

  @endsection
