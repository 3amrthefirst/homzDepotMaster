@extends('website.auth.main')
@section('title','تسجيل الدخول')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-5 mx-auto">
        <div>
            <div class="myform form p-5" >
                 <div class="logo">
                        <div class="col-lg-12 text-center">
                           <a href="{{route('home')}}" class="btn">
                                <img src="{{asset('website/img/Homzdepot-Logo.png')}}" alt="homzdepot" class="img-fluid w-75">
                           </a>
                        </div>
                     <div class="col-md-12 text-center">
                        <h5>مرحبا بكم في هومزديبو</h5>
                     </div>
                </div>
                @error('error')
                <div class="alert alert-danger" role="alert">
                   <strong>{{ $message }}</strong>
                </div>
            @enderror

                <form action="{{route('customer.login')}}" method="post" >
                    @csrf
                       <div class="form-group my-2">
                            <label for="exampleInputEmail1">البريد الإلكتروني </label>
                            <input  type="email"  name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="إدخل بريدك الإلكتروني">
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="text-danger"> {{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                       <div class="form-group my-2">
                          <label for="exampleInputEmail1">كلمه المرور</label>
                          <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="إدخل كلمه المرور ">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong class="text-danger"> {{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                       <div class="form-group my-2 text-center">
                        <button class="btn btn-secondary" type="submit">تسجيل الدخول</button>
                       </div>
                           <div class="form-group my-2 mt-5 text-center">
    <a href="{{url('/login/facebook')}}" class="btn btn-primary" style="width: 100%;" type="submit">   تسجيل الدخول بواسطه   <i class="fab fa-facebook"></i></a>
   </div>
   <div class="form-group my-2 mb-5 text-center">
    <a href="{{url('/login/google')}}" class="btn btn-danger" style="width: 100%;" type="submit">  تسجيل الدخول بواسطه <i class="fab fa-google"></i></a>
   </div>
                       <div class="form-group my-2 ">
                        <input class="form-check-input" dir="rtl" type="checkbox" value="" id="invalidCheck" >
                        <label class="form-check-label" for="invalidCheck"> تذكرني </label>
                       </div>
        
                       <a class="footer-link my-2" href="{{route('reset-password')}}">هل نسيت كلمه المرور ؟</a>
                       <p class="my-2">لا تمتلك حسابا حتي الآن ؟ <a href="{{route('viewSignup')}}" style="color: #f3b21a !important;" class="footer-link">سجل الآن</a></p>
                    </form>

            </div>
        </div>

 @endsection
