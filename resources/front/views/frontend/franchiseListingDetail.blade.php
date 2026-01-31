@extends('frontend.layouts.main')
@php
    $franchiseObj = new App\Http\Controllers\frontend\franchiseController();
    $franchiseImageObj = new App\Http\Controllers\frontend\franchiseController();
    $wordCount = str_word_count($franchiseDetailResult->f_franchisee_desc) * 4 - 300;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        /* body {
      background-color: #f5f7fa;
      font-family: "Segoe UI", sans-serif;
      color: #333;
    } */
        .customFontSize17 {
            font-size: 17px;
        }

        .main-card {
            background-color: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 25px 30px;
            margin-bottom: 25px;
        }

        .brand-logo {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            background-color: #004aad;
            color: #fff;
            font-weight: bold;
            font-size: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
        }

        .verified {
            color: #1ba94c;
            font-weight: 600;
            margin-left: 8px;
        }

        .btn-call {
            background-color: #004aad;
            color: #fff;
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
        }

        .btn-whatsapp {
            background-color: #25d366;
            color: #fff;
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
        }

        .nav-tabs {
            border-bottom: 2px solid #e4e4e4;
            margin-top: 25px;
        }

        .nav-tabs .nav-link {
            color: #555;
            font-weight: 600;
            border: none;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #004aad;
            border-bottom-color: #004aad;
        }

        .info-box {
            text-align: center;
            border-right: 1px solid #e4e4e4;
        }

        .info-box:last-child {
            border-right: none;
        }

        .info-box h6 {
            color: #666;
            font-weight: 600;
        }

        .info-box p {
            color: #222;
            font-weight: 700;
        }

        h5 {
            color: #004aad;
            font-weight: 700;
            margin-bottom: 15px;
        }

        h6 {
            font-weight: 600;
            color: #333;
            margin-top: 10px;
        }

        .download-btn {
            width: 100%;
        }

        .media img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
        }

        .contact {
            background-color: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        hr {
            border-top: 1px solid gray !important;
            border-top: 1px solid #eee;
        }

        .customHeight52 {
            height: 52px !important;
        }

        .verified-badge {
            color: #1ba94c;
            font-weight: 600;
        }

        .social-section {
            background-color: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-top: 25px;
        }

        .social-icons a {
            color: #004aad;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: 0.3s;
        }

        .social-icons a:hover {
            color: #1ba94c;
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
            <div class="row utf_sticky_main_wrapper">
                <div class="main-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex align-items-center mb-2">
                            <div class="brand-logo">{{ Str::substr($franchiseDetailResult->f_brand_name, 0, 1) }}</div>
                            <div>
                                <h4 class="mb-0" style="font-size: 20px; font-weight: bold;">
                                    {{ strtoupper($franchiseDetailResult->f_brand_name) }} 
                                    <span class="verified"><i class="bi bi-patch-check-fill"></i>Verified</span>
                                </h4>
                                <small>{{ strtoupper($franchiseDetailResult->f_company_name) }}</small>
                            </div>
                        </div>

                        <div>
                            <a class="btn btn-call me-2 customFontSize17"
                                href="tel:{{ $franchiseDetailResult->f_contact_no }}"><i class="bi bi-telephone"></i>
                                Call</a>
                            <a class="btn btn-whatsapp customFontSize17"
                                href="tel:{{ $franchiseDetailResult->f_contact_no }}"><i class="bi bi-whatsapp"></i>
                                WhatsApp</a>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="franchiseTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active customFontSize17" id="overview-tab" data-bs-toggle="tab"
                                data-bs-target="#overview" type="button" role="tab">Overview</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link customFontSize17" id="investment-tab" data-bs-toggle="tab"
                                data-bs-target="#investment" type="button" role="tab">Franchise Model &
                                Investment</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link customFontSize17" id="property-tab" data-bs-toggle="tab"
                                data-bs-target="#property" type="button" role="tab">Property Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link customFontSize17" id="support-tab" data-bs-toggle="tab"
                                data-bs-target="#support" type="button" role="tab">Support & Training</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link customFontSize17" id="docs-tab" data-bs-toggle="tab"
                                data-bs-target="#docs" type="button" role="tab">Documents & Downloads</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link customFontSize17" id="media-tab" data-bs-toggle="tab"
                                data-bs-target="#media" type="button" role="tab">Media</button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="tab-content" id="franchiseTabContent">

                    <!-- Overview -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <div class="main-card">
                            <div class="row text-center">
                                <div class="col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-6 info-box" style="width:50%">
                                            <h6 class="customFontSize17">Total Investment</h6>
                                            <p>{{ $franchiseDetailResult->f_total_investment }}</p>
                                        </div>
                                        <div class="col-6 info-box" style="width:50%">
                                            <h6 class="customFontSize17">Franchise Fee</h6>
                                            <p>{{ $franchiseDetailResult->f_franchise_fee }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-6 info-box" style="width:50%">
                                            <h6 class="customFontSize17">Expected ROI</h6>
                                            <p>{{ $franchiseDetailResult->f_expected_roi }}</p>
                                        </div>
                                        <div class="col-6 info-box" style="width:50%">
                                            <h6 class="customFontSize17">Outlets Comapny</h6>
                                            <p>{{ $franchiseDetailResult->f_total_company_owned_outlets }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h4><b>About Business / Brand</b></h4>
                                    <p>{!! $franchiseDetailResult->f_business_desc !!}</p>
                                    <h4><b>Products & Services Offered</b></h4>
                                    <p>{{ $franchiseDetailResult->f_child_cat }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4><b>Why Choose Us?</b></h4>
                                    <p>{!! $franchiseDetailResult->f_why_choose_you !!}</p>
                                    <h4><b>Success Story</b></h4>
                                    <p>{!! $franchiseDetailResult->f_success_story !!}</p>
                                </div>

                                <div class="col-md-12">
                                    <h4><b>About Franchise</b></h4>
                                    <p>{!! $franchiseDetailResult->f_franchisee_desc !!}</p>
                                </div>

                            </div>


                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="main-card h-100">
                                    <h4><b>Franchise Model & Investment</b></h4>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Franchise Types</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ str_replace(',', ', ', $franchiseDetailResult->f_franchisee_type) }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Franchise Fee</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_franchise_fee }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Marketing Fee</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_marketing_fee }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Other Invest</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_other_investment_requirements }}</p>
                                        </div>
                                    </div>

                                    @if (isset($franchiseDetailResult->f_business_year_established))
                                        <hr>
                                        <div class="row customHeight52">
                                            <div class="col-md-6">
                                                <p>Business Year Established</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $franchiseDetailResult->f_business_year_established }}</p>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="main-card h-100">
                                    <h4><b>Property Details</b></h4>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Property Type</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_type_property_required }}</p>
                                        </div>
                                    </div>
                                    {{-- <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Preferred Location</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_property_location_preference }}</p>
                                        </div>
                                    </div> --}}
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Area Required</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_minimum_area_required }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Who Will Furnish Premises</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_who_will_furnish_premises }}</p>
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Performance Guarantee</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_performance_guarantee }}</p>
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Payback Period (Months)</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_payback_period }}</p>
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Franchise Term Duration (Years)</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_franchise_term_duration }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Is Term Renewable</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_term_renewable }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Type of Property Required</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_type_property_required }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Minimum Area Required</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_minimum_area_required }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Property Location Preference</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_property_location_preference }}</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="main-card h-100">
                                    <h4><b>Support Training</b></h4>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Training Provided</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ str_replace(',', ', ', $franchiseDetailResult->f_training_provided) }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Training Duration</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_training_duration }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Financing Aid</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_financing_aid }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Site Selection Assistance</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_site_selection_assistance }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>IT System included</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_it_systems_included }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="main-card h-100">
                                    <h4><b>Document Download</b></h4>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Franchise brochure</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><a download
                                                    href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_franchise_brochure) }}"
                                                    class="btn btn-outline-primary download-btn">Download</a></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Franchise Disclosure Document</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><a download=""
                                                    href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_franchise_disclosure_document) }}"
                                                    class="btn btn-outline-primary download-btn">Download</a></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Business Registration Certificate</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><a download=""
                                                    href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_business_registration_certificate) }}"
                                                    class="btn btn-outline-primary download-btn">Download</a></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Products & Services</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><a download=""
                                                    href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_products_services) }}"
                                                    class="btn btn-outline-primary download-btn">Download</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="main-card h-100">
                                    <h4><b>Media</b></h4>
                                    <div class="row slick_carousel_slider">
                                        <div class="col-md-12">
                                            @php
                                                $franchiseImageData1 = $franchiseImageObj->getAllFranchiseImage(
                                                    $franchiseDetailResult->f_id,
                                                );
                                            @endphp
                                            <div class="simple_slick_carousel_block utf_dots_nav">
                                                @foreach ($franchiseImageData1 as $franchiseImageRow1)
                                                    <div class="utf_carousel_item">
                                                        <div class="utf_listing_item">
                                                            <img src="{{ url('custom-images/franchise-images/' . $franchiseImageRow1->fi_path) }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="main-card h-100">
                                    <h4><b>Contact Details</b></h4>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Contact Person</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_name }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Contact No</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><a href="tel:{{ $franchiseDetailResult->f_contact_no }}" style="color: #3fb4e4">{{ $franchiseDetailResult->f_contact_no }}</a></p>
                                        </div>
                                    </div>
                                    <hr>

                                    @if(isset($franchiseDetailResult->f_alt_contact_no))
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Alternative Contact Number/ WhatsApp Number</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><a href="tel:{{ $franchiseDetailResult->f_alt_contact_no }}" style="color: #3fb4e4">{{ $franchiseDetailResult->f_alt_contact_no }}</a></p>
                                        </div>
                                    </div>
                                    <hr>
                                    @endif

                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Email Address</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><a href="mailto:{{ $franchiseDetailResult->f_email }}" style="color: #3fb4e4">{{ $franchiseDetailResult->f_email }}</a></p>
                                        </div>
                                    </div>

                                    

                                    @if (isset($franchiseDetailResult->f_website))
                                        <hr>
                                        <div class="row customHeight52">
                                            <div class="col-md-6">
                                                <p>Website</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><a href="{{ $franchiseDetailResult->f_website }}" target="_blank"
                                                        style="color: #3fb4e4">{{ $franchiseDetailResult->f_website }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Business Address</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_franchisee_address }}</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Investment -->
                    <div class="tab-pane fade" id="investment" role="tabpanel">
                        <div class="main-card h-100" style="height:{{ $wordCount }}px !important">
                            <h4><b>Franchise Model & Investment</b></h4>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Franchise Types</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ str_replace(',', ', ', $franchiseDetailResult->f_franchisee_type) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Franchise Fee</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_franchise_fee }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Marketing Fee</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_marketing_fee }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Other Invest</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_other_investment_requirements }}</p>
                                </div>
                            </div>
                            <hr>

                            @if (isset($franchiseDetailResult->f_business_year_established))
                                <div class="row customHeight52">
                                    <div class="col-md-6">
                                        <p>Business Year Established</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $franchiseDetailResult->f_business_year_established }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endif
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>About Franchise </p>
                                </div>
                                <div class="col-md-12">
                                    <p>{!! $franchiseDetailResult->f_franchisee_desc !!}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Property -->
                    <div class="tab-pane fade" id="property" role="tabpanel">
                        <div class="main-card h-100">
                            <h4><b>Property Details</b></h4>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Property Type</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_type_property_required }}</p>
                                </div>
                            </div>
                            {{-- <hr>
                                    <div class="row customHeight52">
                                        <div class="col-md-6">
                                            <p>Preferred Location</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $franchiseDetailResult->f_property_location_preference }}</p>
                                        </div>
                                    </div> --}}
                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Area Required</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_minimum_area_required }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Who Will Furnish Premises</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_who_will_furnish_premises }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Performance Guarantee</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_performance_guarantee }}</p>
                                </div>
                            </div>


                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Payback Period (Months)</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_payback_period }}</p>
                                </div>
                            </div>


                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Franchise Term Duration (Years)</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_franchise_term_duration }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Is Term Renewable</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_term_renewable }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Type of Property Required</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_type_property_required }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Minimum Area Required</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_minimum_area_required }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Property Location Preference</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_property_location_preference }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Support -->
                    <div class="tab-pane fade" id="support" role="tabpanel">
                        <div class="main-card h-100">
                            <h4><b>Support Training</b></h4>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Training Provided</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ str_replace(',', ', ', $franchiseDetailResult->f_training_provided) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Training Duration</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_training_duration }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Financing Aid</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_financing_aid }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>Site Selection Assistance</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_site_selection_assistance }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row customHeight52">
                                <div class="col-md-6">
                                    <p>IT System included</p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $franchiseDetailResult->f_it_systems_included }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="tab-pane fade" id="docs" role="tabpanel">
                        <div class="main-card h-100">
                            <h4><b>Document Download</b></h4>
                            <div class="row customHeight52">
                                <div class="col-md-3">
                                    <p>Franchise brochure</p>

                                    <p><a download
                                            href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_franchise_brochure) }}"
                                            class="btn btn-outline-primary download-btn">Download</a></p>
                                </div>

                                <div class="col-md-3">
                                    <p>Franchise Disclosure Document</p>

                                    <p><a download=""
                                            href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_franchise_disclosure_document) }}"
                                            class="btn btn-outline-primary download-btn">Download</a></p>
                                </div>

                                <div class="col-md-3">
                                    <p>Business Registration Certificate</p>

                                    <p><a download=""
                                            href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_business_registration_certificate) }}"
                                            class="btn btn-outline-primary download-btn">Download</a></p>
                                </div>


                                <div class="col-md-3">
                                    <p>Products & Services</p>

                                    <p><a download=""
                                            href="{{ url('custom-images/franchise-images/' . $franchiseDetailResult->f_products_services) }}"
                                            class="btn btn-outline-primary download-btn">Download</a></p>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>

                    <!-- Media -->
                    <div class="tab-pane fade" id="media" role="tabpanel">
                        <div class="main-card h-100">
                            <h4><b>Media</b></h4>
                            <div class="row slick_carousel_slider">
                                <div class="col-md-12">
                                    @php
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
                    </div>

                </div>

                <div class="social-section mt-4 text-center">
                    <p><i style="color: #004aad" class="bi bi-patch-check-fill"></i> Verified Listing <span
                            class="text-muted small">Last Updated:
                            @if (!empty($franchiseDetailResult->f_changed_time))
                                {{ date('j F Y', strtotime($franchiseDetailResult->f_changed_time)) }}
                            @endif
                        </span>
                        <br>
                        <span class="text-muted small">Agreement to <a href="{{ url('term-conditions') }}"
                                target="_blank" style="color:#3fb4e4"><strong>Terms of Use</strong></a> & <a
                                href="{{ url('privacy-policy') }}" target="_blank"
                                style="color:#3fb4e4"><strong>Policy</strong></a></span>
                    </p>

                    <div class="social-icons mt-3">
                        <a target="_blank" href="{{ $franchiseDetailResult->f_facebook_url }}"><i
                                class="bi bi-facebook"></i></a>
                        <a target="_blank" href="{{ $franchiseDetailResult->f_instagram_url }}"><i
                                class="bi bi-instagram"></i></a>
                        <a target="_blank" href="{{ $franchiseDetailResult->f_youtube_url }}"><i
                                class="bi bi-youtube"></i></a>
                        <a target="_blank" href="{{ $franchiseDetailResult->f_twitter_url }}"><i
                                class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
