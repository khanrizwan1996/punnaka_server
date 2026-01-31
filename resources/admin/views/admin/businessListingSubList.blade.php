@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Business Listing Sub Category List</span></li>
            </ul>
        </div>

        @if (session('message'))
            @if (session('message') == MSG_ADD_SUCCESS)
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

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="md-card">
            <div class="md-card-content">
                <button class="md-btn md-btn-primary" data-uk-modal="{target:'#modalBusinessListingCategoryMain'}">Add Sub
                    Category</button>
                <div class="uk-modal" id="modalBusinessListingCategoryMain">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Sub Category Detail</h3>
                        </div>
                        <form id="form_validation" method="POST"
                            action="{{ url('admin/businessListingCategorySubStore') }}" enctype="multipart/form-data">
                            @csrf
                            <label for="login_username">Select Main Category <span class="req"
                                    style="color: red">*</span></label>
                            <div class="uk-form-row">
                                <select class="md-input" required name="cat_sub_main_id">
                                    <option value="">Select Category</option>
                                    @foreach ($busniessListingMainData as $busniessListingMainRow)
                                        <option value="{{ $busniessListingMainRow['cat_main_id'] }}">
                                            {{ $busniessListingMainRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="uk-form-row">
                                <label for="login_username">Sub Category Name <span class="req"
                                        style="color: red">*</span></label>
                                <input class="md-input" type="text" id="cat_sub_name" required name="cat_sub_name" />
                            </div>
                            <br>
                            <label for="login_username">Sub Category Image <span class="req"
                                    style="color: red">*</span></label>
                            <div class="uk-form-row">
                                <input type="file" name="cat_sub_image"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})' required
                                    class="md-btn md-btn-primary md-input" />
                            </div>

                            <div class="uk-modal-footer uk-text-right">
                                <button type="button"
                                    class="md-btn md-btn-flat md-btn md-btn-danger uk-modal-close">Close</button>
                                <button type="submit" class="md-btn md-btn-flat md-btn md-btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Status</th>
                            <th>Added Date&Time</th>
                            <th>Updated Date&Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($busniessListingSubData as $busniessListingSubRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $busniessListingSubRow['cat_main_name'] }}</td>
                                <td>{{ $busniessListingSubRow['cat_sub_name'] }}</td>
                                <td>
                                    @if ($busniessListingSubRow['cat_sub_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>
                                    @if (!empty($busniessListingSubRow['cat_sub_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($busniessListingSubRow['cat_sub_added_time'])) }}
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($busniessListingSubRow['cat_sub_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($busniessListingSubRow['cat_sub_changed_time'])) }}
                                    @endif
                                </td>

                                <td><a
                                        href="{{ url('admin/businessListingCategorySubEdit/' . $busniessListingSubRow['cat_sub_id']) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
