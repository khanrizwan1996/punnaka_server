@include('frontend.layouts.userHeader')
<div class="utf_dashboard_content">
   <div id="titlebar" class="dashboard_gradient">
      <div class="row">
         <div class="col-md-12">
            <h2></h2>
            <nav id="breadcrumbs">
               <ul>
                  <li><a href="{{ url('/dashboard') }}" class="activeUrl">Dashboard</a></li>
                  @if (Route::input('status') == 0)
                  <li><a href="{{ url('/offerList/1') }}" class="activeUrl">Active Offer List</a></li>
                  @php $title = "In Active Offer List" @endphp
                  @elseif (Route::input('status') == 1)
                  <li><a href="{{ url('/offerList/0') }}" class="activeUrl">In Active Offer List</a></li>
                  @php $title = "Active Offer List" @endphp
                  @endif
               </ul>
            </nav>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12 col-md-12 mb-4">
         <div class="utf_dashboard_list_box table-responsive recent_booking">
            <h4>{{$title}}</h4>
            <div class="col-lg-12 col-md-12 mb-4">
               <table id="tableID" class="display">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Offer Title</th>
                        <th>Main Category</th>
                        <th>Sub Category</th>
                        {{--<th>Mall Name</th>
                        <th>Brand Name</th>--}}
                        <th>Added Date & Time</th>
                        <th>Update Date & Time</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php
                     $i = 1;
                     @endphp
                     @foreach ($offerData as $offerRow)
                     <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                           @if($offerRow->offer_status == 0)
                           <center>
                              <div class="dropdown">
                                 <a class="activeUrl" style="font-size:25px; cursor:pointer"><i class="fa fa-gear"></i></a>
                                 <div class="dropdown-content">
                                    <a  href="{{url('offerEdit/'.$offerRow->offer_id)}}" > Edit Detail</a>
                                 </div>
                              </div>
                           </center>
                           @else
                           <center> <b>-</b> </center>
                           @endif
                        </td>
                        <td>@if($offerRow->offer_status == 0)
                           <span class="inActiveStatus">In Active</span>
                           @else<span class="activeStatus">Active</span>
                           @endif
                        </td>
                        <td>{{ $offerRow->offer_title }}</td>
                        <td>{{ $offerRow->offer_main_category }}</td>
                        <td>{{ $offerRow->offer_sub_category }}</td>
                        {{--
                        <td>{{ $offerRow->mall_name }}</td>
                        <td>{{ $offerRow->brand_name }}</td>
                        --}}
                        <td>{{ date('j F Y h:i:s', strtotime($offerRow->offer_added_timestamp)) }}</td>
                        <td>@if(!empty($offerRow->offer_changed_timestamp)){{ date('j F Y h:i:s', strtotime($offerRow->offer_changed_timestamp)) }} @endif</td>
                        {{--
                        <td>
                           @if($offerRow->offer_status == 0)
                           <a href="{{url('offerEdit/'.$offerRow->offer_id)}}" class="activeUrl"><i class="fa fa-edit"></i> Edit Details</a>
                           @else
                           <center> <b>-</b> </center>
                           @endif
                        </td>
                        --}}
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@include('frontend.layouts.userFooter')
