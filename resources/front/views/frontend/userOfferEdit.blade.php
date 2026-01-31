@include('frontend.layouts.userHeader')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
<script src="{{ asset('admin/assets/js/sample.js') }}"></script>
<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit Offer</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/dashboard') }}" class="activeUrl">Dashboard</a></li>
                        <li><a href="{{ url('offerAdd') }}" class="activeUrl">Add New Offer</a></li>
                        <li><a href="{{ url('offerList/0') }}" class="activeUrl">In Active Offer List</a></li>
                        <li><a href="{{ url('offerList/1') }}" class="activeUrl">Active Offer List</a></li>
                    </ul>
                </nav>
                @if(session('message'))
                    @if(session('message') == MSG_UPDATE_SUCCESS)
                    <div style="padding: 1px; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                        <p style="margin: 6px; font-weight: bold;">Data Updated Successfully!..</p>
                    </div>
                    @else
                        <div style="padding: 1px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"">
                            <p style="margin: 6px; font-weight: bold;">Error In Update!..</p>
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

        <div class="col-lg-12 col-md-12">
            <div class="add_utf_listing_section margin-top-45">
                <div class="utf_add_listing_part_headline_part">
                    <h3>Selected Categories</h3>
                </div>
                <div class="row with-forms">
                    <div class="col-md-6">
                        <h5>Selected Main Category : <span style="color:#3fb4e4">{{ $geOffereData->offer_main_category }}</span> </h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Selected Sub Category : <span style="color:#3fb4e4">{{ $geOffereData->offer_sub_category }}</span></h5>
                    </div>
                    {{-- <div class="col-md-6">
                        <h5>Selected Mall : <span style="color:#3fb4e4">{{ $geOffereData->mall_name }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Selected Brand : <span style="color:#3fb4e4">{{ $geOffereData->brand_name }}</span></h5>
                    </div> --}}
                </div>
            </div>
        </div>

        <form method="POST" action="{{ url('offerUpdate/'.$geOffereData->offer_id) }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="old_offer_main_category" value="{{ $geOffereData->offer_main_category }}">
            <input type="hidden" name="old_offer_sub_category" value="{{ $geOffereData->offer_sub_category }}">
            <input type="hidden" name="old_offer_image" value="{{$geOffereData->offer_image }}">
            <input type="hidden" name="old_offer_brand_image" value="{{$geOffereData->offer_brand_image }}">
            {{-- <input type="hidden" name="old_offer_mall_id" value="{{ $geOffereData->offer_mall_id }}">
            <input type="hidden" name="old_offer_brand_id" value="{{ $geOffereData->offer_brand_id }}"> --}}

            <div class="col-lg-12 col-md-12">
                <div class="add_utf_listing_section margin-top-45">
                    <div class="utf_add_listing_part_headline_part">
                        <h3><i class="sl sl-icon-tag"></i> Categories & Malls</h3>
                    </div>
                    <div class="row with-forms">
                        <div class="col-md-6">
                            <h5>Select Main Category</h5>
                            <div class="intro-search-field utf-chosen-cat-single"
                                style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="offer_main_category" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($mainCategoryData as $mainCategoryRow)
                                        <option value="{{ $mainCategoryRow['cat_main_id'] }}">{{ $mainCategoryRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Select Sub Category</h5>
                            <div class="intro-search-field utf-chosen-cat-single" style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="offer_sub_category" id="catsub_id">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <h5>Select Mall</h5>
                            <div class="intro-search-field utf-chosen-cat-single"
                                style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="offer_mall_id" id="mall_id">
                                    <option value="">Select</option>
                                    @foreach ($mallData as $mallRow)
                                    <option value="{{ $mallRow['mall_id'] }}" >{{ "(".$mallRow['mall_city'].") - ".$mallRow['mall_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Select Brand</h5>
                            <div class="intro-search-field utf-chosen-cat-single" style="border: 0px solid #dbdbdb !important;">
                                <select class="default" name="offer_brand_id" id="brand_id">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div> --}}

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
                                    <label>Offer Title <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="offer_title" value="{{ $geOffereData->offer_title }}" class="input-text"placeholder="Enter Offer Title" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Company Name <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="offer_company_name" value="{{$geOffereData->offer_company_name}}" class="input-text" placeholder="Enter Company Name" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Country <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="offer_country" value="{{ $geOffereData->offer_country }}" class="input-text" placeholder="Enter Country" required>
                                </div>
                                <div class="col-md-3">
                                    <label>State <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="offer_state" value="{{ $geOffereData->offer_state }}" class="input-text" placeholder="Enter State" required>
                                </div>
                                <div class="col-md-3">
                                    <label>City <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="offer_city" value="{{ $geOffereData->offer_city }}" class="input-text" placeholder="Enter City" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Start Date <span class="req" style="color: red">*</span></label>
                                    <input type="date" name="offer_start_date" value="{{ $geOffereData->offer_start_date }}" class="input-text" placeholder="Enter Start Date" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Start Time <span class="req" style="color: red">*</span></label>
                                    <input type="time" name="offer_start_time" value="{{ $geOffereData->offer_start_time }}" class="input-text" placeholder="Enter Start Time" required>
                                </div>
                                <div class="col-md-3">
                                    <label>End Date <span class="req" style="color: red">*</span></label>
                                    <input type="date" name="offer_end_date" value="{{ $geOffereData->offer_end_date }}" class="input-text" placeholder="Enter End Date" required>
                                </div>
                                <div class="col-md-3">
                                    <label>End Time <span class="req" style="color: red">*</span></label>
                                    <input type="time" name="offer_end_time" value="{{ $geOffereData->offer_end_time }}" class="input-text" placeholder="Enter End Time" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Offer Image <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                                        <a target="_blank" href="{{asset('custom-images/offers/'.$geOffereData->offer_image)}}">(View Image)</a>
                                    </label>
                                    <input type="file" name="offer_image" class="input-text" onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'>
                                </div>

                                <div class="col-md-3">
                                    <label>Brand logo <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                                        <a target="_blank" href="{{asset('custom-images/offers/'.$geOffereData->offer_brand_image)}}">(View Image)</a>
                                    </label>
                                    <input type="file" name="offer_brand_image" class="input-text" onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'>
                                </div>

                                <div class="col-md-12">
                                    <label>Offer Term & Conditions <span class="req" style="color: red">*</span></label>
                                    <textarea name="offer_t_c" cols="10" rows="8" required>{{$geOffereData->offer_t_c}}</textarea>
                                </div>


                                <div class="col-md-12">
                                    <label>Offer Description <span class="req" style="color: red">*</span></label>
                                    <textarea id="editor" name="offer_detail" cols="10" rows="8" required>{{ $geOffereData->offer_detail }}</textarea>
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
                                    <input type="text" name="offer_meta_title" class="input-text" value="{{ $geOffereData->offer_meta_title }}" placeholder="Enter Meta Title">
                                </div>
                                <div class="col-md-12">
                                    <label>Meta Keywords</label>
                                    <textarea name="offer_meta_keyword" class="input-text" placeholder="Meta Keywords">{{ $geOffereData->offer_meta_keyword }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label>Meta Description</label>
                                    <textarea name="offer_meta_description" class="input-text" placeholder="Meta Description">{{ $geOffereData->offer_meta_description }}</textarea>
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
        jQuery('#mall_id').change(function() {
            var mall_id = jQuery(this).val()
            jQuery.ajax({
                url: '/admin/getmallBrands',
                type: 'POST',
                data: 'mall_id=' + mall_id + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#brand_id').html(result)
                }
            });
        });
    });
</script>
@include('frontend.layouts.userFooter')
