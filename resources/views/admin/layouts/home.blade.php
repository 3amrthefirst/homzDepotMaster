@extends('admin.layouts.main',[
                                    'page_header'       => 'الصفحة الرئيسية',
                                    'page_description'  => 'إحصائيات عامة',
                                    'link' => url('admin')
                                ])
@section('content')

@push('styles')
    {{-- ChartStyle --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush

@push('scripts')
     {!! $line1->script() !!}
    {{-- {!! $line2->script() !!}--}}
    {!! $pie->script() !!}
@endpush
@if($orders->count() > 0)
<div class="alert alert-danger" role="alert">
    <a href="{{route('orders.canceled')}}">

        يوجد عدد {{ $orders->count() }} طلبات الغاء طلب
    </a>
  </div>
  
@endif
@inject('goverments', 'App\Models\Goverment')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>المحافظات</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$goverments->count()}}</h1>
        </div>
    </div>
</div>
@inject('categories', 'App\Models\Category')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>التصنيفات الرئيسية</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$categories->whereNull('parent_id')->count()}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>التصنيفات الفرعيه</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$categories->whereNotNull('parent_id')->count()}}</h1>
        </div>
    </div>
</div>
@inject('products', 'App\Models\Product')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>المنتجات المعلقة</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$products->where('status','pending')->count()}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>المنتجات المقبولة</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$products->where('status','accepted')->count()}}</h1>
        </div>
    </div>
</div>
@inject('discount_code', 'App\Models\DiscountCode')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>كوبونات الخصم المفعلة</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$discount_code->where('is_active',1)->count()}}</h1>
        </div>
    </div>
</div>
@inject('add_q', 'App\Models\AddQuantity')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>طلبات اضافة كمية لمنتج المعلقة</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$add_q->where('status','pending')->count()}}</h1>
        </div>
    </div>
</div>
@inject('pull_q', 'App\Models\PullQuantity')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>طلبات سحب كمية لمنتج المعلقة</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$pull_q->where('status','pending')->count()}}</h1>
        </div>
    </div>
</div>
@inject('complaints', 'App\Models\Complaint')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
        <h5>الشكاوي والمقترحات</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$complaints->count()}}</h1>
        </div>
    </div>
</div>
@inject('orders', 'App\Models\Order')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
        <h5> الطلبات المعلقة</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$orders->where('status','pending')->count()}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
        <h5> الطلبات قيد التنفيذ</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$orders->where('status','inProgress')->count()}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
        <h5> الطلبات جاهزة للشحن</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$orders->where('status','ready')->count()}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
        <h5> الطلبات يتم شحنها للشحن</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$orders->where('status','delireved')->count()}}</h1>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
        <h5> الطلبات المستلمة</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$orders->where('status','received')->count()}}</h1>
        </div>
    </div>
</div>


 <div class="ibox ">
    <div class="row">
         <div class="col-md-6">
            <div class="ibox-title">
                <h5>الطلبات</h5>
            </div>
            <div class="ibox-content">
                {!! $pie->container() !!}
            </div>
        </div>


        <div class="col-md-6">
            <div class="ibox-title">
                <h5>المنتجات شهريا</h5>
            </div>
            <div class="ibox-content">
                {!! $line1->container() !!}
            </div>

        </div>
    </div>

</div>

@endsection

