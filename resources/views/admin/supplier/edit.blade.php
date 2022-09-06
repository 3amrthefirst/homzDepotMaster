
@extends('admin.layouts.main',[
    'page_header'       => 'المنتجات',
    'page_description'  => ' تعديل   ',
    'link' => url('admin/supplier')
    ])
@section('content')
<!-- general form elements -->
<div class="box box-primary">
<!-- form start -->
{!! Form::model($supplier,[

'url'=>url('admin/suppliers/'.$supplier->id),
'id'=>'myForm',
'role'=>'form',
'method'=>'PUT',
'files' => true
])!!}

<div class="box-body">
<div class="clearfix"></div>
<br>
@include('admin.supplier.form')

<div class="box-footer">
<button type="submit" class="btn btn-primary">حفظ</button>
</div>

</div>
{!! Form::close()!!}

</div><!-- /.box -->

@endsection
