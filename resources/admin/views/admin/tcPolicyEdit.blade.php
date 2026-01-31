@extends('admin.layouts.main')
@section('main-container')
@php
    $type = Route::input('type');
    if($type == 'tc'){
        $title = "Terms and Conditions";
        $columnName = "wc_term_condition";
        $value = $getWebsiteContentData['wc_term_condition'];
    }elseif($type == 'pp'){
        $title = "Privacy Policy";
        $columnName = "wc_privacy_policy";
        $value = $getWebsiteContentData['wc_privacy_policy'];
    }
    
@endphp
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>{{ $title }} Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> {{ $title }} Details</h3>

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
                <form id="form_validation" method="POST" action="{{ url('/admin/websiteContentTCAndPPUpdate') }}" enctype="multipart/form-data" class="uk-form-stacked">
                    <input type="hidden" name="type" value="{{ $type }}">
                    @csrf

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="wc_address">{{ $title }}<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="{{$columnName}}" cols="10" rows="2" value="{{ $value }}" required>{{ $value }}</textarea>
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
<script> initSample(); </script>
@endsection