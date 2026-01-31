@php
    $parts = preg_split('/\s+/', trim($couponDetail['cf_store_name']));
    if(count($parts) > 1) {
        $initials = substr($parts[0], 0, 1) . substr(end($parts), 0, 1);
    }else{
        $initials = substr($parts[0], 0, 2);
    }
@endphp
<div class="offer-page">
    <div class="breadcrumbs">Home &nbsp;/&nbsp; Offer Deals</div>
    <header class="offer-header">
        <div class="offer-brand">
            <div class="offer-brand-logo">{{ strtoupper($initials) }}</div>
            <div>
                <div class="offer-brand-name">{{ $couponDetail['cf_store_name'] }}</div>
                <div class="logo"><img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_store_logo']) }}">
                </div>
            </div>
        </div>
        <div class="offer-actions"></div>
    </header>

    <section class="offer-hero">
        <div class="offer-hero-content">
            <h1 class="offer-title">{{ $couponDetail['cf_title'] }}</h1>
            <div class="offer-sub">{{ $couponDetail['cf_short_tagline'] }}</div>

            <div class="offer-cta">
                <button class="offer-btn">Grab Deal</button>
                <button class="offer-btn offer-btn--primary">Grab Deal</button>
            </div>

            <div class="offer-side-card offer-info">
                <div class="offer-row">
                    <div class="offer-label">Code Required</div>
                    <div class="offer-value">{{ $couponDetail['cf_offer_code_required'] }}</div>
                </div>
                <div class="offer-row">
                    <div class="offer-label">Offer Type</div>
                    <div class="offer-value">{{ $couponDetail['cf_offer_type'] }}</div>
                </div>
                <div class="offer-row">
                    <div class="offer-label">Discount Value</div>
                    <div class="offer-value">{{ $couponDetail['cf_offer_discount_value'] }}</div>
                </div>
                <div class="offer-row">
                    <div class="offer-label">Offer Description <br><span style="font-weight: 600;color: black;">{{ $couponDetail['cf_offer_desc'] }}</span>
                    </div>
                </div>
                <div class="offer-row">
                    <div class="offer-label">Valid Until</div>
                    <div class="offer-value">{{ $couponDetail['cf_offer_valid_till'] }}</div>
                </div>
                <h3 class="offer-section-title">Details</h3>
                <div class="offer-row">
                    <div class="offer-label">Category</div>
                    <div class="offer-value">{{ $couponDetail['cf_main_cat'] . ' / ' . $couponDetail['cf_sub_cat'] }}</div>
                </div>
                <div class="offer-row" style="border-bottom: none;">
                    <div class="offer-label"> Start &amp; End Date</div>
                    <div class="offer-value">{{ $couponDetail['cf_start_date'] . ' - ' . $couponDetail['cf_end_date'] }}
                    </div>
                </div>
            </div>
        </div>
        <aside>
            <div class="offer-side-card">
                <img style="border-radius: 10px; height: 150px;"
                    src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_banner_thumbnail']) }}">
                <div class="offer-side-logo">
                    <div class="offer-side-logo-img">{{ strtoupper($initials) }}</div>
                    <div>
                        <div style="font-weight:700">{{ $couponDetail['cf_store_name'] }}</div>
                        <a class="offer-side-link" href="{{ $couponDetail['cf_store_website'] }}" target="_blank">View
                            All Offers by {{ $couponDetail['cf_store_name'] }}</a>
                    </div>
                </div>

                <div class="offer-side-meta">
                    <div class="offer-side-meta-row">
                        <div class="label">Highlight Options</div>
                        <div>{{ $couponDetail['cf_highlight_options'] }}</div>
                    </div>
                    <div class="offer-side-meta-row">
                        <div class="label">Sort Priority</div>
                        <div>{{ $couponDetail['cf_sort_priority'] }}</div>
                    </div>
                    <div class="offer-side-meta-row">
                        <div class="label">Admin Notes</div>
                        <div>{{ $couponDetail['cf_admin_note'] }}</div>
                    </div>
                </div>
            </div>

            <br>
            <div class="offer-meta-card">
                <div class="offer-meta-title">Platforms</div>
                <div class="offer-meta-body">
                    <div class="offer-icon">🖥️</div>Web, App
                </div>
            </div>
            <div style="height:14px"></div>
            <div class="offer-meta-card">
                <div class="offer-meta-title">User Type</div>
                <div class="offer-meta-body">
                    <div class="offer-icon">👤</div>All Users
                </div>
            </div>
            <div style="height:14px"></div>
            <div class="offer-meta-card">
                <div class="offer-meta-title">Region / City</div>
                <div class="offer-meta-body">
                    <div class="offer-icon">📍</div>Pan India
                </div>
            </div>
        </aside>
    </section>
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
                    <a href="{{ url('coupon-detail/'.$latestCouponCity.'/'.$latestCouponCategoryName . '/' . $latestCouponTitle) }}">{{ $getLatestCouponOfferListingRow->cf_title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
