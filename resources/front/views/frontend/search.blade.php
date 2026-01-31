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
    @section('main-container')
        <div id="titlebar" class="gradient margin-bottom-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Search</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Search</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 listing_grid_item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ url('search') }}" method="GET">
                                        @csrf
                                        <div class="main_input_search_part">
                                            <div class="col-md-7">
                                                <div class="main_input_search_part_item">
                                                    <input type="text" placeholder="You can search data by name , country and city"
                                                        name="search" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="main_input_search_part_item intro-search-field">
                                                    <select title="Categories" name="search_type" required>
                                                        <option value="">Select Categories </option>
                                                        <option value="Business Listing">Business Listing</option>
                                                        <option value="Malls">Malls</option>
                                                        <option value="Brands">Brands</option>
                                                        {{-- <option value="shopping Blog">Shopping Blog</option> --}}
                                                        <option value="Blogs">Blogs</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="button">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="dashboard_gradient">
                    <div class="row">
                        <div class="col-md-4" style="text-align-last: left;">
                            <nav id="breadcrumbs">
                                <br>
                                <ul style="color: #000; font-weight: bold; font-size: 17px;">
                                    <li><a href="#">Home</a></li>
                                    <li style="color: black;">Searching Result In <span
                                            style="text-decoration:underline; color: blue;">{{ $searchType }}</span></li>
                                </ul>
                            </nav>
                            <br><br>
                        </div>
                    </div>
                </div>

                @if (isset($searchType) && $searchType == 'Business Listing')
                    <div class="row">
                        @php
                            $businessListingControllerObj = new App\Http\Controllers\frontend\businessListingController();
                        @endphp
                        @foreach ($searchBusinessLisitngArray as $searchBusinessLisitngRow)
                            @php
                                $businessImagePath = $businessListingControllerObj->GetBusinessImage($searchBusinessLisitngRow->bus_id);
                                if(isset($businessImagePath) && !empty($businessImagePath)){
                                    $imagePath = 'business-images/images/'.$businessImagePath;
                                }else{
                                    $imagePath = 'No_image_available.png';
                                }
                                $businessCityName = str_replace(' ', '-', $searchBusinessLisitngRow->bus_city);
                                $businessCategoryName = str_replace(' ', '-', $searchBusinessLisitngRow->bus_sub_cat);
                                $businessName = str_replace(' ', '-', $searchBusinessLisitngRow->bus_name);
                            @endphp
                            <div class="col-lg-4 col-md-12">
                                <a href="{{ url('detail/' . $businessCityName . '/' . $businessCategoryName . '/' . $businessName) }}"
                                    class="utf_listing_item-container" data-marker-id="1">
                                    <div class="utf_listing_item"> <img
                                            src="{{ url('custom-images/'.$imagePath) }}"
                                            alt="">
                                        <div class="utf_listing_item_content">

                                            <div class="utf_listing_prige_block">
                                                <span class="utf_meta_listing_price"><i class="fa fa-phone"></i>
                                                    {{ $searchBusinessLisitngRow->bus_contact_no }}</span>
                                            </div>

                                            <h3>{{ $searchBusinessLisitngRow->bus_name }}</h3>
                                            <span><i class="fa fa-envelope"></i> Business Email :
                                                {{ $searchBusinessLisitngRow->bus_email }}</span>
                                                 <span><i class="fa fa-map-marker"></i> Location (Country) :
                                                {{ Str::substr($searchBusinessLisitngRow->bus_country, 0, 10) }}</span>
                                            <span><i class="fa fa-map-marker"></i> Location (State) :
                                                {{ Str::substr($searchBusinessLisitngRow->bus_state, 0, 10) }}</span>
                                            <span><i class="fa fa-phone"></i> Location (City) :
                                                {{ Str::substr($searchBusinessLisitngRow->bus_city, 0, 10) }}</span>

                                        </div>
                                    </div>

                                </a>
                            </div>
                        @endforeach

                        @if (count($searchBusinessLisitngArray) == 0)
                            <div class="col-lg-12 col-md-12" align="center">
                                <img src="{{ url('custom-images/no-data-found.png') }}" alt="">
                            </div>
                        @endif

                    </div>
                @endif


                @if (isset($searchType) && $searchType == 'Malls')
                    <div class="row">
                        @foreach ($searchMallArray as $searchMallRow)
                            @php
                                $mallName = str_replace(' ', '-', $searchMallRow->mall_name);
                                $mallCity = str_replace(' ', '-', $searchMallRow->mall_city);
                            @endphp
                            <div class="col-lg-4 col-md-12">
                                <a href="{{ url('/detail-mall/Malls-in-' . $mallCity . '/' . $mallName) }}"
                                    class="utf_listing_item-container" data-marker-id="1">
                                    <div class="utf_listing_item"> <img
                                            src="{{ url('custom-images/mall/' . $searchMallRow->mall_logo) }}"
                                            alt="">
                                        <div class="utf_listing_item_content">
                                            <h3>{{ $searchMallRow->mall_name }}</h3>
                                            <span><i class="fa fa-building" aria-hidden="true"></i>
                                                {{ $searchMallRow->mall_city }}</span>
                                            <span><i class="fa fa-map-marker"></i>
                                                {{ $searchMallRow->mall_location }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        @if (count($searchMallArray) == 0)
                            <div class="col-lg-12 col-md-12" align="center">
                                <img src="{{ url('custom-images/no-data-found.png') }}" alt="">
                            </div>
                        @endif

                    </div>
                @endif

                @if (isset($searchType) && $searchType == 'Brands')
                    <div class="row">
                        @foreach ($searchBrandsArray as $searchBrandsRow)
                            @php
                                $brandName = str_replace('-', ' ', $searchBrandsRow->brand_name);

                                $singleMallData = App\Http\Controllers\frontend\mallController::singleMallDataById($searchBrandsRow->brand_mall_id);
                                $singleMallName = str_replace(' ', '-', $singleMallData->mall_name);
                                $singleMallCityName = str_replace(' ', '-', $singleMallData->mall_city);
                            @endphp
                            <div class="col-lg-4 col-md-12">
                                <a href="{{ url('/detail-brand/Malls-in-' . $singleMallCityName . '/' . $singleMallName . '/' . $brandName) }}"
                                    class="utf_listing_item-container" data-marker-id="1">
                                    <div class="utf_listing_item"> <img
                                            src="{{ url('custom-images/brand/' . $searchBrandsRow->brand_logo) }}"
                                            alt="">
                                        <div class="utf_listing_item_content">
                                            <h3>{{ $searchBrandsRow->brand_name }}</h3>
                                            <span><i class="fa fa-list" aria-hidden="true"></i>
                                                {{ $singleMallData->mall_name }}</span>
                                            <span><i class="fa fa-building" aria-hidden="true"></i>
                                                {{ $searchBrandsRow->brand_city }}</span>
                                            <span><i class="fa fa-map-marker"></i>
                                                {{ $searchBrandsRow->brand_location }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        @if (count($searchBrandsArray) == 0)
                            <div class="col-lg-12 col-md-12" align="center">
                                <img src="{{ url('custom-images/no-data-found.png') }}" alt="">
                            </div>
                        @endif

                    </div>
                @endif

                {{-- @if (isset($searchType) && $searchType == 'shopping Blog')
                    <div class="row">
                        @foreach ($searchShoppingBlogArray as $searchShoppingBlogRow)
                            @php
                                $newBlogTitle = str_replace(' ', '-', $searchShoppingBlogRow->blog_title);
                            @endphp
                            <div class="col-lg-4 col-md-12">
                                 <a href="{{ url('detail-blog/' . $newBlogTitle) }}">
                                    <div class="utf_listing_item"> 
                                        <img src="{{ url('custom-images/blogs/'. $searchShoppingBlogRow->blog_image.'') }}" alt="">
                                        <div class="utf_img_content_box visible" style="width: 90%;">
                                            <h4> {{ $searchShoppingBlogRow->blog_title }} </h4>
                                            <span style="background: #3fb4e4">View Details</span>
                                        </div>
                                    </div>
                                </a>
                                <br>
                            </div>
                        @endforeach
                        @if (count($searchShoppingBlogArray) == 0)
                            <div class="col-lg-12 col-md-12" align="center">
                                <img src="{{ url('custom-images/no-data-found.png') }}" alt="">
                            </div>
                        @endif

                    </div>
                @endif

                @if (isset($searchType) && $searchType == 'Blogs')
                    <div class="row">
                        @foreach ($searchBlogsArray as $searchBlogsRow)
                            @php
                                $newBlogTitle = str_replace(' ', '-', $searchBlogsRow->blog_cat_title);
                                $newBlogCatSub = str_replace(' ', '-', $searchBlogsRow->blog_cat_subcat);
                            @endphp
                            <div class="col-lg-4 col-md-12">
                                 <a href="{{ url('blog-info/'.$newBlogCatSub.'/'.$newBlogTitle) }}">
                                    <div class="utf_listing_item"> 
                                        <img src="{{ url('custom-images/blog-cat-images/'. $searchBlogsRow->blog_cat_image.'') }}" alt="">
                                        <div class="utf_img_content_box visible" style="width: 90%;">
                                            <h4> {{ $searchBlogsRow->blog_cat_title }} </h4>
                                            <span style="background: #3fb4e4">View Details</span>
                                        </div>
                                    </div>
                                </a>
                                <br>
                            </div>
                        @endforeach
                        @if (count($searchBlogsArray) == 0)
                            <div class="col-lg-12 col-md-12" align="center">
                                <img src="{{ url('custom-images/no-data-found.png') }}" alt="">
                            </div>
                        @endif

                    </div>
                @endif --}}

                @if (isset($searchType) && $searchType == 'Blogs')
                    <div class="row">
                        @foreach ($blogsData as $blogsRow)
                        
                            @php
                            if(isset($blogsRow->source) && !empty($blogsRow->source) && $blogsRow->source == 'blog_category'){
                                $blogTitle = str_replace(' ', '-', $blogsRow->title);
                                $blogCatSub = str_replace(' ', '-', $blogsRow->sub_category);
                                $blogImage = 'custom-images/blog-cat-images/'.$blogsRow->image;
                                $blogURL = 'blog-info/'.$blogCatSub.'/'.$blogTitle;
                            }else if(isset($blogsRow->source) && !empty($blogsRow->source) && $blogsRow->source == 'blog'){
                                $blogTitle = str_replace(' ', '-', $blogsRow->title);
                                $blogImage = 'custom-images/blogs/'.$blogsRow->image;
                                $blogURL = 'detail-blog/'.$blogTitle;
                            }
                            @endphp
                            <div class="col-lg-4 col-md-12">
                                 <a href="{{ url($blogURL) }}">
                                    <div class="utf_listing_item"> 
                                        <img src="{{ url($blogImage) }}" alt="">
                                        <div class="utf_img_content_box visible" style="width: 90%;">
                                            <h4> {{ $blogsRow->title }} </h4>
                                            <span style="background: #3fb4e4">View Details</span>
                                        </div>
                                    </div>
                                </a>
                                <br>
                            </div>
                        @endforeach
                        @if (count($blogsData) == 0)
                            <div class="col-lg-12 col-md-12" align="center">
                                <img src="{{ url('custom-images/no-data-found.png') }}" alt="">
                            </div>
                        @endif

                    </div>
                @endif

            </div>
        </div>
        </div>
    @endsection
