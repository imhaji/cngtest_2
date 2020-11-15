<nav class="navbar navbar-expand-md text-right bg-light navbar-light side-menu">
    @csrf
    <div class=" navbar-brand w-100 d-flex justify-content-between">
        <b id="title">
            <i class="fas fa-user">
            </i>
            @if (Auth::user())
                {{ Auth::user()->username }}
            @endif
        </b>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="logout" class="text-danger ml-3" id="logout-btn">
            <i class="fas fa-sign-out-alt" title="خروج"></i>
        </a>
    </div>
    <!-- ACCORDION -->
    <div id="accordion">
        <div class="collapse navbar-collapse w-100 " id="collapsibleNavbar">
            <ul class=" navbar-nav flex-column w-100 p-0 align-top">
                <li class="nav-item ">

                    <a class="nav-link active" href="#" data-toggle="collapse" data-controller="dashboard" id="dashboard-btn" data-target="#dashboard">
                        <i class="fas fa-home "></i>
                        پیشخوان
                    </a>
                    <div class="collapse" id="dashboard"  data-parent="#accordion">
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" data-toggle="collapse" data-target="#store-submenu" href="" id="store-btn" data-controller="store">
                        <i class="fas fa-store "></i>
                        انبار و کالا
                    </a>
                    <div class="collapse" id="store-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="define-stuff" data-controller="stuff">
                                    معرفی کالا
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="define-stuff-pack" data-controller="stuff-pack">
                                    معرفی مجموعه کالا
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link" id="temp-reciept-side-menu-btn" data-controller="temp-reciept">
                                    رسید موقت
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link" id="serial-side-menu-btn" data-controller="serial">
                                    ثبت سریال و وضعیت کالا
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-controller="transfer">
                                    انتقال کالا بین انبارها
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#" class="nav-link" id="unit-btn" data-controller="unit">
                                    تعریف واحد اندازه‌گیری
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" data-toggle="collapse" data-target="#car-submenu" href="#" >
                        <i class="fas fa-car " ></i>
                        خودرو </a>
                    <div class="collapse" id="car-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-controller="car-queue">
                                    خودروهای در صف </a>
                            </li>
                            <!--  <li class="nav-item">
                                 <a href="#" class="nav-link">
                                     ورود از طریق فایل </a>
                             </li> -->
                        </ul>
                    </div>
                </li>
                <li class="nav-item text-warning">
                    <a class="nav-link" data-toggle="collapse" data-target="#workshop-submenu" href="#">
                        <i class="fas fa-wrench"></i>
                        کارگاه </a>
                    <div class="collapse" id="workshop-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="define-workshop-btn" data-controller="define-workshop">
                                    تعریف کارگاه </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    مرور اطلاعات نصب </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    صدور صورت وضعیت</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item text-pink">
                    <a class="nav-link" data-toggle="collapse" data-target="#reports-submenu" href="#">
                        <i class="fas fa-chart-bar"></i>
                        گزارشات </a>
                    <div class="collapse" id="reports-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    گزارش موجودی کارگاه ها </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    گزارش موجودی انبارها</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    گزارش صورت وضعیت</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" data-target="#settings-submenu" href="#">
                        <i class="fas fa-cog"></i>
                        امکانات </a>
                    <div class="collapse" id="settings-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <li class="nav-item" id="#nav-users-btn">
                                <a href="#" class="nav-link" data-controller="users" id="side-menu-users-btn">
                                    معرفی کاربران</a>
                            </li>

{{--                             <li class="nav-item">
                                <a href="#" class="nav-link">
                                    معرفی پیمانکاران</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    معرفی کارگاه ها</a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    سطوح دسترسی</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    مرکز دانلود</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    پشتیبانی اطلاعات</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    ورود اطلاعات از سامانه مرکز پخش</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    پشتیبانی اطلاعات</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    پشتیبانی نرم‌‍افزار</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    درباره نرم‌‍افزار</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

