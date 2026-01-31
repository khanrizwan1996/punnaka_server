@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>

<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>


<script src="{{ asset('admin/assets/js/sample.js')}}"></script>
{{-- <script>
    // Initialize CKEditor with file upload support
 
</script> --}}

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('admin/blogCategoryList')}}">Blog Category List</a></li>
                <li><a href="{{url('admin/blogCategoryAdd')}}">Blog Add</a></li>
                <li><span>Blog Category Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Blog Details</h3>

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
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Main Category : <span style="color:#1976d2"> {{ $blogCategorySingleData['blog_cat_maincat'] }}</span></label>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Sub Category : <span style="color:#1976d2"> {{ $blogCategorySingleData['blog_cat_subcat'] }}</span></label>
                    </div>
                </div>
            </div>
        </div>
                <div class="md-card">
                    <div class="md-card-content large-padding">
                <form id="form_validation" method="POST" action="{{url('/admin/blogCategoryUpdate/'.$blogCategorySingleData['blog_cat_id']) }}" enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <input type="hidden" name="old_blog_cat_image" value="{{ $blogCategorySingleData['blog_cat_image'] }}">
                    <input type="hidden" name="old_blog_cat_subcat_image" value="{{ $blogCategorySingleData['blog_cat_subcat_image'] }}">
                    
                    <input type="hidden" name="old_blog_cat_maincat" value="{{ $blogCategorySingleData['blog_cat_maincat'] }}">
                    <input type="hidden" name="old_blog_cat_subcat" value="{{ $blogCategorySingleData['blog_cat_subcat'] }}">
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Main Category</label>
                            <div class="parsley-row">
                                <select class="md-input" name="blog_cat_maincat" id="catmain_id">
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
                                <select class="md-input" name="blog_cat_subcat" id="catsub_id">
                                    <option value="{{ $blogCategorySingleData['blog_cat_subcat'] }}">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Status</label>
                            <div class="parsley-row">
                                <select class="md-input" name="blog_cat_status">
                                    <option value="">Choose..</option>
                                    <option value="{{STATUS_ACTIVE}}" @if($blogCategorySingleData['blog_cat_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active</option>
                                    <option value="{{STATUS_INACTIVE}}"  @if($blogCategorySingleData['blog_cat_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Blog Title<span class="req" style="color: red">*</span></label>
                                <input type="text" name="blog_cat_title" value="{{ $blogCategorySingleData['blog_cat_title'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Country / Category <span class="req" style="color: red">*</span></label>
                                <input type="text" name="blog_cat_country" value="{{ $blogCategorySingleData['blog_cat_country'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">State / Category <span class="req" style="color: red">*</span></label>
                                <input type="text" name="blog_cat_state" value="{{ $blogCategorySingleData['blog_cat_state'] }}" required class="md-input" />
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">City / Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="blog_cat_city" value="{{ $blogCategorySingleData['blog_cat_city'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Start Date <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="date" name="blog_cat_start_date" value="{{ $blogCategorySingleData['blog_cat_start_date'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Start Time <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="time" name="blog_cat_start_time" value="{{ $blogCategorySingleData['blog_cat_start_time'] }}" required class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_cat_image">Image <a target="_blank" href="{{asset('custom-images/blog-cat-images/'.$blogCategorySingleData['blog_cat_image'])}}">(View Image)</a> </label>
                            <div class="parsley-row">
                                <input type="file" name="blog_cat_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_cat_subcat_image">Sub Category Image <a target="_blank" href="{{asset('custom-images/blog-cat-images/'.$blogCategorySingleData['blog_cat_subcat_image'])}}">(View Image)</a></label>
                            <div class="parsley-row">
                                <input type="file" name="blog_cat_subcat_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Desciption<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="blog_cat_desc" cols="10" rows="8" value="{{ $blogCategorySingleData['blog_cat_desc'] }}" required>{{ $blogCategorySingleData['blog_cat_desc'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="blog_cat_meta_title">Meta Title</label>
                                <input type="text" name="blog_cat_meta_title" value="{{ $blogCategorySingleData['blog_cat_meta_title'] }}" class="md-input"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="blog_cat_meta_keyword">Meta Keyword</label>
                                <input type="text" value="{{ $blogCategorySingleData['blog_cat_meta_keyword'] }}" name="blog_cat_meta_keyword" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="blog_cat_meta_desc">Meta Desciption</label>
                                <textarea class="md-input" value="{{ $blogCategorySingleData['blog_cat_title'] }}" name="blog_cat_meta_desc" cols="10" rows="8">{{ $blogCategorySingleData['blog_cat_meta_desc'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="blog_cat_admin_comment">Admin Comment</label>
                                <textarea class="md-input" name="blog_cat_admin_comment" cols="10" rows="8">{{ $blogCategorySingleData['blog_cat_admin_comment'] }}</textarea>
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

    // Default CKEditor sample.js initialization (no upload plugins)
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
