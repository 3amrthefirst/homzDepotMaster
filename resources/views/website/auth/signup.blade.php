@extends('website.auth.main')
@section('title','انشاء حساب جديد')
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
							<h5>مرحبا بكم في هومزديبو</h5>
						 </div>
					</div>

                   <form action="{{route('signup')}}" method="post" >
                    @csrf
                            <div class="form-group my-2">
                                <label for="exampleInputEmail1"> الاسم الأول</label>
                                <input type="text"  name="fname"  class="form-control" aria-describedby="emailHelp" placeholder="إدخل الاسم الأول ">
                                @if ($errors->has('fname'))
                                <span class="help-block">
                                                    <strong class="text-danger"> {{ $errors->first('fname') }}</strong>
                                                </span>
                            @endif
                            </div>
                            <div class="form-group my-2">
                                <label for="exampleInputEmail1"> الاسم الأخير</label>
                                <input type="text"  name="lname" class="form-control" aria-describedby="emailHelp" placeholder="إدخل الاسم الأخير ">
                                @if ($errors->has('lname'))
                                <span class="help-block">
                                                    <strong class="text-danger"> {{ $errors->first('lname') }}</strong>
                                                </span>
                            @endif
                            </div>
                           <div class="form-group my-2">
                              <label for="exampleInputEmail1">البريد الإلكتروني </label>
                              <input  type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="إدخل بريدك الإلكتروني">
                              @if ($errors->has('email'))
                              <span class="help-block">
                                                  <strong class="text-danger"> {{ $errors->first('email') }}</strong>
                                              </span>
                          @endif
                           </div>
                           <div class="form-group my-2">
                            <label for="exampleInputEmail1">رقم التليفون</label>
                            <input type="text"  name="phone" class="form-control" aria-describedby="emailHelp" placeholder="إدخل رقم التليفون  ">
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                                <strong class="text-danger"> {{ $errors->first('phone') }}</strong>
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
                           <div class="form-group my-2">
                              <label for="exampleInputEmail1">إعاده ادخال كلمه المرور</label>
                              <input type="password" name="password_confirmation" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="إعاده إدخال كلمه المرور ">
                           </div>
                           <p class="my-2"> بتسجيلك حساب على منصة هومزديبو فأنت توافق على <a href="{{route('terms')}}" style="color: #f3b21a !important;" class="footer-link">الشروط والاحكام</a> و <a href="{{route('policy')}}" style="color: #f3b21a !important;" class="footer-link">سياسه الاسترجاع.</a></p>

                           <div class="form-group my-2 text-center">
                            <button class="btn btn-secondary" type="submit">تسجيل الحساب</button>
                           </div>
         
    <div class="form-group my-2 mt-5 text-center">
    <a href="{{url('/login/facebook')}}" class="btn btn-primary" style="width: 100%;" type="submit">   التسجيل  بواسطه   <i class="fab fa-facebook"></i></a>
   </div>
   <div class="form-group my-2 mb-5 text-center">
    <a href="{{url('/login/google')}}" class="btn btn-danger" style="width: 100%;" type="submit">  التسجيل  بواسطه <i class="fab fa-google"></i></a>
   </div>
                        </form>

				</div>
			</div>
 @endsection
