@extends('website.auth.main')
@section('title',' نسيت كلمه المرور')
@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-5 mx-auto">
        <div>
            <div class="myform form p-5" >
                 <div class="logo">
                        <div class="col-lg-12 text-center">
                            <img src="{{asset('website/img/Homzdepot-Logo.png')}}" alt="homzdepot" class="img-fluid w-75">
                        </div>
                     <div class="col-md-12 text-center">
                        <h5 >  تغيير كلمه المرور</h5>
                    </div>
                </div>
                <div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            <form action="{{url(route('MarkPass'))}}" method="post">
                @method('put')
                @csrf
                <div class="form-group my-2">
                    <label for="exampleInputEmail1"> كلمه المرور </label>
                    <input type="password" name="password" placeholder="ادخل كلمه المرور " class="form-control" >

                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong style="color: #f3b21a"> {{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group my-2">
                    <label for="exampleInputEmail1">  تاكيد كلمه المرور </label>
                    <input type="password" name="password_confirmation" placeholder="ادخل كلمه المرور " class="form-control" >

                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong style="color: #f3b21a"> {{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
               

                <div class="form-group my-2 text-center">
                    <button class="btn btn-secondary" type="submit"> تاكيد</button>
                   </div>
            </form>
        </div>
    </div>

@endsection








