@extends('supplier.layouts.main',[
								'page_header'		=> 'معلومات الحساب',
								'page_description'	=> 'تعديل ',
								'link' => '#'
								])
@section('content')

<div class="box box-primary">
        <!-- form start -->
       <form action="{{route('supplier.updateAccount')}}" method="POST" enctype="multipart/form-data">
           @csrf
           @method('PUT')
            <div class="box-body">

                <div class="div">
                    <div class="row">
                        <div class="col-md-6">
                            <label>الاسم</label>
                            <input class="form-control" type="text" name="name" placeholder="الاسم" value="{{$record->name}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="col-md-6">
                            <label>رقم الهاتف</label>
                            <input class="form-control" type="text" name="phone" placeholder="رقم الهاتف" value="{{$record->phone}}">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="div">
                    <div class="row">
                        <div class="col-md-12">
                        <label> البريد الالكتروني</label>
                            <input class="form-control" type="email" name="email" placeholder="البريد الالكتروني" value="{{$record->email}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                        </div>
                    </div>
                </div>
                <br>

                <div class="div">
                    <div class="row">
                        <div class="col-md-6">
                            <label>كلمة السر الجديده</label>
                            <input class="form-control" type="password" name="password" placeholder="كلمة السر الجديده" >
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="col-md-6">
                            <label>تأكيد كلمة السر الجديده</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="تأكيد كلمة السر الجديده" >
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="div">
                    <div class="row">
                        <div class="col-md-12">
                        <label> كلمة السر القديمة</label>
                            <input class="form-control" type="password" name="oldpassword" placeholder="كلمة السر القديمة" >
                            @if ($errors->has('oldpassword'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('oldpassword') }}</strong>
                                </span>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>

            </div>
        </form>
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
