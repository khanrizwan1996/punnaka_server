@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js')}}"></script>
<script src="{{ asset('admin/assets/js/sample.js')}}"></script>

    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('admin/businessListing')}}">Business Listing List</a></li>
                <li><a href="{{ url('admin/businessListingTimingEdit/' . Route::input('id') . '') }}">Business Timing Edit</a></li>
                <li><a href="{{ url('admin/businessListingImagesEdit/' . Route::input('id') . '') }}">Business Images</a></li>
                <li><span>Business Listing Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Business Edit Details</h3>

        @if(session('message'))
            @if(session('message') == MSG_UPDATE_SUCCESS)
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

        @if($errors->any())
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
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Main Category : <span style="color:#1976d2"> {{ $businessListingEditData['bus_main_cat'] }}</span></label>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Selected Sub Category : <span style="color:#1976d2"> {{ $businessListingEditData['bus_sub_cat'] }}</span></label>
                    </div>
                </div>
            </div>
        </div>
                <div class="md-card">
                    <div class="md-card-content large-padding">
                <form id="form_validation" method="POST" action="{{url('/admin/businessListingUpdate/'.$businessListingEditData['bus_id']) }}" enctype="multipart/form-data" class="uk-form-stacked">
                    @csrf
                    <input type="hidden" name="old_bus_main_cat" value="{{ $businessListingEditData['bus_main_cat'] }}">
                    <input type="hidden" name="old_bus_sub_cat" value="{{ $businessListingEditData['bus_sub_cat'] }}">
                    <input type="hidden" name="old_bus_payment_mode" value="{{ $businessListingEditData['bus_payment_mode'] }}">

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="bus_main_cat">Business Category</label>
                            <div class="parsley-row">
                                <select class="md-input" name="bus_main_cat" id="catmain_id">
                                    <option value="">Select</option>
                                    @foreach ($businessListingMainArray as $businessListingEditRow)
                                    <option value="{{ $businessListingEditRow['cat_main_id'] }}" >{{ $businessListingEditRow['cat_main_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Sub Category</label>
                            <div class="parsley-row">
                                <select class="md-input" name="bus_sub_cat" id="catsub_id">
                                    <option value="{{ $businessListingEditData['bus_sub_cat'] }}">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_image">Status</label>
                            <div class="parsley-row">
                                <select class="md-input" name="bus_status">
                                    <option value="">Choose..</option>
                                    <option value="{{STATUS_ACTIVE}}" @if($businessListingEditData['bus_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active</option>
                                    <option value="{{STATUS_INACTIVE}}"  @if($businessListingEditData['bus_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>

                                    <option value="{{STATUS_DUPLICATE}}"  @if($businessListingEditData['bus_status'] == STATUS_DUPLICATE) selected style="color:red" @endif>Duplicate</option>

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        {{-- <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Full Name <span class="req" style="color: red">*</span></label>
                                <input type="text" name="user_name"  required class="md-input" value="{{ $businessListingEditData['name'] }}" disabled/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <label for="blog_detail">Contact No <span class="req" style="color: red">*</span></label>
                                <input type="text" name="user_contact_no" required class="md-input" value="{{ $businessListingEditData['contact_no'] }}" disabled/>
                            </div>
                        </div> --}}
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Name <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="bus_name" required class="md-input" value="{{ $businessListingEditData['bus_name'] }}"/>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Contact No <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="bus_contact_no" required class="md-input" value="{{ $businessListingEditData['bus_contact_no'] }}"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Alt Business Contact No</label>
                            <div class="parsley-row">
                                <input type="text" name="bus_alt_contact_no" class="md-input" value="{{ $businessListingEditData['bus_alt_contact_no'] }}"/>
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Email Address <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="email" name="bus_email" required class="md-input" value="{{ $businessListingEditData['bus_email'] }}"/>
                            </div>
                        </div>

                         <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Location (Country) <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="bus_country" required class="md-input" value="{{ $businessListingEditData['bus_country'] }}"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Location (State) <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="bus_state" required class="md-input" value="{{ $businessListingEditData['bus_state'] }}"/>
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                       
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Location (City) <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="bus_city" required class="md-input" value="{{ $businessListingEditData['bus_city'] }}" />
                            </div>
                        </div>
                   
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Area PIN Code <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="bus_pin_code" required class="md-input" value="{{ $businessListingEditData['bus_pin_code'] }}" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_detail">Business Address (Physical Location) <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea name="bus_address1" required class="md-input" >{{$businessListingEditData['bus_address1']}}</textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_detail">Business Address (Area Name)<span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea name="bus_address2" required class="md-input" >{{$businessListingEditData['bus_address2']}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Start / Opening Year <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <select class="md-input" name="bus_start_year">
                                    @php
                                    $cureentYear = date('Y');
                                    $year = 1800;
                                    @endphp
                                    @foreach (range('2100', $year) as $yearValue)
                                        <option value="{{ $yearValue }}"
                                            @if ($yearValue == $businessListingEditData['bus_start_year']) selected style="color:red" @endif>
                                            {{ $yearValue }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Website URL</label>
                            <div class="parsley-row">
                                <input type="text" name="bus_website_url" class="md-input" value="{{ $businessListingEditData['bus_website_url'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Facebook URL <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="text" name="bus_facebook_url" class="md-input" value="{{ $businessListingEditData['bus_facebook_url'] }}" />
                            </div>
                        </div>

                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Instagram URL</label>
                            <div class="parsley-row">
                                <input type="text" name="bus_instagram_url" class="md-input" value="{{ $businessListingEditData['bus_instagram_url'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Twitter URL</label>
                            <div class="parsley-row">
                                <input type="text" name="bus_twitter_url" class="md-input" value="{{ $businessListingEditData['bus_twitter_url'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label for="blog_detail">Business Video</label>
                            <div class="parsley-row">
                                <input type="text" name="bus_video_url" class="md-input" value="{{ $businessListingEditData['bus_video_url'] }}" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <label for="blog_detail">Payment Mode : (<span style="color: red; font-weight:bold"> {{$businessListingEditData['bus_payment_mode'] }}</span> )</label>
                            <div class="parsley-row">
                                <select class="md-input" name="bus_payment_mode[]" multiple>
                                    <option>Select</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Debit Card">Debit Card</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="PhonePe">PhonePe</option>
                                    <option value="Google Pay">Google Pay</option>
                                    <option value="BHIM">BHIM</option>
                                    <option value="Paytm">Paytm</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="Online Money Transfer">Online Money Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-width-medium-1-1">
                                <label for="blog_detail">Discounts / Offers</label>
                                <div class="parsley-row">
                                    <input type="text" name="bus_punnaka_discount" class="md-input" value="{{ $businessListingEditData['bus_punnaka_discount'] }}" />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-1">
                                <label for="blog_detail">Average price range / fee</label>
                                <div class="parsley-row">
                                    <input type="text" name="bus_avg_price_range" class="md-input" value="{{ $businessListingEditData['bus_avg_price_range'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">All of the products & services provided in details</label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="tags" name="bus_product_service" cols="10" rows="8" required>{{ $businessListingEditData['bus_product_service'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Brief description of your business <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <textarea class="md-input" id="editor" name="bus_desc" cols="10" rows="8" required>{{ $businessListingEditData['bus_desc'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Business Tags</label>
                            <div class="parsley-row">
                                <textarea class="md-input tags" name="bus_tags" cols="10" rows="8" required>{{$businessListingEditData['bus_tags']}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Location Tags</label>
                            <div class="parsley-row">
                                <textarea class="md-input tags" id="tags" name="bus_location_tags" cols="10" rows="8" required>{{$businessListingEditData['bus_location_tags']}}</textarea>
                            </div>
                        </div>
                    </div>

                     <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Google Profile  <span title="Paste the Google Maps location URL (copy the link from the iframe's src attribute, not the whole embed code)" style="cursor: pointer;">
                                    <i class="material-icons md-24 md-light" style="font-size: 20px; color: #1976d2; vertical-align: middle;">info</i>
                                </span></label>
                            <div class="parsley-row" style="display: flex; align-items: center; gap: 8px;">
                                <textarea class="md-input" name="bus_google_profile_url" cols="10" rows="2">{{$businessListingEditData['bus_google_profile_url']}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <label for="blog_cat_desc">Direction / Map Link  <span title="Paste the full URL with http or https" style="cursor: pointer;">
                                    <i class="material-icons md-24 md-light" style="font-size: 20px; color: #1976d2; vertical-align: middle;">info</i>
                                </span></label>
                            <div class="parsley-row" style="display: flex; align-items: center; gap: 8px;">
                                <textarea class="md-input" name="bus_map_direction_url" cols="10" rows="2">{{$businessListingEditData['bus_map_direction_url']}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="bus_meta_title">Meta Title</label>
                                <input type="text" name="bus_meta_title" class="md-input"value="{{ $businessListingEditData['bus_meta_title'] }}" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row uk-margin-top">
                                <label for="bus_meta_keyword">Meta Keyword</label>
                                <input type="text" name="bus_meta_keyword" class="md-input" value="{{ $businessListingEditData['bus_meta_keyword'] }}" />
                            </div>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="bus_meta_description">Meta Desciption</label>
                                <textarea class="md-input" name="bus_meta_description" cols="10" rows="8">{{$businessListingEditData['bus_meta_description']}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="parsley-row">
                                <label for="bus_meta_description">Admin Comment</label>
                                <textarea class="md-input" name="bus_admin_comment" cols="10" rows="8">{{$businessListingEditData['bus_admin_comment']}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <center><button type="submit" class="md-btn md-btn-primary">Submit</button></center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/js/pages/tags.js')}}"></script>
<script>
    initSample();
    jQuery(document).ready(function(){
        jQuery('#catmain_id').change(function(){
            var catmain_id = jQuery(this).val()
            jQuery.ajax({
                url:"{{url('admin/getBlogSubCategory')}}",
                type:'POST',
                data:'catmain_id='+catmain_id+'&_token={{csrf_token()}}',
                success:function(result){
                    jQuery('#catsub_id').html(result)
                }
            });
        });
    });
</script>
@endsection
