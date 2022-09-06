@extends('website.layouts.main')
@section('title','تواصل معنا')
@section('content')

<div class="container">
    <div class="row my-5">
        <div class="col-lg-6">
            <h4>اتصل بنا </h4>
            <h6>للتواصل معنا </h6>
            <div>
                <p class="fw-bold"><span><i  class=" color-yellow fas fa-phone"></i></span> الخط الساخن</p>
                <p class="pe-3">11111</p>
            </div>
            <div>
                <p class="fw-bold"><span><i  class=" color-yellow fas fa-clock"></i></span> مواعيد عمل خدمة العملاء</p>
                <p class="pe-3">كل يوم من 9:00 صباحاً إلي 7:00 مساءاً.</p>
            </div>
            <div>
                <p class="fw-bold"><span><i  class=" color-yellow fas fa-envelope"></i></span> البريد الإلكتروني </p>
                <p class="pe-3">hello@gmail.com</p>
            </div>
            <div>
                <p class="fw-bold"><span><i  class=" color-yellow fas fa-map-marker-alt"></i></span> العنوان </p>
                <p class="pe-3">المنصوره حي الجامعه</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="formthree ptb-100">


                            <form method="post" action="{{ route('contact-us.store') }}">
                                @csrf
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="sr-only">الاسم الاول</label>
                                             <input type="text" class="form-control" required="" id="nameSix" placeholder="إدخل الاسم الاول" value="{{ auth()->user()->fname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="sr-only">الاسم الأخير</label>
                                             <input type="text" class="form-control" required="" id="emailSix" placeholder="إدخل الاسم الأخير" value="{{ auth()->user()->lname }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="sr-only"> البريد الإلكتروني</label>
                                             <input type="email" class="form-control" required="" id="nameSix" placeholder="إدخل البريد الإلكتروني" value="{{ auth()->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="sr-only"> رقم الهاتف</label>
                                             <input type="number" class="form-control" required="" id="emailSix" placeholder="إدخل رقم الهاتف" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group my-3">
                                    <select class="form-control" required="" style="color: #ffc107;" name="type">
                                        <option value="" disabled selected>اختر النوع :</option>
                                        <option value="complaint" style="color:black">شكوى</option>
                                        <option value="suggestion" style="color:black" >مقترح</option>
                                    </select>
                                    </div>
                                <div class="form-group my-3">
                                     <label class="sr-only">الرساله</label>
                                      <textarea class="form-control" required="" rows="7" placeholder="إدخل الرساله " name="message"></textarea>
                                     </div>

                                      <button  style="width: 100%;" type="submit" class="btn btn-secondary my-3">إرسل رساله </button>
                            </form>

                </div>


        </div>
    </div>
</div>
</div>


@endsection
