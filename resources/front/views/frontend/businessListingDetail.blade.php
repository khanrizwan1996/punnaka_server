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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" /> --}}
    <style>
        .box {
            padding: 15px;
            box-shadow:
                rgba(0, 0, 0, 0.29) 0px 1px 10px;
            background: rgb(255, 255, 255);
            display: flow-root;
            border-radius: 12px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 {
            margin: 0;
            color: #333;
        }

        .write-review {
            color: #00aaff;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1em;
        }

        .reviews-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .review {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            flex: 1;
            min-width: 280px;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 0.9em;
        }

        .stars {
            color: #ffd700;
            font-size: 1.2em;
        }

        .review-text {
            margin-top: 10px;
            color: #333;
        }

        /* Popup */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup {
            background: white;
            padding: 30px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .popup h3 {
            margin-top: 0;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 1.8em;
            font-weight: bold;
            color: #999;
        }

        .star-rating {
            direction: ltr;
            /* Left to right */
            unicode-bidi: unset;
            display: inline-block;
        }

        .star-rating label {
            float: right;
            /* Hover fill from right */
            font-size: 40px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: #ffd700;
        }

        .star-rating input {
            display: none;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background: #00aaff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .verified {
            color: #1ba94c;
            font-weight: 600;
            margin-left: 8px;
        }
        .verified-badge {
            color: #1ba94c;
            font-weight: 600;
        }
    </style>
    @section('main-container')
        <div class="clearfix"></div>
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2> Business Listing Detail</h2>
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
        @php
            $imagePathObj = new App\Http\Controllers\frontend\businessListingController();
            $imagePath = $imagePathObj->GetBusinessImage($businessLisitngDetailArray['bus_id']);
        @endphp
        <div class="container">
            <div class="row">
                <div class="box">
                    <div class="col-lg-6 col-md-6">
                        <div class="utf_listing_headline_part margin-top-30 margin-bottom-40">
                            <h2 class="text-2xl font-bold mb-2">{{ strtoupper($businessLisitngDetailArray->bus_name) }}
                                {{-- <span class="verified"><i class="bi bi-patch-check-fill"></i>Verified</span> --}}
                            </h2>
                        </div>
                        <p class="mb-4 text-justify">
                            {!! Str::of(Str::substr($businessLisitngDetailArray->bus_desc, 0, 550))->stripTags() !!}....</p>
                        <div class="flex gap-3">
                            <a href="tel:{{ $businessLisitngDetailArray->bus_contact_no }}" class="submit button">📞 Call
                                now</a>
                            <a href="{{ $businessLisitngDetailArray->bus_website_url }}" class="submit button">🌐 Visit
                                website</a>
                            <a href="{{ $businessLisitngDetailArray->bus_map_direction_url }}" target="_blank"
                                class="submit button">🗺️ Get Direction</a>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1"></div>
                    <div class="col-lg-5 col-md-5" style="margin-top: 45px;">
                        <img src="{{ url('custom-images/business-images/images/' . $imagePath) }}"
                            style="width: 66%;border-radius: 30px;">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 60px;">
                <div class="box">
                    <div class="col-lg-6 col-md-6">
                        <h3 style="font-size: 20px; font-weight: bold;text-transform: uppercase;">About Us</h3>
                        <br>
                        <p>{!! $businessLisitngDetailArray->bus_desc !!}</p>
                        <br>
                        <h3 style="font-size: 20px; font-weight: bold;text-transform: uppercase;">Products & Services
                            Provided</h3>
                        <ul class="utf_listing_detail_sidebar">
                            <div id="utf_listing_tags"
                                class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">
                                @foreach (explode(',', $businessLisitngDetailArray['bus_product_service']) as $productServiceName)
                                    <a href="#" style="border: 1px solid #3fb4e4;">{{ $productServiceName }}</a>
                                @endforeach
                            </div>
                        </ul>
                        <br>
                        <h3 style="font-size: 20px; font-weight: bold;text-transform: uppercase;">Other Information</h3>

                        <p style="line-height: 35px;">
                            <i class="fa fa-user" aria-hidden="true"></i> <b>Social Media Profile</b>:
                            @isset($businessLisitngDetailArray->bus_facebook_url)
                                <a target="_blank" href="{{ $businessLisitngDetailArray->bus_facebook_url }}">
                                    <img src="{{ url('custom-images/icons/fb.png') }}" style="height: 18px;" /> &nbsp;
                                </a>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_instagram_url)
                                <a target="_blank" href="{{ $businessLisitngDetailArray->bus_instagram_url }}">
                                    <img src="{{ url('custom-images/icons/insta.png') }}" style="height: 18px;" /> &nbsp;
                                </a>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_twitter_url)
                                <a target="_blank" href="{{ $businessLisitngDetailArray->bus_twitter_url }}">
                                    <img src="{{ url('custom-images/icons/twitter.png') }}" style="height: 18px;" />&nbsp;
                                </a>
                            @endisset

                            @isset($businessLisitngDetailArray->bus_video_url)
                                <a target="_blank" href="{{ $businessLisitngDetailArray->bus_video_url }}">
                                    <img src="{{ url('custom-images/icons/youtube.png') }}" style="height: 18px;" />&nbsp;
                                </a>
                            @endisset


                            @isset($businessLisitngDetailArray->bus_start_year)
                                <br><i class="fa fa-calendar" aria-hidden="true"></i> <b>Opening Year</b> :
                                {{ $businessLisitngDetailArray->bus_start_year }}
                            @endisset

                            @isset($businessLisitngDetailArray->bus_avg_price_range)
                                <br><i class="fa fa-money" aria-hidden="true"></i> <b>Average Price Range</b> :
                                {{ $businessLisitngDetailArray->bus_avg_price_range }}
                            @endisset

                            @isset($businessLisitngDetailArray->bus_payment_mode)
                                <br><i class="fa fa-credit-card" aria-hidden="true"></i> <b>Payment Mode</b> :
                                {{ preg_replace('/[!?,.](?![!?,.\s])/', '$0 ', $businessLisitngDetailArray->bus_payment_mode) }}
                            @endisset

                            @isset($businessLisitngDetailArray->bus_punnaka_discount)
                                <br><i class="fa fa-percent" aria-hidden="true"></i> <b>Offers</b> :
                                {{ $businessLisitngDetailArray->bus_punnaka_discount }}
                            @endisset
                        </p>
                    </div>

                    <div class="col-lg-1 col-md-1"></div>
                    <div class="col-lg-5 col-md-5">
                        <h3 style="font-size: 20px; font-weight: bold;text-transform: uppercase;">Contact Information</h3>
                        <br>
                        <p>
                            <i class="fa fa-phone"></i>
                            <a href="tel:{{ $businessLisitngDetailArray->bus_contact_no }}"> &emsp;
                                {{ $businessLisitngDetailArray->bus_contact_no }}
                            </a>
                        </p>
                        <p>
                            <i class="fa fa-whatsapp"></i>
                            <a href="tel:{{ $businessLisitngDetailArray->bus_alt_contact_no }}"> &emsp;
                                {{ $businessLisitngDetailArray->bus_alt_contact_no }}
                            </a>
                        </p>
                        <p>
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:{{ $businessLisitngDetailArray->bus_email }}"> &emsp;
                                {{ $businessLisitngDetailArray->bus_email }}
                            </a>
                        </p>
                        <p><i class="fa fa-map-pin"></i> &emsp; {{ $businessLisitngDetailArray['bus_address1'] }}</p>
                        <p><i class="fa fa-globe" aria-hidden="true"></i>
                            <a href="{{ $businessLisitngDetailArray->bus_website_url }}" target="_blank"
                                style="color: #3fb4e4;">
                                &emsp; {{ $businessLisitngDetailArray->bus_website_url }}
                            </a>
                        </p>

                        <ul>
                            <div class="row">
                                <h3 style="font-size: 20px; font-weight: bold;text-transform: uppercase;"><i
                                        class="fa fa-clock-o"></i> Business Timing</h3>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_status) &&
                                            $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_status == 1)
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Monday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">

                                            @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_status) &&
                                                    isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_time_status) &&
                                                    $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_time_status == 2)
                                                <span style="font-weight: 400;font-size: 15px;">24 Hours Open </span>
                                            @else
                                                <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;">
                                                    {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_mon_end }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Monday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> Closed
                                            </span>
                                        </div>
                                    @endif
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_status) &&
                                            $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_status == 1)
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Tuesday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_status) &&
                                                    isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_time_status) &&
                                                    $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_time_status == 2)
                                                <span style="font-weight: 400;font-size: 15px;">24 Hours Open </span>
                                            @else
                                                <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;">
                                                    {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_tue_end }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Tuesdays</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> Closed
                                            </span>
                                        </div>
                                    @endif
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_status) &&
                                            $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_status == 1)
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Wednesday
                                            </span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">

                                            @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_status) &&
                                                    isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_time_status) &&
                                                    $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_time_status == 2)
                                                <span style="font-weight: 400;font-size: 15px;">24 Hours Open </span>
                                            @else
                                                <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;">
                                                    {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_wed_end }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Wednesday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> Closed
                                            </span>
                                        </div>
                                    @endif
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_status) &&
                                            $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_status == 1)
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Thursday
                                            </span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">

                                            @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_status) &&
                                                    isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_time_status) &&
                                                    $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_time_status == 2)
                                                <span style="font-weight: 400;font-size: 15px;">24 Hours Open </span>
                                            @else
                                                <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;">
                                                    {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_thu_end }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Thursday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> Closed
                                            </span>
                                        </div>
                                    @endif
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_status) &&
                                            $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_status == 1)
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Friday
                                            </span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_status) &&
                                                    isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_time_status) &&
                                                    $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_time_status == 2)
                                                <span style="font-weight: 400;font-size: 15px;">24 Hours Open </span>
                                            @else
                                                <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;">
                                                    {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_fri_end }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Friday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> Closed
                                            </span>
                                        </div>
                                    @endif
                                    <br>
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_status) &&
                                            $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_status == 1)
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Saturday
                                            </span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">

                                            @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_status) &&
                                                    isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_time_status) &&
                                                    $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_time_status == 2)
                                                <span style="font-weight: 400;font-size: 15px;">24 Hours Open </span>
                                            @else
                                                <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;">
                                                    {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sat_end }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Saturday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> Closed
                                            </span>
                                        </div>
                                    @endif
                                    <br>
                                </li>

                                <li>
                                    @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_status) &&
                                            $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_status == 1)
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Sunday
                                            </span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">

                                            @if (isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_status) &&
                                                    isset($businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_time_status) &&
                                                    $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_time_status == 2)
                                                <span style="font-weight: 400;font-size: 15px;">24 Hours Open </span>
                                            @else
                                                <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;">
                                                    {{ $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_start . ' - ' . $businessLisitngDetailArray->BusinessListingScheduleData->bus_sch_sun_end }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> &emsp13;
                                                Sunday</span>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7">
                                            <span style="font-weight: 400;font-size: 15px; word-spacing: 10px;"> Closed
                                            </span>
                                        </div>
                                    @endif
                                    <br>
                                </li>

                            </div>
                        </ul>
                        <p>
                            <iframe src="{{ $businessLisitngDetailArray->bus_google_profile_url }}" width="100%"
                                height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </p>
                    </div>




                </div>
            </div>

            <br>

            <div class="row slick_carousel_slider">
                <br>
                <div class="col-md-12">
                    <h3 class="headline_part"> Gallery</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="simple_slick_carousel_block utf_dots_nav">
                            @php
                                $businessImageObj = new App\Http\Controllers\frontend\businessListingController();
                                $businessImageArray = $businessImageObj->getAllBusinessImage(
                                    $businessLisitngDetailArray->bus_id,
                                );
                            @endphp
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
            <br><br>
            <div class="box row">
                <h2>Reviews</h2>
                @if (isset(Auth::user()->name))
                    <div class="write-review" onclick="openPopup()">Write a review for
                        {{ $businessLisitngDetailArray->bus_name }} </div>
                @else
                    <a href="{{ url('user-admin/login') }}" class="write-review">Login to write a review</a>
                @endif

                <div class="reviews-container">
                    @foreach ($businessLisitngReview as $businessLisitngReviewRow)
                        <div class="review">
                            <div class="review-header">
                                <strong>{{ $businessLisitngReviewRow->name }}</strong>
                                <span>{{ date('j F Y', strtotime($businessLisitngReviewRow->blr_adde_time)) }}</span>
                            </div>
                            <div class="stars">{{ str_repeat('★', $businessLisitngReviewRow->blr_star) }}</div>
                            <div class="review-text">{{ $businessLisitngReviewRow->blr_review }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>

        </div>

        @if (isset(Auth::user()->name))
            <div class="popup-overlay" id="popup" style="margin-top: 30px;">
                <div class="popup">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h3>Write a Review {{ $businessLisitngDetailArray->bus_name }}</h3>
                    <span>Share your experience to help others make better decisions.</span>
                    <br><br>
                    <form method="POST" action="{{ url('businessListingReviewStore') }}">
                        @csrf
                        <input type="hidden" name="business_city" value="{{ Route::input('city') }}">
                        <input type="hidden" name="business_category" value="{{ Route::input('category') }}">
                        <input type="hidden" name="business_title" value="{{ Route::input('title') }}">
                        <input type="hidden" name="blr_business_listing_id"
                            value="{{ $businessLisitngDetailArray->bus_id }}">

                        <label>Your Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" placeholder="Your Name" value="{{ Auth::user()->name }}"
                            disabled style="background-color:#e2dfdf" required>
                        <span>Your name will be visible with the review</span>

                        <br><br>
                        <label>Your Rating <span class="text-danger">*</span></label>

                        <div class="star-rating">
                            <input type="radio" id="star5" name="blr_star" value="5" required><label
                                for="star5">★</label>
                            <input type="radio" id="star4" name="blr_star" value="4"><label
                                for="star4">★</label>
                            <input type="radio" id="star3" name="blr_star" value="3"><label
                                for="star3">★</label>
                            <input type="radio" id="star2" name="blr_star" value="2"><label
                                for="star2">★</label>
                            <input type="radio" id="star1" name="blr_star" value="1">
                            <label for="star1">★</label>
                        </div>
                        <br><br>
                        <label>Your Review <span class="text-danger">*</span></label>
                        <textarea name="blr_review" rows="5"
                            placeholder="Tell us about service quality, pricing, puncually, and overall experience" required></textarea>
                        <center><button type="submit" style="color: white;">Submit Review</button></center>
                    </form>
                </div>
            </div>
        @endif
        <script>
            function openPopup() {
                document.getElementById('popup').style.display = 'flex';
            }

            function closePopup() {
                document.getElementById('popup').style.display = 'none';
            }
        </script>
    @endsection
