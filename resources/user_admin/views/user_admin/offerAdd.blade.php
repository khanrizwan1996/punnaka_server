@extends('user_admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3>Add Offer</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{url('user-admin/dashboard')}}">Dashboard</a> / </li>
                            <li class="breadcrumb-item active">Add Offer</li>
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
                            @if(session('message') == MSG_ADD_SUCCESS)
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Data Inserted Successfully!..</div>
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"fdprocessedid="wsb8o"></button>
                                        </div>
                                    <div>
                            @else
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Error In Insert!..</div>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" fdprocessedid="wsb8o"></button>
                                    </div>
                                <div>
                            @endforelse
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body checkbox-checked">
                            <form class="row g-3 needs-validation custom-input" novalidate="" method="POST"
                                action="{{ url('user-admin/offerStore') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Select Main Category </label>
                                    <select class="form-select mt-2" name="offer_main_category" id="catmain_id"
                                        required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        @foreach ($mainCategoryData as $mainCategoryRow)
                                            <option value="{{ $mainCategoryRow['cat_main_id'] }}">
                                                {{ $mainCategoryRow['cat_main_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please Select Main Category.</div>
                                </div>
                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Select Sub Category</label>
                                    <select class="form-select mt-2" name="offer_sub_category" id="catsub_id"
                                        required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Sub Category.</div>
                                </div>
                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Offer Title</label>
                                    <input class="form-control mt-2" name="offer_title" type="text" required="">
                                    <div class="invalid-feedback">Please Enter Offer Title.</div>
                                </div>
                                <div class="col-4">
                                    <label class="col-sm-12 col-form-label">Company Name</label>
                                    <input class="form-control mt-2" name="offer_company_name" type="text"
                                        required="">
                                    <div class="invalid-feedback">Please Enter Company Name.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Country </label>
                                    <input class="form-control" name="offer_country" type="text" required="">
                                    <div class="invalid-feedback">Please Enter Country.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">State </label>
                                    <input class="form-control" name="offer_state" type="text" required="">
                                    <div class="invalid-feedback">Please Enter State.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">City </label>
                                    <input class="form-control" name="offer_city" type="text" required="">
                                    <div class="invalid-feedback">Please Enter City.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Start Date </label>
                                    <input class="form-control" name="offer_start_date" type="date" required="">
                                    <div class="invalid-feedback">Please Select Start Date .</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Start Time </label>
                                    <input class="form-control" name="offer_start_time" type="time" required="">
                                    <div class="invalid-feedback">Please Select Start Time.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">End Date </label>
                                    <input class="form-control" name="offer_end_date" type="date" required="">
                                    <div class="invalid-feedback">Please Select End Date.</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">End Time </label>
                                    <input class="form-control" name="offer_end_time" type="time" required="">
                                    <div class="invalid-feedback">Please Select End Time.</div>
                                </div>

                                <div class="col-4">
                                    <label class="form-label" for="formFile1">Choose Offer Image</label>
                                    <input class="form-control" name="offer_image"type="file" aria-label="file example"
                                        required="">
                                    <div class="invalid-feedback">Please Choose Offer Image</div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="formFile1">Choose Brand logo</label>
                                    <input class="form-control" name="offer_brand_image"type="file"
                                        aria-label="file example" required="">
                                    <div class="invalid-feedback">Please Choose Brand logo</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Offer Term & Conditions</label>
                                    <textarea class="form-control" name="offer_t_c" required=""></textarea>
                                    <div class="invalid-feedback">Please Enter Offer Term & Conditions.</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Offer Description</label>
                                    <textarea class="form-control" id="editor" name="offer_detail" cols="10" rows="8" required=""></textarea>
                                    <div class="invalid-feedback">Please Enter Offer Description.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input class="form-control" name="offer_meta_title" type="text">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Keywords</label>
                                    <textarea class="form-control" name="offer_meta_keyword"></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="offer_meta_description"></textarea>
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
