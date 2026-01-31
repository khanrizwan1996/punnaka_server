@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Mall info | Malls in India | Free Business Listing Directory</title>
    <meta name="description"
        content="Free Local Business Listing Directory Site in India. Check out information of Top Malls in India. Offers Services of Digital Marketing, Web & Mobile Development, E-Commerce solutions" />
    <meta name="keywords"
        content="shopping malls in pune, shopping malls in mumbai, shopping malls in navi mumbai, shopping malls in thane, shopping malls in hyderabad, shopping malls in delhi, shopping malls in noida, shopping malls in ghaziabad, shopping malls in bengaluru, shopping malls in chennai, malls offer, malls market, mallsmarket, malls gurgaon,malls in mumbai,malls india,malls hyderabad,mumbai mall,mall in chennai,gurgaon mall,shopping mall chennai,chennai mall,malls pune,pune mall,india's biggest mall,malls in bangalore,hyerabad shopping mall,best mall of delhi,shopping mall delhi,biggest mall in india,mumbai shopping mall,india biggest mall,new delhi mall,shopping new delhi malls,shopping mall bangalore,the biggest shopping mall india,shopping malls in pune,best mall in mumbai,largest malls of india,shopping malls in india,india shopping mall,malls in hyderabad india,shopping bangalore,shopping mall india,new delhi shopping mall,popular malls in delhi,best shopping mall in delhi,malls in east delhi,top mall in delhi,pune shopping malls,best mall bangalore,mall near me,shopping mall near me,nearby mall,nearest mall,pune best mall,biggest mall in pune,pune mall list,malls of pune,punnaka, punaka." />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    <style>
        .currency-switch {
            text-align: center;
            margin: 20px 0;
        }

        .currency-switch button {
            padding: 10px 20px;
            margin: 0 5px;
            border: 1px solid #ccc;
            background: #fff;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        .currency-switch button.active {
            background: #00aaff;
            color: #fff;
            border-color: #00aaff;
        }

        .plan-price {
            font-size: 22px;
            font-weight: bold;
            margin: 15px 0;
            color: #333;
        }

        .faq-container {
            max-width: 800px;
            width: 100%;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        details {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 12px;
            padding: 1rem 1.2rem;
            transition: background 0.3s;
        }

        details[open] {
            background: #f0f7ff;
        }

        summary {
            /* font-size: 1.1rem; */
            font-weight: 600;
            cursor: pointer;
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        summary::-webkit-details-marker {
            display: none;
        }

        /* SVG arrow */
        summary svg {
            float: right;
            width: 20px;
            height: 20px;
            stroke: #374151;
            transition: transform 0.3s ease;
        }

        details[open] summary svg {
            transform: rotate(180deg);
        }

        details p {
            margin: .7rem 0 0;
            color: #4b5563;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .title::before {
            content: "◆";
            margin-right: 5px;
        }

        .bullet-list {
            padding-left: 0;
            line-height: 2;
            font-size: 18px;
        }
        .fontSize16{
            font-size: 16px;
        }
        /* .bullet-list li:nth-child(2)::before {
            content: "✓ • ✓ • ✓";
        } */
    </style>
    @section('main-container')
        {{-- @if (!isset(Auth::user()->id))
            <script LANGUAGE='JavaScript'>
                window.alert('Please Login First');
                window.location.href = 'user-admin/login';
            </script>
        @endif --}}
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Business List</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Promote Your Business on Punnaka.com</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <section class="fullwidth_block margin-top-0 padding-top-0 padding-bottom-50" data-background-color="#fff">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="headline_part centered margin-bottom-20">Promote Your Business on Punnaka.com <span>Choose the Right Listing to Reach More Customers</span></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="utf_pricing_container_block margin-top-30 margin-bottom-30">
                                <p>Punnaka.com offers multiple listing options to help businesses, franchise owners, and sellers increase their online visibility. List your business, franchise, products, services, and special offers and connect with the right audience across locations.</p>
                                <div class="col-md-5 col-sm-5 col-xs-12">

                                    <div class="title">Start Growing Your Business Today!</div>
                                    <ul class="bullet-list">
                                        <li class="fontSize16">✓ Get Listed • Get Found • Get Customers</li>
                                        <li class="fontSize16">✓ Get higher google ranking in your local area</li>
                                        <li class="fontSize16">✓ Connect with target customers in your local area</li>
                                    </ul>
                                    <br>
                                    {{-- <p style="font-size: 16px; font-weight: bold;"><em><img style="height: 7px;"
                                                src="{{ url('custom-images/dot_black.png') }}"> List your business on
                                            punnaka.com</em></p>

                                    <p style="font-size: 16px; font-weight: bold;"><em><img style="height: 7px;"
                                                src="{{ url('custom-images/dot_black.png') }}"> Get higher google ranking in
                                            your local area</em></p>

                                    <p style="font-size: 16px; font-weight: bold;"><em><img style="height: 7px;"
                                                src="{{ url('custom-images/dot_black.png') }}"> Connect with target
                                            customers in your local area</em></p> --}}

                                    <p style="font-size: 16px; font-weight: bold;"><em>NOTICE:</em></p>
                                    <p>All Business Listings are personally reviewed by punnaka.com team members before they
                                        appear in the business directory.</p>

                                    <span> Select your plan now and let Punnaka promote your business to thousands of
                                        potential customers.</span>
                                    <span> <br>✓ Select Your Plan – Get Listed Today </span>
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <img src="{{ url('custom-images/promote-your-business.png') }}">
                                </div>

                                {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="font-weight:bolder; font-size:14px;text-decoration: underline; color:black">
                                        Steps for
                                        Business Listing on punnaka.com</p>
                                    <p>- Select Business Listing Plan</p>
                                    <p>- Fill up your details</p>
                                    <p>- Pay according to selected plan</p>
                                    <p>- Fill up your Business/Company details.</p>
                                    <p>&nbsp; After filling up Business Listing form, Business Listing will be activated on
                                        priority.</p>
                                    <p>&nbsp; If you face any difficulty while business listing on punnaka.com, then email
                                        us at <a href="mailto:info@punnaka.com"
                                            style="color:#3fb4e4; font-weight:bold">info@punnaka.com</a> or WhatsApp us at
                                        <a href="https://api.whatsapp.com/send?phone=7875155538&text=&source=&data="
                                            target="_blank" style="color:#3fb4e4; font-weight:bold">+91-7875155538</a>
                                    </p>
                                </div> --}}

                                {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h3
                                        style="font-weight: bold; font-size: 18px; text-decoration: underline;color:#3fb4e4;">
                                        <img src="{{ url('custom-images/dot_black.png') }}" style="height: 11px;"> Bulk
                                        Upload
                                    </h3>

                                    <p> If you are not able to fill up business details by website form then please download
                                        below mentioned business listing details from and email us after adding all business
                                        details in the downloaded excel file. <a
                                            href="{{ url('custom-images/Business Lisiting Formate.xlsx') }}"
                                            style="color:#3fb4e4;" download
                                            style="font-weight: bold; text-decoration: underline;"> Download File</a></p>

                                    <p> You also can add multiple business details in the downloaded excel file. </p>

                                    <p> You also can add multiple business location details in the downloaded excel file.
                                    </p>

                                    <p> After filling up business details, email us at <a
                                            style="font-weight: bold;text-decoration: underline; color:#3fb4e4;"
                                            href="mailto:info@punnaka.com">info@punnaka.com</span></a> or whatsapp us at <a
                                            style="font-weight: bold; text-decoration: underline; color:#3fb4e4;"
                                            href="https://api.whatsapp.com/send?phone=7875155538&text=&source=&data="
                                            target="_blank">+91-7875155538</a></p>

                                    <p> Once you email us fillup business details excel file, we will upload it in the
                                        website and show to visitors after payment accordingly to selected plan.</p>
                                </div> --}}

                                {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4><img src="{{ url('custom-images/dot_black.png') }}" alt="" srcset=""
                                            style="height: 11px; margin-bottom: 4px;">
                                        <u style="font-weight: bold; font-size: 18px; underline;color:#3fb4e4;">Business
                                            Listing Option 1</u>
                                    </h4>
                                    <p style="font-size: 15px;">Business listing by emailing business details in below
                                        mentioned business listing form in an Excel file.</p>
                                    <p style="font-size: 15px;">Download the Business Listing Form</p>
                                    <p style="font-size: 15px;">You also can add multiple business location details in the
                                        above downloaded excel file.</p>
                                    <p style="font-size: 15px;">You also can add multiple business details in the above
                                        downloaded excel file.</p>
                                    <p style="font-size: 15px;">You also can do bulk business listing by adding all business
                                        details in the above downloaded excel file.</p>
                                    <p style="font-size: 15px;"> <u> for Business Listing by Email </u></p>
                                    <p style="font-size: 15px;">- Download the Business Listing Form</p>
                                    <p style="font-size: 15px;">- Add Business Listing details in the above-downloaded
                                        Business Listing Form.</p>
                                    <p style="font-size: 15px;">- After adding Business Listing details in the downloaded
                                        business listing form excel file, email us at <a
                                            style="font-weight: bold;text-decoration: underline;"
                                            href="mailto:info@punnaka.com">info@punnaka.com</a> or whatsapp us at <br> <a
                                            style="font-weight: bold; text-decoration: underline;"
                                            href="https://api.whatsapp.com/send?phone=7875155538&text=&source=&data="
                                            target="_blank">+91-7875155538</a></p>
                                    <p style="font-size: 15px;">- Please attach the business logo and business images to the
                                        email.</p>
                                    <p style="font-size: 15px;">- Please mention business timings Monday to Sunday in the
                                        email body.</p>
                                    <p style="font-size: 15px;">- Then, We will share the payment link with you in an email;
                                        we will live your business listing on our website after payment according to the
                                        selected plan.</p>
                                </div> --}}
                            </div>

                            <div class="currency-switch">
                                <button id="usdBtn" class="active">$ USD</button>
                                <button id="inrBtn">₹ INR</button>
                            </div>
                            <div class="utf_pricing_container_block margin-top-30 margin-bottom-30">

                                <div class="plan-card plan featured col-md-4 col-sm-6 col-xs-12">
                                    <div class="utf_price_plan">
                                        <h3>Franchisee Listing</h3>
                                        <div class="plan-price" data-usd="2" data-inr="160">$2 /3 years</div>
                                        {{-- <span class="value">${{ env('FRANCISEE_LISTING_PLAN_PRICE') }}</span> --}}
                                    </div>
                                    <div class="utf_price_plan_features" style="text-align: left">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Add 1 Franchisee Listing</li>
                                            <li><i class="fa fa-check"></i> Add Franchisee Details, Images, Brochures</li>
                                            <li><i class="fa fa-check"></i> Add Social Media Links</li>
                                            <li><i class="fa fa-check"></i> Add SEO Meta Tags (Title, Keywords,
                                                Description)
                                            </li>
                                            <li><i class="fa fa-check"></i> Login & Edit Anytime</li>
                                            <li><i class="fa fa-check"></i> Basic SEO Optimize Listing</li>
                                            <li><i class="fa fa-check"></i> 1 Do-Follow Backlink</li>
                                            <li><i class="fa fa-check"></i> Highlight on Home Page (7 days)</li>
                                            <li><i class="fa fa-check"></i> Online Verified Badge</li>
                                            <li><i class="fa fa-check"></i> Email Support</li>
                                            <li><i class="fa fa-check"></i> Validity 3 years</li>
                                        </ul>
                                    </div>
                                    @if (!isset(Auth::user()->id))
                                        <a class="button border" href="{{ url('user-admin/login') }}"> Buy Now </a>
                                    @else
                                        <form action="choose-plan/FL" method="POST">
                                            @csrf
                                            <input type="hidden" name="currency" class="currency-input" value="USD">
                                            <input type="hidden" name="amount" class="amount-input" value="2">
                                            <input type="hidden" name="plan_type" value="FL">
                                            <button type="submit" class="button border">Buy Now</button>
                                        </form>
                                    @endif
                                </div>

                                <div class="plan-card plan featured col-md-4 col-sm-6 col-xs-12">
                                    <div class="utf_price_plan">
                                        <h3>Business Listing </h3>
                                        <div class="plan-price" data-usd="2" data-inr="160">$2 /3 years</div>
                                        {{-- <span class="value">${{ env('BUSINESS_LISTING_PLAN_PRICE') }}</span> --}}
                                    </div>
                                    <div class="utf_price_plan_features" style="text-align: left">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Add 1 Business Listing</li>
                                            <li><i class="fa fa-check"></i> Add Business Details & Images</li>
                                            <li><i class="fa fa-check"></i> Add Social Media Links</li>
                                            <li><i class="fa fa-check"></i> Add SEO Meta Tags (Title, Keywords,
                                                Description)</li>
                                            <li><i class="fa fa-check"></i> Login & Edit Anytime</li>
                                            <li><i class="fa fa-check"></i> Basic SEO Optimize Listing</li>
                                            <li><i class="fa fa-check"></i> 1 Do-Follow Backlink</li>
                                            <li><i class="fa fa-check"></i> Highlight on Home Page (7 days)</li>
                                            <li><i class="fa fa-check"></i> Online Verified Badge</li>
                                            <li><i class="fa fa-check"></i> Email Support</li>
                                            <li><i class="fa fa-check"></i> Validity 3 years</li>
                                        </ul>
                                    </div>
                                    @if (!isset(Auth::user()->id))
                                        <a class="button border" href="{{ url('user-admin/login') }}"> Buy Now </a>
                                    @else
                                        <form action="choose-plan/BL" method="POST">
                                            @csrf
                                            <input type="hidden" name="currency" class="currency-input" value="USD">
                                            <input type="hidden" name="amount" class="amount-input" value="2">
                                            <input type="hidden" name="plan_type" value="BL">
                                            <button type="submit" class="button border">Buy Now</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="plan-card plan featured col-md-4 col-sm-6 col-xs-12">
                                    <div class="utf_price_plan">
                                        <h3>Products & Services Listing</h3>
                                        <div class="plan-price" data-usd="2" data-inr="160">$2 /3 years</div>
                                        {{-- <span class="value">${{ env('PRODUCT_SERVICE_LISTING_PLAN_PRICE') }}</span> --}}
                                    </div>
                                    <div class="utf_price_plan_features" style="text-align: left">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Add Products & Services (up to 50) </li>
                                            <li><i class="fa fa-check"></i> Add Product Details, Images</li>
                                            <li><i class="fa fa-check"></i> Add Social Media Links</li>
                                            <li><i class="fa fa-check"></i> Add SEO Meta Tags (Title, Keywords,
                                                Description)</li>
                                            <li><i class="fa fa-check"></i> Login & Edit Anytime</li>
                                            <li><i class="fa fa-check"></i> Basic SEO Optimize Listing</li>
                                            <li><i class="fa fa-check"></i> 1 Do-Follow Backlink</li>
                                            <li><i class="fa fa-check"></i> Highlight on Home Page (7 days)</li>
                                            <li><i class="fa fa-check"></i> Online Verified Badge</li>
                                            <li><i class="fa fa-check"></i> Email Support</li>
                                            <li><i class="fa fa-check"></i> Validity 3 Years</li>
                                        </ul>
                                    </div>
                                    @if (!isset(Auth::user()->id))
                                        <a class="button border" href="{{ url('user-admin/login') }}"> Buy Now </a>
                                    @else
                                        <form action="choose-plan/PSL" method="POST">
                                            @csrf
                                            <input type="hidden" name="plan_type" value="PSL">
                                            <input type="hidden" name="currency" class="currency-input" value="USD">
                                            <input type="hidden" name="amount" class="amount-input" value="2">
                                            <button type="submit" class="button border">Buy Now</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="plan-card plan featured col-md-4 col-sm-6 col-xs-12">
                                    <div class="utf_price_plan">
                                        <h3>Offers, Coupons, Freebies Listing </h3>
                                        <div class="plan-price" data-usd="2" data-inr="160">$2 /3 years</div>
                                        {{-- <span class="value">${{ env('COUPON_OFFER_LISTING_PLAN_PRICE') }}</span> --}}
                                        <span class="period">(Add Offers/Deals, Coupons, Promo Codes, Free Samples & Free
                                            Recharges Coupons)</span>
                                    </div>
                                    <div class="utf_price_plan_features" style="text-align: left">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Add Offers, Coupons, Freebies (up to 50) </li>
                                            <li><i class="fa fa-check"></i> Add Offers, Coupons, Freebies Details & Images
                                            </li>
                                            <li><i class="fa fa-check"></i> Add Social Media Links</li>
                                            <li><i class="fa fa-check"></i> Add SEO Meta Tags (Title, Keywords,
                                                Description)</li>
                                            <li><i class="fa fa-check"></i> Login & Edit Anytime</li>
                                            <li><i class="fa fa-check"></i> Basic SEO Optimize Listing</li>
                                            <li><i class="fa fa-check"></i> 1 Do-Follow Backlink</li>
                                            <li><i class="fa fa-check"></i> Highlight on Home Page (7 days)</li>
                                            <li><i class="fa fa-check"></i> Online Verified Badge</li>
                                            <li><i class="fa fa-check"></i> Email Support</li>
                                            <li><i class="fa fa-check"></i> Validity 3 Years</li>
                                        </ul>
                                    </div>
                                    @if (!isset(Auth::user()->id))
                                        <a class="button border" href="{{ url('user-admin/login') }}"> Buy Now </a>
                                    @else
                                        <form action="choose-plan/OCFL" method="POST">
                                            @csrf
                                            <input type="hidden" name="plan_type" value="OCFL">
                                            <input type="hidden" name="currency" class="currency-input" value="USD">
                                            <input type="hidden" name="amount" class="amount-input" value="2">
                                            <button type="submit" class="button border">Buy Now</button>
                                        </form>
                                    @endif
                                </div>



                                {{-- <div class="plan featured col-md-4 col-sm-6 col-xs-12">
                                    <div class="utf_price_plan">
                                        <h3>Basic Listing</h3>
                                        <span class="value">$1</span>
                                        <span class="period">One time service charge <br> Validity - Lifetime</span>
                                    </div>
                                    <div class="utf_price_plan_features" style="text-align: left">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Add Business Details</li>
                                            <li><i class="fa fa-check"></i> Add Business Image</li>
                                            <li><i class="fa fa-check"></i> Add Social Media Links</li>
                                            <li><i class="fa fa-check"></i> Add your own target keywords</li>
                                            <li><i class="fa fa-check"></i> Basic optimize Business Listing</li>
                                            <li><i class="fa fa-check"></i> Enhance Online Presence</li>
                                            <li><i class="fa fa-check"></i> Get 1 Do-Follow Backlink to your website</li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">Listing Activation
                                                    takes 24-48 hours</b></li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">Verified Business
                                                    Listing</b></li>
                                        </ul>
                                    </div>
                                    @if (!isset(Auth::user()->id))
                                        <a class="button border" href="{{ url('user-admin/login') }}"> Buy Now </a>
                                    @else
                                        <form action="choose-plan/Priority" method="POST">
                                            @csrf
                                            <input type="hidden" name="plan_type" value="Priority">
                                            <button type="submit" class="button border">Buy Now</button>
                                        </form>
                                    @endif
                                </div>

                                <div class="plan featured col-md-4 col-sm-6 col-xs-12 active">
                                    <div class="utf_price_plan">
                                        <h3> SEO Optimize Listing</h3>
                                        <span class="value">$2</span> <span class="period">One time service charge <br>
                                            Validity - Lifetime</span>
                                    </div>
                                    <div class="utf_price_plan_features" style="text-align: left">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Add Business Details</li>
                                            <li><i class="fa fa-check"></i> Add Business Image</li>
                                            <li><i class="fa fa-check"></i> Add Social Media Links</li>
                                            <li><i class="fa fa-check"></i> Add your own target keywords</li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">SEO optimize Business
                                                    Listing</b></li>
                                            <li><i class="fa fa-check"></i> Enhance Online Presence</li>
                                            <li><i class="fa fa-check"></i> Get 1 Do-Follow Backlink to your website</li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">Listing Activation
                                                    takes 24-48 hours</b></li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">Verified Business
                                                    Listing</b></li>
                                        </ul>
                                    </div>
                                     @if (!isset(Auth::user()->id))
                                        <a class="button border" href="{{ url('user-admin/login') }}"> Buy Now </a>
                                    @else
                                        <form action="choose-plan/SEO Optimize" method="POST">
                                            @csrf
                                            <input type="hidden" name="plan_type" value="SEO Optimize">
                                            <button type="submit" class="button border">Buy Now</button>
                                        </form>
                                    @endif
                                </div>

                                <div class="plan featured col-md-4 col-sm-6 col-xs-12">
                                    <div class="utf_price_plan">
                                        <h3>Premium Listing</h3>
                                        <span class="value">$5</span> <span class="period">One time service charge <br>
                                            Validity - Lifetime</span>
                                    </div>
                                    <div class="utf_price_plan_features" style="text-align: left">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Add Business Details</li>
                                            <li><i class="fa fa-check"></i> Add Business Image</li>
                                            <li><i class="fa fa-check"></i> Add Social Media Links</li>
                                            <li><i class="fa fa-check"></i> Add your own target keywords</li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">SEO optimize Business
                                                    Listing</b></li>
                                            <li><i class="fa fa-check"></i> Enhance Online Presence</li>
                                            <li><i class="fa fa-check"></i> Get 1 Do-Follow Backlink to your website</li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">Listing Activation
                                                    takes 24-48 hours</b>
                                            </li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">Basic Listing and
                                                    Support</b></li>
                                            <!--<li><i class="fa fa-check"></i> <b>1 blog on business-related target keyword, e.g. 5 Best Cardiologists in Pune, <br>5 Best Aquarium Stores in Los Angeles</b></li>-->
                                            <li><i class="fa fa-check"></i> <b style="color: black">Verified Business
                                                    Listing</b></li>
                                            <li><i class="fa fa-check"></i> <b style="color: black">Highlight Business on
                                                    Top Pages - Validity
                                                    30
                                                    days</b></li>
                                            <!-- <li><i class="fa fa-check"></i> 1 Guest Post (Your Content) <a href="https://www.punnaka.com/write-for-us">T&C</a></li>-->
                                        </ul>
                                    </div>
                                     @if (!isset(Auth::user()->id))
                                        <a class="button border" href="{{ url('user-admin/login') }}"> Buy Now </a>
                                    @else
                                        <form action="choose-plan/Premium" method="POST">
                                            @csrf
                                            <input type="hidden" name="plan_type" value="Premium">
                                            <button type="submit" class="button border">Buy Now</button>
                                        </form>
                                    @endif
                                </div>
                                 --}}
                            </div>

                            {{-- <div class="col-md-12">
                                <h4
                                    style="font-weight: bold; font-size: 18px; underline;color:#3fb4e4; text-decoration:underline">
                                    <img src="{{ url('custom-images/dot_black.png') }}" style="height: 14px;"> Business
                                    Listing Option 2
                                </h4>
                                <p style="font-size: 15px;"><span style="color:red;">*</span> Please add your exact
                                    contact
                                    details
                                    in the below-mentioned form.</p>
                            </div>

                            <div class="col-md-6">

                                <p style="font-size: 14px; text-decoration: underline;">Steps for Business Listing on
                                    punnaka.com
                                    website form:</p>
                                <p style="font-size: 15px;">- Fill up your details in the below-mentioned form.</p>
                                <p style="font-size: 15px;">- Submit & Pay according to the selected plan</p>
                                <p style="font-size: 15px;">- After successful payment, you will show the business listing
                                    form.
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 15px;">- Then Fill up your Business/Company details.</p>
                                <p style="font-size: 15px;">-Please submit after adding business details to the business
                                    listing
                                    form.</p>
                                <p style="font-size: 15px;">- Then, your business listing will activate on priority.</p>
                            </div>
                            <div class="col-md-12">
                                <p style="font-size: 15px;"><span style="color:red">*</span> If your payment fails, please
                                    try
                                    Business Listing Option 1.</p>
                                <p style="font-size: 15px;">If you are unable to complete business listing by business
                                    listing
                                    option 2. Then please try business listing option 1.</p>
                                <p style="font-size: 15px;">If you are still facing any issues or any difficulties while
                                    business
                                    listing on punnaka.com, then email us at
                                    <a style="font-weight: bold;text-decoration: underline;"
                                        href="mailto:info@punnaka.com">info@punnaka.com</a> or whatsapp us at <br>
                                    <a style="font-weight: bold; text-decoration: underline;"
                                        href="https://api.whatsapp.com/send?phone=7875155538&text=&source=&data="
                                        target="_blank">+91-7875155538</a>
                                </p>
                            </div> --}}
                            <br>
                            <div class="col-md-4">
                                <div class="title">Section: How It Works?</div>
                                <ul class="bullet-list">
                                    <li class="fontSize16">✓ Pick the plan that fits your business.</li>
                                    <li class="fontSize16">✓ Complete payment for that plan.</li>
                                    <li class="fontSize16">✓ Fill out your selected listing form</li>
                                    <li class="fontSize16">✓ Our team reviews your submission</li>
                                    <li class="fontSize16">✓ Once approved, your listing goes live on Punnaka.com.</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <div class="title">Why List with Punnaka.com?</div>
                                <ul class="bullet-list">
                                    <li class="fontSize16">✓ Improve your online visibility</li>
                                    <li class="fontSize16">✓ Connect with local and national customers</li>
                                    <li class="fontSize16">✓ Rank higher in Google search results</li>
                                    <li class="fontSize16">✓ Highlight your business information, offers, products & services, and photos and
                                        other</li>
                                        <li class="fontSize16">✓ Build trust with verified listings</li>
                                        <li class="fontSize16">✓ Affordable and quick process</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                <div class="title">Need Help or Bulk Listings?</div>
                                <ul class="bullet-list">
                                    <li class="fontSize16">✓ Have multiple businesses or branches to add?</li>
                                    <li class="fontSize16">✓ Our team will help you upload all details quickly.</li>
                                    <li class="fontSize16">📧 Email: info@punnaka.com</li>
                                    <li class="fontSize16">📱 WhatsApp: +91-7875155538</li>
                                    </ul>
                                </div>
                                </div>

                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="faq-container">
                    <h1>Frequently Asked Questions</h1>
                    <details>
                        <summary>
                            Q1. How long does it take for my listing to go live?
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p> Your listing will be reviewed and activated within 24–72 hours after submission.</p>
                    </details>

                    <details>
                        <summary>
                            Q2. Can I add multiple locations for my business?
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p>Yes, you can add as many locations as you like, however each location costs $2</p>
                    </details>

                    <details>
                        <summary>
                            Q3. Will my business appear on Google search results?
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p>Yes, your business listing on Punnaka.com is designed to help improve your local visibility and
                            Google ranking. Once your listing is published, it becomes publicly accessible and can be
                            indexed by search engines like Google. However, appearance in Google search results depends on
                            Google’s own indexing and ranking guidelines.</p>
                    </details>

                    <details>
                        <summary>
                            Q4. Can I showcase Offers and Coupons with my listing?
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p>Yes, depending on the plan, you can highlight offers/coupons to attract customers.</p>
                    </details>

                    <details>
                        <summary>
                            Q5. Is there a refund policy if I cancel my listing?
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p>Once a listing is live, fees are non-refundable. Please check the plan before purchase.</p>
                    </details>
                </div>
            </div>
        </div>
        <script>
            const usdBtn = document.getElementById("usdBtn");
            const inrBtn = document.getElementById("inrBtn");

            // Select all plan cards
            const planCards = document.querySelectorAll(".plan-card");

            usdBtn.addEventListener("click", () => {
                usdBtn.classList.add("active");
                inrBtn.classList.remove("active");

                planCards.forEach(card => {
                    const price = card.querySelector(".plan-price");
                    const currencyInput = card.querySelector(".currency-input");
                    const amountInput = card.querySelector(".amount-input");

                    price.textContent = `$${price.getAttribute("data-usd")} /3 years`;
                    if (currencyInput) currencyInput.value = "USD";
                    if (amountInput) amountInput.value = price.getAttribute("data-usd");
                });
            });

            inrBtn.addEventListener("click", () => {
                inrBtn.classList.add("active");
                usdBtn.classList.remove("active");

                planCards.forEach(card => {
                    const price = card.querySelector(".plan-price");
                    const currencyInput = card.querySelector(".currency-input");
                    const amountInput = card.querySelector(".amount-input");

                    price.textContent = `₹${price.getAttribute("data-inr")} /3 years`;
                    if (currencyInput) currencyInput.value = "INR";
                    if (amountInput) amountInput.value = price.getAttribute("data-inr");
                });
            });
        </script>
    @endsection
