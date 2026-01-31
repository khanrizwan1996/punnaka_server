@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('admin/pressReleaseList')}}">Press Release List</a></li>
                <li><span>Press Release Add </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Press Release Details</h3>

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
                <form id="form_validation" method="POST" action="{{url('admin/pressReleaseStore')}}" enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_main_cat">Main Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="pr_main_cat" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($blogCategoryMainData as $blogCategoryMainRow)
                                    <option value="{{ $blogCategoryMainRow->cat_main_id }}" >{{ $blogCategoryMainRow->cat_main_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_sub_cat">Sub Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="pr_sub_cat" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_title">Title <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_title" required class="md-input" />
                            </div>
                        </div>

                        

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        
                        <div class="uk-width-medium-1-3">
                            <label for="pr_title1">Content Title <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_title1" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_country">Country</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_country" class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_state">State</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_state" class="md-input" />
                            </div>
                        </div>
                        
                    </div>

                   
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_city">City</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_city" class="md-input" />
                            </div>
                        </div>


                        <div class="uk-width-medium-1-3">
                            <label for="pr_content_location">Content Location <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_content_location" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_publisher">Publisher <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_publisher" required class="md-input" />
                            </div>
                        </div>

                        
                    </div>
                   
                   
                    <div class="uk-grid" data-uk-grid-margin>

                         <div class="uk-width-medium-1-3">
                            <label for="pr_author">Author <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_author" required class="md-input" />
                            </div>
                        </div>

                        
                        <div class="uk-width-medium-1-3">
                            <label for="pr_publish_date_time">Publish Date & Time <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="datetime-local" name="pr_publish_date_time" required class="md-input" required />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_modified_date_time">Modified Date & Time </label>
                            <div class="parsley-row">
                                <input type="datetime-local" name="pr_modified_date_time" class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_video_embedded">Video Embedded</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_video_embedded" class="md-input" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="pr_desc">Desciption<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="pr_desc" cols="10" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="pr_meta_title">Meta Title</label>
                                <input type="text" name="pr_meta_title" class="md-input"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="pr_meta_keyword">Meta Keyword</label>
                                <input type="text" name="pr_meta_keyword" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="pr_meta_desc">Meta Desciption</label>
                                <textarea class="md-input" name="pr_meta_desc" cols="10" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_logo">Logo</label>
                            <div class="parsley-row">
                                <input type="file" name="pr_logo"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pri_path">Multiple Images</label>
                            <div class="parsley-row">
                                <input type="file" name="pri_path[]" multiple onchange='multiple_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_attachment">PDF Attachment</label>
                            <div class="parsley-row">
                                <input type="file" name="pr_attachment"  onchange='single_attachment(this,{{ONLY_PDF_FORMATES}},{{PDF_SIZE}})'  class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="pr_admin_comment">Admin Comment</label>
                                <textarea class="md-input" name="pr_admin_comment" cols="10" rows="8"></textarea>
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