<div class="container">
    <div class="row">

<div class="modal fade p-4" id="profileEdit" tabindex="-1" role="dialog"
aria-labelledby="profileLabel" aria-hidden="true">
 <div class="modal-dialog p-4">
   <div class="modal-content p-4">

                         <div class="col-md-12 text-center">
                            <h5>تعديل المعلومات الشخصيه</h5>
                         </div>


                   <form action="{{route('profile.update')}}" method="post" >
                    @method('put')
                    @csrf
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1"> الاسم الأول</label>
                        <input type="text"  name="fname"  class="form-control" aria-describedby="emailHelp" value="{{auth()->user()->fname}}" placeholder="إدخل الاسم الأول ">
                        @if ($errors->has('fname'))
                        <span class="help-block">
                                            <strong style="color: #f3b21a"> {{ $errors->first('fname') }}</strong>
                                        </span>
                         @endif
                    </div>
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1"> الاسم الأخير</label>
                        <input type="text"  name="lname" class="form-control" aria-describedby="emailHelp" value="{{auth()->user()->lname}}" placeholder="إدخل الاسم الأخير ">
                        @if ($errors->has('lname'))
                        <span class="help-block">
                                            <strong style="color: #f3b21a"> {{ $errors->first('lname') }}</strong>
                                        </span>
                          @endif
                    </div>
                     <div class="form-group my-2">
                      <label for="exampleInputEmail1">البريد الإلكتروني </label>
                      <input  type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" value="{{auth()->user()->email}}" placeholder="إدخل بريدك الإلكتروني">
                      @if ($errors->has('email'))
                      <span class="help-block">
                                          <strong style="color: #f3b21a"> {{ $errors->first('email') }}</strong>
                                      </span>
                        @endif
                     </div>
                     <div class="form-group my-2">
                        <label for="exampleInputEmail1">الهاتف المحمول</label>
                        <input  type="phone" name="phone"  class="form-control" id="phone" aria-describedby="emailHelp" value="{{auth()->user()->phone}}" placeholder="إدخل رقم الهاتف ">
                        @if ($errors->has('phone'))
                        <span class="help-block">
                                            <strong style="color: #f3b21a"> {{ $errors->first('phone') }}</strong>
                                        </span>
                          @endif
                       </div>
                      @if(auth()->user()->password)

                     <div class="form-group my-2">
                        <label for="exampleInputEmail1"> كلمه المرور القديمه</label>
                        <input type="password" name="old-password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="إدخل كلمه المرور ">
                        @if ($errors->has('password'))
                        <span class="help-block">
                                            <strong style="color: #f3b21a"> {{ $errors->first('old-password') }}</strong>
                                        </span>
                           @endif
                      </div>
                      @endif
                     <div class="form-group my-2">
                      <label for="exampleInputEmail1">كلمه المرور الجديده</label>
                      <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="إدخل كلمه المرور ">
                      @if ($errors->has('password'))
                      <span class="help-block">
                                          <strong style="color: #f3b21a"> {{ $errors->first('password') }}</strong>
                                      </span>
                         @endif
                    </div>
                    <div class="form-group my-2">
                      <label for="exampleInputEmail1">إعاده ادخال كلمه المرور الجديده</label>
                      <input type="password" name="password_confirmation" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="إعاده إدخال كلمه المرور ">
                    </div>


                           <div class="form-group my-2 text-center">
                            <button class="btn btn-secondary" type="submit">تاكيد</button>
                           </div>
                  </form>

     </div>
 </div>
</div>

    </div>
</div>
