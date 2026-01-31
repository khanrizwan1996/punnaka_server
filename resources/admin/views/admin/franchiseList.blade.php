@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Franchise List</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <a href="{{ url('admin/franchiseAdd') }}" class="md-btn md-btn-primary">Add Franchise</a>
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>State</th>
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Name</th> 
                            <th>Contact No</th>
                            <th>Country</th>
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
                        @foreach ($franchiseDetail as $franchiseDetailRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if($franchiseDetailRow['f_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @elseif($franchiseDetailRow['f_status'] == STATUS_ACTIVE)
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @elseif($franchiseDetailRow['f_status'] == STATUS_DUPLICATE)
                                        <span class="uk-badge uk-badge-danger">Duplicate</span>
                                    @endforelse
                                </td>                                
                                <td>{{ $franchiseDetailRow['f_main_cat'] }}</td>
                                <td>{{ $franchiseDetailRow['f_sub_cat'] }}</td>
                                <td>{{ $franchiseDetailRow['f_name'] }}</td>
                                <td>{{ $franchiseDetailRow['f_contact_no'] }}</td>
                                <td>{{ $franchiseDetailRow['f_country'] }}</td>
                                <td>
                                    @if (!empty($franchiseDetailRow['f_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($franchiseDetailRow['f_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($franchiseDetailRow['f_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($franchiseDetailRow['f_changed_time'])) }}
                                    @endif
                                </td>

                                <td>
                                     <div>
                                        <div class="uk-position-relative uk-display-inline-block"
                                            data-uk-dropdown="{pos:'bottom-right'}">
                                            <i class="md-icon material-icons">&#xE8B8;</i>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav">
                                                    <li><a href="{{ url('admin/franchiseEdit/' . $franchiseDetailRow['f_id']) }}">Detail
                                                            Edit</a></li>
                                                    <li><a href="{{ url('admin/franchiseOtherDetailList/' . $franchiseDetailRow['f_id']) }}">Other Details</a></li>
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
