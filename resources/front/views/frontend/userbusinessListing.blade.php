@include('frontend.layouts.userHeader')
<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Business Listing</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Dashboard</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="utf_dashboard_list_box table-responsive recent_booking">
                <h4>Business Listing</h4>
                <div class="col-lg-12 col-md-12 mb-4">
                    <table id="tableID" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Business Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Register DateTime</th>
                                <th>Update DateTime</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($userBusinessListingArray as $userBusinessListingRow)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>@if($userBusinessListingRow['bus_status'] == 0)
                                        <center>
                                        <div class="dropdown">
                                            <a class="activeUrl" style="font-size:25px; cursor:pointer"><i class="fa fa-gear"></i></a>
                                            <div class="dropdown-content">
                                                <a href="{{url('businessListingEdit/'.$userBusinessListingRow['bus_id'])}}"> Business Detail</a>
                                                <a href="{{url('businessListingTimingEdit/'.$userBusinessListingRow['bus_id'])}}"> Business Timing</a>
                                                <a href="{{url('businessListingImageEdit/'.$userBusinessListingRow['bus_id'])}}"> Business images</a>
                                            </div>
                                        </div>
                                        </center>
                                        @else <center> <b>-</b> </center>
                                        @endif
                                    </td>
                                    <td>
                                        @if($userBusinessListingRow['bus_status'] == 1)
                                        <span class="activeStatus">Active</span>
                                        @else<span class="inActiveStatus">In Active</span
                                        @endif
                                    </td>
                                    <td>{{ $userBusinessListingRow['bus_name'] }}</td>
                                    <td>{{ $userBusinessListingRow['bus_contact_no'] }}</td>
                                    <td>{{ $userBusinessListingRow['bus_email'] }}</td>
                                    <td>{{ $userBusinessListingRow['bus_country'] }}</td>
                                    <td>{{ date('j F Y h:i:s', strtotime($userBusinessListingRow['bus_added_time'])) }}</td>
                                    <td>@if(!empty($userBusinessListingRow['bus_changed_time'])){{ date('j F Y h:i:s', strtotime($userBusinessListingRow['bus_changed_time'])) }} @endif</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@include('frontend.layouts.userFooter')
