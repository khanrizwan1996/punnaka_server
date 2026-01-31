@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Franchise Listing Sub Category List</span></li>
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
                        <form id="form_validation" method="POST" action="{{ url('admin/franchiseCategorySubStore') }}">
                            @csrf
                            <label for="login_username">Select Main Category <span class="req"
                                    style="color: red">*</span></label>
                            <div class="uk-form-row">
                                <select class="md-input" required name="fcs_cat_main_id" id="fcs_cat_main_id">
                                    <option value="">Select Category</option>
                                    @foreach ($franchiseListingMainData as $franchiseListingMainRow)
                                        <option value="{{ $franchiseListingMainRow['fcm_id'] }}">
                                            {{ $franchiseListingMainRow['fcm_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="uk-form-row">
                                <label for="login_username">Sub Category Name <span class="req"
                                        style="color: red">*</span></label>
                                <input class="md-input" type="text" id="fcs_name" required name="fcs_name" />
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
                        @foreach ($franchiseListingSubData as $franchiseListingSubRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $franchiseListingSubRow['fcm_name'] }}</td>
                                <td>{{ $franchiseListingSubRow['fcs_name'] }}</td>
                                <td>
                                    @if($franchiseListingSubRow['fcs_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>
                                    @if(!empty($franchiseListingSubRow['fcs_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($franchiseListingSubRow['fcs_added_time'])) }}
                                    @endif
                                </td>

                                <td>
                                    @if(!empty($franchiseListingSubRow['fcs_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($franchiseListingSubRow['fcs_changed_time'])) }}
                                    @endif
                                </td>

                                <td><a href="{{ url('admin/franchiseCategorySubEdit/'.$franchiseListingSubRow['fcs_id']) }}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
