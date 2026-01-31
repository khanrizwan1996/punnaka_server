@php
    $highlightItems = explode(',', $couponDetail['cf_highlight_options']);
    $parts = preg_split('/\s+/', trim($couponDetail['cf_store_name']));
    if (count($parts) > 1) {
        $initials = substr($parts[0], 0, 1) . substr(end($parts), 0, 1);
    } else {
        $initials = substr($parts[0], 0, 2);
    }
@endphp

<div class="free-sample-page">
    <div class="breadcrumbs">Home &nbsp;/&nbsp; Free Sample</div>
    <header class="free-sample-header">
        <div class="free-sample-brand">
            <div class="free-sample-brand-logo">{{ strtoupper($initials) }}</div>
            <div>
                <div class="free-sample-brand-name">{{ $couponDetail['cf_store_name'] }}</div>
            </div>
        </div>
        {{-- <div class="free-sample-brand-right free-sample-logo-text">LOGO</div> --}}
    </header>

    <div class="free-sample-grid">
        <main class="free-sample-main">

            <h1 class="free-sample-title">{{ $couponDetail['cf_title'] }}</h1>
            <div class="free-sample-sub">{{ $couponDetail['cf_short_tagline'] }}</div>

            <div class="free-sample-badges">
                <div class="free-sample-badge free-sample-badge--active">✓ Active</div>
                <div class="free-sample-badge">Verified</div>
                {{-- <div class="free-sample-badge">Limited Stock</div> --}}
            </div>

            <div class="free-sample-actions">
                <button class="free-sample-btn free-sample-btn--primary">Get Free Sample</button>
                <a href="{{ $couponDetail['cf_store_website'] }}" target="_blank" class="free-sample-btn">Visit Brand
                    Website</a>
            </div>

            <div class="free-sample-table" role="table">
                <div class="free-sample-table-row">
                    <div class="free-sample-label">Freebie Type</div>
                    <div class="free-sample-value">{{ $couponDetail['cf_free_sample_freebie_type'] }}</div>
                </div>

                <div class="free-sample-table-row">
                    <div class="free-sample-label">Sample Description</div>
                    <div class="free-sample-value">{{ $couponDetail['cf_free_sample_desc'] }}</div>
                </div>

                <div class="free-sample-table-row">
                    <div class="free-sample-label">Sample Quantity</div>
                    <div class="free-sample-value">{{ $couponDetail['cf_free_sample_quantity'] }}</div>
                </div>

                <div class="free-sample-table-row">
                    <div class="free-sample-label">Eligible Users</div>
                    <div class="free-sample-value">{{ $couponDetail['cf_free_sample_eligible_users'] }}</div>
                </div>
            </div>

            <h2 class="free-sample-section-title">Details</h2>
            <div class="free-sample-details">
                <div style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap">
                    <div style="min-width:160px;color:var(--free-sample-muted)">Category</div>
                    <div>{{ $couponDetail['cf_main_cat'] }}</div>
                </div>
                <div style="height:12px"></div>
                <div style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap">
                    <div style="min-width:160px;color:var(--free-sample-muted)">Start &amp; End Date</div>
                    <div>{{ $couponDetail['cf_start_date'] }} - {{ $couponDetail['cf_end_date'] }}</div>
                </div>
                <div style="height:12px"></div>
                <div style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap">
                    <div style="min-width:160px;color:var(--free-sample-muted)">Description</div>
                    <div>{!! $couponDetail['cf_desc'] !!}</div>
                </div>

                <hr class="sep" />

                <div class="free-sample-section-title">Terms &amp; Conditions</div>
                <div style="color:var(--free-sample-muted)">{{ $couponDetail['cf_term_condition'] }}</div>

                <hr class="sep" />

                <div class="free-sample-meta-grid">
                    <div class="free-sample-meta-card">
                        <div class="free-sample-meta-title">Platforms</div>
                        <div class="free-sample-meta-body">{{ $couponDetail['cf_platform'] }}</div>
                    </div>
                    <div class="free-sample-meta-card">
                        <div class="free-sample-meta-title">User Type</div>
                        <div class="free-sample-meta-body">{{ $couponDetail['cf_user_type'] }}</div>
                    </div>
                    <div class="free-sample-meta-card">
                        <div class="free-sample-meta-title">Region / City</div>
                        <div class="free-sample-meta-body">{{ $couponDetail['cf_city'] }}</div>
                    </div>
                </div>
            </div>
            <div class="free-sample-footer">Last Updated on 
                @if (!empty($couponDetail->cf_changed_time))
                    {{ date('j F Y', strtotime($couponDetail->cf_changed_time)) }}
                @else
                    {{ date('j F Y', strtotime($couponDetail->cf_added_time)) }}
                @endif
            </div>
        </main>

        <aside class="free-sample-side">
            <div class="free-sample-side-card">
                <div class="free-sample-side-image">
                    <img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_store_logo']) }}">
                </div>
                <br>
                <div class="free-sample-side-meta">
                    <div class="free-sample-side-meta-row">
                        <div>HIGHLIGHTS</div>
                        <div class="free-sample-side-hl">

                            @if(isset($highlightItems[0]) && $highlightItems[0] == 'Homepage')
                                <div class="free-sample-check">
                                    <div class="free-sample-check-box">✓</div>
                                    <div>Homepage</div>
                                </div>
                            @elseif(isset($highlightItems[0]) && $highlightItems[0] == 'Trending')
                               <div class="free-sample-check">
                                    <div class="free-sample-check-box">✓</div>
                                    <div>Trending</div>
                                </div>
                            @endif
                            @if(isset($highlightItems[0]) && isset($highlightItems[1]) && $highlightItems[1] == 'Trending')
                                <div class="free-sample-check">
                                    <div class="free-sample-check-box">✓</div>
                                    <div>Trending</div>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                    <div class="free-sample-side-meta-row">
                        <div class="label">Sort Priority</div>
                        <div>{{ $couponDetail['cf_sort_priority'] }}</div>
                    </div>
                    <div class="free-sample-side-meta-row">
                        <div class="label">Admin Notes</div>
                        <div>{{ $couponDetail['cf_admin_note'] }}</div>
                    </div>
                </div>
            </div>
            <div class="free-sample-side-small">
                <div class="img">
                    <img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_banner_thumbnail']) }}">
                </div>
            </div>
        </aside>
    </div>
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
