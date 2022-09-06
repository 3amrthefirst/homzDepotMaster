@extends('supplier.layouts.main',[
								'page_header'		=> 'طلبات اضافه كميه',
								'page_description'	=> 'عرض ',
								'link' => '#'
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="clearfix"></div>
        </div>
        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>الكود</th>
                        <th> الكميه  المضافه</th>
                        <th> حاله  الطلب</th>
                        <th> تعديل الطلب</th>
                        <th> حذف الطلب</th>

                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)

                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record->product)->name}} </td>
                                <td>{{optional($record->product)->code}} </td>
                                <td>{{$record->quantity}} </td>
                                <td>{{optional($record)->Add_Quantity_Status}} </td>
                                @if ($record->status == "pending")
                                <td><a data-toggle="modal" data-target="#editQuantity{{$record->id}}" type="submit" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                    @include('supplier.products.addQuantity.edit')
                                </td>
                                <td>
                                    <button
                                        id="{{$record->id}}"
                                        data-token="{{ csrf_token() }}"
                                        data-route="{{route('supplier.product.addQuantity.destroy', $record->id)}}"
                                        type="button"
                                        class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                @else
                                <td colspan="2">لا يمكن تعديل او حذف الطلبات المرفوضه او مقبوله</td>
                                @endif
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
