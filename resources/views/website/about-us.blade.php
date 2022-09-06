@extends('website.layouts.main')
@section('title','من نحن')
@section('content')
<div class="container about-us p-3 my-5">
    <div class="row text-center">
        <div class="col-lg-12">
            <img src="{{ asset('website/img/about-us.png') }}" class="img-fluid" alt="Homzdepot">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 my-3">
            <h3 class="fw-bold text-center my-3">من نحن ؟</h3>
            <p class="pe-5"><span class="color-yellow fw-bold">هومزديبو</span> هي منصة تسويق إلكتروني لكل منتجات المنزل من الأثاث والديكور إلى الأجهزة الكهربائية وأكثر!</p>
            <ul>
                <li>نحن نوفر تجربة التسوق المنزلي عبر الإنترنت من خلال إيجاد الحلول للعلامات التجارية والمصنعين والعملاء.</li>
                <li>هومزديبو تجمع بين التكنولوجيا والذكاء الصناعي والخدمات اللوجستية لتقديم تجربة سلسة للعميل.</li>
                <li>تركيزنا باستمرار على كل ما يخص "المنزل" - لدى هومزديبو أكبر تشكيلة من التصميمات العصرية لتمنحك القدرة على تصميم مساحتك بكل راحة من منزلك بضغطة واحدة.</li>
            </ul>
       </div>
       <div class="col-lg-12">
        <h3 class="fw-bold text-center my-3"> كيف يعمل ؟ </h3>
       </div>
       <div class="col-lg-3 text-center">
               <img src="{{ asset('website/img/how-it-work1.png') }}" alt="" class="img-fluid">
               <h6 class="my-3 fw-bold">منتجات متنوعة و متميزة</h6>
               <p>آلاف من المنتجات فى انتظارك</p>
       </div>
       <div class="col-lg-3 text-center">
               <img src="{{ asset('website/img/how-it-work2.png')}}" alt="" class="img-fluid">
               <h6 class="my-3 fw-bold">طرق دفع مختلفة</h6>
               <p>لدينا طرق دفع متعددة منها الدفع عند الاستلام</p>
       </div>
       <div class="col-lg-3 text-center">
               <img src="{{ asset('website/img/how-it-work3.png')}}" alt="" class="img-fluid">
               <h6 class="my-3 fw-bold">أسرع توصيل</h6>
               <p>توصيل الطلبات الى باب منزلك</p>
       </div>
       <div class="col-lg-3 text-center">
               <img src="{{ asset('website/img/how-it-work4.png')}}" alt="" class="img-fluid">
               <h6 class="my-3 fw-bold">خدمة مميزة</h6>
               <p>نحن دائماً جاهزون لمساعدتك</p>
       </div>
       <div class="col-lg-12 my-5">
        <iframe width="100%" height="500"
         src="{{\App\MyHelper\Helper::settingValue('videoLink')}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
       </div>
    </div>
</div>

@endsection
