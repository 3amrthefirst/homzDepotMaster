@extends('admin.layouts.main',[
								'page_header'		=> 'التصنيفات الفرعية',
								'page_description'	=> 'عرض ',
								'link' => url('admin/sub-categories')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-left">
                <a href="{{url(route('categories.sub-categories.create',$cat_id))}}" class="btn btn-primary">
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
                    {!! Form::text('price',old('price'),[
                        'class' => 'form-control',
                        'placeholder' => 'السعر'
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
            @if(!empty($records->subCategories) && count($records->subCategories)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>السعر</th>
                        <th>التصنيف الرئيسي</th>
                        <th class="text-center">تعديل</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records->subCategories as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{$count}}</td>
                                <td>{{optional($record)->name}}</td>
                                <td>{{optional($record)->price}}</td>
                                <td>
                                    {{optional($record->parent)->name}}
                                </td>
                                <td class="text-center"><a
                                        href="{{url(route('categories.sub-categories.edit',[$cat_id,$record->id]))}}"
                                        class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <button
                                        id="{{$record->id}}"
                                        data-token="{{ csrf_token() }}"
                                        data-route="{{URL::route('categories.sub-categories.destroy',[$cat_id,$record->id])}}"
                                        type="button"
                                        class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
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
