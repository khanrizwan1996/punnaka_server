@extends('admin.layouts.main')
@section('main-container')
    <br><br>
    <div id="page_content_inner">
        <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show"
            data-uk-sortable data-uk-grid-margin>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/bar-graph.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Users </span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalUsersCounts }})</span></h2>

                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/pie-chart.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small">Malls</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalMallCounts }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/graph.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small">In Active Brands </span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalInActiveBrandsCounts }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/bar-chart.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Active Brands </span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalActiveBrandsCounts }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/graph-01.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Shopping Blogs</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalShoppingBlogs }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/analysis.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Blogs</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalBlogs }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/dashboard.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Our Services Enqiry</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalServiceEnquiryCounts }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/dashboard.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Write For Us Enqiry</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">({{ $totalWriteForUsEnquiryCounts }})</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/dashboard.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Active Business Listing</span>
                        <h2 class="uk-margin-remove"><span
                                class="countUpMe">({{ $totalActiveBusinessListingCounts }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/dashboard.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> In Active Business Listing</span>
                        <h2 class="uk-margin-remove"><span
                                class="countUpMe">({{ $totalInActiveBusinessListingCounts }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/dashboard.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Business Listing Paid</span>
                        <h2 class="uk-margin-remove"><span
                                class="countUpMe">({{ $totalPaidBusinessListingCounts }})</span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><img class="stroke-icon"
                                src="{{ url('custom-images/icons/dashboard.png') }}" style="height: 30px;"></div>
                        <span class="uk-text-muted uk-text-small"> Business Listing Not Paid</span>
                        <h2 class="uk-margin-remove"><span
                                class="countUpMe">({{ $totalUnPaidBusinessListingCounts }})</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div>
            <h4><b>All In Active Listing:</b></h4>
            <div class="md-card">
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <center>SR. No</center>
                            </th>
                            <th>Edit Listing</th>
                            <th>Listing Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Added Date&Time</th>
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

                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($records as $recordRow)
                            <tr>
                                <td>
                                    <center>{{ $i++ }}</center>
                                </td>
                                <td>
                                    @if ($recordRow->source == 'franchise')
                                        <span><a href="{{ url(ADMIN_URL . 'user-admin/franchiseEdit/' . $recordRow->id) }}"
                                                class="md-btn md-btn-primary">Edit List</a></span>
                                    @elseif($recordRow->source == 'product_service')
                                        <span> -
                                            {{-- <a href="{{ url(ADMIN_URL.'user-admin/productAndServiceEdit/' . $recordRow->id) }}"
                                                                class="md-btn md-btn-primary">Edit List</a> --}}
                                        </span>
                                    @elseif($recordRow->source == 'business_listing')
                                        <span>
                                            <a href="{{ url(ADMIN_URL . 'businessListingEdit/' . $recordRow->id) }}"
                                                class="md-btn md-btn-primary">Edit List</a>
                                        </span>
                                    @elseif($recordRow->source == 'coupon_offer')
                                        <span> -
                                            {{-- <a href="{{ url(ADMIN_URL.'couponOfferEdit/' . $recordRow->id) }}"class="md-btn md-btn-primary">Edit List</a> --}}
                                        </span>
                                    @endif


                                </td>
                                <td>{{ $recordRow->name }}</td>
                                <td>
                                    @if ($recordRow->source == 'franchise')
                                        <span>Franchise Listing</span>
                                    @elseif($recordRow->source == 'product_service')
                                        <span>Product & Service Listing</span>
                                    @elseif($recordRow->source == 'business_listing')
                                        <span>Business Listing</span>
                                    @elseif($recordRow->source == 'coupon_offer')
                                        <span>Coupon Listing</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($recordRow->status == STATUS_ACTIVE)
                                        <span style="padding: 5px;" class="uk-badge uk-badge-success"
                                            fdprocessedid="xprjs2">
                                            <center>Active</center>
                                        </span>
                                    @else
                                        <span style="padding: 5px;" class="uk-badge uk-badge-danger"
                                            fdprocessedid="lvkpk">
                                            <center>In Active</center>
                                        </span>
                                    @endif
                                </td>
                                <td>{{ date('j F Y h:i:s', strtotime($recordRow->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>
@endsection
