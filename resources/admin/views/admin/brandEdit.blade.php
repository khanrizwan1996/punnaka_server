@extends('admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/brandList') }}">Brand List</a></li>
                <li><a href="{{ url('admin/brandAdd') }}">Brand Add</a></li>
                <li><span>Brand Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Brand Details</h3>

        @if (session('message'))
            @if (session('message') == MSG_UPDATE_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Updated Successfully!..</p>
                </div>
            @elseif (session('message') == MSG_IMAGES_ADD)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Images Added Successfully!..</p>
                </div>
            @elseif(session('message') == MSG_IMAGES_ERROR)
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In Images Upload!..</p>
                </div>
            @elseif(session('message') == MSG_DELETE_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Deleted Successfully!..</p>
                </div>
            @elseif(session('message') == MSG_DELETE_ERROR)
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error in Delete!..</p>
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
                <form id="form_validation" method="POST"
                    action="{{ url('admin/brandUpdate/' . $brandSingleData['brand_id']) }}" enctype="multipart/form-data"
                    class="uk-form-stacked">
                    @csrf
                    <input type="hidden" name="old_brand_logo" value="{{ $brandSingleData['brand_logo'] }}">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <select class="md-input" name="brand_mall_id">
                                    <option value="">Select Mall</option>
                                    @foreach ($allActiveMallData as $allActiveMallRow)
                                        <option value="{{ $allActiveMallRow['mall_id'] }}"
                                            @if ($brandSingleData['brand_mall_id'] == $allActiveMallRow['mall_id']) style="color: red" selected @endif>
                                            {{ "(".$allActiveMallRow['mall_city'].") - ".$allActiveMallRow['mall_name'] }}</option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_name">Brand Name <span class="req" style="color: red">*</span></label>
                                <input type="text" name="brand_name" class="md-input" required
                                    value="{{ $brandSingleData['brand_name'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_contact_no">Contact No <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_contact_no" class="md-input" required
                                    value="{{ $brandSingleData['brand_contact_no'] }}" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_email">Email Id <span class="req" style="color: red">*</span></label>
                                <input type="text" name="brand_email" class="md-input" required
                                    value="{{ $brandSingleData['brand_email'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_main_cat">Main Category <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_main_cat" class="md-input" required
                                    value="{{ $brandSingleData['brand_main_cat'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_sub_cat">Sub Category <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_sub_cat" class="md-input" required
                                    value="{{ $brandSingleData['brand_sub_cat'] }}" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_prodct_services">Product/Service <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_prodct_services" class="md-input" required
                                    value="{{ $brandSingleData['brand_prodct_services'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_store_type">Store Type <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_store_type" class="md-input" required
                                    value="{{ $brandSingleData['brand_store_type'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_floor">Floor <span class="req" style="color: red">*</span></label>
                                <input type="text" name="brand_floor" class="md-input" required
                                    value="{{ $brandSingleData['brand_floor'] }}" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_area">Area <span class="req" style="color: red">*</span></label>
                                <input type="text" name="brand_area" class="md-input" required
                                    value="{{ $brandSingleData['brand_area'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_location">Location <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_location" class="md-input" required
                                    value="{{ $brandSingleData['brand_location'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_city">City <span class="req" style="color: red">*</span></label>
                                <input type="text" name="brand_city" class="md-input" required
                                    value="{{ $brandSingleData['brand_city'] }}" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_store_timings">Store Timings <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_store_timings" class="md-input" required
                                    value="{{ $brandSingleData['brand_store_timings'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_store_weekend_timings">Store Weekend Timings <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_store_weekend_timings" class="md-input" required
                                    value="{{ $brandSingleData['brand_store_weekend_timings'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="brand_store_weekday_timings">Store Weekday Timings <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="brand_store_weekday_timings" class="md-input" required
                                    value="{{ $brandSingleData['brand_store_weekday_timings'] }}" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="brand_desc">Desciption <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="brand_desc" required cols="10" rows="8">{{ $brandSingleData['brand_desc'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="brand_meta_title">Meta Title</label>
                                <input type="text" name="brand_meta_title" class="md-input"
                                    value="{{ $brandSingleData['brand_meta_title'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="brand_meta_keyword">Meta Keyword</label>
                                <input type="text" name="brand_meta_keyword" class="md-input"
                                    value="{{ $brandSingleData['brand_meta_keyword'] }}" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="brand_meta_description">Meta Desciption</label>
                                <textarea class="md-input" name="brand_meta_description" cols="10" rows="8">{{ $brandSingleData['brand_meta_description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-medium-1-3">
                            <label for="brand_logo">Brand Logo (<a
                                    href="{{ url('custom-images/brand/' . $brandSingleData['brand_logo']) }}"
                                    target="_blank">View Image</a>)</label>
                            <div class="parsley-row">
                                <input type="file" name="brand_logo"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Status</label>
                            <div class="parsley-row">
                                <select class="md-input" name="brand_status">
                                    <option value="">Choose..</option>
                                    <option value="{{ STATUS_ACTIVE }}"
                                        @if ($brandSingleData['brand_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active
                                    </option>
                                    <option value="{{ STATUS_INACTIVE }}"
                                        @if ($brandSingleData['brand_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active
                                    </option>
                                </select>
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

        <div class="md-card">
            <div class="md-card-content large-padding">
                <h3 class="heading_b uk-margin-bottom" style="font-size: 17px; color: black; font-weight: 500;"> Brand
                    Images <span style="color: red">*</span> ( Upload Multiple images)</h3>
                <form id="form_validation" method="POST"
                    action="{{ url('/admin/brandImagesStore/' . Route::input('id')) }}" class="uk-form-stacked"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <input type="file" name="brand_img_path[]" class="md-btn md-btn-primary" required multiple>
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                        </div>

                    </div>
                </form>

                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover" cellspacing="0" width="100%">
                        <br>
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Image</th>
                                <th>Added Date & Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($singlebrandImagesData as $singlebrandImagesRow)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ url('custom-images/brand-multiple-images/' . $singlebrandImagesRow['brand_img_path']) }}"
                                            target="_blank">{{ $singlebrandImagesRow['brand_img_path'] }}</a></td>
                                    <td>
                                        @if (!empty($singlebrandImagesRow['brand_img_added_time']))
                                            {{ date('j F Y h:i:s', strtotime($singlebrandImagesRow['brand_img_added_time'])) }}
                                        @endif
                                    </td>
                                    <td><a
                                            href="{{ url('admin/brandImagesDelete/' . $singlebrandImagesRow['brand_img_id'] . '/' . $singlebrandImagesRow['brand_img_brand_id'] . '/' . $singlebrandImagesRow['brand_img_path']) }}">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>
        initSample();
    </script>
@endsection
