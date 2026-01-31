@php
    $businessListingControllerObj = new App\Http\Controllers\frontend\businessListingController();
@endphp
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
    <style>
        .banner-slider {
            position: relative;
            width: 100%;
            /* height: 120vh; */
            height: auto;
            overflow: hidden;
        }

        .slides {
            display: flex;
            width: 100%;
            /* 3 slides => 100% each */
            transition: transform 0.6s ease-in-out;
        }

        .slide {
            width: 100%;
            flex-shrink: 0;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Navigation buttons */
        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            font-size: 30px;
            padding: 10px 16px;
            cursor: pointer;
            border-radius: 50%;
            user-select: none;
        }

        .prev {
            left: 20px;
        }

        .next {
            right: 20px;
        }
    </style>
    @section('main-container')
        {{-- <div class="banner-slider">
            <div class="slides">

                @php
                    $i = 1;
                @endphp
                @foreach ($HomebannerData as $HomeBannerRow)
                    <div class="slide @if ($i == 1) active @endif">
                        <img src="{{ url('custom-images/banner/' . $HomeBannerRow['banner_image']) }}" alt="Banner 1">
                    </div>
                    @php $i++  @endphp
                @endforeach
            </div>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div> --}}

        <div class="container">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline_part centered"> Quick Links</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container_categories_box margin-top-5 margin-bottom-30">
                        <a href="{{ url('business-listing') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/wfu.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Add Franchisee</h4>
                            {{-- <span>07</span> 
                        <a href="{{ url('write-for-us') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/wfu.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Write For Us</h4>

                            {{-- <span>15</span> --}}
                        </a>

                        <a href="{{ url('business-listing') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/business-listing.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Add Business</h4>
                        </a>

                        <a href="{{ url('business-listing') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/discount.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Add Coupons & Offers</h4>
                            {{-- <span>05</span> --}}
                        </a>

                        <a href="{{ url('business-listing') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/ps.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Add Products & Services</h4>
                            {{-- <span>12</span> --}}
                        </a>

                        {{-- <a href="{{ url('blogs') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/shopping.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>India Shopping Places</h4>
                            {{-- <span>05</span> --}
                        </a>
                        <a href="{{ url('blog-list/USA/ALL') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/usa-mall.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Malls in USA</h4>
                            {{-- <span>12</span> --}
                        </a> --}}
                        <a href="{{ url('write-for-us') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/wfu.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Write For Us</h4>

                            {{-- <span>15</span> --}}
                        </a>
                        <a href="{{ url('our-services') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/services.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Our Services</h4>
                            {{-- <span>08</span> --}}
                        </a>

                        <a href="{{ url('submit-press-release') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/press-release.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Submit Press Release</h4>
                            {{-- <span>18</span> --}}
                        </a> 

                        {{-- <a href="{{ url('contact-us') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/contact-us.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Contact Us</h4>
                            {{-- <span>18</span> --}
                        </a> --}}
                        {{-- <a href="{{ url('about-us') }}" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/about-us.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>About Us</h4>
                            {{-- <span>07</span> --}
                        </a> --}}
                        {{-- <a href="#" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/survey.jpg') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Survey</h4>
                            {{-- <span>14</span> --}
                        </a> --}}
                        {{-- <a href="#" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/coupon.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Coupon</h4>
                            {{-- <span>22</span> --
                        </a>
                        <a href="#" class="utf_category_small_box_part">
                            <center><img src="{{ url('custom-images/icons/event.png') }}" class="img_margin_left"
                                    style="height: 50px;"></center>
                            <h4>Event</h4>
                            {{-- <span>20</span> --}
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="container main_inner_search_block margin-top-120">
            <form action="{{ url('search') }}" method="GET">
                @csrf
                <div class="main_input_search_part">
                    <div class="col-md-7">
                        <div class="main_input_search_part_item">
                            <input type="text" placeholder="You can search data by name, country and city" name="search"
                                required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="main_input_search_part_item intro-search-field">
                            <select title="Categories" name="search_type" required>
                                <option value="">Select Categories </option>
                                <option value="Business Listing">Business Listing</option>
                                <option value="Malls">Malls</option>
                                <option value="Brands">Brands</option>
                                {{-- <option value="shopping Blog">Shopping Blog</option> --}}
                                <option value="Blogs">Blogs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="button">Search</button>
                    </div>
                </div>
            </form>
        </div>


        @if(isset($getTopbusinessListingIndexData) && $getTopbusinessListingIndexData->isNotEmpty())
        <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
            <div class="container">
                <div class="row slick_carousel_slider">
                    <div class="col-md-12">
                        <h3 class="headline_part centered margin-bottom-45"> Top Local Business</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="simple_slick_carousel_block utf_dots_nav">
                                @foreach ($getTopbusinessListingIndexData as $getTopbusinessListingIndexRow)
                                    @php
                                        $topBusinessImagePath = $businessListingControllerObj->GetBusinessImage(
                                            $getTopbusinessListingIndexRow->bus_id,
                                        );

                                        $topBusinessCityName = str_replace(
                                            ' ',
                                            '-',
                                            $getTopbusinessListingIndexRow->bus_city,
                                        );
                                        $topBusinessCategoryName = str_replace(
                                            ' ',
                                            '-',
                                            $getTopbusinessListingIndexRow->bus_sub_cat,
                                        );

                                        $topBusinessName = str_replace(
                                            ' ',
                                            '-',
                                            $getTopbusinessListingIndexRow->bus_name,
                                        );
                                        if (isset($topBusinessImagePath) && !empty($topBusinessImagePath)) {
                                            $topImagePath = 'business-images/images/' . $topBusinessImagePath;
                                        } else {
                                            $topImagePath = 'No_image_available.png';
                                        }
                                    @endphp
                                    <div class="utf_carousel_item"> <a
                                            href="{{ url('detail/' . $topBusinessCityName . '/' . $topBusinessCategoryName . '/' . $topBusinessName) }}"
                                            class="utf_listing_item-container compact">
                                            <div class="utf_listing_item"> <img
                                                    src="{{ url('custom-images/' . $topImagePath) }}" alt="">
                                                <div class="utf_listing_item_content">
                                                    <div class="utf_listing_prige_block">
                                                        <span class="utf_meta_listing_price"
                                                            style="background: #3fb4e4; color:white">{{ strtoupper($getTopbusinessListingIndexRow->bus_main_cat) }}</span>
                                                    </div>
                                                    <h3>{{ strtoupper($getTopbusinessListingIndexRow->bus_name) }}</h3>
                                                    <span><i class="fa fa-phone" aria-hidden="true"></i>
                                                        {{ $getTopbusinessListingIndexRow->bus_contact_no }}</span>
                                                    <span><i class="fa fa-building" aria-hidden="true"></i>
                                                        {{ $getTopbusinessListingIndexRow->bus_city }}</span>
                                                    <span><i class="fa fa-list-alt" aria-hidden="true"></i>
                                                        {{ strtoupper($getTopbusinessListingIndexRow->bus_sub_cat) }}</span>
                                                    <span><i class="fa fa-map-marker"></i>
                                                        {{ $getTopbusinessListingIndexRow->bus_address1 }}</span>
                                                </div>
                                            </div>
                                            <div class="utf_star_rating_section"
                                                style="
                                                    color: black;
                                                    font-weight: bold;
                                                    text-align: center;
                                                    font-size: 17px;
                                                ">
                                                <span class="fa fa-sign-in"> View More Details </span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(isset($getbusinessListingIndexArray) && $getbusinessListingIndexArray->isNotEmpty())
        <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
            <div class="container">
                <div class="row slick_carousel_slider">
                    <div class="col-md-12">
                        <h3 class="headline_part centered margin-bottom-45"> Recent Listed Business <span>Explore the local
                                business in your city</span> </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="simple_slick_carousel_block utf_dots_nav">
                                @foreach ($getbusinessListingIndexArray as $getbusinessListingIndexRow)
                                    @php
                                        $businessImagePath = $businessListingControllerObj->GetBusinessImage(
                                            $getbusinessListingIndexRow->bus_id,
                                        );
                                        $businessCityName = str_replace(
                                            ' ',
                                            '-',
                                            $getbusinessListingIndexRow->bus_city,
                                        );
                                        $businessCategoryName = str_replace(
                                            ' ',
                                            '-',
                                            $getbusinessListingIndexRow->bus_sub_cat,
                                        );
                                        $businessName = str_replace(' ', '-', $getbusinessListingIndexRow->bus_name);
                                        if (isset($businessImagePath) && !empty($businessImagePath)) {
                                            $imagePath = 'business-images/images/' . $businessImagePath;
                                        } else {
                                            $imagePath = 'No_image_available.png';
                                        }
                                    @endphp
                                    <div class="utf_carousel_item"> <a
                                            href="{{ url('detail/' . $businessCityName . '/' . $businessCategoryName . '/' . $businessName) }}"
                                            class="utf_listing_item-container compact">
                                            <div class="utf_listing_item"> <img
                                                    src="{{ url('custom-images/' . $imagePath) }}" alt="">
                                                <div class="utf_listing_item_content">
                                                    <div class="utf_listing_prige_block">
                                                        <span class="utf_meta_listing_price"
                                                            style="background: #3fb4e4; color:white">{{ strtoupper($getbusinessListingIndexRow->bus_main_cat) }}</span>
                                                    </div>
                                                    <h3>{{ strtoupper($getbusinessListingIndexRow->bus_name) }}</h3>
                                                    <span><i class="fa fa-phone" aria-hidden="true"></i>
                                                        {{ $getbusinessListingIndexRow->bus_contact_no }}</span>
                                                    <span><i class="fa fa-building" aria-hidden="true"></i>
                                                        {{ $getbusinessListingIndexRow->bus_city }}</span>
                                                    <span><i class="fa fa-list-alt" aria-hidden="true"></i>
                                                        {{ strtoupper($getbusinessListingIndexRow->bus_sub_cat) }}</span>
                                                    <span><i class="fa fa-map-marker"></i>
                                                        {{ $getbusinessListingIndexRow->bus_address1 }}</span>
                                                </div>
                                            </div>
                                            <div class="utf_star_rating_section"
                                                style="color: black; font-weight: bold; text-align: center; font-size: 17px;">
                                                <span class="fa fa-sign-in"> View More Details </span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                {{-- @php
                                    $businessListingControllerObj = new App\Http\Controllers\frontend\businessListingController();
                                @endphp
                                @foreach ($getbusinessListingIndexArray as $getbusinessListingIndexRow)
                                    @php
                                        $businessImagePath = $businessListingControllerObj->GetBusinessImage($getbusinessListingIndexRow->bus_id);
                                        $businessCityName = str_replace(' ', '-', $getbusinessListingIndexRow->bus_city);
                                        $businessCategoryName = str_replace(' ', '-', $getbusinessListingIndexRow->bus_sub_cat);
                                        $businessName = str_replace(' ', '-', $getbusinessListingIndexRow->bus_name);
                                        if(isset($businessImagePath) && !empty($businessImagePath)){
                                            $imagePath = 'business-images/images/'.$businessImagePath;
                                        }else{
                                            $imagePath = 'No_image_available.png';
                                        }
                                    @endphp

                                    <div class="utf_carousel_item"> <a
                                            href="{{ url('detail/' . $businessCityName . '/' . $businessCategoryName . '/' . $businessName) }}"
                                            class="utf_listing_item-container compact">
                                            <div class="utf_listing_item"> 
                                                <img src="{{ url('custom-images/'.$imagePath) }}"alt="">
                                                <div class="utf_listing_item_content">
                                                    <h3>{{ $getbusinessListingIndexRow->bus_name }}</h3>
                                                    <span><i class="fa fa-building" aria-hidden="true"></i>
                                                        {{ $getbusinessListingIndexRow->bus_city }}</span>
                                                    <span><i class="fa fa-list-alt" aria-hidden="true"></i>
                                                        {{ $getbusinessListingIndexRow->bus_sub_cat }}</span>
                                                    <span><i class="fa fa-map-marker"></i>
                                                        {{ $getbusinessListingIndexRow->bus_address1 }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(isset($mallInIndiaListArray) && $mallInIndiaListArray->isNotEmpty())
        <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
            <div class="container">
                <div class="row slick_carousel_slider">
                    <div class="col-md-12">
                        <h3 class="headline_part centered margin-bottom-45"> Malls in India </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="simple_slick_carousel_block utf_dots_nav">
                                @foreach ($mallInIndiaListArray as $mallInIndiaListRow)
                                    @php
                                        $mallName = str_replace(' ', '-', $mallInIndiaListRow->mall_name);
                                        $mallCity = str_replace(' ', '-', $mallInIndiaListRow->mall_city);
                                    @endphp

                                    <div class="utf_carousel_item"> <a
                                            href="{{ url('/detail-mall/Malls-in-' . $mallCity . '/' . $mallName) }}"
                                            class="utf_listing_item-container compact">
                                            <div class="utf_listing_item"> <img
                                                    src="{{ url('custom-images/mall/' . $mallInIndiaListRow->mall_logo) }}"
                                                    alt="">
                                                <div class="utf_listing_item_content">
                                                    <h3>{{ $mallInIndiaListRow->mall_name }}</h3>
                                                    <span><i class="fa fa-building" aria-hidden="true"></i>
                                                        {{ $mallInIndiaListRow->mall_city }}</span>
                                                    <span><i class="fa fa-map-marker"></i>
                                                        {{ $mallInIndiaListRow->mall_location }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(isset($mallInUSAListArray) && $mallInUSAListArray->isNotEmpty())
        <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
            <div class="container">
                <div class="row slick_carousel_slider">
                    <div class="col-md-12">
                        <h3 class="headline_part centered margin-bottom-45"> Malls in USA </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="simple_slick_carousel_block utf_dots_nav">
                                @foreach ($mallInUSAListArray as $mallInUSAListRow)
                                    @php
                                        $blogTitle = str_replace(' ', '-', $mallInUSAListRow->blog_cat_title);
                                        $blogSubCat = str_replace(' ', '-', $mallInUSAListRow->blog_cat_subcat);
                                    @endphp

                                    <div class="utf_carousel_item"> <a
                                            href="{{ url('/blog-info/' . $blogSubCat . '/' . $blogTitle) }}"
                                            class="utf_listing_item-container compact">
                                            <div class="utf_listing_item"> <img
                                                    src="{{ url('custom-images/blog-cat-images/' . $mallInUSAListRow->blog_cat_image) }}"
                                                    alt="">

                                            </div>
                                        </a>
                                        <h4 style="color: black; font-size: 18px;margin-left: 1px;">
                                            {{ strtoupper($mallInUSAListRow->blog_cat_title) }}</h4>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(isset($getBlogCategoryIndexArray) && $getBlogCategoryIndexArray->isNotEmpty())
        <section class="fullwidth_block padding-top-75 padding-bottom-75" data-background-color="#ffffff">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="headline_part centered margin-bottom-50"> Recent Posted Blog</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($getBlogCategoryIndexArray as $getBlogCategoryIndexRow)
                        @php
                            $blogCatName = str_replace(' ', '-', $getBlogCategoryIndexRow->blog_cat_title);
                            $blogSubCatName = str_replace(' ', '-', $getBlogCategoryIndexRow->blog_cat_subcat);
                        @endphp
                        <div class="col-md-3 col-sm-6 col-xs-12"> <a
                                href="{{ url('blog-info/' . $blogSubCatName . '/' . $blogCatName) }}"
                                class="blog_compact_part-container">
                                <div class="blog_compact_part"> <img
                                        src="{{ url('custom-images/blog-cat-images/' . $getBlogCategoryIndexRow->blog_cat_image) }}"
                                        alt="">
                                    {{-- <div class="blog_compact_part_content">
                                        <h3 style="font-size: 16px;">{{ strtoupper($getBlogCategoryIndexRow->blog_cat_title) }}</h3>
                                        <ul class="blog_post_tag_part">
                                            {{-- <li>{{ date('j F Y h:i:s', strtotime($getBlogCategoryIndexRow->blog_cat_added_time)) }}</li> --}
                                            <li>{{ strtoupper($getBlogCategoryIndexRow->blog_cat_subcat) }}</li>
                                        </ul>
                                        {{-- <p>{{ $getBlogCategoryIndexRow->blog_cat_subcat }}</p> --}
                                    </div> --}}
                                </div>
                                <h3 style="font-size: 16px;padding: 11px;">
                                    {{ Str::substr(strtoupper($getBlogCategoryIndexRow->blog_cat_title), 0, 35) }} ...</h3>

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        <section class="utf_cta_area_item utf_cta_area2_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="utf_subscribe_block clearfix">
                            <div class="col-md-8 col-sm-7">
                                <div class="section-heading">
                                    <h2 class="utf_sec_title_item utf_sec_title_item2">Subscribe to Newsletter!</h2>
                                    <p class="utf_sec_meta">
                                        Subscribe to get latest updates and information.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5">
                                <div class="contact-form-action">
                                    <form method="POST" action="{{ url('newsLetterStore') }}">
                                        @csrf
                                        <span class="la la-envelope-o"></span>
                                        <input class="form-control" type="email" placeholder="Enter your email"
                                            required="" name="userEmail">
                                        <button class="utf_theme_btn" type="submit">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <script>
            const slidesContainer = document.querySelector('.slides');
            const slides = document.querySelectorAll('.slide');
            const prevBtn = document.querySelector('.prev');
            const nextBtn = document.querySelector('.next');
            let current = 0;
            const total = slides.length;

            function updateSlide() {
                slidesContainer.style.transform = `translateX(-${current * 100}%)`;
            }

            // Next / Prev buttons
            nextBtn.addEventListener('click', () => {
                current = (current + 1) % total;
                updateSlide();
            });

            prevBtn.addEventListener('click', () => {
                current = (current - 1 + total) % total;
                updateSlide();
            });

            // Auto slide every 5 seconds
            setInterval(() => {
                current = (current + 1) % total;
                updateSlide();
            }, 5000);

            // Initialize
            updateSlide();
        </script>
    @endsection
