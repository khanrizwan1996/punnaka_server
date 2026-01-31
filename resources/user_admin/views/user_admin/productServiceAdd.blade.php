@extends('user_admin.layouts.main')
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

    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                 <div class="col-sm-6">
                    <h3>Product & Service</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'dashboard')}}">Dashboard</a> / </li>
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'productServiceList')}}">Product & Service List</a> / </li>
                            <li class="breadcrumb-item active">Add Product & Service</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if (session('message'))
            <div class="card-body live-dark">
                <div class="row">
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
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                <form class="card" method="POST" action="{{ url(USER_ADMIN_URL.'productServiceStore') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="row">
                      <h3 class="heading">Basic Information</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Title <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" placeholder="Enter Title" name="ps_title" id="ps_title" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Category <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" required name="ps_main_cat" id="catmain_id">
                            <option value="">Select</option>
                              @foreach ($mainCategoryData as $mainCategoryRow)
                                <option value="{{ $mainCategoryRow['cat_main_id'] }}" >{{ $mainCategoryRow['cat_main_name'] }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Sub Category <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" required id="catsub_id" name="ps_sub_cat">
                            <option value="">Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Listing Type <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" name="ps_listing_type" id="ps_listing_type" required>
                            <option value="">Select</option>
                            <option value="Product">Product</option>
                            <option value="Service">Service</option>
                            <option value="Both">Both</option>
                          </select>
                        </div>
                      </div>

                      <h3 class="heading">Pricing</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Pricing Type <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" name="ps_pricing_type" id="ps_pricing_type" required>
                            <option value="">Select</option>
                            <option value="Fixed">Fixed</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Range">Range</option>
                            <option value="Package Price">Package Price</option>
                            <option value="Contact for price">Contact for price</option>
                          </select>
                        </div>
                      </div>

                       <div class="col-md-2">
                        <div class="mb-3">
                          <label class="form-label">Currency</label>
                           <select class="form-control mt-2" name="ps_currency" id="ps_currency">
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

                       <div class="col-md-2">
                        <div class="mb-3">
                          <label class="form-label">Price / Range <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_price_range" id="ps_price_range" placeholder="Enter Price / Range" required>
                        </div>
                      </div>
                      
                      <div class="col-md-2">
                        <div class="mb-3">
                          <label class="form-label">Discount (if any)</label>
                          <input class="form-control mt-2" type="text" name="ps_discount" id="ps_discount" placeholder="Enter Discount (if any)">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Tax (optional)</label>
                          <input class="form-control mt-2" type="text" name="ps_tax" id="ps_tax" placeholder="Enter GST, VAT, HST, Percentage%">
                        </div>
                      </div>

                      
                      <h3 class="heading">Location & Availability</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Country <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_country" id="ps_country" placeholder="Enter Country" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">State <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_state" id="ps_state" placeholder="Enter State" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">City <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_city" id="ps_city" placeholder="Enter City" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div>
                          <label class="form-label">Service Area <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" name="ps_service_area" id="ps_service_area" required>
                            <option value="">Select</option>
                            <option value="Local">Local</option>
                            <option value="National">National</option>
                            <option value="Global">Global</option>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Availability (For Services) Date Time <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="datetime-local" name="ps_availability_date_time" id="ps_availability_date_time" placeholder="Enter Availability (For Services) Date Time" required>
                        </div>
                      </div>


                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Additional Options <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" required id="ps_additional_options" name="ps_additional_options" onchange="additionalOptions()">
                            <option value="">Select</option>
                            <option value="Products">Products</option>
                            <option value="Services">Services</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-3 hidden" id="div_ps_size">
                        <div class="mb-3">
                          <label class="form-label">Size <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_size" id="ps_size" placeholder="Enter Size" required>
                        </div>
                      </div>


                      <div class="col-md-3 hidden" id="div_ps_color">
                        <div class="mb-3">
                          <label class="form-label">Color <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_color" id="ps_color" placeholder="Enter Color">
                        </div>
                      </div>

                      <div class="col-md-12 hidden" id="div_ps_return_policy">
                        <div class="mb-3">
                          <label class="form-label">Return Policy <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" type="text" name="ps_return_policy" id="ps_return_policy" placeholder="Enter Return Policy" rows="5" cols="5" required></textarea>
                        </div>
                      </div>


                      <div class="col-md-12 hidden" id="div_ps_cancellation_policy">
                        <div class="mb-3">
                          <label class="form-label">Cancellation Policy <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" type="text" name="ps_cancellation_policy" id="ps_cancellation_policy" placeholder="Enter Cancellation Policy" rows="5" cols="5" required></textarea>
                        </div>
                      </div>

                       <div class="col-md-12 hidden" id="div_ps_add_ons">
                        <div class="mb-3">
                          <label class="form-label">Add-ons <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" type="text" name="ps_add_ons" id="ps_add_ons" placeholder="Enter Add-ons" rows="5" cols="5" required></textarea>
                        </div>
                      </div>

                      
                      <h3 class="heading">Inventory/Availability (For Product)</h3>
                      
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Stock <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_stock" id="ps_stock" placeholder="Enter Stock" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">SKU <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_sku" id="ps_sku" placeholder="Enter SKU" required>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Shipping Options <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_shipping_option" id="ps_shipping_option" placeholder="Enter Shipping Options" required>
                        </div>
                      </div>


                      <h3 class="heading">Media Upload</h3>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Image <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="file" name="ps_image" id="ps_image" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Video Link (optional)</label>
                          <input class="form-control mt-2" type="text" name="ps_video_url" id="ps_video_url" placeholder="Enter Video (optional)">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Brochure (optional)</label>
                          <input class="form-control mt-2" type="file" name="ps_brochure" id="ps_brochure">
                        </div>
                      </div>

                      <h3 class="heading">Contact Information</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Contact Name <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_contact_name" id="ps_contact_name" placeholder="Enter Contact Name" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_contact_number" id="ps_contact_number" placeholder="Enter Phone Number" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">WhatsApp</label>
                          <input class="form-control mt-2" type="text" name="ps_contact_whatsapp" id="ps_contact_whatsapp" placeholder="Enter WhatsApp">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Email <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="email" name="ps_contact_email" id="ps_contact_email" placeholder="Enter Email" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Website URL </label>
                          <input class="form-control mt-2" type="text" name="ps_website_url" id="ps_website_url" placeholder="Enter Website URL">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Portfolio Links</label>
                          <input class="form-control mt-2" type="text" name="ps_portfolio_url" id="ps_portfolio_url" placeholder="Enter Portfolio Links">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Facebook Link</label>
                          <input class="form-control mt-2" type="text" name="ps_facebook_url" id="ps_facebook_url" placeholder="Enter Facebook Link">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Instagram Link</label>
                          <input class="form-control mt-2" type="text" name="ps_instagram_url" id="ps_instagram_url" placeholder="Enter Instagram Link">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Twitter Link</label>
                          <input class="form-control mt-2" type="text" name="ps_twitter_url" id="ps_twitter_url" placeholder="Enter Twitter Link">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Other Link </label>
                          <input class="form-control mt-2" type="text" name="ps_other_url" id="ps_other_url" placeholder="Enter Other Link">
                        </div>
                      </div>

                      <h3 class="heading">Visibility & Other Settings</h3>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Visibility <span class="text-danger">*</span></label>
                          <select name="ps_visibility" id="ps_visibility" class="form-control mt-2" required>
                            <option value="">Select</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Featured Listing <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_featured_listing" id="ps_featured_listing" placeholder="Enter Featured Listing" required>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="date" name="ps_expiry_date" id="ps_expiry_date" required>
                        </div>
                      </div>
                      
                       <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label">Tags / Keywords (Products/Services) <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_tags_keywords" id="ps_tags_keywords" placeholder="Tags / Keywords (Products/Services)" required>
                        </div>
                      </div>

                      <h3 class="heading">Description</h3>

                       <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label">Short Description <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" name="ps_short_description" id="ps_short_description" placeholder="Enter Short Description" required></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label">Detail Description <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" id="editor" name="ps_detail_description" id="ps_detail_description" placeholder="Enter Detail Description" required></textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Terms Agreement <span class="text-danger">*</span></label>
                          <input type="checkbox" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-center">
                    <button class="btn btn-primary" type="submit" fdprocessedid="72s4l">Submit</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
    <script>
    initSample();
    jQuery(document).ready(function(){
        jQuery('#catmain_id').change(function(){
            var catmain_id = jQuery(this).val()
            jQuery.ajax({
                url:'/admin/getBlogSubCategory',
                type:'POST',
                data:'catmain_id='+catmain_id+'&_token={{csrf_token()}}',
                success:function(result){
                    jQuery('#catsub_id').html(result)
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
     
        if(ps_additional_options.value == 'Products') {
            div_ps_cancellation_policy.classList.add('hidden');
            div_ps_add_ons.classList.add('hidden');

            div_ps_cancellation_policy.classList.remove('visible');
            div_ps_add_ons.classList.remove('visible');

            div_ps_size.classList.add('visible');
            div_ps_color.classList.add('visible');
            div_ps_return_policy.classList.add('visible');

            document.getElementById('ps_cancellation_policy').required=false;
            document.getElementById('ps_add_ons').required=false;
            
            document.getElementById('ps_size').required=true;
            document.getElementById('ps_color').required=true;
            document.getElementById('ps_return_policy').required=true;

        }else{
            div_ps_cancellation_policy.classList.add('visible');
            div_ps_add_ons.classList.add('visible');

            div_ps_size.classList.add('hidden');
            div_ps_color.classList.add('hidden');
            div_ps_return_policy.classList.add('hidden');

            div_ps_size.classList.remove('visible');
            div_ps_color.classList.remove('visible');
            div_ps_return_policy.classList.remove('visible');

            document.getElementById('ps_cancellation_policy').required=true;
            document.getElementById('ps_add_ons').required=true;
            
            document.getElementById('ps_size').required=false;
            document.getElementById('ps_color').required=false;
            document.getElementById('ps_return_policy').required=false;
        }
    }
  </script>
@endsection
