@extends('supplier.layouts.main',[
                                'page_header'       => 'المنتجات',
                                'page_description'  => '  منتج  جديد ',
                                'link' => url('supplier/add_product')
                                ])
@section('content')


    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
        {!! Form::model($model,[
                                'action'=>'Supplier\ProductController@store',
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'POST',
                                'files' => true
                                ])!!}

        <div class="box-body">

            @include('supplier.products.form')

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>

        </div>
        {!! Form::close()!!}

    </div><!-- /.box -->

@endsection
<script>
  $("#button1").click(function(){
      $("#bonus").style.display="block"
      };
</script>
