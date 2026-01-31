@extends('admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/mallList') }}">Mall List</a></li>
                <li><span>Mall Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Mall Details</h3>


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
                <form id="form_validation" method="POST" action="{{ url('admin/mallUpdate/' . $mallSingleData['mall_id']) }}"
                    enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <input type="hidden" name="old_mall_logo" value="{{ $mallSingleData['mall_logo'] }}">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_name">Mall Name <span class="req" style="color: red">*</span></label>
                                <input type="text" name="mall_name" value="{{ $mallSingleData['mall_name'] }}"
                                    class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_contact_no">Contact No <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="mall_contact_no"
                                    value="{{ $mallSingleData['mall_contact_no'] }}" class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_email">Email Id <span class="req" style="color: red">*</span></label>
                                <input type="text" name="mall_email" value="{{ $mallSingleData['mall_email'] }}"
                                    class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_location">Location <span class="req" style="color: red">*</span></label>
                                <input type="text" name="mall_location" value="{{ $mallSingleData['mall_location'] }}"
                                    class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_city">City <span class="req" style="color: red">*</span></label>
                                <input type="text" name="mall_city" value="{{ $mallSingleData['mall_city'] }}"
                                    class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_opening_date">Opening Date <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="mall_opening_date"
                                    value="{{ $mallSingleData['mall_opening_date'] }}" class="md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_timing">Mall Timing <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="mall_timing" value="{{ $mallSingleData['mall_timing'] }}"
                                    class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_store_timing">Store Timing <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="mall_store_timing"
                                    value="{{ $mallSingleData['mall_store_timing'] }}" class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="mall_website_link">Website Link <span class="req"
                                        style="color: red">*</span></label>
                                <input type="text" name="mall_website_link"
                                    value="{{ $mallSingleData['mall_website_link'] }}" class="md-input" />
                            </div>
                        </div>
                    </div>


                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="mall_desc">Desciption <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="mall_desc" cols="10" rows="8">{{ $mallSingleData['mall_desc'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="mall_meta_title">Meta Title</label>
                                <input type="text" name="mall_meta_title"
                                    value="{{ $mallSingleData['mall_meta_title'] }}" class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="mall_meta_keyword">Meta Desciption</label>
                                <input type="text" name="mall_meta_keyword"
                                    value="{{ $mallSingleData['mall_meta_keyword'] }}" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="mall_meta_description">Meta Desciption</label>
                                <textarea class="md-input" name="mall_meta_description" cols="10" rows="8">{{ $mallSingleData['mall_meta_description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-medium-1-3">
                            <label for="mall_logo">Mall Logo (<a
                                    href="{{ url('custom-images/mall/' . $mallSingleData['mall_logo']) }}"
                                    target="_blank">View Image</a>)</label>
                            <div class="parsley-row">
                                <input type="file" name="mall_logo"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Status</label>
                            <div class="parsley-row">
                                <select class="md-input" name="mall_status">
                                    <option value="">Choose..</option>
                                    <option value="{{ STATUS_ACTIVE }}"
                                        @if ($mallSingleData['mall_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active
                                    </option>
                                    <option value="{{ STATUS_INACTIVE }}"
                                        @if ($mallSingleData['mall_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active
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
                <h3 class="heading_b uk-margin-bottom" style="font-size: 17px; color: black; font-weight: 500;"> Mall
                    Images <span style="color: red">*</span> ( Upload Multiple images)</h3>
                <form id="form_validation" method="POST"
                    action="{{ url('/admin/mallImagesStore/' . Route::input('id')) }}" class="uk-form-stacked"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <input type="file" name="mall_img_path[]" class="md-btn md-btn-primary" required multiple>
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
                            @foreach ($singleMallImagesData as $singleMallImagesRow)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ url('custom-images/mall-multiple-images/' . $singleMallImagesRow['mall_img_path']) }}"
                                            target="_blank">{{ $singleMallImagesRow['mall_img_path'] }}</a></td>
                                    <td>
                                        @if (!empty($singleMallImagesRow['mall_img_added_time']))
                                            {{ date('j F Y h:i:s', strtotime($singleMallImagesRow['mall_img_added_time'])) }}
                                        @endif
                                    </td>
                                    <td><a
                                            href="{{ url('admin/mallImagesDelete/' . $singleMallImagesRow['mall_img_id'] . '/' . $singleMallImagesRow['mall_img_mall_id'] . '/' . $singleMallImagesRow['mall_img_path']) }}">Remove</a>
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
