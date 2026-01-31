@include('frontend.layouts.userHeader')
<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit Business Images</h2>
                <nav id="breadcrumbs">
                     <ul>
                        <li><a href="{{ url('user-admin/dashboard') }}" class="activeUrl">Dashboard</a></li>
                        <li><a href="{{ url('user-admin/businessListing') }}" class="activeUrl">Business Listing Details</a></li>
                    </ul>
                </nav>
                @if (session('message'))
                    @if (session('message') == MSG_ADD_SUCCESS)
                        <div style="padding: 1px; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                            <p style="margin: 6px; font-weight: bold;">Data Added Successfully!..</p>
                        </div>
                    @else
                        <div style="padding: 1px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"">
                            <p style="margin: 6px; font-weight: bold;">Error In Add!..</p>
                        </div>
                    @endforelse
                @endif
                @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="utf_dashboard_list_box table-responsive recent_booking">
                <h4>Business Logo / images (Upload Multiple images)</h4>
                <div class="row">
                    <br>
                    <form method="POST" action="{{ url('/userBusinessListingImagesLogoStore/' . Route::input('id')) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 col-md-6">
                            <input type="file" multiple name="bus_img_log[]" id="bus_img_log" required>
                        </div>
                        <div class="col-lg-2 col-md-6" style="margin-top: -8px;">
                            <button type="submit" class="button preview btn_center_item margin-top-15">Save
                                Changes</button>
                        </div>
                    </form>
                    <br><br><br><br>
                </div>
                <div class="dashboard-list-box table-responsive invoices with-icons">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Image</th>
                                <th>Added Date & Time </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($businessLogoImagesData as $businessLogoImagesRow)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td><a
                                            href="{{ url('userBusinessListingImagesDelete/' . $businessLogoImagesRow['bus_img_id'] . '/' . $businessLogoImagesRow['bus_img_business_id'] . '/LOGO/' . $businessLogoImagesRow['bus_img_path']) }}">Remove</a>
                                    </td>

                                    <td><a href="{{ url('custom-images/business-images/images/' . $businessLogoImagesRow['bus_img_path']) }}"
                                            target="_blank">{{ $businessLogoImagesRow['bus_img_path'] }}</a></td>

                                    <td>
                                        @if (!empty($businessLogoImagesRow['bus_img_added_time']))
                                            {{ date('j F Y h:i:s', strtotime($businessLogoImagesRow['bus_img_added_time'])) }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="utf_dashboard_list_box table-responsive recent_booking">
                <h4>Business ID Proof (Upload Multiple images)</h4>
                <div class="row">
                    <br>
                    <form method="POST" action="{{ url('/userBusinessListingImagesIDProodStore/' . Route::input('id')) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 col-md-6">
                            <input type="file" multiple name="bus_img_id_proof[]" id="bus_img_id_proof" required>
                        </div>
                        <div class="col-lg-2 col-md-6" style="margin-top: -8px;">
                            <button type="submit" class="button preview btn_center_item margin-top-15">Save
                                Changes</button>
                        </div>
                    </form>
                    <br><br><br><br>
                </div>
                <div class="dashboard-list-box table-responsive invoices with-icons">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Image</th>
                                <th>Added Date & Time </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($businessoIdProofImagesData as $businessoIdProofImagesRow)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td><a href="{{ url('userBusinessListingImagesDelete/' . $businessoIdProofImagesRow['bus_img_id'] . '/' . $businessoIdProofImagesRow['bus_img_business_id'] . '/IDPROOF/' . $businessoIdProofImagesRow['bus_img_path']) }}">Remove</a>
                                    </td>

                                    <td><a href="{{ url('custom-images/business-images/id-proof/' . $businessoIdProofImagesRow['bus_img_path']) }}"target="_blank">{{ $businessoIdProofImagesRow['bus_img_path'] }}</a></td>

                                    <td>@if (!empty($businessoIdProofImagesRow['bus_img_added_time'])){{ date('j F Y h:i:s', strtotime($businessoIdProofImagesRow['bus_img_added_time'])) }} @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{ asset('frontend/scripts/businessScheduleValidation.js') }}"></script>
@include('frontend.layouts.userFooter')
