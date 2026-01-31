@include('frontend.layouts.userHeader')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
<script src="{{ asset('admin/assets/js/sample.js') }}"></script>
<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Business Listing Edit</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('user-admin/dashboard') }}" class="activeUrl">Dashboard</a></li>
                        <li><a href="{{ url('user-admin/businessListing') }}" class="activeUrl">Business Listing Details</a></li>
                    </ul>
                </nav>
                @if (session('message'))
                    @if (session('message') == MSG_UPDATE_SUCCESS)
                        <div style="padding: 1px; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                            <p style="margin: 6px; font-weight: bold;">Data Updated Successfully!..</p>
                        </div>
                    @else
                        <div style="padding: 1px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"">
                            <p style="margin: 6px; font-weight: bold;">Error In Update!..</p>
                        </div>
                    @endforelse
                @endif
                @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="add_utf_listing_section margin-top-45">
                <div class="utf_add_listing_part_headline_part">
                    <h3><i class="sl sl-icon-tag"></i> Selected Categories</h3>
                </div>
                <div class="row with-forms">
                    <div class="col-md-6">
                        <h5>Main Category : <span
                                style="color:#3fb4e4">{{ $businessListingEditData['bus_main_cat'] }}</span> </h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Sub Category : <span
                                style="color:#3fb4e4">{{ $businessListingEditData['bus_sub_cat'] }}</span></h5>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ url('/businessListingDetailUpdate/' . $businessListingEditData['bus_id']) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="old_bus_main_cat" value="{{ $businessListingEditData['bus_main_cat'] }}">
            <input type="hidden" name="old_bus_sub_cat" value="{{ $businessListingEditData['bus_sub_cat'] }}">
            <input type="hidden" name="old_bus_payment_mode"
                value="{{ $businessListingEditData['bus_payment_mode'] }}">
            <input type="hidden" name="old_bus_payment_que_ans"
                value="{{ $businessListingEditData['bus_payment_que_ans'] }}">

            <input type="hidden" name="bus_plan_type" value="{{ session('planType') }}">
            <div class="add_utf_listing_section margin-top-45">
                <div class="utf_add_listing_part_headline_part">
                    <h3>Please add your business details below.</h3>
                </div>
                <div class="row with-forms">
                    <div class="col-md-4">
                        <h5>Business Name <i class="fa fa-info-circle" style="color:#3fb4e4" title="Please enter business name in small letters/lowercase here"></i><span style="color: red">*</span></h5>
                        <input type="text" name="bus_name" id="keywords"
                            value="{{ $businessListingEditData['bus_name'] }}" placeholder="Please enter business name in small letters/lowercase here" required>
                    </div>
                    <div class="col-md-4">
                        <h5>Business Contact Number <span style="color: red">*</span></h5>
                        <input type="text" class="search-field" name="bus_contact_no" id="bus_contact_no"
                            value="{{ $businessListingEditData['bus_contact_no'] }}"
                            placeholder="Please Enter Business Contact Number" required>
                    </div>
                    <div class="col-md-4">
                        <h5>Business Whatsapp Number</h5>
                        <input type="text" name="bus_alt_contact_no" id="bus_alt_contact_no"
                            value="{{ $businessListingEditData['bus_alt_contact_no'] }}"
                            placeholder="Please Enter Business Whatsapp Number">
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-4">
                        <h5>Business Email Address <span style="color: red">*</span></h5>
                        <input type="email" name="bus_email" id="bus_email"
                            value="{{ $businessListingEditData['bus_email'] }}"
                            placeholder="Please Enter Business Email Address" required>
                    </div>
                    <div class="col-md-4">
                        <h5>Business Location (Country) <span style="color: red">*</span></h5>
                        <input type="text" class="search-field" name="bus_country" id="bus_country"
                            value="{{ $businessListingEditData['bus_country'] }}"
                            placeholder="Please Enter Business Location (Country)" required>
                    </div>
                    <div class="col-md-4">
                        <h5>Business Location (State) <span style="color: red">*</span></h5>
                        <input type="text" name="bus_state" id="bus_state"
                            value="{{ $businessListingEditData['bus_state'] }}"
                            placeholder="Please Enter Business Location (State)" required>
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-4">
                        <h5>Business Location (City) <span style="color: red">*</span></h5>
                        <input type="text" name="bus_city" id="bus_city"
                            value="{{ $businessListingEditData['bus_city'] }}"
                            placeholder="Please Enter Business Location (City)" required>
                    </div>
                    <div class="col-md-4">
                        <h5>PIN Code / Zip Code</h5>
                        <input type="text" name="bus_pin_code" id="bus_pin_code"
                            value="{{ $businessListingEditData['bus_pin_code'] }}"
                            placeholder="Please Enter PIN Code / Zip Code">
                    </div>
                    <div class="col-md-4" style="padding: 3px;">
                        <h5>Business Start / Opening Year</h5>
                        <div class="intro-search-field utf-chosen-cat-single"
                            style="border: 0px solid #dbdbdb !important;">
                            <select class="default" title="Select Year" name="bus_start_year" id="bus_start_year">
                                @php
                                    $cureentYear = date('Y');
                                    $year = 1800;
                                @endphp
                                @foreach (range('2100', $year) as $yearValue)
                                    <option value="{{ $yearValue }}"
                                        @if ($yearValue == $businessListingEditData['bus_start_year']) selected style="color:red" @endif>
                                        {{ $yearValue }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-4">
                        <h5>Business Category</h5>
                        <div class="intro-search-field utf-chosen-cat-single" style="margin-top:11px;">
                            <select class="selectpicker default" id="catmain_id" name="bus_main_cat"
                                title="Select Main Category">
                                <option>Select Category</option>
                                @foreach ($businessMainCategoryData as $businessMainCategoryRow)
                                    <option value="{{ $businessMainCategoryRow['cat_main_id'] }}">
                                        {{ $businessMainCategoryRow['cat_main_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Sub category</h5>
                        <div class="intro-search-field utf-chosen-cat-single"
                            style="border: 0px solid #dbdbdb !important;">
                            <select class="default" name="bus_sub_cat" id="catsub_id" title="Select Sub Category">
                                <option>Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Payment Mode (<span style="color: red; font-weight:bold">
                                {{ $businessListingEditData['bus_payment_mode'] }}</span>)</h5>
                        <div class="intro-search-field utf-chosen-cat-single" style="margin-top:11px;">
                            <select class="selectpicker default" title="Select Payment Mode"
                                name="bus_payment_mode[]" id="bus_payment_mode" multiple>
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
                <div class="row with-forms">
                    <div class="col-md-6">
                        <h5>Business Address (Physical Location) <span style="color: red">*</span></h5>
                        <textarea name="bus_address1" id="bus_address1" placeholder="Please Enter Business Address (Physical Location)"
                            cols="30" rows="5" required>{{ $businessListingEditData['bus_address1'] }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <h5>Business Address (Area Name) <span style="color: red">*</span></h5>
                        <textarea name="bus_address2" id="bus_address2" placeholder="Please Enter Business Address (Area Name)"
                            cols="30" rows="5" required>{{ $businessListingEditData['bus_address2'] }}</textarea>
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>All of the products & services provided in details <span style="color: red">*</span></h5>
                        <textarea name="bus_product_service" id="bus_product_service"
                            placeholder="Please Enter All of the products & services provided in details" cols="30" rows="5"
                            required>{{ $businessListingEditData['bus_product_service'] }}</textarea>
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Brief description of your business <span style="color: red">*</span></h5>
                        <textarea name="bus_desc" id="editor" placeholder="Please Enter Brief description of your business"
                            cols="30" rows="5" required>{{ $businessListingEditData['bus_desc'] }}</textarea>
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-4">
                        <h5>Business Website URL</h5>
                        <input type="text" class="search-field" name="bus_website_url" id="bus_website_url"
                            value="{{ $businessListingEditData['bus_website_url'] }}"
                            placeholder="Please Enter Business Website URL">
                    </div>
                    <div class="col-md-4">
                        <h5>Business Facebook URL</h5>
                        <input type="text" name="bus_facebook_url" id="bus_facebook_url"
                            value="{{ $businessListingEditData['bus_facebook_url'] }}"
                            placeholder="Please Enter Business Facebook URL">
                    </div>
                    <div class="col-md-4">
                        <h5>Business Instagram URL</h5>
                        <input type="text" name="bus_instagram_url" id="bus_instagram_url"
                            value="{{ $businessListingEditData['bus_instagram_url'] }}"
                            placeholder="Please Enter Business Instagram URL">
                    </div>
                    <div class="col-md-4">
                        <h5>Business Twitter URL</h5>
                        <input type="text" class="search-field" name="bus_twitter_url" id="bus_twitter_url"
                            value="{{ $businessListingEditData['bus_twitter_url'] }}"
                            placeholder="Please Enter Business Twitter URL">
                    </div>

                    <div class="col-md-4">
                        <h5>Business video URL</h5>
                        <input type="text" name="bus_video_url" id="bus_video_url"
                            value="{{ $businessListingEditData['bus_video_url'] }}"
                            placeholder="Please Enter Business video URL">
                    </div>

                    <div class="col-md-4">
                        <h5>Average price range / fee</h5>
                        <input type="number" min="0" name="bus_avg_price_range" id="bus_avg_price_range"
                            value="{{ $businessListingEditData['bus_avg_price_range'] }}"
                            placeholder="Please Enter Average price range / fee">
                    </div>

                </div>
                <div class="row with-forms">
                    <div class="col-md-4">
                        <h5>Discounts / Offers</h5>
                        <input type="text" name="bus_punnaka_discount" id="bus_punnaka_discount"
                            value="{{ $businessListingEditData['bus_punnaka_discount'] }}"
                            placeholder="Please Enter Discounts / Offers">
                    </div>

                    <div class="col-md-4">
                        <h5>Google Profile URL <span title="Paste the Google Maps location URL (copy the link from the iframe's src attribute, not the whole embed code)" style="cursor: pointer; vertical-align: middle;"><span style="display: inline-block;width: 20px;height: 21px;background: #1976d2;border-radius: 50%;text-align: center;line-height: 22px;"><span style="color: #fff; font-size: 18px; font-weight: bold; font-family: Arial;">i</span></span></span></h5>
                        <input type="text" name="bus_google_profile_url"  value="{{$businessListingEditData['bus_google_profile_url']}}" id="bus_google_profile_url"
                            placeholder="Please Google Profile URL">
                    </div>


                    <div class="col-md-4">
                        <h5>Directions/Map URL</h5>
                        <input type="text" name="bus_map_direction_url" value="{{$businessListingEditData['bus_map_direction_url']}}" id="bus_map_direction_url" placeholder="Please Directions/Map URL">
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Business Tags (Enter keywords that describe your business e.g. clothing store,
                            women clothing store)</h5>
                        <input type="text" class="form-control col-sm-12" name="bus_tags" data-role="tagsinput"
                            value="{{ $businessListingEditData['bus_tags'] }}">
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Area Served (Enter locations where you are providing products or services, e.g. Pune,
                            Mumbai, USA, UK etc.)</h5>
                        <input type="text" class="form-control col-sm-12" name="bus_location_tags"
                            data-role="tagsinput" value="{{ $businessListingEditData['bus_location_tags'] }}">
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-6">
                        <h5>Meta Title (keep your Meta Title within 40-60 characters)</h5>
                        <input type="text" name="bus_meta_title" id="bus_meta_title"
                            value="{{ $businessListingEditData['bus_meta_title'] }}"
                            placeholder="Please Meta Title (keep your Meta Title within 40-60 characters)">
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Meta Keyword</h5>
                        <textarea name="bus_meta_keyword" id="bus_meta_keyword" cols="30" rows="3"
                            placeholder="Please Enter Meta Keyword">{{ $businessListingEditData['bus_meta_keyword'] }}</textarea>
                    </div>
                </div>
                <div class="row with-forms">
                    <div class="col-md-12">
                        <h5>Meta Description (keep your Meta Description up to 160 characters)</h5>
                        <textarea name="bus_meta_description" id="bus_meta_description" cols="30" rows="3"
                            placeholder="Please Meta Description: (keep your Meta Description up to 160 characters)">{{ $businessListingEditData['bus_meta_description'] }}</textarea>
                    </div>
                </div>
                <div class="row col-md-12">
                    <h5>How did you hear about Punnaka.com? (<span style="color: red; font-weight:bold">
                            {{ $businessListingEditData['bus_payment_que_ans'] }}</span>) </h5>
                </div>
                <div class="row col-md-4">
                    <div class="intro-search-field utf-chosen-cat-single">
                        <select class="selectpicker default" title="Select" multiple name="bus_payment_que_ans[]"
                            id="bus_payment_que_ans">
                            <option>Select</option>
                            <option value="Search Engine ( Google, Yahoo, etc.)">Search Engine(Google, Yahoo, etc.)
                            </option>
                            <option value="Recommended by friend or colleague">Recommended by friend or colleague
                            </option>
                            <option value="Social media ( Instagram, Facebook, etc.)">Social media (Instagram,
                                Facebook, etc.)</option>
                            <option value="Read Blog / article or publication">Read Blog / article or publication
                            </option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12" align="center">
                <button type="submit" class="button preview"><i class="fa fa-arrow-circle-right"></i>
                    Submit</button>
            </div>
        </form>
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
@include('frontend.layouts.userFooter')
