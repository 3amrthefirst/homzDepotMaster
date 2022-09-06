@extends('admin.layouts.main',[
								'page_header'		=> ' المعاملات المالية المطلوبة',
								'page_description'	=> 'عرض ',
								'link' => '#'
								])
@section('content')
<div class="ibox">
@inject('suppliers',App\Models\Supplier)

@php
$suppliers = $suppliers->pluck('name','id')->toArray();


@endphp

    </div>
    <div class="row">
        {!! Form::open([
            'method' => 'GET'
        ]) !!}
        <div class="col-md-3">
            <div class="form-group">
                <label for="">&nbsp;</label>
                {!! Form::select('supplier',$suppliers
                ,'الموردين ',[
                    'class' => 'form-control',
                    'placeholder' => 'اسم المورد '


                ]) !!}
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="">&nbsp;</label>
                <button class="btn btn-flat btn-block btn-primary">بحث</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <br>

        </div>
        <div class="ibox-content">


            @if(!empty($records) && count($records)>0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <th>#</th>
                    <th>اسم المورد</th>
                    <th>الأرباح المحققه</th>
                    <th>الأرباح المتاحه</th>
                    <th>  الأسترجاعات المحققه</th>
                    <th>  الأسترجاعات المتاحه</th>
                    <th> كل التحويلات</th>
                    @can('تسجيل تحويل')
                    <th>تحويل</th>
                    @endcan
                    <th>كل التحويلات</th>




                </thead>
                    <tbody>
                    @php $count = 1; @endphp
                    @foreach($records as $record)

                        <tr id="removable{{$record->id}}">
                            <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                            <td>{{$record->name}}
                            <td>{{$record->allProfit}} </td>
                            <td>{{$record->availableProfit}} </td>
                            <td>{{$record->allRefundProfit}} </td>
                            <td>{{$record->refundProfit}}</td>
                            <td>{{$record->withdraw}}</td>
                            @can('تسجيل تحويل')
                            @if($record->availableProfit == 0)
                            <td>
                                <a disabled class="btn btn-primary s">
                                    <i class="fa fa-wallet"></i>  اجراء تحويل
                                </a>
                             </td>
                             @else
                             <td>
                                <a  class="btn btn-primary s" data-toggle="modal" data-target="#transfer{{$record->id}}" type="submit">
                                    <i class="fa fa-wallet"></i>  اجراء تحويل
                                </a>
                                @include('admin.payment.transfer')
                             </td>
                             @endif
                             @endcan
                            <td>
                                <a href="{{route('payment.show' , $record->id )}}"class="btn btn-success pd-5">تفاصيل التحويلات </a>
                            </td>



                        </tr>
                        @php $count ++; @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $records->render() !!}
        @else
            <div>
                <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
            </div>
        @endif

        </div>
        </div>
</div>






@stop


