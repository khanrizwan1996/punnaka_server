<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no,width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />
    <link rel="icon" type="image/png" href="{{ asset('custom-images/fav-icon.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('custom-images/fav-icon.png') }}" sizes="32x32">
    <title>Punnaka | Admin</title>

    @php
        $hostURL = URL::current();
        
        $startLengthURL = 22; // Local
        $EndLengthURL = 30; // Local
       //$startLengthURL = 24; // Live
       //$EndLengthURL = 20; // Live

        $newCurrentURL = Str::substr($hostURL, $startLengthURL, $EndLengthURL);
    
        $adminId = session('adminId');
        $adminName = session('adminName');
        $adminEmail = session('adminEmail');
        $adminPassword = session('adminPassword');
        $adminContactNo = session('adminContactNo');
        $currentURL = Route::current()->uri();
       
    @endphp
    {{-- @if (!isset($adminId))
        <script LANGUAGE='JavaScript'>
            window.alert('Please Login First');
            window.location.href = 'login';
        </script>
    @endif --}}
    <!-- additional styles for plugins -->
    <!-- weather icons -->
    
    <link rel="stylesheet" href="{{ asset('admin/bower_components/weather-icons/css/weather-icons.min.css') }}"
        media="all">
    <!-- metrics graphics (charts) -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/metrics-graphics/dist/metricsgraphics.css') }}">
    <!-- chartist -->
    {{--  <link rel="stylesheet" href="{{asset('admin/bower_components/chartist/dist/chartist.min.css')}}"> --}}

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/uikit/css/uikit.almost-flat.min.css') }}"
        media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('admin/assets/icons/flags/flags.min.css') }}" media="all">

    <!-- style switcher -->
    {{-- <link rel="stylesheet" href="{{asset('admin/assets/css/style_switcher.min.css')}}" media="all"> --}}

    <link rel="stylesheet" href="{{ asset('admin/assets/css/main.min.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/themes/themes_combined.min.css') }}" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="bower_components/matchMedia/matchMedia.js"></script>
        <script type="text/javascript" src="bower_components/matchMedia/matchMedia.addListener.js"></script>
        <link rel="stylesheet" href="assets/css/ie.css" media="all">
    <![endif]-->

</head>

<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar" style="height: 0px;">

                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i
                                    class="material-icons md-24 md-light">fullscreen</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image"><img class="md-user-image"
                                    src="{{asset('custom-images/icons/settings.png')}}" alt="" /></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="{{ asset('admin/adminLogout') }}">Log Out</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">

        <div class="sidebar_main_header" style="height: 66px; background:#fff">
            <div class="sidebar_logo" style="height: 100%;">
                <a href="#" class="sSidebar_hide sidebar_logo_large">
                    <img class="logo_regular" src="{{ asset('custom-images/new-logo.png') }}" alt=""
                        height="60" width="200" style="margin-left: -5px;" />
                    <img class="logo_light" src="{{ asset('custom-images/new-logo.png') }}" alt=""
                        height="60" width="200" style="margin-left: -5px;" />
                </a>
                <a href="#" class="sSidebar_show sidebar_logo_small">
                    <img class="logo_regular" src="assets/img/logo_main_small.png" alt="" height="32"
                        width="32" />
                    <img class="logo_light" src="assets/img/logo_main_small_light.png" alt="" height="32"
                        width="32" />
                </a>
            </div>

        </div>

        <div class="menu_section">
            <ul>
               <li title="Dashboard" @if ($currentURL == 'admin/dashboard') class="current_section" @endif  >
                    <a href="{{ url('admin/dashboard') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/dashboard.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Dashboard</span>
                    </a>
                </li>

                 <li title="Enquires" @if($currentURL == 'admin/writeForUsList' || $currentURL == 'admin/ourServicesList'|| $currentURL == 'admin/newsLetterList') class="submenu_trigger current_section act_section" @endif>
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/survey.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Enquires</span>
                    </a>
                    <ul @if($currentURL == 'admin/writeForUsList' || $currentURL == 'admin/ourServicesList' || $currentURL == 'admin/newsLetterList' || $currentURL == 'admin/userList') 
                    style="display: block; margin-left: -21px;" @endif style="margin-left: -21px;">

                        <li @if($currentURL == 'admin/writeForUsList') class="act_item" @endif>
                            <a href="{{ url('admin/writeForUsList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Write for us</a>
                        </li>

                        <li @if($currentURL == 'admin/ourServicesList') class="act_item" @endif>
                            <a href="{{ url('admin/ourServicesList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Our Services</a>
                        </li>
                        
                        <li @if($currentURL == 'admin/newsLetterList') class="act_item" @endif>
                            <a href="{{ url('admin/newsLetterList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> News Letter List</a>
                        </li>

                        <li @if($currentURL == 'admin/userList') class="act_item" @endif>
                            <a href="{{ url('admin/userList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Users List</a>
                        </li>

                    </ul>
                </li>

                  <li title="Blog Category" @if($currentURL == 'admin/blogCategoryMainList' || $currentURL == 'admin/blogCategorySubList'|| $currentURL == 'admin/blogCategoryList') class="submenu_trigger current_section act_section" @endif>
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/blog-category.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Blogs</span>
                    </a>
                    <ul @if($currentURL == 'admin/blogCategoryMainList' || $currentURL == 'admin/blogCategorySubList'|| $currentURL == 'admin/blogCategoryList') style="display: block; margin-left: -21px;" @endif style="margin-left: -21px;">

                        <li @if($currentURL == 'admin/blogCategoryMainList') class="act_item" @endif>
                            <a href="{{ url('admin/blogCategoryMainList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Main Category</a>
                        </li>

                        <li @if($currentURL == 'admin/blogCategorySubList') class="act_item" @endif>
                            <a href="{{ url('admin/blogCategorySubList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Sub Category</a>
                        </li>

                        <li @if($currentURL == 'admin/blogCategoryList') class="act_item" @endif>
                            <a href="{{ url('admin/blogCategoryList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Blog List & Add Blog</a>
                        </li>
                    </ul>
                </li>

                <li @if ($currentURL =='admin/blogList') class="current_section" @endif title="Shopping Blog">
                    <a href="{{ url('admin/blogList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/shopping-blog.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Shopping Blogs</span>
                    </a>
                </li>

                <li title="Business Listing" @if($currentURL == 'admin/businessListingCategoryMainList' || $currentURL == 'admin/businessListingCategorySubList'|| $currentURL == 'admin/businessListing' ) class="submenu_trigger current_section act_section" @endif >
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/business-list.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Business Listing</span>
                    </a>
                    <ul  @if($currentURL == 'admin/businessListingCategoryMainList' || $currentURL == 'admin/businessListingCategorySubList'|| $currentURL == 'admin/businessListing') style="display: block; margin-left: -21px;" @endif style="margin-left: -21px;">

                        <li @if($currentURL == 'admin/businessListingCategoryMainList') class="act_item" @endif >
                            <a href="{{ url('admin/businessListingCategoryMainList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Main Category</a>
                        </li>

                        <li @if($currentURL == 'admin/businessListingCategorySubList') class="act_item" @endif >
                            <a href="{{ url('admin/businessListingCategorySubList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Sub Category</a>
                        </li>

                        <li @if($currentURL == 'admin/businessListing') class="act_item" @endif >
                            <a href="{{ url('admin/businessListing') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Business Listing</a>
                        </li>
                    </ul>
                </li>
                
                 <li title="Product & Service Listing" @if($newCurrentURL == 'admin/productAndServiceList'|| $newCurrentURL == 'admin/productAndServiceAdd') class="submenu_trigger current_section act_section" @endif>
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/ps.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" style="font-size: 13px;">Product & Service Listing</span>
                    </a>
                    <ul @if($newCurrentURL == 'admin/productAndServiceList'|| $newCurrentURL == 'admin/productAndServiceAdd') style="margin-left: -21px;display:block" @endif style="margin-left: -21px;">
                        <li  @if($newCurrentURL == 'admin/productAndServiceList') class="act_item" @endif>
                            <a href="{{ url('admin/productAndServiceList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Product & Service Listing</a>
                        </li>
                        
                        <li @if($newCurrentURL == 'admin/productAndServiceAdd') class="act_item" @endif>
                            <a href="{{ url('admin/productAndServiceAdd/') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Add Product & Service</a>
                        </li>
                    </ul>
                </li>


                {{-- <li title="userList" @if ($currentURL == 'admin/userList') class="current_section" @endif  >
                    <a href="{{ url('admin/userList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/users.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Users List</span>
                    </a>
                </li> --}}

                <li @if ($currentURL == 'admin/couponAndServiceList') class="current_section" @endif title="Offers & Coupons List">
                    <a href="{{ url('admin/couponAndServiceList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/discount.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Offers & Coupons List</span>
                    </a>
                </li>

                <li title="Business Listing" @if($currentURL == 'admin/businessListingCategoryMainList' || $currentURL == 'admin/businessListingCategorySubList'|| $currentURL == 'admin/businessListing') class="submenu_trigger current_section act_section" @endif >
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/franchise.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Franchise Listing</span>
                    </a>
                    <ul  @if($currentURL == 'admin/franchiseCategoryMainList' || $currentURL == 'admin/franchiseCategorySubList'|| $currentURL == 'admin/franchiseList' ) style="display: block; margin-left: -21px;" @endif style="margin-left: -21px;">

                        <li @if($currentURL == 'admin/franchiseCategoryMainList') class="act_item" @endif >
                            <a href="{{ url('admin/franchiseCategoryMainList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Main Category</a>
                        </li>

                        <li @if($currentURL == 'admin/franchiseCategorySubList') class="act_item" @endif >
                            <a href="{{ url('admin/franchiseCategorySubList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Sub Category</a>
                        </li>

                        <li @if($currentURL == 'admin/franchiseList') class="act_item" @endif >
                            <a href="{{ url('admin/franchiseList') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Franchise Listing</a>
                        </li>

                    </ul>
                </li>

                <li title="Business Listing" @if($currentURL == 'admin/businessListingPaid' || $currentURL == 'admin/businessListingUnPaid' ) class="submenu_trigger current_section act_section" @endif >
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/business-list.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Payment History</span>
                    </a>
                    <ul @if($currentURL == 'admin/businessListingPaid' || $currentURL == 'admin/businessListingUnPaid' ) style="display: block; margin-left: -21px;" @endif style="margin-left: -21px;">

                        <li @if($currentURL == 'admin/businessListingPaid') class="act_item" @endif >
                            <a href="{{ url('admin/businessListingPaid') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Paid List</a>
                        </li>

                        <li @if($currentURL == 'admin/businessListingUnPaid') class="act_item" @endif >
                            <a href="{{ url('admin/businessListingUnPaid') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Not Paid List</a>
                        </li>
                    </ul>
                </li>
                
                 {{-- <li @if ($currentURL == 'admin/franchiseList') class="current_section" @endif title="Franchise">
                    <a href="{{ url('admin/franchiseList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/franchise.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Franchise Listing</span>
                    </a>
                </li> --}}
                
                <li @if ($currentURL == 'admin/mallList') class="current_section" @endif title="Mall">
                    <a href="{{ url('admin/mallList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/mall.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Mall Listing</span>
                    </a>
                </li>

                <li @if ($currentURL == 'admin/pressReleaseList' || $currentURL == 'admin/pressReleaseAdd') class="current_section" @endif title="Mall">
                    <a href="{{ url('admin/pressReleaseList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/press-release.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Press Release Listing</span>
                    </a>
                </li>

               
               <li @if ($currentURL == 'admin/brandList') class="current_section" @endif title="Brand">
                    <a href="{{ url('admin/brandList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/brand.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Brand Listing</span>
                    </a>
                </li>

                 {{-- <li @if ($currentURL == 'admin/imageFolder') class="current_section" @endif title="Brand">
                    <a href="{{ url('admin/imageFolder') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/images.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Image Folder</span>
                    </a>
                </li> --}}

                {{-- <li @if ($currentURL == 'admin/bannerList') class="current_section" @endif title="Banner List">
                    <a href="{{ url('admin/bannerList') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/banner.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">Banner List</span>
                    </a>
                </li> --}}
                <li @if ($currentURL =='admin/aboutUsEdit') class="current_section" @endif title="About Us">
                    <a href="{{ url('admin/aboutUsEdit') }}">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/about-us-1.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title">About Us</span>
                    </a>
                </li>
                <li title="Website Details" @if($currentURL == 'admin/websiteContentEdit' || $currentURL == 'admin/policyEdit/tc'|| $currentURL == 'admin/policyEdit/pp') class="submenu_trigger current_section act_section" @endif>
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/setting.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Website Details</span>
                    </a>
                    <ul @if($currentURL == 'admin/websiteContentEdit' || $currentURL == 'admin/policyEdit/tc' || $currentURL == 'admin/policyEdit/pp') 
                    style="display: block; margin-left: -21px;" @endif style="margin-left: -21px;">

                        <li @if($currentURL == 'admin/websiteContentEdit') class="act_item" @endif>
                            <a href="{{ url('admin/websiteContentEdit') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Website Details</a>
                        </li>

                        <li @if($currentURL == 'admin/policyEdit/tc') class="act_item" @endif>
                            <a href="{{ url('admin/policyEdit/tc') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Term & Conditions</a>
                        </li>
                        
                        <li @if($currentURL == 'admin/policyEdit/pp') class="act_item" @endif>
                            <a href="{{ url('admin/policyEdit/pp') }}" ><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;"> Privacy Policy</a>
                        </li>
                    </ul>
                </li>
                 
                
                {{-- <li title="Coupons Listing" @if($newCurrentURL == 'admin/couponAdd' || $newCurrentURL == 'admin/couponList/0'|| $newCurrentURL == 'admin/couponList/1') class="submenu_trigger current_section act_section" @endif>
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/coupon-1.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Coupons Listing</span>
                    </a>
                    <ul @if($newCurrentURL == 'admin/couponAdd' || $newCurrentURL == 'admin/couponList/0'|| $newCurrentURL == 'admin/couponList/1') style="display:block" @endif>

                        <li  @if($newCurrentURL == 'admin/couponAdd') class="act_item" @endif>
                            <a href="{{ url('admin/couponAdd') }}" >Add Coupon</a>
                        </li>

                        <li  @if($newCurrentURL == 'admin/couponList/1') class="act_item" @endif>
                            <a href="{{ url('admin/couponList/'.STATUS_ACTIVE) }}" >Active Coupon</a>
                        </li>
                        
                        <li  @if($newCurrentURL == 'admin/couponList/0') class="act_item" @endif>
                            <a href="{{ url('admin/couponList/'.STATUS_INACTIVE) }}" >In Active Coupon</a>
                        </li>
                    </ul>
                </li>

                <li title="Offer Listing"  @if($newCurrentURL == 'admin/offerAdd' || $newCurrentURL == 'admin/offerList/0'|| $newCurrentURL == 'admin/offerList/1') class="submenu_trigger current_section act_section" @endif >
                    <a href="#">
                        <img class="stroke-icon" src="{{asset('custom-images/icons/discount.png')}}" style="height: 25px;">&nbsp;
                        <span class="menu_title" >Offer Listing</span>
                    </a>
                    <ul @if($newCurrentURL == 'admin/offerAdd' || $newCurrentURL == 'admin/offerList/0'|| $newCurrentURL == 'admin/offerList/1') style="display:block" @endif>

                        <li @if($newCurrentURL == 'admin/offerAdd') class="act_item" @endif>
                            <a href="{{ url('admin/offerAdd') }}" >Add Offer</a>
                        </li>

                        <li @if($newCurrentURL == 'admin/offerList/1') class="act_item" @endif>
                            <a href="{{ url('admin/offerList/'.STATUS_ACTIVE) }}" >Active Offer</a>
                        </li>

                        <li @if($newCurrentURL == 'admin/offerList/0') class="act_item" @endif>
                            <a href="{{ url('admin/offerList/'.STATUS_INACTIVE) }}" >In Active Offer</a>
                        </li>
                    </ul>
                </li> --}}
              
                

               

               
            </ul>
        </div>
    </aside><!-- main sidebar end -->
    <div id="page_content">
