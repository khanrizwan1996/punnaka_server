@include('frontend.layouts.userHeader')

	<div class="utf_dashboard_content">
      <div id="titlebar" class="dashboard_gradient">
        <div class="row">
          <div class="col-md-12">
            <h2>User Dashboard</h2>
            <nav id="breadcrumbs">
              <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li>Dashboard</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-2">
            <div class="utf_dashboard_stat_content">
              <h4>({{$userActiveBusinessListingCount}})</h4>
              <span>Active <br> Business Listing</span>
			</div>
          </div>
        </div>

        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-3">
            <div class="utf_dashboard_stat_content">
              <h4>({{$userInActiveBusinessListingCount}})</h4>
              <span>In Active <br> Business Listing</span>
			</div>
          </div>
        </div>

        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-4">
            <div class="utf_dashboard_stat_content">
              <h4>({{$userPaidBusinessListingCount}})</h4>
              <span>Business Listing <br> Paid</span>
			</div>
          </div>
        </div>


        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-6">
            <div class="utf_dashboard_stat_content">
              <h4>({{ $userUnPaidBusinessListingCount }})</h4>
              <span>Business Listing <br> UnPaid</span>
			</div>
          </div>
        </div>
      </div>
      <div class="row">

		<div class="col-lg-12 col-md-12 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Recent Payment History</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th>#</th>
					<th>Status</th>
					<th>Payment Id</th>
					<th>Plan Name</th>
					<th>Business Name</th>
					<th>Amount</th>
					<th>Purchase Date</th>
				  </tr>
				</thead>
				<tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($userPaymentHistoryArray as $userPaymentHistoryRow)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            @if ($userPaymentHistoryRow['bus_pay_status'] == 1)
                            <span class="paid" style="background: rgba(0, 0, 0, 0.08);
                            padding: 2px 7px;
                            border-radius: 4px;
                            display: inline;
                            font-size: 12px;
                            font-weight: 700;
                            color: #64bc36;
                            margin-left: 2px;
                            top: -1px;
                            position: relative;">Paid</span>
                            @else
                            <span class="unpaid" style="background: rgba(0, 0, 0, 0.08);
                            padding: 2px 7px;
                            border-radius: 4px;
                            display: inline;
                            font-size: 12px;
                            font-weight: 700;
                            color: #ee3535;
                            margin-left: 2px;
                            top: -1px;
                            position: relative;">Unpaid</span>

                            @endif
                           </td>
                        <td>{{ $userPaymentHistoryRow['bus_pay_payment_id'] }}</td>
                        <td>{{ $userPaymentHistoryRow['bus_pay_plan_type'] }}</td>
                        <td>{{ $userPaymentHistoryRow['bus_pay_user_business_name'] }}</td>
                        <td>${{ $userPaymentHistoryRow['bus_pay_amount'] }}</td>
                        <td>{{ $userPaymentHistoryRow['bus_pay_added_time'] }}</td>
                    </tr>
                    @endforeach
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
        <div class="col-md-12">
          <div class="footer_copyright_part">Punnaka.Com All Rights Reserved | Designed By Weborbitech | Powered By Social Beast |</div>
        </div>
      </div>
    </div>
@include('frontend.layouts.userFooter')
