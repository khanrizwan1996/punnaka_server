@extends('admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <style>
        .heading {
            color: var(--dark);
            margin-bottom: 10px;
            border-left: 5px solid #3fb4e4;
            padding-left: 10px;
            margin-top: 30px;
        }

        .hidden {
            display: none;
        }

        .visible {
            display: block;
        }
    </style>


    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/productAndServiceList') }}">Product & Service List</a></li>
                <li><span>Product & Service Add </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Product & Service Details</h3>

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
                <form id="form_validation" method="POST" action="{{ url('admin/productAndServiceStore') }}"
                    enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <h3 class="heading">Basic Information</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>
                       

                        <div class="uk-width-medium-1-4">
                            <label for="ps_main_cat">User <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_user_id" id="ps_user_id">
                                    <option value="">Select</option>
                                    @foreach ($UserData as $UserRow)
                                        <option value="{{ $UserRow['id'] }}">{{ $UserRow['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label for="ps_main_cat">Main Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_main_cat" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($mainCategoryData as $mainCategoryData)
                                        <option value="{{ $mainCategoryData['cat_main_id'] }}">
                                            {{ $mainCategoryData['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label for="ps_sub_cat">Sub Category <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_sub_cat" id="catsub_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                         <div class="uk-width-medium-1-4">
                            <label for="ps_title">Title <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="ps_title" required class="md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label for="blog_image">Listing Type</label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_listing_type" id="ps_listing_type" required>
                                    <option value="">Select</option>
                                    <option value="Product">Product</option>
                                    <option value="Service">Service</option>
                                    <option value="Both">Both</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3 class="heading">Pricing</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label for="ps_pricing_type">Pricing Type <span class="req"
                                    style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_pricing_type" id="ps_pricing_type" required>
                                    <option value="">Select</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Hourly">Hourly</option>
                                    <option value="Range">Range</option>
                                    <option value="Package Price">Package Price
                                    </option>
                                    <option value="Contact for price">Contact for
                                        price</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-6">
                            <label for="ps_currency">Currency</label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_currency" id="ps_currency">
                                    <option value="">Select</option>
                              <option value="AED">AED</option>
                                <option value="AFN">AFN</option>
                                <option value="ALL">ALL</option>
                                <option value="AMD">AMD</option>
                                <option value="ANG">ANG</option>
                                <option value="AOA">AOA</option>
                                <option value="ARS">ARS</option>
                                <option value="AUD">AUD</option>
                                <option value="AWG">AWG</option>
                                <option value="AZN">AZN</option>
                                <option value="BAM">BAM</option>
                                <option value="BBD">BBD</option>
                                <option value="BDT">BDT</option>
                                <option value="BGN">BGN</option>
                                <option value="BHD">BHD</option>
                                <option value="BIF">BIF</option>
                                <option value="BMD">BMD</option>
                                <option value="BND">BND</option>
                                <option value="BOB">BOB</option>
                                <option value="BRL">BRL</option>
                                <option value="BSD">BSD</option>
                                <option value="BTN">BTN</option>
                                <option value="BWP">BWP</option>
                                <option value="BYN">BYN</option>
                                <option value="BZD">BZD</option>
                                <option value="CAD">CAD</option>
                                <option value="CDF">CDF</option>
                                <option value="CHF">CHF</option>
                                <option value="CLP">CLP</option>
                                <option value="CNY">CNY</option>
                                <option value="COP">COP</option>
                                <option value="CRC">CRC</option>
                                <option value="CUP">CUP</option>
                                <option value="CVE">CVE</option>
                                <option value="CZK">CZK</option>
                                <option value="DJF">DJF</option>
                                <option value="DKK">DKK</option>
                                <option value="DOP">DOP</option>
                                <option value="DZD">DZD</option>
                                <option value="EGP">EGP</option>
                                <option value="ERN">ERN</option>
                                <option value="ETB">ETB</option>
                                <option value="EUR">EUR</option>
                                <option value="FJD">FJD</option>
                                <option value="FKP">FKP</option>
                                <option value="GBP">GBP</option>
                                <option value="GEL">GEL</option>
                                <option value="GHS">GHS</option>
                                <option value="GIP">GIP</option>
                                <option value="GMD">GMD</option>
                                <option value="GNF">GNF</option>
                                <option value="GTQ">GTQ</option>
                                <option value="GYD">GYD</option>
                                <option value="HKD">HKD</option>
                                <option value="HNL">HNL</option>
                                <option value="HRK">HRK</option>
                                <option value="HTG">HTG</option>
                                <option value="HUF">HUF</option>
                                <option value="IDR">IDR</option>
                                <option value="ILS">ILS</option>
                                <option value="INR">INR</option>
                                <option value="IQD">IQD</option>
                                <option value="IRR">IRR</option>
                                <option value="ISK">ISK</option>
                                <option value="JMD">JMD</option>
                                <option value="JOD">JOD</option>
                                <option value="JPY">JPY</option>
                                <option value="KES">KES</option>
                                <option value="KGS">KGS</option>
                                <option value="KHR">KHR</option>
                                <option value="KMF">KMF</option>
                                <option value="KPW">KPW</option>
                                <option value="KRW">KRW</option>
                                <option value="KWD">KWD</option>
                                <option value="KYD">KYD</option>
                                <option value="KZT">KZT</option>
                                <option value="LAK">LAK</option>
                                <option value="LBP">LBP</option>
                                <option value="LKR">LKR</option>
                                <option value="LRD">LRD</option>
                                <option value="LSL">LSL</option>
                                <option value="LYD">LYD</option>
                                <option value="MAD">MAD</option>
                                <option value="MDL">MDL</option>
                                <option value="MGA">MGA</option>
                                <option value="MKD">MKD</option>
                                <option value="MMK">MMK</option>
                                <option value="MNT">MNT</option>
                                <option value="MOP">MOP</option>
                                <option value="MRU">MRU</option>
                                <option value="MUR">MUR</option>
                                <option value="MVR">MVR</option>
                                <option value="MWK">MWK</option>
                                <option value="MXN">MXN</option>
                                <option value="MYR">MYR</option>
                                <option value="MZN">MZN</option>
                                <option value="NAD">NAD</option>
                                <option value="NGN">NGN</option>
                                <option value="NIO">NIO</option>
                                <option value="NOK">NOK</option>
                                <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-6">
                            <label class="form-label">Price / Range <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_price_range" id="ps_price_range"
                                    placeholder="Enter Price / Range" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-6">
                            <label class="form-label">Discount (if any)</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_discount" id="ps_discount"
                                    placeholder="Enter Discount (if any)">
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Tax (optional)</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_tax" id="ps_tax"
                                    placeholder="Enter GST, VAT, HST, Percentage%">
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3 class="heading">Location & Availability</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_country" id="ps_country"
                                    placeholder="Enter Country" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_state" id="ps_state"
                                    placeholder="Enter State" required>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_city" id="ps_city"
                                    placeholder="Enter City" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Service Area <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="ps_service_area" id="ps_service_area" required>
                                    <option value="">Select</option>
                                    <option value="Local">Local</option>
                                    <option value="National">National</option>
                                    <option value="Global">Global</option>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Availability (For Services) Date Time <span
                                    class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="datetime-local" name="ps_availability_date_time"
                                    id="ps_availability_date_time"
                                    placeholder="Enter Availability (For Services) Date Time" required>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Additional Options <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" required id="ps_additional_options" name="ps_additional_options"
                                    onchange="additionalOptions()">
                                    <option value="">Select</option>
                                    <option value="Products">Products</option>
                                    <option value="Services">Services</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4 hidden" id="div_ps_size">
                            <br>
                            <label class="form-label">Size <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_size" id="ps_size"
                                    placeholder="Enter Size">
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4 hidden" id="div_ps_color">
                            <br>
                            <label class="form-label">Color <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_color" id="ps_color"
                                    placeholder="Enter Color">
                            </div>
                        </div>

                        <div class="uk-width-medium-1-1 hidden" id="div_ps_return_policy">
                            <br>
                            <label class="form-label">Return Policy <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" type="text" name="ps_return_policy" id="ps_return_policy"
                                    placeholder="Enter Return Policy" rows="5" cols="5"></textarea>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-1 hidden" id="div_ps_cancellation_policy">
                            <br>
                            <label class="form-label">Cancellation Policy <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" type="text" name="ps_cancellation_policy" id="ps_cancellation_policy"
                                    placeholder="Enter Cancellation Policy" rows="5" cols="5"></textarea>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-1 hidden" id="div_ps_add_ons">
                            <br>
                            <label class="form-label">Add-ons <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" type="text" name="ps_add_ons" id="ps_add_ons" placeholder="Enter Add-ons"
                                    rows="5" cols="5"></textarea>
                            </div>
                        </div>
                    </div>


                    <br>
                    <h3 class="heading">Inventory/Availability (For Product)</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Stock <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_stock" id="ps_stock"
                                    placeholder="Enter Stock" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_sku" id="ps_sku"
                                    placeholder="Enter SKU" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Shipping Options <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_shipping_option" id="ps_shipping_option"
                                    placeholder="Enter Shipping Options" required>
                            </div>
                        </div>

                    </div>

                    <br>
                    <h3 class="heading">Media Upload</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="ps_image">Image <span class="req" style="color: red">*</span>
                                <span title="Please upload jpg,jpge,png & 2 MB size file only" class="menu_icon"><i
                                        class="material-icons">&#xE88F;</i></span></label>
                            <div class="parsley-row">
                                <input type="file" name="ps_image"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>


                        <div class="uk-width-medium-1-3">
                            <label class="form-label" for="formFile1">Brochure <span
                                    title="Please upload min 2 MB size file only">
                                    <i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                            </label>
                            <div class="parsley-row">
                                <input type="file" name="ps_brochure"
                                    onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label class="form-label">Video Link (optional)</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_video_url" id="ps_video_url"
                                    placeholder="Enter Video (optional)">
                            </div>
                        </div>
                    </div>

                    <br>
                    <h3 class="heading">Contact Information</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Contact Name <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_contact_name" id="ps_contact_name"
                                    placeholder="Enter Contact Name" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_contact_number" id="ps_contact_number"
                                    placeholder="Enter Phone Number" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">WhatsApp</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_contact_whatsapp"
                                    id="ps_contact_whatsapp" placeholder="Enter WhatsApp">
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="email" name="ps_contact_email" id="ps_contact_email"
                                    placeholder="Enter Email" required>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Website URL </label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_website_url" id="ps_website_url"
                                    placeholder="Enter Website URL">
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Portfolio Links</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_portfolio_url" id="ps_portfolio_url"
                                    placeholder="Enter Portfolio Links">
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Facebook Link</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_facebook_url" id="ps_facebook_url"
                                    placeholder="Enter Facebook Link">
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Instagram Link</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_instagram_url" id="ps_instagram_url"
                                    placeholder="Enter Instagram Link">
                            </div>
                        </div>


                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Twitter Link</label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_twitter_url" id="ps_twitter_url"
                                    placeholder="Enter Twitter Link">
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Other Link </label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_other_url" id="ps_other_url"
                                    placeholder="Enter Other Link">
                            </div>
                        </div>

                    </div>
                    <br>
                    <h3 class="heading">Visibility & Other Settings</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Visibility <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <select name="ps_visibility" id="ps_visibility" class="md-input" required>
                                    <option value="">Select</option>
                                    <option value="Public">Public</option>
                                    <option value="Private">Private</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Featured Listing <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_featured_listing"
                                    id="ps_featured_listing" placeholder="Enter Featured Listing" required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="date" name="ps_expiry_date" id="ps_expiry_date"
                                    required>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-4">
                            <label class="form-label">Tags / Keywords (Products/Services) <span
                                    class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <input class="md-input" type="text" name="ps_tags_keywords" id="ps_tags_keywords"
                                    placeholder="Tags / Keywords (Products/Services)" required>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h3 class="heading">Description</h3>
                    <br>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" name="ps_short_description" id="ps_short_description"
                                    placeholder="Enter Short Description" required></textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <label class="form-label">Detail Description <span class="text-danger">*</span></label>
                            <br>
                            <textarea class="md-input" id="editor" name="ps_detail_description" id="ps_detail_description" required></textarea>
                        </div>

                        <div class="uk-width-1-1">
                             <label for="bus_meta_description">Admin Comment</label>
                             <div class="parsley-row">
                                <textarea class="md-input" name="ps_admin_comment" cols="10" rows="8"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <button type="submit" class="md-btn md-btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        initSample();
        jQuery(document).ready(function() {
            jQuery('#catmain_id').change(function() {
                var catmain_id = jQuery(this).val()
                jQuery.ajax({
                    url: '/admin/getBlogSubCategory',
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
            jQuery('#mall_id').change(function() {
                var mall_id = jQuery(this).val()
                jQuery.ajax({
                    url: '/admin/getmallBrands',
                    type: 'POST',
                    data: 'mall_id=' + mall_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#brand_id').html(result)
                    }
                });
            });
        });

        function additionalOptions() {

            const ps_additional_options = document.getElementById('ps_additional_options');
            const div_ps_size = document.getElementById('div_ps_size');
            const div_ps_color = document.getElementById('div_ps_color');
            const div_ps_return_policy = document.getElementById('div_ps_return_policy');
            const div_ps_cancellation_policy = document.getElementById('div_ps_cancellation_policy');
            const div_ps_add_ons = document.getElementById('div_ps_add_ons');

            if (ps_additional_options.value == 'Products') {
                div_ps_cancellation_policy.classList.add('hidden');
                div_ps_add_ons.classList.add('hidden');

                div_ps_cancellation_policy.classList.remove('visible');
                div_ps_add_ons.classList.remove('visible');

                div_ps_size.classList.add('visible');
                div_ps_color.classList.add('visible');
                div_ps_return_policy.classList.add('visible');

                document.getElementById('ps_cancellation_policy').required = false;
                document.getElementById('ps_add_ons').required = false;

                document.getElementById('ps_size').required = true;
                document.getElementById('ps_color').required = true;
                document.getElementById('ps_return_policy').required = true;

            } else {
                div_ps_cancellation_policy.classList.add('visible');
                div_ps_add_ons.classList.add('visible');

                div_ps_size.classList.add('hidden');
                div_ps_color.classList.add('hidden');
                div_ps_return_policy.classList.add('hidden');

                div_ps_size.classList.remove('visible');
                div_ps_color.classList.remove('visible');
                div_ps_return_policy.classList.remove('visible');

                document.getElementById('ps_cancellation_policy').required = true;
                document.getElementById('ps_add_ons').required = true;

                document.getElementById('ps_size').required = false;
                document.getElementById('ps_color').required = false;
                document.getElementById('ps_return_policy').required = false;

            }
        }
    </script>
@endsection
