@extends('admin.layouts.main')
@section('main-container')

        <div id="page_content_inner">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{url('admin/franchiseCategoryMainList')}}">Franchise Main Category List</a></li>
                    <li><span>Franchise Main Cayegory Edit </span></li>
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
                    <form id="form_validation" method="POST" action="{{url('/admin/franchiseCategoryMainUpdate/'.$franchiseCategoryMainSingleData['fcm_id']) }}" enctype="multipart/form-data" class="uk-form-stacked">
                        @csrf
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <label for="login_username">Main Category Name <span class="req" style="color: red">*</span></label>
                                    <input class="md-input" type="text" id="fcm_name" value="{{$franchiseCategoryMainSingleData['fcm_name']}}" required name="fcm_name" />
                                    </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <select class="md-input" name="fcm_status">
                                        <option value="">Choose..</option>
                                        <option value="{{STATUS_ACTIVE}}" @if($franchiseCategoryMainSingleData['fcm_status'] == STATUS_ACTIVE) selected style="color:green" @endif>Active</option>
                                        <option value="{{STATUS_INACTIVE}}"  @if($franchiseCategoryMainSingleData['fcm_status'] == STATUS_INACTIVE) selected style="color:red" @endif>In Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-3">
                                <div class="parsley-row">
                                    <br>
                                    <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
