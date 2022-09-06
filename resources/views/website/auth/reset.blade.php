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
                        <h5>استعاده كلمه المرور</h5>
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


            <form action="{{url(route('checkEmail'))}}" method="post">
                @csrf
                <div class="form-group my-2">
                    <label for="exampleInputEmail1">البريد الإلكتروني </label>
                    <input  type="email"  name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="إدخل بريدك الإلكتروني">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color: #f3b21a"> {{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
               
                <a class="footer-link my-2" href="{{route('viewLogin')}}">العودة لتسجيل الدخول؟</a>

                <div class="form-group my-2 text-center">
                    <button class="btn btn-secondary" type="submit"> تاكيد</button>
                   </div>

            </form>
        </div>
    </div>

@endsection
