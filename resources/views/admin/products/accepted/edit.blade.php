
@extends('admin.layouts.main',[
                                'page_header'       => 'المنتجات',
                                'page_description'  => ' تعديل   ',
                                'link' => url('admin/products/accepted')
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    {!! Form::model($model,[
                            'url'=>route('accepted.update',$model->id),
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}

    <div class="box-body">
        <div class="clearfix"></div>
        <br>
        @include('admin.products.accepted.form')

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection
