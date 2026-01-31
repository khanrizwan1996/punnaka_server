@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

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
                        <h2>{{ Route::input('country') }} Business List</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ Route::input('city') }} / {{ Route::input('category') }}</li>
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
                        @foreach ($businessLisitngCategoryArray as $businessLisitngCategoryData)
                            @php

                            $imagePathObj = new App\Http\Controllers\frontend\businessListingController();
                            $imagePath = $imagePathObj->GetBusinessImage($businessLisitngCategoryData['bus_id']);

                            $businessCityName = str_replace(' ', '-', $businessLisitngCategoryData['bus_city']);
                            $businessCategoryName = str_replace(' ', '-', $businessLisitngCategoryData['bus_sub_cat']);
                            $businessName = str_replace(' ', '-', $businessLisitngCategoryData['bus_name']);
                            @endphp

                            <div class="col-lg-6 col-md-12">
                                <a href="{{url('detail/'.$businessCityName.'/'.$businessCategoryName.'/'.$businessName)}}"  data-marker-id="1">
                                    <div class="utf_listing_item">
                                      <img src="{{ url('custom-images/business-images/images/' . $imagePath) }}"
                                            alt="">

                                        <div class="utf_listing_item_content">
                                             <div class="utf_listing_prige_block">
                                                <span class="utf_meta_listing_price"><i class="fa fa-phone"></i>
                                                    {{ $businessLisitngCategoryData['bus_contact_no'] }}</span>
                                            </div>
                                            <h3>{{ $businessLisitngCategoryData['bus_name'] }}</h3>
                                            <span><i class="fa fa-envelope"></i> Business Email :
                                                {{ $businessLisitngCategoryData['bus_email'] }}</span>
                                            <span><i class="fa fa-map-marker"></i> Location (State) :
                                                {{ Str::substr($businessLisitngCategoryData['bus_state'], 0, 10) }}</span>
                                            <span><i class="fa fa-phone"></i> Location (City) :
                                                {{ Str::substr($businessLisitngCategoryData['bus_city'], 0, 10) }}</span>
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
                            @php
                                $latestBusinessListingObj = new App\Http\Controllers\frontend\businessListingController();
                                $latestBusinessListing = $latestBusinessListingObj->getLatestBusinessListing(Route::input('city'));
                            @endphp
                            <h3><i class="sl sl-icon-folder-alt"></i>{{ str_replace(' ', '-', Route::input('city') )}} Categories</h3>
                            <ul class="utf_listing_detail_sidebar">
                                @foreach ($latestBusinessListing as $latestBusinessListingRow)
                                    @php
                                        $latestBusinessCityName = str_replace(' ', '-', $latestBusinessListingRow['bus_city']);
                                        $latestBusinessCategoryName = str_replace(' ', '-', $latestBusinessListingRow['bus_sub_cat']);
                                    @endphp
                                    <li><i class="fa fa-angle-double-right"></i> <a href="{{ url('category/'.$latestBusinessCityName.'/'.$latestBusinessCategoryName) }}">{{ $latestBusinessListingRow->bus_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
