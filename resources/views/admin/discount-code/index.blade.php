@extends('admin.layouts.main',[
								'page_header'		=> 'كوبونات الخصم',
								'page_description'	=> 'عرض ',
								'link' => url('admin/discount-code')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-left">
                @can('عرض وانشاء وتعديل وحذف كوبونات الخصم')
            <a href="{{url('admin/discount-code/create')}}" class="btn btn-primary">
                <i class="fa fa-plus"></i> إضافة جديد
            </a>
            @endcan
            </div>
            <div class="clearfix"></div>
        </div>



        <div class="row">
            {!! Form::open([
                'method' => 'GET'
            ]) !!}
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
                        <th>الكود</th>
                        <th>تاريخ الانشاء</th>
                        <th>قيمة الخصم</th>
                        <th> اقل سعر للطلب</th>
                        <th> اقصي قيمه للخصم</th>
                        <th>نوع الكود</th>
                        <th>عدد المستخدمين المتاح لهم</th>
                        @can('تفعيل كوبونات الخصم')
                        <th class="text-center">تفعيل الظهور فالموقع</th>
                        @endcan
                        @can('عرض وانشاء وتعديل وحذف كوبونات الخصم')
                        <th class="text-center">تعديل</th>
                        @endcan
                        <th>عدد مرات الاستخدام الى الان</th>
                        {{-- <th class="text-center">حذف</th> --}}
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record)->code}}</td>
                                <td>{{optional($record)->created_at}}</td>
                                <td>{{optional($record)->value}} </td>
                                <td>{{optional($record)->total_price}}</td>
                                <td>{{optional($record)->max_value}}</td>
                                <td>{{optional($record)->CodeStatus}}</td>
                                <td>{{optional($record)->maxUser}}</td>
                                @can('تفعيل كوبونات الخصم')
                                <td class="text-center">
                                    {!! \App\MyHelper\Helper::toggleBooleanView($record , url('admin/discount-code/toggle-boolean/'.$record->id.'/is_active'),'is_active') !!}
                                </td>
                                @endcan
                                @can('عرض وانشاء وتعديل وحذف كوبونات الخصم')
                                <td class="text-center"><a href="{{url('admin/discount-code/' . $record->id .'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                @endcan

                                 <td class="text-center">0</td>
                                {{-- <td class="text-center">
                                    <button
                                            id="{{$record->id}}"
                                            data-token="{{ csrf_token() }}"
                                            data-route="{{url('admin/discount-code/'.$record->id)}}"
                                            type="button"
                                            class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td> --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $records->appends(request()->all())->render() !!}
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
