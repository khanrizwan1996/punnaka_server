@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><span>About Us Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> About Us Details</h3>

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
                <form id="form_validation" method="POST" action="{{url('/admin/aboutUsUpdate')}}" enctype="multipart/form-data" class="uk-form-stacked">
                    <input type="hidden" name="old_about_us_image" value="{{$aboutUsData['about_us_image']}}">
                    @csrf

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="about_us_title">About Us Title<span class="req" style="color: red">*</span></label>
                                <input type="text" name="about_us_title" value="{{ $aboutUsData['about_us_title'] }}" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="about_us_image">Image <a target="_blank" href="{{asset('custom-images/'.$aboutUsData['about_us_image'])}}">(View Image)</a> </label>
                            <div class="parsley-row">
                                <input type="file" name="about_us_image"  onchange='single_attachment(this,{{JPG_PNG_FORMATES}},{{IMAGE_SIZE}})' class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="about_us_desc">Desciption<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="about_us_desc" cols="10" rows="8" value="{{ $aboutUsData['about_us_desc'] }}" required>{{ $aboutUsData['about_us_desc'] }}</textarea>
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
