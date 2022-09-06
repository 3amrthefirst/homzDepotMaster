@extends('admin.layouts.main',[
								'page_header'		=> 'المخزن',
								'page_description'	=> 'عرض ',
								'link' => url('admin/stores')
								])
@section('content')


    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-right">
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                         <th class="text-center">المنتجات </th>
                         <th class="text-center">اضافه الكميات المعلقة</th>
                         <th class="text-center">سحب الكميات المعلقة</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><a href="{{url('admin/store/products')}}"><i class="fa fa-cart-arrow-down btn btn-primary btn-xs"></i></a></td>
                                <td class="text-center"><a href="{{url('admin/store/pending-add-quantity')}}"><i class="fa fa-shopping-basket btn btn-warning btn-xs"></i></a></td>
                                <td class="text-center"><a href="{{url('admin/store/pending-pull-quantity')}}"><i class="fa fa-shopping-basket btn btn-danger btn-xs"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

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
