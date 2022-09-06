@extends('supplier.layouts.main',[
								'page_header'		=> 'منتجات اوشكت على النفاذ',
								'page_description'	=> 'عرض ',
								'link' => url('supplier/products')
								])
@section('content')
<div class="alert alert-success">
    يوجد هنا المنتجات التي كمياتها اقل من 5 قطع
</div>
    <div class="ibox box-primary">
        <div class="ibox-title">
            {{-- <div class="btn-group pull-right">
                <a class="btn btn-default text-green btn-sm" href="{{url(route('master-export', 'products'))}}"><i class="fa fa-file-excel-o"></i></a>
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
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-flat btn-block btn-primary">بحث</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <br>
        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th >#</th>
                        <th >اسم المنتج</th>
                        <th>الكود</th>
                        <th> اسم اللون</th>
                        <th> عرض التفاصيل</th>

                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record)->name}}
                                    @if ($record->updated_at->format('d') == \Carbon\Carbon::now()->format('d'))
                                    <span class="badge badge-info">جديد</span>
                                    @endif</td>
                                <td>{{optional($record)->code}}</td>
                                <td>{{$record->colorName}} </td>
                                <td>
                                    <a href="{{route('supplier.products.show' , $record->id )}}"class="btn btn-primary pd-5"> عرض التفاصيل </a>
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
            'showImageNumberLabel':false,

        })


    </script>
@stop
