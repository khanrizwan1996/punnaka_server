@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Mall info | Malls in India | Free Business Listing Directory</title>
<meta name="description" content="Free Local Business Listing Directory Site in India. Check out information of Top Malls in India. Offers Services of Digital Marketing, Web & Mobile Development, E-Commerce solutions" />
<meta name="keywords" content="shopping malls in pune, shopping malls in mumbai, shopping malls in navi mumbai, shopping malls in thane, shopping malls in hyderabad, shopping malls in delhi, shopping malls in noida, shopping malls in ghaziabad, shopping malls in bengaluru, shopping malls in chennai, malls offer, malls market, mallsmarket, malls gurgaon,malls in mumbai,malls india,malls hyderabad,mumbai mall,mall in chennai,gurgaon mall,shopping mall chennai,chennai mall,malls pune,pune mall,india's biggest mall,malls in bangalore,hyerabad shopping mall,best mall of delhi,shopping mall delhi,biggest mall in india,mumbai shopping mall,india biggest mall,new delhi mall,shopping new delhi malls,shopping mall bangalore,the biggest shopping mall india,shopping malls in pune,best mall in mumbai,largest malls of india,shopping malls in india,india shopping mall,malls in hyderabad india,shopping bangalore,shopping mall india,new delhi shopping mall,popular malls in delhi,best shopping mall in delhi,malls in east delhi,top mall in delhi,pune shopping malls,best mall bangalore,mall near me,shopping mall near me,nearby mall,nearest mall,pune best mall,biggest mall in pune,pune mall list,malls of pune,punnaka, punaka." />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="Punnaka">
@section('main-container')
@php
  $cityName = substr(Route::input('city'),9);
  $mallName = str_replace('-', ' ',Route::input('mall_name'))
@endphp
  <div id="titlebar" class="gradient">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h2>{{ $cityName }} - Offer List</h2>
          <!-- Breadcrumbs -->
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{url('/')}}">Home</a></li>
              <li>{{ $cityName }} / {{ $mallName }}</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
       <!-- Sidebar -->
       <div class="col-lg-4 col-md-4">
        <div class="sidebar">
          <div class="utf_box_widget margin-top-35 margin-bottom-75">
            <h3><i class="sl sl-icon-folder-alt"></i> Recent {{ $cityName }} City Offer </h3>
            <ul class="utf_listing_detail_sidebar">
                @foreach ($recentCityWiseOfferData as $recentCityWiseOfferRow)
                @php
                    $offerCityName = str_replace(' ', '-', $recentCityWiseOfferRow->offer_city);
                    $offerTitle = str_replace(' ', '-', $recentCityWiseOfferRow->offer_title);
                @endphp
              <li><i class="fa fa-angle-double-right"></i> <a href="{{url('blog-list/'.$offerCityName.'/'.$offerTitle)}}">{{$recentCityWiseOfferRow->offer_title}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

       <div class="col-lg-8 col-md-8 listing_grid_item">
        <div class="row">
            @foreach ($offerCityWiseMallData as $offerCityWiseMallRow)
            @php
                $offerCity = str_replace(' ', '-', $offerCityWiseMallRow->offer_city);
                $mallName = str_replace(' ', '-', $offerCityWiseMallRow->mall_name);
                $offerTitle = str_replace(' ', '-', $offerCityWiseMallRow->offer_title);

                $startDateTime = date('j F Y h:i:s', strtotime($offerCityWiseMallRow->offer_start_date." ".$offerCityWiseMallRow->offer_start_time));
                $endDateTime = date('j F Y h:i:s', strtotime($offerCityWiseMallRow->offer_end_date." ".$offerCityWiseMallRow->offer_end_time));
            @endphp
                <div class="col-lg-6 col-md-6">
                    <a href="{{url('offer-detail/Malls-in-'.$offerCity.'/'.$mallName.'/'.$offerTitle)}}" class="utf_listing_item-container" data-marker-id="1">
                    <div class="utf_listing_item">
                        <img src="{{asset('custom-images/offers/'.$offerCityWiseMallRow->offer_image.'')}}" alt="">
                        <div class="utf_listing_item_content">
                            <h3>{{ $offerCityWiseMallRow->offer_title }}</h3>
                            <span> <i class="fa fa-list-alt" aria-hidden="true"></i> Main Category: {{ $offerCityWiseMallRow->offer_main_category }}</span>
                            <span> <i class="fa fa-calendar"></i> Start Date Time: {{ $startDateTime }}</span>
                            <span> <i class="fa fa-calendar"></i> End Date Time: {{ $endDateTime }}</span>
                            <span> <i class="fa fa-map-marker"></i> Location (City): {{ $offerCityWiseMallRow->offer_city }}</span>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
@endsection
