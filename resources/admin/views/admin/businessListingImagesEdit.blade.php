@extends('admin.layouts.main')
@section('main-container')
    <style type="text/css">
        .switch-field {
            display: flex;
            /*    margin-bottom: 36px;*/
            overflow: hidden;
        }

        .switch-field input {
            position: absolute !important;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            width: 1px;
            border: 0;
            overflow: hidden;
        }

        .switch-field label {
            background-color: #e4e4e4;
            color: rgba(0, 0, 0, 0.6);
            font-size: 14px;
            line-height: 1;
            text-align: center;
            padding: 8px 16px;
            margin-right: -1px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
            transition: all 0.1s ease-in-out;
        }

        .switch-field label:hover {
            cursor: pointer;
        }

        .switch-field input:checked+label {
            background-color: #a5dc86;
            box-shadow: none;
        }

        .switch-field label:first-of-type {
            border-radius: 4px 0 0 4px;
        }

        .switch-field label:last-of-type {
            border-radius: 0 4px 4px 0;
        }

        .label-info {
            background-color: #17a2b8;
        }

        .text_field_class {
            height: 50px;
            line-height: 50px;
            padding: 0 15px;
            outline: none;
            font-size: 15px;
            color: #808080;
            margin: 0 0 16px 0;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            display: block;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.03);
            font-weight: 600;
            opacity: 1;
            border-radius: 4px;
        }
    </style>
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/businessListing') }}">Business Listing List</a></li>
                <li><a href="{{ url('admin/businessListingEdit/' . Route::input('id') . '') }}">Business Edit</a></li>
                <li><a href="{{ url('admin/businessListingTimingEdit/' . Route::input('id') . '') }}">Business Timing Edit</a></li>
                <li><span>Business Image Edit</span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Business Timing Details</h3>
        @if (session('message'))
            @if (session('message') == MSG_ADD_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Inserted Successfully!..</p>
                </div>
            @else
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In Insert!..</p>
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


        <div class="md-card">
            <div class="md-card-content large-padding">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Business Name : <span
                                style="color:#1976d2"> {{ $businessLisitingData['bus_name'] }}</span></label>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Business Contact No : <span
                                style="color:#1976d2"> {{ $businessLisitingData['bus_contact_no'] }}</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="md-card">
            <div class="md-card-content large-padding">
                <h3 class="heading_b uk-margin-bottom" style="font-size: 17px; color: black; font-weight: 500;"> Business
                    Logo / images <span style="color: red">*</span> ( Upload Multiple images)</h3>
                <form id="form_validation" method="POST"
                    action="{{ url('/admin/businessListingImagesLogoStore/' . Route::input('id')) }}" class="uk-form-stacked"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <input type="file" name="bus_img_log[]" class="md-btn md-btn-primary" required multiple>
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                        </div>

                    </div>
                </form>

                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover" cellspacing="0" width="100%">
                        <br>
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Image</th>
                                <th>Added Date & Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($businessLogoImagesArray as $businessLogoImagesRow)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ url('custom-images/business-images/images/' . $businessLogoImagesRow['bus_img_path']) }}"
                                            target="_blank">{{ $businessLogoImagesRow['bus_img_path'] }}</a></td>
                                    <td>
                                        @if (!empty($businessLogoImagesRow['bus_img_added_time']))
                                            {{ date('j F Y h:i:s', strtotime($businessLogoImagesRow['bus_img_added_time'])) }}
                                        @endif
                                    </td>
                                    <td><a
                                            href="{{ url('admin/businessListingImagesDelete/' . $businessLogoImagesRow['bus_img_id'] . '/' . $businessLogoImagesRow['bus_img_business_id'] . '/LOGO/' . $businessLogoImagesRow['bus_img_path']) }}">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <div class="md-card">
            <div class="md-card-content large-padding">
                <h3 class="heading_b uk-margin-bottom" style="font-size: 17px; color: black; font-weight: 500;"> Business
                    ID Proof <span style="color: red">*</span> ( Upload Multiple images)</h3>
                <form id="form_validation" method="POST"
                    action="{{ url('/admin/businessListingImagesIDProodStore/' . Route::input('id')) }}" class="uk-form-stacked"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <input type="file" name="bus_img_id_proof[]" class="md-btn md-btn-primary" required multiple>
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                        </div>

                    </div>
                </form>

                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover" cellspacing="0" width="100%">
                        <br>
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Image</th>
                                <th>Added Date & Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($businessoIdProofImagesArray as $businessoIdProofImagesRow)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ url('custom-images/business-images/id-proof/' . $businessoIdProofImagesRow['bus_img_path']) }}"
                                            target="_blank">{{ $businessoIdProofImagesRow['bus_img_path'] }}</a></td>
                                    <td>
                                        @if (!empty($businessoIdProofImagesRow['bus_img_added_time']))
                                            {{ date('j F Y h:i:s', strtotime($businessoIdProofImagesRow['bus_img_added_time'])) }}
                                        @endif
                                    </td>
                                    <td><a
                                            href="{{ url('admin/businessListingImagesDelete/' . $businessoIdProofImagesRow['bus_img_id'] . '/' . $businessoIdProofImagesRow['bus_img_business_id'] . '/IDPROOF/' . $businessoIdProofImagesRow['bus_img_path']) }}">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
    <script src="{{ asset('frontend/scripts/businessScheduleValidation.js') }}"></script>
@endsection
