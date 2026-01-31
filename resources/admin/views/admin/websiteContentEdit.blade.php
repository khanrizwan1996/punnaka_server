@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Website Content Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Website Content Details</h3>

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
                <form id="form_validation" method="POST" action="{{ url('/admin/websiteContentUpdate') }}"
                    enctype="multipart/form-data" class="uk-form-stacked">
                    <input type="hidden" name="old_wc_header_logo" value="{{ $getWebsiteContentData['wc_header_logo'] }}">
                    <input type="hidden" name="old_wc_footer_logo" value="{{ $getWebsiteContentData['wc_footer_logo'] }}">
                    @csrf

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="wc_contact_no">Contant No<span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="wc_contact_no"
                                    value="{{ $getWebsiteContentData['wc_contact_no'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="wc_email_address">Email Id<span class="req" style="color: red">*</span></label>
                                <input type="text" name="wc_email_address"
                                    value="{{ $getWebsiteContentData['wc_email_address'] }}" required class="md-input" />
                            </div>
                        </div>
                      <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="wc_whatsapp_link">Whatsapp No<span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="wc_whatsapp_link"
                                    value="{{ $getWebsiteContentData['wc_whatsapp_link'] }}" required class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="wc_fb_link">Facebook Link<span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="wc_fb_link" value="{{ $getWebsiteContentData['wc_fb_link'] }}"
                                    required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="wc_insta_link">Instagram Link<span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="wc_insta_link"
                                    value="{{ $getWebsiteContentData['wc_insta_link'] }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="wc_pinterest_link">Pinterest Link<span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="wc_pinterest_link"
                                    value="{{ $getWebsiteContentData['wc_pinterest_link'] }}" required class="md-input" />
                            </div>
                        </div>

                        </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="wc_quora_link">Quora Link<span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="wc_quora_link"
                                    value="{{ $getWebsiteContentData['wc_quora_link'] }}" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="wc_header_logo">Header Logo <a target="_blank"
                                    href="{{ url('custom-images/' . $getWebsiteContentData['wc_header_logo']) }}">(View
                                    Image)</a> </label>
                            <div class="parsley-row">
                                <input type="file" name="wc_header_logo"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="wc_footer_logo">Footer Logo <a target="_blank" href="{{ url('custom-images/' . $getWebsiteContentData['wc_footer_logo']) }}">(View
                                    Image)</a> </label>
                            <div class="parsley-row">
                                <input type="file" name="wc_footer_logo"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="wc_address">Address<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="wc_address" cols="10" rows="2"
                                    value="{{ $getWebsiteContentData['wc_address'] }}" required>{{ $getWebsiteContentData['wc_address'] }}</textarea>
                            </div>
                        </div>

                        <div class="uk-width-1-1">
                            <br>
                            <label for="wc_footer_content">Footer Content<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="wc_footer_content" cols="10" rows="6"
                                    value="{{ $getWebsiteContentData['wc_footer_content'] }}" required>{{ $getWebsiteContentData['wc_footer_content'] }}</textarea>
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
