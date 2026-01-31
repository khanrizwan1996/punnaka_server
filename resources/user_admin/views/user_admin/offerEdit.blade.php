@extends('user_admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Edit Offer</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'dashboard')}}">Dashboard</a> / </li>
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'offerList')}}">Offer Listing Details</a> / </li>
                            <li class="breadcrumb-item active">Edit Offer</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @if (session('message'))
                        <div class="card-body live-dark">
                            @if(session('message') == MSG_UPDATE_SUCCESS)
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Data Updated Successfully!..</div>
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"fdprocessedid="wsb8o"></button>
                                        </div>
                                    <div>
                            @else
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Error In Update!..</div>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" fdprocessedid="wsb8o"></button>
                                    </div>
                                <div>
                            @endforelse
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <div class="row with-forms">
                                <div class="col-md-6">
                                    <h5>Selected Main Category : <span style="color:#3fb4e4">{{ $getOffereData->offer_main_category }}</span> </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>Selected Sub Category : <span style="color:#3fb4e4">{{ $getOffereData->offer_sub_category }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <form class="row g-3 needs-validation custom-input" novalidate="" method="POST"
                            action="{{ url('user-admin/offerUpdate/'.$getOffereData->offer_id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_offer_main_category" value="{{ $getOffereData->offer_main_category }}">
                                <input type="hidden" name="old_offer_sub_category" value="{{ $getOffereData->offer_sub_category }}">
                                <input type="hidden" name="old_offer_image" value="{{$getOffereData->offer_image }}">
                                <input type="hidden" name="old_offer_brand_image" value="{{$getOffereData->offer_brand_image }}">

                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Select Main Category </label>
                                    <select class="form-select mt-2" name="offer_main_category" id="catmain_id">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        @foreach ($mainCategoryData as $mainCategoryRow)
                                            <option value="{{ $mainCategoryRow['cat_main_id'] }}">
                                                {{ $mainCategoryRow['cat_main_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Select Sub Category</label>
                                    <select class="form-select mt-2" name="offer_sub_category" id="catsub_id" >
                                        <option selected="" disabled="" value="">Choose...</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Offer Title</label>
                                    <input class="form-control mt-2" name="offer_title" value="{{ $getOffereData->offer_title }}" type="text" required="">
                                    <div class="invalid-feedback">Please Enter Offer Title.</div>
                                </div>
                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Company Name</label>
                                    <input class="form-control mt-2" name="offer_company_name" value="{{ $getOffereData->offer_company_name }}" type="text"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Company Name.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Country </label>
                                    <input class="form-control" name="offer_country" type="text" value="{{ $getOffereData->offer_country }}" required="">
                                    <div class="invalid-feedback">Please Enter Country.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">State </label>
                                    <input class="form-control" name="offer_state" type="text" value="{{ $getOffereData->offer_state }}" required="">
                                    <div class="invalid-feedback">Please Enter State.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">City </label>
                                    <input class="form-control" name="offer_city" type="text" value="{{ $getOffereData->offer_city }}" required="">
                                    <div class="invalid-feedback">Please Enter City.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Start Date </label>
                                    <input class="form-control" name="offer_start_date" type="date" value="{{ $getOffereData->offer_start_date }}" required="">
                                    <div class="invalid-feedback">Please Select Start Date .</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Start Time </label>
                                    <input class="form-control" name="offer_start_time" type="time" value="{{ $getOffereData->offer_start_time }}" required="">
                                    <div class="invalid-feedback">Please Select Start Time.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">End Date </label>
                                    <input class="form-control" name="offer_end_date" type="date" value="{{ $getOffereData->offer_end_date }}" required="">
                                    <div class="invalid-feedback">Please Select End Date.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">End Time </label>
                                    <input class="form-control" name="offer_end_time" type="time" value="{{ $getOffereData->offer_end_time }}" required="">
                                    <div class="invalid-feedback">Please Select End Time.</div>
                                </div>

                                <div class="col-4">
                                    <label class="form-label" for="formFile1">Choose Offer Image <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                                            <a target="_blank" href="{{asset('custom-images/offers/'.$getOffereData->offer_image)}}">(View Image)</a>
                                    </label>
                                    <input class="form-control" name="offer_image"type="file" aria-label="file example">
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="formFile1">Choose Brand logo

                                        <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                                        <a target="_blank" href="{{asset('custom-images/offers/'.$getOffereData->offer_brand_image)}}">(View Image)</a>

                                    </label>
                                    <input class="form-control" name="offer_brand_image"type="file" aria-label="file example">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Offer Term & Conditions</label>
                                    <textarea class="form-control" name="offer_t_c" required="">{{ $getOffereData->offer_t_c }}</textarea>
                                    <div class="invalid-feedback">Please Enter Offer Term & Conditions.</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Offer Description</label>
                                    <textarea class="form-control" id="editor" name="offer_detail" cols="10" rows="8" required="">{{ $getOffereData->offer_detail }}</textarea>
                                    <div class="invalid-feedback">Please Enter Offer Description.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input class="form-control" name="offer_meta_title" value="{{ $getOffereData->offer_meta_title }}" type="text">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Keywords</label>
                                    <textarea class="form-control" name="offer_meta_keyword">{{ $getOffereData->offer_meta_keyword }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="offer_meta_description">{{ $getOffereData->offer_meta_description }}</textarea>
                                </div>
                                <center>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Submit form</button>        
                                    </div>
                                </center>
                            </form>
                        </div>
                    </div>
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
                    url: "{{ url('admin/getBlogSubCategory') }}",
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
        });
    </script>
@endsection
