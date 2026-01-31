@extends('user_admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <style>
        .divHidden {
            display: none;
        }
    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Add Coupon & Offers</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'dashboard')}}">Dashboard</a> / </li>
                            <li class="breadcrumb-item active">Add Coupon & Offers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @if (session('message'))
                        <div class="card-body live-dark">
                            @if(session('message') == MSG_ADD_SUCCESS)
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Data Inserted Successfully!..</div>
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"fdprocessedid="wsb8o"></button>
                                        </div>
                                    <div>
                            @else
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Error In Insert!..</div>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" fdprocessedid="wsb8o"></button>
                                    </div>
                                <div>
                            @endforelse
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ url(USER_ADMIN_URL.'couponOfferStore') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Select Main Category <span style="color: red">*</span></label>
                                    <select class="form-select mt-2" name="cf_main_cat" id="catmain_id"
                                        required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        @foreach ($mainCategoryData as $mainCategoryRow)
                                            <option value="{{ $mainCategoryRow['cat_main_id'] }}">
                                                {{ $mainCategoryRow['cat_main_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please Select Main Category.</div>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Select Sub Category <span style="color: red">*</span></label>
                                    <select class="form-select mt-2" name="cf_sub_cat" id="catsub_id"
                                        required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Sub Category.</div>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Listing Type <span style="color: red">*</span></label>
                                    <select class="form-control mt-2" required name="cf_listing_type" id="cf_listing_type">
                                        <option value="">Select</option>
                                        <option value="Coupon / Promo Code">Coupon / Promo Code</option>
                                        <option value="Offer / Deal">Offer / Deal</option>
                                        <option value="Free Sample">Free Sample</option>
                                        <option value="Free Recharge Coupon">Free Recharge Coupon</option>
                                    </select>
                                    <div class="invalid-feedback">Please Enter Brand Name.</div>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Title <span style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="cf_title" id="cf_title" type="text"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Title.</div>
                                </div>
                                
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Short Tagline <span style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="cf_short_tagline" id="cf_short_tagline" type="text"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Short Tagline.</div>
                                </div>

                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Store/Brand Name <span style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="cf_store_name" id="cf_store_name" type="text"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Store/Brand Name</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Region / City <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_city" id="cf_city" type="text" required="">
                                    <div class="invalid-feedback">Please Select Start Time.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Start Date <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_start_date" id="cf_start_date" type="date" required="">
                                    <div class="invalid-feedback">Please Start Date.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">End Date <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_end_date" id="cf_end_date" type="date" required="">
                                    <div class="invalid-feedback">Please End Date.</div>
                                </div>
                                 <div class="col-md-3">
                                    <label class="form-label">Store Website <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_store_website" id="cf_store_website" type="text" required="">
                                    <div class="invalid-feedback">Please Enter Store Website.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ongoing Offer? <span style="color: red">*</span></label>
                                     <select class="form-control" name="cf_ongoing_offer" id="cf_ongoing_offer" required>
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Ongoing Offer.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Sort Priority</label>
                                    <input class="form-control" name="cf_sort_priority" id="cf_sort_priority" type="text">
                                </div>

                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Store Logo Upload</label>
                                    <input class="form-control mt-2" name="cf_store_logo" id="cf_store_logo" type="file">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Banner / Thumbnail Upload</label>
                                    <input class="form-control" name="cf_banner_thumbnail" id="cf_banner_thumbnail" type="file">
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">User Type <span style="color: red">*</span></label>
                                    <br>
                                    <input name="cf_user_type" id="cf_user_type" type="checkbox" value="All Users" required> All Users
                                    <div class="invalid-feedback">Please Select User Type .</div>
                                </div>

                                <div class="col-md-2" align="center">
                                    <label class="form-label">Platform <span style="color: red">*</span></label>
                                    <br>
                                    <input name="cf_platform[]" id="cf_platform" type="checkbox" checked value="Web"> Web&emsp;
                                    <input name="cf_platform[]" id="cf_platform1" type="checkbox" value="App"> App
                                     <div class="invalid-feedback">Please Select Platform .</div>
                                </div>
                                

                                <div class="col-md-3">
                                    <label class="form-label">Highlight Options </label>
                                    <br>
                                    <input name="cf_highlight_options[]" id="cf_highlight_options" type="checkbox" checked value="Homepage"> Homepage&emsp;
                                    <input name="cf_highlight_options[]" id="cf_highlight_options1" type="checkbox" value="Trending"> Trending
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Term & Condition </label>
                                    <textarea class="form-control" name="cf_term_condition" id="cf_term_condition" rows="5"></textarea>
                                    <div class="invalid-feedback">Please Enter Coupon Term & Condition.</div>
                                </div>

                                 <div class="col-12">
                                    <label class="form-label">Description <span style="color: red">*</span></label>
                                    <textarea class="form-control" id="editor" name="cf_desc" id="cf_desc" cols="5" rows="5" required=""></textarea>
                                    <div class="invalid-feedback">Please Enter Coupon Description.</div>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label">Admin Notes</label>
                                    <textarea class="form-control" name="cf_admin_note" id="cf_admin_note" rows="5"></textarea>
                                </div>

                                <div class="row divHidden" id="coupon_promo"> 
                                    <h4><br> Coupon / Promo Code: </h4>
                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Code Required? <span style="color: red">*</span></label>
                                        <select class="form-control" name="cf_coupon_code_required" id="cf_coupon_code_required">
                                            <option value="" disabled selected>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <div class="invalid-feedback">Please Select Code.</div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Coupon / Promo Code <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="cf_coupon_promo_code" id="cf_coupon_promo_code" required>
                                        <div class="invalid-feedback">Please Coupon / Promo Code.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Discount Type <span style="color: red">*</span></label>
                                        <select class="form-control" name="cf_coupon_discount_type" id="cf_coupon_discount_type" required>
                                            <option value="">Select</option>
                                            <option value="Flat">Flat</option>
                                        </select>
                                        <div class="invalid-feedback">Please Discount Type.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Discount Value <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="cf_coupon_discount_value" id="cf_coupon_discount_value" required>
                                        <div class="invalid-feedback">Please Discount Value.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Min Order Value</label>
                                        <input type="text" name="cf_coupon_min_order_value" id="cf_coupon_min_order_value" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Max Discount Cap</label>
                                        <input type="text" name="cf_coupon_max_discount_cap" id="cf_coupon_max_discount_cap" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Login Required to Redeem?</label>
                                        <select class="form-control" name="cf_coupon_login_required_redeem" id="cf_coupon_login_required_redeem">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Redemption Limit</label>
                                        <input type="text" class="form-control" name="cf_coupon_redemption_limit" id="cf_coupon_redemption_limit">
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Redirect / Affiliate URL</label>
                                        <input type="text" class="form-control" name="cf_coupon_redirect_affiliate_url" id="cf_coupon_redirect_affiliate_url">
                                    </div>
                                </div>

                                <div class="row divHidden" id="offer_deal"> 
                                    <h4><br> Offer / Deal:</h4>
                                    <div class="col-md-3">
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

                                <div class="row divHidden" id="free_sample"> 
                                    <h4><br> Free Sample:</h4>
                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Freebie Type <span style="color: red">*</span></label>
                                        <select class="form-control" required name="cf_free_sample_freebie_type" id="cf_free_sample_freebie_type">
                                            <option value="">Select</option>
                                            <option value="Free Sample">Free Sample</option>
                                        </select>
                                        <div class="invalid-feedback">Please Select Freebie Type.</div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Sample Quantity <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" required name="cf_free_sample_quantity" id="cf_free_sample_quantity">
                                        <div class="invalid-feedback">Please Sample Quantity.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Eligible Users</label>
                                        <input type="text" class="form-control" name="cf_free_sample_eligible_users" id="cf_free_sample_eligible_users">
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Sample Redemption Link <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" required name="cf_free_sample_redemption_link" id="cf_free_sample_redemption_link">
                                        <div class="invalid-feedback">Please Sample Redemption Link.</div>
                                    </div>

                                    <div class="col-md-12">
                                        <br>
                                        <label class="form-label">Sample Description <span style="color: red">*</span></label>
                                        <textarea class="form-control" rows="5" required name="cf_free_sample_desc" id="cf_free_sample_desc"></textarea>
                                        <div class="invalid-feedback">Please Sample Description.</div>
                                    </div>
                                </div>

                                <div class="row divHidden" id="free_recharge_coupon"> 
                                    <h4><br> Free Recharge Coupon:</h4>
                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Recharge Type <span style="color: red">*</span></label>
                                        <select class="form-control" required name="cf_free_recharge_type" id="cf_free_recharge_type">
                                            <option value="">Select</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="150">150</option>
                                            <option value="200">200</option>
                                        </select>
                                        <div class="invalid-feedback">Please Recharge Type.</div>
                                    </div>
                                    
                                     <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Eligible Operators <span style="color: red">*</span></label>
                                        <select class="form-control" required multiple name="cf_free_recharge_eligible_operators[]" id="cf_free_recharge_eligible_operators">
                                            <option value="">Select</option>
                                            <option value="Jio">Jio</option>
                                            <option value="Airtel">Airtel</option>
                                            <option value="Vi">Vi</option>
                                        </select>
                                        <div class="invalid-feedback">Please Select Eligible Operators.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Recharge Code</label>
                                        <input type="text" class="form-control" name="cf_free_recharge_code" id="cf_free_recharge_code">
                                        <div class="invalid-feedback">Please Recharge Code.</div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>
                                        <label class="form-label">Claim URL<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" required name="cf_free_recharge_claim_url" id="cf_free_recharge_claim_url">
                                        <div class="invalid-feedback">Please Claim URL.</div>
                                    </div>

                                    <div class="col-md-12">
                                        <br>
                                        <label class="form-label">Recharge Instructions <span style="color: red">*</span></label>
                                        <textarea class="form-control" rows="5" name="cf_free_recharge_instructions" id="cf_free_recharge_instructions"></textarea>
                                    </div>
                                </div>
                                <center>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Submit</button>        
                                    </div>
                                </center>
                            </form>
                        </div>
                    </div>
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
                    url: "{{ url('admin/getBlogSubCategory') }}",
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
        });
        
    const cf_listing_type = document.getElementById("cf_listing_type");

    // Config: each option maps to { section, fields }
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

    // Collect all fields & sections
    const allFields = Object.values(config).flatMap(c => c.fields);
    const allSections = Object.values(config).map(c => c.section);

    // Helpers
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

    // Event handler
    cf_listing_type.addEventListener("change", function () {
    const choice = config[this.value];

    // reset everything
    removeRequired(allFields);
    toggleSections(""); // hide all

    if (choice) {
        toggleSections(choice.section);
        setRequired(choice.fields);
    }
    });


    //     const cf_listing_type = document.getElementById("cf_listing_type");

    //     const cf_coupon_code_required = document.getElementById("cf_coupon_code_required");
    //     const cf_coupon_promo_code = document.getElementById("cf_coupon_promo_code");
    //     const cf_coupon_discount_type = document.getElementById("cf_coupon_discount_type");
    //     const cf_coupon_discount_value = document.getElementById("cf_coupon_discount_value");
    //     const cf_coupon_min_order_value = document.getElementById("cf_coupon_min_order_value");
    //     const cf_coupon_max_discount_cap = document.getElementById("cf_coupon_max_discount_cap");
    //     const cf_coupon_login_required_redeem = document.getElementById("cf_coupon_login_required_redeem");
    //     const cf_coupon_redemption_limit = document.getElementById("cf_coupon_redemption_limit");
    //     const cf_coupon_redirect_affiliate_url = document.getElementById("cf_coupon_redirect_affiliate_url");

    //     const cf_offer_code_required = document.getElementById("cf_offer_code_required");
    //     const cf_offer_type = document.getElementById("cf_offer_type");
    //     const cf_offer_discount_value = document.getElementById("cf_offer_discount_value");
    //     const cf_offer_cta_buy_now_url = document.getElementById("cf_offer_cta_buy_now_url");
    //     const cf_offer_valid_till = document.getElementById("cf_offer_valid_till");
    //     const cf_offer_desc = document.getElementById("cf_offer_desc");

    //     const cf_free_sample_freebie_type = document.getElementById("cf_free_sample_freebie_type");
    //     const cf_free_sample_quantity = document.getElementById("cf_free_sample_quantity");
    //     const cf_free_sample_eligible_users = document.getElementById("cf_free_sample_eligible_users");
    //     const cf_free_sample_redemption_link = document.getElementById("cf_free_sample_redemption_link");
    //     const cf_free_sample_desc = document.getElementById("cf_free_sample_desc");

    //     const cf_free_recharge_type = document.getElementById("cf_free_recharge_type");
    //     const cf_free_recharge_eligible_operators = document.getElementById("cf_free_recharge_eligible_operators");
    //     const cf_free_recharge_code = document.getElementById("cf_free_recharge_code");
    //     const cf_free_recharge_claim_url = document.getElementById("cf_free_recharge_claim_url");
    //     const cf_free_recharge_instructions = document.getElementById("cf_free_recharge_instructions");



    //     cf_listing_type.addEventListener("change", function () {
    //     if(this.value === "Coupon / Promo Code"){
    //         document.getElementById("coupon_promo").classList.remove("divHidden");
    //         document.getElementById("offer_deal").classList.add("divHidden");
    //         document.getElementById("free_sample").classList.add("divHidden");
    //         document.getElementById("free_recharge_coupon").classList.add("divHidden");

    //         cf_coupon_code_required.setAttribute("required", "required");
    //         cf_coupon_promo_code.setAttribute("required", "required");
    //         cf_coupon_discount_type.setAttribute("required", "required");
    //         cf_coupon_discount_value.setAttribute("required", "required");
    //         cf_coupon_min_order_value.setAttribute("required", "required");
    //         cf_coupon_max_discount_cap.setAttribute("required", "required");
    //         cf_coupon_login_required_redeem.setAttribute("required", "required");
    //         cf_coupon_redemption_limit.setAttribute("required", "required");
    //         cf_coupon_redirect_affiliate_url.setAttribute("required", "required");

    //         cf_offer_code_required.removeAttribute("required");
    //         cf_offer_type.removeAttribute("required");
    //         cf_offer_discount_value.removeAttribute("required");
    //         cf_offer_cta_buy_now_url.removeAttribute("required");
    //         cf_offer_valid_till.removeAttribute("required");
    //         cf_offer_desc.removeAttribute("required");

    //         cf_offer_code_required.value = "";
    //         cf_offer_type.value = "";
    //         cf_offer_discount_value.value = "";
    //         cf_offer_cta_buy_now_url.value = "";
    //         cf_offer_valid_till.value = "";
    //         cf_offer_desc.value = "";
            

    //         cf_free_sample_freebie_type.removeAttribute("required");
    //         cf_free_sample_quantity.removeAttribute("required");
    //         cf_free_sample_eligible_users.removeAttribute("required");
    //         cf_free_sample_redemption_link.removeAttribute("required");
    //         cf_free_sample_desc.removeAttribute("required");

    //         cf_free_sample_freebie_type.value = "";
    //         cf_free_sample_quantity.value = "";
    //         cf_free_sample_eligible_users.value = "";
    //         cf_free_sample_redemption_link.value = "";
    //         cf_free_sample_desc.value = "";

            
    //         cf_free_recharge_type.removeAttribute("required");
    //         cf_free_recharge_eligible_operators.removeAttribute("required");
    //         cf_free_recharge_code.removeAttribute("required");
    //         cf_free_recharge_claim_url.removeAttribute("required");
    //         cf_free_recharge_instructions.removeAttribute("required");

    //         cf_free_recharge_type.value = "";
    //         cf_free_recharge_eligible_operators.value = "";
    //         cf_free_recharge_code.value = "";            
    //         cf_free_recharge_claim_url.value = "";
    //         cf_free_recharge_instructions.value = "";

    //     }
    //     else if (this.value === "Offer / Deal"){
    //         document.getElementById("coupon_promo").classList.add("divHidden");
    //         document.getElementById("offer_deal").classList.remove("divHidden");
    //         document.getElementById("free_sample").classList.add("divHidden");
    //         document.getElementById("free_recharge_coupon").classList.add("divHidden");

    //         cf_coupon_code_required.removeAttribute("required");
    //         cf_coupon_promo_code.removeAttribute("required");
    //         cf_coupon_discount_type.removeAttribute("required");
    //         cf_coupon_discount_value.removeAttribute("required");
    //         cf_coupon_min_order_value.removeAttribute("required");
    //         cf_coupon_max_discount_cap.removeAttribute("required");
    //         cf_coupon_login_required_redeem.removeAttribute("required");
    //         cf_coupon_redemption_limit.removeAttribute("required");
    //         cf_coupon_redirect_affiliate_url.removeAttribute("required");

    //         cf_coupon_code_required.value = "";
    //         cf_coupon_promo_code.value = "";
    //         cf_coupon_discount_type.value = "";
    //         cf_coupon_discount_value.value = "";
    //         cf_coupon_min_order_value.value = "";
    //         cf_coupon_max_discount_cap.value = "";
    //         cf_coupon_login_required_redeem.value = "";
    //         cf_coupon_redemption_limit.value = "";
    //         cf_coupon_redirect_affiliate_url.value = "";

    //         cf_offer_code_required.setAttribute("required", "required");
    //         cf_offer_type.setAttribute("required", "required");
    //         cf_offer_discount_value.setAttribute("required", "required");
    //         cf_offer_cta_buy_now_url.setAttribute("required", "required");
    //         cf_offer_valid_till.setAttribute("required", "required");
    //         cf_offer_desc.setAttribute("required", "required");

    //         cf_free_sample_freebie_type.removeAttribute("required");
    //         cf_free_sample_quantity.removeAttribute("required");
    //         cf_free_sample_eligible_users.removeAttribute("required");
    //         cf_free_sample_redemption_link.removeAttribute("required");
    //         cf_free_sample_desc.removeAttribute("required");

    //         cf_free_sample_freebie_type.value = "";
    //         cf_free_sample_quantity.value = "";
    //         cf_free_sample_eligible_users.value = "";
    //         cf_free_sample_redemption_link.value = "";
    //         cf_free_sample_desc.value = "";
            

    //         cf_free_recharge_type.removeAttribute("required");
    //         cf_free_recharge_eligible_operators.removeAttribute("required");
    //         cf_free_recharge_code.removeAttribute("required");
    //         cf_free_recharge_claim_url.removeAttribute("required");
    //         cf_free_recharge_instructions.removeAttribute("required");

    //         cf_free_recharge_type.value = "";
    //         cf_free_recharge_eligible_operators.value = "";
    //         cf_free_recharge_code.value = "";
    //         cf_free_recharge_claim_url.value = "";
    //         cf_free_recharge_instructions.value = "";

    //     }

    //     else if (this.value === "Free Sample"){
    //         document.getElementById("coupon_promo").classList.add("divHidden");
    //         document.getElementById("offer_deal").classList.add("divHidden");
    //         document.getElementById("free_sample").classList.remove("divHidden");
    //         document.getElementById("free_recharge_coupon").classList.add("divHidden");

    //         cf_coupon_code_required.removeAttribute("required");
    //         cf_coupon_promo_code.removeAttribute("required");
    //         cf_coupon_discount_type.removeAttribute("required");
    //         cf_coupon_discount_value.removeAttribute("required");
    //         cf_coupon_min_order_value.removeAttribute("required");
    //         cf_coupon_max_discount_cap.removeAttribute("required");
    //         cf_coupon_login_required_redeem.removeAttribute("required");
    //         cf_coupon_redemption_limit.removeAttribute("required");
    //         cf_coupon_redirect_affiliate_url.removeAttribute("required");

    //         cf_coupon_code_required.value = "";
    //         cf_coupon_promo_code.value = "";
    //         cf_coupon_discount_type.value = "";
    //         cf_coupon_discount_value.value = "";
    //         cf_coupon_min_order_value.value = "";
    //         cf_coupon_max_discount_cap.value = "";
    //         cf_coupon_login_required_redeem.value = "";
    //         cf_coupon_redemption_limit.value = "";
    //         cf_coupon_redirect_affiliate_url.value = "";

    //         cf_offer_code_required.removeAttribute("required");
    //         cf_offer_type.removeAttribute("required");
    //         cf_offer_discount_value.removeAttribute("required");
    //         cf_offer_cta_buy_now_url.removeAttribute("required");
    //         cf_offer_valid_till.removeAttribute("required");
    //         cf_offer_desc.removeAttribute("required");

    //         cf_offer_code_required.value = "";
    //         cf_offer_type.value = "";
    //         cf_offer_discount_value.value = "";
    //         cf_offer_cta_buy_now_url.value = "";
    //         cf_offer_valid_till.value = "";
    //         cf_offer_desc.value = "";

    //         cf_free_sample_freebie_type.setAttribute("required", "required");
    //         cf_free_sample_quantity.setAttribute("required", "required");
    //         cf_free_sample_eligible_users.setAttribute("required", "required");
    //         cf_free_sample_redemption_link.setAttribute("required", "required");
    //         cf_free_sample_desc.setAttribute("required", "required");

    //         cf_free_recharge_type.removeAttribute("required");
    //         cf_free_recharge_eligible_operators.removeAttribute("required");
    //         cf_free_recharge_code.removeAttribute("required");
    //         cf_free_recharge_claim_url.removeAttribute("required");
    //         cf_free_recharge_instructions.removeAttribute("required");

    //         cf_free_recharge_type.value = "";
    //         cf_free_recharge_eligible_operators.value = "";
    //         cf_free_recharge_code.value = "";            
    //         cf_free_recharge_claim_url.value = "";
    //         cf_free_recharge_instructions.value = "";

    //     }

    //     else if (this.value === "Free Recharge Coupon"){
    //         document.getElementById("coupon_promo").classList.add("divHidden");
    //         document.getElementById("offer_deal").classList.add("divHidden");
    //         document.getElementById("free_sample").classList.add("divHidden");
    //         document.getElementById("free_recharge_coupon").classList.remove("divHidden");

    //         cf_coupon_code_required.removeAttribute("required");
    //         cf_coupon_promo_code.removeAttribute("required");
    //         cf_coupon_discount_type.removeAttribute("required");
    //         cf_coupon_discount_value.removeAttribute("required");
    //         cf_coupon_min_order_value.removeAttribute("required");
    //         cf_coupon_max_discount_cap.removeAttribute("required");
    //         cf_coupon_login_required_redeem.removeAttribute("required");
    //         cf_coupon_redemption_limit.removeAttribute("required");
    //         cf_coupon_redirect_affiliate_url.removeAttribute("required");
            
    //         cf_coupon_code_required.value = "";
    //         cf_coupon_promo_code.value = "";
    //         cf_coupon_discount_type.value = "";
    //         cf_coupon_discount_value.value = "";
    //         cf_coupon_min_order_value.value = "";
    //         cf_coupon_max_discount_cap.value = "";
    //         cf_coupon_login_required_redeem.value = "";
    //         cf_coupon_redemption_limit.value = "";
    //         cf_coupon_redirect_affiliate_url.value = "";

    //         cf_offer_code_required.removeAttribute("required");
    //         cf_offer_type.removeAttribute("required");
    //         cf_offer_discount_value.removeAttribute("required");
    //         cf_offer_cta_buy_now_url.removeAttribute("required");
    //         cf_offer_valid_till.removeAttribute("required");
    //         cf_offer_desc.removeAttribute("required");

    //         cf_offer_code_required.value = "";
    //         cf_offer_type.value = "";
    //         cf_offer_discount_value.value = "";
    //         cf_offer_cta_buy_now_url.value = "";
    //         cf_offer_valid_till.value = "";
    //         cf_offer_desc.value = "";

    //         cf_free_sample_freebie_type.removeAttribute("required");
    //         cf_free_sample_quantity.removeAttribute("required");
    //         cf_free_sample_eligible_users.removeAttribute("required");
    //         cf_free_sample_redemption_link.removeAttribute("required");
    //         cf_free_sample_desc.removeAttribute("required");

    //         cf_free_sample_freebie_type.value = "";
    //         cf_free_sample_quantity.value = "";
    //         cf_free_sample_eligible_users.value = "";
    //         cf_free_sample_redemption_link.value = "";
    //         cf_free_sample_desc.value = "";

    //         cf_free_recharge_type.setAttribute("required", "required");
    //         cf_free_recharge_eligible_operators.setAttribute("required", "required");
    //         cf_free_recharge_code.setAttribute("required", "required");
    //         cf_free_recharge_claim_url.setAttribute("required", "required");
    //         cf_free_recharge_instructions.setAttribute("required", "required");
    //     }

    // });
    </script>
@endsection
