@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

        <div id="page_content_inner">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{url('admin/blogList')}}">Shopping Blogs List</a></li>
                    <li><a href="{{url('admin/blogAdd')}}">Shopping Blog Add</a></li>
                    <li><span>Shopping Blog Edit </span></li>
                </ul>
            </div>
            <h3 class="heading_b uk-margin-bottom"> Shopping Blog Details</h3>

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
                    <form id="form_validation" method="POST" action="{{url('/admin/blogUpdate/'.$blogData['blog_id']) }}" enctype="multipart/form-data" class="uk-form-stacked">
                        @csrf
                        <input type="hidden" name="old_blog_image" value="{{$blogData['blog_image']}}">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="blog_detail">Blog Title<span class="req" style="color: red">*</span></label>
                                    <input type="text" name="blog_title" value="{{$blogData['blog_title']}}" required class="md-input" />
                                </div>
                            </div>

                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <select class="md-input" name="blog_status">
                                        <option value="">Choose..</option>
                                        <option value="{{STATUS_ACTIVE}}" @if($blogData['blog_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active</option>
                                        <option value="{{STATUS_INACTIVE}}"  @if($blogData['blog_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-3">
                                <label for="blog_image">Image <a target="_blank" href="{{asset('custom-images/blogs/'.$blogData['blog_image'])}}">(View Image)</a></label>
                                <div class="parsley-row">
                                    <input type="file" name="blog_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <label for="blog_detail">Desciption<span class="req" style="color: red">*</span></label>
                                <div class="parsley-row">
                                    <textarea class="md-input" id="editor" name="blog_detail" cols="10" rows="8" required>{{$blogData['blog_detail']}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row uk-margin-top">
                                    <label for="blog_meta_title">Meta Title</label>
                                    <input type="text" name="blog_meta_title" class="md-input" value="{{$blogData['blog_meta_title']}}"/>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row uk-margin-top">
                                    <label for="blog_meta_keword">Meta Desciption</label>
                                    <input type="text" name="blog_meta_keword" class="md-input" value="{{$blogData['blog_meta_keword']}}" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <div class="parsley-row">
                                    <label for="blog_meta_description">Meta Desciption</label>
                                    <textarea class="md-input" name="blog_meta_description" cols="10" rows="8">{{$blogData['blog_meta_description']}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="blog_cat_admin_comment">Admin Comment</label>
                                <textarea class="md-input" name="blog_admin_comment" cols="10" rows="8">{{ $blogData['blog_admin_comment']}}</textarea>
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
