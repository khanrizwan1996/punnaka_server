@php
  $highlightItems = explode(',', $couponDetail['cf_highlight_options']);
  $freeRechargeEligibleOperators = explode(',', $couponDetail['cf_free_recharge_eligible_operators']);
@endphp   
  <div class="free-recharge-card">
    <!-- Header -->
    <div class="free-recharge-header">
     <img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_store_logo']) }}" class="free-recharge-logo">
      <div>
        <div class="free-recharge-title">{{ $couponDetail['cf_title'] }}</div>
        <div class="free-recharge-subtitle">{{ $couponDetail['cf_short_tagline'] }}!</div>
      </div>
    </div>

    <!-- Status Badges -->
    <div class="free-recharge-badges">
      <div class="free-recharge-badge" style="background:#e0f7e9; color:#0a8f55;">ACTIVE</div>
      <div class="free-recharge-badge" style="background:#e6f0ff; color:#1a4ddb;">VERIFIED</div>
      <div class="free-recharge-badge" style="background:#fdf0e6; color:#b44d00;">LIMITED OFFER</div>
    </div>

    <!-- Button -->
    <button class="free-recharge-btn">CLAIM NOW</button>

    <!-- Main -->
    <div class="free-recharge-main">
      <!-- Left -->
      <div class="free-recharge-left">
        <div class="free-recharge-info">Recharge Type</div>
        <div><strong>{{ $couponDetail['cf_free_recharge_type'] }}</strong></div>

        <div class="free-recharge-info">Eligible Operators</div>
        <div class="free-recharge-operators">
         
            @foreach ($freeRechargeEligibleOperators as $freeRechargeEligibleOperatorsRow)
              <div class="free-recharge-operator">{{ $freeRechargeEligibleOperatorsRow }}</div> 
            @endforeach
            
        </div>

        <div class="free-recharge-info">Recharge Instructions</div>
        <div>{{ $couponDetail['cf_free_recharge_instructions'] }}</div>
        <br>
        <div class="free-recharge-info">Recharge Code</div>
        <div class="free-recharge-code">{{ $couponDetail['cf_free_recharge_code'] }}</div>
        <br>

        <div class="free-recharge-info">Claim URL</div>
        <div class="free-recharge-url"><a href="{{ $couponDetail['cf_free_recharge_code'] }}" target="_blank">{{ $couponDetail['cf_free_recharge_code'] }}</a></div>

        <div class="free-recharge-info">Description</div>
        {!! $couponDetail['cf_desc'] !!}
        <br>

      </div>

      <!-- Right -->
      <div class="free-recharge-right">
        <img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_banner_thumbnail']) }}">

        <div class="free-recharge-side-box">
          <div class="free-recharge-side-title">Highlights</div>
          <div class="free-recharge-tags">
              @if(isset($highlightItems[0]) && $highlightItems[0] == 'Homepage')
                <div class="free-recharge-tag">Homepage</div>
              @elseif(isset($highlightItems[0]) && $highlightItems[0] == 'Trending')
                <div class="free-recharge-tag">Trending</div>
              @endif
              @if(isset($highlightItems[0]) && isset($highlightItems[1]) && $highlightItems[1] == 'Trending')
                <div class="free-recharge-tag">Trending</div>
              @endif
          </div>
        </div>

        <div class="free-recharge-side-box">
          <div class="free-recharge-side-title">Sort Priority</div>
          <div>{{ $couponDetail['cf_sort_priority'] }}</div>
        </div>

        <div class="free-recharge-side-box">
          <div class="free-recharge-side-title">Admin Notes</div>
          <div>{{ $couponDetail['cf_admin_note'] }}</div>
        </div>
      </div>
    </div>

    <!-- Details -->
    <div class="free-recharge-details">
      <div class="free-recharge-details-title">Details</div>
      <table class="free-recharge-table">
        <tr><td>Category</td><td>{{ $couponDetail['cf_main_cat']." / ".$couponDetail['cf_sub_cat'] }}</td></tr>
        <tr><td>Start Date & End Date</td><td>{{ $couponDetail['cf_start_date'] }} - {{ $couponDetail['cf_end_date'] }}</td></tr>
        {{-- <tr><td>Description</td><td>{!! $couponDetail['cf_desc'] !!}</td></tr> --}}
        <tr><td>Terms & Conditions</td><td>{{ $couponDetail['cf_term_condition'] }}</td></tr>
        <tr><td>Platforms</td><td>{{ $couponDetail['cf_platform'] }}</td></tr>
        <tr><td>User Type</td><td>{{ $couponDetail['cf_user_type'] }}</td></tr>
        <tr><td>Region</td><td>{{ $couponDetail['cf_city'] }}</td></tr>
      </table>
    </div>

    <div class="free-recharge-footer">Last Updated on  
      @if (!empty($couponDetail->cf_changed_time))
                    {{ date('j F Y', strtotime($couponDetail->cf_changed_time)) }}
                @else
                    {{ date('j F Y', strtotime($couponDetail->cf_added_time)) }}
                @endif</div>
  </div>
<div class="sidebar">
    <div class="utf_box_widget margin-top-35 margin-bottom-75">
        <h3 style="font-size: 16px;"><i class="sl sl-icon-folder-alt"></i>Latest Offer / Deal List</h3>
        <ul class="utf_listing_detail_sidebar">
            @foreach ($getLatestCouponOfferListing as $getLatestCouponOfferListingRow)
                @php
                    $latestCouponTitle = urlencode(str_replace(' ', '-', $getLatestCouponOfferListingRow['cf_title']));
                    $latestCouponCategoryName = str_replace(' ', '-', $getLatestCouponOfferListingRow['cf_sub_cat']);
                    $latestCouponCity = str_replace(' ', '-', $getLatestCouponOfferListingRow['cf_city']);
                @endphp
                <li>
                    <i class="fa fa-angle-double-right"></i>
                    <a
                        href="{{ url('coupon-detail/' . $latestCouponCity . '/' . $latestCouponCategoryName . '/' . $latestCouponTitle) }}">{{ $getLatestCouponOfferListingRow->cf_title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
