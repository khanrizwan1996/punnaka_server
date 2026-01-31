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
                  <li><a href="{{ url('/franchiseList/1') }}" class="activeUrl">Active Franchise List</a></li>
                  @php $title = "In Active Offer List" @endphp
                  @elseif (Route::input('status') == 1)
                  <li><a href="{{ url('/franchiseList/0') }}" class="activeUrl">In Active Franchise List</a></li>
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
                        <th>Main Category</th>
                        <th>Sub Category</th>
                        <th>Child Category</th>
                        <th>Franchise Name</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Added Date & Time</th>
                        <th>Update Date & Time</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php
                     $i = 1;
                     @endphp
                     @foreach ($getFranchiseData as $getFranchiseRow)
                     <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                           @if($getFranchiseRow['f_status'] == 0)
                           <center>
                              <div class="dropdown">
                                 <a class="activeUrl" style="font-size:25px; cursor:pointer"><i class="fa fa-gear"></i></a>
                                 <div class="dropdown-content">
                                    <a href="@" > Edit Detail</a>
                                 </div>
                              </div>
                           </center>
                           @else
                           <center> <b>-</b> </center>
                           @endif
                        </td>
                        <td>@if($getFranchiseRow['f_status'] == 0)
                           <span class="inActiveStatus">In Active</span>
                           @else<span class="activeStatus">Active</span>
                           @endif
                        </td>
                        <td>{{ $getFranchiseRow['f_main_cat'] }}</td>
                        <td>{{ $getFranchiseRow['f_sub_cat'] }}</td>
                        <td>{{ $getFranchiseRow['f_child_cat'] }}</td>
                        <td>{{ $getFranchiseRow['f_name'] }}</td>
                        <td>{{ $getFranchiseRow['f_contact_no'] }}</td>
                        <td>{{ $getFranchiseRow['f_email'] }}</td>
                        <td>{{ date('j F Y h:i:s', strtotime($getFranchiseRow['f_added_time'])) }}</td>
                        <td>@if(!empty($getFranchiseRow['coupon_changed_time'])){{ date('j F Y h:i:s', strtotime($getFranchiseRow['f_changed_time'])) }} @endif</td>
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
