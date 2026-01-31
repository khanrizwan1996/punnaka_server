@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Brand List</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <a href="{{ url('admin/brandAdd') }}" class="md-btn md-btn-primary">Add Brand</a>
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Status</th>
                            <th>Mall Name</th> 
                            <th>Brand Name</th> 
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
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($brandDataArray as $brandDataRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($brandDataRow['brand_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>{{ $brandDataRow['mall_name'] }}</td>
                                <td>{{ $brandDataRow['brand_name'] }}</td>
                                <td>{{ $brandDataRow['brand_contact_no'] }}</td>
                                <td>{{ $brandDataRow['brand_email'] }}</td>
                                <td>{{ $brandDataRow['brand_city'] }}</td>
                                <td>
                                    @if (!empty($brandDataRow['brand_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($brandDataRow['brand_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($brandDataRow['brand_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($brandDataRow['brand_changed_time'])) }}
                                    @endif
                                </td>

                                <td><a
                                        href="{{ url('admin/brandEdit/' . $brandDataRow['brand_id']) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
