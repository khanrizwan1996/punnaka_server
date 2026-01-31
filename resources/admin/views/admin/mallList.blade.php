@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Mall List</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <a href="{{ url('admin/mallAdd') }}" class="md-btn md-btn-primary">Add Mall</a>
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Status</th>
                            <th>Mall Name</th>
                            <th>Contact No</th>
                            <th>Email Address</th>
                            <th>City</th>
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
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($mallDataArray as $mallDataRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($mallDataRow['mall_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>{{ $mallDataRow['mall_name'] }}</td>
                                <td>{{ $mallDataRow['mall_contact_no'] }}</td>
                                <td>{{ $mallDataRow['mall_email'] }}</td>
                                <td>{{ $mallDataRow['mall_city'] }}</td>
                                <td>
                                    @if (!empty($mallDataRow['mall_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($mallDataRow['mall_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($mallDataRow['mall_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($mallDataRow['mall_changed_time'])) }}
                                    @endif
                                </td>

                                <td><a
                                        href="{{ url('admin/mallEdit/' . $mallDataRow['mall_id']) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
