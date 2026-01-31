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
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .content {
            flex: 1;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #111827;
            margin: 0 0 12px 0;
            line-height: 1.3;
        }

        .excerpt {
            color: #4b5563;
            font-size: 16px;
            margin: 0;
        }

        .image-wrapper {
            flex-shrink: 0;
            width: 240px;
            height: 160px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        @media (max-width: 768px) {
            .card {
                flex-direction: column;
                padding: 20px;
            }

            .image-wrapper {
                width: 100%;
                height: 200px;
            }

            .title {
                font-size: 22px;
            }

            .excerpt {
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .card {
                padding: 16px;
                margin-bottom: 24px;
            }

            .title {
                font-size: 20px;
            }
        }

        .item {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            margin-right: 16px;
            flex-shrink: 0;
            overflow: hidden;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon img {
            width: 32px;
            height: 32px;
        } */

        .text {
            flex: 1;
        }

        .title1 {
            font-weight: 600;
            font-size: 17px;
            color: #111;
            margin: 0 0 4px 0;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .arrow {
            font-size: 24px;
            color: #999;
        }
    </style>

    @section('main-container')
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">


                    <div class="col-md-12">
                        <h2>{{ Route::input('country') }} Press Release List</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
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
                        @if(isset($getPressReleaseCategoryData) && $getPressReleaseCategoryData->isNotEmpty())
                            @foreach ($getPressReleaseCategoryData as $getPressReleaseCategoryRow)
                                @php
                                    $prTitle = str_replace(' ', '-', $getPressReleaseCategoryRow->pr_title);
                                @endphp
                                <div class="card">
                                    <div class="content">
                                        <h2 class="title">{{ $getPressReleaseCategoryRow->pr_title }}</h2>
                                        <p class="excerpt">{!! substr($getPressReleaseCategoryRow->pr_desc, 0, 160) !!}</p>
                                        <a href="{{ url('press-release/' . $prTitle) }}"class="read-more">Read More</a>
                                    </div>
                                    {{-- <div class="image-wrapper">
                                        <img src="{{ url('custom-images/press-release/' . $getPressReleaseCategoryRow->pr_logo) }}">
                                    </div> --}}
                                </div>
                            @endforeach
                        @else
                            <br>
                            <h2>
                                <center><b>No data found</b></center>
                            </h2>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h3>Recent Press Releases</h3>
                    <div class="sidebar">
                        @if(isset($getLatestPressReleaseListing) && $getLatestPressReleaseListing->isNotEmpty())
                            @foreach ($getLatestPressReleaseListing as $getLatestPressReleaseRow)
                                @php
                                    $newPrTitle = str_replace(' ', '-', $getLatestPressReleaseRow->pr_title);
                                @endphp
                                <div class="item">
                                    {{-- <div class="icon">
                                        <img src="{{ url('custom-images/press-release/' . $getLatestPressReleaseRow->pr_logo) }}" alt="">
                                    </div> --}}
                                    <div class="text">
                                        <h3 class="title1">{{ $getLatestPressReleaseRow->pr_title }}</h3>
                                        <p class="subtitle">{{ $getLatestPressReleaseRow->pr_main_cat }}</p>
                                    </div>
                                    <a href="{{ url('press-release/' . $newPrTitle) }}"class="read-more">
                                        <span class="arrow">→</span></a>

                                </div>
                            @endforeach
                         @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
