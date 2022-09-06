@extends('admin.layouts.main',[
								'page_header'		=> 'الطلبات',
								'page_description'	=> 'عرض ',
								'link' => url('admin/customers')
								])
@section('content')

    <div class="ibox box-primary">
            <div class="clearfix"></div>
        </div>
        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>تاريخ الطلب</th>
                        <th>المحافظة</th>
                        <th>العنوان</th>
                        <th>السعر الكلي</th>
                        <th>سعر الشحن</th>
                        <th>الحالة</th>
                        <th>الكود</th>
                        <th>رقم الهاتف</th>

                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)

                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{ $record->created_at->format('Y-m-d') }}</td>
                                <td>{{ $record->government->name }}</td>
                                <td>{{ $record->address }}</td>
                                <td>{{ $record->totalPrice }}</td>
                                <td>{{ $record->shipping }}</td>
                                <td>{{ $record->OrderStatus }}</td>
                                <td>{{ $record->code }}</td>
                                <td>{{ $record->phone }} \ {{$record->phone2 ?? '' }}</td>
                               
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
