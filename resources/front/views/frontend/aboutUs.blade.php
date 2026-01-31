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
  <div id="titlebar" class="gradient margin-bottom-0">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>About Us</h2>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{url('home')}}">Home</a></li>
              <li>About Us</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>


  <section class="fullwidth_block padding-bottom-70" data-background-color="#f9f9f9">
	  <div class="container">
		<div class="row">
		  <div class="col-md-8 col-md-offset-2">
			<h2 class="headline_part centered margin-top-80">{{$aboutUsData['about_us_title']}}</h2>
		  </div>
		</div>
		<div class="row container_icon">
		  <div class="col-md-8 col-sm-8 col-xs-8">
			<div style="text-align: start;" class="box_icon_with_line">
        {!! $aboutUsData['about_us_desc'] !!}
			</div>
		  </div>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <div style="text-align: start;" class="box_icon_two box_icon_with_line">
          <img src="{{asset('custom-images/'.$aboutUsData['about_us_image'])}}" alt="">
        </div>
      </div>

		</div>
	  </div>
  </section>
@endsection
