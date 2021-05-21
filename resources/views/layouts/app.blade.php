<html class="loading" data-textdirection="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Project</title>
    <link rel="apple-touch-icon" href="{{ asset('style/theme-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('style/theme-assets/images/ico/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style/theme-assets/css/vendors.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style/theme-assets/css/app-lite.css') }}">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('style/theme-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('style/theme-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/theme-assets/css/pages/dashboard-ecommerce.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">

    <!-- fixed-top-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                href="#"><i class="ft-menu"></i></a></li>
                        <!--
                <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
              <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
              -->
                        <ul class="dropdown-menu">
                            <li class="arrow_box">
                                <form>
                                    <div class="input-group search-box">
                                        <div class="position-relative has-icon-right full-width">
                                            <input class="form-control" id="search" type="text"
                                                placeholder="Search here...">
                                            <div class="form-control-position navbar-search-close"><i class="ft-x"> </i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                data-toggle="dropdown"><i class="ficon ft-mail"> </i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item" href="#"><i class="ft-book"></i>
                                        Read Mail</a><a class="dropdown-item" href="#"><i class="ft-bookmark"></i> Read
                                        Later</a><a class="dropdown-item" href="#"><i class="ft-check-square"></i> Mark
                                        all Read </a></div>
                            </div>
                        </li>

                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="avatar avatar-online" >
                                    <img src="{{ asset('storage/img/profile/' . Auth::user()->img) }}"
                                        alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item"
                                        href="/profile/member/{{ Auth::user()->id }}"><span
                                            class="avatar avatar-online"><img
                                            src="{{ asset('storage/img/profile/' . Auth::user()->img) }}"
                                                alt="avatar"><span
                                                class="user-name text-bold-700 ml-1">{{ Auth::user()->name }}</span></span></a>
                                    <div class="dropdown-divider">
                                    </div>
                                    <a class="dropdown-item" href="/profile/user/{{ session('session') }}"><i
                                            class="ft-user"></i> Edit Profile</a>
                                    <a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a>
                                    <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a>
                                    <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>
                                    <div class="dropdown-divider"></div>

                                    <!-- tag logout -->
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <!--end tag logout -->

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true"
        data-img="{{ asset('style/theme-assets/images/backgrounds/02.jpg') }}">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><img class="brand-logo"
                            alt="logo CCE" src="{{asset('storage/img/Logo_01.png')}}" />
                        <h3 class="brand-text">CCE</h3>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>

        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if(auth()->user()->status_id == 1 or auth()->user()->status_id == 2)
                <li class=""><a href="{{ route('home') }}"><i class="ft-home"></i><span class="menu-title"
                            data-i18n="">แดชบอร์ด</span></a>
                </li>
                <li class=" nav-item"><a href="{{ route('managemember') }}"><i class="la la-user"></i><span
                            class="menu-title" data-i18n="">สมาชิก</span></a>
                </li>
                <li class=" nav-item"><a href="{{ route('theses') }}"><i class="la la-book"></i><span
                            class="menu-title" data-i18n="">ปริญญานิพนธ์</span></a>
                </li>
                <li class=" nav-item"><a href="{{ route('manage-group') }}"><i class="la la-group"></i><span
                    class="menu-title" data-i18n="">จัดการกลุ่มโครงงาน</span></a>
                </li>
                <li class=" nav-item"><a href="{{ route('history-download') }}"><i class="la la-cloud-download"></i><span
                    class="menu-title" data-i18n="">การดาวน์โหลด</span></a>
                </li>
            @endif

                <li class=" nav-item"><a href="{{ route('search-theses') }}"><i class="la la-search"></i><span
                            class="menu-title" data-i18n="">สืบค้น</span></a>
                </li>

            @if (auth()->user()->status_id == 1 or auth()->user()->status_id == 2 or auth()->user()->status_id == 3)
                @if (auth()->user()->status_id == 3)
                    <li class=" nav-item"><a href="{{ route('createthesis') }}"><i class="la la-book"></i><span
                        class="menu-title" data-i18n="">ส่งเล่ม</span></a>
                    </li>
                @endif
                <li class=" nav-item"><a href="{{ route('show-group') }}"><i class="la la-group"></i><span
                    class="menu-title" data-i18n="">กลุ่มโครงงาน</span></a>
                </li>
            @endif

                <li class=" nav-item"><a href="#"><i class="la la-group"></i><span
                    class="menu-title" data-i18n="">เล่มยอดนิยม</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-group"></i><span
                    class="menu-title" data-i18n="">เกี่ยวกับ</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-group"></i><span
                    class="menu-title" data-i18n="">ติดต่อ</span></a>
                </li>
            </ul>
        </div>

        <div class="navigation-background"></div>
    </div>







    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before">
                <img src="{{ asset('storage/img/bg.jpg') }}" width="100%" height="420px"  alt="">
            </div>
            <div class="content-header row"></div>
            <div class="content-body">
                <!-- Chart -->
                <div class="row match-height">
                    <div class="col-12">
                        <div class="mt-3">
                            <div class="height-250 GradientlineShadow1">
                                <h1 class="display-4" style="color: rgb(230, 230, 230)">
                                    สาขาวิศวกรรมคอมพิวเตอร์และการสื่อสาร</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart --> <br><br>

                <main class="py-4">
                    @yield('content')
                </main>





            </div>
        </div>
    </div>





    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('style/theme-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="{{ asset('style/theme-assets/js/core/app-menu-lite.js') }}" type="text/javascript"></script>
    <script src="{{ asset('style/theme-assets/js/core/app-lite.js') }}" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>


</body>

</html>
