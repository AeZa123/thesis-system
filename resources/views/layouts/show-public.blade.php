<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
  <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
  <meta name="author" content="ThemeSelect">
  <title>CCE</title>
  <link rel="apple-touch-icon" href="{{asset('storage/img/Logo_01.png')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/img/Logo_01.ico')}}">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('style/theme-assets/css/vendors.css')}}">
  <!-- END VENDOR CSS-->
  <!-- BEGIN CHAMELEON  CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('style/theme-assets/css/app-lite.css')}}">
  <!-- END CHAMELEON  CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('style/theme-assets/css/core/menu/menu-types/vertical-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('style/theme-assets/css/core/colors/palette-gradient.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <!-- END Custom CSS-->


  <style>
    .icon-button__badge {
        position: absolute;
        top: 5px;
        left:50px;
        width: 20px;
        height: 20px;
        background: red;
        color: #ffffff;
        border-radius: 100%;
    }
</style>

</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
      <div class="navbar-container content">
        <div class="collapse navbar-collapse show" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
          </ul>

          <ul class="nav navbar-nav float-right mt-2">
            @if (Route::has('login'))

               @auth
                    <a href="{{ url('/home') }}" class="text-sm text-white underline">Home</a>

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
                            <a class="dropdown-item" href=""><i
                                    class="ft-user"></i> Edit Profile</a>

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


                    @else
                    <a href="{{ route('login') }}" class="text-sm text-white underline">?????????????????????</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-2 text-white text-sm underline">?????????????????????????????????</a>
                    @endif
                @endauth

            @endif


          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- ////////////////////////////////////////////////////////////////////////////-->



  <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="{{asset('style/theme-assets/images/backgrounds/02.jpg') }}">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><img class="brand-logo"  src="{{asset('storage/img/Logo_01.png')}}" />
            <h3 class="brand-text">CCE</h3>
          </a></li>
        <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
      </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @if (Route::has('login'))
                @auth
                    @if(auth()->user()->status_id == 1 or auth()->user()->status_id == 2)
                        <li class=""><a href="{{ route('home') }}"><i class="ft-home"></i><span class="menu-title"
                                    data-i18n="">????????????????????????</span></a>
                        </li>
                        <li class="">
                            <a href="{{route('show-notification')}}"><i class="la la-bell-o"></i>
                                <span class="menu-title" data-i18n="">????????????????????????????????????</span>
                                @if (Auth::user()->notification != NULL and Auth::user()->status_id == '2')
                                    <p class="text-center icon-button__badge">{{Auth::user()->notification}}</p>
                                @endif
                            </a>
                        </li>
                        <li class=" nav-item"><a href="{{ route('managemember') }}"><i class="la la-user"></i><span
                                    class="menu-title" data-i18n="">??????????????????</span></a>
                        </li>
                        <li class=" nav-item"><a href="{{ route('theses') }}"><i class="la la-book"></i><span
                                    class="menu-title" data-i18n="">????????????????????????????????????</span></a>
                        </li>
                        <li class=" nav-item"><a href="{{ route('manage-group') }}"><i class="la la-group"></i><span
                            class="menu-title" data-i18n="">??????????????????????????????????????????????????????</span></a>
                        </li>
                        <li class=" nav-item"><a href="{{ route('history-download') }}"><i class="la la-cloud-download"></i><span
                            class="menu-title" data-i18n="">????????????????????????????????????</span></a>
                        </li>
                    @endif

                @endauth

            @endif


            <li class=" nav-item"><a href="/"><i class="la la-search"></i><span
                        class="menu-title" data-i18n="">??????????????????</span></a>
            </li>
            @if (Route::has('login'))
                @auth
                    @if (auth()->user()->status_id == 1 or auth()->user()->status_id == 2 or auth()->user()->status_id == 3)
                        <li class=" nav-item"><a href="{{ route('show-group') }}"><i class="la la-group"></i><span
                            class="menu-title" data-i18n="">????????????????????????????????????</span></a>
                        </li>
                    @endif
                @endauth
            @endif


            <li class=" nav-item"><a href="{{ route('public-topdowload') }}"><i class="la la-book"></i><span
                class="menu-title" data-i18n="">?????????????????????????????????</span></a>
            </li>

            <li class=" nav-item"><a href="{{ route('public-topdowload') }}"><i class="la la-info"></i><span
                class="menu-title" data-i18n="">???????????????????????????</span></a>
            </li>

            <li class=" nav-item"><a href="{{ route('public-topdowload') }}"><i class="la la-map-marker"></i><span
                class="menu-title" data-i18n="">??????????????????</span></a>
            </li>



        </ul>
    </div>
    <div class="navigation-background"></div>
  </div>



  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title"></h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
          <div class="breadcrumbs-top float-md-right">
            <div class="breadcrumb-wrapper mr-1">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>
                </li>
                <li class="breadcrumb-item active">
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body"><!-- Basic Tables start -->
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="content-body"><!-- Bar charts section start -->
                              <main class="py-4">
                                  @yield('content1')
                              </main>
                          </div>

                      </div>

                  </div>
              </div>
          </div>
      </div>

    </div>
  </div>

  <!-- ////////////////////////////////////////////////////////////////////////////-->




  <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2021 &copy; Copyright <a class="text-bold-800 grey darken-2" href="" target="_blank">????????????????????????????????????????????????????????????????????????????????????????????????</a></span>

    </div>
  </footer>


  <!-- BEGIN VENDOR JS-->
  <script src="{{asset('style/theme-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->

  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="{{asset('style/theme-assets/js/core/app-menu-lite.js')}}" type="text/javascript"></script>
  <script src="{{asset('style/theme-assets/js/core/app-lite.js')}}" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  <!-- (Optional) Latest compiled and minified JavaScript translation files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>




</body>

</html>
