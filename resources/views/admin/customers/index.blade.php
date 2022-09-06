@extends('admin.layouts.main',[
								'page_header'		=> 'العملاء',
								'page_description'	=> 'عرض ',
								'link' => url('admin/customers')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">

            <div class="clearfix"></div>
        </div>
        <div class="row">
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
                    {!! Form::text('phone',old('phone'),[
                        'class' => 'form-control',
                        'placeholder' => 'رقم الهاتف'
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
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم العميل</th>
                        <th> الحساب الالكتروني</th>
                        <th>الهاتف المحمول </th>
                        <th class="text-center">  الطلبات</th>




                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)

                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{$record->fname}} {{ $record->lname }}</td>
                                <td>{{$record->email}}</td>
                                <td>{{$record->phone}}</td>
                               
                                <td class="text-center">
                                    <a href="{{route('customer.orders' , $record->id )}}"class="btn btn-xs btn-success"><i class="fa fa-eye"></i> </a>
                                </td>

                               

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
