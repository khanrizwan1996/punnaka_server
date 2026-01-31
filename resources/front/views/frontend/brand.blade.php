@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Mall info | Malls in India | {{ $brandSingleData['brand_meta_title'] }}</title>
    <meta name="description"
        content="{{ $brandSingleData['brand_meta_keyword'] }}" />
    <meta name="keywords"
        content="{{ $brandSingleData['brand_meta_description'] }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    @section('main-container')

        <div id="titlebar" style="margin-bottom:40px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="color:black">Brand Detail ({{ $brandSingleData['brand_name'] }})</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li style="color:black"><a href="{{ url('home') }}">Home</a></li>
                                <li style="color:black">Mall Detail</li>
                                <li style="color:black">{{ $brandSingleData['mall_name'] }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        @if (count($brandmagesArray) > 0)
            <div id="utf_listing_gallery_part" class="utf_listing_section">
                <div class="utf_listing_slider utf_gallery_container margin-bottom-0">
                    @foreach ($brandmagesArray as $brandmagesRow)
                        <a href="{{ url('custom-images/mall-multiple-images/' . $brandmagesRow->brand_img_path) }}"
                            data-background-image="{{ url('custom-images/brand-multiple-images/' . $brandmagesRow->brand_img_path) }}"
                            class="item utf_gallery"></a>
                    @endforeach

                </div>
            </div>
            <br><br>
        @endif

        <div class="container">
            <div class="row utf_sticky_main_wrapper">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ url('custom-images/brand/' . $brandSingleData['brand_logo']) }}" style="height: 250px">
                </div>
                <div class="col-lg-8 col-md-8">

                    <h2>{{ $brandSingleData['brand_name'] }}</h2>
                    
                    @if (!empty($brandSingleData['brand_email'])) 
                        <span><i class="fa fa-envelope" style="color: #3fb4e4"></i> Email Id:
                        {{ $brandSingleData['brand_email'] }}</span><br>
                    @endif
                    
                    @if (!empty($brandSingleData['brand_contact_no'])) 
                        <span><i class="fa fa-phone" style="color: #3fb4e4"></i> Contact No:
                        {{ $brandSingleData['brand_contact_no'] }}</span><br>
                    @endif
                        
                    @if (!empty($brandSingleData['brand_location'])) 
                        <span><i class="fa fa-map-marker" style="color: #3fb4e4"></i> Location:
                        {{ $brandSingleData['brand_location'] }}</span><br>
                    @endif

                    @if (!empty($brandSingleData['brand_store_type'])) 
                        <span><i class="fa fa-building-o" style="color: #3fb4e4"></i> Store Type:
                        {{ $brandSingleData['brand_store_type'] }}</span><br>
                    @endif
                    
                    @if (!empty($brandSingleData['brand_prodct_services'])) 
                        <span><i class="fa fa-building-o" style="color: #3fb4e4"></i> Products / Services:
                        {{ $brandSingleData['brand_prodct_services'] }}</span><br>
                    @endif

                    @if (!empty($brandSingleData['brand_store_timings'])) 
                        <span><i class="fa fa-clock-o" style="color: #3fb4e4"></i> Store Timings:
                        {{ $brandSingleData['brand_store_timings'] }}</span>
                    @endif

                </div>
                <div class="col-lg-12 col-md-12">
                    <div id="utf_listing_overview" class="utf_listing_section">
                        <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Brand Details</h3>
                        <p>{!! $brandSingleData['brand_desc'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
