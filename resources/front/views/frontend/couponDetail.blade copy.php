@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">
    @php use Illuminate\Support\Carbon; @endphp
<head>
    <title>{{ $couponDetailRow['coupon_meta_title'] }}</title>
    <meta name="keywords" content="{{ $couponDetailRow['coupon_meta_keyword'] }}" />
    <meta name="description" content="{{ $couponDetailRow['coupon_meta_description'] }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    @section('main-container')
        <div class="clearfix"></div>
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ Route::input('country') }} Coupon Detail</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $couponDetailRow['coupon_city'] . ' / ' . $couponDetailRow['coupon_sub_category'] . ' / ' . $couponDetailRow['coupon_title'] }}
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
                            <h3>{{ $couponDetailRow['coupon_title'] }}</h3>
                        </div>
                        <div class="row slick_carousel_slider">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="simple_slick_carousel_block utf_dots_nav">
                                        <div class="utf_carousel_item">
                                            <div class="utf_listing_item">
                                                <img src="{{ url('custom-images/coupons/'.$couponDetailRow['coupon_image']) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="utf_carousel_item">
                                            <div class="utf_listing_item">
                                                <img src="{{ url('custom-images/coupons/'.$couponDetailRow['coupon_brand_image']) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="add_utf_listing_section margin-top-45">
                        <div class="utf_add_listing_part_headline_part">
                            <h3>Coupon Detail</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <p><i class="fa fa-columns" style="color: #e43f3f;"></i> Coupon Name <br>
                                    {{ $couponDetailRow->coupon_title }}</p>
                                <p><i class="fa fa-tag" style="color: #e43f3f;"></i> Coupon Code <br>
                                    #{{ $couponDetailRow->coupon_code }}</p>
                                
                                    <p><i class="fa fa-bold" style="color: #e43f3f;"></i> Brand Name <br>
                                    {{ $couponDetailRow->coupon_brand_name }}</p>
                                
                                    <p><i class="fa fa-building-o" style="color: #e43f3f;"></i> Company Name <br>
                                    {{ $couponDetailRow->coupon_company_name }}</p>
                                <p><i class="fa fa-phone" style="color: #e43f3f;"></i> Contact Number <br>
                                    {{ $couponDetailRow->coupon_contact }}</p>
                            </div>
                        </div>
                        <div class="utf_add_listing_part_headline_part">
                            <h3>Location Details</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <p><i class="fa fa-flag" style="color: #e43f3f;"></i> Location (Country) <br>
                                    {{ $couponDetailRow->coupon_country }}</p>
                                <p><i class="fa fa-building" style="color: #e43f3f;"></i> Location (State) <br>
                                    {{ $couponDetailRow->coupon_state }}</p>
                                <p><i class="fa fa-building-o" style="color: #e43f3f;"></i> Location (City) <br>
                                    {{ $couponDetailRow['coupon_city'] }}</p>
                            </div>
                        </div>
                        <div class="utf_add_listing_part_headline_part">
                            <h3>Brief Description Of Coupon</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
								<p>{!! $couponDetailRow->coupon_description	 !!}</p>
                            </div>
                        </div>

                        <div class="utf_add_listing_part_headline_part">
                            <h3>Brief Description Of Brand</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-12">
								<p>{!! $couponDetailRow->coupon_brand_detail	 !!}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Sidebar -->
                 <div class="col-lg-4 col-md-4 margin-top-40 sidebar-search">
					<div class="utf_box_widget margin-top-35">
                        <h3 style="font-size: 19px"><i class="sl sl-icon-folder-alt"></i> Products & Services Provided</h3>
                        <ul class="utf_listing_detail_sidebar">
                            <div id="utf_listing_tags"
                                class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">
                                @foreach (explode(',', $couponDetailRow['coupon_product_services']) as $productServiceName)
                                    <a href="#">{{ $productServiceName }}</a>
                                @endforeach
                            </div>
                        </ul>
                    </div>
                    <div class="utf_box_widget margin-top-35">
                        <h3 style="font-size: 19px"><i class="sl sl-icon-phone"></i> Other Information</h3>
                        
                       	
                        <ul class="utf_listing_detail_sidebar">
                            @isset($couponDetailRow->coupon_end_date_time)
							<li><i class="fa fa-calendar" style="color: #e43f3f;" aria-hidden="true"></i> End Date Time :  {{ Carbon::createFromTimestampMs($couponDetailRow['coupon_end_date_time'])->format('Y-m-d H:i') }}</li>
							@endisset

                            @isset($couponDetailRow->coupon_website)
							<li><i class="fa fa-globe" style="color: #e43f3f;" aria-hidden="true"></i> Website :  {{ $couponDetailRow['coupon_website'] }}</li>
							@endisset
                           
                            @isset($couponDetailRow->coupon_t_c)
							<li><i class="fa fa-file" style="color: #e43f3f;" aria-hidden="true"></i> Terms & Condition :  
                                <a href="{{url("custom-images/coupons/".$couponDetailRow['coupon_t_c']) }}" style="color: blue" download="">Click Here</a></li>
							@endisset

                        </ul>
                    </div>
                </div> 
            </div>
        </div>
    @endsection
