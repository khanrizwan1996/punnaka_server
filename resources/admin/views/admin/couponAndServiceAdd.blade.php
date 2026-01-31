@extends('admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <style>
        .divHidden {
            display: none;
        }
    </style>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/couponAndServiceList') }}">Coupon & Offers List</a></li>
                <li><span>Add Coupon & Offers</span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom">Coupon & Offers Details</h3>

        @if (session('message'))
            @if (session('message') == MSG_ADD_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Inserted Successfully!..</p>
                </div>
            @else
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In Insert!..</p>
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

        <div class="md-card">
            <div class="md-card-content large-padding">
                <form id="form_validation" method="POST" action="{{ url('admin/productAndServiceStore') }}"
                    enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label for="ps_main_cat">User</label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_user_id" id="ps_user_id">
                                    <option value="">Select</option>
                                    @foreach ($UserData as $UserRow)
                                        <option value="{{ $UserRow['id'] }}">{{ $UserRow['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label for="ps_main_cat">Main Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_main_cat" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($mainCategoryData as $mainCategoryData)
                                        <option value="{{ $mainCategoryData['cat_main_id'] }}">
                                            {{ $mainCategoryData['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label for="ps_sub_cat">Sub Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_sub_cat" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label for="ps_title">Title <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="ps_title" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label for="blog_image">Listing Type</label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_listing_type" id="ps_listing_type" required>
                                    <option value="">Select</option>
                                    <option value="Coupon / Promo Code">Coupon / Promo Code</option>
                                    <option value="Offer / Deal">Offer / Deal</option>
                                    <option value="Free Sample">Free Sample</option>
                                    <option value="Free Recharge Coupon">Free Recharge Coupon</option>
                                </select>
                            </div>
                        </div>


                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Short Tagline<span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_price_range" id="ps_price_range"
                                    placeholder="Short Tagline" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Store/Brand Name</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_discount" id="ps_discount"
                                    placeholder="Store/Brand Name">
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Region / City</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_tax" id="ps_tax"
                                    placeholder="Enter GST, VAT, HST, Percentage%">
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="date" name="ps_country" id="ps_country"
                                    placeholder="Enter Country" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="date" name="ps_state" id="ps_state"
                                    placeholder="Enter State" required>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Store Website <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_city" id="ps_city"
                                    placeholder="Store Website" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Ongoing Offer <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_service_area" id="ps_service_area" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Sort Priority<span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="datetime-local" name="ps_availability_date_time"
                                    id="ps_availability_date_time"
                                    placeholder="Enter Availability (For Services) Date Time" required>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">User Type</label>
                            <div class="parsley-row">
                                <br>
                                <input name="cf_user_type" id="cf_user_type" type="checkbox" value="All Users" required>
                                All Users
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Platform <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <br>
                                <input name="cf_platform[]" id="cf_platform" type="checkbox" checked value="Web">
                                Web&emsp;
                                <input name="cf_platform[]" id="cf_platform1" type="checkbox" value="App"> App
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Highlight Options<span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <br>
                                <input name="cf_highlight_options[]" id="cf_highlight_options" type="checkbox" checked
                                    value="Homepage"> Homepage&emsp;
                                <input name="cf_highlight_options[]" id="cf_highlight_options1" type="checkbox"
                                    value="Trending"> Trending
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label for="ps_image">Store Logo Upload <span class="req" style="color: red">*</span>
                                <span title="Please upload jpg,jpge,png & 2 MB size file only" class="menu_icon"><i
                                        class="material-icons">&#xE88F;</i></span></label>
                            <div class="parsley-row">
                                <input type="file" name="ps_image" onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label" for="formFile1">Banner / Thumbnail Upload <span
                                    title="Please upload min 2 MB size file only">
                                    <i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="ps_brochure"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-1">
                            <label class="form-label">Term & Condition <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="ps_short_description" id="ps_short_description"
                                    placeholder="Enter Short Description" required></textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <label class="form-label">Detail Description <span class="text-danger">*</span></label>
                            <br>
                            <textarea class="md-input" id="editor" name="ps_detail_description" id="ps_detail_description" required></textarea>
                        </div>

                         <div class="uk-width-medium-1-1">
                            <label class="form-label">Admin Notes <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="ps_short_description" id="ps_short_description"
                                    placeholder="Enter Short Description" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin id="coupon_promo"> 
                        <div class="uk-width-medium-1-1">
                        <h4><br> Coupon / Promo Code: </h4>
                        </div>
                       <div class="uk-width-medium-1-4">
                            <label class="form-label">Code Required? <span style="color: red">*</span></label>
                            <div class="parsley-row">
                            <select  class="md-input"  name="cf_coupon_code_required" id="cf_coupon_code_required">
                                <option value="" disabled selected>Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            </div>
                        </div>
                        
                         <div class="uk-width-medium-1-4">
                            <label class="form-label">Coupon / Promo Code <span style="color: red">*</span></label>
                              <div class="parsley-row">
                            <input type="text"  class="md-input"  name="cf_coupon_promo_code" id="cf_coupon_promo_code" required>
                            </div>
                        </div>

                         <div class="uk-width-medium-1-4">
                            <label class="form-label">Discount Type <span style="color: red">*</span></label>
                            <div class="parsley-row">
                            <select  class="md-input"  name="cf_coupon_discount_type" id="cf_coupon_discount_type" required>
                                <option value="">Select</option>
                                <option value="Flat">Flat</option>
                            </select>
                            </div>
                        </div>

                         <div class="uk-width-medium-1-4">
                            <label class="form-label">Discount Value <span style="color: red">*</span></label>
                            <div class="parsley-row">
                            <input type="text"  class="md-input"  name="cf_coupon_discount_value" id="cf_coupon_discount_value" required>
                            </div>
                        </div>

                         <div class="uk-width-medium-1-4">
                            <label class="form-label">Min Order Value</label>
                            <div class="parsley-row">
                            <input type="text" name="cf_coupon_min_order_value" id="cf_coupon_min_order_value"  class="md-input" >
                        </div>
                        </div>

                         <div class="uk-width-medium-1-4">
                            <label class="form-label">Max Discount Cap</label>
                            <div class="parsley-row">
                            <input type="text" name="cf_coupon_max_discount_cap" id="cf_coupon_max_discount_cap"  class="md-input" >
                        </div>
                        </div>
                            <div class="uk-width-medium-1-4">
                            <label class="form-label">Login Required to Redeem?</label>
                            <div class="parsley-row">
                            <select  class="md-input"  name="cf_coupon_login_required_redeem" id="cf_coupon_login_required_redeem">
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Redemption Limit</label>
                            <div class="parsley-row">
                            <input type="text"  class="md-input"  name="cf_coupon_redemption_limit" id="cf_coupon_redemption_limit">
                        </div>
                        </div>
                        
                         <div class="uk-width-medium-1-4">
                            <label class="form-label">Redirect / Affiliate URL</label>
                            <div class="parsley-row">
                            <input type="text"  class="md-input"  name="cf_coupon_redirect_affiliate_url" id="cf_coupon_redirect_affiliate_url">
                        </div>
                        </div>
                    </div>

                     <div class="uk-grid" data-uk-grid-margin id="offer_deal"> 
                        <div class="uk-width-medium-1-1">
                                    <h4><br> Offer / Deal:</h4>
                                </div>
                                     <div class="uk-width-medium-1-4">
                                        <br>
                                        <label class="form-label">Code Required? <span style="color: red">*</span></label>
                                        <select class="form-control" required name="cf_offer_code_required" id="cf_offer_code_required">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <div class="invalid-feedback">Please Select Code.</div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Offer Type <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" required name="cf_offer_type" id="cf_offer_type">
                                        <div class="invalid-feedback">Please Offer Type.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Discount Value <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" required name="cf_offer_discount_value" id="cf_offer_discount_value">
                                        <div class="invalid-feedback">Please Discount Value.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">CTA / Buy Now URL <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" required name="cf_offer_cta_buy_now_url" id="cf_offer_cta_buy_now_url">
                                        <div class="invalid-feedback">Please CTA / Buy Now URL.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Valid Till <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" required name="cf_offer_valid_till" id="cf_offer_valid_till">
                                        <div class="invalid-feedback">Please Valid Till.</div>
                                    </div>

                                    <div class="col-md-12">
                                        <br>
                                        <label class="form-label">Offer Description <span style="color: red">*</span></label>
                                        <textarea class="form-control" rows="5" required name="cf_offer_desc" id="cf_offer_desc"></textarea>
                                        <div class="invalid-feedback">Please Offer Description.</div>
                                    </div>
                                </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        initSample();
        jQuery(document).ready(function() {
            jQuery('#catmain_id').change(function() {
                var catmain_id = jQuery(this).val()
                jQuery.ajax({
                    url: '/admin/getBlogSubCategory',
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
        });

    const cf_listing_type = document.getElementById("cf_listing_type");
    const config = {
    "Coupon / Promo Code": {
        section: "coupon_promo",
        fields: [
        "cf_coupon_code_required",
        "cf_coupon_promo_code",
        "cf_coupon_discount_type",
        "cf_coupon_discount_value",
        "cf_coupon_min_order_value",
        "cf_coupon_max_discount_cap",
        "cf_coupon_login_required_redeem",
        "cf_coupon_redemption_limit",
        "cf_coupon_redirect_affiliate_url"
        ]
    },
    "Offer / Deal": {
        section: "offer_deal",
        fields: [
        "cf_offer_code_required",
        "cf_offer_type",
        "cf_offer_discount_value",
        "cf_offer_cta_buy_now_url",
        "cf_offer_valid_till",
        "cf_offer_desc"
        ]
    },
    "Free Sample": {
        section: "free_sample",
        fields: [
        "cf_free_sample_freebie_type",
        "cf_free_sample_quantity",
        "cf_free_sample_eligible_users",
        "cf_free_sample_redemption_link",
        "cf_free_sample_desc"
        ]
    },
    "Free Recharge Coupon": {
        section: "free_recharge_coupon",
        fields: [
        "cf_free_recharge_type",
        "cf_free_recharge_eligible_operators",
        "cf_free_recharge_code",
        "cf_free_recharge_claim_url",
        "cf_free_recharge_instructions"
        ]
    }
    };

    const allFields = Object.values(config).flatMap(c => c.fields);
    const allSections = Object.values(config).map(c => c.section);
    function setRequired(fields) {
    fields.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.setAttribute("required", "required");
    });
    }

    function removeRequired(fields, clearValue = true) {
    fields.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
        el.removeAttribute("required");
        if (clearValue) el.value = "";
        }
    });
    }

    function toggleSections(activeSection) {
    allSections.forEach(secId => {
        const el = document.getElementById(secId);
        if (el) el.classList.add("divHidden");
    });
    const activeEl = document.getElementById(activeSection);
    if (activeEl) activeEl.classList.remove("divHidden");
    }

    cf_listing_type.addEventListener("change", function () {
        const choice = config[this.value];
        removeRequired(allFields);
        toggleSections("");

        if (choice) {
            toggleSections(choice.section);
            setRequired(choice.fields);
        }
    });


    </script>
@endsection
