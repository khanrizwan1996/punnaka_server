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
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 listing_grid_item">

                    <div class="email-cta">
                        <h1><b>Publish Your Press Release</b></h1>
                        <p>Get permanent visibility, global reach, and powerful SEO — live in 24–72 hours</p>
                        <p style="font-size:22px">Just email your Word file to</p>
                        <strong>info@punnaka.com</strong>
                        <a href="mailto:info@punnaka.com" class="btn">Submit Your Press Release Today →</a>
                    </div>

                    <div class="utf_listing_headline_part margin-top-30 margin-bottom-40">
                        <h2 class="text-2xl font-bold mb-2">Benefits of Press Release</h2>
                    </div>
                    <div class="features">
                        <div class="feat">
                            <h3>Permanent URL</h3>Lifetime archive
                        </div>
                        <div class="feat">
                            <h3>Full SEO</h3>Google indexed
                        </div>
                        <div class="feat">
                            <h3>Fast Approval</h3>24–72 hours
                        </div>
                        <div class="feat">
                            <h3>Affordable</h3>Startup-friendly
                        </div>
                    </div>

                    <div class="row">
                        <div class="box">
                            <br>
                            &emsp;<span
                                style="color: white;background: #a00404;padding: 2px 7px;font-size: 13px;">{{ strtoupper($getPressReleaseData->first()->pr_city) }}</span>
                            <br>
                            <span
                                style="font-size: 26px; color: #000; font-weight: bolder; ">&nbsp;&nbsp;{{ $getPressReleaseData->first()->pr_title }}</span>
                            <p style="font-size: 14px;">&emsp; <i class="fa fa-user" aria-hidden="true"></i> By
                                {{ $getPressReleaseData->first()->pr_publisher }}
                                &emsp; <i class="fa fa-calendar" aria-hidden="true"></i>
                                {{ date('j F Y', strtotime($getPressReleaseData->first()->pr_publish_date_time)) }}
                            </p>
                            <div class="col-lg-12 col-md-12">
                                <img src="{{ url('custom-images/press-release/' . $getPressReleaseData->first()->pr_logo) }}"
                                    style="width: 50%;">
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <br>
                                <p class="mb-4 text-justify"><b>Category:</b>
                                    {{ $getPressReleaseData->first()->pr_main_cat . ' / ' . $getPressReleaseData->first()->pr_sub_cat }}
                                </p>
                                <p class="mb-4 text-justify"><b>Author:</b> {{ $getPressReleaseData->first()->pr_author }}
                                </p>

                                @isset($getPressReleaseData->first()->pr_modified_date_time)
                                    <p class="mb-4 text-justify"><b>Modified Date & Time:</b>
                                        {{ $getPressReleaseData->first()->pr_modified_date_time }}</p>
                                @endisset

                                @isset($getPressReleaseData->first()->pr_content_location)
                                    <p class="mb-4 text-justify"><b>Content Location:</b>
                                        {{ $getPressReleaseData->first()->pr_content_location }}</p>
                                @endisset

                                @isset($getPressReleaseData->first()->pr_attachment)
                                    <p class="mb-4 text-justify"><b>PDF Attachment: </b> <a download="" class="text-primary"
                                            href="{{ url('custom-images/press-release/' . $getPressReleaseData->first()->pr_attachment) }}"><b>
                                                Download </b> </a></p>
                                @endisset

                                {{-- @isset($getPressReleaseData->first()->pr_video_embedded)
                                    <p class="mb-4 text-justify"><b>Video</b> <br> {!! $getPressReleaseData->first()->pr_video_embedded  !!}</p>
                                @endisset --}}

                                <p class="mb-4 text-justify">{!! $getPressReleaseData->first()->pr_desc !!}</p>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 60px;margin-left: -28px;">
                        <div class="col-lg-12 col-md-12">
                            <div id="utf_listing_gallery_part" class="utf_listing_section">
                                <div class="utf_listing_slider utf_gallery_container margin-bottom-0">
                                    @foreach ($getPressReleaseData->pluck('PressReleaseImages')->collapse() as $PressReleaseImagesRow)
                                        <a href="{{ url('custom-images/press-release-multiple-images/' . $PressReleaseImagesRow->pri_path) }}"
                                            data-background-image="{{ url('custom-images/press-release-multiple-images/' . $PressReleaseImagesRow->pri_path) }}"
                                            class="item utf_gallery"></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="recent">
                        <h2>Recent Press Releases</h2>
                        <div class="releases">

                            @foreach ($getLatestPressReleaseListing as $getLatestPressReleaseRow)
                                <div class="release">
                                    <h4>{{ $getLatestPressReleaseRow->pr_title }}</h4>
                                    <div class="date">
                                        {{ date('j F Y', strtotime($getPressReleaseData->first()->pr_publish_date_time)) }}
                                    </div>
                                    <p>{!! substr($getLatestPressReleaseRow->pr_desc, 0, 160) !!}</p>
                                    <a href="#">Read more →</a>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div style="text-align:center;margin:60px 0">
                        <a href="{{url('press-release-detail')}}" class="btn" style="padding:18px 55px;font-size:19px">Press Release Submit Flow</a>
                    </div>

                </div>
            </div>

        </div>
        </div>
    @endsection
