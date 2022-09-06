@extends('admin.layouts.main',[
								'page_header'		=> ' الطلبات قيد التوصيل',
								'page_description'	=> ' عرض ',
								'link' => url('admin/orders')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="ibox-title">

                {!! Form::open([
                       'method' => 'get'
                       ]) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::text('name',request()->input('name'),[
                                'class' => 'form-control',
                                'placeholder' => 'اسم العميل'
                            ]) !!}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::text('phone',request()->input('phone'),[
                                'class' => 'form-control',
                                'placeholder' => 'رقم الهاتف'
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::text('code',request()->input('code'),[
                                'class' => 'form-control',
                                'placeholder' => ' كود الطلب'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>id</th>
                        <th>اسم العميل</th>
                        <th> رقم الهاتف</th>
                        <th> رقم الهاتف الثاني</th>
                        <th>كود الطلب</th>
                        <th>العنوان</th>
                        <th>تاريخ الطلب</th>
                        <th class="text-center">عرض التفاصيل</th>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{optional($record)->id}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{optional($record)->phone}}</td>
                                <td>{{optional($record)->phone2 ?? 'لا يوجد'}}</td>
                                <td>{{optional($record)->code}}</td>
                                <td>{{optional($record->government)->name}} || {{optional($record)->address}} </td>
                                <td>{{optional($record)->created_at}}</td>

                                <td class="text-center">
                                    <a href="{{route('orders.delivering.show',$record->id)}}"class="btn btn-primary pd-5"><i class="fa fa-eye"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $records->appends(request()->all())->render() !!}
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
