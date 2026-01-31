@extends('user_admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <style>
        .divHidden {
            display: none !important;
        }

        .divVisible {
            display: block;
        }

        .customBlueColor {
            color: #0037ffb0;
            font-weight: bolder;
        }
    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Edit Coupon & Offers</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{ url(USER_ADMIN_URL . 'dashboard') }}">Dashboard</a> /</li>
                            <li class="breadcrumb-item"><a href="{{ url(USER_ADMIN_URL . 'couponOfferList') }}">Coupon Offer List</a> /</li>
                            <li class="breadcrumb-item active">Edit Coupon & Offers</li>
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
                            @if (session('message') == MSG_UPDATE_SUCCESS)
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Data Updated  Successfully!..</div>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                            aria-label="Close"fdprocessedid="wsb8o"></button>
                                    </div>
                                    <div>
                                    @else
                                        <div id="liveAlertPlaceholder">
                                            <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                                <div class="text-truncate">Error In Update!..</div>
                                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                    aria-label="Close" fdprocessedid="wsb8o"></button>
                                            </div>
                                            <div>
                            @endforelse
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <div class="row with-forms">
                                <div class="col-md-4">
                                    <h5>Selected Main Category : <span
                                            style="color:red">{{ $couponOfferData['cf_main_cat'] }}</span>
                                    </h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Selected Sub Category : <span
                                            style="color:red">{{ $couponOfferData['cf_sub_cat'] }}</span>
                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ url(USER_ADMIN_URL.'couponOfferUpdate/'.$couponOfferData['cf_id']) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_cf_main_cat" value="{{$couponOfferData['cf_main_cat']}}">
                                <input type="hidden" name="old_cf_sub_cat" value="{{$couponOfferData['cf_sub_cat']}}">
                                <input type="hidden" name="old_cf_store_logo" value="{{$couponOfferData['cf_store_logo']}}">
                                <input type="hidden" name="old_cf_banner_thumbnail" value="{{$couponOfferData['cf_banner_thumbnail']}}">
                                <input type="hidden" name="old_cf_free_recharge_eligible_operators" value="{{$couponOfferData['cf_free_recharge_eligible_operators']}}">
                                <input type="hidden" name="old_cf_platform" value="{{$couponOfferData['cf_platform']}}">
                                <input type="hidden" name="old_cf_highlight_options" value="{{$couponOfferData['cf_highlight_options']}}">
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Select Main Category</label>
                                    <select class="form-select mt-2" name="cf_main_cat" id="catmain_id">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        @foreach ($mainCategoryData as $mainCategoryRow)
                                            <option value="{{ $mainCategoryRow['cat_main_id'] }}">
                                                {{ $mainCategoryRow['cat_main_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please Select Main Category.</div>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Select Sub Category</label>
                                    <select class="form-select mt-2" name="cf_sub_cat" id="catsub_id">
                                        <option selected="" disabled="" value="">Choose...</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Sub Category.</div>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Listing Type <span
                                            style="color: red">*</span></label>
                                    <select class="form-control mt-2" required name="cf_listing_type" id="cf_listing_type">
                                        <option value="">Select</option>
                                        <option value="Coupon / Promo Code"
                                            @if ($couponOfferData['cf_listing_type'] == 'Coupon / Promo Code') selected style="color:red" @endif>Coupon /
                                            Promo Code</option>

                                        <option value="Offer / Deal"
                                            @if ($couponOfferData['cf_listing_type'] == 'Offer / Deal') selected style="color:red" @endif>Offer / Deal
                                        </option>

                                        <option value="Free Sample"
                                            @if ($couponOfferData['cf_listing_type'] == 'Free Sample') selected style="color:red" @endif>Free Sample
                                        </option>

                                        <option value="Free Recharge Coupon"
                                            @if ($couponOfferData['cf_listing_type'] == 'Free Recharge Coupon') selected style="color:red" @endif>Free
                                            Recharge Coupon</option>

                                    </select>
                                    <div class="invalid-feedback">Please Enter Brand Name.</div>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Title <span style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="cf_title"
                                        value="{{ $couponOfferData['cf_title'] }}" id="cf_title" type="text"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Title.</div>
                                </div>

                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Short Tagline <span
                                            style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="cf_short_tagline" id="cf_short_tagline"
                                        type="text" required="" value="{{ $couponOfferData['cf_short_tagline'] }}">
                                    <div class="invalid-feedback">Please Enter Short Tagline.</div>
                                </div>

                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Store/Brand Name <span
                                            style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="cf_store_name" id="cf_store_name"
                                        type="text" required="" value="{{ $couponOfferData['cf_store_name'] }}">
                                    <div class="invalid-feedback">Please Enter Store/Brand Name</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Region / City <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_city" id="cf_city" type="text"
                                        required="" value="{{ $couponOfferData['cf_city'] }}">
                                    <div class="invalid-feedback">Please Select Start Time.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Start Date <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_start_date" id="cf_start_date" type="date"
                                        required="" value="{{ $couponOfferData['cf_start_date'] }}">
                                    <div class="invalid-feedback">Please Start Date.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">End Date <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_end_date" id="cf_end_date" type="date"
                                        required="" value="{{ $couponOfferData['cf_end_date'] }}">
                                    <div class="invalid-feedback">Please End Date.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Store Website <span style="color: red">*</span></label>
                                    <input class="form-control" name="cf_store_website" id="cf_store_website"
                                        type="text" required=""
                                        value="{{ $couponOfferData['cf_store_website'] }}">
                                    <div class="invalid-feedback">Please Enter Store Website.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ongoing Offer? <span style="color: red">*</span></label>
                                    <select class="form-control" name="cf_ongoing_offer" id="cf_ongoing_offer" required>
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            @if ($couponOfferData['cf_ongoing_offer'] == 'Yes') selected style="color:red" @endif>Yes</option>
                                        <option value="No"
                                            @if ($couponOfferData['cf_ongoing_offer'] == 'No') selected style="color:red" @endif>No</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Ongoing Offer.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Sort Priority</label>
                                    <input class="form-control" name="cf_sort_priority" id="cf_sort_priority"
                                        type="text" value="{{ $couponOfferData['cf_sort_priority'] }}">
                                </div>

                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Store Logo Upload <a target="_blank"
                                            href="{{ url('custom-images/coupon-offer/' . $couponOfferData->cf_store_logo) }}"
                                            class="customBlueColor">(View
                                            Image)</a></label>
                                    <input class="form-control mt-2" name="cf_store_logo" id="cf_store_logo" type="file">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Banner / Thumbnail Upload <a target="_blank"
                                            href="{{ url('custom-images/coupon-offer/' . $couponOfferData->cf_banner_thumbnail) }}"
                                            class="customBlueColor">(View
                                            Image)</a></label>
                                    <input class="form-control" name="cf_banner_thumbnail" id="cf_banner_thumbnail" type="file">
                                </div>
                                 <div class="col-3">
                                      
                                            <label for="f_status">Status <span class="req"style="color: red">*</span></label>
                                            <select class="form-control required" name="cf_status">
                                                <option value="">Select </option>
                                                 <option value="{{STATUS_ACTIVE}}" @if($couponOfferData['cf_status'] == STATUS_ACTIVE) selected style="color:red" @endif>Active</option>
                                                <option value="{{STATUS_INACTIVE}}" @if($couponOfferData['cf_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>
                                            </select>
                                        </div>
                                <div class="col-md-3">
                                    <label class="form-label">User Type <span style="color: red">*</span></label>
                                    <br>
                                    <input name="cf_user_type" id="cf_user_type" type="checkbox" value="All Users"
                                        required checked> All Users
                                    <div class="invalid-feedback">Please Select User Type .</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Platform (Selected: {{ $couponOfferData['cf_platform'] }} )
                                        <span style="color: red">*</span></label>
                                    <br>
                                    <input name="cf_platform[]" id="cf_platform" type="checkbox" value="Web">
                                    Web&emsp;
                                    <input name="cf_platform[]" id="cf_platform1" type="checkbox" value="App"> App
                                    <div class="invalid-feedback">Please Select Platform .</div>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label">Highlight Options (Selected:
                                        {{ $couponOfferData['cf_highlight_options'] }} ) </label>
                                    <br>
                                    <input name="cf_highlight_options[]" id="cf_highlight_options" type="checkbox"
                                         value="Homepage"> Homepage&emsp;
                                    <input name="cf_highlight_options[]" id="cf_highlight_options1" type="checkbox"
                                        value="Trending"> Trending
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Term & Condition </label>
                                    <textarea class="form-control" name="cf_term_condition" id="cf_term_condition" rows="5">{{ $couponOfferData['cf_term_condition'] }}</textarea>
                                    <div class="invalid-feedback">Please Enter Coupon Term & Condition.</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description <span style="color: red">*</span></label>
                                    <textarea class="form-control" id="editor" name="cf_desc" id="cf_desc" cols="5" rows="5"
                                        required="">{{ $couponOfferData['cf_desc'] }}</textarea>
                                    <div class="invalid-feedback">Please Enter Coupon Description.</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Admin Notes</label>
                                    <textarea class="form-control" name="cf_admin_note" id="cf_admin_note" rows="5">{{ $couponOfferData['cf_admin_note'] }}</textarea>
                                </div>

                                <div class="@if($couponOfferData['cf_listing_type'] == 'Coupon / Promo Code') divVisible @else divHidden @endif"
                                    id="coupon_promo">
                                    <div class="row">
                                        <h4><br> Coupon / Promo Code: </h4>
                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Code Required? <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" name="cf_coupon_code_required"
                                                id="cf_coupon_code_required">
                                                <option value="" disabled selected>Select</option>
                                                <option @if ($couponOfferData['cf_coupon_code_required'] == 'Yes') selected style="color:red" @endif
                                                    value="Yes">Yes</option>
                                                <option @if ($couponOfferData['cf_coupon_code_required'] == 'No') selected style="color:red" @endif
                                                    value="No">No</option>
                                            </select>
                                            <div class="invalid-feedback">Please Select Code.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Coupon / Promo Code <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                value="<?= $couponOfferData['cf_coupon_promo_code'] ?>"
                                                name="cf_coupon_promo_code" id="cf_coupon_promo_code">
                                            <div class="invalid-feedback">Please Coupon / Promo Code.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Discount Type <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" name="cf_coupon_discount_type"
                                                id="cf_coupon_discount_type">
                                                <option value="">Select</option>
                                                <option @if ($couponOfferData['cf_coupon_discount_type'] == 'Flat') selected style="color:red" @endif
                                                    value="Flat">Flat</option>
                                            </select>
                                            <div class="invalid-feedback">Please Discount Type.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Discount Value <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                value="<?= $couponOfferData['cf_coupon_discount_value'] ?>"
                                                name="cf_coupon_discount_value" id="cf_coupon_discount_value">
                                            <div class="invalid-feedback">Please Discount Value.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Min Order Value</label>
                                            <input type="text" name="cf_coupon_min_order_value"
                                                value="<?= $couponOfferData['cf_coupon_min_order_value'] ?>"
                                                id="cf_coupon_min_order_value" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Max Discount Cap</label>
                                            <input type="text" name="cf_coupon_max_discount_cap"
                                                value="<?= $couponOfferData['cf_coupon_max_discount_cap'] ?>"
                                                id="cf_coupon_max_discount_cap" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Login Required to Redeem?</label>
                                            <select class="form-control" name="cf_coupon_login_required_redeem"
                                                id="cf_coupon_login_required_redeem">
                                                <option value="">Select</option>
                                                <option
                                                    @if ($couponOfferData['cf_coupon_login_required_redeem'] == 'Yes') selected style="color:red" @endif
                                                    value="Yes">Yes</option>
                                                <option
                                                    @if ($couponOfferData['cf_coupon_login_required_redeem'] == 'No') selected style="color:red" @endif
                                                    value="No">No</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Redemption Limit</label>
                                            <input type="text" class="form-control" name="cf_coupon_redemption_limit"
                                                id="cf_coupon_redemption_limit"
                                                value="<?= $couponOfferData['cf_coupon_redemption_limit'] ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Redirect / Affiliate URL</label>
                                            <input type="text" class="form-control"
                                                name="cf_coupon_redirect_affiliate_url"
                                                id="cf_coupon_redirect_affiliate_url"
                                                value="<?= $couponOfferData['cf_coupon_redirect_affiliate_url'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="@if($couponOfferData['cf_listing_type'] == 'Offer / Deal') divVisible @else divHidden @endif"
                                    id="offer_deal">
                                    <div class="row">
                                        <h4><br> Offer / Deal:</h4>
                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Code Required? <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" name="cf_offer_code_required"
                                                id="cf_offer_code_required">
                                                <option value="">Select</option>
                                                <option
                                                    @if($couponOfferData['cf_offer_code_required'] == 'Yes') selected style="color:red" @endif
                                                    value="Yes">Yes</option>
                                                <option
                                                    @if ($couponOfferData['cf_offer_code_required'] == 'No') selected style="color:red" @endif
                                                    value="No">No</option>
                                            </select>
                                            <div class="invalid-feedback">Please Select Code.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Offer Type <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="cf_offer_type"
                                                id="cf_offer_type" value="{{ $couponOfferData['cf_offer_type'] }}">
                                            <div class="invalid-feedback">Please Offer Type.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Discount Value <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                name="cf_offer_discount_value" id="cf_offer_discount_value"
                                                value="{{ $couponOfferData['cf_offer_discount_value'] }}">
                                            <div class="invalid-feedback">Please Discount Value.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">CTA / Buy Now URL <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                name="cf_offer_cta_buy_now_url" id="cf_offer_cta_buy_now_url"
                                                value="{{ $couponOfferData['cf_offer_cta_buy_now_url'] }}">
                                            <div class="invalid-feedback">Please CTA / Buy Now URL.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Valid Till <span style="color: red">*</span></label>
                                            <input type="date" class="form-control"
                                                name="cf_offer_valid_till" id="cf_offer_valid_till"
                                                value="{{ $couponOfferData['cf_offer_valid_till'] }}">
                                            <div class="invalid-feedback">Please Valid Till.</div>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <label class="form-label">Offer Description <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" rows="5" name="cf_offer_desc" id="cf_offer_desc">{{ $couponOfferData['cf_offer_desc'] }}</textarea>
                                            <div class="invalid-feedback">Please Offer Description.</div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="@if($couponOfferData['cf_listing_type'] == 'Free Sample') divVisible @else divHidden @endif"
                                    id="free_sample">
                                    <div class="row">
                                        <h4><br> Free Sample:</h4>
                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Freebie Type <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" name="cf_free_sample_freebie_type"
                                                id="cf_free_sample_freebie_type">
                                                <option value="">Select</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_sample_freebie_type'] == 'Free Sample') selected style="color:red" @endif
                                                    value="Free Sample">Free Sample</option>
                                            </select>
                                            <div class="invalid-feedback">Please Select Freebie Type.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Sample Quantity <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                name="cf_free_sample_quantity" id="cf_free_sample_quantity"
                                                value="{{ $couponOfferData['cf_free_sample_quantity'] }}">
                                            <div class="invalid-feedback">Please Sample Quantity.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Eligible Users</label>
                                            <input type="text" class="form-control"
                                                name="cf_free_sample_eligible_users" id="cf_free_sample_eligible_users"
                                                value="{{ $couponOfferData['cf_free_sample_eligible_users'] }}">
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Sample Redemption Link <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                name="cf_free_sample_redemption_link" id="cf_free_sample_redemption_link"
                                                value="{{ $couponOfferData['cf_free_sample_redemption_link'] }}">
                                            <div class="invalid-feedback">Please Sample Redemption Link.</div>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <label class="form-label">Sample Description <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" rows="5" name="cf_free_sample_desc" id="cf_free_sample_desc">{{ $couponOfferData['cf_free_sample_desc'] }}</textarea>
                                            <div class="invalid-feedback">Please Sample Description.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="@if($couponOfferData['cf_listing_type'] == 'Free Recharge Coupon') divVisible @else divHidden @endif"
                                    id="free_recharge_coupon">
                                    <div class="row">
                                        <h4><br> Free Recharge Coupon:</h4>
                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Recharge Type <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" name="cf_free_recharge_type"
                                                id="cf_free_recharge_type">
                                                <option value="">Select</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_recharge_type'] == '50') selected style="color:red" @endif
                                                    value="50">50</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_recharge_type'] == '100') selected style="color:red" @endif
                                                    value="100">100</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_recharge_type'] == '150') selected style="color:red" @endif
                                                    value="150">150</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_recharge_type'] == '200') selected style="color:red" @endif
                                                    value="200">200</option>
                                            </select>
                                            <div class="invalid-feedback">Please Recharge Type.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Eligible Operators (Selected:
                                        {{ $couponOfferData['cf_free_recharge_eligible_operators'] }} )</label>
                                            <select class="form-control" multiple name="cf_free_recharge_eligible_operators[]" id="cf_free_recharge_eligible_operators">
                                                <option value="">Select</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_recharge_eligible_operators'] == 'Jio') selected style="color:red" @endif
                                                    value="Jio">Jio</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_recharge_eligible_operators'] == 'Airtel') selected style="color:red" @endif
                                                    value="Airtel">Airtel</option>
                                                <option
                                                    @if ($couponOfferData['cf_free_recharge_eligible_operators'] == 'Vi') selected style="color:red" @endif
                                                    value="Vi">Vi</option>
                                            </select>
                                            <div class="invalid-feedback">Please Select Eligible Operators.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Recharge Code</label>
                                            <input type="text" class="form-control" name="cf_free_recharge_code"
                                                id="cf_free_recharge_code"
                                                value="{{ $couponOfferData['cf_free_recharge_code'] }}">
                                            <div class="invalid-feedback">Please Recharge Code.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <label class="form-label">Claim URL<span style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                name="cf_free_recharge_claim_url" id="cf_free_recharge_claim_url"
                                                value="{{ $couponOfferData['cf_free_recharge_claim_url'] }}">
                                            <div class="invalid-feedback">Please Claim URL.</div>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <label class="form-label">Recharge Instructions <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" rows="5" name="cf_free_recharge_instructions"
                                                id="cf_free_recharge_instructions">{{ $couponOfferData['cf_free_recharge_instructions'] }}</textarea>
                                        </div>
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

        function toggleSections(activeSection){
           
            allSections.forEach(secId => {
                const el = document.getElementById(secId);
                if (el) el.classList.add("divHidden");
            });
            const activeEl = document.getElementById(activeSection);
            if(activeEl) activeEl.classList.remove("divHidden");
        }

        cf_listing_type.addEventListener("change", function() {
            const choice = config[this.value];
            removeRequired(allFields);
            toggleSections("");
            if(choice){
                toggleSections(choice.section);
                setRequired(choice.fields);
            }
        });

    </script>
@endsection
