@extends('admin.layouts.main',[
'page_header' => 'الموردين',
'page_description' => 'عرض المنتجات ',
'link' => url('admin/suppliers')
])



@section('content')
    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="clearfix"></div>
            <br>
            <div class="row">
                {{-- <div class="col-md-3"> --}}
                    <div class="form-group">
                        <button class="btn btn-success texet-center " style="margin-bottom:10px" data-toggle="modal" data-target="#discountValue"
                            type="submit">
                            <i class="fa fa-check"></i> &nbsp;تفعيل جميع قيم الخصم
                        </button>
                        @include(
                            'admin.supplier.products.discount-value-active'
                        )
                    {{-- </div> --}}
                </div>
                {{-- <div class="col-md-3"> --}}
                    <div class="form-group ">
                        <button class="btn btn-warning texet-center" data-toggle="modal" style="margin-bottom:10px" data-target="#discountPercent"
                            type="submit">
                            <i class="fa fa-check"></i> &nbsp;تفعيل جميع نسب الخصم
                        </button>
                        @include(
                            'admin.supplier.products.discount-percent-active'
                        )
                    {{-- </div> --}}
                </div>
                <div class="form-group">
                    <button class="btn btn-success texet-center" data-toggle="modal" style="margin-bottom:10px" data-target="#discountValue"
                        type="submit">
                        <i class="fa fa-check"></i> &nbsp;تفعيل جميع قيم الخصم
                    </button>
                    @include(
                        'admin.supplier.products.discount-value-active'
                    )
                {{-- </div> --}}
            </div>
            {{-- <div class="col-md-3"> --}}
                <div class="form-group">
                    <button class="btn btn-warning texet-center" data-toggle="modal" style="margin-bottom:10px" data-target="#discountPercent"
                        type="submit">
                        <i class="fa fa-check"></i> &nbsp;تفعيل جميع نسب الخصم
                    </button>
                    @include(
                        'admin.supplier.products.discount-percent-active'
                    )
                {{-- </div> --}}
            </div>


            </div>


        </div>
        <br>
        <br>

        <div class="row">
            {!! Form::open([
    'method' => 'GET',
]) !!}
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('name', old('name'), [
    'class' => 'form-control',
    'placeholder' => 'الاسم',
]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('code', old('code'), [
    'class' => 'form-control',
    'placeholder' => 'الكود',
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
        <div class="ibox-title">
            <div class="clearfix"></div>
            <br>
            <div class="row">
                {{-- <div class="col-md-3"> --}}
                    <div class="form-group">
                        <button class="btn btn-success texet-center" data-toggle="modal" data-target="#discountValue"
                            type="submit">
                            <i class="fa fa-check"></i> &nbsp;تفعيل جميع قيم الخصم
                        </button>
                        @include(
                            'admin.supplier.products.discount-value-active'
                        )
                    {{-- </div> --}}
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button class="btn btn-warning texet-center" data-toggle="modal" data-target="#discountPercent"
                            type="submit">
                            <i class="fa fa-check"></i> &nbsp;تفعيل جميع نسب الخصم
                        </button>
                        @include(
                            'admin.supplier.products.discount-percent-active'
                        )
                    </div>
                </div>

            </div>


        </div>


        <div class="ibox-content">
            @if (!empty($records) && count($records) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">اسم المنتج</th>
                            <th class="text-center">الكود</th>
                            <th class="text-center">تاريخ اضافة المنتج</th>
                            <th class="text-center">تفعيل الظهور فالموقع</th>
                            <th class="text-center">عرض التفاصيل</th>
                        </thead>
                        <tbody>
                            @php $count = 1; @endphp
                            @foreach ($records as $record)
                                <tr id="removable{{ $record->id }}">
                                    <td>{{ $records->perPage() * ($records->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ optional($record)->name }}
                                        @if ($record->updated_at->format('d') == \Carbon\Carbon::now()->format('d'))
                                            <span class="badge badge-info">جديد</span>
                                        @endif
                                    </td>
                                    <td>{{ optional($record)->code }}</td>
                                    <td>{{ optional($record)->created_at }}</td>
                                    <td class="text-center">
                                        {!! \App\MyHelper\Helper::toggleBooleanView($record, url('admin/products/accepted/toggle-boolean/' . $record->id . '/is_active'), 'is_active') !!}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('accepted.show', $record->id) }}" class="btn btn-primary pd-5">
                                            عرض التفاصيل </a>
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
@stop

@section('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': false,

        })
    </script>
@stop
