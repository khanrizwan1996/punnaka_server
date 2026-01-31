@extends('user_admin.layouts.main')
@section('main-container')
@include('user_admin.partials.checkUserPaymentCount')
@php
    $checkUserPaymentCountObj = new App\Http\Controllers\user_admin\userBusinessListingController();
    $checkUserFranchiseListingCountObj = new App\Http\Controllers\user_admin\userFranchiseController();
    $checkUserCouponAndOfferCountObj = new App\Http\Controllers\user_admin\userCouponAndOfferController();
    $checkUserProductAndServiceCountObj = new App\Http\Controllers\user_admin\userProductAndServiceController();

    $checkBusinesListingPaymentCount = $checkUserPaymentCountObj->checkBusinesListingPaymentCount();
    $checkFranchisePaymentCount = $checkUserPaymentCountObj->checkFranchisePaymentCount();
    $checkCouponAndOfferPaymentCount = $checkUserPaymentCountObj->checkCouponAndOfferPaymentCount();
    $checkProductAndServicePaymentCount = $checkUserPaymentCountObj->checkProductAndServicePaymentCount();

    $checkBusinessListingCount = $checkUserPaymentCountObj->checkBusinessListingCount();
    $checkFranchiseListingCount = $checkUserFranchiseListingCountObj->checkFranchiseListingCount();
    $checkCouponAndOfferCount = $checkUserCouponAndOfferCountObj->checkCouponAndOfferCount();
    $checkProductServiceCount = $checkUserProductAndServiceCountObj->checkProductServiceCount();

    if($checkBusinesListingPaymentCount == 0){
      $businessListingUrl = '../business-listing';
    }else{
      if($checkBusinessListingCount == $checkBusinesListingPaymentCount){
        $businessListingUrl = '../business-listing'; 
      }else{
        $businessListingUrl = '../add-business-details'; 
      }
    }

    if($checkFranchisePaymentCount == 0){
      $franchiseListingUrl = '../business-listing'; 
    }else{
      if($checkFranchiseListingCount == $checkFranchisePaymentCount){
        $franchiseListingUrl = '../business-listing'; 
      }else{
        $franchiseListingUrl = USER_ADMIN_URL.'franchiseAdd'; 
      }
    }

    if($checkCouponAndOfferPaymentCount == 0){
      $couponOfferUrl = '../business-listing';  
    }else{
      if($checkCouponAndOfferCount == $checkCouponAndOfferPaymentCount){
        $couponOfferUrl = '../business-listing'; 
      }else{
        $couponOfferUrl = USER_ADMIN_URL.'couponOfferAdd'; 
      }
    }

    if($checkProductAndServicePaymentCount == 0){
      $productServiceUrl = '../business-listing';
    }else{
      if($checkProductServiceCount == $checkProductAndServicePaymentCount){
        $productServiceUrl = '../business-listing'; 
      }else{
        $productServiceUrl = USER_ADMIN_URL.'productServiceAdd'; 
      }
    }
    @endphp

    <link rel="stylesheet" type="text/css" href="{{ asset('user_admin/assets/css/vendors/datatables.css') }}">
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-sm-6">
                    <h3 style="color: #af4646">Welcome back, {{ Auth::user()->name }}</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid default-dashboard">
            <div class="row">
                <div class="col-md-12">
                    <h4>Listing Summary</h4>
                    <br>
                </div>
                <div class="col-md-3">
                    <div class="card progress-items">
                        <div class="card-header pb-0">
                            <div>
                                <div class="d-flex gap-2">
                                    <img class="stroke-icon" src="{{ url('custom-images/icons/franchise.png') }}"
                                        style="height: 20px;">
                                    <h5 class="f-18">Franchise Listing</h5>
                                </div>
                                <h5 class="f-w-600 mt-3 f-14">Total number of listing ({{ $totalFranchiseCount }})</h5>
                                <br>
                                <a href="{{url($franchiseListingUrl)}}" class="btn btn-primary" style="font-size:14px">+ Add Franchise Listing</a>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card progress-items">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="d-flex gap-2">
                                        <img class="stroke-icon" src="{{ url('custom-images/icons/timeline.png') }}"
                                            style="height: 20px;">
                                        <h5 class="f-18">Business Listing</h5>
                                    </div>
                                    <h5 class="f-w-600 mt-3 f-14">Total number of listing ({{ $totalBusinessListingCount }})
                                    </h5>
                                    <br>
                                    <a href="{{url($businessListingUrl)}}" class="btn btn-primary" style="font-size:14px">+ Add Business Listing</a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card progress-items">
                        <div class="card-header pb-0">
                            <div>
                                <div class="d-flex gap-2">
                                    <img class="stroke-icon" src="{{ url('custom-images/icons/ps.png') }}"
                                        style="height: 20px;">
                                    <h5 class="f-18">Products/Services Listing</h5>
                                </div>
                                <h5 class="f-w-600 mt-3 f-14">Total number of listing ({{ $totalProductAndServiceCount }})
                                </h5>
                                <br>
                                <a href="{{url($productServiceUrl)}}" class="btn btn-primary" style="font-size:14px">+ Add Products/Services Listing</a>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card progress-items">
                        <div class="card-header pb-0">
                            <div>
                                <div class="d-flex gap-2">
                                    <img class="stroke-icon" src="{{ url('custom-images/icons/discount.png') }}"
                                        style="height: 20px;">
                                    <h5 class="f-18">Offers/Coupons Listing</h5>
                                </div>
                                <h5 class="f-w-600 mt-3 f-14">Total number of listing (0)</h5>
                                <br>
                                <a href="{{url($couponOfferUrl)}}" class="btn btn-primary"  style="font-size:14px">+ Add Offers/Coupons Listing</a>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <h4>All Listing</h4>
                                <br>
                            </div>
                            <div class="table-responsive">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>SR. No</center>
                                            </th>
                                            <th>Edit Listing</th>
                                            <th>Listing Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Added Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($records as $recordRow)
                                            <tr>
                                                <td>
                                                    <center>{{ $i++ }}</center>
                                                </td>
                                                <td>
                                                    @if ($recordRow->source == 'franchise')
                                                        <span><a href="{{ url(USER_ADMIN_URL.'franchiseEdit/' . $recordRow->id) }}"
                                                                class="btn btn-sm btn-primary">Edit List</a></span>
                                                    @elseif($recordRow->source == 'product_service')
                                                        <span>
                                                            <a href="{{ url(USER_ADMIN_URL.'productServiceEdit/' . $recordRow->id) }}"
                                                                class="btn btn-sm btn-primary">Edit List</a></span>
                                                    @elseif($recordRow->source == 'business_listing')
                                                        <span><a href="{{ url(USER_ADMIN_URL.'businessListingEdit/' . $recordRow->id) }}"
                                                                class="btn btn-sm btn-primary">Edit List</a></span>
                                                    @elseif($recordRow->source == 'coupon_offer')
                                                        <span><a href="{{ url(USER_ADMIN_URL.'couponOfferEdit/' . $recordRow->id) }}"
                                                                class="btn btn-sm btn-primary">Edit List</a></span>
                                                    @endif
                                                    

                                                </td>
                                                <td>{{ $recordRow->name }}</td>
                                                <td>
                                                    @if($recordRow->source == 'franchise')
                                                        <span>Franchise Listing</span>
                                                    @elseif($recordRow->source == 'product_service')
                                                        <span>Product & Service Listing</span>
                                                    @elseif($recordRow->source == 'business_listing')
                                                        <span>Business Listing</span>
                                                    @elseif($recordRow->source == 'coupon_offer')
                                                        <span>Coupon Listing</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($recordRow->status == STATUS_ACTIVE)
                                                        <span style="padding: 5px;" class="f-13 w-100 btn-light-primary"
                                                            fdprocessedid="xprjs2">
                                                            <center>Active</center>
                                                        </span>
                                                    @else
                                                        <span style="padding: 5px;" class="f-13 w-100 btn-light-danger"
                                                            fdprocessedid="lvkpk">
                                                            <center>In Active</center>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ date('j F Y h:i:s', strtotime($recordRow->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
