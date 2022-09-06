<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}">
    <!-- font awesome  -->
    <link rel="stylesheet" href="{{asset('website/css/fontawesome.css')}}">
    <!-- style -->
    <link rel="stylesheet" href="{{asset('website/css/style.css')}}">
    <!-- icon -->
    <link rel="icon" href="{{asset('website/img/Homzdepot-Logo.png')}}">
    <link rel="stylesheet" type="text/css" href="./css/stylezoom.css">
    <!-- cairo font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
  

     <!-- slick -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   @yield('zoom')

    <!-- title -->
    <title>@yield('title')</title>
    @livewireStyles
</head>
<body>
  @livewire('header')


    @yield('content')


    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "106466285117919");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v14.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/ar_AR/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

      <!-- footer -->
      <footer class="mt-5 py-5 bg-light" >
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ route('about-us') }}" class="footer-link">عن هومزديبو</a><br>
                    <a href="{{ route('policy') }}" class="footer-link"> سياسه ارجاع السلع </a><br>
                    <a href="{{ route('contact-us') }}" class="footer-link">  الشكاوي والمقترحات </a><br>
                    <a href="{{ route('terms') }}" class="footer-link"> الشروط والاحكام </a><br>
                    <a href="{{ route('privacy') }}" class="footer-link"> الخصوصيه </a><br>
                    <a href="#" class="footer-link"> وظائف </a><br>
                </div>

                <div class="col-lg-3">
                    <p> تحتاج للمساعده ؟ </p>
                    <p> <span><i class="fas fa-envelope"></i></span> hello@gmail.com </p>
                    <p> <span><i class="fas fa-phone"></i></span> 01501565145</p>
                    <p> <span><i class="fas fa-phone"></i></span> 01501565146</p>
                </div>

                <div class="col-lg-3">
                    <h6> اشترك في نشرتنا </h6>
                    <p> .اشترك لمشاهدة آخر التحديثات في بريدك الالكتروني مباشرة </p>
                    <form class="d-flex ">
                        <input class="form-control me-2 " type="search" placeholder="name@example.com" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit"><span><i class="far fa-paper-plane"></i></span></button>
                      </form>
                </div>

                <div class="col-lg-3">
                    <h6>شاركنا علي </h6>
                    <a class="footer-link" href="https://www.facebook.com/Homzdepot.eg/" target="_blank"><i style="color: #3B5998;" class="fab fa-facebook-square"></i> <span class="px-1">فيسبوك</span></a><br>
                    <a class="footer-link" href="https://instagram.com/homzdepot?utm_medium=copy_link" target="_blank"><i style="color: #FFA500;"  class="fab fa-instagram"></i> <span class="px-1">انستجرام</span> </a><br>
                    <a class="footer-link" href="#"><i style="color: #55ACEE;"  class="fab fa-twitter"></i> <span class="px-1">تويتر</span></a><br>
                    <a class="footer-link" href="#"><i style="color: #1F88BE;"  class="fab fa-linkedin-in"></i> <span class="px-1">لينكد ان</span></a><br>
                </div>
            </div>


                <div class="col-lg-12 text-center">
                    <p class="fs-6">جميع الحقوق محفوظة @2022</p>
                </div>
        </div>
    </footer>
           <!-- jquery -->
    <script src="{{asset('website/js/jquery-3.3.1.min.js')}}"></script>
           <!-- carusal -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   <!-- carusal -->
                   <script type="text/javascript">
                         console.log("احا");
                $('.slider').slick({
          dots: true,
          infinite: false,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 4,
            rtl: true ,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
                     
    </script>


          <script>
                    var x = document.getElementById('search//');
        function myFunction(){
            x.classList.remove("z-index");
        }
        function myFunction1(){
            x.classList.add("z-index");
        }

      </script>
       
    <!-- footer end -->
    <!-- bootsrap js -->
    <script src="{{asset('website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('website/js/all.min.js')}}"></script>
    <!-- jquery -->
    <script src="{{asset('website/js/jquery-3.3.1.min.js')}}"></script>
    <!-- script -->
    <script src="{{asset('website/js/script.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>

       <!-- jQueery  -->

    @livewireScripts

    @yield('scripts')
</body>
</html>


 
