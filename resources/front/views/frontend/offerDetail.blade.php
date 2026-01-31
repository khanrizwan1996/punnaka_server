@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ $offerSingleData->offer_meta_title}}</title>
    <meta name="description"
        content="{{ $offerSingleData->offer_meta_keyword}}" />
    <meta name="keywords"
        content="{{ $offerSingleData->offer_meta_description}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    @section('main-container')
    @php
    $cityName = substr(Route::input('city'),9);
    $mallName = str_replace('-', ' ',Route::input('mall_name'));
    $newTitle = str_replace('-', ' ',Route::input('title'));
    @endphp
        <div id="titlebar" style="margin-bottom:40px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="color:black">Offer Detail ({{ $newTitle }})</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li style="color:black"><a href="{{ url('home') }}">Home</a></li>
                                <li>{{ $cityName }} / {{ $mallName }}</li>
                                <li style="color:black">Offer Detail</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="container">
            <div class="row utf_sticky_main_wrapper">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ url('custom-images/offers/' . $offerSingleData->offer_image) }}" style="height: 300px">
                </div>
                <div class="col-lg-8 col-md-8" style="font-size: 17px">
                    @php
                        $startDateTime = date('j F Y h:i:s', strtotime($offerSingleData->offer_start_date." ".$offerSingleData->offer_start_time));
                        $endDateTime = date('j F Y h:i:s', strtotime($offerSingleData->offer_end_date." ".$offerSingleData->offer_end_time));

                    @endphp
                    <h2>{{ $offerSingleData->offer_title }}</h2>

                    <span><i class="fa fa-cubes" style="color: #3fb4e4"></i> Main Category: {{ $offerSingleData->offer_main_category }}
                    </span><br>

                    <span><i class="fa fa-list-alt" style="color: #3fb4e4"></i> Sub Category: {{ $offerSingleData->offer_sub_category }}
                    </span><br>

                    <span><i class="fa fa-shopping-cart" style="color: #3fb4e4"></i> Mall Name: {{ $offerSingleData->mall_name }}
                    </span><br>

                    <span><i class="fa fa-inbox" style="color: #3fb4e4"></i> Brand Name: {{ $offerSingleData->brand_name }}
                    </span><br>

                    <span><i class="fa fa-flag" style="color: #3fb4e4"></i> Location (Country): {{ $offerSingleData->offer_country }}
                    </span><br>

                    <span><i class="fa fa-map-marker" style="color: #3fb4e4"></i> Location (State): {{ $offerSingleData->offer_state }}
                    </span><br>

                    <span><i class="fa fa-building-o" style="color: #3fb4e4"></i> Location (City): {{ $offerSingleData->offer_city }}
                    </span><br>

                    <span><i class="fa fa-clock-o" style="color: #3fb4e4"></i> Start Date Time: {{ $startDateTime }}</span><br>
                    <span><i class="fa fa-calendar" style="color: #3fb4e4"></i> End Date Time: {{ $endDateTime }}</span><br>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div id="utf_listing_overview" class="utf_listing_section">
                        <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Offer Details</h3>
                        <p>{!! $offerSingleData->offer_detail !!}</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
