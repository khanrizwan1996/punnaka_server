@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('admin/offerList/'.STATUS_ACTIVE)}}">Offer Active List</a></li>
                <li><a href="{{url('admin/offerList/'.STATUS_INACTIVE)}}">Offer In Active List</a></li>
                <li><span>Offer Add </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Offer Details</h3>

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
                <form id="form_validation" method="POST" action="{{url('admin/offerStore')}}" enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label for="offer_main_category">Main Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="offer_main_category" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($blogCategoryMainData as $blogCategoryMainRow)
                                    <option value="{{ $blogCategoryMainRow['cat_main_id'] }}" >{{ $blogCategoryMainRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label for="offer_sub_category">Sub Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="offer_sub_category" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label for="offer_mall_id">Mall <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="offer_mall_id" id="mall_id">
                                    <option value="">Select</option>
                                    @foreach ($mallData as $mallRow)
                                    <option value="{{ $mallRow['mall_id'] }}" >{{ "(".$mallRow['mall_city'].") - ".$mallRow['mall_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label for="offer_brand_id">Brand <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required name="offer_brand_id" id="brand_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <div class="parsley-row">
                                <label for="offer_title">Offer Title <span class="req" style="color: red">*</span></label>
                                <input type="text" name="offer_title" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <div class="parsley-row">
                                <label for="offer_country">Country <span class="req" style="color: red">*</span></label>
                                <input type="text" name="offer_country" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <div class="parsley-row">
                                <label for="offer_state">State <span class="req" style="color: red">*</span></label>
                                <input type="text" name="offer_state" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <div class="parsley-row">
                                <label for="offer_city">City <span class="req" style="color: red">*</span></label>
                                <input type="text" name="offer_city" required class="md-input" />
                            </div>
                        </div>

                    </div>

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-4">
                                <label for="offer_start_date">Start Date <span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <input type="date" name="offer_start_date" required class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-4">
                                <label for="offer_start_time">Start Time <span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <input type="time" name="offer_start_time" required class="md-input" />
                                </div>
                            </div>

                            <div class="uk-width-medium-1-4">
                                <label for="offer_end_date">End Date <span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <input type="date" name="offer_end_date" required class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-4">
                                <label for="offer_end_time">End Time <span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <input type="time" name="offer_end_time" required class="md-input" />
                                </div>
                            </div>
                        </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="offer_detail">Offer Desciption <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="offer_detail" cols="10" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="offer_meta_title">Meta Title</label>
                                <input type="text" name="offer_meta_title" class="md-input"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="offer_meta_keyword">Meta Keyword</label>
                                <input type="text" name="offer_meta_keyword" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="offer_meta_description">Meta Desciption</label>
                                <textarea class="md-input" name="offer_meta_description" cols="10" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="offer_image">Offer Image <span class="req" style="color: red">*</span>
                                <span title="Please upload jpg,jpge,png & 2 MB size file only" class="menu_icon"><i class="material-icons">&#xE88F;</i></span></label>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="offer_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' required  class="md-btn md-btn-primary md-input" />
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


        jQuery('#mall_id').change(function(){
            var mall_id = jQuery(this).val()
            jQuery.ajax({
                url:'/admin/getmallBrands',
                type:'POST',
                data:'mall_id='+mall_id+'&_token={{csrf_token()}}',
                success:function(result){
                    jQuery('#brand_id').html(result)
                }
            });
        });



    });
</script>
@endsection

