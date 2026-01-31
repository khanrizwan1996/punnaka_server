@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

        <div id="page_content_inner">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{url('admin/blogCategoryMainList')}}">Blog Main Category List</a></li>
                    <li><a href="{{url('admin/blogCategorySubList')}}">Blog Sub Category List</a></li>
                    <li><span>Blog Category Edit </span></li>
                </ul>
            </div>
            <h3 class="heading_b uk-margin-bottom"> Update Details</h3>

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
                    <form id="form_validation" method="POST" action="{{url('/admin/blogSubCategoryUpdate/'.$blogCategorySubSingleData['cat_sub_id']) }}" enctype="multipart/form-data" class="uk-form-stacked">
                        @csrf
                        <input type="hidden" name="old_cat_sub_image" value="{{$blogCategorySubSingleData['cat_sub_image']}}">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <select class="md-input" name="cat_sub_main_id">
                                        <option value="{{$blogCategorySubSingleData['cat_sub_main_id']}}">Select Main Category</option>
                                        @foreach ($blogCategoryMainData as $blogCategoryMainRow)

                                        <option value="{{ $blogCategoryMainRow['cat_main_id'] }}" @if($blogCategoryMainRow['cat_main_id'] == $blogCategorySubSingleData['cat_sub_main_id']) selected style="color:green" @endif >{{ $blogCategoryMainRow['cat_main_name'] }}</option>

                                        @endforeach
                                    </select>
                                    </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="login_username">Sub Category Name <span class="req" style="color: red">*</span></label>
                                    <input class="md-input" type="text" id="cat_sub_name" value="{{$blogCategorySubSingleData['cat_sub_name']}}" required name="cat_sub_name" />
                                    </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <select class="md-input" name="cat_sub_status">
                                        <option value="">Choose..</option>
                                        <option value="{{STATUS_ACTIVE}}" @if($blogCategorySubSingleData['cat_sub_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active</option>
                                        <option value="{{STATUS_INACTIVE}}"  @if($blogCategorySubSingleData['cat_sub_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <label for="login_username">Sub Categor Image  <a target="_blank" href="{{asset('custom-images/blog-cat-images/'.$blogCategorySubSingleData['cat_sub_image'])}}">(View Image)</a></label>
                                <div class="parsley-row">
                                    <input type="file" name="cat_sub_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                                </div>
                            </div>

                            <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <br>
                                    &emsp;&emsp;<button type="submit" class="md-btn md-btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            initSample();
            </script>
@endsection
