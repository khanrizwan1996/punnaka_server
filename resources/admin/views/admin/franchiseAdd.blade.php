@extends('admin.layouts.main')
@section('main-container')
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

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/franchiseList') }}">Franchise List</a></li>
                <li><span>Franchise Add </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Franchise Details</h3>

        @if (session('message'))
            @if (session('message') == MSG_ADD_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data inserted Successfully!..</p>
                </div>
            @else
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In insert!..</p>
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

                    <form class="row g-3 needs-validation custom-input" id="wizard-form" novalidate="" method="POST"
                        action="{{ url(ADMIN_URL . 'franchiseStore') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="wizard-content-container">
                            <div class="wizard-content active" data-step="1">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Contact Person <span class="req"
                                                style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_name" name="f_name" class="md-input required"
                                                placeholder="Enter Contact Person">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Email Address <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="email" id="f_email" name="f_email" class="md-input required"
                                                placeholder="Enter Email Address">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Phone Number <span class="req"
                                                style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_contact_no" name="f_contact_no"
                                                class="md-input required" placeholder="Enter Phone Number">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Alternative Contact Number/ WhatsApp Number</label>
                                        <br>
                                        <input type="text" id="f_alt_contact_no" name="f_alt_contact_no" class="md-input" placeholder="Enter Alternative Contact Number">
                                    </div>


                                    <div class="uk-width-medium-1-3">

                                        <label class="col-sm-12 col-form-label">Website </label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_website" name="f_website" class="md-input"
                                                placeholder="Enter Website">
                                        </div>
                                    </div>
                                    <div class="wizard-buttons">
                                        <button type="button" onclick="checkSelected()"
                                            class="wizard-btn next">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-content" data-step="2">
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-3">
                                            <label for="bus_main_cat">Users <span class="req"
                                                    style="color: red">*</span></label>
                                            <div class="parsley-row">
                                                <select class="md-input" name="f_user_id" id="f_user_id" required>
                                                    <option value="">Select</option>
                                                    @foreach ($userData as $userRow)
                                                        <option value="{{ $userRow->id }}">{{ $userRow->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="f_brand_name">Brand Name <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_brand_name" name="f_brand_name"
                                                class="md-input required" placeholder="Enter Brand Name">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="f_company_name">Company Name <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_company_name" name="f_company_name"
                                                class="md-input required" placeholder="Enter Company Name">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_business_year_established">Business Year Established <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_business_year_established"
                                                name="f_business_year_established" class="md-input required"
                                                placeholder="Enter Business Year Established">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_business_type">Business Type <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="checkbox" value="B2B" name="f_business_type[]"
                                                style="width: 20px;">B2B
                                            <input type="checkbox" value="B2C" name="f_business_type[]"
                                                style="width: 20px;">B2C
                                            <input type="checkbox" value="Both" name="f_business_type[]"
                                                style="width: 20px;">Both
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_main_cat">Sector <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select name="f_main_cat" class="md-input mt-2 required" id="catmain_id">
                                                <option value="">Select</option>
                                                @foreach ($mainCategoryData as $mainCategoryRow)
                                                    <option value="{{ $mainCategoryRow['fcm_id'] }}">
                                                        {{ $mainCategoryRow['fcm_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_sub_cat">Sub Sector <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select name="f_sub_cat" class="md-input mt-2 required" id="catsub_id">
                                                <option selected="" disabled="" value="">Choose...</option>
                                            </select>
                                        </div>
                                    </div>





                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_country">Country <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_country" name="f_country"
                                                class="md-input required" placeholder="Enter Country">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_state">State / Region <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_state" name="f_state"
                                                class="md-input required" placeholder="Enter State / Region">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_city">City <span class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_city" name="f_city"
                                                class="md-input required" placeholder="Enter City">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_pin_code">PIN Code/ ZIP Code <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_pin_code" name="f_pin_code"
                                                class="md-input required" placeholder="Enter PIN Code/ ZIP Code">
                                        </div>
                                    </div>



                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_website_url">Franchise Website URL <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_franchise_website_url"
                                                name="f_franchise_website_url" class="md-input required"
                                                placeholder="Enter Franchise Website URL">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label for="f_franchisee_address">Full Address <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <textarea id="f_franchisee_address" name="f_franchisee_address" class="md-input required"
                                                placeholder="Enter Full Address" rows="5" cols="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label for="f_child_cat">Products & Services Offered <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_child_cat" name="f_child_cat"
                                                class="md-input required" placeholder="Enter Products & Services Offered">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label for="f_business_desc">About Business / Brand <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <textarea id="editor1" name="f_business_desc" class="md-input required"
                                                placeholder="Enter About Business / Brand" rows="5" cols="5"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>

                            </div>
                            <div class="wizard-content" data-step="3">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchisee_type">Franchise Type <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="checkbox" name="f_franchisee_type[]" value="Single Unit"
                                                style="width: 19px;">Single Unit
                                            <input type="checkbox" name="f_franchisee_type[]" value="Multi-unit"
                                                style="width: 19px;">Multi-unit
                                            <input type="checkbox" name="f_franchisee_type[]" value="Master Franchise"
                                                style="width: 19px;">Master Franchise
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchisee_year_established">Franchisee Year Established <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_franchisee_year_established"
                                                name="f_franchisee_year_established" class="md-input required"
                                                placeholder="Enter Franchisee Year Established">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_total_investment">Total Investment <span
                                                class="req"style="color: red">*</span> </label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_total_investment" name="f_total_investment"
                                                class="md-input required" placeholder="Enter Total Investment">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_fee">Franchise Fee <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_franchise_fee" name="f_franchise_fee"
                                                class="md-input required" placeholder="Enter Franchise Fee">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_royalty_fee">Royalty Fee (%) <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_royalty_fee" name="f_royalty_fee"
                                                class="md-input required" placeholder="Enter Royalty Fee (%)">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_marketing_fee">Marketing Fee (%) <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_marketing_fee" name="f_marketing_fee"
                                                class="md-input required" placeholder="Enter Marketing Fee (%)">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_total_company_owned_outlets">Total Company-Owned Outlets <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_total_company_owned_outlets"
                                                name="f_total_company_owned_outlets" class="md-input required"
                                                placeholder="Enter Total Company-Owned Outlets">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_total_franchise_outlets_opened">Total Franchise Outlets Opened <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_total_franchise_outlets_opened"
                                                name="f_total_franchise_outlets_opened" class="md-input required"
                                                placeholder="Enter Total Franchise Outlets Opened">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_other_investment_requirements">Other Investment Requirements? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_other_investment_requirements"
                                                name="f_other_investment_requirements" class="md-input required"
                                                placeholder="Enter Other Investment Requirements?">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <br>
                                        <label for="f_franchisee_desc">About Franchisee <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <textarea id="editor" name="f_franchisee_desc" class="md-input" placeholder="Enter About Franchisee"rows="5"
                                                cols="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>
                            </div>

                            <div class="wizard-content" data-step="4">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="password">Available in India?</label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_available_in_india">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="password">International Expansion? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_international_expansion">
                                                <option value="">Select </option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_training_provided">Training Provided <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="checkbox" name="f_training_provided[]" value="Initial"
                                                style="width: 19px;">Initial
                                            <input type="checkbox" name="f_training_provided[]" value="Ongoing"
                                                style="width: 19px;">Ongoing
                                            <input type="checkbox" name="f_training_provided[]" value="Marketing"
                                                style="width: 19px;">Marketing
                                            <input type="checkbox" name="f_training_provided[]" value="Manuals"
                                                style="width: 19px;">Manuals
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_training_duration">Training Duration (Weeks) <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select id="f_training_duration" name="f_training_duration"
                                                class="md-input required">
                                                <option value="">Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_fee">Financing Aid? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_financing_aid">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_site_selection_assistance">Site Selection Assistance? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_site_selection_assistance">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_head_office_support_open">Head Office Support to Open? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_head_office_support_open">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_it_systems_included">IT Systems Included? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_it_systems_included">
                                                <option value="">Select </option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label>Preferred Countries & Cities <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <button type="button" class="md-btn md-btn-primary" onclick="addGroup()">Add
                                                More</button>
                                        </div>
                                    </div>

                                    <div id="inputContainer">
                                        <br>
                                        <div class="input-group">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-3">
                                                    <input type="text" name="country[]" class="md-input required"
                                                        placeholder="Enter Country Name">
                                                </div>
                                                <div class="uk-width-medium-1-3">
                                                    <input type="text" name="city[]" class="md-input required"
                                                        placeholder="Enter City Name">
                                                </div>

                                                <div class="uk-width-medium-1-3">
                                                    <a href="javascript:void(0);" class="text-danger remove-link"
                                                        onclick="removeGroup(this)">&emsp;&emsp;🗑 Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>
                            </div>

                            <div class="wizard-content" data-step="5">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_performance_guarantee">Performance Guarantee? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_performance_guarantee">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_expected_roi">Expected ROI <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_expected_roi" name="f_expected_roi"
                                                class="md-input required" placeholder="Enter Expected ROI">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_payback_period">Payback Period (Months) <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_payback_period" name="f_payback_period"
                                                class="md-input required" placeholder="Payback Period (Months)">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_term_duration">Franchise Term Duration (Years) <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_franchise_term_duration">
                                                <option value="">Select</option>
                                                <option value="3 Years">3 Years</option>
                                                <option value="5 Years">5 Years</option>
                                                <option value="10 Years">10 Years</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_term_renewable">Is Term Renewable? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_term_renewable">
                                                <option value="">Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_type_property_required">Type of Property Required <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_type_property_required">
                                                <option value="">Select</option>
                                                <option value="Commercial">Commercial</option>
                                                <option value="Non-Commercial">Non-Commercial</option>
                                                <option value="Residential">Residential</option>
                                                <option value="Any">Any</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_minimum_area_required">Minimum Area Required <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_minimum_area_required"
                                                name="f_minimum_area_required" class="md-input required"
                                                placeholder="Enter Minimum Area Required">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_property_location_preference">Property Location Preference <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="text" id="f_property_location_preference"
                                                name="f_property_location_preference" class="md-input required"
                                                placeholder="Enter Property Location Preference">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_who_will_furnish_premises">Who Will Furnish Premises? <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <select class="md-input required" name="f_who_will_furnish_premises">
                                                <option value="">Select</option>
                                                <option value="Franchisor">Franchisor</option>
                                                <option value="Franchisee">Franchisee</option>
                                                <option value="Shared Responsibility">Shared Responsibility</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>
                            </div>

                            <div class="wizard-content" data-step="6">
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-3">
                                        <label for="f_company_logo">Upload Company Logo <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input required"
                                                id="f_company_logo" name="f_company_logo">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="f_franchise_brochure">Upload Franchise Brochure</label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input"
                                                id="f_franchise_brochure" name="f_franchise_brochure">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="f_business_registration_certificate">Upload Business Registration
                                            Certificate <span class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input required"
                                                id="f_business_registration_certificate"
                                                name="f_business_registration_certificate">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_disclosure_document">Upload Franchise Disclosure Document
                                            <span class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input required"
                                                id="f_franchise_disclosure_document"
                                                name="f_franchise_disclosure_document">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_products_services">Upload Products & Services File <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input required"
                                                id="f_products_services" name="f_products_services">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="franchise_images">Upload Franchisee Outlet Images <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input required"
                                                id="franchise_images" name="franchise_images[]" multiple>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_corporate_video_url">Enter Corporate Video Link</label>
                                        <div class="parsley-row">
                                            <input type="text" class="md-input" id="f_corporate_video_url"
                                                name="f_corporate_video_url" placeholder="Enter Corporate Video Link">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_facebook_url">Enter Facebook Page Link</label>
                                        <div class="parsley-row">
                                            <input type="text" class="md-input" id="f_facebook_url"
                                                name="f_facebook_url" placeholder="Enter Facebook Page Link">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_twitter_url">Enter Twitter (X.com) Page Link</label>
                                        <div class="parsley-row">
                                            <input type="text" class="md-input" id="f_twitter_url"
                                                name="f_twitter_url" placeholder="Enter Twitter (X.com) Page Link">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_instagram_url">Enter Instagram Page link</label>
                                        <div class="parsley-row">
                                            <input type="text" class="md-input" id="f_instagram_url"
                                                name="f_instagram_url" placeholder="Enter Instagram Page link">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_youtube_url">Enter YouTube Link</label>
                                        <div class="parsley-row">
                                            <input type="text" class="md-input" id="f_youtube_url"
                                                name="f_youtube_url" placeholder="Enter YouTube Link">
                                        </div>
                                    </div>

                                </div>

                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>
                            </div>

                            <div class="wizard-content" data-step="7">
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="col-12">
                                        <br>
                                        <label for="f_why_choose_you">Why Choose You?</label>
                                        <div class="parsley-row">
                                            <textarea id="editor2" name="f_why_choose_you" class="md-input" placeholder="Enter Why Choose You?"
                                                rows="5" cols="100"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <br>
                                        <label for="f_success_story">Success Story <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <textarea id="editor3" name="f_success_story" class="md-input" placeholder="Enter Success Story"
                                                rows="5" cols="100"></textarea>
                                        </div>
                                    </div>
                                    
                                </div>

                                 <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <div class="parsley-row uk-margin-top">
                                                <label for="f_meta_title">Meta Title</label>
                                                <input type="text" name="f_meta_title" class="md-input"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-1">
                                            <div class="parsley-row uk-margin-top">
                                                <label for="f_meta_keyword">Meta Keyword</label>
                                                <input type="text" name="f_meta_keyword" class="md-input" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="parsley-row">
                                                <label for="f_meta_description">Meta Desciption</label>
                                                <textarea class="md-input" name="f_meta_description" cols="10" rows="8"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>
                            </div>

                            <div class="wizard-content" data-step="8">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="col-12">
                                        <label>Confirm Information is Accurate <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="checkbox" id="confirm_information_accurate"
                                                style="width: 19px;">Yes

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <br>
                                        <label>Agree to Terms & Privacy <span
                                                class="req"style="color: red">*</span></label>
                                        <div class="parsley-row">
                                            <input type="checkbox" id="agree_terms_privacy" style="width: 19px;">I
                                            confirm
                                            that all the information provided above is accurate and truthful to the best of
                                            my
                                            knowledge. <br> I understand and accept the Terms of Use and Privacy Policy of
                                            Punnaka.com and consent to the collection, <br> storage, and use of my data for
                                            listing
                                            and communication purposes.
                                        </div>
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

                if (stepNum == 8) {
                    if (!confirm_information_accurate.checked) {
                        confirm_information_accurate.classList.add("error");
                        return;
                    }
                    if (!agree_terms_privacy.checked) {
                        agree_terms_privacy.classList.add("error");
                        return;
                    }
                }

                // requiredFields.forEach(field => {

                //     //alert("field.value "+field.value);

                //     if (!field.value.trim()) {
                //         isValid = false;
                //         field.style.borderColor = 'red';
                //     } else {
                //         field.style.borderColor = '#ccc';
                //     }
                // });
                // //alert("isValid "+isValid);
                // if (!isValid) {
                //     alert('Please fill out all required fields.');
                // }

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

            const fields = [{
                    name: "country[]",
                    placeholder: "Enter Country Name",
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
                col.className = "col-6 mb-3";

                const input = document.createElement("input");
                input.type = field.type;
                input.name = field.name;
                input.placeholder = field.placeholder;
                input.className = "md-input";
                input.required = true;

                col.appendChild(input);
                row.appendChild(col);
            });

            const deleteLink = document.createElement("a");
            deleteLink.href = "javascript:void(0);";
            deleteLink.className = "text-danger remove-link";
            deleteLink.innerHTML = "&emsp;&emsp;🗑 Delete";
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
    </script>
@endsection
