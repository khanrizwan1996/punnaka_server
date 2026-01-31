@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

<head>
    {{-- <title>{{ $blogSingleData['blog_meta_title'] }} | Punnaka</title>
    <meta name="keywords" content="{{ $blogSingleData['blog_meta_keword'] }}" />
    <meta name="description" content="{{ $blogSingleData['blog_meta_description'] }}" /> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">

    <style>
     
        .section {
            background: #fff;
            border-radius: 8px;
            margin-bottom: 30px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .section h2 {
            font-size: 1.4rem;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #3fb4e4;
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
        }

        .field-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
        }

        .field {
            flex: 1 1 250px;
            /* background: #fafafa; */
            border-radius: 6px;
            padding: 15px;
            border: 1px solid #ddd;
        }

        .field label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        .field span {
            color: #777;
        }

        @media (max-width: 768px) {
            .field-group {
                flex-direction: column;
            }
        }

        .heading {
      color: var(--dark);
      margin-bottom: 10px;
   
      border-left: 5px solid #3fb4e4;
      padding-left: 10px;
      margin-top: 30px;
    }
    
    </style>

    @section('main-container')
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Blog Detail</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/blogs') }}">Blog List</a></li>
                                <li>Blog Detail</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="blog-page">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div>
                            <img class="utf_post_img" style="height: 550px" src="{{ url('custom-images/product-service/' . $productAndServiceData['ps_image'] . '') }}" alt="">

                            <div class="section">
                                <br>
                                <h2 class="heading">Basic Information</h2>
                                
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Title: </label><span> {{ $productAndServiceData['ps_title']}} </span></div>
                                    <div class="field"><label style="font-weight:bolder">Category: </label><span>{{ $productAndServiceData['ps_main_cat']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Sub Category: </label><span>{{ $productAndServiceData['ps_sub_cat']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Listing Type: </label><span>{{ $productAndServiceData['ps_listing_type']}}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <h2 class="heading">Pricing</h2>
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Pricing Type: </label><span>{{ $productAndServiceData['ps_pricing_type']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Currency: </label><span>{{ $productAndServiceData['ps_currency']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Price / Range: </label><span>{{ $productAndServiceData['ps_price_range']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Discount: </label><span>{{ $productAndServiceData['ps_discount']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Tax: </label><span>{{ $productAndServiceData['ps_tax']}}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <h2 class="heading">Location & Availability</h2>
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Country: </label><span>{{ $productAndServiceData['ps_country']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">State: </label><span>{{ $productAndServiceData['ps_state']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">City: </label><span>{{ $productAndServiceData['ps_city']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Service Area: </label><span>{{ $productAndServiceData['ps_service_area']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Availability for Date: </label><span>{{ $productAndServiceData['ps_availability_date_time']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Additional Options: </label><span>{{ $productAndServiceData['ps_additional_options']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Size: </label><span>{{ $productAndServiceData['ps_size']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Color: </label><span>{{ $productAndServiceData['ps_color']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Return Policy: </label><span>{{ $productAndServiceData['ps_return_policy']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Cancellation Policy: </label><span>{{ $productAndServiceData['ps_cancellation_policy']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Add Ons: </label><span>{{ $productAndServiceData['ps_add_ons']}}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <h2 class="heading">Inventory / Availability (For Product)</h2>
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Stock: </label><span>{{ $productAndServiceData['ps_stock']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">SKU: </label><span>{{ $productAndServiceData['ps_sku']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Shipping Options: </label><span>{{ $productAndServiceData['ps_shipping_option']}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <h2 class="heading">Media Upload</h2>
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Video Link: </label><span>{{ $productAndServiceData['ps_video_url']}}</span>
                                    </div>
                                    <div class="field"><label style="font-weight:bolder">Brochure: </label><span>{{ $productAndServiceData['ps_brochure']}}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <h2 class="heading">Contact Information</h2>
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Contact Name: </label><span>{{ $productAndServiceData['ps_contact_name']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Phone Number: </label><span>{{ $productAndServiceData['ps_contact_number']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">WhatsApp: </label><span>{{ $productAndServiceData['ps_contact_whatsapp']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Email: </label><span>{{ $productAndServiceData['ps_contact_email']}}</span></div>
                                </div>
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Website URL: </label><span>{{ $productAndServiceData['ps_website_url']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Portfolio Link: </label><span>{{ $productAndServiceData['ps_portfolio_url']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Facebook Link: </label><span>{{ $productAndServiceData['ps_facebook_url']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Instagram Link: </label><span>{{ $productAndServiceData['ps_instagram_url']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Twitter Link: </label><span>{{ $productAndServiceData['ps_twitter_url']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Other Link: </label><span>{{ $productAndServiceData['ps_other_url']}}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <h2 class="heading">Visibility & Other Settings</h2>
                                <div class="field-group">
                                    <div class="field"><label style="font-weight:bolder">Visibility: </label><span>{{ $productAndServiceData['ps_visibility']}}</span></div>
                                    <div class="field"><label style="font-weight:bolder">Featured Listing: </label><span>{{ $productAndServiceData['ps_featured_listing']}}</span>
                                    </div>
                                    <div class="field"><label style="font-weight:bolder">Expiry Date: </label><span>{{ $productAndServiceData['ps_expiry_date']}}</span></div>
                                </div>
                                <div class="field-group">
                                    <div class="field" style="flex: 1 1 100%"><label style="font-weight:bolder">Tags / Keywords: </label><span>{{ $productAndServiceData['ps_tags_keywords']}}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <h2 class="heading">Description</h2>
                                <div class="field-group">
                                    <div class="field" style="flex: 1 1 100%"><label style="font-weight:bolder">Short Description: </label><span>{{ $productAndServiceData['ps_short_description ']}}</span></div>
                                </div>
                                <div class="field-group">
                                    <div class="field" style="flex: 1 1 100%"><label style="font-weight:bolder">Detail Description: </label><span>
                                        {!!  $productAndServiceData['ps_detail_description'] !!}</span></div>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="sidebar right">
                            <div class="utf_box_widget">
                                <div class="utf_search_blog_input">
                                    <img src="{{ url('custom-images/business-listing-hd-png-download-bg.png') }}"
                                        alt="">
                                    <center>
                                        <p>Get a <b>Punnaka.com</b> Page</p>
                                        <p>Promote your business to local customers.</p>
                                        <div class="input">
                                            <a href="{{ url('business-listing') }}" class="submit button">Local Business
                                                Listing</a>
                                        </div>
                                    </center>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="utf_box_widget margin-top-35">
                                <h3><i class="sl sl-icon-book-open"></i> Recent Blogs</h3>
                                <ul class="utf_widget_tabs">
                                    @foreach ($recentProductAndServiceData as $recentProductAndServiceRow)
                                        @php $newRecentPSTitle = str_replace(' ', '-', $recentProductAndServiceRow['ps_title']); @endphp
                                        <li>
                                            <div class="utf_widget_content">
                                                <div class="utf_widget_thum"> <a href="#"><img src="{{ url('custom-images/product-service/' . $recentProductAndServiceRow['ps_image'] . '') }}" alt=""></a> </div>
                                                <div class="utf_widget_text">
                                                    <h5><a href="{{ url('product-service-detail/'.$newRecentPSTitle) }}">{{ $recentProductAndServiceRow['ps_title'] }}</a>
                                                    </h5>
                                                    <span><i class="fa fa-clock-o"></i> {{ date('j F Y', strtotime($recentProductAndServiceRow['ps_added_time'])) }}</span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="utf_box_widget opening-hours margin-top-35">
                                <h3><i class="sl sl-icon-envelope-open"></i> Services Form</h3>
                                <form action="{{ url('/ourServiceStore/') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Name <span style="color: red">*</span></label>
                                            <input name="se_user_name" type="text" placeholder="Enter Your Name"
                                                required />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="">Contact No <span style="color: red">*</span></label>
                                            <input name="se_user_contact_no" type="text"
                                                placeholder="Enter Your Contact No" required />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="">Email Address <span style="color: red">*</span></label>
                                            <input name="se_user_email" type="email" placeholder="Enter Your Email"
                                                required />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Select Services <span
                                                    style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="se_services[]" value="Web Design"
                                                style="height: 13px; width:30px">Web Design
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="se_services[]" value="Web Development"
                                                style="height: 13px; width:30px">Web Development
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="se_services[]" value="Web Application"
                                                style="height: 13px; width:30px">Web Application
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="se_services[]" value="Mobile Development"
                                                style="height: 13px; width:30px">Mobile Development
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="se_services[]" value="Digital Marketing"
                                                style="height: 13px; width:30px">Digital Marketing
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="se_services[]" value="E-commerce"
                                                style="height: 13px; width:30px">E-commerce
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="se_services[]" value="Content Writing"
                                                style="height: 13px; width:30px">Content Writing
                                        </div>
                                        <div class="col-md-12">
                                            <textarea name="se_message" cols="40" rows="2" id="comments" placeholder="Your Message" required></textarea>
                                        </div>
                                    </div>
                                    <input type="submit" class="submit button" id="submit" value="Submit" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
