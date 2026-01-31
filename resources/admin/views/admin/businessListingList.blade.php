@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Business Listing List</span></li>
            </ul>
        </div>
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="md-card">
            <div class="md-card-content">
                <form id="form_validation" method="POST" action="{{ url('admin/importBusinessListingExcel') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="banner_image">Upload Excel <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="file" name="excel_file" required class="md-btn md-btn-primary md-input" />
                            </div>
                            <p><a download="" href="{{asset('custom-images/Business-Listing.csv')}}" style="color:red;font-weight:bolder">Download Excel</a></p>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <br>
                                <button type="submit" style="margin: 3px;"
                                    class="md-btn md-btn-flat md-btn md-btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <a href="{{ url('admin/businessListingAdd') }}" class="md-btn md-btn-flat md-btn md-btn-primary">Add New Business Listing </a>
                <a href="{{ url('admin/exportBusinessListingExcel') }}" class="md-btn md-btn-flat md-btn md-btn-success">Export Business Listing </a>
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Status</th>
                            <th>Business Name</th>
                            <th>Business Contact No</th>
                            <th>Full Name</th>
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
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($allBusinessListingArray as $allBusinessListingRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if($allBusinessListingRow->bus_status == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @elseif($allBusinessListingRow->bus_status == STATUS_ACTIVE)
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @elseif($allBusinessListingRow->bus_status == STATUS_DUPLICATE)
                                        <span class="uk-badge uk-badge-danger">Duplicate</span>
                                    @endforelse
                                </td>
                                <td>{{ $allBusinessListingRow->bus_name }}</td>
                                <td>{{ $allBusinessListingRow->bus_contact_no }}</td>
                                <td>{{ $allBusinessListingRow->name }}</td>

                                <td>
                                    @if(!empty($allBusinessListingRow->bus_added_time))
                                        {{ date('j F Y h:i:s', strtotime($allBusinessListingRow->bus_added_time)) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($allBusinessListingRow->bus_changed_time))
                                        {{ date('j F Y h:i:s', strtotime($allBusinessListingRow->bus_changed_time)) }}
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <div class="uk-position-relative uk-display-inline-block"
                                            data-uk-dropdown="{pos:'bottom-right'}">
                                            <i class="md-icon material-icons">&#xE8B8;</i>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav">
                                                    <li><a href="{{ url('admin/businessListingEdit/' . $allBusinessListingRow->bus_id) }}">Detail Edit</a></li>
                                                    <li><a href="{{ url('admin/businessListingImagesEdit/' . $allBusinessListingRow->bus_id) }}">Images</a></li>
                                                    <li><a href="{{ url('admin/businessListingTimingEdit/' . $allBusinessListingRow->bus_id) }}">Business Timings</a></li>

                                                    <li><a href="{{ url('admin/businessListingReview/' . $allBusinessListingRow->bus_id) }}">Business Reviews</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
