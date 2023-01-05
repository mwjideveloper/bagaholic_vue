<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>BAGAHOLIC FASHION STATEMENT</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('backend_theme/img/core-img/favicon.ico')}}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('backend_theme/css/core-style.css')}}">
    <link rel="stylesheet" href="{{asset('backend_theme/style.css')}}">

    <!-- Responsive CSS -->
    <link href="{{asset('backend_theme/css/responsive.css')}}" rel="stylesheet">

</head>

<body>
    <div class="catagories-side-menu">
        <!-- Close Icon -->
        <div id="sideMenuClose">
            <i class="ti-close"></i>
        </div>
        <!--  Side Nav  -->
        <div class="nav-side-menu">
            <div class="menu-list">
                <h6>CATEGORIES</h6>
                <ul id="menu-content" class="menu-content collapse out">
                    @foreach($allBrands as $key=>$brand)
                        @if(count($allStylesListBrands[$key]) > 0)
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle w-100 mb-1" type="button" id="dropdownMenuButton{{$brand->brand_name}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{$brand->brand_name}}
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton{{$brand->brand_name}}">
                                    @foreach($allStylesListBrands[$key] as $style)
                                        <li><a class="dropdown-item" href="{{url("/stocklist/BAG/$brand->id/$style->id")}}">{{$style->style}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endforeach

                    

                    @if(count($allStyles[0]) > 0)
                        <li><hr class="dropdown-divider"></li>

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButtonAccessory" data-bs-toggle="dropdown" aria-expanded="false">
                                ACCESSORY
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButtonAccessory">
                                @foreach($allStyles[0] as $style)
                                    <li><a class="dropdown-item" href="{{url("/stocklist/ACCESSORY/ALL/$style->id")}}">{{$style->style}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(count($allStyles[1]) > 0)
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButtonEyewear" data-bs-toggle="dropdown" aria-expanded="false">
                            EYEWEAR
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButtonEyewear">               
                            @foreach($allStyles[1] as $style)
                                <li><a class="dropdown-item" href="{{url("/stocklist/EYEWEAR/ALL/$style->id")}}">{{$style->style}}</a></li>
                            @endforeach
                        </ul>                              
                    @endif

                    @if(count($allStyles[2]) > 0)
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButtonFootwear" data-bs-toggle="dropdown" aria-expanded="false">
                            FOOTWEAR
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButtonFootwear">               
                            @foreach($allStyles[2] as $style)
                                <li><a class="dropdown-item" href="{{url("/stocklist/FOOTWEAR/ALL/$style->id")}}">{{$style->style}}</a></li>
                            @endforeach
                        </ul>
                    @endif

                    @if(count($allStyles[3]) > 0)
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButtonWallet" data-bs-toggle="dropdown" aria-expanded="false">
                            WALLET
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButtonWallet">               
                            @foreach($allStyles[0] as $style)
                                <li><a class="dropdown-item" href="{{url("/stocklist/WALLET/ALL/$style->id")}}">{{$style->style}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <!-- ****** Header Area Start ****** -->
        <header class="header_area">
            <!-- Top Header Area Start -->
            <div class="top_header_area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-end">

                        <div class="col-12 col-lg-7">
                            <div class="top_single_area d-flex align-items-center">
                                <!-- Logo Area -->
                                <div class="top_logo">
                                    <a href="/"><img src="{{ asset('/logos/1_crop.png') }}" alt="" style="width: 200px; height: 60px; padding: 2px 2px 2px 3px; background-color: #333;"></a>
                                </div>
                                <!-- Cart & Menu Area -->
                                <div class="header-cart-menu d-flex align-items-center ml-auto">
                                    <!-- Cart Area -->
                                    <div class="cart">
                                        <a id="header-cart-btn" target="_blank"> <i class="ti-bag"></i> CATEGORIES</a>
                                    </div>
                                    <div class="header-right-side-menu ml-15">
                                        <a href="#" id="sideMenuBtn"><i class="ti-menu" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Top Header Area End -->
            <div class="main_header_area">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-12 d-md-flex justify-content-between">
                            <!-- Header Social Area -->
                            <div class="header-social-area">
                                <a href="https://www.facebook.com/BagaholicFashionStation"><span class="karl-level">Share</span> <i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://twitter.com/bagafashion?lang=en"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/bagaholic_fashion_station/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                            <!-- Menu Area -->
                            
                              
                            <div class="main-menu-area">
                                <nav class="navbar navbar-expand-lg align-items-start">
                                    <div class="container-fluid">
                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"><i class="ti-menu"></i></span>
                                        </button>
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                <li class="nav-item d-md-block d-lg-none pt-2">
                                                    <div class="input-group mb-3">
                                                        <input type="search" class="form-control border-end-0" placeholder="SEARCH FOR KEYWORD" id="keyword" name="keyword" aria-label="search">
                                                        <button class="btn btn-outline-secondary" type="submit" onclick="submitButton()"><i class="fa fa-search" aria-hidden="true"></i></button>

                                                        <form class="form-inline" id="submitSearch" name="submitSearch" method="GET"></form>
                                                    </div>
                                                </li>
                                                <li class="nav-item px-4"><a class="nav-link"> <span class="invisible"></span></a></li>
                                                <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/stocks/brands">View Stocks</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/contact_us">Contact Us</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/about_us">About Us</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Media </a></li>
                                                <li class="nav-item px-4"><a class="nav-link"> <span class="invisible"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>

                                <nav class="navbar navbar-expand-lg align-items-start d-none d-lg-block d-xl-block d-xxl-block">
                                    <div class="container-fluid px-5">
                                        <div class="input-group mb-3 w-100 px-5" style="padding">
                                            <input type="search" class="form-control border-end-0 ps-5" placeholder="SEARCH FOR KEYWORD" id="keyword" name="keyword" aria-label="search">
                                            <button class="btn btn-outline-secondary" type="submit" onclick="submitButton()"><i class="fa fa-search" aria-hidden="true"></i></button>

                                            <form class="form-inline" id="submitSearch" name="submitSearch" method="GET"></form>
                                        </div>
                                    </div>
                                </nav>
                            </div>

                            <!-- Messenger Chat Plugin Code -->
                            <div id="fb-root"></div>
                            <script>
                                window.fbAsyncInit = function() {
                                    FB.init({
                                    xfbml            : true,
                                    version          : 'v10.0'
                                    });
                                };
                        
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s); js.id = id;
                                    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
                    
                            <!-- Your Chat Plugin code -->
                            <div class="fb-customerchat"
                                attribution="page_inbox"
                                page_id="100921746716944">
                            </div>

                            <!-- Help Line -->
                            <div class="help-line">
                                <a href="tel:+63-917-814-1967"><i class="ti-headphone-alt"></i> CALL US</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ****** Header Area End ****** -->

        <!-- ****** Top Discount Area Start ****** -->
        <section class="top-discount-area d-md-flex align-items-center">
            <!-- Single Discount Area -->
            <div class="single-discount-area">
                <h5>Authentic Products</h5>
                <h6><a href="#">BUY NOW</a></h6>
            </div>
            <!-- Single Discount Area -->
            <div class="single-discount-area">
                <h5>Money Back Guarantee</h5>
                <h6><a href="#">(Terms and Conditions)</a></h6>
            </div>
            <!-- Single Discount Area -->
            <div class="single-discount-area">
                <h5>Client Support</h5>
                <h6><a href="#">(Office Hours)</a></h6>
            </div>
        </section>
        <!-- ****** Top Discount Area End ****** -->

        {{-- _________________________VUE COMPONENTS__________________________________________ --}}
        <div id="app">
            
        </div>
        {{--  _________________________END VUE COMPONENTS__________________________________________  --}}

        <!-- ****** Footer Area Start ****** -->
        <footer class="footer_area">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="single_footer_area">
                            <div class="footer-logo">
                                <img src="{{ asset('/logos/1_crop.png') }}" alt="" style="padding: 2px 2px 2px 3px; background-color: #333;">
                            </div>
                            <div class="copywrite_text d-flex align-items-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                        <div class="single_footer_area">
                            <ul class="footer_widget_menu">
                                <li><a href="/">Home</a></li>
                                <li><a href="/stocks/brands">Stock</a></li>
                                <li><a href="/contact_us">Contact Us</a></li>
                                <li><a href="/about_us">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                        <div class="single_footer_area">
                            <ul class="footer_widget_menu">
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="/contact_us">Support</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-lg-5">
                        <div class="single_footer_area">
                            <div class="footer_heading mb-30">
                                <h6>Subscribe to our newsletter</h6>
                            </div>
                            <div class="subscribtion_form">
                                <form action="#" method="post">
                                    <input type="email" name="mail" class="mail" placeholder="Your email here">
                                    <button type="submit" class="submit">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line"></div>

                <!-- Footer Bottom Area Start -->
                <div class="footer_bottom_area">
                    <div class="row">
                        <div class="col-12 mx-0">
                            <div class="copywrite_text text-center">
                                <a style="color: #b8b8b8;">Disclaimer: Bagaholic is not in any way connected to any of the brands offered on this website.</a>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="footer_social_area text-center">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ****** Footer Area End ****** -->
    </div>
    <!-- /.wrapper end -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{asset('backend_theme/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('backend_theme/js/popper.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('backend_theme/js/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('backend_theme/js/active.js')}}"></script>

    {{-- VUE JS --}}
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

    <script>
        function submitButton()
        {   
            var keyword = document.getElementById("keyword").value;

            const submit_form = document.getElementById("submitSearch"); 
            
            submit_form.action = "/stocklist/" + keyword;

            submit_form.submit();
        }
    </script>

</body>
</html>