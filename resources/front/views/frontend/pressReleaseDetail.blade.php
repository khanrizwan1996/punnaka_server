@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ $getPressReleaseData->first()->pr_meta_title }}</title>
    <meta name="keywords" content="{{ $getPressReleaseData->first()->pr_meta_keyword }}" />
    <meta name="description" content="{{ $getPressReleaseData->first()->pr_meta_desc }}" />
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

        .arrow {
            font-size: 24px;
            color: #999;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        .hero {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            padding: 20px 20px;
            text-align: center;
            position: relative;
            overflow: hidden
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 80% 20%, rgba(255, 255, 255, .15), transparent 50%)
        }

        h1 {
            font-size: 48px;
            font-weight: 900;
            margin-bottom: 12px
        }

        .hero p {
            font-size: 19px;
            max-width: 700px;
            margin: 0 auto 25px;
            opacity: 0.95
        }

        .btn {
            background: #fff;
            color: #667eea;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: .3s
        }

        .btn:hover {
            background: #667eea;
            color: #fff;
            border: 2px solid #fff
        }

        .features {
            margin: 60px 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px
        }

        .feat {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, .1)
        }

        .feat h3 {
            font-size: 22px;
            color: #667eea;
            margin: 15px 0 10px
        }

        .email-cta {
            background: #667eea;
            color: #fff;
            padding: 30px 20px;
            text-align: center;
            border-radius: 25px;
            margin: 60px 0;
            position: relative;
            overflow: hidden
        }

        .email-cta strong {
            font-size: 25px;
            display: block;
            margin: 10px 0
        }

        .steps {
            margin: 60px 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 18px
        }

        .step {
            background: #fff;
            padding: 25px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08)
        }

        .step-num {
            width: 55px;
            height: 55px;
            background: #764ba2;
            color: #fff;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 900
        }

        .recent {
            margin: 70px 0
        }

        .recent h2 {
            font-size: 32px;
            text-align: center;
            color: #667eea;
            margin-bottom: 30px;
            font-weight: 900
        }

        .releases {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px
        }

        .release {
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(102, 126, 234, .08);
            transition: .3s
        }

        .release:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, .15)
        }

        .release h4 {
            font-size: 18px;
            color: #1a1a2e;
            margin-bottom: 6px;
            line-height: 1.3
        }

        .release .date {
            font-size: 13px;
            color: #764ba2;
            margin-bottom: 10px;
            font-weight: 600
        }

        .release p {
            font-size: 14.5px;
            color: #555;
            line-height: 1.5
        }

        .release a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px
        }

        .release a:hover {
            text-decoration: underline
        }
    </style>
    @section('main-container')
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Press Release Detail</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('submit-press-release') }}">Submit Press Release</a></li>
                                <li>Press Release </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="scrollTopId">
            <div class="row">


                <div class="col-lg-9 col-md-9 listing_grid_item">

                    <div class="box">
                        &emsp;
                        <span style="color: white;background: #a00404;padding: 2px 7px;font-size: 13px;">{{ strtoupper($getPressReleaseData->first()->pr_main_cat . ' / ' . $getPressReleaseData->first()->pr_sub_cat) }}</span>
                        <br><br>
                        <span style="font-size: 26px; color: #000; font-weight: bolder; ">&nbsp;&nbsp;{{ $getPressReleaseData->first()->pr_title1 }}</span>
                        <p style="font-size: 14px;">&emsp; 
                            <i class="fa fa-user" aria-hidden="true"></i> By
                            {{ $getPressReleaseData->first()->pr_author }}
                            
                            

                            &emsp; <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{ date('j F Y H:i', strtotime($getPressReleaseData->first()->pr_publish_date_time)) }}

                            &emsp; Updated
                            {{ date('j F Y H:i', strtotime($getPressReleaseData->first()->pr_modified_date_time)) }}
                        </p>

                        @if (isset($getPressReleaseData->first()->pr_logo) && !empty($getPressReleaseData->first()->pr_logo))
                            <div class="col-lg-12 col-md-12">
                                <img src="{{ url('custom-images/press-release/' . $getPressReleaseData->first()->pr_logo) }}"
                                    style="width: 100%;">
                            </div>
                            <br>
                        @endif
                        <div class="col-lg-12 col-md-12">

                            <p class="text-justify"><b>Publisher:</b> {{ $getPressReleaseData->first()->pr_publisher }}
                            </p>

                            @isset($getPressReleaseData->first()->pr_content_location)
                                <p class="mb-4 text-justify"><b>Content Location:</b>
                                    {{ $getPressReleaseData->first()->pr_content_location }}</p>
                            @endisset

                            @isset($getPressReleaseData->first()->pr_attachment)
                                <p class="mb-4 text-justify"><b>PDF Attachment: </b> 
                                    <a download="" class="text-primary" href="{{ url('custom-images/press-release/' . $getPressReleaseData->first()->pr_attachment) }}"><b> Download </b>
                                    </a>
                                </p>
                            @endisset

                            

                            @isset($getPressReleaseData->first()->pr_desc)
                            <div style="padding: 20px;background: #f0f0f069;padding-top: 0;">
                                <p class="mb-4 text-justify">{!! $getPressReleaseData->first()->pr_desc !!}</p>
                            </div>
                            @endisset

                            @isset($getPressReleaseData->first()->pr_video_embedded)
                                <p class="mb-4 text-justify"><b>Video</b> <br> {!! $getPressReleaseData->first()->pr_video_embedded !!}</p>
                            @endisset
                            
                            <div style="text-align:center;">
                                <br>
                                <a href="{{ url('submit-press-release') }}" class="btn"
                                    style="padding:18px 55px;font-size:19px">Submit Press Release</a>
                                <br><br>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-3">
                    <center>
                        <div class="utf_box_widget" style="border-radius: 25px;width: 270px;">
                            <a href="mailto:info@punnaka.com">
                                <img src="{{ url('custom-images/guess-post.jpeg') }}"style="width:300px">
                            </a>
                        </div>
                    </center>

                    <div class="sidebar">
                        <div class="recent">
                            <h3>Recent Press Releases</h3>
                            <div class="releases">
                                @foreach ($getLatestPressReleaseListing as $getLatestPressReleaseRow)
                                    @php
                                        $newPrTitle = str_replace(' ', '-', $getLatestPressReleaseRow->pr_title);
                                    @endphp
                                    <div class="release">
                                        <h4>{{ $getLatestPressReleaseRow->pr_title }}</h4>
                                        <div class="date">
                                            {{ date('j F Y', strtotime($getPressReleaseData->first()->pr_publish_date_time)) }}
                                        </div>

                                        <a href="{{ url('press-release/' . $newPrTitle) }}">Read more →</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection