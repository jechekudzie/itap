<!doctype html>
<html lang="en">
<head>
    <title>iTAP Media</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="icon" href="#" type="image/gif" sizes="20x20">

    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- font icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- Jquery UI -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <!-- Bootstarp icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">


</head>
<body>

<!-- Start Preloader Area -->
{{--<div class="preloader">
    <div class="loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>--}}
<!-- End Preloader Area -->

<!-- ===============  header area start =============== -->
<header>
    <div class="header-area header-style-one">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-12 col-md-2 col-sm-12 col-xs-12 d-xl-flex align-items-center">
                    <div class="logo d-flex align-items-center justify-content-between">
                        <a href="{{url('/')}}"><img style="margin-top: -30px; width: 200px; height: 150px;" src="{{asset('/logo/logo-removebg-preview.png')}}" alt="logo"></a>

                        <div class="mobile-menu d-flex ">

                            <a href="javascript:void(0)" class="hamburger d-block d-xl-none">
                                <span class="h-top"></span>
                                <span class="h-middle"></span>
                                <span class="h-bottom"></span>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-6 col-xs-6">

                    <nav class="main-nav">
                        <div class="inner-logo d-xl-none">
                            <a href="#"><img src="{{asset('assets/images/logo.png')}}" alt=""></a>
                        </div>
                        <ul>
                            <li><a href="{{url('/')}}">Home </a></li>
                            <li><a href="{{url('#')}}">About</a></li>

                            <li class="has-child-menu">
                                <a href="javascript:void(0)" class="active">What We Offer
                                    <span> {{ \App\Models\ServiceCategory::all()->count() }}</span></a>
                                <i class="fl flaticon-plus">+</i>
                                <ul class="sub-menu">
                                    @foreach(\App\Models\ServiceCategory::all() as $serviceCategory)
                                        <li>
                                            <a href="{{url('#')}}">
                                                {{ $serviceCategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a href="#">Contact</a></li>
                        </ul>

                        <div class="inner-btn d-xl-none">
                            <a href="#" class="primary-btn-fill">Check Dates</a>
                        </div>

                    </nav>
                </div>


            </div>
        </div>
    </div>
</header>
<!-- ===============  header area end =============== -->


@yield('content')


<!-- ===============  footer area start  =============== -->

<div class="footer-outer pt-120 gray-300">
    <div class="footer-area">
        <div class="container">
            <div class="footer-wrapper">
                <div class="footer-watermark">
                    <h1>iTAP Media</h1>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-5 order-1">
                        <div class="footer-widget mt-0">
                            <h5 class="footer-widget-title">
                                Quick Link
                            </h5>
                            <div class="footer-links">
                                <ul class="link-list">

                                    <li><a href="{{url('#')}}" class="footer-link">Home</a></li>
                                    <li><a href="{{url('#')}}" class="footer-link">About Us</a></li>
                                    <li><a href="{{url('#')}}" class="footer-link">What We Offer</a></li>
                                    <li><a href="{{url('#')}}" class="footer-link">Contact Us</a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-3">

                        <div class="footer-newslatter-wrapper text-center">
                            <h3>Subscribe Our Newsletter</h3>
                            <h5>Don’t Miss Our Feature Update</h5>

                            <form class="newslatter-form" action="#" id="newslatter-form">
                                <div class="newslatter-input-group d-flex">
                                    <input type="email" placeholder="Enter Your Email">
                                    <button type="submit">Subscribe</button>
                                </div>
                            </form>

                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-7 order-lg-3 order-2 ">

                        <div class="footer-widget">
                            <h5 class="footer-widget-title">
                                Contact
                            </h5>
                            <div class="footer-links">
                                <ul class="link-list">
                                    <li class="contact-box">
                                        <div class="contact-icon">
                                            <i class="bi bi-telephone-plus"></i>
                                        </div>
                                        <div class="contact-links">
                                            <a href="tel:+17632275032">+1 763-227-5032</a>
                                            <a href="tel:+17632275032">+1 763-227-5032</a>
                                        </div>
                                    </li>
                                    <li class="contact-box">
                                        <div class="contact-icon">
                                            <i class="bi bi-envelope-open"></i>
                                        </div>
                                        <div class="contact-links">
                                            <a href="mailto:info@example.com">info@example.com</a>
                                            <a href="mailto:support@example.com">support@example.com</a>
                                        </div>
                                    </li>
                                    <li class="contact-box">
                                        <div class="contact-icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="contact-links">
                                            <a href="#">2752 Willison Street
                                                Eagan, United State</a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-5  order-3 order-lg-1">
                        <div class="footer-copyright">
                            <p>Copyright 2021 EventLab| Design By <a href="#">Egens Lab</a></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 order-1 order-lg-2">
                        <div class="footer-logo">
                            <a href="#"><img src="assets/images/logo-v2.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 order-2 order-lg-3">
                        <ul class="d-flex footer-social-links justify-content-lg-end justify-content-center">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ===============  footer area end  =============== -->


<!-- Custom Cursor -->

<div class="cursor"></div>
<div class="cursor2"></div>

<!-- Custom Cursor End -->
<!--Javascript -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.js') }}"></script>
<script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>

<!-- Custom JavaScript -->
<script src="{{ asset('assets/js/main.js') }}"></script>


</body>
</html>
