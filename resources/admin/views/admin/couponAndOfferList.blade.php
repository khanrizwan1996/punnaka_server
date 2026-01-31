@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Offers & Coupons List</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <a href="{{ url('admin/couponAndServiceAdd') }}" class="md-btn md-btn-primary">Add New Offers & Coupons</a>
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                          <tr>
                                <th>SR. No</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Listing Type</th>
                                <th>Title</th>
                                <th>Added Date & Time</th>
                                <th>Update Date & Time</th>
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
                        @foreach ($couponOfferData as $CouponOfferRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if($CouponOfferRow->cf_status == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @elseif($CouponOfferRow->cf_status == STATUS_ACTIVE)
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @elseif($CouponOfferRow->cf_status == STATUS_DUPLICATE)
                                        <span class="uk-badge uk-badge-danger">Duplicate</span>
                                    @endforelse
                                </td>
                                 <td>{{ $CouponOfferRow['cf_main_cat']." ".$CouponOfferRow['cf_sub_cat'] }}</td>
                                
                                 <td>{{ $CouponOfferRow['cf_listing_type'] }}</td>
                                 <td>{{ $CouponOfferRow['cf_title'] }}</td>
                                 <td>{{ date('j F Y h:i:s', strtotime($CouponOfferRow['cf_added_time'])) }}</td>
                                 <td>@if(!empty($CouponOfferRow['cf_changed_time'])){{ date('j F Y h:i:s', strtotime($CouponOfferRow['cf_changed_time'])) }} @endif</td>
                                 <td>
                                    <div>
                                        <div class="uk-position-relative uk-display-inline-block"
                                            data-uk-dropdown="{pos:'bottom-right'}">
                                            <i class="md-icon material-icons">&#xE8B8;</i>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav">
                                                    <li><a href="{{ url('admin/couponAndServiceEdit/' . $CouponOfferRow->cf_id) }}">Detail Edit</a></li>
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
