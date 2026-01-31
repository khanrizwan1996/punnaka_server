@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ $businessLisitngDetailArray['bus_meta_title'] }}</title>
    <meta name="keywords" content="{{ $businessLisitngDetailArray['bus_meta_keyword'] }}" />
    <meta name="description" content="{{ $businessLisitngDetailArray['bus_meta_description'] }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    @section('main-container')
        <div class="clearfix"></div>
        {{-- <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0">
		<a href="{{url('frontend/images/single-listing-01.jpg')}}" data-background-image="{{url('frontend/images/single-listing-01.jpg')}}" class="item utf_gallery"></a>
		<a href="{{url('frontend/images/single-listing-02.jpg')}}" data-background-image="{{url('frontend/images/single-listing-02.jpg')}}" class="item utf_gallery"></a>
		<a href="{{url('frontend/images/single-listing-03.jpg')}}" data-background-image="{{url('frontend/images/single-listing-03.jpg')}}" class="item utf_gallery"></a>
		<a href="{{url('frontend/images/single-listing-04.jpg')}}" data-background-image="{{url('frontend/images/single-listing-04.jpg')}}" class="item utf_gallery"></a>
	</div>
  </div> --}}

        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ Route::input('country') }} Business Listing Detail</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $businessLisitngDetailArray['bus_city'] . ' / ' . $businessLisitngDetailArray['bus_sub_cat'] . ' / ' . $businessLisitngDetailArray['bus_name'] }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row utf_sticky_main_wrapper">
                <div class="col-lg-8 col-md-8">
                    <div id="titlebar" class="utf_listing_titlebar">
                        <div class="utf_listing_headline_part margin-top-30 margin-bottom-40">
                            <h3>{{ $businessLisitngDetailArray['bus_name'] }}</h3>
                        </div>
                        <div class="row slick_carousel_slider">
                            <div class="row">
                                <div class="col-md-12">

                                    @php
                                        $businessImageObj = new App\Http\Controllers\frontend\businessListingController();
                                        $businessImageArray = $businessImageObj->getAllBusinessImage(
                                            $businessLisitngDetailArray->bus_id,
                                        );
                                    @endphp

                                    <div class="simple_slick_carousel_block utf_dots_nav">
                                        @foreach ($businessImageArray as $businessImageRow)
                                            <div class="utf_carousel_item">
                                                <div class="utf_listing_item">
                                                    <img src="{{ url('custom-images/business-images/images/' . $businessImageRow->bus_img_path) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add_utf_listing_section margin-top-45">
                        <div class="utf_add_listing_part_headline_part">
                            <h3 style="font-weight: bolder;">Contact Detail</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <p><i class="fa fa-columns" style="color: #e43f3f;"></i> Business Name <br>
                                    {{ $businessLisitngDetailArray->bus_name }}</p>
                                <p><i class="fa fa-envelope" style="color: #e43f3f;"></i> Email <br>
                                    {{ $businessLisitngDetailArray->bus_email }}</p>
                                <p><i class="fa fa-phone" style="color: #e43f3f;"></i> Contact Number <br>
                                    {{ $businessLisitngDetailArray->bus_contact_no }}</p>
                                <p><i class="fa fa-whatsapp" aria-hidden="true" style="color: #e43f3f;"></i>
                                    Business Whatsapp Number <br> {{ $businessLisitngDetailArray->bus_alt_contact_no }}
                                </p>
                            </div>
                        </div>
                        <div class="utf_add_listing_part_headline_part">
                            <h3 style="font-weight: bolder;">Location Details</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <p><i class="fa fa-flag" style="color: #e43f3f;"></i> Location (Country) <br>
                                    {{ $businessLisitngDetailArray->bus_country }}</p>
                                <p><i class="fa fa-building" style="color: #e43f3f;"></i> Location (State) <br>
                                    {{ $businessLisitngDetailArray->bus_state }}</p>
                                <p><i class="fa fa-building-o" style="color: #e43f3f;"></i> Location (City) <br>
                                    {{ $businessLisitngDetailArray['bus_city'] }}</p>
                                <p><i class="fa fa-map-pin" style="color: #e43f3f;" aria-hidden="true"></i> Area PIN Code /
                                    ZIP Code <br> {{ $businessLisitngDetailArray['bus_pin_code'] }}
                                <p><i class="fa fa-caret-square-o-right" style="color: #e43f3f;" aria-hidden="true"></i>
                                    Business Address (Physical Location) <br>
                                    {{ $businessLisitngDetailArray['bus_address1'] }}</p>
                                <p><i class="fa fa-chevron-circle-right" style="color: #e43f3f;" aria-hidden="true"></i>
                                    Business Address (Area Name) <br> {{ $businessLisitngDetailArray->bus_address2 }}</p>
                            </div>
                        </div>
                        <div class="utf_add_listing_part_headline_part">
                            <h3 style="font-weight: bolder;">Brief Description Of Business</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <p>{!! $businessLisitngDetailArray->bus_desc !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-4 margin-top-40 sidebar-search">
                    <div class="utf_box_widget opening-hours margin-top-35">
                        <h3 style="font-size: 19px; font-weight: bolder;"><i class="sl sl-icon-clock"></i> Business Timings
                        </h3>
                        <ul>
                            <div class="row">

                                <li>
                                    @if(isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_status) && $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_status == 1)
                                        <div class="col-md-3">
                                            Monday
                                        </div>
                                        <div class="col-md-2">
                                            Open
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;">
                                                {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_end }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            Monday
                                        </div>
                                        <div class="col-md-2">
                                            Close
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;"> - </p>
                                        </div>
                                    @endif

                                    <br>
                                </li>

                                <li>
                                    @if(isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_status) &&$businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_status == 1)
                                        <div class="col-md-3">
                                            Tuesday
                                        </div>
                                        <div class="col-md-2">
                                            Open
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;">
                                                {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_end }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            Tuesdays
                                        </div>
                                        <div class="col-md-2">
                                            Close
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;"> - </p>
                                        </div>
                                    @endif

                                    <br>
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_status) &&  $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_status == 1)
                                        <div class="col-md-3">
                                            Wednesday
                                        </div>
                                        <div class="col-md-2">
                                            Open
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;">
                                                {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_end }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            Wednessday
                                        </div>
                                        <div class="col-md-3">
                                            &nbsp; Close
                                        </div>
                                        <div class="col-md-5">
                                            <p style="font-weight: 400;font-size: 14px;"> - </p>
                                        </div>
                                    @endif

                                    <br>
                                </li>

                                <li>
                                    @if(isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_status) && $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_status == 1)
                                        <div class="col-md-3">
                                            Thursday
                                        </div>
                                        <div class="col-md-2">
                                            Open
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;">
                                                {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_end }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            Thursday
                                        </div>
                                        <div class="col-md-2">
                                            Close
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;"> - </p>
                                        </div>
                                    @endif
                                    <br>
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_status) && $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_status == 1)
                                        <div class="col-md-3">
                                            Friday
                                        </div>
                                        <div class="col-md-2">
                                            Open
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;">
                                                {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_end }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            Friday
                                        </div>
                                        <div class="col-md-2">
                                            Close
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;"> - </p>
                                        </div>
                                    @endif
                                    <br>
                                </li>

                                <li>
                                    @if(isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_status) && $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_status == 1)
                                        <div class="col-md-3">
                                            Saturday
                                        </div>
                                        <div class="col-md-2">
                                            Open
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;">
                                                {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_end }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            Saturday
                                        </div>
                                        <div class="col-md-2">
                                            Close
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;"> - </p>
                                        </div>
                                    @endif
                                    <br>
                                </li>

                                <li>
                                    @if(isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_status) &&$businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_status == 1)
                                        <div class="col-md-3">
                                            Sunday
                                        </div>
                                        <div class="col-md-2">
                                            Open
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;">
                                                {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_end }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            Sunday
                                        </div>
                                        <div class="col-md-2">
                                            Close
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-weight: 400;font-size: 14px;"> - </p>
                                        </div>
                                    @endif
                                    <br>
                                </li>

                            </div>
                        </ul>
                    </div>

                    <div class="utf_box_widget margin-top-35">
                        <h3 style="font-size: 19px ;font-weight: bolder;"><i class="sl sl-icon-folder-alt"></i> Products &
                            Services Provided</h3>
                        <ul class="utf_listing_detail_sidebar">
                            <div id="utf_listing_tags"
                                class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">
                                @foreach (explode(',', $businessLisitngDetailArray['bus_product_service']) as $productServiceName)
                                    <a href="#">{{ $productServiceName }}</a>
                                @endforeach
                            </div>
                        </ul>
                    </div>

                    <div class="utf_box_widget margin-top-35">
                        <h3 style="font-size: 19px ;font-weight: bolder;"><i class="sl sl-icon-phone"></i> Other
                            Information</h3>

                        <ul class="utf_social_icon rounded margin-top-10">
                            @isset($businessLisitngDetailArray->bus_facebook_url)
                                <li><a class="facebook" target="_blank"
                                        href="{{ $businessLisitngDetailArray->bus_facebook_url }}"><i
                                            class="icon-facebook"></i></a></li>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_twitter_url)
                                <li><a class="twitter" target="_blank"
                                        href="{{ $businessLisitngDetailArray->bus_twitter_url }}"><i
                                            class="icon-twitter"></i></a></li>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_video_url)
                                <li><a class="youtube" target="_blank"
                                        href="{{ $businessLisitngDetailArray->bus_video_url }}"><i
                                            class="icon-youtube"></i></a></li>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_instagram_url)
                                <li><a class="instagram" target="_blank"
                                        href="{{ $businessLisitngDetailArray->bus_instagram_url }}"><i
                                            class="icon-instagram"></i></a></li>
                            @endisset
                        </ul>

                        <ul class="utf_listing_detail_sidebar">
                            @isset($businessLisitngDetailArray->bus_start_year)
                                <li><i class="fa fa-calendar" style="color: #e43f3f;" aria-hidden="true"></i> Business Start
                                    / Opening Year : {{ $businessLisitngDetailArray->bus_start_year }}</li>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_avg_price_range)
                                <li><i class="fa fa-money" style="color: #e43f3f;" aria-hidden="true"></i> Average price
                                    range / fee : {{ $businessLisitngDetailArray->bus_avg_price_range }}</li>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_payment_mode)
                                <li><i class="fa fa-credit-card" style="color: #e43f3f;" aria-hidden="true"></i> Payment mode
                                    :
                                    {{ preg_replace('/[!?,.](?![!?,.\s])/', '$0 ', $businessLisitngDetailArray->bus_payment_mode) }}
                                </li>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_punnaka_discount)
                                <li><i class="fa fa-percent" style="color: #e43f3f;" aria-hidden="true"></i> Discounts /
                                    Offers : {{ $businessLisitngDetailArray->bus_punnaka_discount }}</li>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_website_url)
                                <li><i class="fa fa-globe" style="color: #e43f3f;" aria-hidden="true"></i> Business Webiste :
                                    <a href="{{ $businessLisitngDetailArray->bus_website_url }}" target="_blank"
                                        style="color: #3fb4e4;">{{ $businessLisitngDetailArray->bus_website_url }}</a></li>
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
