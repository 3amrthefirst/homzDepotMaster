@extends('supplier.layouts.main',[
								'page_header'		=> 'المحفظه',
								'page_description'	=> 'عرض ',
								'link' => '#'
								])
@section('content')
<div class="ibox">
    </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <h3 class="">المحفظه</h3>
                <table class="table m-b-xs">
                    <tbody>
                        <tr>
                            <td>
                                {{__('نسبه الموقع')}} : <strong>{{$record->adminProfit}}%</strong>
                            </td>
                            <td>
                                {{__(' التحويلات')}} : <strong>{{$record->withdraw}}</strong>
                            </td>
                        </tr>
                    <tr>
                        <td>
                            {{__(' الأرباح المحققه')}} : <strong>{{$record->allProfit}}</strong>
                        </td>
                        <td>
                            {{__('الارباح المتاحه')}} : <strong>{{$record->availableProfit}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('جميع الأسترجاعات')}} : <strong>{{$record->allRefundProfit}}</strong>
                        </td>
                    <td>
                        {{__(' الاسترجاع المتاحه')}} : <strong>{{$record->refundProfit}}</strong>
                    </td>
                    
                </tr>
                    </tbody>
            </table>
            <hr>
            @if(!empty($payments) && count($payments)>0)
            <div class="table-responsive">
                
                <table class="table table-bordered">
                    <thead>
                    <th>#</th>
                    <th>تاريخ التحويل</th>
                    <th>المبلغ الكلي</th>
                    <th>(مبلغ) نسبة الموقع</th>
                    <th>الاسترجاعات</th>
                    <th>المبلغ المحول</th>

                    </thead>
                    <tbody>
                    @php $count = 1; @endphp
                    @foreach($payments as $payment)

                        <tr id="removable{{$payment->id}}">
                            <td>{{($payments->perPage() * ($payments->currentPage() - 1)) + $loop->iteration}}</td>
                            <td>{{$payment->created_at->format('d/m/y')}} 
                             <td>{{$payment->allAmount}} </td>
                            <td>{{$payment->websiteProfit}} </td>
                             <td>{{$payment->refund}} </td>
                             <td>{{$payment->amount}} </td>

                        </tr>
                        @php $count ++; @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $payments->render() !!}
        @else
            <div>
                <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
            </div>
        @endif
                   
        </div>
        </div>
</div>
                    





@stop


