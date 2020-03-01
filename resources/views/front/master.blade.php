<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap file css-->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
    <!--google-font-->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
    <!--main file css-->
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <title>بنك الدم</title>
</head>

<body>
    <!--Loading Page-->
    <div class="loading-page">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!--header section-->
    <section class="header">
        <!--top-bar-->
        <div class="top-bar py-2">
            <div class="container">
                <!--row of top-bar-->
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="index.html" class="ar px-1">عربى</a>
                        <a href="" class="en px-1">EN</a>
                    </div>
                    <div>
                        <ul class="list-unstyled">
                            <li class="d-inline-block mx-2"><a class="facebook" href="{{$settings->fb_link}}" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="insta" href="{{$settings->insta_link}}" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="twitter" href="{{$settings->tw_link}}" target="_blank"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="whatsapp" href="{{$settings->whats_num}}" target="_blank"><i
                                        class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                    <div class="connect">
                      @auth('client-web')
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span> مرحبا بك </span> &nbsp; &nbsp; {{auth('client-web')->user()->name}}
                            </a>
                            <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{url('website')}}">  <i class="fas fa-home ml-2"></i>الرئيسيه</a>
                              <a class="dropdown-item" href="{{url('/profile')}}"> <i class="fas fa-user-alt ml-2"></i>معلوماتى</a>
                              <a class="dropdown-item" href="{{url('/notification-setting')}}"> <i class="fas fa-bell ml-2"></i>اعدادات الاشعارات</a>
                              <a class="dropdown-item" href="{{url('/fav-posts')}}"> <i class="far fa-heart ml-2"></i>المفضلة</a>
                              <a class="dropdown-item" href="{{url('contact')}}"> <i class="fas fa-phone ml-2"></i>تواصل معنا</a>
                              <a class="dropdown-item" href="{{url('logout')}}"> <i class="fas fa-sign-out ml-2"></i>تسجيل خروج</a>
                            </div>
                          </div>
                      @endauth
                    </div>
                </div>
                <!--End row-->
            </div>
            <!--End container-->
        </div>
        <!--End top-bar-->
        <!--navbar-->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="imgs/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item {{Request::path() === 'website' ? 'active' : ''}}">
                            <a class="nav-link" href="{{url('/website')}}">الرئيسيه <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{Request::path() === 'about' ? 'active' : ''}}">
                            <a class="nav-link" href="{{url('/about')}}">عن بنك الدم</a>
                        </li>
                        <li class="nav-item {{Request::path() === 'posts' ? 'active' : ''}}">
                            <a class="nav-link" href="{{url('posts')}}">المقالات</a>
                        </li>
                        <li class="nav-item {{Request::path() === 'donations' ? 'active' : ''}}">
                            <a class="nav-link" href="{{url('/donations')}}">طلبات التبرع</a>
                        </li>
                        <li class="nav-item {{Request::path() === 'who-we-are' ? 'active' : ''}}">
                            <a class="nav-link" href="{{url('/who-we-are')}}">من نحن</a>
                        </li>
                        <li class="nav-item cont {{Request::path() === 'contact' ? 'active' : ''}}">
                            <a class="nav-link" href="{{url('/contact')}}">اتصل بنا</a>
                        </li>
                        @auth('client-web')
                          <li class="pr-3"><a class="btn bg px-3" href="{{url('donation-create')}}">طلب تبرع</a></li>
                        @endauth
                        @guest('client-web')
                          <li class="mr-lg-auto py-md-2"><a class="signin" href="{{url('client-register')}}">انشاء حساب جديد</a></li>
                          <li class="pr-3"><a class="btn bg px-3" href="{{url('client-login')}}">دخول</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
            <!--End container-->
        </nav>
        <!--End Nav-->
      <!--StartContent-->
      @yield('content')
      <!--EndContent-->

    <!--Footer-->
    <footer>
        <div class="main-footer py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{asset('front/imgs/logo.png')}}" alt="">
                        <h5 class="my-3">بنك الدم</h5>
                        <p class="pl-4">{{$settings->about_app}}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="px-md-5 mt-md-3">الرئيسية</h6>
                        <ul class="list-unstyled">
                            <li class="py-2"><a href="">عن بنك الدم</a></li>
                            <li class="py-2"><a href="{{url('articles')}}">المقالات</a></li>
                            <li class="py-2"><a href="{{url('/donations')}}">عن التبرع</a></li>
                            <li class="py-2"><a href="{{url('/who-we-are')}}">من نحن</a></li>
                            <li class="py-2"><a href="{{url('/contact')}}">اتصل بنا</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 available">
                        <h6 class="mb-5 mt-md-3 px-md-5">متوفر على</h6>
                        <div class="my-3"><a href="{{$settings->play_store_url}}" target="_blank"><img src="{{asset('front/imgs/google1.png')}}" alt=""></a></div>
                        <div class="my-3"><a href="{{$settings->app_store_url}}" target="_blank"><img src="{{asset('front/imgs/ios1.png')}}" alt=""></a></div>
                    </div>
                </div>
            </div>
            <!--End container-->
        </div>
        <!--End main-footer-->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <ul class="list-unstyled pt-sm-3 py-md-3">
                            <li class="d-inline-block mx-2"><a class="facebook" href="{{$settings->fb_link}}" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="insta" href="{{$settings->insta_link}}" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="twitter" href="{{$settings->tw_link}}" target="_blank"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="whatsapp" href="{{$settings->whats_num}}" target="_blank"><i
                                        class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-7">
                        <p class="mx-5 py-md-3">جميع الحقوق محفوظه لـ <span>بنك الدم</span> &copy; 2019</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--End Footer-->
    <!--scrollUp-->
    <div class="scrollUp">
		<i class="fas fa-chevron-up"></i>
	</div>
    <!--jquery/bootstrap/main file js-->
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('front/js/slick.min.js')}}"></script>
    <script src="{{asset('front/js/popper.min.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/main.js')}}"></script>
    @stack('scripts')
</body>

</html>
