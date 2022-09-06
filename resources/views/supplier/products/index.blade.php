@extends('supplier.layouts.main',[
								'page_header'		=> 'المنتجات',
								'page_description'	=> 'عرض ',
								'link' => '#'
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-right">


                <a href="{{route('supplier.products.create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة جديد
                </a>

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

        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>الكود</th>
                        <th> اسم اللون</th>
                        <th>السعر </th>
                        <th> الكميه </th>
                        <th> حاله  المنتج</th>

                        <th> تعديل المنتج</th>
                        <th> حذف المنتج</th>

                        <th> عرض التفاصيل</th>


                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)

                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{$record->name}} 
                                    @if ($record->updated_at->format('d') == \Carbon\Carbon::now()->format('d'))
                                    <span class="badge badge-info">جديد</span>
                                    @endif </td>
                                <td>{{$record->code}} </td>
                                <td>{{$record->colorName}} </td>
                                <td>{{$record->price}} </td>
                                <td>{{$record->original_quantity}} </td>
                                <td>{{$record->Product_status}} </td>
                                @if ($record->status == "pending")
                                <td><a href="{{route('supplier.products.edit',$record->id)}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <button
                                        id="{{$record->id}}"
                                        data-token="{{ csrf_token() }}"
                                        data-route="{{route('supplier.products.destroy', $record->id)}}"
                                        type="button"
                                        class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                @else
                                <td colspan="2">لا يمكن تعديل او حذف المنتجات المرفوضه او مقبوله</td>
                                @endif
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
