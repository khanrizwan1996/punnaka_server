@extends('user_admin.layouts.main')
@section('main-container')
@php use Illuminate\Support\Carbon; @endphp
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Edit Coupon</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'dashboard')}}">Dashboard</a> / </li>
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'couponList')}}">Coupons Listing Details</a> / </li>
                            <li class="breadcrumb-item active">Edit Coupon</li>
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
                                    <h5>Selected Main Category : <span style="color:#3fb4e4">{{ $getCouponData->coupon_main_category }}</span> </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>Selected Sub Category : <span style="color:#3fb4e4">{{ $getCouponData->coupon_sub_category }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ url(USER_ADMIN_URL.'couponUpdate/'.$getCouponData['coupon_id']) }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="old_coupon_image" value="{{ $getCouponData['coupon_image'] }}">
                                <input type="hidden" name="old_coupon_brand_image" value="{{ $getCouponData['coupon_brand_image'] }}">
                                {{-- <input type="hidden" name="old_coupon_t_c" value="{{ $couponSingleData['coupon_t_c'] }}"> --}}
                                <input type="hidden" name="old_coupon_main_category" value="{{ $getCouponData['coupon_main_category'] }}">
                                <input type="hidden" name="old_coupon_sub_category" value="{{ $getCouponData['coupon_sub_category'] }}">
                                
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Select Main Category </label>
                                    <select class="form-select mt-2" name="coupon_main_category" id="catmain_id">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        @foreach ($mainCategoryData as $mainCategoryRow)
                                            <option value="{{ $mainCategoryRow['cat_main_id'] }}">
                                                {{ $mainCategoryRow['cat_main_name'] }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Select Sub Category </label>
                                    <select class="form-select mt-2" name="coupon_sub_category" id="catsub_id">
                                        <option selected="" disabled="" value="">Choose...</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Brand Name <span class="req" style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="coupon_brand_name" type="text" value="{{ $getCouponData->coupon_brand_name }}" required="">
                                    <div class="invalid-feedback">Please Enter Brand Name.</div>
                                </div>
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Company Name <span class="req" style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="coupon_company_name" type="text" value="{{ $getCouponData->coupon_company_name }}"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Company Name.</div>
                                </div>
                                
                                
                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Coupon Title <span class="req" style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="coupon_title" type="text" value="{{ $getCouponData->coupon_title }}"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Coupon Title.</div>
                                </div>

                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Coupon Code <span class="req" style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="coupon_code" type="text" value="{{ $getCouponData->coupon_code }}"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Coupon Code</div>
                                </div>

                                <div class="col-3">
                                    <label class="col-sm-12 col-form-label">Coupon Number <span class="req" style="color: red">*</span></label>
                                    <input class="form-control mt-2" name="coupon_contact" type="text" value="{{ $getCouponData->coupon_contact }}"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Coupon Number</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Coupon Website <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_website" type="text" value="{{ $getCouponData->coupon_website }}" required="">
                                    <div class="invalid-feedback">Please Enter Coupon Website.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Country <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_country" type="text" value="{{ $getCouponData->coupon_country }}" required="">
                                    <div class="invalid-feedback">Please Enter Country.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">State <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_state" type="text" value="{{ $getCouponData->coupon_state }}" required="">
                                    <div class="invalid-feedback">Please Enter State.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">City <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_city" type="text" value="{{ $getCouponData->coupon_city }}" required="">
                                    <div class="invalid-feedback">Please Enter City.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Location <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_location" type="text" value="{{ $getCouponData->coupon_location }}" required="">
                                    <div class="invalid-feedback">Please Enter Location .</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Start Date <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_start_date" type="date" value="{{ Carbon::createFromTimestampMs($getCouponData['coupon_start_date_time'])->format('Y-m-d') }}" required="">
                                    <div class="invalid-feedback">Please Select Start Date .</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Start Time <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_start_time" type="time" value="{{ Carbon::createFromTimestampMs($getCouponData['coupon_start_date_time'])->format('H:i') }}" required="">
                                    <div class="invalid-feedback">Please Select Start Time.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">End Date <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_end_date" type="date" value="{{ Carbon::createFromTimestampMs($getCouponData['coupon_end_date_time'])->format('Y-m-d') }}" required="">
                                    <div class="invalid-feedback">Please Select End Date.</div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">End Time <span class="req" style="color: red">*</span></label>
                                    <input class="form-control" name="coupon_end_time" type="time" value="{{ Carbon::createFromTimestampMs($getCouponData['coupon_end_date_time'])->format('H:i') }}" required="">
                                    <div class="invalid-feedback">Please Select End Time.</div>
                                </div>
                               
                                 
                               

                                
                                <div class="col-6">
                                    <label class="form-label">Brand Description <span class="req" style="color: red">*</span></label>
                                    <textarea class="form-control" name="coupon_brand_detail" rows="10" required="">{{ $getCouponData->coupon_brand_detail }}</textarea>
                                    <div class="invalid-feedback">Please Enter Brand Description.</div>
                                </div>


                                <div class="col-6">
                                    <label class="form-label">Product / Services <span class="req" style="color: red">*</span></label>
                                    <textarea class="form-control" name="coupon_product_services" rows="10"  required="">{{ $getCouponData->coupon_product_services }}</textarea>
                                    <div class="invalid-feedback">Please Enter Product / Services.</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Coupon Term & Condition <span class="req" style="color: red">*</span></label>
                                    <textarea class="form-control" name="coupon_t_c" rows="10"  required="">{{ $getCouponData->coupon_t_c }}</textarea>
                                    <div class="invalid-feedback">Please Enter Coupon Term & Condition.</div>
                                </div>

                             
                                <div class="col-12">
                                    <label class="form-label">Coupon Description <span class="req" style="color: red">*</span></label>
                                    <textarea class="form-control" id="editor" name="coupon_description" cols="10" rows="8" required="">{{ $getCouponData->coupon_description }}</textarea>
                                    <div class="invalid-feedback">Please Enter Coupon Description.</div>
                                </div>


                                <div class="col-4">
                                    <label class="form-label" for="formFile1">Choose coupon Image <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                                        <a target="_blank" href="{{asset('custom-images/coupons/'.$getCouponData->coupon_image)}}">(View Image)</a></label>
                                    <input class="form-control" name="coupon_image"type="file" aria-label="file example">
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="formFile1">Choose Brand logo <span title="Please upload jpg,jpge,png & 2 MB size file only"><i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span>
                                        <a target="_blank" href="{{asset('custom-images/coupons/'.$getCouponData->coupon_brand_image)}}">(View Image)</a></label>
                                    <input class="form-control" name="coupon_brand_image"type="file"
                                        aria-label="file example">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input class="form-control" name="coupon_meta_title" type="text" value="{{ $getCouponData->coupon_meta_title }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Keywords</label>
                                    <textarea class="form-control" name="coupon_meta_keyword">{{ $getCouponData->coupon_meta_keyword }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="coupon_meta_description">{{ $getCouponData->coupon_meta_description }}</textarea>
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
