@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('admin/couponList/'.STATUS_ACTIVE)}}">Coupon Active List</a></li>
                <li><a href="{{url('admin/couponList/'.STATUS_INACTIVE)}}">Coupon In Active List</a></li>
                <li><span>Coupon Add </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Coupon Details</h3>

        @if(session('message'))
            @if(session('message') == MSG_ADD_SUCCESS)
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

        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="md-card">
            <div class="md-card-content large-padding">
                <form id="form_validation" method="POST" action="{{url('admin/couponStore')}}" enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label for="blog_detail">Main Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="coupon_main_category" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($blogCategoryMainData as $blogCategoryMainRow)
                                    <option value="{{ $blogCategoryMainRow['cat_main_id'] }}" >{{ $blogCategoryMainRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label for="blog_image">Sub Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="coupon_sub_category" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label for="blog_detail">End Date <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="date" name="coupon_end_date" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label for="blog_detail">End Time <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="time" name="coupon_end_time" required class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Brand Name <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_brand_name" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Company Name <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_company_name" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Title <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_title" required class="md-input" />
                            </div>
                        </div>
                    </div>


                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Code <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_code" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Contact Number <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_contact" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Country <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_country" required class="md-input" />
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">State <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_state" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">City <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_city" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Webiste <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_website" required class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="blog_detail">Coupon Location <span class="req" style="color: red">*</span></label>
                                <input type="text" name="coupon_location" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="blog_cat_desc">Product / Services <span class="req" style="color: red">*</span>
                                </label>
                                <span title="Add value in comma eg: value1,value2" class="menu_icon"><i class="material-icons">&#xE88F;</i></span>
                                <input type="text" name="coupon_product_services" required class="md-input" />
                            </div>
                        </div>
                    </div>


                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Brand Desciption <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="coupon_brand_detail" cols="5" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Coupon Desciption <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="coupon_description" cols="10" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="coupon_meta_title">Meta Title</label>
                                <input type="text" name="coupon_meta_title" class="md-input"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="coupon_meta_keyword">Meta Keyword</label>
                                <input type="text" name="coupon_meta_keyword" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="coupon_meta_description">Meta Desciption</label>
                                <textarea class="md-input" name="coupon_meta_description" cols="10" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="coupon_image">Coupon Image <span class="req" style="color: red">*</span>
                                <span title="Please upload jpg,jpge,png & 2 MB size file only" class="menu_icon"><i class="material-icons">&#xE88F;</i></span></label>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="coupon_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' required  class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_cat_subcat_image">Brand Image <span class="req" style="color: red">*</span>
                                <span title="Please upload jpg,jpge,png & 2 MB size file only" class="menu_icon"><i class="material-icons">&#xE88F;</i></span></label>
                            <div class="parsley-row">
                                <input type="file" name="coupon_brand_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' required  class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_cat_subcat_image">Coupon Terms & Condition <span class="req" style="color: red">*</span>
                                <span title="Please upload doc,docx & 2 MB size file only" class="menu_icon"><i class="material-icons">&#xE88F;</i></span></label>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="coupon_t_c"  onchange='single_attachment(this,{{ONLY_DOCUMENTS_FORMATES}},{{DOCUMENTS_SIZE}})' required  class="md-btn md-btn-primary md-input" />
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
