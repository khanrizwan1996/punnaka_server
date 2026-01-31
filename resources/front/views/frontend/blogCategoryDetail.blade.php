@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ $blogCatSingleData['blog_cat_meta_title'] }} | Punnaka</title>
    <meta name="keywords" content="{{ $blogCatSingleData['blog_cat_meta_keyword'] }}" />
    <meta name="description" content="{{ $blogCatSingleData['blog_cat_meta_desc'] }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="Punnaka">
    @section('main-container')
        {{-- <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0">
		<a href="{{asset('custom-images/blog-cat-images/'.$blogCatSingleData['blog_cat_image'].'')}}" data-background-image="{{asset('custom-images/blog-cat-images/'.$blogCatSingleData['blog_cat_image'].'')}}" class="item utf_gallery"></a>
	</div>
  </div> --}}
        @php
            $newBlogCatCountry = str_replace(' ', '-', $blogCatSingleData['blog_cat_country']);
        @endphp
        <div class="clearfix"></div>
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ $blogCatSingleData['blog_cat_title'] }}</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('blog-list/' . $newBlogCatCountry . '/ALL') }}">Blog List</a></li>
                                <li>Blog Category Detail</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row utf_sticky_main_wrapper">
                <div class="col-lg-8 col-md-8">
                    <div id="titlebar" class="utf_listing_titlebar" style="margin-top: -36px;">
                        <div class="utf_listing_titlebar_title">
                            <h2>{{ $blogCatSingleData['blog_cat_title'] }}
                                <br><br>
                                <img src="{{ url('custom-images/blog-cat-images/' . $blogCatSingleData['blog_cat_image'] . '') }}"
                                    style="width:698px; height:435px" alt="">
                                <br><br>
                                <span class="listing-tag">{{ $blogCatSingleData['blog_cat_subcat'] }}</span>
                            </h2>
                            <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-info"></i>
                                    {{ $blogCatSingleData['blog_cat_state'] . ' ' . $blogCatSingleData['blog_cat_city'] }}
                                </a>
                            </span>
                            <span class="call_now"><i class="sl sl-icon-phone"></i>
                                {{ date('j F Y', strtotime($blogCatSingleData['blog_cat_added_time'])) }}</span>
                            <span><a href="#">{{ count($recentBlogCatCommentsData) }} Comments</a></span>
                        </div>
                    </div>
                    <div id="utf_listing_overview" class="utf_listing_section">
                        <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Description</h3>
                        <p>{!! $blogCatSingleData['blog_cat_desc'] !!}</p>

                    </div>


                    <div id="utf_listing_reviews" class="utf_listing_section">
                        <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Comments <span>
                                ({{ count($recentBlogCatCommentsData) }}) </span></h3>
                        <div class="clearfix"></div>

                        <div class="comments utf_listing_reviews">
                            <ul>
                                @foreach ($recentBlogCatCommentsData as $recentBlogCatCommentsRow)
                                    <li>
                                        <div class="avatar">
                                            <img src="{{ url('custom-images/user_avatar.png') }}" alt="" />
                                        </div>
                                        <div class="utf_comment_content">
                                            <div class="utf_arrow_comment"></div>
                                            <div class="utf_by_comment">
                                                {{ $recentBlogCatCommentsRow['name'] }}
                                                <span class="date">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ date('j F Y h:i:s', strtotime($recentBlogCatCommentsRow['blogcat_comment_added_time'])) }}
                                                </span>
                                            </div>
                                            <p>{{ $recentBlogCatCommentsRow['blogcat_comment_desc'] }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    @if (isset(Auth::user()->name))
                        <div id="utf_add_review" class="utf_add_review-box">
                            <h3 class="utf_listing_headline_part margin-bottom-20">Add Your Comment</h3>
                            <span class="utf_leave_rating_title">Your email address will not be published.</span>

                            <form method="POST" action="{{ url('/blogCatCommentStore') }}">
                                <input type="hidden" name="blogcat_comment_user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="blogcat_comment_blog_id"
                                    value="{{ $blogCatSingleData['blog_cat_id'] }}">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Name:</label>
                                            <input type="text" placeholder="Name" name="" disabled
                                                value="{{ Auth::user()->name }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email:</label>
                                            <input type="text" placeholder="Email" disabled
                                                value="{{ Auth::user()->email }}" />
                                        </div>
                                    </div>
                                    <div>
                                        <label>Comment:</label>
                                        <textarea cols="40" name="blogcat_comment_desc" placeholder="Your Message..." required rows="3"></textarea>
                                    </div>
                                </fieldset>
                                <button class="button" type="submit">Submit Review</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    @else
                        <div class="utf_box_widget margin-top-35">
                            <h3><i class="sl sl-icon-login"></i> After login you can comment on this blog</h3>
                            <a class="utf_progress_button button fullwidth_block margin-top-5"
                                href="{{ url('user-admin/login') }}">Please Login</a>
                        </div>
                    @endforelse

                </div>

                <div class="col-lg-4 col-md-4">

                    <div class="sidebar right">

                        <center>
                            <div class="utf_box_widget margin-top-35" style="border-radius: 25px;width: 270px;">
                                <a href="mailto:info@punnaka.com">
                                    <img src="{{ url('custom-images/guess-post.jpeg') }}"style="width:300px">
                                </a>
                            </div>

                            <div class="utf_box_widget margin-top-35" style="border-radius: 25px;width: 270px;">
                                <a href="mailto:info@punnaka.com">
                                    <img src="{{ url('custom-images/franchisee-listing.png') }}" style="width:300px">
                                </a>
                            </div>
                            
                            <div class="utf_box_widget margin-top-35" style="border-radius: 25px;width: 270px;">
                                <a href="mailto:info@punnaka.com">
                                    <img src="{{ url('custom-images/business-listing.png') }}" style="width:300px">
                                </a>
                            </div>
                            <div class="utf_box_widget margin-top-35" style="border-radius: 25px;width: 270px;">
                                <a href="mailto:info@punnaka.com">
                                    <img src="{{ url('custom-images/product-service-listing.png') }}" style="width:300px">
                                </a>
                            </div>
                            <div class="utf_box_widget margin-top-35" style="border-radius: 25px;width: 270px;">
                                <a href="mailto:info@punnaka.com">
                                    <img src="{{ url('custom-images/offers-coupon-listing.png') }}" style="width:300px">
                                </a>
                            </div>
                            
                        </center>
                        
                        {{-- <div class="utf_box_widget">
                            <div class="utf_search_blog_input">
                                <img src="{{asset('custom-images/business-listing-hd-png-download-bg.png')}}" alt="">
                                <center><p>Get a <b>Punnaka.com</b> Page</p>
                                <p>Promote your business to local customers.</p>
                                <div class="input">
                                    <a href="{{url('business-listing')}}" class="submit button">Local Business Listing</a>
                                </div></center>
                            </div>
                            <div class="clearfix"></div>
                        </div> --}}

                        <div class="utf_box_widget margin-top-35">
                            <h3><i class="sl sl-icon-book-open"></i> Recent Blogs</h3>
                            <ul class="utf_widget_tabs">
                                @foreach ($blogCatRecentData as $blogCatRecentRow)
                                    @php
                                        $newRecentBlogCatTitle = str_replace(
                                            ' ',
                                            '-',
                                            $blogCatRecentRow['blog_cat_title'],
                                        );
                                        $newRecentBlogSubCatTitle = str_replace(
                                            ' ',
                                            '-',
                                            $blogCatRecentRow['blog_cat_subcat'],
                                        );
                                        if (
                                            isset($blogCatRecentRow['blog_cat_image']) &&
                                            !empty($blogCatRecentRow['blog_cat_image'])
                                        ) {
                                            $imageURL =
                                                'custom-images/blog-cat-images/' . $blogCatRecentRow['blog_cat_image'];
                                        } else {
                                            $imageURL = 'custom-images/No_image_available.png';
                                        }
                                    @endphp
                                    <li>
                                        <div class="utf_widget_content">
                                            <div class="utf_widget_thum"> <a
                                                    href="{{ url('blog-info/' . $newRecentBlogSubCatTitle . '/' . $newRecentBlogCatTitle) }}"><img
                                                        src="{{ url($imageURL) }}" alt=""></a>
                                            </div>
                                            <div class="utf_widget_text">
                                                <h5><a
                                                        href="{{ url('blog-info/' . $newRecentBlogSubCatTitle . '/' . $newRecentBlogCatTitle) }}">{{ $blogCatRecentRow['blog_cat_title'] }}</a>
                                                </h5>
                                                <span><i class="fa fa-clock-o"></i>
                                                    {{ date('j F Y', strtotime($blogCatRecentRow['blog_cat_added_time'])) }}</span>
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
                                        <label for="">Select Services <span style="color: red">*</span></label>
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

                        {{-- <div class="utf_box_widget margin-top-35">
                            <h3><i class="sl sl-icon-phone"></i> Quick contact to help?</h3>
                            <p>Excepteur sint occaecat non proident, sunt in culpa officia deserunt mollit anim id est
                                laborum.</p>
                            <ul class="utf_social_icon rounded">
                                <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                                <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>
                            </ul>
                            <a class="utf_progress_button button fullwidth_block margin-top-5"
                                href="{{ url('contact-us') }}">Contact Us</a>
                        </div> --}}

                    </div>
                </div>

                <section class="fullwidth_block padding-top-20 padding-bottom-50">
                    <div class="container">
                        <div class="row slick_carousel_slider">
                            <div class="col-md-12">
                                <h3 class="headline_part centered margin-bottom-25">Top Local Business</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="simple_slick_carousel_block utf_dots_nav">
                                        @php
                                            $businessListingControllerObj = new App\Http\Controllers\frontend\businessListingController();
                                        @endphp
                                        @foreach ($recentBusinessListingArray as $recentBusinessListingRow)
                                            @php
                                                $businessName = str_replace(
                                                    ' ',
                                                    '-',
                                                    $recentBusinessListingRow->bus_name,
                                                );
                                                $businessCity = str_replace(
                                                    ' ',
                                                    '-',
                                                    $recentBusinessListingRow->bus_city,
                                                );
                                                $businessSubCat = str_replace(
                                                    ' ',
                                                    '-',
                                                    $recentBusinessListingRow->bus_sub_cat,
                                                );
                                                $singleBusinessImageRow = $businessListingControllerObj->GetBusinessImage(
                                                    $recentBusinessListingRow->bus_id,
                                                );

                                                //$singleBusinessImageRow = App\Http\Controllers\frontend\businessListingController::GetBusinessImage($recentBusinessListingRow->bus_id);

                                                if (isset($singleBusinessImageRow) && !empty($singleBusinessImageRow)) {
                                                    $imagePath = 'business-images/images/' . $singleBusinessImageRow;
                                                } else {
                                                    $imagePath = 'No_image_available.png';
                                                }

                                            @endphp
                                            <div class="utf_carousel_item">
                                                <a href="{{ url('detail/' . $businessCity . '/' . $businessSubCat . '/' . $businessName) }}"
                                                    class="utf_listing_item-container compact">
                                                    <div class="utf_listing_item"> <img
                                                            src="{{ url('custom-images/' . $imagePath) }}" alt="">
                                                        <div class="utf_listing_item_content">
                                                            <h3>{{ $recentBusinessListingRow->bus_name }}</h3>
                                                            <span><i class="fa fa-map-marker"></i>
                                                                {{ Str::substr($recentBusinessListingRow->bus_address1, 0, 15) }}</span>
                                                            <span><i class="fa fa-phone"></i>
                                                                {{ $recentBusinessListingRow->bus_contact_no }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    @endsection
