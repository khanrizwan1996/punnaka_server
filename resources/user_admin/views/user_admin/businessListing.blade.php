@extends('user_admin.layouts.main')
@section('main-container')

{{-- @php
$status = Route::input('status');

if($status == 1){
    $title = "Active Business List";
}else{
    $title = "In Active Business List";
}
@endphp --}}

<link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/datatables.css')}}">
       <div class="page-body">
          <div class="container-fluid">
            <div class="row page-title">
              <div class="col-sm-6">
                <h3>Business Listing Details</h3>
              </div>
              <div class="col-sm-6">
                <nav>
                  <ol class="breadcrumb justify-content-sm-end align-items-center">
                    <li class="breadcrumb-item"><a href="{{url('user-admin/dashboard')}}">Dashboard</a> / </li>
                    <li class="breadcrumb-item active">Business Listing Details</li>
                    {{-- @if ($status == 0)
                    <li class="breadcrumb-item active">In Active Business List</li>
                    @elseif ($status == 1)
                    <li class="breadcrumb-item active">Active Business List</li>
                    @endif --}}
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
                            <th>Sr. No</th>
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
                                @if($userBusinessListingRow['bus_status'] == 0)
                                <td>    
                                    <div class="dropdown icon-dropdown">
                                      <button class="btn dropdown-toggle" id="userdropdown{{$i}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" fdprocessedid="xw6ho5">Edit Detail</button>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown{{$i}}">
                                        
                                        {{-- href="{{url('businessListingEdit/'.$userBusinessListingRow['bus_id'])}}"
                                        href="{{url('businessListingTimingEdit/'.$userBusinessListingRow['bus_id'])}}"
                                        href="{{url('businessListingImageEdit/'.$userBusinessListingRow['bus_id'])}}" --}}

                                        <a class="dropdown-item" href="{{url('businessListingEdit/'.$userBusinessListingRow['bus_id'])}}"> Business Detail</a>
                                        <a class="dropdown-item" href="{{url('businessListingTimingEdit/'.$userBusinessListingRow['bus_id'])}}"> Business Timing</a>
                                        <a class="dropdown-item" href="{{url('businessListingImageEdit/'.$userBusinessListingRow['bus_id'])}}"> Business images</a>
                                    </div>
                                  </td>
                                  @else
                                  <td>-</td>
                                  @endif
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
          </div>
        </div>
        @endsection
