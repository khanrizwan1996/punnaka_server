
<!DOCTYPE html>
<html lang="zxx">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mall info | Malls in India | Free Business Listing Directory</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Free Local Business Listing Directory Site in India. Check out information of Top Malls in India. Offers Services of Digital Marketing, Web & Mobile Development, E-Commerce solutions" />
<meta name="keywords" content="shopping malls in pune, shopping malls in mumbai, shopping malls in navi mumbai, shopping malls in thane, shopping malls in hyderabad, shopping malls in delhi, shopping malls in noida, shopping malls in ghaziabad, shopping malls in bengaluru, shopping malls in chennai, malls offer, malls market, mallsmarket, malls gurgaon,malls in mumbai,malls india,malls hyderabad,mumbai mall,mall in chennai,gurgaon mall,shopping mall chennai,chennai mall,malls pune,pune mall,india's biggest mall,malls in bangalore,hyerabad shopping mall,best mall of delhi,shopping mall delhi,biggest mall in india,mumbai shopping mall,india biggest mall,new delhi mall,shopping new delhi malls,shopping mall bangalore,the biggest shopping mall india,shopping malls in pune,best mall in mumbai,largest malls of india,shopping malls in india,india shopping mall,malls in hyderabad india,shopping bangalore,shopping mall india,new delhi shopping mall,popular malls in delhi,best shopping mall in delhi,malls in east delhi,top mall in delhi,pune shopping malls,best mall bangalore,mall near me,shopping mall near me,nearby mall,nearest mall,pune best mall,biggest mall in pune,pune mall list,malls of pune,punnaka, punaka." />
<meta name="author" content="Punnaka">

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.png">
<!-- Style CSS -->
<link rel="stylesheet" href="{{url('frontend/css/stylesheet.css')}}">
<link rel="stylesheet" href="{{url('frontend/css/mmenu.css')}}">
<link rel="stylesheet" href="{{url('frontend/css/perfect-scrollbar.css')}}">
<link rel="stylesheet" href="{{url('frontend/css/style.css')}}" id="colors">
<link rel="stylesheet" href="{{url('frontend/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('frontend/css/bootstrap-tagsinput.css')}}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&amp;display=swap&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">

@if (!isset(Auth::user()->id))
<script LANGUAGE='JavaScript'>
    window.alert('Please Login First');
    window.location.href = '/login';
</script>
@endif

<style>
    .activeUrl{
        font-weight: 500;
        color: #000 !important;
        /* color: #3fb4e4 !important; */
        /* text-decoration: underline; */
    }
    .activeStatus{
        padding: 2px 7px;
        border-radius: 4px;
        display: inline;
        /* font-size: 12px; */
        font-weight: 700;
        color: #64bc36;
        margin-left: 2px;
        top: -1px;
        position: relative;
    }

    .inActiveStatus{
        padding: 2px 7px;
        border-radius: 4px;
        display: inline;
        /* font-size: 12px; */
        font-weight: 700;
        color: #ee3535;
        margin-left: 2px;
        top: -1px;
        position: relative;
    }
    .dropbtn {
      background-color: #4CAF50;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown:hover .dropbtn {
      background-color: #3e8e41;
    }
    </style>
@php
$url = Request::path();
@endphp
</head>
<body>

<!-- Wrapper -->
<div id="main_wrapper">
  {{-- <header id="header_part" class="fixed fullwidth_block dashboard">
    <div id="header" class="not-sticky">
      <div class="container">
        <div class="utf_left_side">
          <div id="logo"> <a href="{{url('/')}}"><img src="frontend/images/new-logo.png" alt=""></a> <a href="{{url('/')}}" class="dashboard-logo"><img src="{{asset('custom-images/new-logo.jpg')}}" style="width:140px" alt=""></a> </div>
          <div class="mmenu-trigger">
			<button class="hamburger utfbutton_collapse" type="button">
				<span class="utf_inner_button_box">
					<span class="utf_inner_section"></span>
				</span>
			</button>
		  </div>
          <nav id="navigation" class="style_one">
            <ul id="responsive">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">Find Business</a>
                  <ul>
                    @foreach ($businessListingHeaderMenu as $businessListingHeaderMenuData)
                    @php
                    $newBusinessListingCountry = str_replace(' ', '-',$businessListingHeaderMenuData['bus_country']);
                    @endphp
                    <li><a href="{{url('business-list/'.$newBusinessListingCountry)}}">{{$businessListingHeaderMenuData['bus_country']}}</a></li>
                    @endforeach
                  </ul>
                </li>
                <li><a href="{{url('business-listing')}}">Add Business</a></li>
                <li><a href="{{url('our-services')}}">Services</a></li>
                <li><a href="#">Mall</a>
                  <ul>
                    @foreach ($mallCityHeaderMenu as $mallCityHeaderMenuData)
                      <li><a href="#">{{$mallCityHeaderMenuData->mall_city}}</a>

                        @php
                        $mallControllerObj = new App\Http\Controllers\frontend\mallController();
                        $cityWiseMallDataHeaderMenu = $mallControllerObj->cityWiseMallDataHeaderMenu($mallCityHeaderMenuData->mall_city);
                        $newMallCity = str_replace(' ', '-',$mallCityHeaderMenuData->mall_city);
                        @endphp
                        <ul>
                          @foreach ($cityWiseMallDataHeaderMenu as $cityWiseMallDataHeaderMenuData)
                          @php
                            $newMallName = str_replace(' ', '-',$cityWiseMallDataHeaderMenuData->mall_name);
                          @endphp

                          <li><a href="{{url('detail-mall/Malls-in-'.$newMallCity.'/'.$newMallName)}}">{{$cityWiseMallDataHeaderMenuData->mall_name}}</a></li>
                          @endforeach
                        </ul>
                      </li>
                    @endforeach
                  </ul>
                </li>
                <li><a href="{{url('blogs')}}">Shopping Blogs</a></li>

                <li><a href="#">Blogs</a>
                  <ul>
                    @foreach ($blogCategoryHeaderMenu as $blogCategoryHeaderMenuData)
                    @php
                    $newBlogCatCountry = str_replace(' ', '-',$blogCategoryHeaderMenuData['blog_cat_country']);
                    @endphp
                    <li><a href="{{url('blog-list/'.$newBlogCatCountry.'/ALL')}}">{{$blogCategoryHeaderMenuData['blog_cat_country']}}</a></li>
                    @endforeach
                  </ul>
                </li>
              </ul>
          </nav>
          <div class="clearfix"></div>
        </div>
        <div class="utf_right_side">
          <div class="header_widget">
            <div class="utf_user_menu">
              <div class="utf_user_name"><span><img src="images/dashboard-avatar.jpg" alt=""></span>Hi, {{ Str::substr(Auth::user()->name, 0, 6) }}</div>
              <ul>
                <li><a href="{{url('profile')}}"><i class="sl sl-icon-user"></i> My Profile</a></li>
                <li><a href="{{url('logout')}}"><i class="sl sl-icon-power"></i> Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header> --}}
  <div class="clearfix"></div>
    <!-- Dashboard -->
    <div id="dashboard">
        {{-- <a href="#" class="utf_dashboard_nav_responsive"><i class="fa fa-reorder"></i> Dashboard Sidebar Menu</a> --}}
        <div class="utf_dashboard_navigation js-scrollbar">
          <div class="utf_dashboard_navigation_inner_block">
            <ul>
              <li @if($url == 'dashboard') class="active" @endif><a href="{{url('user-admin/dashboard')}}" style="color:black"><i class="sl sl-icon-layers"></i> Dashboard</a></li>

              {{-- <li @if($url == 'businessListing/0' || $url == 'businessListing/1' || $url == 'offerAdd') class="active" @endif>
                <a href="javascript:void(0)" style="color:black"><i class="sl sl-icon-layers"></i> Business Listing</a>
                <ul style="padding: 1px; margin-top:2px">
                    <li><a href="{{url('checkPlanPurchaseStatus/Priority')}}" style="color:black">Add Basic Listing</a></li>
                    <li><a href="{{url('checkPlanPurchaseStatus/SEO Optimize')}}" style="color:black">Add SEO Optimize Listing</a></li>
                     <li><a href="{{url('checkPlanPurchaseStatus/Premium')}}" style="color:black">Add Premium Listing</a></li>
                     <li @if($url == 'businessListing/0') class="active" @endif><a href="{{url('businessListing/0')}}" style="color:black">In Active Listing</a></li>
                     <li @if($url == 'businessListing/1') class="active" @endif><a href="{{url('businessListing/1')}}" style="color:black">Active Listing</a></li>
                </ul>
              </li>


              <li @if($url == 'paymentHistory') class="active" @endif><a href="{{url('paymentHistory')}}" style="color:black"><i class="sl sl-icon-user"></i> Payment History</a></li>


              <li @if($url == 'offerList/0' || $url == 'offerList/1' || $url == 'offerAdd') class="active" @endif>
                <a href="javascript:void(0)" style="color:black"><i class="sl sl-icon-layers"></i> Offers</a>
                <ul style="padding: 1px; margin-top:2px">
                    <li @if($url == 'offerAdd') class="active" @endif><a href="{{url('offerAdd')}}" style="color:black">Add Mall offers</a></li>
                    <li @if($url == 'offerList/0') class="active" @endif><a href="{{url('offerList/0')}}" style="color:black"> In Active Offer List</a></li>
                     <li @if($url == 'offerList/1') class="active" @endif><a href="{{url('offerList/1')}}" style="color:black"> Active Offer List</a></li>
                </ul>
              </li>

              <li @if($url == 'couponList/0' || $url == 'couponList/1' || $url == 'couponAdd') class="active" @endif>
                <a href="javascript:void(0)" style="color:black"><i class="sl sl-icon-layers"></i> Coupons</a>
                <ul style="padding: 1px; margin-top:2px">
                    <li @if($url == 'couponAdd') class="active" @endif><a href="{{url('couponAdd')}}" style="color:black"> Add Coupons</a></li>
                    <li @if($url == 'couponList/0') class="active" @endif><a href="{{url('couponList/0')}}" style="color:black"> In Active Coupon List</a></li>
                     <li @if($url == 'couponList/1') class="active" @endif><a href="{{url('couponList/1')}}" style="color:black"> Active Coupon List</a></li>
                </ul>
              </li>

              <li @if($url == 'franchiseList/0' || $url == 'franchiseList/1' || $url == 'franchiseAdd') class="active" @endif>
                <a href="javascript:void(0)" style="color:black"><i class="sl sl-icon-layers"></i> Franchise</a>
                <ul style="padding: 1px; margin-top:2px">
                    <li @if($url == 'franchiseAdd') class="active" @endif><a href="{{url('franchiseAdd')}}" style="color:black"> Add Franchise</a></li>
                    <li @if($url == 'franchiseList/0') class="active" @endif><a href="{{url('franchiseList/0')}}" style="color:black"> In Active Franchise List</a></li>
                     <li @if($url == 'franchiseList/1') class="active" @endif><a href="{{url('franchiseList/1')}}" style="color:black"> Active Franchise List</a></li>
                </ul>
              </li>


              <li  @if($url == 'profile') class="active" @endif><a href="{{url('profile')}}" style="color:black"><i class="sl sl-icon-user"></i> My Profile</a></li>
              <li  @if($url == 'userPasswordChange') class="active" @endif><a href="{{url('userPasswordChange')}}" style="color:black"><i class="sl sl-icon-key"></i> Change Password</a></li> --}}
              <li><a href="{{url('userLogout')}}" style="color:black"><i class="sl sl-icon-power"></i> Logout</a></li>
            </ul>
          </div>
        </div>
