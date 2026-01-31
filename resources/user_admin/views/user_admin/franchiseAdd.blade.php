@extends('user_admin.layouts.main')
@section('main-container')

    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
        <style>
            .wizard-container {
                display: flex;
                max-width: 100%;
                margin: 20px auto;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .wizard-nav {
                width: 250px;
                background: #2c3e50;
                color: #fff;
                padding: 20px;
                border-radius: 8px 0 0 8px;
            }

            .wizard-step {
                display: flex;
                align-items: center;
                padding: 10px;
                margin-bottom: 10px;
                cursor: pointer;
                transition: background 0.3s;
            }

            .wizard-step.active {
                background: #3498db;
                border-radius: 5px;
            }

            .wizard-step.completed {
                background: #27ae60;
                border-radius: 5px;
            }

            .wizard-step .dot {
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: #ccc;
                margin-right: 10px;
                transition: background 0.3s;
            }

            .wizard-step.active .dot {
                background: #fff;
            }

            .wizard-step.completed .dot {
                background: #fff;
            }

            .wizard-content {
                flex: 1;
                padding: 20px;
                display: none;
            }

            .wizard-content.active {
                display: block;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .wizard-buttons {
                margin-top: 20px;
                text-align: right;
            }

            .wizard-buttons button {
                padding: 10px 20px;
                margin-left: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                background: #3498db;
                color: #fff;
                transition: background 0.3s;
            }

            .wizard-buttons button:hover {
                background: #2980b9;
            }

            .wizard-buttons button:disabled {
                background: #ccc;
                cursor: not-allowed;
            }

            @media (max-width: 768px) {
                .wizard-container {
                    flex-direction: column;
                }

                .wizard-nav {
                    width: 100%;
                    border-radius: 8px 8px 0 0;
                }

                .wizard-step {
                    justify-content: center;
                }
            }

            .error {
                outline: 2px solid red;
                padding: 5px;
                border-radius: 5px;
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
                            <li class="breadcrumb-item"><a href="{{ url(USER_ADMIN_URL . 'dashboard') }}">Dashboard</a> /
                            </li>
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

                    <div class="wizard-container">
                        <aside class="wizard-nav">
                            <div class="wizard-step active" data-step="1">
                                <span>1. Contact Information</span>
                            </div>
                            <div class="wizard-step" data-step="2">
                                <span>2. Business Details</span>
                            </div>
                            <div class="wizard-step" data-step="3">
                                <span>3. Franchise</span>
                            </div>
                            <div class="wizard-step" data-step="4">
                                <span>4. Location Targeting, Support & Training</span>
                            </div>
                            <div class="wizard-step" data-step="5">
                                <span>5. Financial Expectations & Property Details</span>
                            </div>
                            <div class="wizard-step" data-step="6">
                                <span>6. Media & Uploads</span>
                            </div>
                            <div class="wizard-step" data-step="7">
                                <span>7. Additional Information</span>
                            </div>
                            <div class="wizard-step" data-step="8">
                                <span>8. Agreement</span>
                            </div>
                        </aside>

                        <form class="row g-3 needs-validation custom-input" id="wizard-form" novalidate="" method="POST" action="{{ url(USER_ADMIN_URL.'franchiseStore') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="wizard-content-container">
                                <div class="wizard-content active" data-step="1">
                                    <div class="form-group row">                                   
                                        <div class="col-4">
                                            <label class="col-sm-12 col-form-label">Contact Person <span class="req"
                                                    style="color: red">*</span></label>
                                            <input type="text" id="f_name" name="f_name" class="form-control required"
                                                placeholder="Enter Contact Person">
                                        </div>
                                        <div class="col-4">
                                            <label class="col-sm-12 col-form-label">Email Address <span class="req"style="color: red">*</span></label>
                                            <input type="email" id="f_email" name="f_email" class="form-control required"
                                                placeholder="Enter Email Address">
                                        </div>
                                        <div class="col-4">
                                            <label class="col-sm-12 col-form-label">Phone Number <span class="req"
                                                    style="color: red">*</span></label>
                                            <input type="text" id="f_contact_no" name="f_contact_no" class="form-control required"
                                                placeholder="Enter Phone Number">
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label class="col-sm-12 col-form-label">Alternative Contact Number/ WhatsApp Number</label>
                                            <input type="text" id="f_alt_contact_no" name="f_alt_contact_no" class="form-control"
                                                placeholder="Enter Alternative Contact Number/ WhatsApp Number">
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label class="col-sm-12 col-form-label">Website </label>
                                            <input type="text" id="f_website" name="f_website" class="form-control"
                                                placeholder="Enter Website">
                                        </div>
                                        <div class="wizard-buttons">
                                            <button type="button" onclick="checkSelected()" class="wizard-btn next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-content" data-step="2">
                                    <div class="form-group row">
                                        
                                        <div class="col-4">
                                            <label for="f_brand_name">Brand Name <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_brand_name" name="f_brand_name" class="form-control required"
                                                placeholder="Enter Brand Name">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_company_name">Company Name <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_company_name" name="f_company_name" class="form-control required"
                                                placeholder="Enter Company Name">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_year_established">Business Year Established <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_business_year_established" name="f_business_year_established" class="form-control required"
                                                placeholder="Enter Business Year Established">
                                        </div>
                                   
                                        <div class="col-4">
                                            <br>
                                            <label for="f_business_type">Business Type <span class="req"style="color: red">*</span></label>
                                            <input type="checkbox" value="B2B" name="f_business_type[]" style="width: 20px;">B2B
                                            <input type="checkbox" value="B2C" name="f_business_type[]" style="width: 20px;">B2C
                                            <input type="checkbox" value="Both" name="f_business_type[]" style="width: 20px;">Both
                                        </div>
                                   
                                        <div class="col-4">
                                            <br>
                                            <label for="f_main_cat">Sector <span class="req"style="color: red">*</span></label>
                                           <select name="f_main_cat" class="form-control mt-2 required" id="catmain_id">
                                               <option value="">Select</option>
                                                @foreach ($mainCategoryData as $mainCategoryRow)
                                                    <option value="{{ $mainCategoryRow['fcm_id'] }}">
                                                        {{ $mainCategoryRow['fcm_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_sub_cat">Sub Sector <span class="req"style="color: red">*</span></label>
                                           <select name="f_sub_cat" class="form-control mt-2 required" id="catsub_id">
                                                <option selected="" disabled="" value="">Choose...</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-8">
                                            <br>
                                            <label for="f_child_cat">Products & Services Offered <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_child_cat" name="f_child_cat" class="form-control required" placeholder="Enter Products & Services Offered">
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_franchise_website_url">Franchise Website URL <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_franchise_website_url" name="f_franchise_website_url" class="form-control required" placeholder="Enter Franchise Website URL">
                                        </div>

                                        <div class="col-12">
                                            <br>
                                            <label for="f_business_desc">About Business / Brand <span class="req"style="color: red">*</span></label>
                                            <textarea id="f_business_desc" name="f_business_desc" class="form-control required" placeholder="Enter About Business / Brand"  rows="5" cols="5"></textarea>
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_country">Country <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_country" name="f_country" class="form-control required" placeholder="Enter Country" >
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_state">State / Region <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_state" name="f_state" class="form-control required" placeholder="Enter State / Region" >
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_city">City <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_city" name="f_city" class="form-control required" placeholder="Enter City" >
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_pin_code">PIN Code/ ZIP Code <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_pin_code" name="f_pin_code" class="form-control required" placeholder="Enter PIN Code/ ZIP Code">
                                        </div>
                                        <div class="col-12">
                                            <br>
                                            <label for="f_franchisee_address">Full Address <span class="req"style="color: red">*</span></label>
                                            <textarea id="f_franchisee_address" name="f_franchisee_address" class="form-control required" placeholder="Enter Full Address" rows="5" cols="10"></textarea>
                                        </div>

                                    </div>
                                    
                                    
                                    <div class="wizard-buttons">
                                        <button type="button" class="wizard-btn prev">Previous</button>
                                        <button type="button" class="wizard-btn next">Next</button>
                                    </div>

                                </div>
                                <div class="wizard-content" data-step="3">
                                    <div class="form-group row">
                                        <div class="col-4">
                                        <br>
                                        <label for="f_franchisee_type">Franchise Type <span class="req"style="color: red">*</span></label>
                                        <input type="checkbox" name="f_franchisee_type[]" value="Single Unit" style="width: 19px;">Single Unit
                                        <input type="checkbox" name="f_franchisee_type[]" value="Multi-unit" style="width: 19px;">Multi-unit
                                        <input type="checkbox" name="f_franchisee_type[]" value="Master Franchise" style="width: 19px;">Master Franchise
                                        </div>
                                    <div class="col-4">
                                            <br>
                                        <label for="f_franchisee_year_established">Franchisee Year Established <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_franchisee_year_established" name="f_franchisee_year_established" class="form-control required" placeholder="Enter Franchisee Year Established">
                                    </div>

                                    <div class="col-4">
                                            <br>
                                        <label for="f_total_investment">Total Investment <span class="req"style="color: red">*</span> </label>
                                        <input type="text" id="f_total_investment" name="f_total_investment" class="form-control required" placeholder="Enter Total Investment">
                                    </div>
                               
                                    <div class="col-4">
                                            <br>
                                        <label for="f_franchise_fee">Franchise Fee <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_franchise_fee" name="f_franchise_fee" class="form-control required" placeholder="Enter Franchise Fee"  >
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_royalty_fee">Royalty Fee (%) <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_royalty_fee" name="f_royalty_fee" class="form-control required" placeholder="Enter Royalty Fee (%)"  >
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_marketing_fee">Marketing Fee (%) <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_marketing_fee" name="f_marketing_fee" class="form-control required" placeholder="Enter Marketing Fee (%)"  >
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_total_company_owned_outlets">Total Company-Owned Outlets <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_total_company_owned_outlets" name="f_total_company_owned_outlets" class="form-control required" placeholder="Enter Total Company-Owned Outlets"  >
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_total_franchise_outlets_opened">Total Franchise Outlets Opened <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_total_franchise_outlets_opened" name="f_total_franchise_outlets_opened" class="form-control required" placeholder="Enter Total Franchise Outlets Opened"  >
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_other_investment_requirements">Other Investment Requirements? <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_other_investment_requirements" name="f_other_investment_requirements" class="form-control required" placeholder="Enter Other Investment Requirements?"  >
                                    </div>
                               
                                    <div class="col-12">
                                        <br>
                                        <label for="f_franchisee_desc">About Franchisee <span class="req"style="color: red">*</span></label>
                                        <textarea id="editor" name="f_franchisee_desc" class="form-control" placeholder="Enter About Franchisee"rows="5" cols="10"></textarea>
                                    </div>
                                    </div>
                                   
                                    <div class="wizard-buttons">
                                        <button type="button" class="wizard-btn prev">Previous</button>
                                        <button type="button" class="wizard-btn next">Next</button>
                                    </div>
                                </div>

                                 <div class="wizard-content" data-step="4">
                                    <div class="form-group row">
                                        <div class="col-4">
                                        <br>
                                            <label for="password">Available in India?</label>
                                            <select class="form-control required" name="f_available_in_india">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                        <br>
                                            <label for="password">International Expansion? <span class="req"style="color: red">*</span></label>
                                            <select class="form-control required" name="f_international_expansion">
                                                <option value="">Select </option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <br>
                                            <label>Preferred Countries & Cities <span class="req"style="color: red">*</span></label>
                                            <button type="button" class="btn btn-primary" onclick="addGroup()">Add More</button>
                                        </div>
                                        <div id="inputContainer">
                                            <br>
                                            <div class="input-group">
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <input type="text" name="country[]" class="form-control required" placeholder="Enter Country Name">
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <input type="text" name="city[]" class="form-control required" placeholder="Enter City Name">
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0);" class="text-danger remove-link" onclick="removeGroup(this)">&emsp;&emsp;🗑 Delete</a>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_training_provided">Training Provided <span class="req"style="color: red">*</span></label>
                                            <input type="checkbox" name="f_training_provided[]" value="Initial" style="width: 19px;">Initial
                                            <input type="checkbox" name="f_training_provided[]" value="Ongoing" style="width: 19px;">Ongoing
                                            <input type="checkbox" name="f_training_provided[]" value="Marketing" style="width: 19px;">Marketing
                                            <input type="checkbox" name="f_training_provided[]" value="Manuals" style="width: 19px;">Manuals
                                        </div>

                                    <div class="col-4">
                                            <br>
                                        <label for="f_training_duration">Training Duration (Weeks) <span class="req"style="color: red">*</span></label>
                                        <select  id="f_training_duration" name="f_training_duration" class="form-control required">
                                            <option value="">Select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                               
                                    <div class="col-4">
                                            <br>
                                        <label for="f_franchise_fee">Financing Aid? <span class="req"style="color: red">*</span></label>
                                        <select class="form-control required" name="f_financing_aid">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_site_selection_assistance">Site Selection Assistance? <span class="req"style="color: red">*</span></label>
                                         <select class="form-control required" name="f_site_selection_assistance">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_head_office_support_open">Head Office Support to Open? <span class="req"style="color: red">*</span></label>
                                        <select class="form-control required" name="f_head_office_support_open">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                               
                                    <div class="col-4">
                                        <br>
                                        <label for="f_it_systems_included">IT Systems Included? <span class="req"style="color: red">*</span></label>
                                        <select class="form-control required" name="f_it_systems_included">
                                            <option value="">Select </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    </div>
                                   
                                    <div class="wizard-buttons">
                                        <button type="button" class="wizard-btn prev">Previous</button>
                                        <button type="button" class="wizard-btn next">Next</button>
                                    </div>
                                </div>

                                <div class="wizard-content" data-step="5">
                                    <div class="form-group row">                               
                                        <div class="col-4">
                                            <br>
                                            <label for="f_performance_guarantee">Performance Guarantee? <span class="req"style="color: red">*</span></label>
                                            <select class="form-control required" name="f_performance_guarantee">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_expected_roi">Expected ROI <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_expected_roi" name="f_expected_roi" class="form-control required" placeholder="Enter Expected ROI"  >
                                        </div>
                                
                                        <div class="col-4">
                                            <br>
                                            <label for="f_payback_period">Payback Period (Months) <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_payback_period" name="f_payback_period" class="form-control required" placeholder="Payback Period (Months)">
                                        </div>
                                    
                                        <div class="col-4">
                                        <br>
                                            <label for="f_franchise_term_duration">Franchise Term Duration (Years) <span class="req"style="color: red">*</span></label>
                                            <select class="form-control required" name="f_franchise_term_duration">
                                                <option value="">Select</option>
                                                <option value="3 Years">3 Years</option>
                                                <option value="5 Years">5 Years</option>
                                                <option value="10 Years">10 Years</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                        <br>
                                            <label for="f_term_renewable">Is Term Renewable? <span class="req"style="color: red">*</span></label>
                                           <select class="form-control required" name="f_term_renewable">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                        <br>
                                            <label for="f_type_property_required">Type of Property Required <span class="req"style="color: red">*</span></label>
                                            <select class="form-control required" name="f_type_property_required">
                                                <option value="">Select</option>
                                                <option value="Commercial">Commercial</option>
                                                <option value="Non-Commercial">Non-Commercial</option>
                                                <option value="Residential">Residential</option>
                                                <option value="Any">Any</option>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_minimum_area_required">Minimum Area Required <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_minimum_area_required" name="f_minimum_area_required" class="form-control required" placeholder="Enter Minimum Area Required">
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_property_location_preference">Property Location Preference <span class="req"style="color: red">*</span></label>
                                            <input type="text" id="f_property_location_preference" name="f_property_location_preference" class="form-control required" placeholder="Enter Property Location Preference">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_who_will_furnish_premises">Who Will Furnish Premises? <span class="req"style="color: red">*</span></label>
                                            <select class="form-control required" name="f_who_will_furnish_premises">
                                                <option value="">Select</option>
                                                <option value="Franchisor">Franchisor</option>
                                                <option value="Franchisee">Franchisee</option>
                                                <option value="Shared Responsibility">Shared Responsibility</option>
                                            </select>
                                        </div>

                                    </div>
                                   
                                    <div class="wizard-buttons">
                                        <button type="button" class="wizard-btn prev">Previous</button>
                                        <button type="button" class="wizard-btn next">Next</button>
                                    </div>
                                </div>
                               
                                <div class="wizard-content" data-step="6">
                                    <div class="form-group row">                               
                                       
                                          <div class="col-4">
                                            <label for="f_company_logo">Upload Company Logo <span class="req"style="color: red">*</span></label>
                                            <input type="file" class="form-control required" id="f_company_logo" name="f_company_logo">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_franchise_brochure">Upload Franchise Brochure</label>
                                            <input type="file" class="form-control" id="f_franchise_brochure" name="f_franchise_brochure">
                                        </div>
                                        <div class="col-4">
                                            <label for="f_business_registration_certificate">Upload Business Registration Certificate <span class="req"style="color: red">*</span></label>
                                            <input type="file" class="form-control required" id="f_business_registration_certificate" name="f_business_registration_certificate">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_franchise_disclosure_document">Upload Franchise Disclosure Document <span class="req"style="color: red">*</span></label>
                                            <input type="file" class="form-control required" id="f_franchise_disclosure_document" name="f_franchise_disclosure_document">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_products_services">Upload Products & Services File <span class="req"style="color: red">*</span></label>
                                            <input type="file" class="form-control required" id="f_products_services" name="f_products_services">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="franchise_images">Upload Franchisee Outlet Images <span class="req"style="color: red">*</span></label>
                                            <input type="file" class="form-control required" id="franchise_images" name="franchise_images[]" multiple>
                                        </div>

                                        <div class="col-4">
                                            <br>
                                            <label for="f_corporate_video_url">Enter Corporate Video Link</label>
                                            <input type="text" class="form-control" id="f_corporate_video_url" name="f_corporate_video_url" placeholder="Enter Corporate Video Link">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_facebook_url">Enter Facebook Page Link</label>
                                            <input type="text" class="form-control" id="f_facebook_url" name="f_facebook_url" placeholder="Enter Facebook Page Link">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_twitter_url">Enter Twitter (X.com) Page Link</label>
                                            <input type="text" class="form-control" id="f_twitter_url" name="f_twitter_url" placeholder="Enter Twitter (X.com) Page Link">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_instagram_url">Enter Instagram Page link</label>
                                            <input type="text" class="form-control" id="f_instagram_url" name="f_instagram_url" placeholder="Enter Instagram Page link">
                                        </div>
                                        <div class="col-4">
                                            <br>
                                            <label for="f_youtube_url">Enter YouTube Link</label>
                                            <input type="text" class="form-control" id="f_youtube_url" name="f_youtube_url" placeholder="Enter YouTube Link">
                                        </div>

                                    </div>
                                   
                                    <div class="wizard-buttons">
                                        <button type="button" class="wizard-btn prev">Previous</button>
                                        <button type="button" class="wizard-btn next">Next</button>
                                    </div>
                                </div>

                                <div class="wizard-content" data-step="7">
                                   <div class="form-group row">
                                        
                                        <div class="col-12">
                                            <br>
                                            <label for="f_why_choose_you">Why Choose You?</label>
                                            <textarea id="f_why_choose_you" name="f_why_choose_you" class="form-control" placeholder="Enter Why Choose You?"  rows="5" cols="100"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <br>
                                            <label for="f_success_story">Success Story <span class="req"style="color: red">*</span></label>
                                            <textarea id="f_success_story" name="f_success_story" class="form-control" placeholder="Enter Success Story" rows="5" cols="100"></textarea>
                                        </div>
                                    </div>
                                    <div class="wizard-buttons">
                                        <button type="button" class="wizard-btn prev">Previous</button>
                                        <button type="button" class="wizard-btn next">Next</button>
                                    </div>
                                </div>

                                <div class="wizard-content" data-step="8">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Confirm Information is Accurate <span class="req"style="color: red">*</span></label>
                                            <input type="checkbox" id="confirm_information_accurate" style="width: 19px;">Yes
                                            
                                        </div>
                                        <div class="col-12">
                                            <br>
                                            <label>Agree to Terms & Privacy <span class="req"style="color: red">*</span></label>
                                            <input type="checkbox" id="agree_terms_privacy" style="width: 19px;">I confirm that all the information provided above is accurate and truthful to the best of my knowledge. I understand and accept the Terms of Use and Privacy Policy of Punnaka.com and consent to the collection, storage, and use of my data for listing and communication purposes.
                                        </div>
                                    </div>
                                    <div class="wizard-buttons">
                                        <button type="button" class="wizard-btn prev">Previous</button>
                                        <button type="submit" class="wizard-btn finish">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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



        class Wizard {
            constructor() {
                this.form = document.getElementById('wizard-form');
                this.steps = document.querySelectorAll('.wizard-step');
                this.contents = document.querySelectorAll('.wizard-content');
                this.currentStep = 1;
                this.totalSteps = this.steps.length;

                this.steps.forEach(step => {
                    step.addEventListener('click', () => {
                        const stepNumber = parseInt(step.dataset.step);
                        if (step.classList.contains('completed') || step.classList.contains('active')) {
                            this.navigateToStep(stepNumber);
                        }
                    });
                });

                document.querySelectorAll('.wizard-btn').forEach(button => {
                    button.addEventListener('click', (e) => {
                        if (button.classList.contains('next') && this.validateStep(this.currentStep)) {
                            this.navigateToStep(this.currentStep + 1);
                        } else if (button.classList.contains('prev')) {
                            this.navigateToStep(this.currentStep - 1);
                        }
                    });
                });

                this.form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    if (this.validateStep(this.currentStep)) {
                        // Simulate form submission (replace with actual endpoint logic)
                        console.log('Submitting form data:', new FormData(this.form));
                       
                        this.form.submit(); // Uncomment to enable actual form submission
                       
                    }
                });
            }

            validateStep(stepNumber) {
                const content = document.querySelector(`.wizard-content[data-step="${stepNumber}"]`);
                const stepNum = content.getAttribute('data-step');
                const requiredFields = content.querySelectorAll('.required');

                let isValid = true;
                let confirm_information_accurate = document.getElementById("confirm_information_accurate");
                let agree_terms_privacy = document.getElementById("agree_terms_privacy");

                confirm_information_accurate.classList.remove("error");
                agree_terms_privacy.classList.remove("error");
                
                if(stepNum == 8){
                    if(!confirm_information_accurate.checked) {
                        confirm_information_accurate.classList.add("error");
                        return;
                    }
                    if(!agree_terms_privacy.checked) {
                        agree_terms_privacy.classList.add("error");
                        return;
                    }
                }

                requiredFields.forEach(field => {
                    
                    //alert("field.value "+field.value);

                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = 'red';
                    } else {
                        field.style.borderColor = '#ccc';
                    }
                });
                //alert("isValid "+isValid);
                 if (!isValid) {
                    alert('Please fill out all required fields.');
                 }

                return isValid;
            }

            navigateToStep(stepNumber) {
                if (stepNumber < 1 || stepNumber > this.totalSteps) return;

                this.steps.forEach(step => {
                    step.classList.remove('active');
                    if (parseInt(step.dataset.step) < stepNumber) {
                        step.classList.add('completed');
                    } else {
                        step.classList.remove('completed');
                    }
                });

                this.contents.forEach(content => {
                    content.classList.remove('active');
                });

                document.querySelector(`.wizard-step[data-step="${stepNumber}"]`).classList.add('active');
                document.querySelector(`.wizard-content[data-step="${stepNumber}"]`).classList.add('active');

                this.currentStep = stepNumber;

                if (stepNumber === this.totalSteps) {
                    this.updateReview();
                }
            }

            updateReview() {
                document.getElementById('review-name').textContent = document.getElementById('name').value ||
                    'Not provided';
                document.getElementById('review-age').textContent = document.getElementById('age').value ||
                    'Not provided';
                document.getElementById('review-email').textContent = document.getElementById('email').value ||
                    'Not provided';
                document.getElementById('review-phone').textContent = document.getElementById('phone').value ||
                    'Not provided';
                document.getElementById('review-category').textContent = document.getElementById('category').value ||
                    'Not provided';
                document.getElementById('review-comments').textContent = document.getElementById('comments').value ||
                    'Not provided';
            }

            reset() {
                this.navigateToStep(1);
                document.querySelectorAll('input, select, textarea').forEach(field => {
                    field.value = '';
                    field.style.borderColor = '#ccc';
                });
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const wizard = new Wizard();
        });

        function addGroup() {
      const container = document.getElementById("inputContainer");

      const group = document.createElement("div");
      group.className = "input-group";

      const row = document.createElement("div");
      row.className = "row";

      const fields = [
        { name: "country[]", placeholder: "Enter Country Name", type: "text" },
        { name: "city[]", placeholder: "Enter City Name", type: "text" }
      ];

      fields.forEach(field => {
        const col = document.createElement("div");
        col.className = "col-6 mb-3";

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
      deleteLink.innerHTML = "&emsp;&emsp;🗑 Delete";
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

    </script>
@endsection
