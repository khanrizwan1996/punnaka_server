@extends('user_admin.layouts.main')
@section('main-container')

    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
        <style>
            body {
                /* font-family: 'Segoe UI', sans-serif; */
                margin: 0;
                padding: 20px;
                background-color: #fff;
            }

            .wizard-header {
                display: flex;
                justify-content: space-between;
                background: #eaf8f6;
                padding: 10px 0;
                border-radius: 5px;
                margin-bottom: 30px;
            }

            .wizard-step {
                flex: 1;
                text-align: center;
                color: #999;
                font-weight: 500;
                position: relative;
            }

            .wizard-step.active {
                color: #0f9d8c;
                font-weight: bold;
            }

            .wizard-step .icon {
                background: #0f9d8c;
                color: #fff;
                border-radius: 50%;
                padding: 10px;
                display: inline-block;
                margin-bottom: 5px;
            }

            .wizard-step:not(:last-child)::after {
                content: '';
                height: 3px;
                background: #ccc;
                position: absolute;
                top: 20px;
                right: -50%;
                width: 100%;
                z-index: -1;
            }

            .wizard-step.active:not(:last-child)::after {
                background: #0f9d8c;
            }

            .step {
                display: none;
            }

            .step.active {
                display: block;
            }

            .form-group {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                margin-bottom: 15px;
            }

            .form-group label {
                font-weight: 500;
                margin-bottom: 5px;
                display: block;
            }

            /* .form-control {
                padding: 10px;
                font-size: 16px;
                border-radius: 6px;
                border: 1px solid #ccc;
                width: 100%;
            } */

            textarea.form-control {
                resize: vertical;
                height: 80px;
            }

            .form-check {
                margin-top: 10px;
            }

            .form-check label {
                font-weight: normal;
            }

            .col-6 {
                width: 48%;
            }

            .col-4 {
                width: 30%;
            }

            @media (max-width: 768px) {

                .col-6,
                .col-4 {
                    width: 100%;
                }
            }

            h2 {
                margin-bottom: 5px;
            }

            .subtitle {
                color: #666;
                font-size: 15px;
                margin-bottom: 25px;
            }

            .buttons {
                margin-top: 20px;
                display: flex;
                justify-content: space-between;
            }

            .buttons button {
                padding: 10px 20px;
                border: none;
                background: #0f9d8c;
                color: white;
                border-radius: 5px;
                cursor: pointer;
            }

            .buttons button[disabled] {
                background: #ccc;
                cursor: not-allowed;
            }
        </style>
    </head>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Edit Franchise</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{ url(USER_ADMIN_URL . 'dashboard') }}">Dashboard</a> /</li>
                            <li class="breadcrumb-item"><a href="{{ url(USER_ADMIN_URL . 'dashboard') }}">franchiseList</a> /</li>
                            <li class="breadcrumb-item active">Edit Franchise</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @if (session('message'))
                        <div class="card-body live-dark">
                            @if (session('message') == MSG_UPDATE_SUCCESS)
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Data Updated Successfully!..</div>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                            aria-label="Close"fdprocessedid="wsb8o"></button>
                                    </div>
                                    <div>
                                    @else
                                        <div id="liveAlertPlaceholder">
                                            <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                                <div class="text-truncate">Error In Update!..</div>
                                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                    aria-label="Close" fdprocessedid="wsb8o"></button>
                                            </div>
                                            <div>
                            @endforelse
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <div class="wizard-header">
                                <div class="wizard-step active" data-step="0">
                                    <div class="icon material-icons">person</div>
                                    <div>Genreal Details</div>
                                </div>
                                <div class="wizard-step" data-step="1">
                                    <div class="icon material-icons">local_shipping</div>
                                    <div>Business Details</div>
                                </div>
                                <div class="wizard-step" data-step="2">
                                    <div class="icon material-icons">payments</div>
                                    <div>Franchies Detail</div>
                                </div>
                                <div class="wizard-step" data-step="3">
                                    <div class="icon material-icons">check_circle</div>
                                    <div>Property Details</div>
                                </div>
                                <div class="wizard-step" data-step="4">
                                    <div class="icon material-icons">check_circle</div>
                                    <div>Franchisee Training Details</div>
                                </div>
                                <div class="wizard-step" data-step="5">
                                    <div class="icon material-icons">check_circle</div>
                                    <div>Other Details</div>
                                </div>


                            </div>

                            <form id="wizardForm" class="row g-3 needs-validation custom-input" novalidate=""
                                method="POST" action="{{ url(USER_ADMIN_URL . 'franchiseUpdate/' . $getFranchiseData->f_id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_f_main_cat" id="old_f_main_cat"
                                    value="{{ $getFranchiseData->f_main_cat }}">
                                <input type="hidden" name="old_f_sub_cat" id="old_f_sub_cat"
                                    value="{{ $getFranchiseData->f_sub_cat }}">
                                <input type="hidden" name="old_f_child_cat" id="old_f_child_cat"
                                    value="{{ $getFranchiseData->f_child_cat }}">
                                <input type="hidden" name="old_f_company_logo" id="old_f_company_logo"
                                    value="{{ $getFranchiseData->f_company_logo }}">
                                <input type="hidden" name="old_f_company_image" id="old_f_company_image"
                                    value="{{ $getFranchiseData->f_company_image }}">
                                <input type="hidden" name="old_f_franchise_logo" id="old_f_franchise_logo"
                                    value="{{ $getFranchiseData->f_franchise_logo }}">
                                <input type="hidden" name="old_f_franchise_image" id="old_f_franchise_image"
                                    value="{{ $getFranchiseData->f_franchise_image }}">
                                <input type="hidden" name="old_f_franchise_brochure" id="old_f_franchise_brochure"
                                    value="{{ $getFranchiseData->f_franchise_brochure }}">
                                <input type="hidden" name="old_f_begin_expanding_internationally_country"
                                    id="old_f_begin_expanding_internationally_country"
                                    value="{{ $getFranchiseData->f_begin_expanding_internationally_country }}">


                                <input type="hidden" name="old_f_current_franchisee_outlets_located_country"
                                    id="old_f_current_franchisee_outlets_located_country"
                                    value="{{ $getFranchiseData->f_current_franchisee_outlets_located_country }}">

                                <input type="hidden" name="old_f_current_franchisee_outlets_located_state"
                                    id="old_f_current_franchisee_outlets_located_state"
                                    value="{{ $getFranchiseData->f_current_franchisee_outlets_located_state }}">

                                <input type="hidden" name="old_f_current_franchisee_outlets_located_city"
                                    id="old_f_current_franchisee_outlets_located_city"
                                    value="{{ $getFranchiseData->f_current_franchisee_outlets_located_city }}">

                                <div class="step active" data-step="0">
                                    <h2>Genreal Information</h2>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_name">Your Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mt-2" id="f_name" name="f_name"
                                                value="{{ $getFranchiseData->f_name }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_contact_no">Your Contact Number <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control mt-2" id="f_contact_no"
                                                name="f_contact_no" value="{{ $getFranchiseData->f_contact_no }}"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_email">Your Email Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control mt-2" id="f_email" name="f_email"
                                                value="{{ $getFranchiseData->f_email }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_whatsapp_no">Your WhatsApp Number (optional)</label>
                                            <input type="text" class="form-control mt-2" id="f_whatsapp_no"
                                                name="f_whatsapp_no" value="{{ $getFranchiseData->f_whatsapp_no }}">
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <button type="button" disabled>Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>

                                <div class="step" data-step="1">
                                    <h2>Business Details</h2>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_company_name">Company Name*</label>
                                            <input type="text" class="form-control mt-2" id="f_company_name"
                                                name="f_company_name" value="{{ $getFranchiseData->f_company_name }}"
                                                required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_company_designation">Your Designation in Company</label>
                                            <input type="text" class="form-control mt-2" id="f_company_designation"
                                                name="f_company_designation"
                                                value="{{ $getFranchiseData->f_company_designation }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_brand_name">Brand Name</label>
                                            <input type="text" class="form-control mt-2" id="f_brand_name"
                                                name="f_brand_name" value="{{ $getFranchiseData->f_brand_name }}"
                                                required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_owner_name">CEO / MD / Owner Name</label>
                                            <input type="text" class="form-control mt-2" id="f_owner_name"
                                                name="f_owner_name" value="{{ $getFranchiseData->f_owner_name }}"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_owner_contact_no">CEO / MD / Owner Mobile No</label>
                                            <input type="text" class="form-control mt-2" id="f_owner_contact_no"
                                                name="f_owner_contact_no"
                                                value="{{ $getFranchiseData->f_owner_contact_no }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_owner_email">CEO / MD / Owner Email </label>
                                            <input type="email" class="form-control mt-2" id="f_owner_email"
                                                name="f_owner_email" value="{{ $getFranchiseData->f_owner_email }}"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_manager_name">Manager Name </label>
                                            <input type="text" class="form-control mt-2" id="f_manager_name"
                                                name="f_manager_name" value="{{ $getFranchiseData->f_manager_name }}"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_manger_contact_no">Manager Contact </label>
                                            <input type="text" class="form-control mt-2" id="f_manger_contact_no"
                                                name="f_manger_contact_no"
                                                value="{{ $getFranchiseData->f_manger_contact_no }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_manager_email">Manger Email</label>
                                            <input type="email" class="form-control mt-2" id="f_manager_email"
                                                name="f_manager_email" value="{{ $getFranchiseData->f_manager_email }}"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_company_address">Company/Business Head office address</label>
                                            <input type="text" class="form-control mt-2" id="f_company_address"
                                                name="f_company_address"
                                                value="{{ $getFranchiseData->f_company_address }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_country">Country</label>
                                            <input type="text" class="form-control mt-2" id="f_country" name="f_country"
                                                value="{{ $getFranchiseData->f_country }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_state">State</label>
                                            <input type="text" class="form-control mt-2" id="f_state" name="f_state"
                                                value="{{ $getFranchiseData->f_state }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_city">City</label>
                                            <input type="text" class="form-control mt-2" id="f_city" name="f_city"
                                                value="{{ $getFranchiseData->f_city }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_pin_code">Pin Code (Optional)</label>
                                            <input type="text" class="form-control mt-2" id="f_pin_code" name="f_pin_code"
                                                value="{{ $getFranchiseData->f_pin_code }}">
                                        </div>

                                        <div class="col-4">
                                            <label for="f_landline">Landline </label>
                                            <input type="text" class="form-control mt-2" id="f_landline" name="f_landline"
                                                value="{{ $getFranchiseData->f_landline }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_website_url">Business Website URL</label>
                                            <input type="text" class="form-control mt-2" id="f_business_website_url"
                                                name="f_business_website_url"
                                                value="{{ $getFranchiseData->f_business_website_url }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_email">Business Email Address</label>
                                            <input type="text" class="form-control mt-2" id="f_business_email"
                                                name="f_business_email" value="{{ $getFranchiseData->f_business_email }}"
                                                required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_business_alt_email">Business Alternate Email Address</label>
                                            <input type="text" class="form-control mt-2" id="f_business_alt_email"
                                                name="f_business_alt_email"
                                                value="{{ $getFranchiseData->f_business_alt_email }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_establishment_year">Business Establishment Year</label>
                                            <input type="text" class="form-control mt-2" id="f_business_establishment_year"
                                                name="f_business_establishment_year"
                                                value="{{ $getFranchiseData->f_business_establishment_year }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_year_commenced_business_operations">Year Commenced Business
                                                Operations</label>
                                            <select name="f_year_commenced_business_operations" class="form-control mt-2"
                                                required>
                                                <option value="">Select Year</option>
                                                @for ($year = now()->year; $year >= 1900; $year--)
                                                    <option
                                                        @if ($year == $getFranchiseData->f_year_commenced_business_operations) selected style="color:red" @endif
                                                        value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_total_no_company_owned_outlets">Total number of Company owned
                                                Outlets</label>
                                            <select name="f_total_no_company_owned_outlets" class="form-control mt-2" required>
                                                <option value="">Select</option>
                                                <option value="Less than 10"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == 'Less than 10') selected style="color:red" @endif>Less
                                                    than 10</option>

                                                <option value="10 - 20"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == '10 - 20') selected style="color:red" @endif>10 -
                                                    20</option>

                                                <option value="20 - 50"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == '20 - 50') selected style="color:red" @endif>20 -
                                                    50</option>

                                                <option value="50 - 100"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == '50 - 100') selected style="color:red" @endif>50 -
                                                    100</option>

                                                <option value="100 - 200"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == '100 - 200') selected style="color:red" @endif>100
                                                    - 200</option>

                                                <option value="200 - 500"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == '200 - 500') selected style="color:red" @endif>200
                                                    - 500</option>

                                                <option value="500 - 1000"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == '500 - 1000') selected style="color:red" @endif>500
                                                    - 1000</option>

                                                <option value="1000 - 10000"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == '1000 - 10000') selected style="color:red" @endif>
                                                    1000 - 10000</option>

                                                <option value="More than 10000"
                                                    @if ($getFranchiseData->f_total_no_company_owned_outlets == 'More than 10000') selected style="color:red" @endif>
                                                    More than 10000</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="f_business_desc">About Business/Brand</label>
                                            <textarea class="form-control mt-2" cols="5" rows="5" id="f_business_desc" name="f_business_desc" required>{{ $getFranchiseData->f_business_desc }}</textarea>
                                        </div>

                                    </div>

                                    <div class="buttons">
                                        <button type="button" onclick="prevStep()">Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>

                                <div class="step" data-step="2">
                                    <h2>Franchies Detail</h2>
                                    <br>
                                    <div class="card">
                                        <div class="card-body checkbox-checked">
                                            <div class="row with-forms">
                                                <div class="col-md-4">
                                                    <h5>Selected Main Category : <br><span
                                                            style="color:#3fb4e4">{{ $getFranchiseData->f_main_cat }}</span>
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5>Selected Sub Category : <br><span
                                                            style="color:#3fb4e4">{{ $getFranchiseData->f_sub_cat }}</span>
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5>Selected Child Category : <br><span
                                                            style="color:#3fb4e4">{{ $getFranchiseData->f_child_cat }}</span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_franchisee_name">Franchisee Name</label>
                                            <input type="text" class="form-control mt-2" id="f_franchisee_name"
                                                name="f_franchisee_name"
                                                value="{{ $getFranchiseData->f_franchisee_name }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_year_commenced_franchising">Year Commenced Franchising</label>
                                            <select name="f_year_commenced_franchising" class="form-control mt-2" required>
                                                <option value="">Select Year</option>
                                                @for ($year = now()->year; $year >= 1900; $year--)
                                                    <option
                                                        @if ($year == $getFranchiseData->f_year_commenced_franchising) selected style="color:red" @endif
                                                        value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_website_url">Franchise Website URL</label>
                                            <input type="text" class="form-control mt-2" id="f_franchise_website_url"
                                                name="f_franchise_website_url"
                                                value="{{ $getFranchiseData->f_franchisee_name }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_main_cat">Industry / Main Category</label>
                                            <select name="f_main_cat" class="form-control mt-2" id="catmain_id">
                                                <option value="">Select</option>
                                                @foreach ($mainCategoryData as $mainCategoryRow)
                                                    <option value="{{ $mainCategoryRow['fcm_id'] }}">
                                                        {{ $mainCategoryRow['fcm_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_sub_cat">Sector / Sub Category </label>
                                            <select name="f_sub_cat" class="form-control mt-2" id="catsub_id">
                                                <option selected="" disabled="" value="">Choose...</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_child_cat">Product / Service</label>
                                            <select name="f_child_cat" class="form-control mt-2" id="catchild_id">
                                                <option selected="" disabled="" value="">Choose...</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_total_no_franchise_outlets_opened">The total number of franchise
                                                outlets that have opened</label>
                                            <select name="f_total_no_franchise_outlets_opened" class="form-control mt-2"
                                                required>
                                                <option value="">Select</option>
                                                <option value="Less than 10"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == 'Less than 10') selected style="color:red" @endif>
                                                    Less than 10</option>

                                                <option value="10 - 20"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == '10 - 20') selected style="color:red" @endif>10
                                                    - 20</option>

                                                <option value="20 - 50"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == '20 - 50') selected style="color:red" @endif>20
                                                    - 50</option>

                                                <option value="50 - 100"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == '50 - 100') selected style="color:red" @endif>50
                                                    - 100</option>

                                                <option value="100 - 200"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == '100 - 200') selected style="color:red" @endif>
                                                    100 - 200</option>

                                                <option value="200 - 500"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == '200 - 500') selected style="color:red" @endif>
                                                    200 - 500</option>

                                                <option value="500 - 1000"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == '500 - 1000') selected style="color:red" @endif>
                                                    500 - 1000</option>

                                                <option value="1000 - 10000"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == '1000 - 10000') selected style="color:red" @endif>
                                                    1000 - 10000</option>

                                                <option value="More than 10000"
                                                    @if ($getFranchiseData->f_total_no_franchise_outlets_opened == 'More than 10000') selected style="color:red" @endif>
                                                    More than 10000</option>

                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_current_franchisee_outlets_located_country">Current Franchisee
                                                Outlets are located in Country <br>(<span
                                                    style="color: red; font-weight:500">Selected:
                                                    <?= $getFranchiseData->f_current_franchisee_outlets_located_country ?>
                                                </span>)</label>
                                            <select name="f_current_franchisee_outlets_located_country" id="country"
                                                class="form-control mt-2">
                                                <option value="">Select Country</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_current_franchisee_outlets_located_state">Current Franchisee
                                                Outlets are located in State <br>(<span
                                                    style="color: red; font-weight:500">Selected:
                                                    <?= $getFranchiseData->f_current_franchisee_outlets_located_state ?>
                                                </span>)</label>
                                            <select name="f_current_franchisee_outlets_located_state" id="state"
                                                class="form-control mt-2">
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_current_franchisee_outlets_located_city">Current Franchisee
                                                Outlets are located in City <br>(<span
                                                    style="color: red; font-weight:500">Selected:
                                                    <?= $getFranchiseData->f_current_franchisee_outlets_located_city ?>
                                                </span>)</label>
                                            <select name="f_current_franchisee_outlets_located_city" id="city"
                                                class="form-control mt-2">
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_marketing_materials_available">Marketing Materials
                                                Available</label>
                                            <input type="radio" name="f_marketing_materials_available" value="YES"
                                                @if ($getFranchiseData->f_marketing_materials_available == 'YES') checked @endif> Yes &emsp; <input
                                                type="radio" name="f_marketing_materials_available" value="NO"
                                                @if ($getFranchiseData->f_marketing_materials_available == 'NO') checked @endif> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_grant_unit_exclusive_territorial_rights">Does a
                                                franchise grant a unit exclusive territorial rights?</label>
                                            <input type="radio"
                                                name="f_franchise_grant_unit_exclusive_territorial_rights" value="YES"
                                                @if ($getFranchiseData->f_franchise_grant_unit_exclusive_territorial_rights == 'YES') checked @endif> Yes &emsp; <input
                                                type="radio" name="f_franchise_grant_unit_exclusive_territorial_rights"
                                                value="NO" @if ($getFranchiseData->f_franchise_grant_unit_exclusive_territorial_rights == 'NO') checked @endif> No
                                        </div>

                                        <div class="col-4">
                                            <label for="f_performance_guarantees_unit_franchisees">Are there any
                                                performance guarantees given to unit franchisees? </label>
                                            <input type="radio" name="f_performance_guarantees_unit_franchisees"
                                                value="YES" @if ($getFranchiseData->f_performance_guarantees_unit_franchisees == 'YES') checked @endif> Yes
                                            &emsp; <input type="radio" name="f_performance_guarantees_unit_franchisees"
                                                value="NO" @if ($getFranchiseData->f_performance_guarantees_unit_franchisees == 'NO') checked @endif> No
                                        </div>

                                        <div class="col-4">
                                            <label for="f_marketing_advertising_levies_payable_franchisor">Are there any
                                                marketing/advertising levies payable to the franchisor?</label>
                                            <input type="radio" name="f_marketing_advertising_levies_payable_franchisor"
                                                value="YES" @if ($getFranchiseData->f_marketing_advertising_levies_payable_franchisor == 'YES   ') checked @endif> Yes
                                            &emsp; <input type="radio"
                                                name="f_marketing_advertising_levies_payable_franchisor" value="NO"
                                                @if ($getFranchiseData->f_marketing_advertising_levies_payable_franchisor == 'NO') checked @endif> No
                                        </div>

                                        <div class="col-4">
                                            <label for="f_amount_investment_franchisee">An amount of investment is needed
                                                for the franchisee. </label>
                                            <input type="text" class="form-control mt-2"
                                                id="f_amount_investment_franchisee" name="f_amount_investment_franchisee"
                                                value="{{ $getFranchiseData->f_amount_investment_franchisee }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_franchisee_brand_fee">Franchisee/Brand Fee</label>
                                            <input type="text" class="form-control mt-2" id="f_franchisee_brand_fee"
                                                name="f_franchisee_brand_fee"
                                                value="{{ $getFranchiseData->f_franchisee_brand_fee }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_multi_units_brand_fee">Multi Units / Brand Fee</label>
                                            <input type="text" class="form-control mt-2" id="f_multi_units_brand_fee"
                                                name="f_multi_units_brand_fee"
                                                value="{{ $getFranchiseData->f_multi_units_brand_fee }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_royalty_commission">Royalty / Commission %</label>
                                            <input type="text" class="form-control mt-2" id="f_royalty_commission"
                                                name="f_royalty_commission"
                                                value="{{ $getFranchiseData->f_royalty_commission }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_return_investment_anticipated">How much of a return on investment
                                                is anticipated?</label>
                                            <input type="text" class="form-control mt-2"
                                                id="f_return_investment_anticipated"
                                                name="f_return_investment_anticipated"
                                                value="{{ $getFranchiseData->f_return_investment_anticipated }}" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="email">What is the expected payback period of capital for a
                                                franchised unit?</label>
                                            <div class="input-group mb-3">

                                                <span class="input-group-text">
                                                    <span class="material-icons">calendar_today</span>
                                                </span>

                                                <select class="form-select"
                                                    name="f_expected_payback_period_capital_franchised_unit_no" required>
                                                    @for ($i = 0; $i <= 10; $i++)
                                                        <option
                                                            @if ($getFranchiseData->f_expected_payback_period_capital_franchised_unit_no == $i) selected style="color:red" @endif
                                                            value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>

                                                <select class="form-select"
                                                    name="f_expected_payback_period_capital_franchised_unit_month"
                                                    required>
                                                    <option value="">Max</option>
                                                    @for ($j = 1; $j <= 12; $j++)
                                                        <option
                                                            @if ($getFranchiseData->f_expected_payback_period_capital_franchised_unit_month == $j) selected style="color:red" @endif
                                                            value="{{ $j }}">{{ $j }}</option>
                                                    @endfor
                                                </select>

                                                <!-- Month/Year Dropdown -->
                                                <select class="form-select"
                                                    name="f_expected_payback_period_capital_franchised_unit_year" required>
                                                    <option
                                                        @if ($getFranchiseData->f_expected_payback_period_capital_franchised_unit_year == 'month') selected style="color:red" @endif
                                                        value="month">Month</option>
                                                    <option
                                                        @if ($getFranchiseData->f_expected_payback_period_capital_franchised_unit_year == 'year') selected style="color:red" @endif
                                                        value="year">Year</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_further_investment_requirements">Are there any further investment
                                                requirements?</label>
                                            <input type="text" class="form-control mt-2"
                                                id="f_further_investment_requirements"
                                                name="f_further_investment_requirements"
                                                value="{{ $getFranchiseData->f_further_investment_requirements }}"
                                                required>
                                        </div>

                                        <div class="col-6">
                                            <label>In which Country/State/City the Franchisee is available? (<a
                                                    href="#" data-bs-toggle="modal"
                                                    data-bs-target=".location-details-modal" style="color: red">View
                                                    Location Detail</a>) </label>
                                            <button type="button" class="btn btn-primary" onclick="addGroup()">Add
                                                More</button>
                                        </div>
                                        <br><br>
                                        <div id="inputContainer">
                                            <div class="input-group">
                                                <div class="row">
                                                    <div class="col-4 mb-3">
                                                        <input type="text" name="country[]" class="form-control mt-2"
                                                            placeholder="Enter Country Name">
                                                    </div>
                                                    <div class="col-4 mb-3">
                                                        <input type="text" name="state[]" class="form-control mt-2"
                                                            placeholder="Enter State Name">
                                                    </div>
                                                    <div class="col-4 mb-3">
                                                        <input type="text" name="city[]" class="form-control mt-2"
                                                            placeholder="Enter City Name">
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0);" class="text-danger remove-link"
                                                    onclick="removeGroup(this)">🗑 Delete</a>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_provide_aid_financing">Do you provide aid in financing? </label>
                                            <input type="radio" name="f_provide_aid_financing" value="YES"
                                                @if ($getFranchiseData->f_provide_aid_financing == 'YES') checked @endif> Yes &emsp; <input
                                                type="radio" name="f_provide_aid_financing" value="NO"
                                                @if ($getFranchiseData->f_provide_aid_financing == 'NO') checked @endif> No
                                        </div>

                                        <div class="col-4">
                                            <label for="f_begin_expanding_internationally">Would you like to begin
                                                expanding internationally? (<a href="#" data-bs-toggle="modal"
                                                    data-bs-target=".country-details-modal" style="color: red">View
                                                    Country Detail</a>) </label>
                                            <input type="radio" name="f_begin_expanding_internationally" value="YES"
                                                @if ($getFranchiseData->f_begin_expanding_internationally == 'YES') checked @endif
                                                onclick="countryDisplay()"> Yes &emsp; <input type="radio"
                                                name="f_begin_expanding_internationally" value="NO"
                                                onclick="countryDisplay()"
                                                @if ($getFranchiseData->f_begin_expanding_internationally == 'NO') checked @endif> No
                                        </div>

                                        <select id="f_begin_expanding_internationally_country"
                                            @if ($getFranchiseData->f_begin_expanding_internationally == 'YES') style="display: block;" @else style="display: none;" @endif
                                            name="f_begin_expanding_internationally_country[]" multiple
                                            class="form-control mt-2">
                                            <option value="">-- Select Country --</option>
                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Afghanistan') selected style="color:red" @endif
                                                value="Afghanistan">Afghanistan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Albania') selected style="color:red" @endif
                                                value="Albania">Albania</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Algeria') selected style="color:red" @endif
                                                value="Algeria">Algeria</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Andorra') selected style="color:red" @endif
                                                value="Andorra">Andorra</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Angola') selected style="color:red" @endif
                                                value="Angola">Angola</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Argentina') selected style="color:red" @endif
                                                value="Argentina">Argentina</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Armenia') selected style="color:red" @endif
                                                value="Armenia">Armenia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Australia') selected style="color:red" @endif
                                                value="Australia">Australia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Austria') selected style="color:red" @endif
                                                value="Austria">Austria</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Azerbaijan') selected style="color:red" @endif
                                                value="Azerbaijan">Azerbaijan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Bahamas') selected style="color:red" @endif
                                                value="Bahamas">Bahamas</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Bahrain') selected style="color:red" @endif
                                                value="Bahrain">Bahrain</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Bangladesh') selected style="color:red" @endif
                                                value="Bangladesh">Bangladesh</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Barbados') selected style="color:red" @endif
                                                value="Barbados">Barbados</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Belarus') selected style="color:red" @endif
                                                value="Belarus">Belarus</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Belgium') selected style="color:red" @endif
                                                value="Belgium">Belgium</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Belize') selected style="color:red" @endif
                                                value="Belize">Belize</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Benin') selected style="color:red" @endif
                                                value="Benin">Benin</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Bhutan') selected style="color:red" @endif
                                                value="Bhutan">Bhutan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Bolivia') selected style="color:red" @endif
                                                value="Bolivia">Bolivia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Bosnia and Herzegovina') selected style="color:red" @endif
                                                value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Botswana') selected style="color:red" @endif
                                                value="Botswana">Botswana</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Brazil') selected style="color:red" @endif
                                                value="Brazil">Brazil</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Brunei') selected style="color:red" @endif
                                                value="Brunei">Brunei</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Bulgaria') selected style="color:red" @endif
                                                value="Bulgaria">Bulgaria</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Burkina Faso') selected style="color:red" @endif
                                                value="Burkina Faso">Burkina Faso</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Burundi') selected style="color:red" @endif
                                                value="Burundi">Burundi</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Cambodia') selected style="color:red" @endif
                                                value="Cambodia">Cambodia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Cameroon') selected style="color:red" @endif
                                                value="Cameroon">Cameroon</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Canada') selected style="color:red" @endif
                                                value="Canada">Canada</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Chad') selected style="color:red" @endif
                                                value="Chad">Chad</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Chile') selected style="color:red" @endif
                                                value="Chile">Chile</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'China') selected style="color:red" @endif
                                                value="China">China</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Colombia') selected style="color:red" @endif
                                                value="Colombia">Colombia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Comoros') selected style="color:red" @endif
                                                value="Comoros">Comoros</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Costa Rica') selected style="color:red" @endif
                                                value="Costa Rica">Costa Rica</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Croatia') selected style="color:red" @endif
                                                value="Croatia">Croatia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Cuba') selected style="color:red" @endif
                                                value="Cuba">Cuba</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Cyprus') selected style="color:red" @endif
                                                value="Cyprus">Cyprus</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Czech Republic') selected style="color:red" @endif
                                                value="Czech Republic">Czech Republic</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Denmark') selected style="color:red" @endif
                                                value="Denmark">Denmark</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Dominica') selected style="color:red" @endif
                                                value="Dominica">Dominica</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Dominican Republic') selected style="color:red" @endif
                                                value="Dominican Republic">Dominican Republic</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Ecuador') selected style="color:red" @endif
                                                value="Ecuador">Ecuador</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Egypt') selected style="color:red" @endif
                                                value="Egypt">Egypt</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'El Salvador') selected style="color:red" @endif
                                                value="El Salvador">El Salvador</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Estonia') selected style="color:red" @endif
                                                value="Estonia">Estonia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Ethiopia') selected style="color:red" @endif
                                                value="Ethiopia">Ethiopia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Fiji') selected style="color:red" @endif
                                                value="Fiji">Fiji</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Finland') selected style="color:red" @endif
                                                value="Finland">Finland</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'France') selected style="color:red" @endif
                                                value="France">France</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Gabon') selected style="color:red" @endif
                                                value="Gabon">Gabon</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Gambia') selected style="color:red" @endif
                                                value="Gambia">Gambia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Georgia') selected style="color:red" @endif
                                                value="Georgia">Georgia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Germany') selected style="color:red" @endif
                                                value="Germany">Germany</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Ghana') selected style="color:red" @endif
                                                value="Ghana">Ghana</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Greece') selected style="color:red" @endif
                                                value="Greece">Greece</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Grenada') selected style="color:red" @endif
                                                value="Grenada">Grenada</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Guatemala') selected style="color:red" @endif
                                                value="Guatemala">Guatemala</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Guinea') selected style="color:red" @endif
                                                value="Guinea">Guinea</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Guyana') selected style="color:red" @endif
                                                value="Guyana">Guyana</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Haiti') selected style="color:red" @endif
                                                value="Haiti">Haiti</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Honduras') selected style="color:red" @endif
                                                value="Honduras">Honduras</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Hungary') selected style="color:red" @endif
                                                value="Hungary">Hungary</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Iceland') selected style="color:red" @endif
                                                value="Iceland">Iceland</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'India') selected style="color:red" @endif
                                                value="India">India</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Indonesia') selected style="color:red" @endif
                                                value="Indonesia">Indonesia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Iran') selected style="color:red" @endif
                                                value="Iran">Iran</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Iraq') selected style="color:red" @endif
                                                value="Iraq">Iraq</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Ireland') selected style="color:red" @endif
                                                value="Ireland">Ireland</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Israel') selected style="color:red" @endif
                                                value="Israel">Israel</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Italy') selected style="color:red" @endif
                                                value="Italy">Italy</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Jamaica') selected style="color:red" @endif
                                                value="Jamaica">Jamaica</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Japan') selected style="color:red" @endif
                                                value="Japan">Japan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Jordan') selected style="color:red" @endif
                                                value="Jordan">Jordan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Kazakhstan') selected style="color:red" @endif
                                                value="Kazakhstan">Kazakhstan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Kenya') selected style="color:red" @endif
                                                value="Kenya">Kenya</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Kuwait') selected style="color:red" @endif
                                                value="Kuwait">Kuwait</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Kyrgyzstan') selected style="color:red" @endif
                                                value="Kyrgyzstan">Kyrgyzstan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Laos') selected style="color:red" @endif
                                                value="Laos">Laos</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Latvia') selected style="color:red" @endif
                                                value="Latvia">Latvia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Lebanon') selected style="color:red" @endif
                                                value="Lebanon">Lebanon</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Lesotho') selected style="color:red" @endif
                                                value="Lesotho">Lesotho</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Liberia') selected style="color:red" @endif
                                                value="Liberia">Liberia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Libya') selected style="color:red" @endif
                                                value="Libya">Libya</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Lithuania') selected style="color:red" @endif
                                                value="Lithuania">Lithuania</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Luxembourg') selected style="color:red" @endif
                                                value="Luxembourg">Luxembourg</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Madagascar') selected style="color:red" @endif
                                                value="Madagascar">Madagascar</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Malawi') selected style="color:red" @endif
                                                value="Malawi">Malawi</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Malaysia') selected style="color:red" @endif
                                                value="Malaysia">Malaysia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Maldives') selected style="color:red" @endif
                                                value="Maldives">Maldives</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Mali') selected style="color:red" @endif
                                                value="Mali">Mali</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Malta') selected style="color:red" @endif
                                                value="Malta">Malta</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Mauritania') selected style="color:red" @endif
                                                value="Mauritania">Mauritania</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Mauritius') selected style="color:red" @endif
                                                value="Mauritius">Mauritius</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Mexico') selected style="color:red" @endif
                                                value="Mexico">Mexico</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Moldova') selected style="color:red" @endif
                                                value="Moldova">Moldova</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Monaco') selected style="color:red" @endif
                                                value="Monaco">Monaco</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Mongolia') selected style="color:red" @endif
                                                value="Mongolia">Mongolia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Montenegro') selected style="color:red" @endif
                                                value="Montenegro">Montenegro</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Morocco') selected style="color:red" @endif
                                                value="Morocco">Morocco</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Mozambique') selected style="color:red" @endif
                                                value="Mozambique">Mozambique</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Myanmar') selected style="color:red" @endif
                                                value="Myanmar">Myanmar</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Namibia') selected style="color:red" @endif
                                                value="Namibia">Namibia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Nepal') selected style="color:red" @endif
                                                value="Nepal">Nepal</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Netherlands') selected style="color:red" @endif
                                                value="Netherlands">Netherlands</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'New Zealand') selected style="color:red" @endif
                                                value="New Zealand">New Zealand</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Nicaragua') selected style="color:red" @endif
                                                value="Nicaragua">Nicaragua</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Niger') selected style="color:red" @endif
                                                value="Niger">Niger</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Nigeria') selected style="color:red" @endif
                                                value="Nigeria">Nigeria</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'North Korea') selected style="color:red" @endif
                                                value="North Korea">North Korea</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Norway') selected style="color:red" @endif
                                                value="Norway">Norway</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Oman') selected style="color:red" @endif
                                                value="Oman">Oman</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Pakistan') selected style="color:red" @endif
                                                value="Pakistan">Pakistan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Palestine') selected style="color:red" @endif
                                                value="Palestine">Palestine</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Panama') selected style="color:red" @endif
                                                value="Panama">Panama</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Paraguay') selected style="color:red" @endif
                                                value="Paraguay">Paraguay</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Peru') selected style="color:red" @endif
                                                value="Peru">Peru</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Philippines') selected style="color:red" @endif
                                                value="Philippines">Philippines</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Poland') selected style="color:red" @endif
                                                value="Poland">Poland</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Portugal') selected style="color:red" @endif
                                                value="Portugal">Portugal</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Qatar') selected style="color:red" @endif
                                                value="Qatar">Qatar</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Romania') selected style="color:red" @endif
                                                value="Romania">Romania</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Russia') selected style="color:red" @endif
                                                value="Russia">Russia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Rwanda') selected style="color:red" @endif
                                                value="Rwanda">Rwanda</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Saudi Arabia') selected style="color:red" @endif
                                                value="Saudi Arabia">Saudi Arabia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Senegal') selected style="color:red" @endif
                                                value="Senegal">Senegal</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Serbia') selected style="color:red" @endif
                                                value="Serbia">Serbia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Singapore') selected style="color:red" @endif
                                                value="Singapore">Singapore</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Slovakia') selected style="color:red" @endif
                                                value="Slovakia">Slovakia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Slovenia') selected style="color:red" @endif
                                                value="Slovenia">Slovenia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Somalia') selected style="color:red" @endif
                                                value="Somalia">Somalia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'South Africa') selected style="color:red" @endif
                                                value="South Africa">South Africa</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'South Korea') selected style="color:red" @endif
                                                value="South Korea">South Korea</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Spain') selected style="color:red" @endif
                                                value="Spain">Spain</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Sri Lanka') selected style="color:red" @endif
                                                value="Sri Lanka">Sri Lanka</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Sudan') selected style="color:red" @endif
                                                value="Sudan">Sudan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Sweden') selected style="color:red" @endif
                                                value="Sweden">Sweden</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Switzerland') selected style="color:red" @endif
                                                value="Switzerland">Switzerland</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Syria') selected style="color:red" @endif
                                                value="Syria">Syria</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Taiwan') selected style="color:red" @endif
                                                value="Taiwan">Taiwan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Tajikistan') selected style="color:red" @endif
                                                value="Tajikistan">Tajikistan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Tanzania') selected style="color:red" @endif
                                                value="Tanzania">Tanzania</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Thailand') selected style="color:red" @endif
                                                value="Thailand">Thailand</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Tunisia') selected style="color:red" @endif
                                                value="Tunisia">Tunisia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Turkey') selected style="color:red" @endif
                                                value="Turkey">Turkey</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Uganda') selected style="color:red" @endif
                                                value="Uganda">Uganda</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Ukraine') selected style="color:red" @endif
                                                value="Ukraine">Ukraine</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'United Arab Emirates') selected style="color:red" @endif
                                                value="United Arab Emirates">United Arab Emirates</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'United Kingdom') selected style="color:red" @endif
                                                value="United Kingdom">United Kingdom</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'United States') selected style="color:red" @endif
                                                value="United States">United States</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Uruguay') selected style="color:red" @endif
                                                value="Uruguay">Uruguay</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Uzbekistan') selected style="color:red" @endif
                                                value="Uzbekistan">Uzbekistan</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Venezuela') selected style="color:red" @endif
                                                value="Venezuela">Venezuela</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Vietnam') selected style="color:red" @endif
                                                value="Vietnam">Vietnam</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Yemen') selected style="color:red" @endif
                                                value="Yemen">Yemen</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Zambia') selected style="color:red" @endif
                                                value="Zambia">Zambia</option>

                                            <option @if ($getFranchiseData->f_begin_expanding_internationally_country == 'Zimbabwe') selected style="color:red" @endif
                                                value="Zimbabwe">Zimbabwe</option>
                                        </select>

                                        <div class="col-12">
                                            <label for="f_franchisee_desc">About Franchisee </label>
                                            <textarea class="form-control mt-2" id="editor" name="f_franchisee_desc" required>{{ $getFranchiseData->f_franchisee_desc }}</textarea>
                                        </div>

                                    </div>
                                    <div class="buttons">
                                        <button type="button" onclick="prevStep()">Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>
                                <div class="step" data-step="3">
                                    <h2>Property Details</h2>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_franchise_opportunity">What kind of property is required for this
                                                franchise opportunity? </label>
                                            <select class="form-control mt-2" name="f_franchise_opportunity" required>
                                                <option value=""> Select</option>
                                                <option
                                                    @if ($getFranchiseData->f_franchise_opportunity == 'Domestic') selected style="color:red" @endif
                                                    value="Domestic"> Domestic</option>
                                                <option
                                                    @if ($getFranchiseData->f_franchise_opportunity == 'Comercial') selected style="color:red" @endif
                                                    value="Comercial"> Comercial</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_preferred_location_franchise_outlet">Preferred location for
                                                franchise outlet </label>
                                            <input type="text" class="form-control mt-2"
                                                id="f_preferred_location_franchise_outlet"
                                                name="f_preferred_location_franchise_outlet" required
                                                value="{{ $getFranchiseData->f_preferred_location_franchise_outlet }}">
                                        </div>

                                        <div class="col-4">
                                            <label for="f_floor_area_requirements_franchisee">Floor Area Requirements for
                                                Franchisee </label>
                                            <input type="text" class="form-control mt-2"
                                                id="f_floor_area_requirements_franchisee"
                                                name="f_floor_area_requirements_franchisee" required
                                                value="{{ $getFranchiseData->f_floor_area_requirements_franchisee }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchisee_arrange_furnish_premises">The franchisor or franchisee
                                                will arrange to furnish the premises</label>
                                            <input type="text" class="form-control mt-2"
                                                id="f_franchisee_arrange_furnish_premises"
                                                name="f_franchisee_arrange_furnish_premises" required
                                                value="{{ $getFranchiseData->f_franchisee_arrange_furnish_premises }}">
                                        </div>

                                        <div class="col-4">
                                            <label for="email">Do you offer site selection assistance?</label>
                                            <input type="radio" name="f_offer_site_selection_assistance" value="YES"
                                                @if ($getFranchiseData->f_offer_site_selection_assistance == 'YES') checked @endif> Yes &emsp; <input
                                                type="radio" name="f_offer_site_selection_assistance" value="NO"
                                                @if ($getFranchiseData->f_offer_site_selection_assistance == 'NO') checked @endif> No
                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <button type="button" onclick="prevStep()">Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>

                                <div class="step" data-step="4">
                                    <h2>Franchisee Training Details</h2>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="firstName">Do you currently have complete franchise operation
                                                instructions available?</label>
                                            <input type="radio" name="f_franchise_operation_instructions_available"
                                                value="YES" @if ($getFranchiseData->f_franchise_operation_instructions_available == 'YES') checked @endif> Yes
                                            &emsp; <input type="radio"
                                                name="f_franchise_operation_instructions_available" value="NO"
                                                @if ($getFranchiseData->f_franchise_operation_instructions_available == 'NO') checked @endif> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchisee_training_conducted">Where is franchisee training
                                                conducted?</label>
                                            <input type="text" class="form-control mt-2"
                                                id="f_franchisee_training_conducted"
                                                name="f_franchisee_training_conducted" required
                                                value="{{ $getFranchiseData->f_franchisee_training_conducted }}">
                                        </div>

                                        <div class="col-4">
                                            <label for="f_field_assistance_available_franchises">Is there any field
                                                assistance available for franchises? Yes or No </label>
                                            <input type="radio" name="f_field_assistance_available_franchises"
                                                value="YES" @if ($getFranchiseData->f_field_assistance_available_franchises == 'YES') checked @endif> Yes
                                            &emsp; <input type="radio" name="f_field_assistance_available_franchises"
                                                value="NO" @if ($getFranchiseData->f_field_assistance_available_franchises == 'NO') checked @endif> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_office_support_franchisee_opening_franchise">Will the head office
                                                support the franchisee in opening the franchise? </label>
                                            <input type="radio" name="f_office_support_franchisee_opening_franchise"
                                                value="YES" @if ($getFranchiseData->f_office_support_franchisee_opening_franchise == 'YES') checked @endif> Yes
                                            &emsp; <input type="radio"
                                                name="f_office_support_franchisee_opening_franchise" value="NO"
                                                @if ($getFranchiseData->f_office_support_franchisee_opening_franchise == 'NO') checked @endif> No
                                        </div>

                                        <div class="col-4">
                                            <label for="f_it_systems_presently_included_franchise">What IT systems do you
                                                presently have that will be included in the franchise?</label>
                                            <input type="radio" name="f_it_systems_presently_included_franchise"
                                                value="YES" @if ($getFranchiseData->f_it_systems_presently_included_franchise == 'YES') checked @endif> Yes
                                            &emsp; <input type="radio" name="f_it_systems_presently_included_franchise"
                                                value="NO" @if ($getFranchiseData->f_it_systems_presently_included_franchise == 'NO') checked @endif> No
                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <button type="button" onclick="prevStep()">Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>


                                <div class="step" data-step="5">
                                    <h2>Other Details</h2>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_standard_franchise_agreement">Do you provide a standard franchise
                                                agreement?</label>
                                            <input type="radio" name="f_standard_franchise_agreement" value="YES"
                                                @if ($getFranchiseData->f_standard_franchise_agreement == 'YES') checked @endif> Yes &emsp; <input
                                                type="radio" name="f_standard_franchise_agreement" value="NO"
                                                @if ($getFranchiseData->f_standard_franchise_agreement == 'NO') checked @endif> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_contract_last">How long will the franchise contract last? </label>
                                            <input type="radio" name="f_franchise_contract_last" onclick="franchiseContract()" value="YES" 
                                            @if ($getFranchiseData->f_franchise_contract_last == 'YES') checked @endif> Life time &emsp;
                                            
                                            <input type="radio" name="f_franchise_contract_last" value="NO" onclick="franchiseContract()"
                                                @if ($getFranchiseData->f_franchise_contract_last == 'NO') checked @endif> Calendar
                                        </div>
                                        <div class="col-4" id="f_franchise_contract_last_value" @if($getFranchiseData->f_franchise_contract_last == 'NO') style="display: block;" @else style="display: none;" @endif>
                                            <label for="f_franchise_contract_last_value">Calendar Value </label>
                                            <select class="form-control mt-2" name="f_franchise_contract_last_value">
                                                <option value="">Select</option>
                                                <option value="1"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 1) selected style="color:red" @endif>
                                                    1</option>
                                                <option value="2"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 2) selected style="color:red" @endif>
                                                    2</option>
                                                <option value="3"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 3) selected style="color:red" @endif>
                                                    3</option>
                                                <option value="4"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 4) selected style="color:red" @endif>
                                                    4</option>
                                                <option value="5"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 5) selected style="color:red" @endif>
                                                    5</option>
                                                <option value="6"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 6) selected style="color:red" @endif>
                                                    6</option>
                                                <option value="7"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 7) selected style="color:red" @endif>
                                                    7</option>
                                                <option value="8"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value  == 8) selected style="color:red" @endif>
                                                    8</option>
                                                <option value="9"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value  == 9) selected style="color:red" @endif>
                                                    9</option>
                                                <option value="10"
                                                    @if ($getFranchiseData->f_franchise_contract_last_value == 10) selected style="color:red" @endif>
                                                    10</option>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label for="contact">Is the franchise contract renewable?</label>
                                            <input type="radio" name="f_franchise_contract_renewable" value="YES"
                                                @if ($getFranchiseData->f_franchise_contract_renewable == 'YES') checked @endif> Yes &emsp; <input
                                                type="radio" name="f_franchise_contract_renewable" value="NO"
                                                @if ($getFranchiseData->f_franchise_contract_renewable == 'NO') checked @endif> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_company_logo">Upload Company Logo <a target="_blank"
                                                    href="{{ url('custom-images/franchise-images/' . $getFranchiseData->f_company_logo) }}">
                                                    (View Image)</a> </label>
                                            <input type="file" class="form-control mt-2" id="f_company_logo"
                                                name="f_company_logo">
                                        </div>

                                        <div class="col-4">
                                            <label for="f_company_image">Upload Company Images <a target="_blank"
                                                    href="{{ url('custom-images/franchise-images/' . $getFranchiseData->f_company_image) }}">(View
                                                    Image)</a> </label>
                                            <input type="file" class="form-control mt-2" id="f_company_image"
                                                name="f_company_image">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_logo">Upload Franchisee Logo <a target="_blank"
                                                    href="{{ url('custom-images/franchise-images/' . $getFranchiseData->f_franchise_logo) }}">(View
                                                    Image)</a> </label>
                                            <input type="file" class="form-control mt-2" id="f_franchise_logo"
                                                name="f_franchise_logo">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_image">Upload Franchisee Images <a target="_blank"
                                                    href="{{ url('custom-images/franchise-images/' . $getFranchiseData->f_franchise_image) }}">(View
                                                    Image)</a> </label>
                                            <input type="file" class="form-control mt-2" id="f_franchise_image"
                                                name="f_franchise_image">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_brochure">Upload Franchisee Brochure <a
                                                    target="_blank"
                                                    href="{{ url('custom-images/franchise-images/' . $getFranchiseData->f_franchise_brochure) }}">(View
                                                    Image)</a> </label>
                                            <input type="file" class="form-control mt-2" id="f_franchise_brochure"
                                                name="f_franchise_brochure">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_corporate_video_url">Enter Corporate Video Link</label>
                                            <input type="text" class="form-control mt-2" id="f_corporate_video_url"
                                                name="f_corporate_video_url"
                                                value="{{ $getFranchiseData->f_corporate_video_url }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_facebook_url">Enter Facebook Page Link</label>
                                            <input type="text" class="form-control mt-2" id="f_facebook_url"
                                                name="f_facebook_url" value="{{ $getFranchiseData->f_facebook_url }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_twitter_url">Enter Twitter (X.com) Page Link</label>
                                            <input type="text" class="form-control mt-2" id="f_twitter_url"
                                                name="f_twitter_url" value="{{ $getFranchiseData->f_twitter_url }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_instagram_url">Enter Instagram Page link</label>
                                            <input type="text" class="form-control mt-2" id="f_instagram_url"
                                                name="f_instagram_url" value="{{ $getFranchiseData->f_instagram_url }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_youtube_url">Enter YouTube Link</label>
                                            <input type="text" class="form-control mt-2" id="f_youtube_url"
                                                name="f_youtube_url" value="{{ $getFranchiseData->f_youtube_url }}">
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <button type="button" onclick="prevStep()">Previous</button>
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        initSample();
        jQuery(document).ready(function() {
            jQuery('#catmain_id').change(function() {
                var catmain_id = jQuery(this).val()
                jQuery.ajax({
                    url: "{{ url('user-admin/getFranchiseSubCategory') }}",
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
        });

        jQuery(document).ready(function() {
            jQuery('#catsub_id').change(function() {
                var catmain_id = jQuery('#catmain_id').val()
                var catsub_id = jQuery(this).val()
                jQuery.ajax({
                    url: "{{ url('user-admin/getFranchiseChildCategory') }}",
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&catsub_id=' + catsub_id +
                        '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catchild_id').html(result)
                    }
                });
            });
        });

        let currentStep = 0;
        const steps = document.querySelectorAll('.step');
        const indicators = document.querySelectorAll('.wizard-step');

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle('active', i === index);
                indicators[i].classList.toggle('active', i === index);
            });
        }

        function validateStep(step) {
            const inputs = steps[step].querySelectorAll('input, select, textarea');
            for (let input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return false;
                }
            }
            return true;
        }

        function nextStep() {
            if (!validateStep(currentStep)) return;
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        // document.getElementById('wizardForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     alert('Form submitted successfully!');
        // });

        $(document).ready(function() {
            $.get("https://countriesnow.space/api/v0.1/countries/positions", function(data) {
                let countries = data.data;
                // $('#country').append('<option>Select Country</option>');
                countries.forEach(country => {
                    $('#country').append(
                    `<option value="${country.name}">${country.name}</option>`);
                });
            });

            $('#country').on('change', function() {
                let country = $(this).val();
                $('#state').html('<option>Loading...</option>');
                $('#city').html('<option>Select City</option>');
                $.ajax({
                    url: 'https://countriesnow.space/api/v0.1/countries/states',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        country: country
                    }),
                    success: function(response) {
                        $('#state').html('<option>Select State</option>');
                        response.data.states.forEach(state => {
                            $('#state').append(
                                `<option value="${state.name}">${state.name}</option>`
                                );
                        });
                    }
                });
            });

            $('#state').on('change', function() {
                let country = $('#country').val();
                let state = $(this).val();
                $('#city').html('<option>Loading...</option>');
                $.ajax({
                    url: 'https://countriesnow.space/api/v0.1/countries/state/cities',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        country: country,
                        state: state
                    }),
                    success: function(response) {
                        $('#city').html('<option>Select City</option>');
                        response.data.forEach(city => {
                            $('#city').append(
                                `<option value="${city}">${city}</option>`);
                        });
                    }
                });
            });
        });


        function addGroup() {
            const container = document.getElementById("inputContainer");

            const group = document.createElement("div");
            group.className = "input-group";

            const row = document.createElement("div");
            row.className = "row";

            const fields = [{
                    name: "country[]",
                    placeholder: "Enter Country Name",
                    type: "text"
                },
                {
                    name: "state[]",
                    placeholder: "Enter State Name",
                    type: "text"
                },
                {
                    name: "city[]",
                    placeholder: "Enter City Name",
                    type: "text"
                }
            ];

            fields.forEach(field => {
                const col = document.createElement("div");
                col.className = "col-4 mb-3";

                const input = document.createElement("input");
                input.type = field.type;
                input.name = field.name;
                input.placeholder = field.placeholder;
                input.className = "form-control";
                input.required = true;

                col.appendChild(input);
                row.appendChild(col);
            });

            const deleteLink = document.createElement("a");
            deleteLink.href = "javascript:void(0);";
            deleteLink.className = "text-danger remove-link";
            deleteLink.innerHTML = "🗑 Delete";
            deleteLink.onclick = function() {
                removeGroup(deleteLink);
            };

            group.appendChild(row);
            group.appendChild(deleteLink);
            container.appendChild(group);
        }

        function removeGroup(link) {
            const container = document.getElementById("inputContainer");
            if (container.children.length > 1) {
                link.parentNode.remove();
            } else {
                alert("At least one set of details is required.");
            }
        }

        function countryDisplay() {
            const selected = document.querySelector('input[name="f_begin_expanding_internationally"]:checked').value;
            const extraFields = document.getElementById('f_begin_expanding_internationally_country');

            if (selected === 'YES') {
                extraFields.style.display = 'block';
            } else {
                extraFields.style.display = 'none';
                document.getElementById('f_begin_expanding_internationally_country').value = '';
            }
        }

        function franchiseContract() {
            const selected = document.querySelector('input[name="f_franchise_contract_last"]:checked').value;
            const extraFields = document.getElementById('f_franchise_contract_last_value');
            if (selected === 'NO') {
                extraFields.style.display = 'block';
            } else {
                extraFields.style.display = 'none';
                document.getElementById('f_franchise_contract_last_value').value = '';
            }
        }
    </script>


    <div class="modal fade location-details-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModal">Location Details</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="large-modal-header">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"><center>Sr.NO</center></th>
                                            <th scope="col">Country</th>
                                            <th scope="col">State</th>
                                            <th scope="col">City</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($getFranchiseLocationDetail as $getFranchiseLocationRow)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $i++ }}</center>
                                                </th>
                                                <td>{{ $getFranchiseLocationRow['fld_country'] }}</td>
                                                <td>{{ $getFranchiseLocationRow['fld_state'] }}</td>
                                                <td>{{ $getFranchiseLocationRow['fld_city'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade country-details-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModal">Country Details</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="large-modal-header">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"><center>Sr.NO</center></th>
                                            <th scope="col">Country</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                            $beginExpandingInternationallyCountryData = explode(',', $getFranchiseData->f_begin_expanding_internationally_country);
                                        @endphp
                                        @foreach ($beginExpandingInternationallyCountryData as $beginExpandingInternationallyCountryRow)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $i++ }}</center>
                                                </th>
                                                <td>{{ $beginExpandingInternationallyCountryRow }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
