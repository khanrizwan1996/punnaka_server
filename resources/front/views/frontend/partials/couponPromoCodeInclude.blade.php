<div class="page">
    <div class="breadcrumbs">Home &nbsp;/&nbsp; Coupons &nbsp;/&nbsp; Promo Code</div>

    <div class="topbar">
        <div class="badges">
            <div class="badge trend">TRENDING</div>
            <div class="badge verified"><i class="fa fa-check-square-o"></i> VERIFIED</div>
            <div class="badge active">ACTIVE</div>
        </div>
        <div class="cta">
            <a class="btn primary">Get Code</a>
            <a href="{{ $couponDetail['cf_store_website'] }}" target="_blank" class="btn ghost">Visit
                Store</a>
        </div>
    </div>

    <div class="row">
        <div class="main">
            <div class="header-grid">
                <div class="logo"><img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_store_logo']) }}">
                </div>
                <div>
                    <h1 class="title">{{ $couponDetail['cf_title'] }}</h1>
                    <div class="subtitle">{{ $couponDetail['cf_short_tagline'] }}</div>
                </div>
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px">
                    <!-- right top small box duplicate of cta on large screens -->
                    {{-- <div
                        style="background:#fff;padding:12px;border-radius:10px;border:1px solid var(--border);min-width:220px;text-align:center">
                        <div style="font-weight:800;font-size:20px"><?= $couponDetail['cf_store_name'] ?></div>
                        <div style="color:var(--muted);font-size:13px;margin-top:6px"><?= $couponDetail['cf_store_website'] ?></div>
                        </div> --}}
                </div>
            </div>

            <div class="info-card">
                <div class="info-list">
                    <div class="info-row">
                        <div class="code-box" style="margin-bottom: 10px;">
                            {{ $couponDetail['cf_coupon_promo_code'] }}</div>
                        <span class="label">Login Required: </span>
                        <span class="val">{{ $couponDetail['cf_coupon_login_required_redeem'] }}</span><br>
                        <span class="label" style="margin-top:6px">Redemption Limit: </span>
                        <span class="val">{{ $couponDetail['cf_coupon_redemption_limit'] }}</span>
                    </div>

                    <div class="info-row" style="line-height: 2.03; margin-bottom: 23px;">
                        <span class="label">Discount Type: </span>
                        <span
                            class="val">{{ $couponDetail['cf_coupon_discount_type'] . ' ₹' . $couponDetail['cf_coupon_discount_value'] }}</span><br>

                        <span class="label">Min Orr Value: </span>
                        <span class="val">{{ $couponDetail['cf_coupon_min_order_value'] }}</span><br>

                        <span class="label">Max. Discount: </span>
                        <span class="val">{{ $couponDetail['cf_coupon_max_discount_cap'] }}</span><br>

                        <span class="label">Redemption Limit: </span>
                        <span class="val">{{ $couponDetail['cf_coupon_redemption_limit'] }}</span><br>
                    </div>
                </div>
            </div>

            <h3 class="section-title">Details</h3>
            <div class="details">{!! $couponDetail['cf_desc'] !!} </div>
            <hr class="sep" />
            <h3 class="section-title">Terms &amp; Conditions</h3>
            <p>{{ $couponDetail['cf_term_condition'] }}</p>
            <hr class="sep" />
            <div class="info-list">
                <div class="info-row">
                    <div class="aside-card"style="width: 300px;">
                        <i class="fa fa-calendar"></i> Validity:
                       {{ $couponDetail['cf_start_date'] . ' - ' . $couponDetail['cf_end_date'] }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="aside-card"style="width: 300px;">
                        👤 User Type:
                        {{ $couponDetail['cf_user_type'] }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="aside-card"style="width: 300px;">
                        🖥️ Platform:
                        {{ $couponDetail['cf_platform'] }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="aside-card"style="width: 300px;">
                        📍 Region / City:
                        {{ $couponDetail['cf_city'] }}
                    </div>
                </div>
            </div>
            <hr class="sep" />
            <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap">
                <div style="font-size:13px;color:var(--muted)">Last Updated on
                    @if (!empty($couponDetail->cf_changed_time))
                        {{ date('j F Y', strtotime($couponDetail->cf_changed_time)) }}
                    @else
                        {{ date('j F Y', strtotime($couponDetail->cf_added_time)) }}
                    @endif
                </div>
            </div>
        </div>

        <aside class="sidebar">
            <div class="aside-card">
                <div class="aside-logo"><img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_store_logo']) }}">
                </div>
                <div style="font-weight:700;font-size:18px;margin-bottom:6px">
                    {{ $couponDetail['cf_store_name'] }}</div>
                <div style="color:var(--muted);font-size:13px">
                    {{ $couponDetail['cf_coupon_redirect_affiliate_url'] }}</div>

                <div class="aside-banner">
                    <img src="{{ url('custom-images/coupon-offer/' . $couponDetail['cf_banner_thumbnail']) }}">
                </div>

                <div style="margin-top:10px;display:flex;justify-content:space-between;align-items:center">
                    <div style="color:var(--muted);font-size:13px">Sort Priority</div>
                    <div style="font-weight:700">{{ $couponDetail['cf_sort_priority'] }}</div>
                </div>

                <div style="margin-top:6px;display:flex;justify-content:space-between;align-items:center">
                    <div style="color:var(--muted);font-size:13px">Admin Notes</div>
                    <div style="font-weight:700">{{ $couponDetail['cf_admin_note'] }}</div>
                </div>
            </div>

            <div style="height:12px"></div>

            <!-- small report link -->
            {{-- <div style="padding:12px;background:transparent;border-radius:10px;font-size:14px;color:var(--accent);font-weight:600">
⚠️ Report this Listing</div> --}}
        </aside>
    </div>

</div>
