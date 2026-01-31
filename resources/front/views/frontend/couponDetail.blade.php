@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">
{{-- @php use Illuminate\Support\Carbon; @endphp --}}

<head>
    {{-- <title>{{ $couponDetailRow['coupon_meta_title'] }}</title>
    <meta name="keywords" content="{{ $couponDetailRow['coupon_meta_keyword'] }}" />
    <meta name="description" content="{{ $couponDetailRow['coupon_meta_description'] }}" /> --}}

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom-css.css') }}">


    @section('main-container')
        <div class="clearfix"></div>
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Coupon Detail</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $couponDetail['cf_city'] . ' / ' . $couponDetail['cf_sub_cat'] . ' / ' . $couponDetail['cf_title'] }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <div class="container">
            <div class="row utf_sticky_main_wrapper">

                @if($couponDetail['cf_listing_type'] == 'Coupon / Promo Code')
                   @include('frontend.partials.couponPromoCodeInclude')

                @elseif($couponDetail['cf_listing_type'] == 'Offer / Deal')
                   @include('frontend.partials.offerDealInclude')

                @elseif($couponDetail['cf_listing_type'] == 'Free Sample')
                   @include('frontend.partials.freeSample')
                @elseif($couponDetail['cf_listing_type'] == 'Free Recharge Coupon')
                   @include('frontend.partials.freeRechargeCouponInclude')
                @endif

           </div>
        </div>
    @endsection
