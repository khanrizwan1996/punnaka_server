@extends('user_admin.layouts.main')
@section('main-container')
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
        <style>
            body {
                
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
                    <h3>Add Franchise</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{ url(USER_ADMIN_URL . 'dashboard') }}">Dashboard</a> / </li>
                            <li class="breadcrumb-item active">Add Franchise</li>
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
                            @if (session('message') == MSG_ADD_SUCCESS)
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Data Inserted Successfully!..</div>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                            aria-label="Close"fdprocessedid="wsb8o"></button>
                                    </div>
                                <div>
                            @else
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Error In Insert!..</div>
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

                            <form id="wizardForm" class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ url(USER_ADMIN_URL.'franchiseStore') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- Step 1: Billing -->
                                <div class="step active" data-step="0">
                                    <h2>Genreal Information</h2>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_name">Your Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mt-2" id="f_name" name="f_name" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_contact_no">Your Contact Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mt-2" id="f_contact_no" name="f_contact_no" required>
                                        </div>
                                    
                                        <div class="col-4">
                                            <label for="f_email">Your Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control mt-2" id="f_email" name="f_email" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_whatsapp_no">Your WhatsApp Number (optional)</label>
                                            <input type="text" class="form-control mt-2" id="f_whatsapp_no" name="f_whatsapp_no">
                                        </div>    
                                    </div>
                                         
                                    <div class="buttons">
                                        <button type="button" disabled>Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>

                                <!-- Step 2: Shipping -->
                                <div class="step" data-step="1">
                                    <h2>Business Details</h2>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_company_name">Company Name*</label>
                                            <input type="text" class="form-control mt-2" id="f_company_name" name="f_company_name" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_company_designation">Your Designation in Company</label>
                                            <input type="text" class="form-control mt-2" id="f_company_designation" name="f_company_designation" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_brand_name">Brand Name</label>
                                            <input type="text" class="form-control mt-2" id="f_brand_name" name="f_brand_name" required>
                                        </div>
                                    
                                        <div class="col-4">
                                            <label for="f_owner_name">CEO / MD / Owner Name</label>
                                            <input type="text" class="form-control mt-2" id="f_owner_name" name="f_owner_name" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_owner_contact_no">CEO / MD / Owner Mobile No</label>
                                            <input type="text" class="form-control mt-2" id="f_owner_contact_no" name="f_owner_contact_no" required
                                               >
                                        </div>
                                        <div class="col-4">
                                            <label for="f_owner_email">CEO / MD / Owner Email </label>
                                            <input type="email" class="form-control mt-2" id="f_owner_email" name="f_owner_email" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_manager_name">Manager Name </label>
                                            <input type="text" class="form-control mt-2" id="f_manager_name" name="f_manager_name" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_manger_contact_no">Manager Contact </label>
                                            <input type="text" class="form-control mt-2" id="f_manger_contact_no" name="f_manger_contact_no" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_manager_email">Manger Email</label>
                                            <input type="email" class="form-control mt-2" id="f_manager_email" name="f_manager_email" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_company_address">Company/Business Head office address</label>
                                            <input type="text" class="form-control mt-2" id="f_company_address" name="f_company_address" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_country">Country</label>
                                            <input type="text" class="form-control mt-2" id="f_country" name="f_country" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_state">State</label>
                                            <input type="text" class="form-control mt-2" id="f_state" name="f_state" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_city">City</label>
                                            <input type="text" class="form-control mt-2" id="f_city" name="f_city" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_pin_code">Pin Code (Optional)</label>
                                            <input type="text" class="form-control mt-2" id="f_pin_code" name="f_pin_code">
                                        </div>
                                       
                                        <div class="col-4">
                                            <label for="f_landline">Landline </label>
                                            <input type="text" class="form-control mt-2" id="f_landline" name="f_landline" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_website_url">Business Website URL</label>
                                            <input type="text" class="form-control mt-2" id="f_business_website_url" name="f_business_website_url" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_email">Business Email Address</label>
                                            <input type="text" class="form-control mt-2" id="f_business_email" name="f_business_email" required>
                                        </div>
                                       
                                        <div class="col-4">
                                            <label for="f_business_alt_email">Business Alternate Email Address</label>
                                            <input type="text" class="form-control mt-2" id="f_business_alt_email" name="f_business_alt_email">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_establishment_year">Business Establishment Year</label>
                                            <input type="text" class="form-control mt-2" id="f_business_establishment_year" name="f_business_establishment_year" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_year_commenced_business_operations">Year Commenced Business Operations</label>
                                            <select name="f_year_commenced_business_operations" class="form-control mt-2" required>
                                                <option value="">Select Year</option>
                                                @for ($year = now()->year; $year >= 1900; $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label for="f_total_no_company_owned_outlets">Total number of Company owned Outlets</label>
                                            <select name="f_total_no_company_owned_outlets" class="form-control mt-2" required>
                                                <option value="">Select</option>
                                                <option value="Less than 10">Less than 10</option>
                                                <option value="10 - 20">10 - 20</option>
                                                <option value="20 - 50">20 - 50</option>
                                                <option value="50 - 100">50 - 100</option>
                                                <option value="100 - 200">100 - 200</option>
                                                <option value="200 - 500">200 - 500</option>
                                                <option value="500 - 1000">500 - 1000</option>
                                                <option value="1000 - 10000">1000 - 10000</option>
                                                <option value="More than 10000">More than 10000</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="f_business_desc">About Business/Brand</label>
                                            <textarea class="form-control mt-2" cols="5" rows="5" id="f_business_desc" name="f_business_desc" required></textarea>
                                        </div>

                                    </div>

                                    <div class="buttons">
                                        <button type="button" onclick="prevStep()">Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>

                                <!-- Step 3: Payment -->
                                <div class="step" data-step="2">
                                    <h2>Franchies Detail</h2>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_franchisee_name">Franchisee Name</label>
                                            <input type="text" class="form-control mt-2" id="f_franchisee_name" name="f_franchisee_name" required>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_year_commenced_franchising">Year Commenced Franchising</label>
                                            <select name="f_year_commenced_franchising" class="form-control mt-2" required>
                                                <option value="">Select Year</option>
                                                @for ($year = now()->year; $year >= 1900; $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_website_url">Franchise Website URL</label>
                                            <input type="text" class="form-control mt-2" id="f_franchise_website_url" name="f_franchise_website_url" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_main_cat">Industry / Main Category</label>
                                            <select name="f_main_cat" class="form-control mt-2" id="catmain_id" required>
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
                                            <select name="f_sub_cat" class="form-control mt-2" id="catsub_id" required>
                                                <option selected="" disabled="" value="">Choose...</option>
                                            </select>
                                        </div>
                                          <div class="col-4">
                                            <label for="f_child_cat">Product / Service</label>
                                            <select name="f_child_cat" class="form-control mt-2" id="catchild_id" required>
                                                <option selected="" disabled="" value="">Choose...</option>
                                            </select>
                                        </div>
                                          <div class="col-4">
                                            <label for="f_total_no_franchise_outlets_opened">The total number of franchise outlets that have opened</label>
                                             <select name="f_total_no_franchise_outlets_opened" class="form-control mt-2" required>
                                                <option value="">Select</option>
                                                <option value="Less than 10">Less than 10</option>
                                                <option value="10 - 20">10 - 20</option>
                                                <option value="20 - 50">20 - 50</option>
                                                <option value="50 - 100">50 - 100</option>
                                                <option value="100 - 200">100 - 200</option>
                                                <option value="200 - 500">200 - 500</option>
                                                <option value="500 - 1000">500 - 1000</option>
                                                <option value="1000 - 10000">1000 - 10000</option>
                                                <option value="More than 10000">More than 10000</option>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label for="f_current_franchisee_outlets_located_country">Current Franchisee Outlets are located in Country</label>
                                             <select name="f_current_franchisee_outlets_located_country" id="country" class="form-control mt-2" required>
                                                <option value="">Select Country</option>
                                            </select>
                                        </div>
                                          <div class="col-4">
                                            <label for="f_current_franchisee_outlets_located_state">Current Franchisee Outlets are located in State</label>
                                             <select name="f_current_franchisee_outlets_located_state" id="state" class="form-control mt-2" required>
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_current_franchisee_outlets_located_city">Current Franchisee Outlets are located in City</label>
                                             <select name="f_current_franchisee_outlets_located_city" id="city" class="form-control mt-2" required>
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                          <div class="col-4">
                                            <label for="f_marketing_materials_available">Marketing Materials Available</label>
                                            <input type="radio" name="f_marketing_materials_available" value="YES"> Yes &emsp; <input type="radio" name="f_marketing_materials_available" value="NO" checked> No
                                        </div>
                                          <div class="col-4">
                                            <label for="f_franchise_grant_unit_exclusive_territorial_rights">Does a franchise grant a unit exclusive territorial rights?</label>
                                           <input type="radio" name="f_franchise_grant_unit_exclusive_territorial_rights" value="YES"> Yes &emsp; <input type="radio" name="f_franchise_grant_unit_exclusive_territorial_rights" value="NO" checked> No
                                        </div>

                                        
                                          <div class="col-4">
                                            <label for="f_performance_guarantees_unit_franchisees">Are there any performance guarantees given to unit franchisees? </label>
                                           <input type="radio" name="f_performance_guarantees_unit_franchisees" value="YES"> Yes &emsp; <input type="radio" name="f_performance_guarantees_unit_franchisees" value="NO" checked> No
                                        </div>

                                        
                                          <div class="col-4">
                                            <label for="f_marketing_advertising_levies_payable_franchisor">Are there any marketing/advertising levies payable to the franchisor?</label>
                                            <input type="radio" name="f_marketing_advertising_levies_payable_franchisor" value="YES"> Yes &emsp; <input type="radio" name="f_marketing_advertising_levies_payable_franchisor" value="NO" checked> No
                                        </div>
                                        
                                          <div class="col-4">
                                            <label for="f_amount_investment_franchisee">An amount of investment is needed for the franchisee. </label>
                                            <input type="text" class="form-control mt-2" id="f_amount_investment_franchisee" name="f_amount_investment_franchisee" required>
                                        </div>
                                        
                                          <div class="col-4">
                                            <label for="f_franchisee_brand_fee">Franchisee/Brand Fee</label>
                                            <input type="text" class="form-control mt-2" id="f_franchisee_brand_fee" name="f_franchisee_brand_fee" required>
                                        </div>
                                        
                                          <div class="col-4">
                                            <label for="f_multi_units_brand_fee">Multi Units / Brand Fee</label>
                                            <input type="text" class="form-control mt-2" id="f_multi_units_brand_fee" name="f_multi_units_brand_fee" required>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label for="f_royalty_commission">Royalty / Commission %</label>
                                            <input type="text" class="form-control mt-2" id="f_royalty_commission" name="f_royalty_commission" required>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label for="f_return_investment_anticipated">How much of a return on investment is anticipated?</label>
                                            <input type="text" class="form-control mt-2" id="f_return_investment_anticipated" name="f_return_investment_anticipated" required>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label for="email">What is the expected payback period of capital for a franchised unit?</label>
                                            <div class="input-group mb-3">
                                                <!-- Calendar Icon -->
                                                <span class="input-group-text">
                                                <span class="material-icons">calendar_today</span>
                                                </span>

                                                <!-- Numeric Dropdown -->
                                                <select class="form-select" name="f_expected_payback_period_capital_franchised_unit_no" required>
                                                @for ($i = 0; $i <= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                                </select>

                                                <!-- Max Dropdown -->
                                                <select class="form-select" name="f_expected_payback_period_capital_franchised_unit_month" required>
                                                <option value="">Max</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                                </select>

                                                <!-- Month/Year Dropdown -->
                                                <select class="form-select" name="f_expected_payback_period_capital_franchised_unit_year" required>
                                                <option value="month">Month</option>
                                                <option value="year">Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label for="f_further_investment_requirements">Are there any further investment requirements?</label>
                                            <input type="text" class="form-control mt-2" id="f_further_investment_requirements" name="f_further_investment_requirements" required>
                                        </div>

                                        <div class="col-6">
                                            <label>In which Country/State/City the Franchisee is available? </label>
                                            <button type="button" class="btn btn-primary" onclick="addGroup()">Add More</button>
                                        </div>
                                        <br><br>
                                        <div id="inputContainer">
                                            <div class="input-group">
                                                <div class="row">
                                                    <div class="col-4 mb-3">
                                                        <input type="text" name="country[]" class="form-control mt-2" placeholder="Enter Country Name" required>
                                                    </div>
                                                    <div class="col-4 mb-3">
                                                        <input type="text" name="state[]" class="form-control mt-2" placeholder="Enter State Name" required>
                                                    </div>
                                                    <div class="col-4 mb-3">
                                                        <input type="text" name="city[]" class="form-control mt-2" placeholder="Enter City Name" required>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0);" class="text-danger remove-link" onclick="removeGroup(this)">🗑 Delete</a>
                                            </div>
                                        </div>
                                     
                                        <div class="col-4">
                                            <label for="f_provide_aid_financing">Do you provide aid in financing?  </label>
                                            <input type="radio" name="f_provide_aid_financing" value="YES"> Yes &emsp; <input type="radio" name="f_provide_aid_financing" value="NO" checked> No
                                        </div>
                                        
                                        <div class="col-4">
                                            <label for="f_begin_expanding_internationally">Would you like to begin expanding internationally?</label>
                                            <input type="radio" name="f_begin_expanding_internationally" value="YES" onclick="countryDisplay()"> Yes &emsp; <input type="radio" name="f_begin_expanding_internationally" value="NO" onclick="countryDisplay()" checked> No
                                        </div>
                                        
                                        <select  id="f_begin_expanding_internationally_country" style="display: none;" name="f_begin_expanding_internationally_country[]" multiple class="form-control mt-2">
                                        <option value="">-- Select Country --</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="North Korea">North Korea</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>

                                        <div class="col-12">
                                            <label for="f_franchisee_desc">About Franchisee </label>
                                            <textarea class="form-control mt-2" id="editor" name="f_franchisee_desc" required></textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="buttons">
                                        <button type="button" onclick="prevStep()">Previous</button>
                                        <button type="button" onclick="nextStep()">Next</button>
                                    </div>
                                </div>

                                <!-- Step 4: Finish -->
                                <div class="step" data-step="3">
                                    <h2>Property Details</h2>
                                    <div class="form-group">
                                        <div class="col-4">
                                            <label for="f_franchise_opportunity">What kind of property is required for this franchise opportunity? </label>
                                            <select class="form-control mt-2" name="f_franchise_opportunity" required>
                                                <option value=""> Select</option>
                                                <option value="Domestic"> Domestic</option>
                                                <option value="Comercial"> Comercial</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_preferred_location_franchise_outlet">Preferred location for franchise outlet </label>
                                            <input type="text" class="form-control mt-2" id="f_preferred_location_franchise_outlet" name="f_preferred_location_franchise_outlet" required>
                                        </div>
                                    
                                        <div class="col-4">
                                            <label for="f_floor_area_requirements_franchisee">Floor Area Requirements for Franchisee </label>
                                            <input type="text" class="form-control mt-2" id="f_floor_area_requirements_franchisee" name="f_floor_area_requirements_franchisee" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchisee_arrange_furnish_premises">The franchisor or franchisee will arrange to furnish the premises</label>
                                            <input type="text" class="form-control mt-2" id="f_franchisee_arrange_furnish_premises" name="f_franchisee_arrange_furnish_premises" required>
                                        </div>

                                          <div class="col-4">
                                            <label for="email">Do you offer site selection assistance?</label>
                                            <input type="radio" name="f_offer_site_selection_assistance" value="YES"> Yes &emsp; <input type="radio" name="f_offer_site_selection_assistance" value="NO" checked> No
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
                                            <label for="firstName">Do you currently have complete franchise operation instructions available?</label>
                                           <input type="radio" name="f_franchise_operation_instructions_available" value="YES"> Yes &emsp; <input type="radio" name="f_franchise_operation_instructions_available" value="NO" checked> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchisee_training_conducted">Where is franchisee training conducted?</label>
                                            <input type="text" class="form-control mt-2" id="f_franchisee_training_conducted" name="f_franchisee_training_conducted"  required>
                                        </div>
                                    
                                        <div class="col-4">
                                            <label for="f_field_assistance_available_franchises">Is there any field assistance available for franchises?  Yes or No </label>
                                            <input type="radio" name="f_field_assistance_available_franchises" value="YES"> Yes &emsp; <input type="radio" name="f_field_assistance_available_franchises" value="NO" checked> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_office_support_franchisee_opening_franchise">Will the head office support the franchisee in opening the franchise?  </label>
                                            <input type="radio" name="f_office_support_franchisee_opening_franchise" value="YES"> Yes &emsp; <input type="radio" name="f_office_support_franchisee_opening_franchise" value="NO" checked> No
                                        </div>

                                         <div class="col-4">
                                            <label for="f_it_systems_presently_included_franchise">What IT systems do you presently have that will be included in the franchise?</label>
                                            <input type="radio" name="f_it_systems_presently_included_franchise" value="YES"> Yes &emsp; <input type="radio" name="f_it_systems_presently_included_franchise" value="NO" checked> No
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
                                            <label for="f_standard_franchise_agreement">Do you provide a standard franchise agreement?</label>
                                           <input type="radio" name="f_standard_franchise_agreement" value="YES"> Yes &emsp; <input type="radio" name="f_standard_franchise_agreement" value="NO" checked> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_contract_last">How long will the franchise contract last? </label>
                                            <input type="radio" name="f_franchise_contract_last" value="YES" onclick="franchiseContractDisplay()"> Life time &emsp; <input type="radio" name="f_franchise_contract_last" value="NO" onclick="franchiseContractDisplay()" checked> Calendar
                                        </div>
                                        <div class="col-4" style="display: none" id="f_franchise_contract_last_value">
                                            <label for="f_franchise_contract_last_value">Calendar Value </label>
                                           <select class="form-control mt-2" name="f_franchise_contract_last_value">
                                            <option value="">Select Value</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                           </select>
                                        </div>
                                    
                                        <div class="col-4">
                                            <label for="contact">Is the franchise contract renewable?</label>
                                            <input type="radio" name="f_franchise_contract_renewable" value="YES"> Yes &emsp; <input type="radio" name="f_franchise_contract_renewable" value="NO" checked> No
                                        </div>
                                        <div class="col-4">
                                            <label for="f_company_logo">Upload Company Logo</label>
                                            <input type="file" class="form-control mt-2" id="f_company_logo" name="f_company_logo" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_company_image">Upload Company Images</label>
                                            <input type="file" class="form-control mt-2" id="f_company_image" name="f_company_image" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_logo">Upload Franchisee Logo</label>
                                            <input type="file" class="form-control mt-2" id="f_franchise_logo" name="f_franchise_logo" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_image">Upload Franchisee Images </label>
                                            <input type="file" class="form-control mt-2" id="f_franchise_image" name="f_franchise_image" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_brochure">Upload Franchisee Brochure</label>
                                            <input type="file" class="form-control mt-2" id="f_franchise_brochure" name="f_franchise_brochure" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="f_corporate_video_url">Enter Corporate Video Link</label>
                                            <input type="text" class="form-control mt-2" id="f_corporate_video_url" name="f_corporate_video_url">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_facebook_url">Enter Facebook Page Link</label>
                                            <input type="text" class="form-control mt-2" id="f_facebook_url" name="f_facebook_url">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_twitter_url">Enter Twitter (X.com) Page Link</label>
                                            <input type="text" class="form-control mt-2" id="f_twitter_url" name="f_twitter_url">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_instagram_url">Enter Instagram Page link</label>
                                            <input type="text" class="form-control mt-2" id="f_instagram_url" name="f_instagram_url">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_youtube_url">Enter YouTube Link</label>
                                            <input type="text" class="form-control mt-2" id="f_youtube_url" name="f_youtube_url">
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
    </script>
    <script>
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
    </script>

    <script>
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
   
    $(document).ready(function () {
        $.get("https://countriesnow.space/api/v0.1/countries/positions", function (data) {
            let countries = data.data;
           // $('#country').append('<option>Select Country</option>');
            countries.forEach(country => {
                $('#country').append(`<option value="${country.name}">${country.name}</option>`);
            });
        });

        $('#country').on('change', function () {
            let country = $(this).val();
            $('#state').html('<option>Loading...</option>');
            $('#city').html('<option>Select City</option>');
            $.ajax({
                url: 'https://countriesnow.space/api/v0.1/countries/states',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ country: country }),
                success: function (response) {
                    $('#state').html('<option>Select State</option>');
                    response.data.states.forEach(state => {
                        $('#state').append(`<option value="${state.name}">${state.name}</option>`);
                    });
                }
            });
        });

        $('#state').on('change', function () {
            let country = $('#country').val();
            let state = $(this).val();
            $('#city').html('<option>Loading...</option>');
            $.ajax({
                url: 'https://countriesnow.space/api/v0.1/countries/state/cities',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ country: country, state: state }),
                success: function (response) {
                    $('#city').html('<option>Select City</option>');
                    response.data.forEach(city => {
                        $('#city').append(`<option value="${city}">${city}</option>`);
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

      const fields = [
        { name: "country[]", placeholder: "Enter Country Name", type: "text" },
        { name: "state[]", placeholder: "Enter State Name", type: "text" },
        { name: "city[]", placeholder: "Enter City Name", type: "text" }
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
      deleteLink.onclick = function () {
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
  
  
  function franchiseContractDisplay() {
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

@endsection
