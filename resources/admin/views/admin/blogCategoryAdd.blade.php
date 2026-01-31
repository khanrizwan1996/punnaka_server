@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('admin/blogCategoryList')}}">Blog List</a></li>
                <li><span>Blog Add </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Blog Details</h3>

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
                <form id="form_validation" method="POST" action="{{url('admin/blogCategoryStore')}}" enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_detail">Main Category<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="blog_cat_maincat" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($blogCategoryMainData as $blogCategoryMainRow)
                                    <option value="{{ $blogCategoryMainRow['cat_main_id'] }}" >{{ $blogCategoryMainRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_image">Sub Category<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="blog_cat_subcat" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="blog_detail">Blog Title<span class="req" style="color: red">*</span></label>
                                <input type="text" name="blog_cat_title" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="blog_detail">Country / Category <span class="req" style="color: red">*</span></label>
                                <input type="text" name="blog_cat_country" required class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="parsley-row">
                                <label for="blog_detail">State / Category <span class="req" style="color: red">*</span></label>
                                <input type="text" name="blog_cat_state" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_detail">City / Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="blog_cat_city" required class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_detail">Start Date <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="date" name="blog_cat_start_date" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_detail">Start Time <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="time" name="blog_cat_start_time" required class="md-input" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Desciption<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="blog_cat_desc" cols="10" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="blog_cat_meta_title">Meta Title</label>
                                <input type="text" name="blog_cat_meta_title" class="md-input"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="blog_cat_meta_keyword">Meta Keyword</label>
                                <input type="text" name="blog_cat_meta_keyword" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="blog_cat_meta_desc">Meta Desciption</label>
                                <textarea class="md-input" name="blog_cat_meta_desc" cols="10" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_cat_image">Image<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="file" name="blog_cat_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' required  class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-2">
                            <label for="blog_cat_subcat_image">Sub Category Image<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="file" name="blog_cat_subcat_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' required  class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="blog_cat_admin_comment">Admin Comment</label>
                                <textarea class="md-input" name="blog_cat_admin_comment" cols="10" rows="8"></textarea>
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