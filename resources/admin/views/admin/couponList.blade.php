@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                @if (Route::input('status') == STATUS_ACTIVE)
                <li><span>Active Coupon List</span></li>
                @else
                <li><span>In Active Coupon List</span></li>
                @endif

            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Brand Name</th>
                            <th>Company Name</th>
                            <th>Coupon Title</th>
                            <th>Coupon Code</th>
                            <th>Contact No</th>
                            <th>Added Date & Time</th>
                            <th>Updated Date & Time</th>
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
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($couponListArray as $couponListRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $couponListRow['coupon_brand_name'] }}</td>
                                <td>{{ $couponListRow['coupon_company_name'] }}</td>
                                <td>{{ $couponListRow['coupon_title'] }}</td>
                                <td>{{ $couponListRow['coupon_code'] }}</td>
                                <td>{{ $couponListRow['coupon_contact'] }}</td>
                                <td>
                                    @if (!empty($couponListRow['coupon_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($couponListRow['coupon_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($couponListRow['coupon_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($couponListRow['coupon_changed_time'])) }}
                                    @endif
                                </td>

                                <td><a
                                        href="{{ url('admin/couponEdit/' . $couponListRow['coupon_id']) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
