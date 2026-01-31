@include('frontend.layouts.userHeader')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
<script src="{{ asset('admin/assets/js/sample.js') }}"></script>
<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Coupon</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/dashboard') }}" class="activeUrl">Dashboard</a></li>
                        <li><a href="{{ url('couponList/0') }}" class="activeUrl">In Active Coupon List</a></li>
                        <li><a href="{{ url('couponList/1') }}" class="activeUrl">Active Coupon List</a></li>
                    </ul>
                </nav>
                @if(session('message'))
                    @if(session('message') == MSG_ADD_SUCCESS)
                        <div style="padding: 1px; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                            <p style="margin: 6px; font-weight: bold;">Data Inserted Successfully!..</p>
                        </div>
                    @else
                        <div style="padding: 1px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"">
                            <p style="margin: 6px; font-weight: bold;">Error In Insert!..</p>
                        </div>
                    @endforelse
                @endif
                @if($errors->any())
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
        <form method="POST" action="{{ url('couponStore') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 col-md-12">
                <div class="add_utf_listing_section margin-top-45">
                    <div class="utf_add_listing_part_headline_part">
                        <h3><i class="sl sl-icon-tag"></i> Categories & Malls</h3>
                    </div>
                    <div class="row with-forms">
                        <div class="col-md-3">
                            <h5>Select Main Category <span class="req" style="color: red">*</span></h5>
                            <div class="intro-search-field utf-chosen-cat-single"
                                style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="coupon_main_category" id="catmain_id" required>
                                    <option value="">Select</option>
                                    @foreach ($mainCategoryData as $mainCategoryRow)
                                        <option value="{{ $mainCategoryRow['cat_main_id'] }}">{{ $mainCategoryRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Select Sub Category <span class="req" style="color: red">*</span></h5>
                            <div class="intro-search-field utf-chosen-cat-single" style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="coupon_sub_category" id="catsub_id" required>
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" style="margin-top:7px">
                            <label>Start Date <span class="req" style="color: red">*</span></label>
                            <input type="date" name="coupon_start_date" class="input-text" placeholder="Enter Start Date" required>
                        </div>
                        <div class="col-md-3" style="margin-top:7px">
                            <label>Start Time <span class="req" style="color: red">*</span></label>
                            <input type="time" name="coupon_start_time" class="input-text" placeholder="Enter End Time" required>
                        </div>
                    </div>
                    <div class="row with-forms">
                        <div class="col-md-3" style="margin-top:7px">
                            <label>End Date <span class="req" style="color: red">*</span></label>
                            <input type="date" name="coupon_end_date" class="input-text" placeholder="Enter End Date" required>
                        </div>
                        <div class="col-md-3" style="margin-top:7px">
                            <label>End Time <span class="req" style="color: red">*</span></label>
                            <input type="time" name="coupon_end_time" class="input-text" placeholder="Enter End Time" required>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="utf_dashboard_list_box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-list"></i> Basic Details</h4>
                    <div class="utf_dashboard_list_box-static">
                        <div class="my-profile">
                            <div class="row with-forms">
                                <div class="col-md-3">
                                    <label>Brand Name <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_brand_name" class="input-text"placeholder="Enter Brand Name" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Company Name <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_company_name" class="input-text" placeholder="Enter Company Name" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Coupon Title <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_title" class="input-text" placeholder="Enter Coupon Title" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Coupon Code <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_code" class="input-text" placeholder="Enter Coupon Code" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Coupon Number <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_contact" class="input-text" placeholder="Enter Coupon Number" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Country <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_country" class="input-text" placeholder="Enter Country" required>
                                </div>

                                <div class="col-md-3">
                                    <label>State <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_state" class="input-text" placeholder="Enter State" required>
                                </div>
                                <div class="col-md-3">
                                    <label>City <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_city" class="input-text" placeholder="Enter City" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Coupon Website <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_website" class="input-text" placeholder="Enter Coupon Website" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Location <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="coupon_location" class="input-text" placeholder="Enter Coupon Website" required>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-6">
                                    <label>Brand Description <span class="req" style="color: red">*</span></label>
                                    <textarea name="coupon_brand_detail" cols="10" rows="8" required></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label>Product / Services <span class="req" style="color: red">*</span></label>
                                    <textarea name="coupon_product_services" cols="10" rows="8" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label>Coupon Term & Condition <span class="req" style="color: red">*</span></label>
                                    <textarea name="coupon_t_c" cols="10" rows="8" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label>Coupon Description <span class="req" style="color: red">*</span></label>
                                    <textarea id="editor" name="coupon_description" cols="10" rows="8" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="utf_dashboard_list_box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-user"></i> Images</h4>
                    <div class="utf_dashboard_list_box-static">
                        <div class="my-profile">
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <label>Coupon Image <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span> <span class="req" style="color: red">*</span></label>
                                        <input type="file" name="coupon_image" class="input-text" onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})' required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Brand Image <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span> <span class="req" style="color: red">*</span></label>
                                        <input type="file" name="coupon_brand_image" class="input-text" onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})' required>
                                    </div>
                                    <!--<div class="col-md-4">
                                        <label>Coupon Terms & Condition <span title="Please upload doc,docx & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span> <span class="req" style="color: red">*</span></label>
                                        <input type="file" name="coupon_t_c" class="input-text" onchange='single_attachment(this,{{ ONLY_DOCUMENTS_FORMATES }},{{ DOCUMENTS_SIZE }})' required>
                                    </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="utf_dashboard_list_box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-user"></i> SEO Details</h4>
                    <div class="utf_dashboard_list_box-static">
                        <div class="my-profile">
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <label>Meta Title</label>
                                    <input type="text" name="coupon_meta_title" class="input-text" placeholder="Enter Meta Title">
                                </div>
                                <div class="col-md-12">
                                    <label>Meta Keywords</label>
                                    <textarea name="coupon_meta_keyword" class="input-text" placeholder="Meta Keywords"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label>Meta Description</label>
                                    <textarea name="coupon_meta_description" class="input-text" placeholder="Meta Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <button type="submit" class="button preview btn_center_item margin-top-15">Save Changes</button>
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
                url: '/admin/getBlogSubCategory',
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
