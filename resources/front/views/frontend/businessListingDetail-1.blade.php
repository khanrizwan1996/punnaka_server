@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Mall info | Malls in India | Free Business Listing Directory</title>
<meta name="description" content="Free Local Business Listing Directory Site in India. Check out information of Top Malls in India. Offers Services of Digital Marketing, Web & Mobile Development, E-Commerce solutions" />
<meta name="keywords" content="shopping malls in pune, shopping malls in mumbai, shopping malls in navi mumbai, shopping malls in thane, shopping malls in hyderabad, shopping malls in delhi, shopping malls in noida, shopping malls in ghaziabad, shopping malls in bengaluru, shopping malls in chennai, malls offer, malls market, mallsmarket, malls gurgaon,malls in mumbai,malls india,malls hyderabad,mumbai mall,mall in chennai,gurgaon mall,shopping mall chennai,chennai mall,malls pune,pune mall,india's biggest mall,malls in bangalore,hyerabad shopping mall,best mall of delhi,shopping mall delhi,biggest mall in india,mumbai shopping mall,india biggest mall,new delhi mall,shopping new delhi malls,shopping mall bangalore,the biggest shopping mall india,shopping malls in pune,best mall in mumbai,largest malls of india,shopping malls in india,india shopping mall,malls in hyderabad india,shopping bangalore,shopping mall india,new delhi shopping mall,popular malls in delhi,best shopping mall in delhi,malls in east delhi,top mall in delhi,pune shopping malls,best mall bangalore,mall near me,shopping mall near me,nearby mall,nearest mall,pune best mall,biggest mall in pune,pune mall list,malls of pune,punnaka, punaka." />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="Punnaka">
@section('main-container')
  <div id="titlebar" class="gradient">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Business List</h2>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{url('/')}}">Home</a></li>
              <li>Business List</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
       {{--  <div class="listing_filter_block">
          <div class="col-md-10 col-xs-10">
            <div class="sort-by utf_panel_dropdown sort_by_margin float-right"> <a href="#">Destination</a>
              <div class="utf_panel_dropdown-content">
                <input class="distance-radius" type="range" min="1" max="999" step="1" value="1" data-title="Select Range">
                <div class="panel-buttons">
                  <button class="panel-apply">Apply</button>
                </div>
              </div>
            </div>
            <div class="sort-by">
              <div class="utf_sort_by_select_item sort_by_margin">
                <select data-placeholder="Sort by Listing" class="utf_chosen_select_single">
                  <option>Sort by Listing</option>
				  <option>Latest Listings</option>
				  <option>Popular Listings</option>
				  <option>Price (Low to High)</option>
				  <option>Price (High to Low)</option>
				  <option>Highest Reviewe</option>
				  <option>Lowest Reviewe</option>
                  <option>Newest Listing</option>
                  <option>Oldest Listing</option>
				  <option>Random Listings</option>
                </select>
              </div>
            </div>
            <div class="sort-by">
              <div class="utf_sort_by_select_item sort_by_margin">
                <select data-placeholder="Categories:" class="utf_chosen_select_single">
				  <option>Categories</option>
				  <option>Restaurant</option>
                  <option>Health</option>
                  <option>Hotels</option>
                  <option>Real Estate</option>
				  <option>Fitness</option>
                  <option>Shopping</option>
				  <option>Travel</option>
				  <option>Shops</option>
				  <option>Nightlife</option>
				  <option>Events</option>
                </select>
              </div>
            </div>
            <div class="sort-by">
              <div class="utf_sort_by_select_item utf_search_map_section">
                <ul>
                  <li><a class="utf_common_button" href="#"><i class="fa fa-dot-circle-o"></i>Near Me</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div> --}}
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout"> <a href="{{url('business-detail')}}" class="utf_listing_item">
              <div class="utf_listing_item-image">
				  <img src="{{url('frontend/images/utf_listing_item-01.jpg')}}" alt="">
				 {{--  <span class="like-icon"></span>
				  <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
				  <div class="utf_listing_prige_block utf_half_list">
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				  </div> --}}
			  </div>
			  {{-- <span class="utf_open_now">Open Now</span> --}}
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3>Chontaduro Barcelona</h3>
                  <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
				  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
                  {{-- <div class="utf_star_rating_section" data-rating="4.5">
                    <div class="utf_counter_star_rating">(4.5)</div>
                  </div> --}}
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                </div>
              </div>
              </a>
			</div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout"> <a href="{{url('business-detail')}}" class="utf_listing_item">
              <div class="utf_listing_item-image">
				<img src="{{url('frontend/images/utf_listing_item-02.jpg')}}" alt="">
				{{-- <span class="like-icon"></span>
				<span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
				<span class="featured_tag">Featured</span> --}}
				{{-- <div class="utf_listing_prige_block utf_half_list">
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $35 - $55</span>
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				</div> --}}
			  </div>
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3>The Lounge</h3>
                  <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
				  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
                {{--   <div class="utf_star_rating_section" data-rating="5.0">
                    <div class="utf_counter_star_rating">(4.5)</div>
                  </div> --}}
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                </div>
              </div>
              </a>
			</div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout"> <a href="{{url('business-detail')}}" class="utf_listing_item">
              <div class="utf_listing_item-image">
				  <img src="{{url('frontend/images/utf_listing_item-03.jpg')}}" alt="">
				 {{--  <span class="like-icon"></span>
				  <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
				  <div class="utf_listing_prige_block utf_half_list">
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				  </div> --}}
			  </div>
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3>Westfield Sydney</h3>
                  <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
				  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
                 {{--  <div class="utf_star_rating_section" data-rating="3.5">
                    <div class="utf_counter_star_rating">(3.5)</div>
                  </div> --}}
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                </div>
              </div>
              </a>
			</div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout"> <a href="{{url('business-detail')}}" class="utf_listing_item">
              <div class="utf_listing_item-image">
				<img src="{{url('frontend/images/utf_listing_item-04.jpg')}}" alt="">
				{{-- <span class="like-icon"></span>
				<span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
				<span class="featured_tag">Featured</span>
				<div class="utf_listing_prige_block utf_half_list">
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				</div> --}}
			  </div>
			 {{--  <span class="utf_closed">Closed</span> --}}
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3>Ruby Beauty Center</h3>
                  <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
				  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
                 {{--  <div class="utf_star_rating_section" data-rating="4.5">
                    <div class="utf_counter_star_rating">(4.5)</div>
                  </div> --}}
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                </div>
              </div>
              </a>
			</div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout"> <a href="{{url('business-detail')}}" class="utf_listing_item">
              <div class="utf_listing_item-image">
				<img src="{{url('frontend/images/utf_listing_item-05.jpg')}}" alt="">
				{{-- <span class="like-icon"></span>
				<span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
				<div class="utf_listing_prige_block utf_half_list">
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				</div> --}}
			  </div>
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3>UK Fitness Club</h3>
                  <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
				  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
                  {{-- <div class="utf_star_rating_section" data-rating="4.5">
                    <div class="utf_counter_star_rating">(4.5)</div>
                  </div> --}}
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                </div>
              </div>
              </a>
			</div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout"> <a href="{{url('business-detail')}}" class="utf_listing_item">
              <div class="utf_listing_item-image">
				<img src="{{url('frontend/images/utf_listing_item-06.jpg')}}" alt="">
				{{-- <span class="like-icon"></span>
				<span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
				<div class="utf_listing_prige_block utf_half_list">
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				</div> --}}
			  </div>
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3>Fairmont Pacific Rim</h3>
                  <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
				  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
                 {{--  <div class="utf_star_rating_section" data-rating="4.5">
                    <div class="utf_counter_star_rating">(4.5)</div>
                  </div> --}}
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                </div>
              </div>
              </a>
			</div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12">
            <div class="utf_pagination_container_part margin-top-20 margin-bottom-70">
              <nav class="pagination">
                <ul>
                  <li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
                  <li><a href="#" class="current-page">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4">
        <div class="sidebar">
         {{--  <div class="utf_box_widget margin-bottom-35">
            <h3><i class="sl sl-icon-direction"></i> Filters</h3>
            <div class="row with-forms">
              <div class="col-md-12">
                <input type="text" placeholder="What are you looking for?" value=""/>
              </div>
            </div>
            <div class="row with-forms">
              <div class="col-md-12">
                <div class="input-with-icon location">
                  <input type="text" placeholder="Search Location..." value=""/>
                  <a href="#"><i class="sl sl-icon-location"></i></a> </div>
              </div>
            </div>
			<a href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="More Filters Options" data-close-title="More Filters Options"></a>
            <div class="more-search-options relative">
				<div class="checkboxes one-in-row margin-bottom-15">
					<input id="check-a" type="checkbox" name="check">
					<label for="check-a">Real Estate</label>
					<input id="check-b" type="checkbox" name="check">
					<label for="check-b">Friendly Workspace</label>
					<input id="check-c" type="checkbox" name="check">
					<label for="check-c">Instant Book</label>
					<input id="check-d" type="checkbox" name="check">
					<label for="check-d">Wireless Internet</label>
					<input id="check-e" type="checkbox" name="check" >
					<label for="check-e">Free Parking</label>
					<input id="check-f" type="checkbox" name="check" >
					<label for="check-f">Elevator in Building</label>
					<input id="check-g" type="checkbox" name="check">
					<label for="check-g">Restaurant</label>
					<input id="check-h" type="checkbox" name="check">
					<label for="check-h">Dance Floor</label>
				</div>
			</div>
            <button class="button fullwidth_block margin-top-5">Update</button>
          </div> --}}
          <div class="utf_box_widget margin-top-35 margin-bottom-75">
            <h3><i class="sl sl-icon-folder-alt"></i> Categories</h3>
            <ul class="utf_listing_detail_sidebar">
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Travel</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Nightlife</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Fitness</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Real Estate</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Restaurant</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Dance Floor</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="utf_cta_area_item utf_cta_area2_block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="utf_subscribe_block clearfix">
                    <div class="col-md-8 col-sm-7">
                        <div class="section-heading">
                            <h2 class="utf_sec_title_item utf_sec_title_item2">Subscribe to Newsletter!</h2>
                            <p class="utf_sec_meta">
                                Subscribe to get latest updates and information.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <div class="contact-form-action">
                            <form method="post">
                                <span class="la la-envelope-o"></span>
                                <input class="form-control" type="email" placeholder="Enter your email" required="">
                                <button class="utf_theme_btn" type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
	</section>
@endsection
