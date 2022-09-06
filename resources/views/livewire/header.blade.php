<div class="sticky-top">
   <!-- nav bar -->

    <div class="container-fluid bg-warning text-center py-2 ">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{\App\MyHelper\Helper::settingValue('navbarOfferLink')}}">
                <span class="fw-bold text-light">
                    {{\App\MyHelper\Helper::settingValue('navbarOffer')}}
                </span>
                </a>
            </div>
        </div>
    </div>
    <!-- 
                <div class="col-lg-12">
                
                          <a href="{{\App\MyHelper\Helper::settingValue('navbarOfferLink')}}">
                <span class="fw-bold text-light">
                    {{\App\MyHelper\Helper::settingValue('navbarOffer')}}
                </span>
                </a>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            
            </div>
    -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav-media">

        <div class="container-fluid">
                    <!-- nav bar brand -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{asset('website/img/Homzdepot-Logo.png')}}" class="mx-3 logo-img"  alt="" >
                </a>
                
                <!--  search -->

              <form class="d-flex search hidden-m" method="get" action="{{route('search')}}">
                <input class="form-control me-2"  type="search" name="search" id="search" placeholder="البحث عن المنتجات" aria-label="Search"> 
                   <button class="btn btn-outline-secondary d-inline" type="submit"><span style="font-size: 11px;"><i class="fas fa-search"></i></span></button>
              </form>
            <!--  search mobile -->
                <button type="button"  class="btn" onclick="myFunction()"><i class="fas fa-search vision-m text-secondary"></i></button>


                    <!--  cart -->
                    <a href="{{route('cart')}}"  class=" cart btn mx-1  position-relative ">
                    <i class="fas fa-shopping-cart text-secondary cart-icon  position-relative" style="width: 35px; height: 30px;"></i>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                            {{$cartTotal}}
                        </span>
                    </a>

                    <!--  profile -->
       
                  @if (auth()->user())
               <a href="{{route('profile')}}" class"btn"> <span class="hidden-m fw-bold text-secondary">  اهلا,{{auth()->user()->fname}}</span> <i class="fas fa-user text-secondary mx-2"></i></a>
              @endif
                   @if(!auth()->user())
                   <!--  login -->
                <a href="{{route('viewLogin')}}" class="btn btn-outline-secondary hidden-m login">تسجيل الدخول <span><i class="fas fa-user"></i></span></a>
                <a href="{{route('viewLogin')}}" class="text-secondary vision-m"><span><i class="fas fa-user"></i></span> </a>
                @else
                <!--  logout -->
                <a href="{{route('logout')}}" class=" logout btn " ><i class="fas fa-sign-out-alt text-secondary cart-icon " style="width:30px; height:30px; " ></i></a>
                @endif
                

             
                        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon cart-icon"></span>
                        </button>
            
     
          </div>
           

      </nav>

      <nav class="navbar navbar-expand-lg second-nav navbar-light bg-light " >
        <div class="container">
      
          <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0  ">
                @inject('categories',App\Models\Category)
                @foreach ($categories->where('parent_id',null)->get() as $category )
                <li class="nav-item dropdown">
                  <a class="nav-link  btn-outline-secondary fw-bold text-center" href=""  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span> @if($category->icon)
                                <img src="{{ asset('website/img/'.$category->icon) }}">
                                @endif
                            </span>{{ $category->name }}
                    </a>

                    <ul class="dropdown-menu text-center" dir="rtl"; aria-labelledby="navbarDropdown">
                        @foreach ($categories->where('parent_id',$category->id)->get() as $subcategory )
                        <li>
                          <form class="d-flex " method="get" action="{{route('subCategory,products')}}">
                            <input hidden class="form-control me-2" value="{{$subcategory->id}}"  name="category">
                            <button type="submit" class="dropdown-item py-2 my-2" >{{ $subcategory->name }}</button>
                          </form>
                          </li>                        @endforeach
                    </ul>
                </li>

                @endforeach



            </ul>
          </div>
        </div>
      </nav>
      <!--  search mobile -->
            <div class="container-fluid bg-light text-center vision-m search-m z-index " id="search//">
        <div class="row">
            <div class="col-lg-12">
                  <form class="d-flex mt-2" method="get" action="{{route('search')}}">
                    <input class="form-control px-3 me-2"  type="search" name="search" id="search" placeholder="البحث عن المنتجات" aria-label="Search" style="width:85%;" > 
                    <button class="btn btn-outline-secondary" type="submit"><span style="font-size: 11px;"><i class="fas fa-search"></i></span></button>
                    <button type="button"  class="btn" onclick="myFunction1()"><i class="fas fa-window-close  text-secondary"></i></button>
                  </form>
            </div>
        </div> 
      </div>
            <!--  search mobile end -->


</div>
<!-- nav bar end --></div>
@section('scripts')
<script type="text/javascript">


  var route = "{{ url('products/autocomplete-search') }}";

  $('#search').typeahead({
      source: function (query, process) {
          return $.get(route, {
              query: query
          }, function (data) {
              return process(data);
          });
      }
  });


</script>
  

@endsection


