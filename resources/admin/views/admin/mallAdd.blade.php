@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

        <div id="page_content_inner">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{url('admin/mallList')}}">Mall List</a></li>
                    <li><span>Mall Add </span></li>
                </ul>
            </div>
            <h3 class="heading_b uk-margin-bottom"> Mall Details</h3>

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
                    <form id="form_validation" method="POST" action="{{url('admin/mallStore')}}" enctype="multipart/form-data" class="uk-form-stacked">
                        @csrf
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_name">Mall Name <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_name"  class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_contact_no">Contact No <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_contact_no"  class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_email">Email Id <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_email"  class="md-input" />
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_location">Location <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_location"  class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_city">City <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_city"  class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_opening_date">Opening Date <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_opening_date"  class="md-input" />
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_timing">Mall Timing <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_timing"  class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_store_timing">Store Timing <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_store_timing"  class="md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="mall_website_link">Website Link <span class="req" style="color: red">*</span></label>
                                    <input type="text" name="mall_website_link"  class="md-input" />
                                </div>
                            </div>
                        </div>
                       

                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <label for="mall_desc">Desciption <span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <textarea class="md-input" id="editor" name="mall_desc" cols="10" rows="8" ></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row uk-margin-top">
                                    <label for="mall_meta_title">Meta Title</label>
                                    <input type="text" name="mall_meta_title" class="md-input"/>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row uk-margin-top">
                                    <label for="mall_meta_keyword">Meta Desciption</label>
                                    <input type="text" name="mall_meta_keyword" class="md-input" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <div class="parsley-row">
                                    <label for="mall_meta_description">Meta Desciption</label>
                                    <textarea class="md-input" name="mall_meta_description" cols="10" rows="8"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid">
                            <div class="uk-width-medium-1-3">
                                <label for="mall_logo">Mall Logo <span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <input type="file" name="mall_logo" onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})'   class="md-btn md-btn-primary md-input" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <label for="mall_img_path">Mall Multiple <span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <input type="file" name="mall_img_path[]" multiple onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})'   class="md-btn md-btn-primary md-input" />
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
            </script>
@endsection
