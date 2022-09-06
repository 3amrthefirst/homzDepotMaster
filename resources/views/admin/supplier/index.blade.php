@extends('admin.layouts.main',[
								'page_header'		=> 'الموردين',
								'page_description'	=> 'عرض ',
								'link' => url('admin/suppliers')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-left">
                @can('اضافة مورد')

                <a href="{{url('admin/suppliers/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة جديد
                </a>
                @endcan


            </div>
            {{-- <div class="btn-group pull-right">

                <a class="btn btn-default text-green btn-sm" href="{{url(route('master-export', 'suppliers'))}}"><i class="fa fa-file-excel-o"></i></a>

            </div> --}}

            <div class="clearfix"></div>
        </div>
        <div class="row">
            {!! Form::open([
                'method' => 'GET'
            ]) !!}
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('name',old('name'),[
                        'class' => 'form-control',
                        'placeholder' => 'الاسم'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('code',old('code'),[
                        'class' => 'form-control',
                        'placeholder' => 'الكود'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('phone',old('phone'),[
                        'class' => 'form-control',
                        'placeholder' => 'رقم الهاتف'
                    ]) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المورد</th>
                        <th>كود المورد</th>
                        <th> الحساب الالكتروني</th>
                        <th>الهاتف المحمول </th>
                        <th>نسبة الموقع</th>
                        <th>تفعيل المورد</th>
                        @can('تعديل مورد')
                        <td class="text-center">تعديل</td>
                        @endcan
                        <th class="text-center"> التحويلات المالية</th>
                        {{--<th class="text-center">المبيعات</th> --}}
                        <th class="text-center">منتجات المورد</th>




                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)

                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->code}}</td>
                                <td>{{$record->email}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->adminProfit}}</td>
                                <td class="text-center">
                                    {!! \App\MyHelper\Helper::toggleBooleanView($record , route('supplier.is_active',[$record->id,"is_active"]),'is_active')!!}
                                </td>
                                @can('تعديل مورد')
                                <td class="text-center"><a href="{{url('admin/suppliers/'.$record->id.'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                @endcan
                                <td class="text-center">
                                    <a href="{{route('payment.show' , $record->id )}}"class="btn btn-xs btn-warning"><i class="fa fa-wallet"></i> </a>
                                </td>

                                <td class="text-center"><a href="{{url('admin/suppliers/products/'.$record->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-desktop"></i></a></td>

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
@stop

@section('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel':false,

        })
    </script>
@stop
