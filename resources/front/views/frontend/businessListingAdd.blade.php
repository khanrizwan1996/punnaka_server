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

    <style type="text/css">
        .switch-field {
            display: flex;
            /*    margin-bottom: 36px;*/
            overflow: hidden;
        }

        .switch-field input {
            position: absolute !important;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            width: 1px;
            border: 0;
            overflow: hidden;
        }

        .switch-field label {
            background-color: #e4e4e4;
            color: rgba(0, 0, 0, 0.6);
            font-size: 14px;
            line-height: 1;
            text-align: center;
            padding: 8px 16px;
            margin-right: -1px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
            transition: all 0.1s ease-in-out;
        }

        .switch-field label:hover {
            cursor: pointer;
        }

        .switch-field input:checked+label {
            background-color: #a5dc86;
            box-shadow: none;
        }

        .switch-field label:first-of-type {
            border-radius: 4px 0 0 4px;
        }

        .switch-field label:last-of-type {
            border-radius: 0 4px 4px 0;
        }

        .label-info {
            background-color: #17a2b8;
        }

        @media only screen and (min-width: 1024px) {
            .custom-MarginLetf {
                margin-left: -30px;
            }
        }

        .heading-section {
            font-size: 20px;
            font-weight: bold;
            padding-top: 28px;
        }
    </style>

    @section('main-container')
        <link rel="stylesheet" href="frontend/css/bootstrap-tagsinput.css"
            integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg=="
            crossorigin="anonymous" />
        <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Business Listing</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Business Listing of PUNNAKA</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container margin-bottom-75">
            <div class="row">
                <div class="col-lg-12">
                    <div id="utf_add_listing_part">
                        <div class="add_utf_listing_section">
                            <div class="utf_add_listing_part_headline_part">
                                <h3>Bulk Business Listing / Multiple Business Listing</h3>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <div class="form-group lis-relative">
                                        <p>If you are not able to fill up business details by website form then please
                                            download below mentioned business listing details Form and email us after
                                            adding
                                            all business details in the downloaded excel file. Download File <a
                                                href="{{ url('custom-images/Business-Lisiting-Formate.xlsx') }}"
                                                download="">Download</a></p>
                                        <p>You also can add multiple business details in the downloaded excel file.</p>
                                        <p>You also can add multiple business location details in the downloaded excel file.
                                        </p>
                                        <p> After filling up business details, email us at <a
                                                style="font-weight: bold;text-decoration: underline;"
                                                href="mailto:info@punnaka.com">info@punnaka.com</a> or whatsapp us at <a
                                                style="font-weight: bold; text-decoration: underline;"
                                                href="https://api.whatsapp.com/send?phone=7875155538&amp;text=&amp;source=&amp;data="
                                                target="_blank">+91-7875155538</a></p>
                                        <p> Once you email us fillup business details excel file, we will upload it in the
                                            website and show to visitors after payment accordingly to selected plan.</p>

                                        <h3><b>List Your Business on Punnaka.</b></h3>
                                        <p>Please enter your details below.</p>
                                        <p><span style="color: red">*</span> denotes required fields</p>
                                        <p> If you face any difficulty while business listing on punnaka.com, then WhatsApp
                                            us at <a style="font-weight: bold; text-decoration: underline;"
                                                href="https://api.whatsapp.com/send?phone=7875155538&amp;text=&amp;source=&amp;data="
                                                target="_blank">+91-7875155538</a> or email us at <a
                                                style="font-weight: bold;text-decoration: underline;"
                                                href="mailto:info@punnaka.com">info@punnaka.com</a></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ url('/businessDetailStore/') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset(Auth::user()->id))
                                <input type="hidden" name="bus_user_id" value="{{ Auth::user()->id }}">
                            @endif
                            <input type="hidden" name="bus_plan_type" value="{{ session('planType') }}">
                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3>Please add your business details below.</h3>
                                </div>
                                <div class="row with-forms">
                                    <div class="col-md-12 heading-section">
                                        🧑‍💼 SECTION 1: Contact Person Details
                                    </div>
                                    @if (isset(Auth::user()->id))
                                        <div class="col-md-4">
                                            <h5>Your Full Name <span style="color: red">*</span></h5>
                                            <input type="text" class="search-field" placeholder="Your Full Name" disabled
                                                value="{{ Auth::user()->name }}" style="background: #efecec;">
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Your Contact No <span style="color: red">*</span></h5>
                                            <input type="text" placeholder="Your Contact No" disabled
                                                value="{{ Auth::user()->contact_no }}" style="background: #efecec;">
                                        </div>
                                    @endif

                                </div>
                                <hr />


                                <div class="row with-forms">
                                    <div class="col-md-12 heading-section">
                                        🏢 SECTION 2: Business Basic Information
                                    </div>

                                    <div class="col-md-4">
                                        <h5>Business Name <i class="fa fa-info-circle" style="color:#3fb4e4"
                                                title="Please enter business name in small letters/lowercase here"></i><span
                                                style="color: red">*</span></h5>
                                        <input type="text" name="bus_name" id="keywords"
                                            placeholder="Please enter business name in small letters/lowercase here"
                                            required>
                                    </div>

                                    <div class="col-md-4">
                                        <h5>Business Start / Opening Year</h5>
                                        <div class="intro-search-field utf-chosen-cat-single"
                                            style="border: 0px solid #dbdbdb !important;">
                                            <select class="default" title="Select Year" name="bus_start_year"
                                                id="bus_start_year">
                                                @php
                                                    $cureentYear = date('Y');
                                                    $year = 1800;
                                                @endphp
                                                @foreach (range('2100', $year) as $yearValue)
                                                    <option value="{{ $yearValue }}"
                                                        @if ($yearValue == $cureentYear) selected style="color:red" @endif>
                                                        {{ $yearValue }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Business Category <span style="color: red">*</span></h5>
                                        {{-- <br><br> --}}
                                        <div class="intro-search-field utf-chosen-cat-single">
                                            <select class="selectpicker default" id="catmain_id" name="bus_main_cat"
                                                title="Select Main Category" required>
                                                <option>Select Category</option>
                                                @foreach ($businessMainCategoryData as $businessMainCategoryRow)
                                                    <option value="{{ $businessMainCategoryRow['cat_main_id'] }}">
                                                        {{ $businessMainCategoryRow['cat_main_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-4">
                                        <h5>Sub category <span style="color: red">*</span></h5>

                                        <div class="intro-search-field utf-chosen-cat-single"
                                            style="border: 0px solid #dbdbdb !important;">
                                            <select class="default" name="bus_sub_cat" id="catsub_id"
                                                title="Select Sub Category" required>
                                                <option>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr />

                                <div class="row with-forms">

                                    <div class="col-md-12 heading-section">
                                        📞 SECTION 3: Business Contact Details
                                    </div>

                                    <div class="col-md-4">
                                        <h5>Business Contact Number <span style="color: red">*</span></h5>
                                        <input type="text" class="search-field" name="bus_contact_no"
                                            id="bus_contact_no" placeholder="Please Enter Business Contact Number"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Business Whatsapp Number</h5>
                                        <input type="text" name="bus_alt_contact_no" id="bus_alt_contact_no"
                                            placeholder="Please Enter Business Whatsapp Number">
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Business Email Address <span style="color: red">*</span></h5>
                                        <input type="email" name="bus_email" id="bus_email"
                                            placeholder="Please Enter Business Email Address" required>
                                    </div>
                                </div>

                                <hr />
                                <div class="col-md-12 heading-section">
                                    📍 SECTION 4: Business Location Details
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-3">
                                        <h5>Business Location (Country) <span style="color: red">*</span></h5>
                                        <input type="text" class="search-field" name="bus_country" id="bus_country"
                                            placeholder="Please Enter Business Location (Country)" required>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>Business Location (State) <span style="color: red">*</span></h5>
                                        <input type="text" name="bus_state" id="bus_state"
                                            placeholder="Please Enter Business Location (State)" required>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>Business Location (City) <span style="color: red">*</span></h5>
                                        <input type="text" name="bus_city" id="bus_city"
                                            placeholder="Please Enter Business Location (City)" required>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>PIN Code / Zip Code <span style="color: red">*</span></h5>
                                        <input type="text" name="bus_pin_code" id="bus_pin_code"
                                            placeholder="Please Enter PIN Code / Zip Code" required>
                                    </div>
                                </div>
                                <div class="row with-forms">
                                    <div class="col-md-6">
                                        <h5>Full Business Address (Physical Location) <span style="color: red">*</span>
                                        </h5>
                                        <textarea name="bus_address1" id="bus_address1" placeholder="Please Enter Full Business Address (Physical Location)"
                                            cols="30" rows="5" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Business Area / Locality Name <span style="color: red">*</span></h5>
                                        <textarea name="bus_address2" id="bus_address2" placeholder="Please Enter Business Area / Locality Name"
                                            cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <hr />
                                <div class="col-md-12 heading-section">
                                    🛍️ SECTION 5: Products & Services Information
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>All of the products & services provided in details <span
                                                style="color: red">*</span></h5>
                                        <textarea name="bus_product_service" id="bus_product_service"
                                            placeholder="Please Enter All of the products & services provided in details" cols="30" rows="5"
                                            required></textarea>
                                    </div>
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>Brief description of your business <span style="color: red">*</span></h5>
                                        <textarea name="bus_desc" id="editor" placeholder="Please Enter Brief description of your business"
                                            cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="row with-forms">
                                    <div class="col-md-4">
                                        <h5>Average price range / fee</h5>
                                        <input type="number" min="0" name="bus_avg_price_range"
                                            id="bus_avg_price_range" placeholder="Please Enter Average price range / fee">
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Discounts / Special Offers</h5>
                                        <input type="text" name="bus_punnaka_discount" id="bus_punnaka_discount"
                                            placeholder="Please Enter Discounts / Special Offers">
                                    </div>
                                </div>
                                <hr />
                                <div class="col-md-12 heading-section">
                                    🌐 SECTION 6: Online Presence & Social Media
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-4">
                                        <h5>Business Website URL</h5>
                                        <input type="text" class="search-field" name="bus_website_url"
                                            id="bus_website_url" placeholder="Please Enter Business Website URL">
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Business Facebook URL</h5>
                                        <input type="text" name="bus_facebook_url" id="bus_facebook_url"
                                            placeholder="Please Enter Business Facebook URL">
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Business Instagram URL</h5>
                                        <input type="text" name="bus_instagram_url" id="bus_instagram_url"
                                            placeholder="Please Enter Business Instagram URL">
                                    </div>
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-4">
                                        <h5>Business Twitter URL</h5>
                                        <input type="text" class="search-field" name="bus_twitter_url"
                                            id="bus_twitter_url" placeholder="Please Enter Business Twitter URL">
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Business video URL</h5>
                                        <input type="text" name="bus_video_url" id="bus_video_url"
                                            placeholder="Please Enter Business video URL">
                                    </div>

                                </div>

                                <hr />
                                <div class="col-md-12 heading-section">
                                    💳 SECTION 7: Payment Information
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-4">
                                        <h5>Payment Mode <span style="color: red">*</span></< /h5>
                                            <br><br>
                                            <div class="intro-search-field utf-chosen-cat-single">
                                                <select class="selectpicker default" title="Select Payment Mode"
                                                    name="bus_payment_mode[]" id="bus_payment_mode" multiple required>
                                                    <option>Select</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Debit Card">Debit Card</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="PhonePe">PhonePe</option>
                                                    <option value="Google Pay">Google Pay</option>
                                                    <option value="BHIM">BHIM</option>
                                                    <option value="Paytm">Paytm</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="Online Money Transfer">Online Money Transfer</option>
                                                </select>
                                            </div>
                                    </div>

                                </div>

                                <hr />
                                <div class="col-md-12 heading-section">
                                    🗺️ SECTION 8: Maps & Google Business
                                </div>

                                <div class="row with-forms">

                                    <div class="col-md-4">
                                        <h5>Google Profile URL</h5>
                                        <input type="text" name="bus_google_profile_url" id="bus_google_profile_url"
                                            placeholder="Please Google Profile URL">
                                    </div>

                                    <div class="col-md-4">
                                        <h5>Directions/Map URL</h5>
                                        <input type="text" name="bus_map_direction_url" id="bus_map_direction_url"
                                            placeholder="Please Directions/Map URL">
                                    </div>

                                    <div class="col-md-12">
                                        <h5>Area Served (Enter locations where you are providing products or services, e.g.
                                            Pune, Mumbai, USA, UK etc.) </h5>
                                        <textarea class="tags" data-role="tagsinput" name="bus_location_tags" id="bus_location_tags"
                                            placeholder="Please Enter Area Served (Enter locations where you are providing products or services, e.g. Pune, Mumbai, USA, UK etc.)"
                                            cols="30" rows="3"></textarea>
                                    </div>

                                </div>

                                <hr />
                                <div class="col-md-12 heading-section">
                                    🖼️ SECTION 9: Media & Verification
                                </div>


                                <div class="row with-forms">


                                    <div class="col-md-4">
                                        <h5>Business Logo / images <span style="color: red">*</span> <i
                                                class="fa fa-info-circle" style="color:#3fb4e4"
                                                title="Upload Multiple images"></i>
                                        </h5>
                                        <input type="file" multiple name="bus_img_log[]" id="bus_img_log" required>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 style="font-size: 15px;">Valid ID proof for business verfication <i
                                                class="fa fa-info-circle" style="color:#3fb4e4"
                                                title="you can upload multiple images"></i></h5>
                                        <input type="file" multiple name="bus_img_id_proof[]" id="bus_img_id_proof">
                                    </div>
                                </div>

                                <hr />
                                <div class="col-md-12 heading-section">
                                    🏷️ SECTION 10: Business Keywords & Tags
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>Business Tags (Enter keywords that describe your business e.g. clothing store,
                                            women clothing store)</h5>
                                        <textarea data-role="tagsinput" class="tags" name="bus_tags"
                                            placeholder="Please Enter Business Tags (Enter keywords that describe your business e.g. clothing store, women clothing store)"
                                            cols="30" rows="3"></textarea>
                                    </div>
                                </div>

                                <hr />
                                <div class="col-md-12 heading-section">
                                    🔍 SECTION 11: SEO Information (Optional but Recommended)
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-6">
                                        <h5>Meta Title (keep your Meta Title within 40-60 characters)</h5>
                                        <input type="text" name="bus_meta_title" id="bus_meta_title"
                                            placeholder="Meta Title (keep your Meta Title within 40-60 characters)">
                                    </div>
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>Meta Keyword</h5>
                                        <textarea name="bus_meta_keyword" id="bus_meta_keyword" cols="30" rows="3"
                                            placeholder="Please Enter Meta Keyword"></textarea>
                                    </div>
                                </div>

                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>Meta Description: (keep your Meta Description up to 160 characters)</h5>
                                        <textarea name="bus_meta_description" id="bus_meta_description" cols="30" rows="3"
                                            placeholder="Please Enter Meta Description: (keep your Meta Description up to 160 characters)"></textarea>
                                    </div>
                                </div>

                            </div>
                            <hr />
                            <div class="col-md-12 heading-section">
                                ⏰ SECTION 12: Business Timings
                            </div>

                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3><i class="sl sl-icon-clock"></i> Business Timings :</h3>
                                </div>
                                <div class="switcher-content">
                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Monday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-one-open" name="bus_sch_mon_status"
                                                    value="1" />
                                                <label for="radio-one-open">Open</label>
                                                <input type="radio" id="radio-one-close" name="bus_sch_mon_status"
                                                    value="0" />
                                                <label for="radio-one-close">Close</label>
                                            </div>
                                        </div>
                                        <div class="row col-md-4">
                                            <div id="bus_sch_mon_24_div" style="display: none">
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_mon_24_set_time"
                                                        name="bus_sch_mon_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_mon_24_hours" name="bus_sch_mon_24"
                                                        value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_mon_set_time" style="display: none;">
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_mon_start" name="bus_sch_mon_start"
                                                        placeholder="Open Time" class="text_field_class"
                                                        style="background-color: gainsboro;" disabled />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_mon_end"
                                                        name="bus_sch_mon_end"style="background-color: gainsboro;" disabled
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Tuesday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-two-open" name="bus_sch_tue_status"
                                                    value="1" />
                                                <label for="radio-two-open">Open</label>
                                                <input type="radio" id="radio-two-close" name="bus_sch_tue_status"
                                                    value="0" />
                                                <label for="radio-two-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_tue_24_div" style="display: none">
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_tue_24_set_time"
                                                        name="bus_sch_tue_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_tue_24_hours" name="bus_sch_tue_24"
                                                        value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_tue_set_time" style="display: none;">
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_tue_start" name="bus_sch_tue_start"
                                                        placeholder="Open Time" class="text_field_class"
                                                        style="background-color: gainsboro;" disabled />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_tue_end"
                                                        name="bus_sch_tue_end"style="background-color: gainsboro;" disabled
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_tue_start" id="bus_sch_tue_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_tue_end" id="bus_sch_tue_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div>
                                         --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Wednesday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-three-open" name="bus_sch_wed_status"
                                                    value="1" />
                                                <label for="radio-three-open">Open</label>
                                                <input type="radio" id="radio-three-close" name="bus_sch_wed_status"
                                                    value="0" />
                                                <label for="radio-three-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_wed_24_div" style="display: none">
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_wed_24_set_time"
                                                        name="bus_sch_wed_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_wed_24_hours" name="bus_sch_wed_24"
                                                        value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_wed_set_time" style="display: none;">
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_wed_start" name="bus_sch_wed_start"
                                                        placeholder="Open Time" class="text_field_class"
                                                        style="background-color: gainsboro;" disabled />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_wed_end"
                                                        name="bus_sch_wed_end"style="background-color: gainsboro;" disabled
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_wed_start" id="bus_sch_wed_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_wed_end" id="bus_sch_wed_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Thursday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-four-open" name="bus_sch_thu_status"
                                                    value="1" />
                                                <label for="radio-four-open">Open</label>
                                                <input type="radio" id="radio-four-close" name="bus_sch_thu_status"
                                                    value="0" />
                                                <label for="radio-four-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_thu_24_div" style="display: none">
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_thu_24_set_time"
                                                        name="bus_sch_thu_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_thu_24_hours" name="bus_sch_thu_24"
                                                        value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_thu_set_time" style="display: none;">
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_thu_start" name="bus_sch_thu_start"
                                                        placeholder="Open Time" class="text_field_class"
                                                        style="background-color: gainsboro;" disabled />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_thu_end"
                                                        name="bus_sch_thu_end"style="background-color: gainsboro;" disabled
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_thu_start" id="bus_sch_thu_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_thu_end" id="bus_sch_thu_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Friday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-five-open" name="bus_sch_fri_status"
                                                    value="1" />
                                                <label for="radio-five-open">Open</label>
                                                <input type="radio" id="radio-five-close" name="bus_sch_fri_status"
                                                    value="0" />
                                                <label for="radio-five-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_fri_24_div" style="display: none">
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_fri_24_set_time"
                                                        name="bus_sch_fri_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_fri_24_hours" name="bus_sch_fri_24"
                                                        value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_fri_set_time" style="display: none;">
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_fri_start" name="bus_sch_fri_start"
                                                        placeholder="Open Time" class="text_field_class"
                                                        style="background-color: gainsboro;" disabled />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_fri_end"
                                                        name="bus_sch_fri_end"style="background-color: gainsboro;" disabled
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_fri_start" id="bus_sch_fri_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_fri_end" id="bus_sch_fri_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Saturday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-six-open" name="bus_sch_sat_status"
                                                    value="1" />
                                                <label for="radio-six-open">Open</label>
                                                <input type="radio" id="radio-six-close" name="bus_sch_sat_status"
                                                    value="0" />
                                                <label for="radio-six-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_sat_24_div" style="display: none">
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_sat_24_set_time"
                                                        name="bus_sch_sat_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_sat_24_hours" name="bus_sch_sat_24"
                                                        value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_sat_set_time" style="display: none;">
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sat_start" name="bus_sch_sat_start"
                                                        placeholder="Open Time" class="text_field_class"
                                                        style="background-color: gainsboro;" disabled />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sat_end"
                                                        name="bus_sch_sat_end"style="background-color: gainsboro;" disabled
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sat_start" id="bus_sch_sat_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sat_end" id="bus_sch_sat_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Sunday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-seven-open" name="bus_sch_sun_status"
                                                    value="1" />
                                                <label for="radio-seven-open">Open</label>
                                                <input type="radio" id="radio-seven-close" name="bus_sch_sun_status"
                                                    value="0" />
                                                <label for="radio-seven-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_sun_24_div" style="display: none">
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_sun_24_set_time"
                                                        name="bus_sch_sun_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_sun_24_hours" name="bus_sch_sun_24"
                                                        value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-md-4">
                                            <div id="bus_sch_sun_set_time" style="display: none;">
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sun_start" name="bus_sch_sun_start"
                                                        placeholder="Open Time" class="text_field_class"
                                                        style="background-color: gainsboro;" disabled />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sun_end"
                                                        name="bus_sch_sun_end"style="background-color: gainsboro;" disabled
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sun_start" id="bus_sch_sun_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sun_end" id="bus_sch_sun_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="row col-md-4">
                                    <br>
                                    <h5>How did you hear about Punnaka.com? <span style="color: red">*</span></< /h5>
                                        <br><br>
                                        <div class="intro-search-field utf-chosen-cat-single">
                                            <select class="selectpicker default" title="Select" multiple
                                                name="bus_payment_que_ans[]" id="bus_payment_que_ans">
                                                <option>Select</option>
                                                <option value="Search Engine ( Google, Yahoo, etc.)">Search Engine (
                                                    Google,
                                                    Yahoo, etc.)</option>
                                                <option value="Recommended by friend or colleague">Recommended by friend or
                                                    colleague</option>
                                                <option value="Social media ( Instagram, Facebook, etc.)">Social media (
                                                    Instagram, Facebook, etc.)</option>
                                                <option value="Read Blog / article or publication">Read Blog / article or
                                                    publication</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                </div>

                                <hr />
                                <div class="col-md-12 heading-section">
                                    ⏰ 📢 SECTION 13: Marketing Information
                                </div>



                                <div class="col-md-12">
                                    <br>
                                    <b style="font-size:16px;">Important :</b>
                                    <p> be sure all information above is true and correct. By submitting this form you
                                        confirm that
                                        you have read, fully understand and agreed to our terms of service and Privacy
                                        Policy.</p>

                                    <p> We reserve the right to edit your listing, including the text and image content. If
                                        we feel
                                        that your listing needs extra photos or content to be complete, our review team may
                                        visit
                                        your website to find it.</p>

                                    <p> If you face any difficulty or need any help, contact us via email at <a
                                            style="font-weight: bold;text-decoration: underline;"
                                            href="mailto:info@punnaka.com">info@punnaka.com</a></p>
                                </div>
                            </div>
                            <div class="col-md-12" align="center">
                                <button type="submit" class="button preview"><i class="fa fa-arrow-circle-right"></i>
                                    Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            initSample();
            jQuery(document).ready(function() {
                jQuery('#catmain_id').change(function() {
                    var catmain_id = jQuery(this).val()
                    jQuery.ajax({
                        url: '{{ url('/getBusinessSubCategory') }}',
                        type: 'POST',
                        data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                        success: function(result) {
                            jQuery('#catsub_id').html(result)
                        }
                    });
                });
            });
        </script>

        <script src="{{ asset('frontend/scripts/businessScheduleValidation.js') }}"></script>
        <script src="frontend/scripts/bootstrap-tagsinput.js"
            integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg=="
            crossorigin="anonymous"></script>

        <script>
            $('.tags').tagsinput({
                allowDuplicates: true
            });
            //on click of remove button
            $(document).on("click", ".label-info span[data-role=remove]", function() {
                //remove that spn
                var to_remove = $(this).closest(".label-info").clone().children().remove().end().text().trim()
                //console.log($("[name=tags]").val())
                //if i put here inisde split `,` not working as well
                var values = $("[class=tags]").val().split(';')
                //console.log("to remove ---" + to_remove)
                $(this).closest(".label-info").remove()
                //console.log("input box values--" + $("[name=tags]").val())
                for (var i = 0; i < values.length; i++) {
                    if (values[i] == to_remove) {
                        values.splice(i, 1);
                        return true;
                    }
                }
                //console.log("after splice--" + values)
                $(this).closest(".label-info").remove()
                $("[class=tags]").val(values)
                //console.log("After setting new values--" + $("[name=tags]").val())
            })
            $('.tags').on('beforeItemRemove', function(e) {
                e.cancel = true; //set cancel to false..
            });
        </script>
    @endsection
