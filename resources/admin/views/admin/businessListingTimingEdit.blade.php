@extends('admin.layouts.main')
@section('main-container')
    <style type="text/css">
        .switch-field {
            display: flex;
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

        .text_field_class {
            height: 50px;
            line-height: 50px;
            padding: 0 15px;
            outline: none;
            font-size: 15px;
            color: #808080;
            margin: 0 0 16px 0;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            display: block;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.03);
            font-weight: 600;
            opacity: 1;
            border-radius: 4px;
        }
    </style>
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/businessListing') }}">Business Listing List</a></li>
                <li><a href="{{ url('admin/businessListingEdit/' . Route::input('id') . '') }}">Business Edit</a></li>
                <li><a href="{{ url('admin/businessListingImagesEdit/' . Route::input('id') . '') }}">Business Images</a>
                </li>
                <li><span>Business Timing Edit </span></li>
            </ul>
        </div>
        <h3 class="heading_b uk-margin-bottom"> Business Timing Details</h3>
        @if (session('message'))
            @if (session('message') == MSG_ADD_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Insert Successfully!..</p>
                </div>
            @elseif (session('message') == MSG_ADD_ERROR)
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In Insert!..</p>
                </div>
            @endforelse

            @if (session('message') == MSG_UPDATE_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Updated Successfully!..</p>
                </div>
            @elseif (session('message') == MSG_UPDATE_ERROR)
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
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Business Name : <span
                                style="color:#1976d2"> {{ $businessTimingData['bus_name'] }}</span></label>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="" style="font-weight: bolder;font-size: 15px;">Business Contact No : <span
                                style="color:#1976d2"> {{ $businessTimingData['bus_contact_no'] }}</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="md-card">
            <div class="md-card-content large-padding">

                @if (isset($businessTimingData) && !empty($businessTimingData['bus_sch_id']))
                    <form id="form_validation" method="POST"
                        action="{{ url('/admin/businessListingTimingUpdate/' . $businessTimingData['bus_sch_id']) }}"
                        class="uk-form-stacked">
                        @csrf
                        <input type="hidden" name="bus_sch_business_id" value="{{ $businessTimingData['bus_id'] }}">
                        <div class="uk-overflow-container">
                            {{-- <table class="uk-table uk-table-hover">
                                <tbody>
                                    <tr>
                                        <td>Monday :- </td>
                                        <td>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-one-open" name="bus_sch_mon_status" value="1"
                                                    @if ($businessTimingData['bus_sch_mon_status'] == 1) checked @endif
                                                />
                                                <label for="radio-one-open">Open</label>
                                                <input type="radio" id="radio-one-close" name="bus_sch_mon_status" value="0"
                                                @if ($businessTimingData['bus_sch_mon_status'] == 0) checked @endif
                                                />
                                                <label for="radio-one-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_mon_start" name="bus_sch_mon_start" placeholder="Open Time"
                                                            class="text_field_class" @if ($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{$businessTimingData['bus_sch_mon_start']}}" />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_mon_end" name="bus_sch_mon_end" value="{{$businessTimingData['bus_sch_mon_end']}}"  @if ($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif placeholder="Close Time"
                                                            class="text_field_class" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><br>Tuesday :- </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-two-open" name="bus_sch_tue_status" value="1"
                                                @if ($businessTimingData['bus_sch_tue_status'] == 1) checked @endif
                                                />
                                                <label for="radio-two-open">Open</label>
                                                <input type="radio" id="radio-two-close" name="bus_sch_tue_status" value="0"
                                                @if ($businessTimingData['bus_sch_tue_status'] == 0) checked @endif
                                                />
                                                <label for="radio-two-close">Close</label>
                                            </div>
                                        </td>
                                        <td><br>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_tue_start" name="bus_sch_tue_start" placeholder="Open Time"
                                                            class="text_field_class" value="{{$businessTimingData['bus_sch_tue_start']}}"
                                                            @if ($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_tue_end" name="bus_sch_tue_end" placeholder="Close Time"
                                                            class="text_field_class" value="{{$businessTimingData['bus_sch_tue_end']}}"
                                                            @if ($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><br>Wednesday :- </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-three-open" name="bus_sch_wed_status"value="1"
                                                    @if ($businessTimingData['bus_sch_wed_status'] == 1) checked @endif
                                                />
                                                <label for="radio-three-open">Open</label>
                                                <input type="radio" id="radio-three-close" name="bus_sch_wed_status" value="0"
                                                @if ($businessTimingData['bus_sch_wed_status'] == 0) checked @endif
                                                />
                                                <label for="radio-three-close">Close</label>
                                            </div>
                                        </td>
                                        <td><br>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_wed_start" name="bus_sch_wed_start" placeholder="Open Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_wed_start']}}"
                                                        @if ($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_wed_end" name="bus_sch_wed_end" placeholder="Close Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_wed_end']}}"
                                                        @if ($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><br>Thursday:- </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-four-open" name="bus_sch_thu_status" value="1"
                                                    @if ($businessTimingData['bus_sch_thu_status'] == 1) checked @endif
                                                />
                                                <label for="radio-four-open">Open</label>
                                                <input type="radio" id="radio-four-close" name="bus_sch_thu_status" value="0"
                                                @if ($businessTimingData['bus_sch_thu_status'] == 0) checked @endif
                                                />
                                                <label for="radio-four-close">Close</label>
                                            </div>
                                        </td>
                                        <td><br>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_thu_start" name="bus_sch_thu_start" placeholder="Open Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_thu_start']}}"
                                                        @if ($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_thu_end" name="bus_sch_thu_end" placeholder="Close Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_thu_end']}}"
                                                        @if ($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><br>Friday:- </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-five-open" name="bus_sch_fri_status" value="1"
                                                    @if ($businessTimingData['bus_sch_fri_status'] == 1) checked @endif
                                                />
                                                <label for="radio-five-open">Open</label>
                                                <input type="radio" id="radio-five-close" name="bus_sch_fri_status" value="0"
                                                    @if ($businessTimingData['bus_sch_fri_status'] == 0) checked @endif
                                                />
                                                <label for="radio-five-close">Close</label>
                                            </div>
                                        </td>
                                        <td><br>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_fri_start" name="bus_sch_fri_start" placeholder="Open Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_fri_start']}}"
                                                        @if ($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_fri_end" name="bus_sch_fri_end" placeholder="Close Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_fri_end']}}"
                                                        @if ($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><br>Saturday:- </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-six-open" name="bus_sch_sat_status" value="1"
                                                    @if ($businessTimingData['bus_sch_sat_status'] == 1) checked @endif
                                                />
                                                <label for="radio-six-open">Open</label>
                                                <input type="radio" id="radio-six-close" name="bus_sch_sat_status" value="0"
                                                    @if ($businessTimingData['bus_sch_sat_status'] == 0) checked @endif
                                                />
                                                <label for="radio-six-close">Close</label>
                                            </div>
                                        </td>
                                        <td><br>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_sat_start" name="bus_sch_sat_start" placeholder="Open Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_sat_start']}}"
                                                        @if ($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_sat_end" name="bus_sch_sat_end" placeholder="Close Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_sat_end']}}"
                                                        @if ($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                            />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><br>Sunday:- </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-seven-open" name="bus_sch_sun_status" value="1"
                                                    @if ($businessTimingData['bus_sch_sun_status'] == 1) checked @endif
                                                />
                                                <label for="radio-seven-open">Open</label>
                                                <input type="radio" id="radio-seven-close" name="bus_sch_sun_status" value="0"
                                                    @if ($businessTimingData['bus_sch_sun_status'] == 0) checked @endif
                                                />
                                                <label for="radio-seven-close">Close</label>
                                            </div>
                                        </td>
                                        <td><br>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_sun_start" name="bus_sch_sun_start" placeholder="Open Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_sun_start']}}"
                                                        @if ($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row">
                                                        <input type="text" id="bus_sch_sun_end" name="bus_sch_sun_end" placeholder="Close Time"
                                                        class="text_field_class" value="{{$businessTimingData['bus_sch_sun_end']}}"
                                                        @if ($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> --}}

                            <table class="uk-table uk-table-hover">
                                <tbody>
                                    <tr>
                                        <td>Monday :- </td>
                                        <td>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-one-open" name="bus_sch_mon_status"
                                                    @if ($businessTimingData['bus_sch_mon_status'] == 1) checked @endif value="1" />
                                                <label for="radio-one-open">Open</label>
                                                <input type="radio" id="radio-one-close"
                                                    @if ($businessTimingData['bus_sch_mon_status'] == 0) checked @endif
                                                    name="bus_sch_mon_status" value="0" />
                                                <label for="radio-one-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_mon_24_div"
                                                    @if ($businessTimingData['bus_sch_mon_time_status'] == 1 || $businessTimingData['bus_sch_mon_time_status'] == 2) style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_mon_24_set_time"
                                                                @if ($businessTimingData['bus_sch_mon_time_status'] == 1) checked @endif
                                                                name="bus_sch_mon_24" value="1" /> Set Time

                                                            <input type="radio" id="bus_sch_mon_24_hours"
                                                                @if ($businessTimingData['bus_sch_mon_time_status'] == 2) checked @endif
                                                                name="bus_sch_mon_24" value="2" /> 24 Hours Open

                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_mon_set_time"
                                                    @if (isset($businessTimingData['bus_sch_mon_start']) && $businessTimingData['bus_sch_mon_end'] != '') style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_mon_start"
                                                                    name="bus_sch_mon_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    @if($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif value="{{ $businessTimingData['bus_sch_mon_start'] }}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_mon_end"
                                                                    name="bus_sch_mon_end"
                                                                    placeholder="Close Time" class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_mon_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_mon_end'] }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Tuesday :-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-two-open"
                                                    @if($businessTimingData['bus_sch_tue_status'] == 1) checked @endif
                                                    name="bus_sch_tue_status" value="1" />
                                                <label for="radio-two-open">Open</label>
                                                <input type="radio" id="radio-two-close"
                                                    @if ($businessTimingData['bus_sch_tue_status'] == 0) checked @endif
                                                    name="bus_sch_tue_status" value="0" />
                                                <label for="radio-two-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_tue_24_div"
                                                    @if (
                                                        ($businessTimingData['bus_sch_tue_time_status'] == 1 || $businessTimingData['bus_sch_tue_time_status'] == 2) &&
                                                            $businessTimingData['bus_sch_tue_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio"
                                                                @if($businessTimingData['bus_sch_tue_time_status'] == 1) checked @endif
                                                                id="bus_sch_tue_24_set_time" name="bus_sch_tue_24"
                                                                value="1" /> Set Time

                                                            <input type="radio"
                                                                @if ($businessTimingData['bus_sch_tue_time_status'] == 2) checked @endif
                                                                id="bus_sch_tue_24_hours" name="bus_sch_tue_24"
                                                                value="2" /> 24 Hours Open

                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_tue_set_time"
                                                    @if(isset($businessTimingData['bus_sch_tue_start']) && $businessTimingData['bus_sch_tue_end'] != '') style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_tue_start"
                                                                    name="bus_sch_tue_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_tue_start'] }}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_tue_end"
                                                                    name="bus_sch_tue_end" placeholder="Close Time"
                                                                    class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_tue_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_tue_end'] }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Wednesday :-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-three-open"
                                                    @if($businessTimingData['bus_sch_wed_status'] == 1) checked @endif
                                                    name="bus_sch_wed_status" value="1" />
                                                <label for="radio-three-open">Open</label>
                                                <input type="radio" id="radio-three-close"
                                                    @if ($businessTimingData['bus_sch_wed_status'] == 0) checked @endif
                                                    name="bus_sch_wed_status" value="0" />
                                                <label for="radio-three-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_wed_24_div"
                                                    @if (
                                                        ($businessTimingData['bus_sch_wed_time_status'] == 1 || $businessTimingData['bus_sch_wed_time_status'] == 2) &&
                                                            $businessTimingData['bus_sch_wed_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_wed_24_set_time"
                                                                @if ($businessTimingData['bus_sch_wed_time_status'] == 1) checked @endif
                                                                name="bus_sch_wed_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_wed_24_hours"
                                                                @if ($businessTimingData['bus_sch_wed_time_status'] == 2) checked @endif
                                                                name="bus_sch_wed_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_wed_set_time"
                                                    @if (isset($businessTimingData['bus_sch_wed_start']) && $businessTimingData['bus_sch_wed_end'] != '') style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_wed_start"
                                                                    name="bus_sch_wed_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    @if($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_wed_start'] }}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_wed_end"
                                                                    name="bus_sch_wed_end" placeholder="Close Time"
                                                                    class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_wed_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_wed_end'] }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <br>Thursday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-four-open"
                                                    @if($businessTimingData['bus_sch_thu_status'] == 1) checked @endif
                                                    name="bus_sch_thu_status" value="1" />
                                                <label for="radio-four-open">Open</label>
                                                <input type="radio" id="radio-four-close"
                                                    @if ($businessTimingData['bus_sch_thu_status'] == 0) checked @endif
                                                    name="bus_sch_thu_status" value="0" />
                                                <label for="radio-four-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_thu_24_div"
                                                    @if (
                                                        ($businessTimingData['bus_sch_thu_time_status'] == 1 || $businessTimingData['bus_sch_thu_time_status'] == 2) &&
                                                            $businessTimingData['bus_sch_thu_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_thu_24_set_time"
                                                                @if($businessTimingData['bus_sch_thu_time_status'] == 1) checked @endif
                                                                name="bus_sch_thu_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_thu_24_hours"
                                                                @if ($businessTimingData['bus_sch_thu_time_status'] == 2) checked @endif
                                                                name="bus_sch_thu_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_thu_set_time"
                                                    @if (isset($businessTimingData['bus_sch_thu_start']) && $businessTimingData['bus_sch_thu_end'] != '') style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_thu_start"
                                                                    name="bus_sch_thu_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    @if($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_thu_start'] }}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_thu_end"
                                                                    name="bus_sch_thu_end" placeholder="Close Time"
                                                                    class="text_field_class"
                                                                    @if($businessTimingData['bus_sch_thu_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_thu_end'] }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Friday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-five-open"
                                                    @if($businessTimingData['bus_sch_fri_status'] == 1) checked @endif
                                                    name="bus_sch_fri_status" value="1" />
                                                <label for="radio-five-open">Open</label>
                                                <input type="radio" id="radio-five-close"
                                                    @if($businessTimingData['bus_sch_fri_status'] == 0) checked @endif
                                                    name="bus_sch_fri_status" value="0" />
                                                <label for="radio-five-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-3" id="bus_sch_fri_24_div"
                                                    @if (
                                                        ($businessTimingData['bus_sch_fri_time_status'] == 1 || $businessTimingData['bus_sch_fri_time_status'] == 2) &&
                                                            $businessTimingData['bus_sch_fri_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_fri_24_set_time"
                                                                @if ($businessTimingData['bus_sch_fri_time_status'] == 1) checked @endif
                                                                name="bus_sch_fri_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_fri_24_hours"
                                                                @if ($businessTimingData['bus_sch_fri_time_status'] == 2) checked @endif
                                                                name="bus_sch_fri_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_fri_set_time"
                                                    @if (isset($businessTimingData['bus_sch_fri_start']) && $businessTimingData['bus_sch_fri_end'] != '') style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_fri_start"
                                                                    name="bus_sch_fri_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_fri_start'] }}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_fri_end"
                                                                    name="bus_sch_fri_end" placeholder="Close Time"
                                                                    class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_fri_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_fri_end'] }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Saturday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-six-open"
                                                    @if($businessTimingData['bus_sch_sat_status'] == 1) checked @endif
                                                    name="bus_sch_sat_status" value="1" />
                                                <label for="radio-six-open">Open</label>
                                                <input type="radio" id="radio-six-close"
                                                    @if ($businessTimingData['bus_sch_sat_status'] == 0) checked @endif
                                                    name="bus_sch_sat_status" value="0" />
                                                <label for="radio-six-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_sat_24_div"
                                                    @if (
                                                        ($businessTimingData['bus_sch_sat_time_status'] == 1 || $businessTimingData['bus_sch_sat_time_status'] == 2) &&
                                                            $businessTimingData['bus_sch_sat_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_sat_24_set_time"
                                                                @if($businessTimingData['bus_sch_sat_time_status'] == 1) checked @endif
                                                                name="bus_sch_sat_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_sat_24_hours"
                                                                @if ($businessTimingData['bus_sch_sat_time_status'] == 2) checked @endif
                                                                name="bus_sch_sat_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_sat_set_time"
                                                    @if (isset($businessTimingData['bus_sch_sat_start']) && $businessTimingData['bus_sch_sat_end'] != '') style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sat_start"
                                                                    name="bus_sch_sat_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    @if($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_sat_start'] }}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sat_end"
                                                                    name="bus_sch_sat_end" placeholder="Close Time"
                                                                    class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_sat_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_sat_end'] }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Sunday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-seven-open"
                                                    @if ($businessTimingData['bus_sch_sun_status'] == 1) checked @endif
                                                    name="bus_sch_sun_status" value="1" />
                                                <label for="radio-seven-open">Open</label>
                                                <input type="radio" id="radio-seven-close"
                                                    @if ($businessTimingData['bus_sch_sun_status'] == 0) checked @endif
                                                    name="bus_sch_sun_status" value="0" />
                                                <label for="radio-seven-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_sun_24_div"
                                                    @if (($businessTimingData['bus_sch_sun_time_status'] == 1 || $businessTimingData['bus_sch_sun_time_status'] == 2) &&
                                                            $businessTimingData['bus_sch_sun_status'] != 0) style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_sun_24_set_time"
                                                                @if($businessTimingData['bus_sch_sun_time_status'] == 1) checked @endif
                                                                name="bus_sch_sun_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_sun_24_hours"
                                                                @if ($businessTimingData['bus_sch_sun_time_status'] == 2) checked @endif
                                                                name="bus_sch_sun_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_sun_set_time"
                                                    @if (isset($businessTimingData['bus_sch_sun_start']) && $businessTimingData['bus_sch_sun_end'] != '') style="display: block" @else style="display: none" @endif>
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sun_start"
                                                                    name="bus_sch_sun_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    @if($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_sun_start'] }}" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sun_end"
                                                                    name="bus_sch_sun_end" placeholder="Close Time"
                                                                    class="text_field_class"
                                                                    @if ($businessTimingData['bus_sch_sun_status'] == 0) disabled style="background-color: gainsboro;" @endif
                                                                    value="{{ $businessTimingData['bus_sch_sun_end'] }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                        <br>
                        <div class="uk-grid">
                            <div align="center" class="uk-width-1-1">
                                <button type="submit" class="md-btn md-btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form id="form_validation" method="POST" action="{{ url('/admin/businessListingTimingAdd/') }}"
                        class="uk-form-stacked">
                        @csrf
                        <input type="hidden" name="bus_sch_business_id" value="{{ $businessTimingData['bus_id'] }}">
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-table-hover">
                                <tbody>
                                    <tr>
                                        <td>Monday :- </td>
                                        <td>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-one-open" name="bus_sch_mon_status"
                                                    value="1" />
                                                <label for="radio-one-open">Open</label>
                                                <input type="radio" id="radio-one-close" name="bus_sch_mon_status"
                                                    value="0" />
                                                <label for="radio-one-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_mon_24_div"
                                                    style="display: none">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_mon_24_set_time"
                                                                name="bus_sch_mon_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_mon_24_hours"
                                                                name="bus_sch_mon_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_mon_set_time" style="display: none;">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_mon_start"
                                                                    name="bus_sch_mon_start" placeholder="Open Time"
                                                                    class="text_field_class"
                                                                    style="background-color: gainsboro;" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_mon_end"
                                                                    name="bus_sch_mon_end"
                                                                    style="background-color: gainsboro;" disabled
                                                                    placeholder="Close Time" class="text_field_class" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Tuesday :-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-two-open" name="bus_sch_tue_status"
                                                    value="1" />
                                                <label for="radio-two-open">Open</label>
                                                <input type="radio" id="radio-two-close" name="bus_sch_tue_status"
                                                    value="0" />
                                                <label for="radio-two-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_tue_24_div"
                                                    style="display: none">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_tue_24_set_time"
                                                                name="bus_sch_tue_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_tue_24_hours"
                                                                name="bus_sch_tue_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_tue_set_time" style="display: none;">
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_tue_start"
                                                                    name="bus_sch_tue_start" placeholder="Open Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_tue_end"
                                                                    name="bus_sch_tue_end" placeholder="Close Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Wednesday :-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-three-open" name="bus_sch_wed_status"
                                                    value="1" />
                                                <label for="radio-three-open">Open</label>
                                                <input type="radio" id="radio-three-close" name="bus_sch_wed_status"
                                                    value="0" />
                                                <label for="radio-three-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_wed_24_div"
                                                    style="display: none">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_wed_24_set_time"
                                                                name="bus_sch_wed_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_wed_24_hours"
                                                                name="bus_sch_wed_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_wed_set_time" style="display: none;">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_wed_start"
                                                                    name="bus_sch_wed_start" placeholder="Open Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_wed_end"
                                                                    name="bus_sch_wed_end" placeholder="Close Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <br>Thursday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-four-open" name="bus_sch_thu_status"
                                                    value="1" />
                                                <label for="radio-four-open">Open</label>
                                                <input type="radio" id="radio-four-close" name="bus_sch_thu_status"
                                                    value="0" />
                                                <label for="radio-four-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_thu_24_div"
                                                    style="display: none">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_thu_24_set_time"
                                                                name="bus_sch_thu_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_thu_24_hours"
                                                                name="bus_sch_thu_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_thu_set_time" style="display: none;">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_thu_start"
                                                                    name="bus_sch_thu_start" placeholder="Open Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_thu_end"
                                                                    name="bus_sch_thu_end" placeholder="Close Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Friday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-five-open" name="bus_sch_fri_status"
                                                    value="1" />
                                                <label for="radio-five-open">Open</label>
                                                <input type="radio" id="radio-five-close" name="bus_sch_fri_status"
                                                    value="0" />
                                                <label for="radio-five-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_fri_24_div"
                                                    style="display: none">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_fri_24_set_time"
                                                                name="bus_sch_fri_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_fri_24_hours"
                                                                name="bus_sch_fri_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_fri_set_time" style="display: none;">
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_fri_start"
                                                                    name="bus_sch_fri_start" placeholder="Open Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_fri_end"
                                                                    name="bus_sch_fri_end" placeholder="Close Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Saturday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-six-open" name="bus_sch_sat_status"
                                                    value="1" />
                                                <label for="radio-six-open">Open</label>
                                                <input type="radio" id="radio-six-close" name="bus_sch_sat_status"
                                                    value="0" />
                                                <label for="radio-six-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_sat_24_div"
                                                    style="display: none">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_sat_24_set_time"
                                                                name="bus_sch_sat_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_sat_24_hours"
                                                                name="bus_sch_sat_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_sat_set_time" style="display: none;">
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sat_start"
                                                                    name="bus_sch_sat_start" placeholder="Open Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sat_end"
                                                                    name="bus_sch_sat_end" placeholder="Close Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>Sunday:-
                                        </td>
                                        <td>
                                            <br>
                                            <div class="switch-field">
                                                <input type="radio" id="radio-seven-open" name="bus_sch_sun_status"
                                                    value="1" />
                                                <label for="radio-seven-open">Open</label>
                                                <input type="radio" id="radio-seven-close" name="bus_sch_sun_status"
                                                    value="0" />
                                                <label for="radio-seven-close">Close</label>
                                            </div>
                                        </td>
                                        <td>
                                            <br>
                                            <div class="uk-grid" data-uk-grid-margin>

                                                <div class="uk-width-medium-1-3" id="bus_sch_sun_24_div"
                                                    style="display: none">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="parsley-row" style="margin-top: -12px;">
                                                            <br>
                                                            <input type="radio" id="bus_sch_sun_24_set_time"
                                                                name="bus_sch_sun_24" value="1" /> Set Time
                                                            <input type="radio" id="bus_sch_sun_24_hours"
                                                                name="bus_sch_sun_24" value="2" /> 24 Hours Open
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="bus_sch_sun_set_time" style="display: none;">
                                                    <div class="uk-grid" data-uk-grid-margin>

                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sun_start"
                                                                    name="bus_sch_sun_start" placeholder="Open Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="parsley-row">
                                                                <input type="text" id="bus_sch_sun_end"
                                                                    name="bus_sch_sun_end" placeholder="Close Time"
                                                                    class="text_field_class" disabled
                                                                    style="background-color: gainsboro;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="uk-grid">
                            <div align="center" class="uk-width-1-1">
                                <button type="submit" class="md-btn md-btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/scripts/businessScheduleValidation.js') }}"></script>
@endsection
