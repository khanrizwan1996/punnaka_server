@extends('admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/pressReleaseList') }}">Press Release List</a></li>
                <li><a href="{{ url('admin/pressReleaseAdd') }}">Press Release Add</a></li>
                <li><span>Press Release Edit</span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Press Release Details</h3>

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
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Main Category : <span
                                style="color:#1976d2"> {{ $pressReleaseData->pr_main_cat }}</span></label>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Sub Category : <span
                                style="color:#1976d2"> {{ $pressReleaseData->pr_sub_cat }}</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="md-card">
            <div class="md-card-content large-padding">
                <form id="form_validation" method="POST" action="{{ url('admin/pressReleaseUpdate') }}"
                    enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf

                    <input type="hidden" name="pr_id" value="{{ $pressReleaseData->pr_id }}">
                    <input type="hidden" name="old_pr_logo" value="{{ $pressReleaseData->pr_logo }}">
                    <input type="hidden" name="old_pr_attachment" value="{{ $pressReleaseData->pr_attachment }}">

                    <input type="hidden" name="old_pr_main_cat" value="{{ $pressReleaseData->pr_main_cat }}">
                    <input type="hidden" name="old_pr_sub_cat" value="{{ $pressReleaseData->pr_sub_cat }}">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_main_cat">Main Category</label>
                            <div class="parsley-row">
                                <select class="md-input" name="pr_main_cat" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($blogCategoryMainData as $blogCategoryMainRow)
                                        <option value="{{ $blogCategoryMainRow->cat_main_id }}">
                                            {{ $blogCategoryMainRow->cat_main_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_sub_cat">Sub Category </label>
                            <div class="parsley-row">
                                <select class="md-input" name="pr_sub_cat" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Status</label>
                            <div class="parsley-row">
                                <select class="md-input" name="pr_status">
                                    <option value="">Choose..</option>
                                    <option value="{{ STATUS_ACTIVE }}"
                                        @if ($pressReleaseData->pr_status == STATUS_ACTIVE) selected style="color:green" @endif>Active
                                    </option>
                                    <option value="{{ STATUS_INACTIVE }}"
                                        @if ($pressReleaseData->pr_status == STATUS_INACTIVE) selected style="color:red" @endif>In Active
                                    </option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_title">URL Title / Slug <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_title" value="{{ $pressReleaseData->pr_title }}" required
                                    class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_title1">Content Title <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_title1" value="{{ $pressReleaseData->pr_title1 }}" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_country">Country</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_country" value="{{ $pressReleaseData->pr_country }}" class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_state">State</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_state" value="{{ $pressReleaseData->pr_state }}"  class="md-input" />
                            </div>
                        </div>

                    </div>


                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_city">City</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_city" value="{{ $pressReleaseData->pr_city }}"  class="md-input" />
                            </div>
                        </div>


                        <div class="uk-width-medium-1-3">
                            <label for="pr_content_location">Content Location <span class="req"
                                    style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_content_location"
                                    value="{{ $pressReleaseData->pr_content_location }}" required class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_publisher">Publisher <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_publisher" value="{{ $pressReleaseData->pr_publisher }}"
                                    required class="md-input" />
                            </div>
                        </div>



                    </div>


                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_author">Author <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="pr_author" value="{{ $pressReleaseData->pr_author }}"
                                    required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_publish_date_time">Publish Date & Time <span class="req"
                                    style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="datetime-local" name="pr_publish_date_time"
                                    value="{{ $pressReleaseData->pr_publish_date_time }}" required class="md-input"
                                    required />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_modified_date_time">Modified Date & Time </label>
                            <div class="parsley-row">
                                <input type="datetime-local" name="pr_modified_date_time"
                                    value="{{ $pressReleaseData->pr_modified_date_time }}" class="md-input" />
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_video_embedded">Video Embedded</label>
                            <div class="parsley-row">
                                <input type="text" name="pr_video_embedded"
                                    value="{{ $pressReleaseData->pr_video_embedded }}" class="md-input" />
                            </div>
                        </div>


                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="pr_desc">Desciption<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="pr_desc" cols="10" rows="8" required>{{ $pressReleaseData->pr_desc }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="pr_meta_title">Meta Title</label>
                                <input type="text" name="pr_meta_title"
                                    value="{{ $pressReleaseData->pr_meta_title }}" class="md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="pr_meta_keyword">Meta Keyword</label>
                                <input type="text" name="pr_meta_keyword"
                                    value="{{ $pressReleaseData->pr_meta_keyword }}" class="md-input" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="pr_meta_desc">Meta Desciption</label>
                                <textarea class="md-input" name="pr_meta_desc" cols="10" rows="8">{{ $pressReleaseData->pr_meta_desc }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="pr_logo">Logo
                                (<a href="{{ url('custom-images/press-release/' . $pressReleaseData->pr_logo) }}"
                                    target="_blank">View Image</a>)
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="pr_logo"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="pr_attachment">PDF Attachment

                                @isset($pressReleaseData->pr_attachment)
                                    (<a href="{{ url('custom-images/press-release/' . $pressReleaseData->pr_attachment) }}"
                                        target="_blank">View PDF</a>)
                                @endisset

                            </label>
                            <div class="parsley-row">
                                <input type="file" name="pr_attachment"
                                    onchange='single_attachment(this,{{ ONLY_PDF_FORMATES }},{{ PDF_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="pr_admin_comment">Admin Comment</label>
                                <textarea class="md-input" name="pr_admin_comment" cols="10" rows="8">{{ $pressReleaseData->pr_admin_comment }}</textarea>
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
                <h3 class="heading_b uk-margin-bottom" style="font-size: 17px; color: black; font-weight: 500;">
                    Upload Multiple images <span style="color: red">*</span></h3>
                <form id="form_validation" method="POST" action="{{ url('/admin/pressReleaseImages') }}"
                    class="uk-form-stacked" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pr_id" value="{{ $pressReleaseData->pr_id }}">
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <input type="file" name="pri_path[]" multiple
                                onchange='multiple_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})' class="md-btn md-btn-primary md-input" />
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
                            @foreach ($pressReleaseImagesData as $pressReleaseImagesRow)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ url('custom-images/press-release-multiple-images/' . $pressReleaseImagesRow->pri_path) }}"
                                            target="_blank">{{ $pressReleaseImagesRow->pri_path }}</a></td>
                                    <td>
                                        @if (!empty($pressReleaseImagesRow->pri_added_time))
                                            {{ date('j F Y h:i:s', strtotime($pressReleaseImagesRow->pri_added_time)) }}
                                        @endif
                                    </td>
                                    <td><a href="{{ url('admin/pressReleaseImagesDelete/' . $pressReleaseImagesRow->pri_id . '/' . $pressReleaseImagesRow->pri_press_release_id . '/' . $pressReleaseImagesRow->pri_path) }}">Remove</a>
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
        jQuery(document).ready(function() {
            jQuery('#catmain_id').change(function() {
                var catmain_id = jQuery(this).val()
                jQuery.ajax({
                    url: '/admin/getBlogSubCategory',
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
        });
    </script>
@endsection
