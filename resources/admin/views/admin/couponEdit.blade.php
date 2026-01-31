@extends('admin.layouts.main')
@section('main-container')
@php use Illuminate\Support\Carbon; @endphp
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('admin/couponAdd')}}">Coupon Add</a></li>
                <li><a href="{{url('admin/couponList/'.STATUS_ACTIVE)}}">Coupon Active List</a></li>
                <li><a href="{{url('admin/couponList/'.STATUS_INACTIVE)}}">Coupon In Active List</a></li>
                <li><span>Coupon Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Coupon Details</h3>

        @if(session('message'))
            @if(session('message') == MSG_UPDATE_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Updated Successfully!..</p>
                </div>
            @else
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In Update!..</p>
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

        <div class="md-card">
            <div class="md-card-content large-padding">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Main Category : <span style="color:#1976d2"> {{ $couponSingleData['coupon_main_category'] }}</span></label>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Sub Category : <span style="color:#1976d2"> {{ $couponSingleData['coupon_sub_category'] }}</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="md-card">
            <div class="md-card-content large-padding">
                <form id="form_validation" method="POST" action="{{url('admin/couponUpdate/'.$couponSingleData['coupon_id'])}}" enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf

                    <input type="hidden" name="old_coupon_image" value="{{ $couponSingleData['coupon_image'] }}">
                    <input type="hidden" name="old_coupon_brand_image" value="{{ $couponSingleData['coupon_brand_image'] }}">
                    <input type="hidden" name="old_coupon_t_c" value="{{ $couponSingleData['coupon_t_c'] }}">
                    <input type="hidden" name="old_coupon_main_category" value="{{ $couponSingleData['coupon_main_category'] }}">
                    <input type="hidden" name="old_coupon_sub_category" value="{{ $couponSingleData['coupon_sub_category'] }}">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Main Category</label>
                            <div class="parsley-row">
                                <select class="md-input" name="coupon_main_category" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($blogCategoryMainData as $blogCategoryMainRow)
                                    <option value="{{ $blogCategoryMainRow['cat_main_id'] }}" >{{ $blogCategoryMainRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Sub Category</label>
                            <div class="parsley-row">
                                <select class="md-input" name="coupon_sub_category" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Status</label>
                            <div class="parsley-row">
                                <select class="md-input" name="coupon_status">
                                    <option value="">Choose..</option>
                                    <option value="{{STATUS_ACTIVE}}" @if($couponSingleData['coupon_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active</option>
                                    <option value="{{STATUS_INACTIVE}}"  @if($couponSingleData['coupon_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">End Date <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="date" name="coupon_end_date" value="{{ Carbon::createFromTimestampMs($couponSingleData['coupon_end_date_time'])->format('Y-m-d') }}" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">End Time <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="time" name="coupon_end_time" value="{{ Carbon::createFromTimestampMs($couponSingleData['coupon_end_date_time'])->format('H:i') }}" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Brand Name <span class="req" style="color: red">*</span></label>
                                <br>
                                <input type="text" name="coupon_brand_name" value="{{ $couponSingleData['coupon_brand_name'] }}" required class="md-input" />
                            </div>
                        </div>

                    </div>


                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Company Name <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_company_name" value="{{ $couponSingleData['coupon_company_name'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Title <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_title" value="{{ $couponSingleData['coupon_title'] }}" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Code <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_code"value="{{ $couponSingleData['coupon_code'] }}" required class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Contact Number <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_contact" value="{{ $couponSingleData['coupon_contact'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Country <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_country" value="{{ $couponSingleData['coupon_country'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">State <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_state" value="{{ $couponSingleData['coupon_state'] }}" required class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">City <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_city" value="{{ $couponSingleData['coupon_city'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Webiste <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_website" value="{{ $couponSingleData['coupon_website'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Location <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_location" value="{{ $couponSingleData['coupon_location'] }}" required class="md-input" />
                            </div>
                        </div>


                    </div>


                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <label for="blog_cat_desc">Product / Services <span class="req" style="color: red">*</span>
                                <span title="Add value in comma eg: value1,value2" class="menu_icon"><i class="material-icons">&#xE88F;</i></span>
                            </label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="coupon_product_services" cols="5" rows="5" required>{{ $couponSingleData['coupon_product_services'] }}</textarea>
                            </div>
                        </div>

                        <div class="uk-width-1-2">
                            <label for="blog_cat_desc">Brand Desciption <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="coupon_brand_detail" cols="5" rows="5" required>{{ $couponSingleData['coupon_brand_detail'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Coupon Desciption <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="coupon_description" cols="10" rows="8" required> {{ $couponSingleData['coupon_description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="coupon_meta_title">Meta Title</label>
                                <input type="text" name="coupon_meta_title" value="{{ $couponSingleData['coupon_meta_title'] }}" class="md-input"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="coupon_meta_keyword">Meta Keyword</label>
                                <input type="text" name="coupon_meta_keyword" value="{{ $couponSingleData['coupon_meta_keyword'] }}" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="coupon_meta_description">Meta Desciption</label>
                                <textarea class="md-input" name="coupon_meta_description" cols="10" rows="8">{{ $couponSingleData['coupon_meta_description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="coupon_brand_image">Coupon Image
                                <span title="Please upload jpg,jpge,png & 2 MB size file only" class="menu_icon"><i class="material-icons">&#xE88F;</i></span>
                                <a target="_blank" href="{{asset('custom-images/coupons/'.$couponSingleData['coupon_image'])}}">(View Image)</a>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="coupon_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="coupon_brand_image">Brand Image
                                <span title="Please upload jpg,jpge,png & 2 MB size file only" class="menu_icon"><i class="material-icons">&#xE88F;</i></span>
                                <a target="_blank" href="{{asset('custom-images/coupons/'.$couponSingleData['coupon_brand_image'])}}">(View Image)</a>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="coupon_brand_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="coupon_t_c">Coupon Terms & Condition
                                <span title="Please upload doc,docx & 2 MB size file only" class="menu_icon"><i class="material-icons">&#xE88F;</i></span>
                                <a target="_blank" href="{{asset('custom-images/coupons/'.$couponSingleData['coupon_t_c'])}}">(View Doc)</a>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="coupon_t_c"  onchange='single_attachment(this,{{ONLY_DOCUMENTS_FORMATES}},{{DOCUMENTS_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
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
    jQuery(document).ready(function(){
        jQuery('#catmain_id').change(function(){
            var catmain_id = jQuery(this).val()
            jQuery.ajax({
                url:'/admin/getBlogSubCategory',
                type:'POST',
                data:'catmain_id='+catmain_id+'&_token={{csrf_token()}}',
                success:function(result){
                    jQuery('#catsub_id').html(result)
                }
            });
        });
    });
</script>
@endsection
