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
                <a href="{{url('admin/home')}}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">الرئيسية</span>
                </a>
            </li>
            @can('عرض وانشاء وتعديل وحذف محافظات')
             <li>
                <a href="{{url('admin/goverments')}}">
                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                    <span class="nav-label">{{__('المحافظات')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض وتعديل وحذف التصنيفات')
            <li>
                <a href="{{url('admin/categories')}}">
                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                    <span class="nav-label">{{__('التصنيفات')}}</span>
                </a>
            </li>
            @endcan
            <li>
                <a href="{{url('admin/reports')}}">
                    <i class="fa fa-window-restore"></i>
                    <span class="nav-label">التقارير</span>
                </a>
            </li>
            @can('عرض وانشاء وتعديل وحذف كوبونات الخصم')
            <li>
                <a href="{{url('admin/discount-code')}}">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                    <span class="nav-label">{{__('كوبونات الخصم')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض الموردين')
            <li>
                <a href="{{route('customers.index')}}">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="nav-label">{{__('العملاء')}}</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/suppliers')}}">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="nav-label">{{__('الموردين')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض المنتجات')
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">المنتجات</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{url('admin/products/pending')}}">المنتجات المعلقة</a></li>
                    <li><a href="{{url('admin/products/accepted')}}"> المنتجات المقبولة </a></li>
                    <li><a href="{{url('admin/products/out-of-stock')}}"> منتجات اوشكت على النفاذ </a></li>
                </ul>
            </li>
            @endcan
            @can('عرض المخزن')
            <li>
                <a href="{{url('admin/store')}}">
                    <i class="fa fa-store" aria-hidden="true"></i>
                    <span class="nav-label">{{__('المخزن')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض التحويلات')
            <li>
                <a href="#"><i class="fa fa-wallet"></i> <span class="nav-label">تحويلات الموردين</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{route('payment.index')}}">المعاملات المادية المطلوبة</a></li>
                    <li><a href="{{route('all.payment')}}">جميع التحويلات</a></li>

                </ul>
            </li>

            @endcan
         

            <li>
                <a href="#"><i class="fa fa-cart-arrow-down"></i> <span class="nav-label">الطلبات</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('الطلبات المعلقة')
                    <li><a href="{{route('orders.pending')}}">الطلبات المعلقة</a></li>
                    @endcan
                    @can('الطلبات قيد التنفيذ')
                    <li><a href="{{route('orders.inProgress')}}">الطلبات قيد التنفيذ</a></li>
                    @endcan
                    @can('الطلبات الجاهزة للشحن')
                    <li><a href="{{route('orders.ready')}}">الطلبات الجاهزة للشحن</a></li>
                    @endcan
                    @can('طلبات جاري شحنها')
                    <li><a href="{{route('orders.delivering')}}">الطلبات قيد التوصيل</a></li>
                    @endcan
                    @can('المنتجات المستلمة')
                    <li><a href="{{route('orders.received')}}">الطلبات المستلمة</a></li>
                    <li><a href="{{route('orders.canceled')}}">الطلبات الملغية</a></li>
                    <li><a href="{{route('orders.paymob')}}">الطلبات المدفوعة بالفيزا</a></li>


                    @endcan
                </ul>
            </li>
            @can('المرتجعات')
            <li>
                <a href="{{route('refund.index')}}">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                    <span class="nav-label">{{__('المرتجعات')}}</span>
                </a>
            </li>
            @endcan


            @can('عرض وحذف الشكاوي والمقترحات')
            <li>
                <a href="{{url('admin/complaints')}}">
                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                    <span class="nav-label">{{__('الشكاوي والمقترحات')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض السجلات')
            <li>
                <a href="{{url('admin/logs')}}">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="nav-label">{{__('السجلات')}}</span>
                </a>
            </li>
            @endcan
            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">المستخدمين</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('عرض المستخدمين')

                    <li><a href="{{url('admin/users')}}">المستخدمين</a></li>
                    @endcan
                    @can('عرض الرتب')
                    <li><a href="{{url('admin/roles')}}"> رتب المستخدمين</a></li>
                    @endcan
                </ul>
            </li>
            

            <li>
                <a href="{{url('admin/update-profile')}}">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">حسابي</span>
                </a>
            </li>
@can('عرض اﻹعدادات')
            <li>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">الإعدادات</span><span
                class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
            <li><a href="{{url('admin/settings')}}">إعدادات عامة</a></li>

            <li><a href="{{url('admin/advertisements')}}">المساحه الاعلانيه</a></li>
            <li><a href="{{url('admin/backup')}}">{{__('النسخ الاحتياطي')}}</a></li>

           {{-- <li><a href="{{url('admin/developer/setting')}}">اعدادات التطبيق للمطورين </a></li>
           <li><a href="{{url('admin/developer/settings/categories')}}">  الاقسام  </a></li> --}}
        </ul>
        </li>
        @endcan

        </ul>

    </div>
</nav>
