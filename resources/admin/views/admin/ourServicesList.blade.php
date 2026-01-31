@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Our Services List</span></li>
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
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Selected Services</th>
                            <th>Message</th>
                            <th>Added Date & Time</th>
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
                        @foreach ($ourServicesListArray as $ourServicesListRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $ourServicesListRow['se_user_name']}}</td>
                                <td>{{ $ourServicesListRow['se_user_email']}}</td>
                                <td>{{ $ourServicesListRow['se_user_contact_no']}}</td>
                                <td>{{ $ourServicesListRow['se_services']}}</td>
                                <td title="{{$ourServicesListRow['se_message']}}">{{ Str::substr($ourServicesListRow['se_message'], 0, 30)}}</td>
                                <td>
                                    @if (!empty($ourServicesListRow['se_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($ourServicesListRow['se_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/OurServiceDelete/' . $ourServicesListRow['se_id']) }}">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
