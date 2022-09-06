@extends('supplier.layouts.main',[
                                    'page_header'       => 'الصفحة الرئيسية',
                                    'page_description'  => 'إحصائيات عامة',
                                    'link' => url('supplier')
                                ])
@section('content')

@push('styles')
    {{-- ChartStyle --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush

@push('scripts')
    {{-- {!! $line1->script() !!}
    {!! $line2->script() !!}
    {!! $pie->script() !!} --}}
@endpush
@inject('products', 'App\Models\Product')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>المنتجات</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$products->where('supplier_id',auth()->id())->count()}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> المنتجات المقبوله</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$products->where('supplier_id',auth()->id())->where('status','accepted')->count()}}</h1>
        </div>
    </div>
</div>
@inject('addQuantity', 'App\Models\AddQuantity')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>طلبات اضافه كميات</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$addQuantity->where('supplier_id',auth()->id())->count()}}</h1>
        </div>
    </div>
</div>
@inject('pullQuantity', 'App\Models\PullQuantity')
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>طلبات سحب الكميات</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$pullQuantity->where('supplier_id',auth()->id())->count()}}</h1>
        </div>
    </div>
</div>




@endsection

