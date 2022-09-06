@extends('admin.layouts.main',[
								'page_header'		=> 'تفاصيل التحويلات',
								'page_description'	=> 'عرض ',
								'link' => '#'
								])
@section('content')
<div class="ibox">
    </div>
        <div class="ibox-content">
            <div class="table-responsive">

            </table>
            <hr>
            @if(!empty($payments) && count($payments)>0)
            <div class="table-responsive">
                <div class="ibox-title">
                    التحويلات
                    <div class="clearfix"></div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <th>#</th>
                    <th>اسم المورد</th>
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
                            <td>{{$payment->supplier->name}}</td>
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
                <h3 class="text-info" style="text-align: center"> لا توجد تحويلات للعرض </h3>
            </div>
        @endif

        </div>
        </div>
</div>






@stop


