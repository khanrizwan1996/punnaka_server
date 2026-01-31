@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Product & Service List</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <a class="md-btn md-btn-primary" href="{{url('admin/productAndServiceAdd')}}">Add New Product & Service</a>
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Listing Type</th>
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
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($productAndServiceData as $productAndServiceRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if($productAndServiceRow->ps_status == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @elseif($productAndServiceRow->ps_status == STATUS_ACTIVE)
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @elseif($productAndServiceRow->ps_status == STATUS_DUPLICATE)
                                        <span class="uk-badge uk-badge-danger">Duplicate</span>
                                    @endforelse
                                </td>
                                <td>{{ $productAndServiceRow['ps_main_cat']." ".$productAndServiceRow['ps_sub_cat'] }}</td>
                                <td>{{ $productAndServiceRow['ps_title'] }}</td>
                                <td>{{ $productAndServiceRow['ps_listing_type'] }}</td>
                                <td>
                                    @if(!empty($productAndServiceRow['ps_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($productAndServiceRow['ps_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($productAndServiceRow['ps_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($productAndServiceRow['ps_changed_time'])) }}
                                    @endif
                                </td>
                                 <td>
                                    <div>
                                        <div class="uk-position-relative uk-display-inline-block"
                                            data-uk-dropdown="{pos:'bottom-right'}">
                                            <i class="md-icon material-icons">&#xE8B8;</i>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav">
                                                    <li><a href="{{ url('admin/productAndServiceEdit/' . $productAndServiceRow->ps_id) }}">Detail Edit</a></li>
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
