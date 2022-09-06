@extends('admin.layouts.main',[
                                'page_header'       => 'الاعدادات',
                                'page_description'  => 'اعدادات التطبيق',
                                 'link' => url('admin/settings')
                                ])
@section('content')
    @inject('settings_categories' , App\Models\SettingsCategory)

    <!-- form start -->
    {!! Form::open([
                            'url'=>url('admin/settings/'),
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'post',
                            'files' => true
                            ])!!}



    <br>
    <button type="submit" class="btn btn-primary">حفظ الكل</button>
    <br><br>

    @if($settings_categories->count())

        @foreach($settings_categories->orderBy('level')->get() as $category)

            @if($category->settings()->count())
                <div class="col-lg-12">
                    <div class="ibox border-bottom">
                        <div class="ibox-title">
                            <h5 style="color: #3c8dbc ;font-weight: bold">{{$category->name}}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>

                            </div>
                        </div>
                        <div class="ibox-content" style="display: none;">

                            @foreach($category->settings()->orderBy('level')->get() as $setting)

                                {!!  \App\MyHelper\SettingField::setInput($setting)!!}
                                <div class="files-data">
                                    @if($setting->data_type == 'fileWithPreview')
                                        <img src="{{asset(optional($setting->photo)->path)}}" alt=""
                                             style="height: 70px;margin: 15px;">
                                    @elseif($setting->data_type == 'mulifileWithPreview')
                                        @foreach($setting->photos as $photo)
                                            <img src="{{$photo->path}}" alt=""
                                                 style="height: 70px;margin: 15px;">
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    @endif

    {!! Form::close()!!}


@endsection
