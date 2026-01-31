@extends('admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/franchiseCategoryMainList') }}">Franchise Main Category List</a></li>
                <li><a href="{{ url('admin/franchiseCategorySubList') }}">Franchise Sub Category List</a></li>
                <li><span>Franchise Child Cayegory Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Update Details</h3>

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
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-1-2 uk-row-first">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Main Category : <span
                                style="color:#1976d2"> {{ $franchiseListingChildSingleData->fcm_name }}</span></label>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Sub Category : <span
                                style="color:#1976d2"> {{ $franchiseListingChildSingleData->fcs_name }}</span></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="md-card">
            <div class="md-card-content large-padding">
                <form id="form_validation" method="POST"
                    action="{{ url('/admin/franchiseCategoryChildUpdate/' . $franchiseListingChildSingleData->fcc_id) }}"
                    enctype="multipart/form-data" class="uk-form-stacked">
                    <input type="hidden" name="old_fcc_cat_main_id" value="{{$franchiseListingChildSingleData->fcc_cat_main_id}}">
                    <input type="hidden" name="old_fcc_cat_sub_id" value="{{$franchiseListingChildSingleData->fcc_cat_sub_id}}">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <select class="md-input" name="fcc_cat_main_id" id="catmain_id">
                                <option value="">Select Category</option>
                                @foreach ($franchiseListingMainData as $franchiseListingMainRow)
                                    <option value="{{ $franchiseListingMainRow->fcm_id }}">
                                        {{ $franchiseListingMainRow->fcm_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="f_sub_cat">Sector / Sub Category </label>
                            <select name="fcc_cat_sub_id" class="md-input" id="catsub_id">
                                <option selected="" disabled="" value="">Choose...</option>
                            </select>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="login_username">Child Category Name <span class="req"
                                        style="color: red">*</span></label>
                                <input class="md-input" type="text" id="fcc_name"
                                    value="{{ $franchiseListingChildSingleData->fcc_name }}" required name="fcc_name" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <select class="md-input" name="fcc_status">
                                    <option value="">Choose..</option>
                                    <option value="{{ STATUS_ACTIVE }}"
                                        @if ($franchiseListingChildSingleData->fcc_status == STATUS_ACTIVE) selected style="color:green" @endif>Active
                                    </option>
                                    <option value="{{ STATUS_INACTIVE }}"
                                        @if ($franchiseListingChildSingleData->fcc_status == STATUS_INACTIVE) selected style="color:red" @endif>In Active
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <br>
                                <button type="submit" class="md-btn md-btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function() {
            jQuery('#catmain_id').change(function() {
                var catmain_id = jQuery(this).val()
                jQuery.ajax({
                    url: "{{ url('user-admin/getFranchiseSubCategory') }}",
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
