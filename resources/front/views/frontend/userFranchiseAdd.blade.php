@include('frontend.layouts.userHeader')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
<script src="{{ asset('admin/assets/js/sample.js') }}"></script>
<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Franchise</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/dashboard') }}" class="activeUrl">Dashboard</a></li>
                        <li><a href="{{ url('franchiseList/0') }}" class="activeUrl">In Active Franchise List</a></li>
                        <li><a href="{{ url('franchiseList/1') }}" class="activeUrl">Active Franchise List</a></li>
                    </ul>
                </nav>
                @if (session('message'))
                    @if (session('message') == MSG_ADD_SUCCESS)
                    <br>
                        <div style="padding: 1px; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                            <p style="margin: 13px; font-weight: bold;">Data Inserted Successfully!..</p>
                        </div>
                     @else
                        <div style="padding: 1px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"">
                            <p style="margin: 6px; font-weight: bold;">Error In Insert!..</p>
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
        <form method="POST" action="{{ url('franchiseStore') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 col-md-12">
                <div class="add_utf_listing_section margin-top-45">
                    <div class="utf_add_listing_part_headline_part">
                        <h3><i class="sl sl-icon-tag"></i> Categories & Malls</h3>
                    </div>
                    <div class="row with-forms">
                        <div class="col-md-4">
                            <h5>Select Main Category <span class="req" style="color: red">*</span></h5>
                            <div class="intro-search-field utf-chosen-cat-single"
                                style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="f_main_cat" id="catmain_id" required>
                                    <option value="">Select</option>
                                    @foreach ($mainCategoryData as $mainCategoryRow)
                                        <option value="{{ $mainCategoryRow['fcm_id'] }}">
                                            {{ $mainCategoryRow['fcm_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Select Sub Category <span class="req" style="color: red">*</span></h5>
                            <div class="intro-search-field utf-chosen-cat-single"
                                style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="f_sub_cat" id="catsub_id" required>
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5>Select Child Category <span class="req" style="color: red">*</span></h5>
                            <div class="intro-search-field utf-chosen-cat-single"
                                style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="f_child_cat" id="catchild_id" required>
                                    <option>Select</option>
                                </select>
                            </div>
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

                                <div class="col-md-3" style="margin-top:7px">
                                    <label>Franchise Name <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_name" class="input-text"
                                        placeholder="Enter Franchise Name" required>
                                </div>

                                <div class="col-md-3" style="margin-top:7px">
                                    <label>Email <span class="req" style="color: red">*</span></label>
                                    <input type="email" name="f_email" class="input-text"
                                        placeholder="Email" required>
                                </div>

                                <div class="col-md-3" style="margin-top:7px">
                                    <label>Contact No <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_contact_no" class="input-text"
                                        placeholder="Enter Contact No" required>
                                </div>

                                <div class="col-md-3" style="margin-top:7px">
                                    <label>Alternet Contact No</label>
                                    <input type="text" name="f_alt_contact" class="input-text"
                                        placeholder="Enter Alternet Contact No">
                                </div>


                                <div class="col-md-3">
                                    <label>Franchise Type <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_type"
                                        class="input-text"placeholder="Enter Franchise type" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Franchise Start / Opening Year <span class="req" style="color: red">*</span></label>
                                    <select class="default" title="Select Year" name="f_start_year" id="f_start_year">
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

                                <div class="col-md-3">
                                    <label>Country <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_country" class="input-text"
                                        placeholder="Enter Country" required>
                                </div>

                                <div class="col-md-3">
                                    <label>State <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_state" class="input-text"
                                        placeholder="Enter State" required>
                                </div>
                                <div class="col-md-3">
                                    <label>City <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_city" class="input-text"
                                        placeholder="Enter City" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Pin Code/Zip Code <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_pin_code" class="input-text"
                                        placeholder="Enter Pin Code/Zip Code" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Location <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_location" class="input-text"
                                        placeholder="Enter Location" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Headquarter <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_headquarter" class="input-text"
                                        placeholder="Enter Headquarter" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Space Req <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_space_req" class="input-text"
                                        placeholder="Enter Space Req" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Investment Range <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="f_investment_range" class="input-text"
                                        placeholder="Enter Investment Range" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Franchises Image <span
                                            title="Please upload jpg,jpge,png & 2 MB size file only"><i
                                                class="fa fa-info-circle" style="color: #3fb4e4;"></i></span> <span
                                            class="req" style="color: red">*</span></label>
                                    <input type="file" name="franchise_images[]" class="input-file" multiple>
                                </div>



                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <label>Franchise Description <span class="req"
                                            style="color: red">*</span></label>
                                    <textarea id="editor" name="f_desc" cols="10" rows="8" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="utf_dashboard_list_box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-user"></i> Social Links</h4>
                    <div class="utf_dashboard_list_box-static">
                        <div class="my-profile">
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label>Website URL</label>
                                        <input type="text" name="f_website_url" class="input-text"
                                            placeholder="Enter Website URL" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Facebook URL</label>
                                        <input type="text" name="f_facebook_url" class="input-text"
                                            placeholder="Enter Facebook URL" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Instagram URL</label>
                                        <input type="text" name="f_instagram_url" class="input-text"
                                            placeholder="Enter Instagram URL" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Twitter URL</label>
                                        <input type="text" name="f_twitter_url" class="input-text"
                                            placeholder="Enter Twitter URL" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="utf_dashboard_list_box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-user"></i> Expension Plan</h4>
                    <div class="utf_dashboard_list_box-static">
                        <div class="my-profile">
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>North</label>
                                        <input type="text" name="f_north" class="input-text"
                                            placeholder="Enter North">
                                    </div>

                                    <div class="col-md-6">
                                        <label>South</label>
                                        <input type="text" name="f_south" class="input-text"
                                            placeholder="Enter South">
                                    </div>

                                    <div class="col-md-6">
                                        <label>East</label>
                                        <input type="text" name="f_east" class="input-text"
                                            placeholder="Enter East">
                                    </div>

                                    <div class="col-md-6">
                                        <label>West</label>
                                        <input type="text" name="f_west" class="input-text"
                                            placeholder="Enter West">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Center</label>
                                        <input type="text" name="f_center" class="input-text"
                                            placeholder="Enter Center">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Union Territories</label>
                                        <input type="text" name="f_union_territories" class="input-text"
                                            placeholder="Enter Union Territories">
                                    </div>

                                </div>
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
                                    <input type="text" name="f_meta_title" class="input-text"
                                        placeholder="Enter Meta Title">
                                </div>
                                <div class="col-md-12">
                                    <label>Meta Keywords</label>
                                    <textarea name="f_meta_keyword" class="input-text" placeholder="Meta Keywords"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label>Meta Description</label>
                                    <textarea name="f_meta_description" class="input-text" placeholder="Meta Description"></textarea>
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
                url: '/getFranchiseSubCategory',
                type: 'POST',
                data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#catsub_id').html(result)
                }
            });
        });
    });
</script>
<script>
    initSample();
    jQuery(document).ready(function() {
        jQuery('#catsub_id').change(function() {
            var catmain_id = jQuery('#catmain_id').val()
            var catsub_id = jQuery(this).val()
            jQuery.ajax({
                url: '/getFranchiseChildCategory',
                type: 'POST',
                data: 'catmain_id='+catmain_id+'&catsub_id='+catsub_id+'&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#catchild_id').html(result)
                }
            });
        });
    });
</script>
@include('frontend.layouts.userFooter')
