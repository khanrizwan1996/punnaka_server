@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard </a></li>
                <li><a href="{{ url('admin/businessListing') }}">Business Listing </a></li>
                <li><span>Business Review List</span></li>
                <li><span style="color: red; font-wegiht_bolder">{{ $businessListingReviewData->first()->bus_name }}</span></li>
            </ul>
        </div>
       
        <div class="md-card">
            <div class="md-card-content">
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Status</th>
                            <th>User Name</th>
                            <th>Stars</th>
                            <th>Review</th>
                            <th>Added Date&Time</th>
                            {{-- <th>Action</th> --}}
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
                            {{-- <th></th> --}}
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($businessListingReviewData as $businessListingReviewRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if($businessListingReviewRow->blr_status == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @elseif($businessListingReviewRow->blr_status == STATUS_ACTIVE)
                                        <span class="uk-badge uk-badge-success">Active</span>
                  
                                    @endforelse
                                </td>
                                {{-- <td>{{ $businessListingReviewRow->bus_name }}</td> --}}
                                <td>{{ $businessListingReviewRow->name }}</td>
                                <td>{{ $businessListingReviewRow->blr_star }}</td>
                                <td>{{ $businessListingReviewRow->blr_review }}</td>

                                <td>
                                    @if(!empty($businessListingReviewRow->blr_adde_time))
                                        {{ date('j F Y h:i:s', strtotime($businessListingReviewRow->blr_adde_time)) }}
                                    @endif
                                </td>
                                {{-- <td>
                                    <div>
                                        <div class="uk-position-relative uk-display-inline-block"
                                            data-uk-dropdown="{pos:'bottom-right'}">
                                            <i class="md-icon material-icons">&#xE8B8;</i>
                                            <div class="uk-dropdown">
                                                {{-- <ul class="uk-nav">
                                                    <li><a href="{{ url('admin/businessListingEdit/' . $allBusinessListingRow->bus_id) }}">Detail Edit</a></li>
                                                    
                                                </ul> --}
                                            </div>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
