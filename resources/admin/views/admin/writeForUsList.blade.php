@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Write For Us List</span></li>
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
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($writeForUsListArray as $writeForUsListRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $writeForUsListRow['wfu_user_name']}}</td>
                                <td>{{ $writeForUsListRow['wfu_user_email']}}</td>
                                <td>{{ $writeForUsListRow['wfu_user_contact_no']}}</td>
                                <td title="{{ $writeForUsListRow['wfu_message']}}">{{ Str::substr($writeForUsListRow['wfu_message'], 0, 30) }}</td>
                                <td>
                                    @if (!empty($writeForUsListRow['wfu_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($writeForUsListRow['wfu_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/writeForUsDelete/' . $writeForUsListRow['wfu_id']) }}">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
