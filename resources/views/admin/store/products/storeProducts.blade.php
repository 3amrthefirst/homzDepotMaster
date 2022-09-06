@extends('admin.layouts.main',[
								'page_header'		=> 'المخزن',
								'page_description'	=> 'عرض النتجات ',
								'link' => url('admin/stores')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="clearfix"></div>

        </div>
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
                <button class="btn btn-primary btn-block" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>




        <div class="ibox-content">
            @if(!empty($products) && count($products)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th >وصف المنتج</th>
                            <th >عدد القطع</th>
                            <th class="text-center">عرض تفاصيل المنتج</th>
                        </thead>
                        <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($products as $product)
                            <tr id="removable{{$product->id}}">
                                <td>{{$count++}}</td>
                                <td>{{$product->name}}</td>
                                <td>{!!$product->description !!}</td>
                                <td>{{optional($product)->availableQuantity ?? 'null'}}</td>
                                <td class="text-center">
                                    <a href="{{route('store.product.show',$product->id )}}" class="btn btn-primary pd-5">  عرض التفاصيل </a>
                                </td>
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
