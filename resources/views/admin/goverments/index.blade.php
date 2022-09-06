@extends('admin.layouts.main',[
								'page_header'		=> 'المحافظات',
								'page_description'	=> 'عرض ',
								'link' => url('admin/goverments')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-left">
                @can('عرض وانشاء وتعديل وحذف محافظات')
                <a href="{{url('admin/goverments/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة جديد
                </a>
                @endcan 
            </div>
            <div class="clearfix"></div>

            </div>

{{--
            <div class="btn-group pull-right">
                    <a class="btn btn-default text-green btn-sm" href="{{url(route('master-export', 'governorate'))}}"><i class="fa fa-file-excel-o"></i></a>
            </div> --}}

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
                    {!! Form::number('price',old('price'),[
                        'class' => 'form-control',
                        'placeholder' => 'السعر'
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
                        <th>الاسم</th>
                        <th>السعر </th>
                        <th>مدة التوصيل </th>
                        @can('عرض وانشاء وتعديل وحذف محافظات')
                        <th class="text-center">تعديل</th>
                        <th class="text-center">حذف</th>
                        @endcan
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record)->name}}</td>
                                <td>{{optional($record)->price}}</td>
                                <td>{{optional($record)->time}}</td>
                                @can('عرض وانشاء وتعديل وحذف محافظات')
                                <td class="text-center"><a href="{{url('admin/goverments/' . $record->id .'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                <td class="text-center">
                                    <button
                                            id="{{$record->id}}"
                                            data-token="{{ csrf_token() }}"
                                            data-route="{{url('admin/goverments/'.$record->id)}}"
                                            type="button"
                                            class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                @endcan

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
