<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="profile-element">
                    {{--// profile image and display name of user--}}
                    <div class="text-center">
                            <img class="rounded-circle" alt="image"  style="  width: 40%;
                            height: 50%;
                            text-align:center;
                            border-radius: 50%;"

                                src="{{asset(auth()->user()->attachmentRelation[0]->path ?? 'photos/cartoon.png')}}"/>
                    </div>
                    <a href="{{url('admin/update-profile')}}" class="text-center">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{Auth::user()->name}}</strong>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    <img src="{{asset(auth()->user()->attachmentRelation[0]->path ?? 'photos/cartoon.png')}}" style="margin-top: 20px; margin-bottom:auto;" height="40"
                         alt="logo">
                </div>
            </li>
            <li>
                <a href="{{url('supplier/home')}}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">الرئيسية</span>
                </a>
            </li>
            <li>
                <a href="{{route('supplier.product.outofstock')}}">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-label"> منتجات اوشكت علي النفاذ</span>
                </a>
            </li>
            <li>
                <a href="{{route('supplier.products.index')}}">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-label"> المنتجات</span>
                </a>
            </li>
            <li>
                <a href="{{route('supplier.products.rejected')}}">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-label"> المنتجات المرفوضه</span>
                </a>
            </li>
            <li>
                    <a href="{{route('supplier.product.addQuantity.index')}}">
                    <i class="fa fa-plus"></i>
                    <span class="nav-label"> طلبات أضافه كميات</span>
                </a>
            </li>
            <li>
                <a href="{{route('supplier.product.addQuantity.rejected')}}">
                <i class="fa fa-plus"></i>
                <span class="nav-label"> طلبات أضافه كميات المرفوضه</span>
            </a>
        </li>
            <li>
                <a href="{{route('supplier.product.pullQuantity.index')}}">
                    <i class="fa fa-minus"></i>
                    <span class="nav-label"> طلبات سحب كميات</span>
                </a>
            </li>
            <li>
                <a href="{{route('supplier.product.pullQuantity.rejected')}}">
                    <i class="fa fa-minus"></i>
                    <span class="nav-label">  طلبات سحب كميات المرفوضه</span>
                </a>
            </li>
            <li>
                <a href="#"><i class="fa fa-cart-arrow-down"></i> <span class="nav-label">الطلبات</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{route('supplier.orders')}}">الطلبات</a></li>
                    <li><a href="{{route('supplier.orders.received')}}"> الطلبات المستلمه</a></li>
                    <li><a href="{{route('supplier.orders.refunds')}}"> الطلبات المرتجعه</a></li>                   
                </ul>
            </li>
            <li>
                <a href="{{route('supplier.payment.index')}}">
                    <i class="fa fa-wallet"></i>
                    <span class="nav-label"> المحفظه</span>
                </a>
            </li>
            <li>
                <a href="{{route('supplier.editAccount')}}">
                    <i class="fa fa-user"></i>
                    <span class="nav-label"> حسابي</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
