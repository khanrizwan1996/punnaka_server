@include('frontend.layouts.userHeader')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
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

     @media only screen and (min-width: 1024px) {
            .custom-MarginLetf {
                margin-left: -30px;
            }
        }

</style>

<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit Business Timing</h2>
                <nav id="breadcrumbs">
                     <ul>
                        <li><a href="{{ url('user-admin/dashboard') }}" class="activeUrl">Dashboard</a></li>
                        <li><a href="{{ url('user-admin/businessListing') }}" class="activeUrl">Business Listing Details</a></li>
                    </ul>
                </nav>
                @if(session('message'))
                    @if(session('message') == MSG_UPDATE_SUCCESS)
                        <div style="padding: 1px; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                            <p style="margin: 6px; font-weight: bold;">Data Updated Successfully!..</p>
                        </div>
                    @else
                        <div style="padding: 1px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"">
                            <p style="margin: 6px; font-weight: bold;">Error In Updated!..</p>
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
            </div>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="{{ url('businessListingTimingUpdate/'.$businessTimingData['bus_sch_id']) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="bus_sch_business_id" value="{{$businessTimingData['bus_sch_business_id']}}">
            <div class="col-lg-12 col-md-12">
                <div class="add_utf_listing_section margin-top-45">
                    <div class="utf_add_listing_part_headline_part">
                        <h3><i class="sl sl-icon-clock"></i> Business Timings :</h3>
                    </div>
                    <div class="row with-forms">

                            {{-- <div class="switcher-content">
                                <div class="row utf_opening_day utf_js_demo_hours">
                                    <div class="col-md-2">
                                        <h5>Monday :-</h5>
                                    </div>
                                    <div class="col-md-3" style="padding: 16px;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-one-open" name="bus_sch_mon_status"
                                                value="1"  @if($businessTimingData['bus_sch_mon_status'] == 1) checked @endif />
                                            <label for="radio-one-open">Open</label>
                                            <input type="radio" id="radio-one-close" name="bus_sch_mon_status" @if ($businessTimingData['bus_sch_mon_status'] == 0) checked @endif value="0" />
                                            <label for="radio-one-close">Close</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-5">
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_mon_start" id="bus_sch_mon_start"
                                                placeholder="Open Time" @if($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_mon_start']}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_mon_end" id="bus_sch_mon_end" placeholder="Close Time" @if($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_mon_end']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row utf_opening_day utf_js_demo_hours">
                                    <div class="col-md-2">
                                        <h5>Tuesday :-</h5>
                                    </div>
                                    <div class="col-md-3" style="padding: 16px;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-two-open" name="bus_sch_tue_status"
                                                value="1" @if($businessTimingData['bus_sch_tue_status'] == 1) checked @endif />
                                            <label for="radio-two-open">Open</label>
                                            <input type="radio" id="radio-two-close" name="bus_sch_tue_status"
                                                value="0" @if($businessTimingData['bus_sch_tue_status'] == 0) checked @endif/>
                                            <label for="radio-two-close">Close</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-5">
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_tue_start" id="bus_sch_tue_start"
                                                placeholder="Open Time" @if($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_tue_start']}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_tue_end" id="bus_sch_tue_end"
                                                placeholder="Close Time" @if($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_tue_end']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row utf_opening_day utf_js_demo_hours">
                                    <div class="col-md-2">
                                        <h5>Wednesday :-</h5>
                                    </div>
                                    <div class="col-md-3" style="padding: 16px;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-three-open" name="bus_sch_wed_status"
                                                value="1" @if($businessTimingData['bus_sch_wed_status'] == 1) checked @endif />
                                            <label for="radio-three-open">Open</label>
                                            <input type="radio" id="radio-three-close" name="bus_sch_wed_status"
                                                value="0" @if($businessTimingData['bus_sch_wed_status'] == 0) checked @endif/>
                                            <label for="radio-three-close">Close</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-5">
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_wed_start" id="bus_sch_wed_start"
                                                placeholder="Open Time" @if($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_wed_start']}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_wed_end" id="bus_sch_wed_end"
                                                placeholder="Close Time" @if($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_wed_end']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row utf_opening_day utf_js_demo_hours">
                                    <div class="col-md-2">
                                        <h5>Thursday :-</h5>
                                    </div>
                                    <div class="col-md-3" style="padding: 16px;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-four-open" name="bus_sch_thu_status"
                                                value="1" @if($businessTimingData['bus_sch_thu_status'] == 1) checked @endif />
                                            <label for="radio-four-open">Open</label>
                                            <input type="radio" id="radio-four-close" name="bus_sch_thu_status"
                                                value="0" @if($businessTimingData['bus_sch_thu_status'] == 0) checked @endif/>
                                            <label for="radio-four-close">Close</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-5">
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_thu_start" id="bus_sch_thu_start"
                                                placeholder="Open Time" @if($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_thu_start']}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_thu_end" id="bus_sch_thu_end"
                                                placeholder="Close Time" @if($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_thu_end']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row utf_opening_day utf_js_demo_hours">
                                    <div class="col-md-2">
                                        <h5>Friday :-</h5>
                                    </div>
                                    <div class="col-md-3" style="padding: 16px;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-five-open" name="bus_sch_fri_status"
                                                value="1" @if($businessTimingData['bus_sch_fri_status'] == 1) checked @endif />
                                            <label for="radio-five-open">Open</label>
                                            <input type="radio" id="radio-five-close" name="bus_sch_fri_status"
                                                value="0" @if($businessTimingData['bus_sch_fri_status'] == 0) checked @endif/>
                                            <label for="radio-five-close">Close</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-5">
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_fri_start" id="bus_sch_fri_start"
                                                placeholder="Open Time" @if($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_fri_start']}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_fri_end" id="bus_sch_fri_end"
                                                placeholder="Close Time" @if($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_fri_end']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row utf_opening_day utf_js_demo_hours">
                                    <div class="col-md-2">
                                        <h5>Saturday :-</h5>
                                    </div>
                                    <div class="col-md-3" style="padding: 16px;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-six-open" name="bus_sch_sat_status"
                                                value="1" @if($businessTimingData['bus_sch_sat_status'] == 1) checked @endif />
                                            <label for="radio-six-open">Open</label>
                                            <input type="radio" id="radio-six-close" name="bus_sch_sat_status"
                                                value="0" @if($businessTimingData['bus_sch_sat_status'] == 0) checked @endif/>
                                            <label for="radio-six-close">Close</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-5">
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_sat_start" id="bus_sch_sat_start"
                                                placeholder="Open Time" @if($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_sat_start']}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_sat_end" id="bus_sch_sat_end"
                                                placeholder="Close Time" @if($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_sat_end']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row utf_opening_day utf_js_demo_hours">
                                    <div class="col-md-2">
                                        <h5>Sunday :-</h5>
                                    </div>
                                    <div class="col-md-3" style="padding: 16px;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-seven-open" name="bus_sch_sun_status"
                                                value="1" @if($businessTimingData['bus_sch_sun_status'] == 1) checked @endif />
                                            <label for="radio-seven-open">Open</label>
                                            <input type="radio" id="radio-seven-close" name="bus_sch_sun_status"
                                                value="0" @if($businessTimingData['bus_sch_sun_status'] == 0) checked @endif/>
                                            <label for="radio-seven-close">Close</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-5">
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_sun_start" id="bus_sch_sun_start"
                                                placeholder="Open Time" @if($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_sun_start']}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bus_sch_sun_end" id="bus_sch_sun_end"
                                                placeholder="Close Time" @if($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_sun_end']}}">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="switcher-content">
                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Monday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-one-open" name="bus_sch_mon_status" @if($businessTimingData['bus_sch_mon_status'] == 1) checked @endif value="1" />
                                                <label for="radio-one-open">Open</label>
                                                <input type="radio" id="radio-one-close" name="bus_sch_mon_status" @if($businessTimingData['bus_sch_mon_status'] == 0) checked @endif value="0" />
                                                <label for="radio-one-close">Close</label>
                                            </div>
                                        </div>
                                        <div class="row col-md-4">
                                            <div id="bus_sch_mon_24_div"  @if ($businessTimingData['bus_sch_mon_time_status'] == 1 || $businessTimingData['bus_sch_mon_time_status'] == 2) style="display: block" @else style="display: none" @endif>
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_mon_24_set_time"  @if ($businessTimingData['bus_sch_mon_time_status'] == 1) checked @endif name="bus_sch_mon_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if ($businessTimingData['bus_sch_mon_time_status'] == 2) checked @endif id="bus_sch_mon_24_hours" name="bus_sch_mon_24" value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_mon_set_time"  @if (isset($businessTimingData['bus_sch_mon_start']) && $businessTimingData['bus_sch_mon_end'] != '') style="display: block" @else style="display: none" @endif>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_mon_start" name="bus_sch_mon_start" placeholder="Open Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{ $businessTimingData['bus_sch_mon_start'] }}" />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_mon_end" name="bus_sch_mon_end"
                                                    @if($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                    value="{{ $businessTimingData['bus_sch_mon_end'] }}"
                                                    placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Tuesday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-two-open" @if($businessTimingData['bus_sch_tue_status'] == 1) checked @endif name="bus_sch_tue_status" value="1"/>
                                                <label for="radio-two-open">Open</label>
                                                <input type="radio" id="radio-two-close" @if($businessTimingData['bus_sch_tue_status'] == 0) checked @endif name="bus_sch_tue_status" value="0"/>
                                                <label for="radio-two-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_tue_24_div" @if(($businessTimingData['bus_sch_tue_time_status'] == 1 || $businessTimingData['bus_sch_tue_time_status'] == 2) && $businessTimingData['bus_sch_tue_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if($businessTimingData['bus_sch_tue_time_status'] == 1) checked @endif id="bus_sch_tue_24_set_time" name="bus_sch_tue_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if($businessTimingData['bus_sch_tue_time_status'] == 2) checked @endif id="bus_sch_tue_24_hours" name="bus_sch_tue_24" value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_tue_set_time" @if(isset($businessTimingData['bus_sch_tue_start']) && $businessTimingData['bus_sch_tue_end'] != '') style="display: block" @else style="display: none" @endif>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_tue_start" name="bus_sch_tue_start" placeholder="Open Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        value="{{ $businessTimingData['bus_sch_tue_start'] }}" />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_tue_end" name="bus_sch_tue_end" @if ($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{ $businessTimingData['bus_sch_tue_end'] }}"
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_tue_start" id="bus_sch_tue_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_tue_end" id="bus_sch_tue_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div>
                                         --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Wednesday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-three-open"  @if($businessTimingData['bus_sch_wed_status'] == 1) checked @endif name="bus_sch_wed_status" value="1" />
                                                <label for="radio-three-open">Open</label>
                                                <input type="radio" id="radio-three-close"  @if($businessTimingData['bus_sch_wed_status'] == 0) checked @endif name="bus_sch_wed_status" value="0" />
                                                <label for="radio-three-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_wed_24_div" @if(($businessTimingData['bus_sch_wed_time_status'] == 1 || $businessTimingData['bus_sch_wed_time_status'] == 2) && $businessTimingData['bus_sch_wed_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if ($businessTimingData['bus_sch_wed_time_status'] == 1) checked @endif id="bus_sch_wed_24_set_time" name="bus_sch_wed_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if ($businessTimingData['bus_sch_wed_time_status'] == 2) checked @endif id="bus_sch_wed_24_hours" name="bus_sch_wed_24" value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_wed_set_time" @if (isset($businessTimingData['bus_sch_wed_start']) && $businessTimingData['bus_sch_wed_end'] != '') style="display: block" @else style="display: none" @endif>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_wed_start" name="bus_sch_wed_start" placeholder="Open Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        value="{{ $businessTimingData['bus_sch_wed_start'] }}" />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_wed_end" name="bus_sch_wed_end"
                                                     @if ($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                    value="{{ $businessTimingData['bus_sch_wed_end'] }}"
                                                        placeholder="Close Time" class="text_field_class" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_wed_start" id="bus_sch_wed_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_wed_end" id="bus_sch_wed_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Thursday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-four-open"  @if($businessTimingData['bus_sch_thu_status'] == 1) checked @endif name="bus_sch_thu_status" value="1" />
                                                <label for="radio-four-open">Open</label>
                                                <input type="radio" id="radio-four-close"  @if($businessTimingData['bus_sch_thu_status'] == 0) checked @endif name="bus_sch_thu_status" value="0" />
                                                <label for="radio-four-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_thu_24_div" @if(($businessTimingData['bus_sch_thu_time_status'] == 1 || $businessTimingData['bus_sch_thu_time_status'] == 2) && $businessTimingData['bus_sch_thu_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if($businessTimingData['bus_sch_thu_time_status'] == 1) checked @endif id="bus_sch_thu_24_set_time" name="bus_sch_thu_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if($businessTimingData['bus_sch_thu_time_status'] == 2) checked @endif id="bus_sch_thu_24_hours" name="bus_sch_thu_24" value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_thu_set_time" @if (isset($businessTimingData['bus_sch_thu_start']) && $businessTimingData['bus_sch_thu_end'] != '') style="display: block" @else style="display: none" @endif>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_thu_start" name="bus_sch_thu_start" placeholder="Open Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        value="{{ $businessTimingData['bus_sch_thu_start'] }}" />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_thu_end" name="bus_sch_thu_end" placeholder="Close Time" class="text_field_class"
                                                    @if($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                    value="{{ $businessTimingData['bus_sch_thu_end'] }}" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_thu_start" id="bus_sch_thu_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_thu_end" id="bus_sch_thu_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Friday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-five-open" @if($businessTimingData['bus_sch_fri_status'] == 1) checked @endif name="bus_sch_fri_status" value="1" />
                                                <label for="radio-five-open">Open</label>
                                                <input type="radio" id="radio-five-close" @if($businessTimingData['bus_sch_fri_status'] == 0) checked @endif name="bus_sch_fri_status" value="0" />
                                                <label for="radio-five-close">Close</label>
                                            </div>
                                        </div>

                                         <div class="row col-md-4">
                                            <div id="bus_sch_fri_24_div" @if (($businessTimingData['bus_sch_fri_time_status'] == 1 || $businessTimingData['bus_sch_fri_time_status'] == 2) && $businessTimingData['bus_sch_fri_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if ($businessTimingData['bus_sch_fri_time_status'] == 1) checked @endif id="bus_sch_fri_24_set_time" name="bus_sch_fri_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if ($businessTimingData['bus_sch_fri_time_status'] == 2) checked @endif id="bus_sch_fri_24_hours" name="bus_sch_fri_24" value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_fri_set_time" @if(isset($businessTimingData['bus_sch_fri_start']) && $businessTimingData['bus_sch_fri_end'] != '') style="display: block" @else style="display: none" @endif>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_fri_start" name="bus_sch_fri_start" placeholder="Open Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        value="{{ $businessTimingData['bus_sch_fri_start'] }}" />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_fri_end" name="bus_sch_fri_end" placeholder="Close Time" class="text_field_class"
                                                    @if ($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                    value="{{ $businessTimingData['bus_sch_fri_end'] }}" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_fri_start" id="bus_sch_fri_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_fri_end" id="bus_sch_fri_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Saturday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-six-open" @if($businessTimingData['bus_sch_sat_status'] == 1) checked @endif name="bus_sch_sat_status" value="1" />
                                                <label for="radio-six-open">Open</label>
                                                <input type="radio" id="radio-six-close" @if($businessTimingData['bus_sch_sat_status'] == 0) checked @endif name="bus_sch_sat_status" value="0" />
                                                <label for="radio-six-close">Close</label>
                                            </div>
                                        </div>

                                         <div class="row col-md-4">
                                            <div id="bus_sch_sat_24_div" @if(($businessTimingData['bus_sch_sat_time_status'] == 1 || $businessTimingData['bus_sch_sat_time_status'] == 2) && $businessTimingData['bus_sch_sat_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" @if($businessTimingData['bus_sch_sat_time_status'] == 1) checked @endif id="bus_sch_sat_24_set_time" name="bus_sch_sat_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio"  @if($businessTimingData['bus_sch_sat_time_status'] == 2) checked @endif id="bus_sch_sat_24_hours" name="bus_sch_sat_24" value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_sat_set_time"  @if(isset($businessTimingData['bus_sch_sat_start']) && $businessTimingData['bus_sch_sat_end'] != '') style="display: block" @else style="display: none" @endif>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sat_start" name="bus_sch_sat_start" placeholder="Open Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_sat_start'] }}" />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sat_end" name="bus_sch_sat_end" placeholder="Close Time" class="text_field_class"  @if ($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                    value="{{ $businessTimingData['bus_sch_sat_end'] }}" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sat_start" id="bus_sch_sat_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sat_end" id="bus_sch_sat_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Sunday :-</h5>
                                        </div>
                                        <div class="col-md-2" style="padding: 16px;">
                                            <div class="switch-field">
                                                <input type="radio" id="radio-seven-open" @if($businessTimingData['bus_sch_sun_status'] == 1) checked @endif name="bus_sch_sun_status" value="1" />
                                                <label for="radio-seven-open">Open</label>
                                                <input type="radio" id="radio-seven-close" @if($businessTimingData['bus_sch_sun_status'] == 0) checked @endif name="bus_sch_sun_status" value="0" />
                                                <label for="radio-seven-close">Close</label>
                                            </div>
                                        </div>

                                        <div class="row col-md-4">
                                            <div id="bus_sch_sun_24_div" @if(($businessTimingData['bus_sch_sun_time_status'] == 1 || $businessTimingData['bus_sch_sun_time_status'] == 2) && $businessTimingData['bus_sch_sun_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_sun_24_set_time" @if($businessTimingData['bus_sch_sun_time_status'] == 1) checked @endif name="bus_sch_sun_24" value="1" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    Set Time
                                                </div>

                                                <div class="col-md-2" style="margin-top: 21px;">
                                                    <input type="radio" id="bus_sch_sun_24_hours" @if($businessTimingData['bus_sch_sun_time_status'] == 2) checked @endif name="bus_sch_sun_24" value="2" />
                                                </div>
                                                <div class="col-md-4 custom-MarginLetf" style="margin-top: 16px;">
                                                    24 Hours
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-4">
                                            <div id="bus_sch_sun_set_time" @if (isset($businessTimingData['bus_sch_sun_start']) && $businessTimingData['bus_sch_sun_end'] != '') style="display: block" @else style="display: none" @endif>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sun_start" name="bus_sch_sun_start" placeholder="Open Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        value="{{ $businessTimingData['bus_sch_sun_start'] }}" />
                                                </div>
                                                <div class="row col-md-2"></div>
                                                <div class="row col-md-5">
                                                    <input type="text" id="bus_sch_sun_end" name="bus_sch_sun_end"
                                                        placeholder="Close Time" class="text_field_class"
                                                        @if($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        value="{{ $businessTimingData['bus_sch_sun_end'] }}" />
                                                </div>
                                            </div>
                                        </div>


                                        {{-- <div class="row col-md-5">
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sun_start" id="bus_sch_sun_start"
                                                    placeholder="Open Time">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="bus_sch_sun_end" id="bus_sch_sun_end"
                                                    placeholder="Close Time">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <button type="submit" class="button preview btn_center_item margin-top-15">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('frontend/scripts/businessScheduleValidation.js') }}"></script>
@include('frontend.layouts.userFooter')
