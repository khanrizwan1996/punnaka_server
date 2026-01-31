
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Punnaka">
    <meta name="keywords" content="Punnaka">
    <meta name="author" content="pixelstrap">
    <title>Punnaka | User Dashboard</title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{url('frontend/images/new-logo-fav-icon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('frontend/images/new-logo-fav-icon.png')}}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <!-- Font awesome icon css -->
    <link rel="stylesheet" href="{{asset('user_admin/assets/css/vendors/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_admin/assets/css/vendors/@fortawesome/fontawesome-free/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('user_admin/assets/css/vendors/@fortawesome/fontawesome-free/css/brands.css')}}">
    <link rel="stylesheet" href="{{asset('user_admin/assets/css/vendors/@fortawesome/fontawesome-free/css/solid.css')}}">
    <link rel="stylesheet" href="{{asset('user_admin/assets/css/vendors/@fortawesome/fontawesome-free/css/regular.css')}}">
    <!-- Ico Icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/@icon/icofont/icofont.css')}}">
    <!-- Flag Icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/flag-icon.css')}}">
    <!-- Themify Icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/themify-icons/themify-icons/css/themify.css')}}">
    <!-- Animation css -->
    <link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/animate.css/animate.css')}}">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/weather-icons/css/weather-icons.min.css')}}">
  
    <link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/simple-datatables/dist/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/scrollbar.css')}}">
    <!-- App css-->
    <link rel="stylesheet" href="{{asset('user_admin/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('user_admin/assets/css/color-1.css')}}" media="screen">
    
    @php
    $checkUserPaymentCountObj = new App\Http\Controllers\user_admin\userBusinessListingController();
    $checkUserFranchiseListingCountObj = new App\Http\Controllers\user_admin\userFranchiseController();
    $checkUserCouponAndOfferCountObj = new App\Http\Controllers\user_admin\userCouponAndOfferController();
    $checkUserProductAndServiceCountObj = new App\Http\Controllers\user_admin\userProductAndServiceController();

    $checkBusinesListingPaymentCount = $checkUserPaymentCountObj->checkBusinesListingPaymentCount();
    $checkFranchisePaymentCount = $checkUserPaymentCountObj->checkFranchisePaymentCount();
    $checkCouponAndOfferPaymentCount = $checkUserPaymentCountObj->checkCouponAndOfferPaymentCount();
    $checkProductAndServicePaymentCount = $checkUserPaymentCountObj->checkProductAndServicePaymentCount();

    $checkBusinessListingCount = $checkUserPaymentCountObj->checkBusinessListingCount();
    $checkFranchiseListingCount = $checkUserFranchiseListingCountObj->checkFranchiseListingCount();
    $checkCouponAndOfferCount = $checkUserCouponAndOfferCountObj->checkCouponAndOfferCount();
    $checkProductServiceCount = $checkUserProductAndServiceCountObj->checkProductServiceCount();

    if($checkBusinesListingPaymentCount == 0){
      $businessListingUrl = '../business-listing';
    }else{
      if($checkBusinessListingCount == $checkBusinesListingPaymentCount){
        $businessListingUrl = '../business-listing'; 
      }else{
        session(['planType' => 'BL']);
        $businessListingUrl = '../add-business-details'; 
      }
    }

    if($checkFranchisePaymentCount == 0){
      $franchiseListingUrl = '../business-listing'; 
    }else{
      if($checkFranchiseListingCount == $checkFranchisePaymentCount){
        $franchiseListingUrl = '../business-listing'; 
      }else{
        session(['planType' => 'FL']);
        $franchiseListingUrl = USER_ADMIN_URL.'franchiseAdd'; 
      }
    }

    if($checkCouponAndOfferPaymentCount == 0){
      $couponOfferUrl = '../business-listing';  
    }else{
      if($checkCouponAndOfferCount == $checkCouponAndOfferPaymentCount){
        $couponOfferUrl = '../business-listing'; 
      }else{
        session(['planType' => 'OCFL']);
        $couponOfferUrl = USER_ADMIN_URL.'couponOfferAdd'; 
      }
    }

    if($checkProductAndServicePaymentCount == 0){
      $productServiceUrl = '../business-listing';
    }else{
      if($checkProductServiceCount == $checkProductAndServicePaymentCount){
        $productServiceUrl = '../business-listing'; 
      }else{
        session(['planType' => 'PSL']);
        $productServiceUrl = USER_ADMIN_URL.'productServiceAdd'; 
      }
    }
    @endphp
  </head>
  <body> 
    <main class="page-wrapper compact-wrapper" id="pageWrapper">
      <header class="page-header row">
        <div class="logo-wrapper d-flex align-items-center col-auto"><a href="{{url(USER_ADMIN_URL.'dashboard')}}"><img class="for-light" src="{{url('frontend/images/new-logo.png')}}" style="height: 45px" alt="logo"><img class="for-dark" src="{{url('frontend/images/new-logo.png')}}" alt="logo"></a><a class="close-btn" href="javascript:void(0)">
            <div class="toggle-sidebar">
              <div class="line"></div>
              <div class="line"></div>
              <div class="line"></div>
            </div></a></div>
            <div class="page-main-header col">
          <div class="header-left d-lg-block d-none">
            <br>
             <h3 style="color: #3fb4e4; font-weight: bold;">Dashboard &nbsp;&nbsp; | </h3>
          </div>
          <div class="nav-right">
            <ul class="header-right">
              <li class="profile-dropdown custom-dropdown">
                <div class="d-flex align-items-center">
                  <img src="{{asset('user_admin/assets/images/profile.png')}}" alt="">
                  <div class="flex-grow-1"> 
                    <h5>{{ Str::substr(Auth::user()->name, 0, 20) }}</h5>
                    <span>{{ Str::substr(Auth::user()->email, 0, 20) }}</span>
                    <br>
                    <a style="font-size: 12px; font-weight: bold; color: red;" class="sidebar-link" href="{{url('userLogout')}}">
                    Logout
                  </a>
                  </div>
                </div>
                <div class="custom-menu overflow-hidden">
                  <ul> 
                    <li class="d-flex"> 
                      
                      <a class="ms-2" href="#">Dashboard</a>
                    </li>
                    <li class="d-flex"> 
                      <a class="ms-2" href="#">Log Out</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </header>
      <!-- Page header end-->
      <div class="page-body-wrapper">
        <!-- Page sidebar start-->
        <div class="overlay"></div>
        <aside class="page-sidebar" data-sidebar-layout="stroke-svg">
          {{-- <div class="left-arrow" id="left-arrow">
            <svg class="feather">
              <use href="http://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-left"></use>
            </svg>
          </div> --}}
          <div id="sidebar-menu">
            <ul class="sidebar-menu" id="simple-bar">
              <li class="pin-title sidebar-list p-0">
                <h5 class="sidebar-main-title">Pinned</h5>
              </li>
              <li class="line pin-line"></li>
              
              <li class="sidebar-list"> 
                <a class="sidebar-link" href="{{url(USER_ADMIN_URL.'dashboard')}}">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/home.png')}}" style="height: 20px;"><span>Dashboard</span></a>
              </li>
             
              <li class="sidebar-list"> 
                <a class="sidebar-link" href="javascript:void(0)">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/timeline.png')}}" style="height: 20px;"><span>Business Listing</span>
                 
                  <svg class="feather">
                    <img src="{{asset('custom-images/drop.png')}}" style="height: 22px;">
                  </svg></a>
                <ul class="sidebar-submenu"> 

                  <li><a href="{{url($businessListingUrl)}}" style="color:black"><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Business</a></li>

                   <li><a href="{{url(USER_ADMIN_URL.'businessListing')}}" style="color:black"><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Business Listing Details</a></li>
                    

                    {{-- <li><a href="{{url(USER_ADMIN_URL.'checkPlanPurchaseStatus/Priority')}}" style="color:black"> <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Basic Listing</a></li>
                    <li><a href="{{url(USER_ADMIN_URL.'checkPlanPurchaseStatus/SEO Optimize')}}" style="color:black"><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add SEO Optimize Listing</a></li>
                     <li><a href="{{url(USER_ADMIN_URL.'checkPlanPurchaseStatus/Premium')}}" style="color:black"><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Premium Listing</a></li>
                     <li><a href="{{url(USER_ADMIN_URL.'businessListing/0')}}" style="color:black"><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  In Active Listing</a></li>
                     <li><a href="{{url(USER_ADMIN_URL.'businessListing/1')}}" style="color:black"><img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Active Listing</a></li> --}}
                </ul>
              </li>  


            
              <li class="sidebar-list"> 
                <a class="sidebar-link" href="javascript:void(0)">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/franchise.png')}}" style="height: 20px;"><span>Franchise</span>
                 
                  <svg class="feather">
                    <img src="{{asset('custom-images/drop.png')}}" style="height: 22px;">
                  </svg></a>
                <ul class="sidebar-submenu"> 
                  <li>
                    <a href="{{url($franchiseListingUrl)}}"> 
                      <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Franchise
                    </a>
                  </li>
                  
                  <li><a href="{{url(USER_ADMIN_URL.'franchiseList')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Franchise Listing Details</a>
                  </li>
                  {{-- <li><a href="{{url(USER_ADMIN_URL.'franchiseList/0')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  In Active franchise</a></li>
                  <li><a href="{{url(USER_ADMIN_URL.'franchiseList/1')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Active franchise</a></li> --}}
                </ul>
              </li>  

              <li class="sidebar-list"> 
                <a class="sidebar-link" href="javascript:void(0)">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/discount.png')}}" style="height: 20px;"><span>Coupon & Offers</span>
                 
                  <svg class="feather">
                    <img src="{{asset('custom-images/drop.png')}}" style="height: 22px;">
                  </svg></a>
                <ul class="sidebar-submenu"> 
                  <li>

                    <a href="{{url($couponOfferUrl)}}"> 
                      <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Coupon & Offers
                    </a>

                  </li>
                  <li><a href="{{url(USER_ADMIN_URL.'couponOfferList')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Coupon & Offers Listing Details</a>
                  </li>
                  {{-- <li><a href="{{url(USER_ADMIN_URL.'offerList/0')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  In Active Offer</a></li>
                  <li><a href="{{url(USER_ADMIN_URL.'offerList/1')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Active Offer</a></li> --}}
                </ul>
              </li>  

{{--               
              <li class="sidebar-list"> 
                <a class="sidebar-link" href="javascript:void(0)">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/discount.png')}}" style="height: 20px;"><span>Offers</span>
                 
                  <svg class="feather">
                    <img src="{{asset('custom-images/drop.png')}}" style="height: 22px;">
                  </svg></a>
                <ul class="sidebar-submenu"> 
                  <li><a href="{{url(USER_ADMIN_URL.'offerAdd')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Offer</a>
                  </li>
                  <li><a href="{{url(USER_ADMIN_URL.'offerList')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Offer Listing Details</a>
                  </li>
                  {{-- <li><a href="{{url(USER_ADMIN_URL.'offerList/0')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  In Active Offer</a></li>
                  <li><a href="{{url(USER_ADMIN_URL.'offerList/1')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Active Offer</a></li> --}
                </ul>
              </li>  
              
              <li class="sidebar-list"> 
                <a class="sidebar-link" href="javascript:void(0)">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/coupon.png')}}" style="height: 20px;"><span>Coupons</span>
                 
                  <svg class="feather">
                    <img src="{{asset('custom-images/drop.png')}}" style="height: 22px;">
                  </svg></a>
                <ul class="sidebar-submenu"> 
                  <li><a href="{{url(USER_ADMIN_URL.'couponAdd')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Coupon</a>
                  </li>
                  <li>
                    <a href="{{url(USER_ADMIN_URL.'couponList')}}"> 
                      <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Coupons Listing Details
                    </a>
                  </li>

                  {{-- <li><a href="{{url(USER_ADMIN_URL.'couponList/0')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  In Active Coupon</a></li>
                  <li><a href="{{url(USER_ADMIN_URL.'couponList/1')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Active Coupon</a></li> --}
                </ul>
              </li>   --}}
              
                   <li class="sidebar-list"> 
                <a class="sidebar-link" href="javascript:void(0)">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/ps.png')}}" style="height: 20px;"><span>Product & Service</span>
                 
                  <svg class="feather">
                    <img src="{{asset('custom-images/drop.png')}}" style="height: 22px;">
                  </svg></a>
                <ul class="sidebar-submenu"> 
                  <li><a href="{{url($productServiceUrl)}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Add Product & Service</a>
                  </li>
                  <li><a href="{{url(USER_ADMIN_URL.'productServiceList')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Product & Service Listing</a>
                  </li>
                  {{-- <li><a href="{{url(USER_ADMIN_URL.'offerList/0')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  In Active Offer</a></li>
                  <li><a href="{{url(USER_ADMIN_URL.'offerList/1')}}"> 
                    <img class="stroke-icon" src="{{asset('custom-images/icons/circle.png')}}" style="height: 14px;">&nbsp;  Active Offer</a></li> --}}
                </ul>
              </li>  

              <li class="sidebar-list"> 
                <a class="sidebar-link" href="{{url(USER_ADMIN_URL.'paymentHistory')}}">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/payment.png')}}" style="height: 20px;"><span>Payment History</span></a>
              </li>

              <li class="sidebar-list"> 
                <a class="sidebar-link" href="{{url(USER_ADMIN_URL.'profileEdit')}}">
                  <img class="stroke-icon" src="{{asset('custom-images/icons/profile-edit.png')}}" style="height: 20px;"><span>Settings</span></a>
              </li>
              <br>
              <li class="sidebar-list"> 
                <a class="sidebar-link btn btn-primary btn-block" href="{{url('/')}}" target="_blank" >
                  <span style="color: white">Go to Homepage</span><img class="stroke-icon" src="{{asset('custom-images/icons/external-link.png')}}" style="height: 15px;margin-top: 4px;"></a>
              </li>
            </ul>
          </div>
        </aside>
        <!-- Page sidebar end-->
