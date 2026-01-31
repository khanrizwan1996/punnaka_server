@extends('user_admin.layouts.main')
@section('main-container')
    <link rel="stylesheet" type="text/css" href="{{ asset('user_admin/assets/css/vendors/datatables.css') }}">
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Payment History</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{ url('user-admin/dashboard') }}">Dashboard</a> / </li>
                            <li class="breadcrumb-item active">Payment History List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>SR. No</th>
                                            <th>Status</th>
                                            <th>Payment Id</th>
                                            <th>Plan Name</th>
                                            {{-- <th>Business Name</th> --}}
                                            <th>Amount</th>
                                            <th>Purchase Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($userPaymentHistoryArray as $userPaymentHistoryRow)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    @if ($userPaymentHistoryRow['bus_pay_status'] == 1)
                                                        <span class="paid"
                                                            style="background: rgba(0, 0, 0, 0.08);
                                  padding: 2px 7px;
                                  border-radius: 4px;
                                  display: inline;
                                  font-size: 12px;
                                  font-weight: 700;
                                  color: #64bc36;
                                  margin-left: 2px;
                                  top: -1px;
                                  position: relative;">Paid</span>
                                                    @else
                                                        <span class="unpaid"
                                                            style="background: rgba(0, 0, 0, 0.08);
                                  padding: 2px 7px;
                                  border-radius: 4px;
                                  display: inline;
                                  font-size: 12px;
                                  font-weight: 700;
                                  color: #ee3535;
                                  margin-left: 2px;
                                  top: -1px;
                                  position: relative;">Unpaid</span>
                                                    @endif
                                                </td>
                                                <td>{{ $userPaymentHistoryRow['bus_pay_payment_id'] }}</td>
                                                <td>
                                                    @if ($userPaymentHistoryRow['bus_pay_plan_type'] === 'FL')
                                                        Franchisee Listing
                                                    @elseif($userPaymentHistoryRow['bus_pay_plan_type'] === 'BL')
                                                        Business Listing
                                                    @elseif($userPaymentHistoryRow['bus_pay_plan_type'] === 'PSL')
                                                        Products & Services Listing
                                                    @elseif($userPaymentHistoryRow['bus_pay_plan_type'] === 'OCFL')
                                                        Offers, Coupons, Freebies Listing
                                                    @else
                                                        Old Plan Purchased
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $userPaymentHistoryRow['bus_pay_user_business_name'] }}</td> --}}
                                                <td>
                                                    @php
                                                        if (
                                                            $userPaymentHistoryRow['bus_pay_payment_currency'] == 'USD'
                                                        ) {
                                                            echo '&#36;' . $userPaymentHistoryRow['bus_pay_amount'];
                                                        } else {
                                                            echo '&#8377;' . $userPaymentHistoryRow['bus_pay_amount'];
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @if (!empty($userPaymentHistoryRow['bus_pay_added_time']))
                                                        {{ date('j F Y h:i:s', strtotime($userPaymentHistoryRow['bus_pay_added_time'])) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
