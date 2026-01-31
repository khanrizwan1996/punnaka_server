@extends('user_admin.layouts.main')
@section('main-container')
<link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/datatables.css')}}">
       <div class="page-body">
          <div class="container-fluid">
            <div class="row page-title">
              <div class="col-sm-6">
                <h3>Coupons Listing Details</h3>
              </div>
              <div class="col-sm-6">
                <nav>
                  <ol class="breadcrumb justify-content-sm-end align-items-center">
                    <li class="breadcrumb-item"><a href="{{url('user-admin/dashboard')}}">Dashboard</a> / </li>
                    <li class="breadcrumb-item active">Coupons Listing Details</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>SR. No</th>
                                <th>Action</th>
                                <th>Coupon Title</th>
                                <th>Main Category</th>
                                <th>Sub Category</th>
                                <th>Added Date & Time</th>
                                <th>Update Date & Time</th>
                             </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($getCouponData as $couponRow)
                            <tr>
                               <td>{{ $i++ }}</td>
                               <td>    
                                <div class="dropdown icon-dropdown">
                                  <button class="btn dropdown-toggle" id="userdropdown{{$i}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" fdprocessedid="xw6ho5">Edit Detail</button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown{{$i}}">
                                    <a class="dropdown-item" href="{{url('user-admin/couponEdit/'.$couponRow->coupon_id)}}"> Edit Detail</a>
                                </div>
                              </td>
                               <td>{{ $couponRow->coupon_title }}</td>
                               <td>{{ $couponRow->coupon_main_category }}</td>
                               <td>{{ $couponRow->coupon_sub_category }}</td>
                               <td>{{ date('j F Y h:i:s', strtotime($couponRow->coupon_added_time)) }}</td>
                               <td>@if(!empty($couponRow->coupon_changed_time)){{ date('j F Y h:i:s', strtotime($couponRow->coupon_changed_time)) }} @endif</td>
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
