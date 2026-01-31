<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.png">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/stylesheet.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/mmenu.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" id="colors">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&amp;display=swap&amp;subset=latin-ext,vietnamese"
   rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5098637975065354"crossorigin="anonymous"></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R6PFHNL70S"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R6PFHNL70S');
</script>

</head>
@php
$websiteContentControllerObj = new App\Http\Controllers\frontend\websiteContentController();
$websiteContentDetailsRow = $websiteContentControllerObj->websiteContentDetails();

$franchiseHeaderObj = new App\Http\Controllers\frontend\franchiseController();
$franchiseListingHeaderMenu = $franchiseHeaderObj->franchiseListingHeaderMenu();

$couponAndOfferHeaderObj = new App\Http\Controllers\frontend\couponAndOfferController();
$couponAndOfferListingHeaderMenu = $couponAndOfferHeaderObj->getCouponAndOfferListingHeaderMenu();

$pressReleaseHeaderObj = new App\Http\Controllers\frontend\pressReleaseController();
$pressReleaseListingHeaderMenu = $pressReleaseHeaderObj->getpressReleaseListingHeaderMenu();
@endphp

<style>
     html, body {
            box-sizing: border-box;
            overflow-x: hidden;
        }

        /* *, *:before, *:after {
            box-sizing: inherit;
        }

        img, iframe, embed, object, video {
            max-width: 100%;
            height: auto;
            display: block;
        } */
</style>

<body>
   <!-- Wrapper -->
   <div id="main_wrapper">
   {{--
   <header>
      <div id="header">
         <div class="container">
            <div class="col-md-3">
               <div id="google_translate_element"></div>
               <script type="text/javascript">
                  function googleTranslateElementInit() {
                      new google.translate.TranslateElement({
                          pageLanguage: 'en'
                      }, 'google_translate_element');
                  }
               </script>
               <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
         </div>
      </div>
   </header>
   --}}
   <header id="header_part">
      <div class="header-top bg-theme-color-2 sm-text-center p-0" style="background-color: #3fb4e4">
         <div class="container">
            <div class="row">
               <div class="col-md-8 col-sm-12 col-xs-12">
                  <div class="widget no-border m-0 mr-15 pull-left flip sm-pull-none sm-text-center">
                     <ul class="list-inline font-13 sm-text-center mt-5" style="font-weight: bolder; font-size:16px;">
                        <li><a style="color: white;" href="{{url('/')}}">Home</a></li>

                        <li  style="color: white;">|</li>
                        <li><a style="color: white;" href="write-for-us">Write For Us</a></li>

                        {{-- <li><a  style="color: white;" href="{{ url('product-service') }}">Product & Service</a></li>    --}}

                        {{-- <li style="color: white;">|</li>
                        <li><a style="color: white;" href="{{ url('business-listing') }}">Add Business</a></li> --}}

                        <li style="color: white;">|</li>
                        <li><a style="color: white;" href="{{ url('submit-press-release') }}">Submit Press Release</a></li>

                        {{-- <li style="color: white;">|</li>
                        <li><a style="color: white;" href="{{ url('our-services') }}">Services</a></li> --}}



                     </ul>
                  </div>
               </div>
               <div class="col-md-4 col-sm-12 col-xs-12 pull-right">
                  <div class="widget no-border m-0 pull-right">
                     <ul class="list-inline font-13 sm-text-center mt-5">

                        @if (isset(Auth::user()->name))
                        <li><a href="{{url('user-admin/dashboard')}}" style="color: white; font-weight:bold">{{ Str::substr(Auth::user()->name, 0, 20) }}</a></li>
                        <li><a href="{{url('userLogout')}}" style="color: white; font-weight:bold">Log out</a></li>
                        @endif
                        @if (!isset(Auth::user()->name))
                        <li>
                           <a href="{{url('user-admin/login')}}" style="color: white; font-weight:bold">Log In / Sign Up</a>
                        </li>
                        @endif
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="header">
         <div class="container">
            <div class="utf_left_side">
               <div id="logo"> <a href="{{ url('/') }}"><img
                  src="{{ url('custom-images/'.$websiteContentDetailsRow['wc_header_logo']) }}" style="max-height: 42px important;"
                  alt=""></a> </div>
               <div class="mmenu-trigger">
                  <button class="hamburger utfbutton_collapse" type="button">
                  <span class="utf_inner_button_box">
                  <span class="utf_inner_section"></span>
                  </span>
                  </button>
               </div>
               <nav id="navigation" class="style_one">
                  <ul id="responsive">
                     <li><a href="{{ url('/') }}">Home</a></li>
                     @if (isset(Auth::user()->name))
                        <li><a href="{{ url('business-listing') }}">Add Business</a></li>
                     @else
                     <li><a href="{{ url('user-admin/login') }}">Add Business</a></li>
                       @endif
                     <li>
                        <a href="#">Find Business</a>
                        @if(isset($businessListingHeaderMenu) && $businessListingHeaderMenu->isNotEmpty())
                        <ul style="height: 500px; overflow: auto;">
                           @foreach ($businessListingHeaderMenu as $businessListingHeaderMenuDataCountry)
                           @php
                           $newBusinessListingCountry = str_replace(' ', '-', $businessListingHeaderMenuDataCountry);
                           @endphp
                           <li><a
                              href="{{ url('business-list/' . $newBusinessListingCountry) }}">{{ $businessListingHeaderMenuDataCountry }}</a>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </li>
                     <li>
                        <a href="#">Find Franchise</a>
                        @if(isset($franchiseListingHeaderMenu) && $franchiseListingHeaderMenu->isNotEmpty())
                        <ul style="height: auto; overflow: auto;">
                           @foreach ($franchiseListingHeaderMenu as $franchiseListingHeaderMenuDataCountry)
                           @php
                           $newFranchiseListingCountry = strtolower(str_replace(' ', '-', $franchiseListingHeaderMenuDataCountry));
                           @endphp
                           <li><a
                              href="{{ url('franchise-list/' . $newFranchiseListingCountry) }}">{{ $franchiseListingHeaderMenuDataCountry }}</a>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </li>


                     <li>
                        <a href="#">Coupon & Offers</a>
                        @if(isset($couponAndOfferListingHeaderMenu) && $couponAndOfferListingHeaderMenu->isNotEmpty())
                        <ul>
                           @foreach ($couponAndOfferListingHeaderMenu as $couponAndOfferListingHeaderMenuRow)
                           @php

                           if($couponAndOfferListingHeaderMenuRow['cf_listing_type'] == 'Coupon / Promo Code'){
                              $cf_listing_type = 'Coupon Promo Code';
                           }else if($couponAndOfferListingHeaderMenuRow['cf_listing_type'] == 'Offer / Deal'){
                              $cf_listing_type = 'Offer Deal';
                           }else if($couponAndOfferListingHeaderMenuRow['cf_listing_type'] == 'Free Sample'){
                              $cf_listing_type = 'Free Sample';
                           }else if($couponAndOfferListingHeaderMenuRow['cf_listing_type'] == 'Free Recharge Coupon'){
                              $cf_listing_type = 'Free Recharge Coupon';
                           }
                           $cfListingType = strtolower(str_replace(' ', '-', $cf_listing_type));
                           @endphp
                           <li><a
                              href="{{ url('coupon-list/' . $cfListingType) }}">{{ $couponAndOfferListingHeaderMenuRow['cf_listing_type'] }}</a>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </li>

                     <li><a href="#">Press Release</a>
                        @if(isset($pressReleaseListingHeaderMenu) && $pressReleaseListingHeaderMenu->isNotEmpty())
                     <ul>
                        @foreach ($pressReleaseListingHeaderMenu as $pressReleaseListingHeaderMenuRow)
                        @php
                           $prMainCat = str_replace(' ', '-', $pressReleaseListingHeaderMenuRow);
                        @endphp
                           <li>
                              <a href="{{ url('press-release-category/'.$prMainCat) }}">{{ $pressReleaseListingHeaderMenuRow }}</a>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </li>

                     <li>
                        <a href="#">Mall</a>
                        @if(isset($mallCityHeaderMenu) && $mallCityHeaderMenu->isNotEmpty())
                        <ul>
                           @foreach ($mallCityHeaderMenu as $mallCityHeaderMenuDataCity)
                           <li>
                              <a href="#">{{ $mallCityHeaderMenuDataCity }}</a>
                              @php
                              $mallControllerObj = new App\Http\Controllers\frontend\mallController();
                              $cityWiseMallDataHeaderMenu = $mallControllerObj->cityWiseMallDataHeaderMenu($mallCityHeaderMenuDataCity);
                              $newMallCity = str_replace(' ', '-', $mallCityHeaderMenuDataCity);
                              @endphp
                              <ul>
                                 @foreach ($cityWiseMallDataHeaderMenu as $cityWiseMallDataHeaderMenuData)
                                 @php
                                 $newMallName = str_replace(' ', '-', $cityWiseMallDataHeaderMenuData->mall_name);
                                 @endphp
                                 <li><a
                                    href="{{ url('detail-mall/Malls-in-' . $newMallCity . '/' . $newMallName) }}">{{ $cityWiseMallDataHeaderMenuData->mall_name }}</a>
                                 </li>
                                 @endforeach
                              </ul>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </li>

                     {{-- <li>
                        <a href="#">Offers</a>
                        <ul>
                           @foreach ($offerHeaderMenu as $offerHeaderMenuRow)
                           <li>
                              <a href="#">{{ $offerHeaderMenuRow->offer_city }}</a>
                              @php
                              $cityWiseOfferDataHeaderMenuObj = new App\Http\Controllers\frontend\offersController();
                              $cityWiseOfferDataHeaderMenu = $cityWiseOfferDataHeaderMenuObj->cityWiseOfferDataHeaderMenu($offerHeaderMenuRow->offer_city);
                              $newMallCity = str_replace(' ', '-', $offerHeaderMenuRow->offer_city);
                              @endphp
                              <ul>
                                 @foreach ($cityWiseOfferDataHeaderMenu as $cityWiseOfferDataHeaderMenuRow)
                                 @php
                                 $newMallName = str_replace(' ', '-', $cityWiseOfferDataHeaderMenuRow->mall_name);
                                 @endphp
                                 <li>
                                    <a href="{{ url('offer-list/Malls-in-'.$newMallCity.'/'.$newMallName) }}">{{ $cityWiseOfferDataHeaderMenuRow->mall_name }}</a>
                                 </li>
                                 @endforeach
                              </ul>
                           </li>
                           @endforeach
                        </ul>
                     </li> --}}
                     {{-- <li><a href="{{ url('blogs') }}">Shopping Blogs</a></li> --}}
                     <li>
                        <a href="#">Blogs</a>
                        @if(isset($blogCategoryHeaderMenu) && $blogCategoryHeaderMenu->isNotEmpty())
                        <ul style="height: 500px; overflow: auto;">
                           @foreach ($blogCategoryHeaderMenu as $blogCategoryHeaderMenuDataCountry)
                           @php
                           $newBlogCatCountry = str_replace(' ', '-', $blogCategoryHeaderMenuDataCountry);
                           @endphp
                           <li>
                              <a href="{{ url('blog-list/' . $newBlogCatCountry . '/ALL') }}">{{ $blogCategoryHeaderMenuDataCountry }}</a>
                           </li>
                           @endforeach
                           <li><a href="{{ url('blogs') }}">Shopping Blogs</a></li>
                        </ul>
                        @endif
                     </li>

                     <li><a href="{{ url('product-service') }}">Product & Service</a></li>

                     {{-- <li>
                        <a href="#">Shops</a>
                        <ul style="height: auto; overflow: auto;">
                           <li><a target="_blank" href="https://punnaka.uspp.com/"><strong>Buy Custom Gift Items</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/lapel-pins"><strong>Buy Custom Lapel Pins</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/coins"><strong>Buy Custom Challenge Coins</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/medals"><strong>Buy Custom Medals</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/lanyards"><strong>Buy Custom Lanyards</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/patches"><strong>Buy Custom Patches</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/belt-buckles"><strong>Buy Custom Belt Buckles</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/pvc-patches"><strong>Buy Custom PVC Patches</strong></a></li>
                           <li><a target="_blank" href="https://punnaka.uspp.com/custom-t-shirts"><strong>Buy Custom T-Shirts</strong></a></li>
                        </ul>
                     </li> --}}
                     {{-- <li><a href="{{ url('our-services') }}">Services</a></li> --}}
                  </ul>
               </nav>
               <div class="clearfix"></div>
            </div>
            {{-- @if (isset(Auth::user()->name))
            <div class="utf_right_side">
               <div class="header_widget">
                  <div class="utf_user_menu">
                     <div class="utf_user_name">
                        <span><img src="{{ url('custom-images/icons/user-icon.png') }}"
                           alt="" style="width: 35px; margin-left: 8px;"></span>Hi,
                        {{ Str::substr(Auth::user()->name, 0, 6) }} !
                     </div>
                     <ul>
                        <li><a href="{{ url('dashboard') }}"><i class="sl sl-icon-layers"></i> Dashboard</a>
                        </li>
                        <li><a href="{{ url('profile') }}"><i class="sl sl-icon-user"></i> My Profile</a></li>
                        <li><a href="{{ url('userPasswordChange') }}"><i class="sl sl-icon-lock"></i>Password Change </a></li>
                        <li><a href="{{ url('userLogout') }}"><i class="sl sl-icon-power"></i> Logout</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            @endif
            @if (!isset(Auth::user()->name))
            <div class="utf_right_side"style="margin-top: 11px;">
               <div class="header_widget">
                  <a style="color: black;font-weight: bold;" href="{{ url('register') }}"
                     class="border with-icon"><i class="fa fa-sign-in"></i> Sign Up &emsp;</a>
                  <a style="color: black;font-weight: bold;" href="{{ url('login') }}"
                     class="border with-icon"><i class="sl sl-icon-user"></i> Login</a>
               </div>
            </div>
            @endif --}}
         </div>
      </div>
   </header>
   <div class="clearfix"></div>
