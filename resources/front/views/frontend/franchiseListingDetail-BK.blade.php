@extends('frontend.layouts.main')
@php
    $franchiseObj = new App\Http\Controllers\frontend\franchiseController();
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ $franchiseDetailResult['f_meta_title'] }}</title>
    <meta name="keywords" content="{{ $franchiseDetailResult['f_meta_keyword'] }}" />
    <meta name="description" content="{{ $franchiseDetailResult['f_meta_description'] }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">

    <style>
        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            margin-bottom: 15px;
            font-size: 18px;
            background-color: #efefef;
            padding: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #424242;
            color: white;
        }

        .locations {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .location-box {
            flex: 1 1 30%;
            background-color: #f2f2f2;
            padding: 15px;
            border-radius: 5px;
            min-width: 250px;
        }

        .location-box h4 {
            margin-bottom: 10px;
            font-size: 16px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        .boxClass {
            text-align: center;
            margin-top: 30px;
            position: relative;
            background: #fff;
            padding: 40px 25px 20px 25px;
            box-shadow: 0 0px 25px rgba(0, 0, 0, 0.12);
            margin-bottom: 20px;
            border-radius: 10px;
            transform: translate3d(0, 0, 0);
            transition: transform 0.3s;
        }
    </style>

    @section('main-container')
        <div class="clearfix"></div>

        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ Route::input('country') }} Franchise Listing Detail</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $franchiseDetailResult['f_city'] . ' / ' . $franchiseDetailResult['f_sub_cat'] . ' / ' . $franchiseDetailResult['f_name'] }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row utf_sticky_main_wrapper" style="margin-top: -40px;">
                <div class="col-lg-8 col-md-8">
                    <div id="titlebar" class="utf_listing_titlebar ">
                        <div class="utf_listing_headline_part margin-top-30 margin-bottom-40">
                            <h3>{{ $franchiseDetailResult['f_name'] }}</h3>
                        </div>
                        <div class="row slick_carousel_slider">
                            <div class="row">
                                <div class="col-md-12">
                                    @php
                                        $franchiseImageObj = new App\Http\Controllers\frontend\franchiseController();
                                        $franchiseImageData = $franchiseImageObj->getAllFranchiseImage(
                                            $franchiseDetailResult->f_id,
                                        );
                                    @endphp
                                    <div class="simple_slick_carousel_block utf_dots_nav">
                                        @foreach ($franchiseImageData as $franchiseImageRow)
                                            <div class="utf_carousel_item">
                                                <div class="utf_listing_item">
                                                    <img src="{{ url('custom-images/franchise-images/' . $franchiseImageRow->fi_path) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="section boxClass">
                        <table class="table" style="line-height: 2.828571;">
                            <tr>
                                <th>Basic Detail</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <b>Name:</b> {{ $franchiseDetailResult->f_name }}<br>
                                    <b>Contact No:</b> {{ $franchiseDetailResult->f_contact_no }}<br>
                                    <b>Email:</b> {{ $franchiseDetailResult->f_email }}<br>
                                    <b>Website:</b> {{ $franchiseDetailResult->f_website }}<br>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                    <div class="section boxClass">
                        <table class="table" style="line-height: 1.828571;">
                            <tr>
                                <th>Business Details</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <b>Brand Name:</b> {{ $franchiseDetailResult->f_brand_name }}<br>
                                    <b>Company Name:</b> {{ $franchiseDetailResult->f_company_name }}<br>
                                    <b>Business Year Established:</b> {{ $franchiseDetailResult->f_brand_name }}<br>
                                    <b>Business Type:</b> {{ $franchiseDetailResult->f_business_type }}<br>
                                    <b>Sector:</b> {{ $franchiseDetailResult->f_main_cat }}<br>
                                    <b>Sub Sector:</b> {{ $franchiseDetailResult->f_sub_cat }}<br>
                                    <b>Products & Services Offered:</b> {{ $franchiseDetailResult->f_child_cat }}

                                </td>
                                <td>
                                    <br>
                                    <b>Franchise Website URL:</b> {{ $franchiseDetailResult->f_franchise_website_url }}<br>
                                    <b>Country:</b> {{ $franchiseDetailResult->f_country }}<br>
                                    <b>State / Region:</b> {{ $franchiseDetailResult->f_state }}<br>
                                    <b>City:</b> {{ $franchiseDetailResult->f_city }}<br>
                                    <b>PIN Code/ ZIP Code:</b> {{ $franchiseDetailResult->f_pin_code }}<br>
                                    <b>Full Address:</b> {{ $franchiseDetailResult->f_franchisee_address }}<br>

                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left;">
                            <b>About Business / Brand:</b><br>
                            {{ $franchiseDetailResult->f_business_desc }}
                        </div>
                    </div>

                    <div class="section boxClass">
                        <table class="table table-responsive">
                            <tr>
                                <th>Franchies Detail</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td style="line-height: 1.828571;">
                                    <span><b>Franchise Type:</b> {{ $franchiseDetailResult->f_franchisee_type }}</span><br>
                                    <span><b>Franchisee Year Established:</b>
                                        {{ $franchiseDetailResult->f_franchisee_year_established }}</span><br>
                                    <span><b>Total Investment:</b>
                                        {{ $franchiseDetailResult->f_total_investment }}</span><br>
                                    <span><b>Franchise Fee:</b> {{ $franchiseDetailResult->f_franchise_fee }}</span><br>
                                    <span><b>Royalty Fee (%):</b> {{ $franchiseDetailResult->f_royalty_fee }}</span><br>
                                    <span><b>Marketing Fee (%):</b>
                                        {{ $franchiseDetailResult->f_marketing_fee }}</span><br>
                                    <span><b>Total Company-Owned Outlets:</b>
                                        {{ $franchiseDetailResult->f_total_company_owned_outlets }}</span><br>
                                    <span><b>Total Franchise Outlets Opened:</b>
                                        {{ $franchiseDetailResult->f_total_franchise_outlets_opened }}</span><br>
                                    <span><b>Other Investment Requirements:</b>
                                        {{ $franchiseDetailResult->f_other_investment_requirements }}</span><br>
                                    <span><b>About Franchisee:</b>{!! $franchiseDetailResult->f_franchisee_desc !!}</span><br>
                    </div>
                </div>

                </td>
                </tr>
                </table>
            </div>
        </div>

        <div class="opening-hours margin-top-110">
            <div class="section boxClass">
                <table class="table">
                    <tr>
                        <th>Location Targeting, Support & Training</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            <b>Available in India:</b> {{ $franchiseDetailResult->f_available_in_india }}<br>
                            <b>International Expansion:</b> {{ $franchiseDetailResult->f_international_expansion }}<br>
                            <b>Preferred Countries & Cities:</b>(<a href="#dialog_signin_part" style="color:red"
                                class="popup-with-zoom-anim">View
                                Location</a>)

                            <div id="dialog_signin_part" class="zoom-anim-dialog mfp-hide" style="max-width: 700px;">
                                <div class="small_dialog_header">
                                    <h3>Location Details</h3>
                                </div>
                                <div class="utf_signin_form style_one">
                                    <div class="tab_container alt">
                                        <div class="tab_content" id="tab1" style="display:none;">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            <center>Sr.NO</center>
                                                        </th>
                                                        <th scope="col">Country</th>
                                                        <th scope="col">City</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color:black">
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($getFranchiseLocationDetail as $getFranchiseLocationRow)
                                                        <tr>
                                                            <th scope="row">
                                                                <center>{{ $i++ }}</center>
                                                            </th>
                                                            <td>{{ $getFranchiseLocationRow['fld_country'] }}</td>
                                                            <td>{{ $getFranchiseLocationRow['fld_city'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div><br>
                            <b>Training Provided:</b> {{ $franchiseDetailResult->f_international_expansion }}<br>
                            <b>Training Duration (Weeks):</b> {{ $franchiseDetailResult->f_training_duration }}<br>
                            <b>Financing Aid:</b> {{ $franchiseDetailResult->f_financing_aid }}<br>
                            <b>Site Selection Assistance:</b> {{ $franchiseDetailResult->f_site_selection_assistance }}<br>
                            <b>Head Office Support to Open:</b>
                            {{ $franchiseDetailResult->f_head_office_support_open }}<br>
                            <b>IT Systems Included:</b> {{ $franchiseDetailResult->f_it_systems_included }}<br>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="section boxClass">
                <table class="table">
                    <tr>
                        <th>Financial Expectations & Property Details</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            <b>Performance Guarantee:</b> {{ $franchiseDetailResult->f_performance_guarantee }}<br>
                            <b>Expected ROI:</b> {{ $franchiseDetailResult->f_expected_roi }}<br>
                            <b>Payback Period (Months):</b> {{ $franchiseDetailResult->f_payback_period }}<br>
                            <b>Franchise Term Duration (Years):</b>
                            {{ $franchiseDetailResult->f_franchise_term_duration }}<br>
                            <b>Is Term Renewable:</b> {{ $franchiseDetailResult->f_franchise_term_duration }}<br>
                            <b>Type of Property Required:</b> {{ $franchiseDetailResult->f_type_property_required }}<br>
                            <b>Minimum Area Required:</b> {{ $franchiseDetailResult->f_minimum_area_required }}<br>
                            <b>Property Location Preference:</b>
                            {{ $franchiseDetailResult->f_property_location_preference }}<br>
                            <b>Who Will Furnish Premises:</b> {{ $franchiseDetailResult->f_who_will_furnish_premises }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="section boxClass">
                <table class="table">
                    <tr>
                        <th>Media & Additional Information</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            <b>Company Logo:</b> <a download style="color: red; font-weight:600" target="_blank"
                                href="http://127.0.0.1:8000/custom-images/franchise-images/{{ $franchiseDetailResult->f_company_logo }}">Download</a><br>

                            <b>Franchise Brochure:</b> <a download style="color: red; font-weight:600" target="_blank"
                                href="http://127.0.0.1:8000/custom-images/franchise-images/{{ $franchiseDetailResult->f_franchise_brochure }}">Download</a><br>

                            <b>Business Registration Certificate:</b> <a download style="color: red; font-weight:600"
                                target="_blank"
                                href="http://127.0.0.1:8000/custom-images/franchise-images/{{ $franchiseDetailResult->f_business_registration_certificate }}">Download</a><br>

                            <b>Franchise Disclosure Document:</b> <a download style="color: red; font-weight:600"
                                target="_blank"
                                href="http://127.0.0.1:8000/custom-images/franchise-images/{{ $franchiseDetailResult->f_franchise_disclosure_document }}">Download</a><br>

                            <b>Products & Services File:</b> <a download style="color: red; font-weight:600" target="_blank"
                                href="http://127.0.0.1:8000/custom-images/franchise-images/{{ $franchiseDetailResult->f_products_services }}">Download</a><br>

                            <b>Corporate Video Link:</b> {{ $franchiseDetailResult->f_corporate_video_url }}<br>
                            <b>Facebook Page Link:</b> {{ $franchiseDetailResult->f_facebook_url }}<br>
                            <b>Twitter (X.com) Page Link:</b> {{ $franchiseDetailResult->f_twitter_url }}<br>
                            <b>Instagram Page link:</b> {{ $franchiseDetailResult->f_instagram_url }}<br>
                            <b>YouTube Link:</b> {{ $franchiseDetailResult->f_youtube_url }}<br>
                            <b>Why Choose You:</b> {{ $franchiseDetailResult->f_why_choose_you }}<br>
                            <b>Success Story:</b> {{ $franchiseDetailResult->f_success_story }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="utf_box_widget opening-hours margin-top-35">
                <h4>Instant apply form for Investor</h4>
                <form method="POST" action="{{ url('franchiseEnquiryStore') }}">
                    @csrf
                    <input type="hidden" name="fe_franchise_id" id="fe_franchise_id"
                        value="{{ $franchiseDetailResult->f_id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="fe_name" type="text" placeholder="Your Name" required />
                        </div>
                        <div class="col-md-12">
                            <input name="fe_email" type="text" placeholder="Email" required />
                        </div>
                        <div class="col-md-12">
                            <input name="fe_contact_no" type="text" placeholder="Contact No" required />
                        </div>
                        <div class="col-md-12">
                            <input name="fe_country" type="text" placeholder="Country for Franchisee" required />
                        </div>
                        <div class="col-md-12">
                            <input name="fe_state" type="text" placeholder="State for Franchisee" required />
                        </div>

                        <div class="col-md-12">
                            <input name="fe_city" type="text" placeholder="City for Franchisee" required />
                        </div>

                        <div class="col-md-12">
                            <input name="fe_investment_range" type="text" placeholder="Investment Range" required />
                        </div>

                        <div class="col-md-12">
                            <textarea name="fe_investment_range" cols="40" rows="2" id="fe_investment_range" placeholder="Address"
                                required></textarea>
                        </div>
                    </div>
                    <center> <input type="submit" class="submit button" id="submit" value="Submit" /></center>
                </form>
            </div>
        </div>
        </div>
        </div>
    @endsection
