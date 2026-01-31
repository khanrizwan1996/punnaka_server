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
                <li><span>Franchise Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Franchise Details</h3>

        @if (session('message'))
            @if (session('message') == MSG_UPDATE_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Updated Successfully!..</p>
                </div>
            @else
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In Update!..</p>
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
                        action="{{ url(ADMIN_URL . 'franchiseUpdate/' . $getFranchiseData->f_id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_f_main_cat" id="old_f_main_cat"
                            value="{{ $getFranchiseData['f_main_cat'] }}">
                        <input type="hidden" name="old_f_sub_cat" id="old_f_sub_cat"
                            value="{{ $getFranchiseData['f_sub_cat'] }}">
                        <input type="hidden" name="old_f_business_type" id="old_f_business_type"
                            value="{{ $getFranchiseData['f_business_type'] }}">
                        <input type="hidden" name="old_f_franchisee_type" id="old_f_franchisee_type"
                            value="{{ $getFranchiseData['f_franchisee_type'] }}">
                        <input type="hidden" name="old_f_company_logo" id="old_f_company_logo"
                            value="{{ $getFranchiseData['f_company_logo'] }}">
                        <input type="hidden" name="old_f_franchise_brochure" id="old_f_franchise_brochure"
                            value="{{ $getFranchiseData['f_franchise_brochure'] }}">
                        <input type="hidden" name="old_f_business_registration_certificate"
                            id="old_f_business_registration_certificate"
                            value="{{ $getFranchiseData['f_business_registration_certificate'] }}">
                        <input type="hidden" name="old_f_franchise_disclosure_document"
                            id="old_f_franchise_disclosure_document"
                            value="{{ $getFranchiseData['f_franchise_disclosure_document'] }}">
                        <input type="hidden" name="old_f_products_services" id="old_f_products_services"
                            value="{{ $getFranchiseData['f_products_services'] }}">
                        <input type="hidden" name="old_f_training_provided" id="old_f_training_provided"
                            value="{{ $getFranchiseData['f_training_provided'] }}">

                        <div class="wizard-content-container">
                            <div class="wizard-content active" data-step="1">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Contact Person <span class="req"
                                                style="color: red">*</span></label>
                                        <input type="text" id="f_name" name="f_name"
                                            value="{{ $getFranchiseData['f_name'] }}" class="md-input required"
                                            placeholder="Enter Contact Person">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Email Address <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="email" id="f_email" name="f_email"
                                            value="{{ $getFranchiseData['f_email'] }}" class="md-input required"
                                            placeholder="Enter Email Address">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Phone Number <span class="req"
                                                style="color: red">*</span></label>
                                        <input type="text" id="f_contact_no" name="f_contact_no"
                                            value="{{ $getFranchiseData['f_contact_no'] }}" class="md-input required"
                                            placeholder="Enter Phone Number">
                                    </div>
                                   
                                    <div class="uk-width-medium-1-3">
                                        <label class="col-sm-12 col-form-label">Alternative Contact Number/ WhatsApp Number</label>
                                        <br>
                                        <input type="text" id="f_alt_contact_no" name="f_alt_contact_no"
                                            value="{{ $getFranchiseData['f_alt_contact_no'] }}" class="md-input" placeholder="Enter Alternative Contact Number">
                                    </div>


                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label class="col-sm-12 col-form-label">Website </label>
                                        <input type="text" id="f_website" name="f_website"
                                            value="{{ $getFranchiseData['f_website'] }}" class="md-input"
                                            placeholder="Enter Website">
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="wizard-buttons">
                                                <button type="button" onclick="checkSelected()"
                                                    class="wizard-btn next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-content" data-step="2">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <br>
                                    <div class="card-body checkbox-checked" style="width: 96%;">
                                        <div class="md-card">
                                            <div class="md-card-content large-padding">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for=""
                                                            style="font-weight: bolder;font-size: 15px;">Selected Main
                                                            Category : <span style="color:#1976d2">
                                                                {{ $getFranchiseData['f_main_cat'] }}</span></label>
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for=""
                                                            style="font-weight: bolder;font-size: 15px;">Selected Sub
                                                            Category : <span style="color:#1976d2">
                                                                {{ $getFranchiseData['f_sub_cat'] }}</span></label>
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for=""
                                                            style="font-weight: bolder;font-size: 15px;">Selected Business
                                                            Type : <span style="color:#1976d2">
                                                                {{ $getFranchiseData['f_business_type'] }}</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_brand_name">Brand Name <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_brand_name" name="f_brand_name"
                                            value="{{ $getFranchiseData['f_brand_name'] }}" class="md-input required"
                                            placeholder="Enter Brand Name">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_company_name">Company Name <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_company_name" name="f_company_name"
                                            value="{{ $getFranchiseData['f_company_name'] }}" class="md-input required"
                                            placeholder="Enter Company Name">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_business_year_established">Business Year Established <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_business_year_established"
                                            value="{{ $getFranchiseData['f_business_year_established'] }}"
                                            name="f_business_year_established" class="md-input required"
                                            placeholder="Enter Business Year Established">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_business_type">Business Type </label>
                                        <input type="checkbox" value="B2B" name="f_business_type[]"
                                            style="width: 20px;">B2B
                                        <input type="checkbox" value="B2C" name="f_business_type[]"
                                            style="width: 20px;">B2C
                                        <input type="checkbox" value="Both" name="f_business_type[]"
                                            style="width: 20px;">Both
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="f_main_cat">Sector</label>
                                        <br>
                                        <select name="f_main_cat" class="md-input mt-2" id="catmain_id">
                                            <option value="">Select</option>
                                            @foreach ($mainCategoryData as $mainCategoryRow)
                                                <option value="{{ $mainCategoryRow['fcm_id'] }}">
                                                    {{ $mainCategoryRow['fcm_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_sub_cat">Sub Sector</label>
                                        <select name="f_sub_cat" class="md-input mt-2" id="catsub_id">
                                            <option selected="" disabled="" value="">Choose...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-2">
                                        <br>
                                        <label for="f_child_cat">Products & Services Offered <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_child_cat" name="f_child_cat"
                                            value="{{ $getFranchiseData['f_child_cat'] }}" class="md-input required"
                                            placeholder="Enter Products & Services Offered">
                                    </div>

                                    <div class="uk-width-medium-1-2">
                                        <br>
                                        <label for="f_franchise_website_url">Franchise Website URL <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_franchise_website_url"
                                            value="{{ $getFranchiseData['f_franchise_website_url'] }}"
                                            name="f_franchise_website_url" class="md-input required"
                                            placeholder="Enter Franchise Website URL">
                                    </div>

                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label for="f_business_desc">About Business / Brand <span class="req"style="color: red">*</span></label>
                                        <br>
                                                
                                        <textarea id="editor1" name="f_business_desc" class="md-input required"
                                            placeholder="Enter About Business / Brand" rows="5" cols="5">{{ $getFranchiseData['f_business_desc'] }}</textarea>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_country">Country <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_country" name="f_country"
                                            value="{{ $getFranchiseData['f_country'] }}" class="md-input required"
                                            placeholder="Enter Country">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_state">State / Region <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_state" name="f_state"
                                            value="{{ $getFranchiseData['f_state'] }}" class="md-input required"
                                            placeholder="Enter State / Region">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_city">City <span class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_city" name="f_city"
                                            value="{{ $getFranchiseData['f_city'] }}" class="md-input required"
                                            placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_pin_code">PIN Code/ ZIP Code <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_pin_code" name="f_pin_code"
                                            value="{{ $getFranchiseData['f_pin_code'] }}" class="md-input required"
                                            placeholder="Enter PIN Code/ ZIP Code">
                                    </div>
                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label for="f_franchisee_address">Full Address <span
                                                class="req"style="color: red">*</span></label>
                                        <textarea id="f_franchisee_address" name="f_franchisee_address" class="md-input required"
                                            placeholder="Enter Full Address" rows="5" cols="10">{{ $getFranchiseData['f_franchisee_address'] }}</textarea>
                                    </div>
                                </div>
                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>

                            </div>
                            <div class="wizard-content" data-step="3">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <br>
                                    <div class="card-body checkbox-checked" style="width: 96%;">
                                        <div class="md-card">
                                            <div class="md-card-content large-padding">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-1">
                                                        <label for=""
                                                            style="font-weight: bolder;font-size: 15px;">Selected Franchise
                                                            Type : <span style="color:#1976d2">
                                                                {{ $getFranchiseData['f_franchisee_type'] }}</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchisee_type">Franchise Type</label>
                                        <input type="checkbox" name="f_franchisee_type[]" value="Single Unit"
                                            style="width: 19px;">Single Unit
                                        <input type="checkbox" name="f_franchisee_type[]" value="Multi-unit"
                                            style="width: 19px;">Multi-unit
                                        <input type="checkbox" name="f_franchisee_type[]" value="Master Franchise"
                                            style="width: 19px;">Master Franchise
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchisee_year_established">Franchisee Year Established <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_franchisee_year_established"
                                            value="{{ $getFranchiseData['f_franchisee_year_established'] }}"
                                            name="f_franchisee_year_established" class="md-input required"
                                            placeholder="Enter Franchisee Year Established">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_total_investment">Total Investment <span
                                                class="req"style="color: red">*</span> </label>
                                        <input type="text" id="f_total_investment"
                                            value="{{ $getFranchiseData['f_total_investment'] }}"
                                            name="f_total_investment" class="md-input required"
                                            placeholder="Enter Total Investment">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_fee">Franchise Fee <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_franchise_fee"
                                            value="{{ $getFranchiseData['f_franchise_fee'] }}" name="f_franchise_fee"
                                            class="md-input required" placeholder="Enter Franchise Fee">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_royalty_fee">Royalty Fee (%) <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_royalty_fee"
                                            value="{{ $getFranchiseData['f_royalty_fee'] }}" name="f_royalty_fee"
                                            class="md-input required" placeholder="Enter Royalty Fee (%)">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_marketing_fee">Marketing Fee (%) <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_marketing_fee"
                                            value="{{ $getFranchiseData['f_marketing_fee'] }}" name="f_marketing_fee"
                                            class="md-input required" placeholder="Enter Marketing Fee (%)">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_total_company_owned_outlets">Total Company-Owned Outlets <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_total_company_owned_outlets"
                                            value="{{ $getFranchiseData['f_total_company_owned_outlets'] }}"
                                            name="f_total_company_owned_outlets" class="md-input required"
                                            placeholder="Enter Total Company-Owned Outlets">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_total_franchise_outlets_opened">Total Franchise Outlets Opened <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_total_franchise_outlets_opened"
                                            value="{{ $getFranchiseData['f_total_franchise_outlets_opened'] }}"
                                            name="f_total_franchise_outlets_opened" class="md-input required"
                                            placeholder="Enter Total Franchise Outlets Opened">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_other_investment_requirements">Other Investment Requirements? <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_other_investment_requirements"
                                            value="{{ $getFranchiseData['f_other_investment_requirements'] }}"
                                            name="f_other_investment_requirements" class="md-input required"
                                            placeholder="Enter Other Investment Requirements?">
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label for="f_franchisee_desc">About Franchise <span
                                                class="req"style="color: red">*</span></label>
                                        <br>
                                        <textarea id="editor" name="f_franchisee_desc" class="md-input required"
                                            placeholder="Enter About Franchise"rows="5" cols="10">{{ $getFranchiseData['f_franchisee_desc'] }}</textarea>
                                    </div>
                                </div>

                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>
                            </div>

                            <div class="wizard-content" data-step="4">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <br>
                                    <div class="card-body checkbox-checked" style="width: 96%;">
                                        <div class="md-card">
                                            <div class="md-card-content large-padding">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-1">
                                                        <label for=""
                                                            style="font-weight: bolder;font-size: 15px;">Selected Training
                                                            Provided : <span style="color:#1976d2">
                                                                {{ $getFranchiseData['f_training_provided'] }}</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="password">Available in India?</label>
                                        <select class="md-input required" name="f_available_in_india">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_available_in_india'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_available_in_india'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="password">International Expansion? <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_international_expansion">
                                            <option value="">Select </option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_international_expansion'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_international_expansion'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_training_provided">Training Provided <span
                                                class="req"style="color: red">*</span></label>
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
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_training_duration">Training Duration (Weeks) <span
                                                class="req"style="color: red">*</span></label>
                                        <select id="f_training_duration" name="f_training_duration"
                                            class="md-input required">
                                            <option value="">Select</option>
                                            <option value="1"
                                                @if ($getFranchiseData['f_training_duration'] == '1') selected style="color:red" @endif>1
                                            </option>
                                            <option value="2"
                                                @if ($getFranchiseData['f_training_duration'] == '2') selected style="color:red" @endif>2
                                            </option>
                                            <option value="4"
                                                @if ($getFranchiseData['f_training_duration'] == '4') selected style="color:red" @endif>4
                                            </option>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_fee">Financing Aid? <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_financing_aid">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_financing_aid'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_financing_aid'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_site_selection_assistance">Site Selection Assistance? <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_site_selection_assistance">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_site_selection_assistance'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_site_selection_assistance'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_head_office_support_open">Head Office Support to Open? <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_head_office_support_open">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_head_office_support_open'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_head_office_support_open'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_it_systems_included">IT Systems Included? <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_it_systems_included">
                                            <option value="">Select </option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_it_systems_included'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_it_systems_included'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
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
                                        <select class="md-input required" name="f_performance_guarantee">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_performance_guarantee'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_performance_guarantee'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_expected_roi">Expected ROI <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_expected_roi"
                                            value="{{ $getFranchiseData['f_expected_roi'] }}" name="f_expected_roi"
                                            class="md-input required" placeholder="Enter Expected ROI">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_payback_period">Payback Period (Months) <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_payback_period"
                                            value="{{ $getFranchiseData['f_payback_period'] }}" name="f_payback_period"
                                            class="md-input required" placeholder="Payback Period (Months)">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_term_duration">Franchise Term Duration (Years) <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_franchise_term_duration">
                                            <option value="">Select</option>
                                            <option value="3 Years"
                                                @if ($getFranchiseData['f_franchise_term_duration'] == '3 Years') selected style="color:red" @endif>3
                                                Years</option>
                                            <option value="5 Years"
                                                @if ($getFranchiseData['f_franchise_term_duration'] == '5 Years') selected style="color:red" @endif>5
                                                Years</option>
                                            <option value="10 Years"
                                                @if ($getFranchiseData['f_franchise_term_duration'] == '10 Years') selected style="color:red" @endif>10
                                                Years</option>
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_term_renewable">Is Term Renewable? <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_term_renewable">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                @if ($getFranchiseData['f_term_renewable'] == 'Yes') selected style="color:red" @endif>Yes
                                            </option>
                                            <option value="No"
                                                @if ($getFranchiseData['f_term_renewable'] == 'No') selected style="color:red" @endif>No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_type_property_required">Type of Property Required <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_type_property_required">
                                            <option value="">Select</option>
                                            <option value="Commercial"
                                                @if ($getFranchiseData['f_type_property_required'] == 'Commercial') selected style="color:red" @endif>
                                                Commercial</option>
                                            <option value="Non-Commercial"
                                                @if ($getFranchiseData['f_type_property_required'] == 'Non-Commercial') selected style="color:red" @endif>
                                                Non-Commercial</option>
                                            <option value="Residential"
                                                @if ($getFranchiseData['f_type_property_required'] == 'Residential') selected style="color:red" @endif>
                                                Residential</option>
                                            <option value="Any"
                                                @if ($getFranchiseData['f_type_property_required'] == 'Any') selected style="color:red" @endif>Any
                                            </option>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_minimum_area_required">Minimum Area Required <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_minimum_area_required"
                                            value="{{ $getFranchiseData['f_minimum_area_required'] }}"
                                            name="f_minimum_area_required" class="md-input required"
                                            placeholder="Enter Minimum Area Required">
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_property_location_preference">Property Location Preference <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="text" id="f_property_location_preference"
                                            value="{{ $getFranchiseData['f_property_location_preference'] }}"
                                            name="f_property_location_preference" class="md-input required"
                                            placeholder="Enter Property Location Preference">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_who_will_furnish_premises">Who Will Furnish Premises? <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_who_will_furnish_premises">
                                            <option value="">Select</option>
                                            <option value="Franchisor"
                                                @if ($getFranchiseData['f_who_will_furnish_premises'] == 'Franchisor') selected style="color:red" @endif>
                                                Franchisor</option>
                                            <option value="Franchisee"
                                                @if ($getFranchiseData['f_who_will_furnish_premises'] == 'Franchisee') selected style="color:red" @endif>
                                                Franchisee</option>
                                            <option value="Shared Responsibility"
                                                @if ($getFranchiseData['f_who_will_furnish_premises'] == 'Shared Responsibility') selected style="color:red" @endif>Shared
                                                Responsibility</option>
                                        </select>
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
                                        <label for="f_company_logo">Upload Company Logo <a target="_blank"
                                                style="color: red"
                                                href="{{ url('custom-images/franchise-images/' . $getFranchiseData['f_company_logo']) }}">
                                                (View Image)</a></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input"
                                                id="f_company_logo" name="f_company_logo">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="f_franchise_brochure">Upload Franchise Brochure <a target="_blank"
                                                style="color: red"
                                                href="{{ url('custom-images/franchise-images/' . $getFranchiseData['f_franchise_brochure']) }}">
                                                (View File)</a></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input"
                                                id="f_franchise_brochure" name="f_franchise_brochure">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="f_business_registration_certificate" style="font-size: 12px;">Upload
                                            Business Registration Certificate <a target="_blank" style="color: red"
                                                href="{{ url('custom-images/franchise-images/' . $getFranchiseData['f_business_registration_certificate']) }}">
                                                (View File)</a></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input"
                                                id="f_business_registration_certificate"
                                                name="f_business_registration_certificate">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_franchise_disclosure_document" style="font-size: 13px;">Upload
                                            Franchise Disclosure Document <a target="_blank" style="color: red"
                                                href="{{ url('custom-images/franchise-images/' . $getFranchiseData['f_franchise_disclosure_document']) }}">
                                                (View File)</a></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input"
                                                id="f_franchise_disclosure_document"
                                                name="f_franchise_disclosure_document">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_products_services">Upload Products & Services File <a
                                                target="_blank" style="color: red"
                                                href="{{ url('custom-images/franchise-images/' . $getFranchiseData['f_products_services']) }}">
                                                (View File)</a></label>
                                        <div class="parsley-row">
                                            <input type="file" class="md-btn md-btn-primary md-input"
                                                id="f_products_services" name="f_products_services">
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_corporate_video_url">Enter Corporate Video Link</label>
                                        <br>
                                        <input type="text" class="md-input"
                                            value="{{ $getFranchiseData['f_corporate_video_url'] }}"
                                            id="f_corporate_video_url" name="f_corporate_video_url"
                                            placeholder="Enter Corporate Video Link">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_facebook_url">Enter Facebook Page Link</label>
                                        <br>
                                        <input type="text" class="md-input"
                                            value="{{ $getFranchiseData['f_facebook_url'] }}" id="f_facebook_url"
                                            name="f_facebook_url" placeholder="Enter Facebook Page Link">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_twitter_url">Enter Twitter (X.com) Page Link</label>
                                        <br>
                                        <input type="text" class="md-input"
                                            value="{{ $getFranchiseData['f_twitter_url'] }}" id="f_twitter_url"
                                            name="f_twitter_url" placeholder="Enter Twitter (X.com) Page Link">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_instagram_url">Enter Instagram Page link</label>
                                        <br>
                                        <input type="text" class="md-input"
                                            value="{{ $getFranchiseData['f_instagram_url'] }}" id="f_instagram_url"
                                            name="f_instagram_url" placeholder="Enter Instagram Page link">
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_youtube_url">Enter YouTube Link</label>
                                        <br>
                                        <input type="text" class="md-input"
                                            value="{{ $getFranchiseData['f_youtube_url'] }}" id="f_youtube_url"
                                            name="f_youtube_url" placeholder="Enter YouTube Link">
                                    </div>

                                </div>

                                <div class="wizard-buttons">
                                    <button type="button" class="wizard-btn prev">Previous</button>
                                    <button type="button" class="wizard-btn next">Next</button>
                                </div>
                            </div>

                            <div class="wizard-content" data-step="7">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <label for="f_why_choose_you">Why Choose You?</label>
                                        <br>
                                        <textarea id="editor2" name="f_why_choose_you" class="md-input" placeholder="Enter Why Choose You?"
                                            rows="5" cols="100">{{ $getFranchiseData['f_why_choose_you'] }}</textarea>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label for="f_success_story">Success Story <span class="req"style="color: red">*</span></label>
                                        <br>
                                               
                                        <textarea id="editor3" name="f_success_story" class="md-input" placeholder="Enter Success Story"
                                            rows="5" cols="100">{{ $getFranchiseData['f_success_story'] }}</textarea>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <div class="parsley-row uk-margin-top">
                                                <label for="f_meta_title">Meta Title</label>
                                                <input type="text" name="f_meta_title" value="{{ $getFranchiseData['f_meta_title'] }}" class="md-input"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-1">
                                            <div class="parsley-row uk-margin-top">
                                                <label for="f_meta_keyword">Meta Keyword</label>
                                                <input type="text" name="f_meta_keyword" value="{{ $getFranchiseData['f_meta_keyword'] }}" class="md-input" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="parsley-row">
                                                <label for="f_meta_description">Meta Desciption</label>
                                                <textarea class="md-input" name="f_meta_description" cols="10" rows="8">{{ $getFranchiseData['f_meta_description'] }}
                                                </textarea>
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

                                    <div class="uk-width-medium-1-3">
                                        <br>
                                        <label for="f_status">Status <span
                                                class="req"style="color: red">*</span></label>
                                        <select class="md-input required" name="f_status">
                                            <option value="">Select </option>
                                            <option value="{{ STATUS_ACTIVE }}"
                                                @if ($getFranchiseData['f_status'] == STATUS_ACTIVE) selected style="color:red" @endif>Active
                                            </option>
                                            <option value="{{ STATUS_INACTIVE }}"
                                                @if ($getFranchiseData['f_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In
                                                Active</option>

                                            <option value="{{ STATUS_DUPLICATE }}"
                                                @if ($getFranchiseData['f_status'] == STATUS_DUPLICATE) selected style="color:red" @endif>
                                                Duplicate</option>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label>Confirm Information is Accurate<span
                                                class="req"style="color: red">*</span></label>
                                        <input type="checkbox" id="confirm_information_accurate" style="width: 19px;">Yes

                                    </div>
                                    <div class="uk-width-medium-1-1">
                                        <br>
                                        <label>Agree to Terms & Privacy <span
                                                class="req"style="color: red">*</span></label>
                                        <input type="checkbox" id="agree_terms_privacy" style="width: 19px;">I confirm
                                        that all the information provided above is accurate and truthful to the best of my
                                        knowledge. I understand and accept the Terms of Use and Privacy Policy of
                                        Punnaka.com and consent to the collection, storage, and use of my data for listing
                                        and communication purposes.
                                    </div>

                                    <div class="uk-width-1-1">
                                        <br><br>
                                        <div class="parsley-row">
                                            <label for="bus_meta_description">Admin Comment</label>
                                            <textarea class="md-input" name="f_admin_comment" cols="10" rows="8">{{ $getFranchiseData['f_admin_comment'] }}</textarea>
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

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = 'red';
                    } else {
                        field.style.borderColor = '#ccc';
                    }
                });

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
