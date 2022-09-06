
@extends('admin.layouts.main',[
                                'page_header'       => ' الانشطة الفرعية',
                                'page_description'  => ' تعديل   ',
                                'link' => url('admin/sub-categories')
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    {!! Form::model($model,[

                            'action'=>['Admin\SubCategoryController@update',$category->id,$model->id],
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}

    <div class="box-body">
        <div class="clearfix"></div>
        <br>
        @include('admin.sub_categories.form')

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection
