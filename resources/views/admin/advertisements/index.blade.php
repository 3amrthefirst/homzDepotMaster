@extends('admin.layouts.main',[
								'page_header'		=> 'الاعلانات',
								'page_description'	=> 'عرض ',
								'link' => url('admin/advertisements')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-left">
                @can('تعديل اﻹعدادات')

                <a href="{{url('admin/advertisements/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة جديد
                </a>
                @endcan
            </div>
            <div class="clearfix"></div>
        </div>



{{--        --}}
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
                        <th>الاعلان</th>
                        {{-- <th>الموقع</th> --}}
                        <th class="text-center"> تفعيل الظهور في الموقع</th>
                        <th class="text-center">تعديل</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record)->name}}</td>
                                <td>
                                    @forelse($record->attachmentRelation as $img)

                                        <img alt="image" class="img-fluid img-responsive"

                                        src="{{asset($img->path)}}"  style=" border-radius: 50%; width: 50px ; height: 50px;">
                                    @empty

                                        <span>لا يوجد صورة للاعلان</span>

                                    @endforelse

                                </td>
                                {{-- <td>{{ $record->TypePostion }}</td> --}}
                                <td class="text-center">
                                    {!! \App\MyHelper\Helper::toggleBooleanView($record , url('admin/advertisements/toggle-boolean/'.$record->id.'/is_active'),'is_active') !!}
                                </td>
                                @can('تعديل اﻹعدادات')
                                <td class="text-center"><a href="{{url('admin/advertisements/' . $record->id .'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                <td class="text-center">
                                    <button
                                            id="{{$record->id}}"
                                            data-token="{{ csrf_token() }}"
                                            data-route="{{url('admin/advertisements/'.$record->id)}}"
                                            type="button"
                                            class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                @endcan

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
