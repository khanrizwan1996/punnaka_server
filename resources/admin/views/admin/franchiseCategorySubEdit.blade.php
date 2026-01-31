@extends('admin.layouts.main')
@section('main-container')
        <div id="page_content_inner">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{url('admin/franchiseCategoryMainList')}}">Franchise Main Category List</a></li>
                    <li><a href="{{url('admin/franchiseCategorySubList')}}">Franchise Sub Category List</a></li>
                    <li><span>Franchise Sub Category Edit </span></li>
                </ul>
            </div>
            <h3 class="heading_b uk-margin-bottom"> Update Details</h3>
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
                    <form id="form_validation" method="POST" action="{{url('/admin/franchiseCategorySubUpdate/'.$franchiseListingSubSingleData['fcs_id']) }}" class="uk-form-stacked">
                        @csrf
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <select class="md-input" name="fcs_cat_main_id">
                                        <option value="{{$franchiseListingSubSingleData['fcs_cat_main_id']}}">Select Main Category</option>
                                        @foreach ($franchiseListingMainData as $franchiseListingMainRow)

                                        <option value="{{ $franchiseListingMainRow['fcm_id'] }}" @if($franchiseListingMainRow['fcm_id'] == $franchiseListingSubSingleData['fcs_cat_main_id']) selected style="color:green" @endif >{{ $franchiseListingMainRow['fcm_name'] }}</option>

                                        @endforeach
                                    </select>
                                    </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="login_username">Sub Category Name <span class="req" style="color: red">*</span></label>
                                    <input class="md-input" type="text" id="fcs_name" value="{{$franchiseListingSubSingleData['fcs_name']}}" required name="fcs_name" />
                                    </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <select class="md-input" name="fcs_status">
                                        <option value="">Choose..</option>
                                        <option value="{{STATUS_ACTIVE}}" @if($franchiseListingSubSingleData['fcs_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active</option>
                                        <option value="{{STATUS_INACTIVE}}"  @if($franchiseListingSubSingleData['fcs_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <center><button type="submit" class="md-btn md-btn-primary">Submit</button></center>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
