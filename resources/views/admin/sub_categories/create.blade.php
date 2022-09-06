@extends('admin.layouts.main',[
                                'page_header'       => 'التصنيفات الفرعية',
                                'page_description'  => '  اضافة  ',
                                'link' => url('admin/sub-categories')
                                ])
@section('content')


    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
        {!! Form::model($model,[
                                'action'=>['Admin\SubCategoryController@store',$category->id],
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'POST',
                                'files' => true
                                ])!!}

        <div class="box-body">

            @include('admin.sub_categories.form')

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>

        </div>
        {!! Form::close()!!}

    </div><!-- /.box -->

@endsection
