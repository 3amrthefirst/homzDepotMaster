@extends('admin.layouts.main',[
								'page_header'		=> '  تقرير المبيعات ',
								'page_description'	=> ' عرض ',
								'link' => url('admin/report')
								])

@section('content')
@inject('suppliers', 'App\Models\Supplier')
@php
$suppliers=$suppliers->get();
        $companyRefunds = 0;
        $customerRefunds = 0;
        $totalRefunds = 0;
        $totalSupplierProfit = 0;
        $totalSupplierRefund=0;
        $allwebsiteProfit=0;
        $AllSupplierNetProfit=0;

        foreach($records as $record)
        {

            foreach($record->refunds as $refunds){
           foreach ($refunds->products as $refundsProducts) {
                $totalRefunds += $refundsProducts->price;

           }

        }



        }

        foreach($suppliers as $supplier){
            $totalSupplierProfit += ($supplier->allProfit);
            $totalSupplierRefund += ($supplier->allRefundProfit);
            $allwebsiteProfit += ($supplier->All_Website_Profit);
            $AllSupplierNetProfit+=$supplier->All_Supplier_Net_Profit;


        }
        $totalDiscountOrders=array_sum($orders->whereNotNull('discount_code_id')->whereNotNull('total_after_discount')->pluck('totalPrice')->toArray());
        $afterDiscountOrders=array_sum($orders->whereNotNull('discount_code_id')->whereNotNull('total_after_discount')->pluck('total_after_discount')->toArray());
        $totalOrders=array_sum($orders->whereNull('total_after_discount')->pluck('totalPrice')->toArray());



        $totalShipping = array_sum($records->pluck('shipping')->toArray());

        $inProgressOrders = $orders->where('status', '!=','pending')
            ->where('status', '!=','received')
            ->where('status', '!=','notRecevied')
            ->where('status', '!=','canceled')
            ->where('status', '!=','rejected')
            ->pluck('totalPrice')
            ->toArray();

        $rejectedOrders = $orders
        ->where('status', '!=','pending')
            ->where('status', '!=','storePending')
            ->where('status', '!=','inProgress')
            ->where('status', '!=','ready')
            ->where('status', '!=','delivered')
            ->where('status', '!=','received')
            ->where('status', '!=','notRecevied')
            ->where('status', '!=','canceled')
            ->pluck('totalPrice')
            ->toArray();

            $notReceivedOrders = $orders
        ->where('status', '!=','pending')
            ->where('status', '!=','storePending')
            ->where('status', '!=','inProgress')
            ->where('status', '!=','ready')
            ->where('status', '!=','delivered')
            ->where('status', '!=','received')
            ->where('status', '!=','rejected')
            ->where('status', '!=','canceled')
            ->pluck('totalPrice')
            ->toArray();


@endphp
<div class="table-responsive">

<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>مجموع المبيعات </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{array_sum($orders->pluck('totalPrice')->toArray())- array_sum($rejectedOrders) - $categories_price}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>مجموع  المبيعات تحتوي اكواد الخصم </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$afterDiscountOrders- array_sum($rejectedOrders) }}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>مجموع  المبيعات  لا تحتوي اكواد الخصم </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$totalOrders - array_sum($rejectedOrders) }}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>مجموع اكواد الخصم </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$totalDiscountOrders- $afterDiscountOrders}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>مجموع المبيعات المستلمة </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{array_sum($records->pluck('totalPrice')->toArray()) - $categories_price}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> مجموع الطلبات المعلقة </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{array_sum($orders->where('status','pending')->pluck('totalPrice')->toArray())}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> مجموع الطلبات قيد التنفيذ </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{array_sum($inProgressOrders) }}
            </h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>  مجموع الطلبات المرفوضة   </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{array_sum($rejectedOrders) }}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>  مجموع المرتجعات </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$totalRefunds }}</h1>
        </div>
    </div>
</div>


<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> مصاريف الشحن</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$totalShipping + $categories_price}}</h1>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> مبيعات الموردين </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$totalSupplierProfit - $categories_price}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> مرتجعات الموردين </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{$totalSupplierRefund}}</h1>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> صافي مبيعات الموردين  </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{ $AllSupplierNetProfit - $categories_price}}</h1>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5> نسبه  الموقع  </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{ $allwebsiteProfit}}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>   صافي ربح الموقع  </h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{ $allwebsiteProfit - ($totalDiscountOrders- $afterDiscountOrders)}}</h1>
        </div>
    </div>
</div>
</div>
<div class="clearfix"></div>
{{-- <div class="btn-group pull-right">

    <a class="btn btn-default text-green btn-sm" href="{{url(route('master-export', 'salesReport'))}}"><i class="fa fa-file-excel-o"></i></a>

</div> --}}
<br>

<div class="ibox-title">

    {!! Form::open([
           'method' => 'get'
           ]) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""> اسم العميل الأول </label>
                {!! Form::text('name',request()->input('name'),[
                    'class' => 'form-control',
                    'placeholder' => ' اسم العميل  '
                ]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for=""> اسم العميل الأخير </label>
                {!! Form::text('lname',request()->input('lname'),[
                    'class' => 'form-control',
                    'placeholder' => ' اسم العميل  '
                ]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for=""> (من)  البحث حسب تاريخ انشاء الطلب </label>
                {!! Form::date('fromDate',request()->input('fromDate'),[
                    'class' => 'form-control',
                    'placeholder' => ' من تاريخ '
                ]) !!}
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label for="">(الى)  البحث حسب تاريخ انشاء الطلب</label>
                {!! Form::date('toDate',request()->input('toDate'),[
                    'class' => 'form-control',
                    'placeholder' => 'الى تاريخ  المسوق'
                ]) !!}
            </div>
        </div>



        <div class="col-md-4">
            <div class="form-group">
                <label for=""></label>
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="ibox-content">
    <div class="table-responsive">
        @if (!empty($records) && count($records) > 0)
        <table class="table table-bordered">
            <thead>
                <th class="text-center">#</th>
                <th class="text-center">{{ __('تاريخ انشاء الطلب') }}</th>
                <th class="text-center">{{ __('كود الطلب') }}</th>
                <th class="text-center">{{ __('اسم المسوق') }}</th>
                <th class="text-center">{{ __('المحافظة') }}</th>
                <th class="text-center">{{ __('  السعر الكلي شامل الشحن') }}</th>
                <th class="text-center">{{ __('تكلفة المنتجات') }}</th>
                <th class="text-center">{{ __('قيمة الشحن') }}</th>
                <th class="text-center">{{ __(' كود الخصم') }}</th>
                <th class="text-center">{{ __(' قيمه الخصم') }}</th>
                <th class="text-center">{{ __(' السعر الكلي شامل الخصم والشحن') }}</th>
                <th class="text-center">{{ __('الاسترجاع') }}</th>

                <th class="text-center">{{ __('المنتجات المطلوبة') }}</th>
            </thead>
            <tbody>
                @php $count = 1; @endphp
                @foreach ($records as $record)
                @php
                    $rowspanNum = count(optional($record->products)->pluck('id')->toArray());
                    $productsPrice = 0;
                    $categoryPrice = 0;
                    foreach($record->products as $orderProduct){
                            $productsPrice += (optional($orderProduct)->price * $orderProduct->quantity);
                            $categoryPrice += $orderProduct->product->subCategory->price;
                        }
                        $refund =count($record->refunds()
                                ->where('type','refund')
                                ->get());
                @endphp
                <tr id="removable{{ $record->id }}">
                    <td class="text-center" rowspan="{{$rowspanNum}}">
                        {{ $count }}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ optional($record)->created_at->format('Y-m-d') }}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ $record->code }}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ optional($record->customer)->fname. ' ' . optional($record->customer)->lname}}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ optional($record->government)->name }}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ $record->totalPrice + $record->shipping }}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ $productsPrice - $categoryPrice}}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ $record->shipping + $categoryPrice  }}</td>

                    <td class="text-center" rowspan="{{$rowspanNum}}">{{optional($record->discountCode)->code ?? 'لا يوجد' }}</td>

                    @if($record->discountCode && $record->total_after_discount )
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{$record->totalPrice- $record->total_after_discount}}</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">{{ $record->total_after_discount + $record->shipping}}</td>

                    @else
                    <td class="text-center" rowspan="{{$rowspanNum}}">لايوجد</td>
                    <td class="text-center" rowspan="{{$rowspanNum}}">لايوجد</td>


                    @endif

                    @if($refund > 0)
                        <td class="text-center" rowspan="{{$rowspanNum}}"><a href="{{route('report.order.refunds',$record->id) }}" >{{ $refund }}</a></td>

                    @else
                        <td class="text-center" rowspan="{{$rowspanNum}}">{{ $refund }}</td>
                    @endif
                    @foreach ($record->products as $product )
                        <td class="text-center">

                                {{optional($product->product)->name }} || كمية : {{ $product->quantity }}

                        </td>
                    </tr>
                    @endforeach
                    @php $count++; @endphp

                @endforeach
            </tbody>
        </table>

        @else
        <div>
            <h3 class="text-info" style="text-align: center">{{ __(' لا توجد بيانات للعرض ') }}</h3>
        </div>
        @endif
    </div>
</div>
</div>
@endsection

