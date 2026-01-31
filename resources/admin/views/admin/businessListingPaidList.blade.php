@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Business Listing Paid List</span></li>
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
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Payment Id</th>
                            <th>Plan Type</th>
                            <th>Amount</th>
                            <th>Business Name</th>
                            <th>Full Name</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Added Date&Time</th>
                            <th>Updated Date&Time</th>
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
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($businessListingPaidArray as $businessListingPaidRow)
                        @php
                            if(isset($businessListingPaidRow->bus_pay_user_id) && !empty($businessListingPaidRow->bus_pay_user_id)){
                                $userObj = new App\Http\Controllers\admin\adminUserController();
                                $userDetail = $userObj->getUserDetailById($businessListingPaidRow->bus_pay_user_id);
                            }
                        @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $businessListingPaidRow->bus_pay_payment_id }}</td>
                                <td>
                                    @if($businessListingPaidRow->bus_pay_plan_type === 'FL')
                                        Franchisee Listing
                                    @elseif($businessListingPaidRow->bus_pay_plan_type === 'BL')
                                        Business Listing
                                    @elseif($businessListingPaidRow->bus_pay_plan_type === 'PSL')
                                        Products & Services Listing
                                    @elseif($businessListingPaidRow->bus_pay_plan_type === 'OCFL')
                                        Offers, Coupons, Freebies Listing
                                    @else
                                        Old Plan Purchased
                                    @endif
                                </td>
                                <td>{{ $businessListingPaidRow->bus_pay_amount }}</td>
                                <td>{{ $businessListingPaidRow->bus_pay_user_business_name }}</td>
                                <td>
                                    @if(isset($userDetail))
                                    {{ $userDetail->name }}
                                    @else
                                        {{ $businessListingPaidRow->bus_pay_user_name }}
                                    @endif
                                </td>
                                <td>{{ $businessListingPaidRow->bus_pay_user_contact_no }}</td>
                                <td>{{ $businessListingPaidRow->bus_pay_user_email }}</td>
                                <td>
                                    @if (!empty($businessListingPaidRow->bus_pay_added_time))
                                        {{ date('j F Y h:i:s', strtotime($businessListingPaidRow->bus_pay_added_time)) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($businessListingPaidRow->bus_pay_changed_time))
                                        {{ date('j F Y h:i:s', strtotime($businessListingPaidRow->bus_pay_changed_time)) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
