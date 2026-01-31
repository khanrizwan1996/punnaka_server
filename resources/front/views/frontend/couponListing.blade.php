@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">
@php

   $couponType = str_replace(' ', '-', ucwords(str_replace('-', ' ', Route::input('type'))));
    if($couponType == 'Coupon-Promo-Code'){
        $newCouponType = 'Coupon / Promo Code';
    }else if($couponType == 'Offer-Deal'){
        $newCouponType = 'Offer / Deal';
    }else if($couponType == 'Free-Sample'){
        $newCouponType = 'Free Sample';
    }else if($couponType == 'Free-Recharge-Coupon'){
        $newCouponType = 'Free Recharge Coupon';
    }
@endphp
<head>
    <title>Mall info | Malls in India | Free Business Listing Directory</title>
    <meta name="description"
        content="Free Local Business Listing Directory Site in India. Check out information of Top Malls in India. Offers Services of Digital Marketing, Web & Mobile Development, E-Commerce solutions" />
    <meta name="keywords"
        content="shopping malls in pune, shopping malls in mumbai, shopping malls in navi mumbai, shopping malls in thane, shopping malls in hyderabad, shopping malls in delhi, shopping malls in noida, shopping malls in ghaziabad, shopping malls in bengaluru, shopping malls in chennai, malls offer, malls market, mallsmarket, malls gurgaon,malls in mumbai,malls india,malls hyderabad,mumbai mall,mall in chennai,gurgaon mall,shopping mall chennai,chennai mall,malls pune,pune mall,india's biggest mall,malls in bangalore,hyerabad shopping mall,best mall of delhi,shopping mall delhi,biggest mall in india,mumbai shopping mall,india biggest mall,new delhi mall,shopping new delhi malls,shopping mall bangalore,the biggest shopping mall india,shopping malls in pune,best mall in mumbai,largest malls of india,shopping malls in india,india shopping mall,malls in hyderabad india,shopping bangalore,shopping mall india,new delhi shopping mall,popular malls in delhi,best shopping mall in delhi,malls in east delhi,top mall in delhi,pune shopping malls,best mall bangalore,mall near me,shopping mall near me,nearby mall,nearest mall,pune best mall,biggest mall in pune,pune mall list,malls of pune,punnaka, punaka." />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    @section('main-container')
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ $newCouponType }} List</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $newCouponType }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 listing_grid_item">
                    <div class="row">
                        @foreach ($getCouponTypeLisitng as $getCouponTypeLisitngRow)
                            @php
                            $couponTitle = strtolower(urlencode(str_replace(' ', '-', $getCouponTypeLisitngRow['cf_title'])));
                            //$couponTitle = str_replace(' ', '-', $getCouponTypeLisitngRow['cf_title']);
                            $couponCategoryName = strtolower(str_replace(' ', '-', $getCouponTypeLisitngRow['cf_sub_cat']));
                            $couponCity = strtolower(str_replace(' ', '-', $getCouponTypeLisitngRow['cf_city']));
                            @endphp

                            <div class="col-lg-6 col-md-12">
                                <a href="{{url('coupon/'.$couponCity.'/'.$couponCategoryName.'/'.$couponTitle)}}"  data-marker-id="1">
                                    <div class="utf_listing_item">
                                      <img src="{{ url('custom-images/coupon-offer/'. $getCouponTypeLisitngRow['cf_store_logo']) }}"
                                            alt="">

                                        <div class="utf_listing_item_content">
                                             <div class="utf_listing_prige_block">
                                                <span class="utf_meta_listing_price">{{ $getCouponTypeLisitngRow['cf_main_cat'] }}</span>
                                            </div>
                                            <h3>{{ $getCouponTypeLisitngRow['cf_title'] }}</h3>
                                            <span>Location (City) :
                                                {{ Str::substr($getCouponTypeLisitngRow['cf_city'], 0, 10) }}</span>
                                                <span>{{ Str::substr($getCouponTypeLisitngRow['cf_short_tagline'], 0, 50) }}</span>
                                            </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <div class="utf_box_widget margin-top-35 margin-bottom-75">
                        
                            <h3 style="font-size: 16px;"><i class="sl sl-icon-folder-alt"></i>Latest {{ $newCouponType }} List</h3>
                            <ul class="utf_listing_detail_sidebar">
                                @foreach ($getLatestCouponOfferListing as $getLatestCouponOfferListingRow)
                                    @php
                                    $latestCouponTitle = strtolower(urlencode(str_replace(' ', '-', $getCouponTypeLisitngRow['cf_title'])));
                                    $latestCouponCategoryName = strtolower(str_replace(' ', '-', $getLatestCouponOfferListingRow['cf_sub_cat']));
                                    $latestCouponCity = strtolower(str_replace(' ', '-', $getLatestCouponOfferListingRow['cf_city']));
                                    @endphp
                                    <li><i class="fa fa-angle-double-right"></i> <a href="{{ url('coupon/'.$latestCouponCity.'/'.$latestCouponCategoryName.'/'.$latestCouponTitle) }}">{{ $getLatestCouponOfferListingRow->cf_title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
