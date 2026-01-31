@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                @if (Route::input('status') == STATUS_ACTIVE)
                <li><a href="{{url('admin/offerList/'.STATUS_INACTIVE)}}">Offer In Active List</a></li>
                <li><span>Offer Active List</span></li>
                @else
                <li><a href="{{url('admin/offerList/'.STATUS_ACTIVE)}}">Offer Active List</a></li>
                <li><span>Offer In Active  List</span></li>
                @endif

            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Mall Name</th>
                            <th>Brand Name</th>
                            <th>Offer Title</th>
                            <th>Start Date Time</th>
                            <th>End Date Time</th>
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
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($offerListData as $offerListRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $offerListRow->offer_main_category }}</td>
                                <td>{{ $offerListRow->offer_sub_category }}</td>
                                <td>{{ $offerListRow->mall_name }}</td>
                                <td>{{ $offerListRow->brand_name }}</td>
                                <td>{{ $offerListRow->offer_title }}</td>
                                <td>{{ date('j F Y h:i:s', strtotime($offerListRow->offer_start_date." ".$offerListRow->offer_start_time)) }}</td>
                                <td>{{ date('j F Y h:i:s', strtotime($offerListRow->offer_end_date." ".$offerListRow->offer_end_time)) }}</td>
                                <td>
                                    @if (!empty($offerListRow->offer_added_timestamp))
                                        {{ date('j F Y h:i:s', strtotime($offerListRow->offer_added_timestamp)) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($offerListRow->offer_changed_timestamp))
                                        {{ date('j F Y h:i:s', strtotime($offerListRow->offer_changed_timestamp)) }}
                                    @endif
                                </td>

                                <td><a
                                        href="{{ url('admin/offerEdit/' . $offerListRow->offer_id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
