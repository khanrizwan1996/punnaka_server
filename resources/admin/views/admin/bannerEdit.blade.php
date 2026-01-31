@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/bannerList') }}">Banner List</a></li>
                <li><span>Banner Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Banner Details</h3>
        @if (session('message'))
            @if (session('message') == MSG_UPDATE_SUCCESS)
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
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="md-card">
            <div class="md-card-content large-padding">
                <form id="form_validation" method="POST" action="{{url('/admin/bannerUpdate/'.$bannerSingleData['banner_id']) }}"
                    enctype="multipart/form-data" class="uk-form-stacked">
                    <input type="hidden" name="old_banner_image" value="{{ $bannerSingleData['banner_image'] }}">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Title</label>
                                <input type="text" name="banner_title" value="{{ $bannerSingleData['banner_title']}}" class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="banner_image">Image <a target="_blank"
                                    href="{{ url('custom-images/banner/' . $bannerSingleData['banner_image']) }}">(View
                                    Image)</a> </label>
                            <div class="parsley-row">
                                <input type="file" name="banner_image"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Status</label>
                            <div class="parsley-row">
                                <select class="md-input" name="banner_status">
                                    <option value="">Choose..</option>
                                    <option value="{{ STATUS_ACTIVE }}"
                                        @if ($bannerSingleData['banner_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active
                                    </option>
                                    <option value="{{ STATUS_INACTIVE }}"
                                        @if ($bannerSingleData['banner_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row">
                                <label for="blog_detail">Short Description</label>
                                <input type="text" name="banner_short_desc" value="{{ $bannerSingleData['banner_short_desc']}}" class="md-input" />
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
@endsection
