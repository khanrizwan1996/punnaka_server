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
                        <h2>{{ Route::input('country'); }} Business List</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ Route::input('country'); }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12  row">
                    <div class="utf_dashboard_list_box margin-top-0">
                        <h4 class="gray"> {{ str_replace('-', ' ', Route::input('city')) ; }} Business List</h4>
                    </div>
                    <div class="listing_filter_block">
                        <div class="col-md-12 col-xs-12">
                            <div class="sort-by">
                                <div class="col-md-12 col-xs-12 row">
                                @foreach ($businessCityDataArray as $businessCityDataArrayResult)
                                        <div class="col-md-6" style="margin-top: 30px;">
                                            <a class="utf_common_button" style="background-color: #87ceeb; color:white; font-weight:bold" href="#">{{$businessCityDataArrayResult->bus_main_cat}}</a>

                                            @php
                                            $businessLisitngCityBusinessListObj = new App\Http\Controllers\frontend\businessListingController();
                                            $businessLisitngCityBusinessListArray = $businessLisitngCityBusinessListObj->businessLisitngCityBusinessList($businessCityDataArrayResult->bus_city,$businessCityDataArrayResult->bus_main_cat);

                                            //print_r($businessLisitngCityBusinessListArray);
                                            @endphp

                                        @foreach ($businessLisitngCityBusinessListArray as $businessSubCatDataArrayResult)
                                        @php
                                            $businessCityName = str_replace(' ', '-', $businessSubCatDataArrayResult->bus_city);
                                            $businessSubCategoryName = str_replace(' ', '-', $businessSubCatDataArrayResult->bus_sub_cat);
                                        @endphp
                                            <span style="text-decoration: underline;">
                                            <a href="{{url('category/'.$businessCityName.'/'.$businessSubCategoryName)}}"> {{$businessSubCatDataArrayResult->bus_sub_cat}}</a>
                                            </span> &emsp;
                                        @endforeach <br>


                                        </div>
                                    @endforeach
                                </div>
                                    {{-- @foreach ($businessSubCatDataArray as $businessSubCatDataArrayResult)
                                    @php
                                        $businessCityName = str_replace(' ', '-', $businessSubCatDataArrayResult->bus_city);
                                        $businessSubCategoryName = str_replace(' ', '-', $businessSubCatDataArrayResult->bus_sub_cat);
                                    @endphp
                                        <span style="text-decoration: underline;">
                                           <a href="{{url('category/'.$businessCityName.'/'.$businessSubCategoryName)}}"> {{$businessSubCatDataArrayResult->bus_sub_cat}}</a>
                                        </span> &emsp;
                                    @endforeach --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
