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
    * {
      box-sizing: border-box;
    }

  
    .carousel-wrapper {
      position: relative;
      max-width: 1200px;
      margin: 50px auto;
      overflow: hidden;
      padding: 10px;
    }

    .carousel-track {
      display: flex;
      gap: 20px;
      transition: transform 0.4s ease-in-out;
    }

    .slide {
      min-width: 260px;
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
    }

    .slide img {
      width: 100%;
      height: auto;
      display: block;
    }

    .arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: #007bff;
      color: #fff;
      border: none;
      /* padding: 12px 16px; */
      padding: 0px 10px;
      border-radius: 50%;
      font-size: 18px;
      cursor: pointer;
      z-index: 1;
      transition: background 0.3s;
    }

    .arrow:hover {
      background: #0056b3;
    }

    .arrow.prev {
      left: 10px;
    }

    .arrow.next {
      right: 10px;
    }

    @media (max-width: 768px) {
      .slide {
        min-width: 200px;
      }
    }

    @media (max-width: 480px) {
      .slide {
        min-width: 160px;
      }
    }
  </style>
    @section('main-container')

        <div id="titlebar" style="margin-bottom:40px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="color:black">Mall Detail ({{ $mallSingleData['mall_name'] }})</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li style="color:black"><a href="{{ url('home') }}">Home</a></li>
                                <li style="color:black">Mall Detail</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

<div class="carousel-wrapper">
  <button class="arrow prev" onclick="moveSlide(-1)">&#10094;</button>
  <div class="carousel-track" id="carouselTrack">
    @foreach ($mallImagesArray as $mallImagesRow)
    <div class="slide">
        <img src="{{ url('custom-images/mall-multiple-images/' . $mallImagesRow->mall_img_path) }}" onclick="openModal(this.src)" style="width:343px; height:179px">
    </div>
     @endforeach
  </div>
  <button class="arrow next" onclick="moveSlide(1)">&#10095;</button>
</div>

        {{-- <div class="clearfix"></div>
        @if (count($mallImagesArray) > 0)
            <div id="utf_listing_gallery_part" class="utf_listing_section">
                <div class="utf_listing_slider utf_gallery_container margin-bottom-0">
                    @foreach ($mallImagesArray as $mallImagesRow)
                        <a href="{{ url('custom-images/mall-multiple-images/' . $mallImagesRow->mall_img_path) }}"
                            data-background-image="{{ url('custom-images/mall-multiple-images/' . $mallImagesRow->mall_img_path) }}"
                            class="item utf_gallery"></a>
                    @endforeach

                </div>
            </div>
            <br><br>
        @endif --}}

        <div class="container">
            <div class="row utf_sticky_main_wrapper">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ url('custom-images/mall/' . $mallSingleData['mall_logo']) }}" style="height: 300px">
                </div>
                <div class="col-lg-8 col-md-8">

                    <h2>{{ $mallSingleData['mall_name'] }}</h2>

                    <span><i class="fa fa-envelope" style="color: #3fb4e4"></i> Email Id:
                        {{ $mallSingleData['mall_email'] }}</span><br>

                    <span><i class="fa fa-phone" style="color: #3fb4e4"></i> Contact No:
                        {{ $mallSingleData['mall_contact_no'] }}</span><br>

                    <span><i class="fa fa-map-marker" style="color: #3fb4e4"></i> Location:
                        {{ $mallSingleData['mall_location'] }}</span><br>

                    <span><i class="fa fa-building-o" style="color: #3fb4e4"></i> City:
                        {{ $mallSingleData['mall_city'] }}</span><br>

                    <span><i class="fa fa-clock-o" style="color: #3fb4e4"></i> Mall Timings:
                        {{ $mallSingleData['mall_timing'] }}</span><br>
                    <span><i class="fa fa-calendar" style="color: #3fb4e4"></i> Mall Opening Date:
                        {{ $mallSingleData['mall_opening_date'] }}</span><br>
                    <span><i class="fa fa-home" style="color: #3fb4e4"></i> Store Timings:
                        {{ $mallSingleData['mall_store_timing'] }}</span><br>
                    <span><i class="fa fa-globe" style="color: #3fb4e4"></i> Website Link:
                        {{ $mallSingleData['mall_website_link'] }}</span>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div id="utf_listing_overview" class="utf_listing_section">
                        <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Mall Details</h3>
                        <p>{!! $mallSingleData['mall_desc'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
        @if (count($brandsArray)>0)
            <section class="fullwidth_block padding-top-20 padding-bottom-50">
                <div class="container">
                    <div class="row slick_carousel_slider">
                        <div class="col-md-12">
                            <h3 class="headline_part centered margin-bottom-25">Brands</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="simple_slick_carousel_block utf_dots_nav">
                                    
                                    @foreach ($brandsArray as $brandsRow)
                                    @php 
                                    $brandName = str_replace(' ', '-',$brandsRow->brand_name);
                                    @endphp

                                     <div class="utf_carousel_item"> 
                                        <a href="{{url('detail-brand/'.Route::input('city').'/'.Route::input('name').'/'.$brandName)}}"
                                        class="utf_listing_item-container compact">

                                    <div class="utf_listing_item"> <img src="{{asset('custom-images/brand/'.$brandsRow->brand_logo)}}" alt="">
                                    <div class="utf_listing_item_content">
                                        <h3>{{$brandsRow->brand_name}}</h3>
                                        @if(!empty(($brandsRow->brand_location)))
                                        <span><i class="fa fa-map-marker"></i> {{ $brandsRow->brand_location }}</span>
                                        @endif
                                        @if(!empty(($brandsRow->brand_email)))
                                        <span><i class="fa fa-envelope" aria-hidden="true"></i> {{ $brandsRow->brand_email }}</span>
                                        @endif
                                    </div>
                                    </div>
                                    </a>
                                </div>

                                        {{-- <div class="utf_carousel_item"> 
                                            <a href="{{url('detail-brand/'.Route::input('city').'/'.Route::input('name').'/'.$brandName)}}"
                                                class="utf_listing_item-container compact">
                                                <div class="utf_listing_item"> 
                                                    <span><i class="fa fa-building" aria-hidden="true"></i> {{ $brandName }}</span>
                                                        <span><i class="fa fa-list-alt" aria-hidden="true"></i> {{ $brandName }}</span>
                                                        <span><i class="fa fa-map-marker"></i> {{ $brandName }}</span>
                                                    <img src="{{asset('custom-images/brand/'.$brandsRow->brand_logo)}}" alt="">
                                                </div>
                                            </a>
                                        </div> --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        
<script>
  const track = document.getElementById('carouselTrack');
  let currentIndex = 0;

  function moveSlide(direction) {
    const slides = document.querySelectorAll('.slide');
    const slideWidth = slides[0].offsetWidth + 20; // +gap
    const visibleSlides = Math.floor(track.parentElement.offsetWidth / slideWidth);
    const maxIndex = slides.length - visibleSlides;

    currentIndex += direction;
    if (currentIndex < 0) currentIndex = 0;
    if (currentIndex > maxIndex) currentIndex = maxIndex;

    track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
  }
</script>
    @endsection
