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
                            <li class="breadcrumb-item active">Edit Product & Service</li>
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
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">

                <div class="card">
                    <div class="card-body checkbox-checked">
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Selected Main Category : <span style="color:#3fb4e4">{{ $getProductServiceData['ps_main_cat'] }}</span> </h5>
                            </div>
                            <div class="col-md-6">
                                <h5>Selected Sub Category : <span style="color:#3fb4e4">{{ $getProductServiceData['ps_sub_cat'] }}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form class="card" method="POST" action="{{ url(USER_ADMIN_URL.'productServiceUpdate/'.$getProductServiceData['ps_id']) }}" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="old_ps_image" value="{{ $getProductServiceData['ps_image'] }}">
                <input type="hidden" name="old_ps_brochure" value="{{ $getProductServiceData['ps_brochure'] }}">
                <input type="hidden" name="old_ps_main_cat" value="{{ $getProductServiceData['ps_main_cat'] }}">
                <input type="hidden" name="old_ps_sub_cat" value="{{ $getProductServiceData['ps_sub_cat'] }}">

                  <div class="card-body">
                    <div class="row">
                      <h3 class="heading">Basic Information</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Title <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" placeholder="Enter Title" value="{{$getProductServiceData['ps_title'] }}" name="ps_title" id="ps_title" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Category</label>
                          <select class="form-control mt-2" name="ps_main_cat" id="catmain_id">
                            <option value="">Select</option>
                              @foreach ($mainCategoryData as $mainCategoryRow)
                                <option value="{{ $mainCategoryRow['cat_main_id'] }}" >{{ $mainCategoryRow['cat_main_name'] }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Sub Category</label>
                          <select class="form-control mt-2" id="catsub_id" name="ps_sub_cat">
                            <option value="">Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Listing Type <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" name="ps_listing_type" id="ps_listing_type" required>
                            <option value="">Select</option>
                            <option value="Product" @if($getProductServiceData['ps_listing_type'] == 'Product') selected style="color:red" @endif>Product</option>
                            <option value="Service" @if($getProductServiceData['ps_listing_type'] == 'Service') selected style="color:red" @endif>Service</option>
                            <option value="Both" @if($getProductServiceData['ps_listing_type'] == 'Both') selected style="color:red" @endif>Both</option>
                          </select>
                        </div>
                      </div>

                      <h3 class="heading">Pricing</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Pricing Type <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" name="ps_pricing_type" id="ps_pricing_type" required>
                            <option value="">Select</option>
                            <option value="Fixed" @if($getProductServiceData['ps_pricing_type'] == 'Fixed') selected style="color:red" @endif>Fixed</option>
                            <option value="Hourly" @if($getProductServiceData['ps_pricing_type'] == 'Hourly') selected style="color:red" @endif>Hourly</option>
                            <option value="Range" @if($getProductServiceData['ps_pricing_type'] == 'Range') selected style="color:red" @endif>Range</option>
                            <option value="Package Price" @if($getProductServiceData['ps_pricing_type'] == 'Package Price') selected style="color:red" @endif>Package Price</option>
                            <option value="Contact for price" @if($getProductServiceData['ps_pricing_type'] == 'Contact for price') selected style="color:red" @endif>Contact for price</option>
                          </select>
                        </div>
                      </div>

                       <div class="col-md-2">
                        <div class="mb-3">
                          <label class="form-label">Currency</label>
                          <select class="form-control mt-2" name="ps_currency" id="ps_currency">
                          <option value="">Select</option>
                          <option value="AED" @if($getProductServiceData['ps_currency'] == 'AED') selected style="color:red" @endif>AED</option>
                          <option value="AFN" @if($getProductServiceData['ps_currency'] == 'AFN') selected style="color:red" @endif>AFN</option>
                          <option value="ALL" @if($getProductServiceData['ps_currency'] == 'ALL') selected style="color:red" @endif>ALL</option>
                          <option value="AMD" @if($getProductServiceData['ps_currency'] == 'AMD') selected style="color:red" @endif>AMD</option>
                          <option value="ANG" @if($getProductServiceData['ps_currency'] == 'ANG') selected style="color:red" @endif>ANG</option>
                          <option value="AOA" @if($getProductServiceData['ps_currency'] == 'AOA') selected style="color:red" @endif>AOA</option>
                          <option value="ARS" @if($getProductServiceData['ps_currency'] == 'ARS') selected style="color:red" @endif>ARS</option>
                          <option value="AUD" @if($getProductServiceData['ps_currency'] == 'AUD') selected style="color:red" @endif>AUD</option>
                          <option value="AWG" @if($getProductServiceData['ps_currency'] == 'AWG') selected style="color:red" @endif>AWG</option>
                          <option value="AZN" @if($getProductServiceData['ps_currency'] == 'AZN') selected style="color:red" @endif>AZN</option>
                          <option value="BAM" @if($getProductServiceData['ps_currency'] == 'BAM') selected style="color:red" @endif>BAM</option>
                          <option value="BBD" @if($getProductServiceData['ps_currency'] == 'BBD') selected style="color:red" @endif>BBD</option>
                          <option value="BDT" @if($getProductServiceData['ps_currency'] == 'BDT') selected style="color:red" @endif>BDT</option>
                          <option value="BGN" @if($getProductServiceData['ps_currency'] == 'BGN') selected style="color:red" @endif>BGN</option>
                          <option value="BHD" @if($getProductServiceData['ps_currency'] == 'BHD') selected style="color:red" @endif>BHD</option>
                          <option value="BIF" @if($getProductServiceData['ps_currency'] == 'BIF') selected style="color:red" @endif>BIF</option>
                          <option value="BMD" @if($getProductServiceData['ps_currency'] == 'BMD') selected style="color:red" @endif>BMD</option>
                          <option value="BND" @if($getProductServiceData['ps_currency'] == 'BND') selected style="color:red" @endif>BND</option>
                          <option value="BOB" @if($getProductServiceData['ps_currency'] == 'BOB') selected style="color:red" @endif>BOB</option>
                          <option value="BRL" @if($getProductServiceData['ps_currency'] == 'BRL') selected style="color:red" @endif>BRL</option>
                          <option value="BSD" @if($getProductServiceData['ps_currency'] == 'BSD') selected style="color:red" @endif>BSD</option>
                          <option value="BTN" @if($getProductServiceData['ps_currency'] == 'BTN') selected style="color:red" @endif>BTN</option>
                          <option value="BWP" @if($getProductServiceData['ps_currency'] == 'BWP') selected style="color:red" @endif>BWP</option>
                          <option value="BYN" @if($getProductServiceData['ps_currency'] == 'BYN') selected style="color:red" @endif>BYN</option>
                          <option value="BZD" @if($getProductServiceData['ps_currency'] == 'BZD') selected style="color:red" @endif>BZD</option>
                          <option value="CAD" @if($getProductServiceData['ps_currency'] == 'CAD') selected style="color:red" @endif>CAD</option>
                          <option value="CDF" @if($getProductServiceData['ps_currency'] == 'CDF') selected style="color:red" @endif>CDF</option>
                          <option value="CHF" @if($getProductServiceData['ps_currency'] == 'CHF') selected style="color:red" @endif>CHF</option>
                          <option value="CLP" @if($getProductServiceData['ps_currency'] == 'CLP') selected style="color:red" @endif>CLP</option>
                          <option value="CNY" @if($getProductServiceData['ps_currency'] == 'CNY') selected style="color:red" @endif>CNY</option>
                          <option value="COP" @if($getProductServiceData['ps_currency'] == 'COP') selected style="color:red" @endif>COP</option>
                          <option value="CRC" @if($getProductServiceData['ps_currency'] == 'CRC') selected style="color:red" @endif>CRC</option>
                          <option value="CUP" @if($getProductServiceData['ps_currency'] == 'CUP') selected style="color:red" @endif>CUP</option>
                          <option value="CVE" @if($getProductServiceData['ps_currency'] == 'CVE') selected style="color:red" @endif>CVE</option>
                          <option value="CZK" @if($getProductServiceData['ps_currency'] == 'CZK') selected style="color:red" @endif>CZK</option>
                          <option value="DJF" @if($getProductServiceData['ps_currency'] == 'DJF') selected style="color:red" @endif>DJF</option>
                          <option value="DKK" @if($getProductServiceData['ps_currency'] == 'DKK') selected style="color:red" @endif>DKK</option>
                          <option value="DOP" @if($getProductServiceData['ps_currency'] == 'DOP') selected style="color:red" @endif>DOP</option>
                          <option value="DZD" @if($getProductServiceData['ps_currency'] == 'DZD') selected style="color:red" @endif>DZD</option>
                          <option value="EGP" @if($getProductServiceData['ps_currency'] == 'EGP') selected style="color:red" @endif>EGP</option>
                          <option value="ERN" @if($getProductServiceData['ps_currency'] == 'ERN') selected style="color:red" @endif>ERN</option>
                          <option value="ETB" @if($getProductServiceData['ps_currency'] == 'ETB') selected style="color:red" @endif>ETB</option>
                          <option value="EUR" @if($getProductServiceData['ps_currency'] == 'EUR') selected style="color:red" @endif>EUR</option>
                          <option value="FJD" @if($getProductServiceData['ps_currency'] == 'FJD') selected style="color:red" @endif>FJD</option>
                          <option value="FKP" @if($getProductServiceData['ps_currency'] == 'FKP') selected style="color:red" @endif>FKP</option>
                          <option value="GBP" @if($getProductServiceData['ps_currency'] == 'GBP') selected style="color:red" @endif>GBP</option>
                          <option value="GEL" @if($getProductServiceData['ps_currency'] == 'GEL') selected style="color:red" @endif>GEL</option>
                          <option value="GHS" @if($getProductServiceData['ps_currency'] == 'GHS') selected style="color:red" @endif>GHS</option>
                          <option value="GIP" @if($getProductServiceData['ps_currency'] == 'GIP') selected style="color:red" @endif>GIP</option>
                          <option value="GMD" @if($getProductServiceData['ps_currency'] == 'GMD') selected style="color:red" @endif>GMD</option>
                          <option value="GNF" @if($getProductServiceData['ps_currency'] == 'GNF') selected style="color:red" @endif>GNF</option>
                          <option value="GTQ" @if($getProductServiceData['ps_currency'] == 'GTQ') selected style="color:red" @endif>GTQ</option>
                          <option value="GYD" @if($getProductServiceData['ps_currency'] == 'GYD') selected style="color:red" @endif>GYD</option>
                          <option value="HKD" @if($getProductServiceData['ps_currency'] == 'HKD') selected style="color:red" @endif>HKD</option>
                          <option value="HNL" @if($getProductServiceData['ps_currency'] == 'HNL') selected style="color:red" @endif>HNL</option>
                          <option value="HRK" @if($getProductServiceData['ps_currency'] == 'HRK') selected style="color:red" @endif>HRK</option>
                          <option value="HTG" @if($getProductServiceData['ps_currency'] == 'HTG') selected style="color:red" @endif>HTG</option>
                          <option value="HUF" @if($getProductServiceData['ps_currency'] == 'HUF') selected style="color:red" @endif>HUF</option>
                          <option value="IDR" @if($getProductServiceData['ps_currency'] == 'IDR') selected style="color:red" @endif>IDR</option>
                          <option value="ILS" @if($getProductServiceData['ps_currency'] == 'ILS') selected style="color:red" @endif>ILS</option>
                          <option value="INR" @if($getProductServiceData['ps_currency'] == 'INR') selected style="color:red" @endif>INR</option>
                          <option value="IQD" @if($getProductServiceData['ps_currency'] == 'IQD') selected style="color:red" @endif>IQD</option>
                          <option value="IRR" @if($getProductServiceData['ps_currency'] == 'IRR') selected style="color:red" @endif>IRR</option>
                          <option value="ISK" @if($getProductServiceData['ps_currency'] == 'ISK') selected style="color:red" @endif>ISK</option>
                          <option value="JMD" @if($getProductServiceData['ps_currency'] == 'JMD') selected style="color:red" @endif>JMD</option>
                          <option value="JOD" @if($getProductServiceData['ps_currency'] == 'JOD') selected style="color:red" @endif>JOD</option>
                          <option value="JPY" @if($getProductServiceData['ps_currency'] == 'JPY') selected style="color:red" @endif>JPY</option>
                          <option value="KES" @if($getProductServiceData['ps_currency'] == 'KES') selected style="color:red" @endif>KES</option>
                          <option value="KGS" @if($getProductServiceData['ps_currency'] == 'KGS') selected style="color:red" @endif>KGS</option>
                          <option value="KHR" @if($getProductServiceData['ps_currency'] == 'KHR') selected style="color:red" @endif>KHR</option>
                          <option value="KMF" @if($getProductServiceData['ps_currency'] == 'KMF') selected style="color:red" @endif>KMF</option>
                          <option value="KPW" @if($getProductServiceData['ps_currency'] == 'KPW') selected style="color:red" @endif>KPW</option>
                          <option value="KRW" @if($getProductServiceData['ps_currency'] == 'KRW') selected style="color:red" @endif>KRW</option>
                          <option value="KWD" @if($getProductServiceData['ps_currency'] == 'KWD') selected style="color:red" @endif>KWD</option>
                          <option value="KYD" @if($getProductServiceData['ps_currency'] == 'KYD') selected style="color:red" @endif>KYD</option>
                          <option value="KZT" @if($getProductServiceData['ps_currency'] == 'KZT') selected style="color:red" @endif>KZT</option>
                          <option value="LAK" @if($getProductServiceData['ps_currency'] == 'LAK') selected style="color:red" @endif>LAK</option>
                          <option value="LBP" @if($getProductServiceData['ps_currency'] == 'LBP') selected style="color:red" @endif>LBP</option>
                          <option value="LKR" @if($getProductServiceData['ps_currency'] == 'LKR') selected style="color:red" @endif>LKR</option>
                          <option value="LRD" @if($getProductServiceData['ps_currency'] == 'LRD') selected style="color:red" @endif>LRD</option>
                          <option value="LSL" @if($getProductServiceData['ps_currency'] == 'LSL') selected style="color:red" @endif>LSL</option>
                          <option value="LYD" @if($getProductServiceData['ps_currency'] == 'LYD') selected style="color:red" @endif>LYD</option>
                          <option value="MAD" @if($getProductServiceData['ps_currency'] == 'MAD') selected style="color:red" @endif>MAD</option>
                          <option value="MDL" @if($getProductServiceData['ps_currency'] == 'MDL') selected style="color:red" @endif>MDL</option>
                          <option value="MGA" @if($getProductServiceData['ps_currency'] == 'MGA') selected style="color:red" @endif>MGA</option>
                          <option value="MKD" @if($getProductServiceData['ps_currency'] == 'MKD') selected style="color:red" @endif>MKD</option>
                          <option value="MMK" @if($getProductServiceData['ps_currency'] == 'MMK') selected style="color:red" @endif>MMK</option>
                          <option value="MNT" @if($getProductServiceData['ps_currency'] == 'MNT') selected style="color:red" @endif>MNT</option>
                          <option value="MOP" @if($getProductServiceData['ps_currency'] == 'MOP') selected style="color:red" @endif>MOP</option>
                          <option value="MRU" @if($getProductServiceData['ps_currency'] == 'MRU') selected style="color:red" @endif>MRU</option>
                          <option value="MUR" @if($getProductServiceData['ps_currency'] == 'MUR') selected style="color:red" @endif>MUR</option>
                          <option value="MVR" @if($getProductServiceData['ps_currency'] == 'MVR') selected style="color:red" @endif>MVR</option>
                          <option value="MWK" @if($getProductServiceData['ps_currency'] == 'MWK') selected style="color:red" @endif>MWK</option>
                          <option value="MXN" @if($getProductServiceData['ps_currency'] == 'MXN') selected style="color:red" @endif>MXN</option>
                          <option value="MYR" @if($getProductServiceData['ps_currency'] == 'MYR') selected style="color:red" @endif>MYR</option>
                          <option value="MZN" @if($getProductServiceData['ps_currency'] == 'MZN') selected style="color:red" @endif>MZN</option>
                          <option value="NAD" @if($getProductServiceData['ps_currency'] == 'NAD') selected style="color:red" @endif>NAD</option>
                          <option value="NGN" @if($getProductServiceData['ps_currency'] == 'NGN') selected style="color:red" @endif>NGN</option>
                          <option value="NIO" @if($getProductServiceData['ps_currency'] == 'NIO') selected style="color:red" @endif>NIO</option>
                          <option value="NOK" @if($getProductServiceData['ps_currency'] == 'NOK') selected style="color:red" @endif>NOK</option>
                          <option value="USD" @if($getProductServiceData['ps_currency'] == 'USD') selected style="color:red" @endif>USD</option>
                      </select>

                           {{-- <select class="form-control mt-2" name="ps_currency" id="ps_currency">
                              <option value="">Select</option>
                              <option value="INR" @if($getProductServiceData['ps_currency'] == 'INR') selected style="color:red" @endif>INR</option>
                              <option value="EUR" @if($getProductServiceData['ps_currency'] == 'EUR') selected style="color:red" @endif>EUR</option>
                              <option value="USD" @if($getProductServiceData['ps_currency'] == 'USD') selected style="color:red" @endif>USD</option>
                          </select> --}}
                        </div>
                      </div>

                       <div class="col-md-2">
                        <div class="mb-3">
                          <label class="form-label">Price / Range <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_price_range" id="ps_price_range" value="{{$getProductServiceData['ps_price_range'] }}" placeholder="Enter Price / Range" required>
                        </div>
                      </div>
                      
                      <div class="col-md-2">
                        <div class="mb-3">
                          <label class="form-label">Discount (if any)</label>
                          <input class="form-control mt-2" type="text" name="ps_discount" id="ps_discount" value="{{$getProductServiceData['ps_discount'] }}" placeholder="Enter Discount (if any)">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Tax (optional)</label>
                          <input class="form-control mt-2" type="text" name="ps_tax" id="ps_tax" value="{{$getProductServiceData['ps_tax'] }}" placeholder="Enter GST, VAT, HST, Percentage%">
                        </div>
                      </div>

                      
                      <h3 class="heading">Location & Availability</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Country <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_country" id="ps_country" value="{{$getProductServiceData['ps_country'] }}" placeholder="Enter Country" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">State <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_state" id="ps_state" value="{{$getProductServiceData['ps_state'] }}" placeholder="Enter State" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">City <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_city" id="ps_city" value="{{$getProductServiceData['ps_city'] }}" placeholder="Enter City" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div>
                          <label class="form-label">Service Area <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" name="ps_service_area" id="ps_service_area" required>
                            <option value="">Select</option>
                            <option value="Local" @if($getProductServiceData['ps_service_area'] == 'Local') selected style="color:red" @endif>Local</option>
                            <option value="National" @if($getProductServiceData['ps_service_area'] == 'National') selected style="color:red" @endif>National</option>
                            <option value="Global" @if($getProductServiceData['ps_service_area'] == 'Global') selected style="color:red" @endif>Global</option>
                            <option value="Online" @if($getProductServiceData['ps_service_area'] == 'Online') selected style="color:red" @endif>Online</option>
                            <option value="Offline" @if($getProductServiceData['ps_service_area'] == 'Offline') selected style="color:red" @endif>Offline</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Availability (For Services) Date Time <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="datetime-local" name="ps_availability_date_time" value="{{$getProductServiceData['ps_availability_date_time'] }}" id="ps_availability_date_time" placeholder="Enter Availability (For Services) Date Time" required>
                        </div>
                      </div>


                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Additional Options <span class="text-danger">*</span></label>
                          <select class="form-control mt-2" required id="ps_additional_options" name="ps_additional_options" onchange="additionalOptions()">
                            <option value="">Select</option>
                            <option value="Products" @if($getProductServiceData['ps_additional_options'] == 'Products') selected style="color:red" @endif>Products</option>
                            <option value="Services" @if($getProductServiceData['ps_additional_options'] == 'Services') selected style="color:red" @endif>Services</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-3 @if($getProductServiceData['ps_additional_options'] == 'Products') visible @else hidden @endif" id="div_ps_size">
                        <div class="mb-3">
                          <label class="form-label">Size <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_size" id="ps_size" value="{{$getProductServiceData['ps_size'] }}" placeholder="Enter Size">
                        </div>
                      </div>


                      <div class="col-md-3 @if($getProductServiceData['ps_additional_options'] == 'Products') visible @else hidden @endif" id="div_ps_color">
                        <div class="mb-3">
                          <label class="form-label">Color <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_color" id="ps_color" value="{{$getProductServiceData['ps_color'] }}" placeholder="Enter Color">
                        </div>
                      </div>

                      <div class="col-md-12 @if($getProductServiceData['ps_additional_options'] == 'Products') visible @else hidden @endif" id="div_ps_return_policy">
                        <div class="mb-3">
                          <label class="form-label">Return Policy <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" type="text" name="ps_return_policy" id="ps_return_policy" placeholder="Enter Return Policy" rows="5" cols="5">{{$getProductServiceData['ps_return_policy'] }}</textarea>
                        </div>
                      </div>


                      <div class="col-md-12 @if($getProductServiceData['ps_additional_options'] == 'Services') visible @else hidden @endif" id="div_ps_cancellation_policy">
                        <div class="mb-3">
                          <label class="form-label">Cancellation Policy <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" type="text" name="ps_cancellation_policy" id="ps_cancellation_policy" placeholder="Enter Cancellation Policy" rows="5" cols="5" required> {{$getProductServiceData['ps_cancellation_policy'] }}</textarea>
                        </div>
                      </div>

                       <div class="col-md-12 @if($getProductServiceData['ps_additional_options'] == 'Services') visible @else hidden @endif" id="div_ps_add_ons">
                        <div class="mb-3">
                          <label class="form-label">Add-ons <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" type="text" name="ps_add_ons" id="ps_add_ons" placeholder="Enter Add-ons" rows="5" cols="5" required> {{$getProductServiceData['ps_add_ons'] }}</textarea>
                        </div>
                      </div>

                      
                      <h3 class="heading">Inventory/Availability (For Product)</h3>
                      
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Stock <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_stock" id="ps_stock" value="{{$getProductServiceData['ps_stock'] }}" placeholder="Enter Stock" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">SKU <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_sku" id="ps_sku" value="{{$getProductServiceData['ps_sku'] }}" placeholder="Enter SKU" required>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Shipping Options <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_shipping_option" id="ps_shipping_option" value="{{$getProductServiceData['ps_shipping_option'] }}" placeholder="Enter Shipping Options" required>
                        </div>
                      </div>


                      <h3 class="heading">Media Upload</h3>
                      <div class="col-md-4">
                        <div class="mb-3">
                         <label class="form-label" for="formFile1">Image <span title="Please upload jpg,jpge,png & 2 MB size file only">
                            <i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                             <a target="_blank" href="{{asset('custom-images/product-service/'.$getProductServiceData['ps_image'])}}">(View Image)</a></label>
                          <input class="form-control mt-2" type="file" name="ps_image" id="ps_image">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Video Link (optional)</label>
                          <input class="form-control mt-2" type="text" name="ps_video_url" id="ps_video_url" value="{{$getProductServiceData['ps_video_url'] }}" placeholder="Enter Video (optional)">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                           <label class="form-label" for="formFile1">Brochure <span title="Please upload min 2 MB size file only">
                            <i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                             <a target="_blank" href="{{asset('custom-images/product-service/'.$getProductServiceData['ps_brochure'])}}">(View Brochure)</a></label>
                          <input class="form-control mt-2" type="file" name="ps_brochure" id="ps_brochure">
                        </div>
                      </div>

                      <h3 class="heading">Contact Information</h3>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Contact Name <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_contact_name" id="ps_contact_name" value="{{$getProductServiceData['ps_contact_name'] }}" placeholder="Enter Contact Name" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_contact_number" id="ps_contact_number" value="{{$getProductServiceData['ps_contact_number'] }}" placeholder="Enter Phone Number" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">WhatsApp</label>
                          <input class="form-control mt-2" type="text" name="ps_contact_whatsapp" id="ps_contact_whatsapp" value="{{$getProductServiceData['ps_contact_whatsapp'] }}" placeholder="Enter WhatsApp">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Email <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="email" name="ps_contact_email" id="ps_contact_email" value="{{$getProductServiceData['ps_contact_email'] }}" placeholder="Enter Email" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Website URL </label>
                          <input class="form-control mt-2" type="text" name="ps_website_url" id="ps_website_url" value="{{$getProductServiceData['ps_website_url'] }}" placeholder="Enter Website URL">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Portfolio Links</label>
                          <input class="form-control mt-2" type="text" name="ps_portfolio_url" id="ps_portfolio_url" value="{{$getProductServiceData['ps_portfolio_url'] }}" placeholder="Enter Portfolio Links">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Facebook Link</label>
                          <input class="form-control mt-2" type="text" name="ps_facebook_url" id="ps_facebook_url" value="{{$getProductServiceData['ps_facebook_url'] }}" placeholder="Enter Facebook Link">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Instagram Link</label>
                          <input class="form-control mt-2" type="text" name="ps_instagram_url" id="ps_instagram_url" value="{{$getProductServiceData['ps_instagram_url'] }}" placeholder="Enter Instagram Link">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Twitter Link</label>
                          <input class="form-control mt-2" type="text" name="ps_twitter_url" id="ps_twitter_url" value="{{$getProductServiceData['ps_twitter_url'] }}" placeholder="Enter Twitter Link">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Other Link </label>
                          <input class="form-control mt-2" type="text" name="ps_other_url" id="ps_other_url" value="{{$getProductServiceData['ps_other_url'] }}" placeholder="Enter Other Link">
                        </div>
                      </div>

                      <h3 class="heading">Visibility & Other Settings</h3>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Visibility <span class="text-danger">*</span></label>
                          <select name="ps_visibility" id="ps_visibility" class="form-control mt-2" required>
                            <option value="">Select</option>
                            <option value="Public" @if($getProductServiceData['ps_visibility'] == 'Public') selected style="color:red" @endif>Public</option>
                            <option value="Private" @if($getProductServiceData['ps_visibility'] == 'Private') selected style="color:red" @endif>Private</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Featured Listing <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_featured_listing" id="ps_featured_listing" value="{{$getProductServiceData['ps_featured_listing'] }}" placeholder="Enter Featured Listing" required>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="date" name="ps_expiry_date" value="{{$getProductServiceData['ps_expiry_date'] }}" id="ps_expiry_date" required>
                        </div>
                      </div>
                      
                       <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label">Tags / Keywords (Products/Services) <span class="text-danger">*</span></label>
                          <input class="form-control mt-2" type="text" name="ps_tags_keywords" value="{{$getProductServiceData['ps_tags_keywords'] }}" id="ps_tags_keywords" placeholder="Tags / Keywords (Products/Services)" required>
                        </div>
                      </div>

                      <h3 class="heading">Description</h3>

                       <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label">Short Description <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" name="ps_short_description" id="ps_short_description" placeholder="Enter Short Description" required>{{$getProductServiceData['ps_short_description'] }}</textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label">Detail Description <span class="text-danger">*</span></label>
                          <textarea class="form-control mt-2" id="editor" name="ps_detail_description" id="ps_detail_description" placeholder="Enter Detail Description" required>{{$getProductServiceData['ps_detail_description'] }}</textarea>
                        </div>
                      </div>
                      {{-- <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Terms Agreement <span class="text-danger">*</span></label>
                          <input type="checkbox" required>
                        </div>
                      </div> --}}

                      <div class="col-md-3">
                          <label class="form-label">Status</label>
                          <select class="form-control mt-2" name="ps_status" id="ps_status" required>
                            <option value="">Select</option>
                            <option value="{{STATUS_ACTIVE}}" @if($getProductServiceData['ps_status'] == STATUS_ACTIVE ) selected style="color:red" @endif>Active</option>
                            <option value="{{STATUS_INACTIVE}}" @if($getProductServiceData['ps_status'] == STATUS_INACTIVE ) selected style="color:red" @endif>In Active</option>
                          </select>
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