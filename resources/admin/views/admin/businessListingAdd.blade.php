@extends('admin.layouts.main') @section('main-container')
    <style type="text/css">
        .switch-field {
            display: flex;
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

        .text_field_class {
            height: 50px;
            line-height: 50px;
            padding: 0 15px;
            outline: none;
            font-size: 15px;
            color: #808080;
            margin: 0 0 16px 0;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            display: block;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.03);
            font-weight: 600;
            opacity: 1;
            border-radius: 4px;
        }
    </style>

    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/businessListing') }}">Business Listing List</a></li>
                <li><span>Business Listing Add </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Business Add Details</h3>
        @if (session('message'))
            @if (session('message') == MSG_ADD_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data inserted Successfully!..</p>
                </div>
            @else
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In insert!..</p>
                </div>
                @endforelse @endif @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif


                <div class="md-card">
                    <div class="md-card-content large-padding">
                        <form id="form_validation" method="POST" action="{{ url('/admin/businessListingStore/') }}"
                            enctype="multipart/form-data" class="uk-form-stacked">
                            @csrf
                            <div class="uk-accordion" data-uk-accordion>
                                <h3 class="uk-accordion-title uk-accordion-title-primary">General Information</h3>
                                <div class="uk-accordion-content">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="bus_main_cat">Users <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <select class="md-input" name="bus_user_id" id="bus_user_id" required>
                                                    <option value="">Select</option>
                                                    @foreach ($userData as $userRow)
                                                        <option value="{{ $userRow['id'] }}">{{ $userRow['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="bus_main_cat">Business Category</label>
                                            <div class="parsley-row">
                                                <select class="md-input" name="bus_main_cat" id="catmain_id" required>
                                                    <option value="">Select</option>
                                                    @foreach ($businessMainCategoryData as $businessMainCategoryRow)
                                                        <option value="{{ $businessMainCategoryRow['cat_main_id'] }}">
                                                            {{ $businessMainCategoryRow['cat_main_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_image">Sub Category</label>
                                            <div class="parsley-row">
                                                <select class="md-input" name="bus_sub_cat" id="catsub_id" required>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Name <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_name" required class="md-input" />
                                            </div>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Contact No <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_contact_no" required class="md-input" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Alt Business Contact No</label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_alt_contact_no" class="md-input" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Email Address <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <input type="email" name="bus_email" required class="md-input" />
                                            </div>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Location (Country) <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_country" required class="md-input" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Location (State) <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_state" required class="md-input" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Location (City) <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_city" required class="md-input" />
                                            </div>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Area PIN Code <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_pin_code" required class="md-input" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <label for="blog_detail">Business Address (Physical Location) <span
                                                    class="req" style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <textarea name="bus_address1" required class="md-input"></textarea>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="blog_detail">Business Address (Area Name)<span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <textarea name="bus_address2" required class="md-input"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Start / Opening Year <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <select class="md-input" name="bus_start_year" required>
                                                    @php
                                                        $cureentYear = date('Y');
                                                        $year = 1800;
                                                    @endphp @foreach (range('2100', $year) as $yearValue)
                                                        <option value="{{ $yearValue }}"
                                                            @if ($yearValue == $cureentYear) selected style="color:red" @endif>
                                                            {{ $yearValue }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Website URL</label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_website_url" class="md-input" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Facebook URL</label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_facebook_url" class="md-input" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Instagram URL</label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_instagram_url" class="md-input" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Twitter URL</label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_twitter_url" class="md-input" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="blog_detail">Business Video</label>
                                            <div class="parsley-row">
                                                <input type="text" name="bus_video_url" class="md-input" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <label for="blog_detail">Payment Mode <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <select class="md-input" name="bus_payment_mode[]" required multiple>
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
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-width-medium-1-1">
                                                <label for="blog_detail">Discounts / Offers</label>
                                                <div class="parsley-row">
                                                    <input type="text" name="bus_punnaka_discount" class="md-input" />
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-1">
                                                <label for="blog_detail">Average price range / fee</label>
                                                <div class="parsley-row">
                                                    <input type="text" name="bus_avg_price_range" class="md-input" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <label for="blog_cat_desc">All of the products & services provided in
                                                details</label>
                                            <div class="parsley-row">
                                                <textarea class="md-input" id="tags" name="bus_product_service" cols="10" rows="8" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <label for="blog_cat_desc">Brief description of your business <span
                                                    class="req" style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <textarea class="md-input" id="editor" name="bus_desc" cols="10" rows="8" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-1-3">
                                            <label for="bus_meta_description">Business Logo / images <span
                                                    style="color: red">*</span> ( Upload Multiple images)</label>
                                            <div class="parsley-row">
                                                <input type="file" name="bus_img_log[]" class="md-btn md-btn-primary"
                                                    required multiple>
                                            </div>
                                        </div>

                                        <div class="uk-width-1-3">
                                            <label for="bus_meta_description">Business ID Proof <span
                                                    style="color: red">*</span> ( Upload Multiple images)</label>
                                            <div class="parsley-row">
                                                <input type="file" name="bus_img_id_proof[]"
                                                    class="md-btn md-btn-primary" required multiple>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <label for="blog_cat_desc">Business Tags</label>
                                            <div class="parsley-row">
                                                <textarea class="md-input tags" name="bus_tags" cols="10" rows="8" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <label for="blog_cat_desc">Location Tags</label>
                                            <div class="parsley-row">
                                                <textarea class="md-input tags" id="tags" name="bus_location_tags" cols="10" rows="8" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <label for="blog_cat_desc">Google Profile <span
                                                    title="Paste the Google Maps location URL (copy the link from the iframe's src attribute, not the whole embed code)"
                                                    style="cursor: pointer;">
                                                    <i class="material-icons md-24 md-light"
                                                        style="font-size: 20px; color: #1976d2; vertical-align: middle;">info</i>
                                                </span></label>
                                            <div class="parsley-row"
                                                style="display: flex; align-items: center; gap: 8px;">
                                                <textarea class="md-input" name="bus_google_profile_url" cols="10" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <label for="blog_cat_desc">Direction / Map Link <span
                                                    title="Paste the full URL with http or https"
                                                    style="cursor: pointer;">
                                                    <i class="material-icons md-24 md-light"
                                                        style="font-size: 20px; color: #1976d2; vertical-align: middle;">info</i>
                                                </span></label>
                                            <div class="parsley-row"
                                                style="display: flex; align-items: center; gap: 8px;">
                                                <textarea class="md-input" name="bus_map_direction_url" cols="10" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <div class="parsley-row uk-margin-top">
                                                <label for="bus_meta_title">Meta Title</label>
                                                <input type="text" name="bus_meta_title" class="md-input" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-1">
                                            <div class="parsley-row uk-margin-top">
                                                <label for="bus_meta_keyword">Meta Keyword</label>
                                                <input type="text" name="bus_meta_keyword" class="md-input" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="parsley-row">
                                                <label for="bus_meta_description">Meta Desciption</label>
                                                <textarea class="md-input" name="bus_meta_description" cols="10" rows="8"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="parsley-row">
                                                <label for="bus_meta_description">Admin Comment</label>
                                                <textarea class="md-input" name="bus_admin_comment" cols="10" rows="8"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-1-3">
                                            <div class="parsley-row">
                                                <label for="bus_meta_description">How did you hear about Punnaka.com? <span
                                                        style="color: red">*</span></label>
                                                <select class="md-input" title="Select" multiple
                                                    name="bus_payment_que_ans[]" id="bus_payment_que_ans" required>
                                                    <option>Select</option>
                                                    <option value="Search Engine ( Google, Yahoo, etc.)">Search Engine (
                                                        Google,
                                                        Yahoo, etc.)</option>
                                                    <option value="Recommended by friend or colleague">Recommended by
                                                        friend or
                                                        colleague</option>
                                                    <option value="Social media ( Instagram, Facebook, etc.)">Social media
                                                        (
                                                        Instagram, Facebook, etc.)</option>
                                                    <option value="Read Blog / article or publication">Read Blog / article
                                                        or
                                                        publication</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h3 class="uk-accordion-title uk-accordion-title-warning">Business Time</h3>
                                <div class="uk-accordion-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table uk-table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Monday :- </td>
                                                    <td>
                                                        <div class="switch-field">
                                                            <input type="radio" id="radio-one-open"
                                                                name="bus_sch_mon_status" value="1" />
                                                            <label for="radio-one-open">Open</label>
                                                            <input type="radio" id="radio-one-close"
                                                                name="bus_sch_mon_status" value="0" />
                                                            <label for="radio-one-close">Close</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="uk-grid" data-uk-grid-margin>

                                                            <div class="uk-width-medium-1-3" id="bus_sch_mon_24_div"
                                                                style="display: none">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="parsley-row" style="margin-top: -12px;">
                                                                        <br>
                                                                        <input type="radio" id="bus_sch_mon_24_set_time"
                                                                            name="bus_sch_mon_24" value="1" /> Set
                                                                        Time
                                                                        <input type="radio" id="bus_sch_mon_24_hours"
                                                                            name="bus_sch_mon_24" value="2" /> 24
                                                                        Hours Open
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="bus_sch_mon_set_time" style="display: none;">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_mon_start"
                                                                                name="bus_sch_mon_start"
                                                                                placeholder="Open Time"
                                                                                class="text_field_class"
                                                                                style="background-color: gainsboro;"
                                                                                disabled />
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_mon_end"
                                                                                name="bus_sch_mon_end"
                                                                                style="background-color: gainsboro;"
                                                                                disabled placeholder="Close Time"
                                                                                class="text_field_class" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <br>Tuesday :-
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="switch-field">
                                                            <input type="radio" id="radio-two-open"
                                                                name="bus_sch_tue_status" value="1" />
                                                            <label for="radio-two-open">Open</label>
                                                            <input type="radio" id="radio-two-close"
                                                                name="bus_sch_tue_status" value="0" />
                                                            <label for="radio-two-close">Close</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="uk-grid" data-uk-grid-margin>

                                                            <div class="uk-width-medium-1-3" id="bus_sch_tue_24_div"
                                                                style="display: none">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="parsley-row" style="margin-top: -12px;">
                                                                        <br>
                                                                        <input type="radio" id="bus_sch_tue_24_set_time"
                                                                            name="bus_sch_tue_24" value="1" /> Set
                                                                        Time
                                                                        <input type="radio" id="bus_sch_tue_24_hours"
                                                                            name="bus_sch_tue_24" value="2" /> 24
                                                                        Hours Open
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="bus_sch_tue_set_time" style="display: none;">
                                                                <div class="uk-grid" data-uk-grid-margin>

                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_tue_start"
                                                                                name="bus_sch_tue_start"
                                                                                placeholder="Open Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_tue_end"
                                                                                name="bus_sch_tue_end"
                                                                                placeholder="Close Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <br>Wednesday :-
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="switch-field">
                                                            <input type="radio" id="radio-three-open"
                                                                name="bus_sch_wed_status" value="1" />
                                                            <label for="radio-three-open">Open</label>
                                                            <input type="radio" id="radio-three-close"
                                                                name="bus_sch_wed_status" value="0" />
                                                            <label for="radio-three-close">Close</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="uk-grid" data-uk-grid-margin>

                                                            <div class="uk-width-medium-1-3" id="bus_sch_wed_24_div"
                                                                style="display: none">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="parsley-row" style="margin-top: -12px;">
                                                                        <br>
                                                                        <input type="radio" id="bus_sch_wed_24_set_time"
                                                                            name="bus_sch_wed_24" value="1" /> Set
                                                                        Time
                                                                        <input type="radio" id="bus_sch_wed_24_hours"
                                                                            name="bus_sch_wed_24" value="2" /> 24
                                                                        Hours Open
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="bus_sch_wed_set_time" style="display: none;">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_wed_start"
                                                                                name="bus_sch_wed_start"
                                                                                placeholder="Open Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_wed_end"
                                                                                name="bus_sch_wed_end"
                                                                                placeholder="Close Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <br>Thursday:-
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="switch-field">
                                                            <input type="radio" id="radio-four-open"
                                                                name="bus_sch_thu_status" value="1" />
                                                            <label for="radio-four-open">Open</label>
                                                            <input type="radio" id="radio-four-close"
                                                                name="bus_sch_thu_status" value="0" />
                                                            <label for="radio-four-close">Close</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="uk-grid" data-uk-grid-margin>

                                                            <div class="uk-width-medium-1-3" id="bus_sch_thu_24_div"
                                                                style="display: none">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="parsley-row" style="margin-top: -12px;">
                                                                        <br>
                                                                        <input type="radio" id="bus_sch_thu_24_set_time"
                                                                            name="bus_sch_thu_24" value="1" /> Set
                                                                        Time
                                                                        <input type="radio" id="bus_sch_thu_24_hours"
                                                                            name="bus_sch_thu_24" value="2" /> 24
                                                                        Hours Open
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="bus_sch_thu_set_time" style="display: none;">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_thu_start"
                                                                                name="bus_sch_thu_start"
                                                                                placeholder="Open Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_thu_end"
                                                                                name="bus_sch_thu_end"
                                                                                placeholder="Close Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <br>Friday:-
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="switch-field">
                                                            <input type="radio" id="radio-five-open"
                                                                name="bus_sch_fri_status" value="1" />
                                                            <label for="radio-five-open">Open</label>
                                                            <input type="radio" id="radio-five-close"
                                                                name="bus_sch_fri_status" value="0" />
                                                            <label for="radio-five-close">Close</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="uk-grid" data-uk-grid-margin>

                                                            <div class="uk-width-medium-1-3" id="bus_sch_fri_24_div"
                                                                style="display: none">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="parsley-row" style="margin-top: -12px;">
                                                                        <br>
                                                                        <input type="radio" id="bus_sch_fri_24_set_time"
                                                                            name="bus_sch_fri_24" value="1" /> Set
                                                                        Time
                                                                        <input type="radio" id="bus_sch_fri_24_hours"
                                                                            name="bus_sch_fri_24" value="2" /> 24
                                                                        Hours Open
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="bus_sch_fri_set_time" style="display: none;">
                                                                <div class="uk-grid" data-uk-grid-margin>

                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_fri_start"
                                                                                name="bus_sch_fri_start"
                                                                                placeholder="Open Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_fri_end"
                                                                                name="bus_sch_fri_end"
                                                                                placeholder="Close Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <br>Saturday:-
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="switch-field">
                                                            <input type="radio" id="radio-six-open"
                                                                name="bus_sch_sat_status" value="1" />
                                                            <label for="radio-six-open">Open</label>
                                                            <input type="radio" id="radio-six-close"
                                                                name="bus_sch_sat_status" value="0" />
                                                            <label for="radio-six-close">Close</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="uk-grid" data-uk-grid-margin>

                                                            <div class="uk-width-medium-1-3" id="bus_sch_sat_24_div"
                                                                style="display: none">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="parsley-row" style="margin-top: -12px;">
                                                                        <br>
                                                                        <input type="radio" id="bus_sch_sat_24_set_time"
                                                                            name="bus_sch_sat_24" value="1" /> Set
                                                                        Time
                                                                        <input type="radio" id="bus_sch_sat_24_hours"
                                                                            name="bus_sch_sat_24" value="2" /> 24
                                                                        Hours Open
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="bus_sch_sat_set_time" style="display: none;">
                                                                <div class="uk-grid" data-uk-grid-margin>

                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_sat_start"
                                                                                name="bus_sch_sat_start"
                                                                                placeholder="Open Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_sat_end"
                                                                                name="bus_sch_sat_end"
                                                                                placeholder="Close Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <br>Sunday:-
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="switch-field">
                                                            <input type="radio" id="radio-seven-open"
                                                                name="bus_sch_sun_status" value="1" />
                                                            <label for="radio-seven-open">Open</label>
                                                            <input type="radio" id="radio-seven-close"
                                                                name="bus_sch_sun_status" value="0" />
                                                            <label for="radio-seven-close">Close</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <br>
                                                        <div class="uk-grid" data-uk-grid-margin>

                                                            <div class="uk-width-medium-1-3" id="bus_sch_sun_24_div"
                                                                style="display: none">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="parsley-row" style="margin-top: -12px;">
                                                                        <br>
                                                                        <input type="radio" id="bus_sch_sun_24_set_time"
                                                                            name="bus_sch_sun_24" value="1" /> Set
                                                                        Time
                                                                        <input type="radio" id="bus_sch_sun_24_hours"
                                                                            name="bus_sch_sun_24" value="2" /> 24
                                                                        Hours Open
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="bus_sch_sun_set_time" style="display: none;">
                                                                <div class="uk-grid" data-uk-grid-margin>

                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_sun_start"
                                                                                name="bus_sch_sun_start"
                                                                                placeholder="Open Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="uk-width-medium-1-2">
                                                                        <div class="parsley-row">
                                                                            <input type="text" id="bus_sch_sun_end"
                                                                                name="bus_sch_sun_end"
                                                                                placeholder="Close Time"
                                                                                class="text_field_class" disabled
                                                                                style="background-color: gainsboro;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <center>
                                        <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
    <script src="{{ asset('frontend/scripts/businessScheduleValidation.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/tags.js') }}"></script>
    <script>
        initSample();
        jQuery(document).ready(function() {
            jQuery('#catmain_id').change(function() {
                var catmain_id = jQuery(this).val()
                jQuery.ajax({
                    url: "{{ url('admin/getBlogSubCategory') }}",
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
        });
    </script>
@endsection
