@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Mall info | Malls in India | Free Business Listing Directory</title>
<meta name="description"
    content="Free Local Business Listing Directory Site in India. Check out information of Top Malls in India. Offers Services of Digital Marketing, Web & Mobile Development, E-Commerce solutions" />
<meta name="keywords" content="shopping malls in pune, shopping malls in mumbai, shopping malls in navi mumbai, shopping malls in thane, shopping malls in hyderabad, shopping malls in delhi, shopping malls in noida, shopping malls in ghaziabad, shopping malls in bengaluru, shopping malls in chennai, malls offer, malls market, mallsmarket, malls gurgaon,malls in mumbai,malls india,malls hyderabad,mumbai mall,mall in chennai,gurgaon mall,shopping mall chennai,chennai mall,malls pune,pune mall,india's biggest mall,malls in bangalore,hyerabad shopping mall,best mall of delhi,shopping mall delhi,biggest mall in india,mumbai shopping mall,india biggest mall,new delhi mall,shopping new delhi malls,shopping mall bangalore,the biggest shopping mall india,shopping malls in pune,best mall in mumbai,largest malls of india,shopping malls in india,india shopping mall,malls in hyderabad india,shopping bangalore,shopping mall india,new delhi shopping mall,popular malls in delhi,best shopping mall in delhi,malls in east delhi,top mall in delhi,pune shopping malls,best mall bangalore,mall near me,shopping mall near me,nearby mall,nearest mall,pune best mall,biggest mall in pune,pune mall list,malls of pune,punnaka, punaka." />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="Punnaka">
@section('main-container')
  <div id="titlebar" class="gradient margin-bottom-0">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2>Product & Service</h2>
                  <nav id="breadcrumbs">
                      <ul>
                          <li><a href="{{ url('home') }}">Home</a></li>
                          <li>Product & Service</li>
                      </ul>
                  </nav>
              </div>
          </div>
      </div>
  </div>

  <div class="container" id="scrollTopId">
      {{-- <div class="row">
          <div class="col-md-12">
              <h3 class="headline_part centered margin-top-75"> Describe Blogs <span>Find out shopping places in india</span></h3>
          </div>
      </div> --}}
      <div class="row margin-bottom-60">
        <br>
          @foreach ($productAndServiceData as $productAndServiceRow)
              @php
                  $newPSTitle = strtolower(str_replace(' ', '-', $productAndServiceRow['ps_title']));
              @endphp
              <div class="col-md-4 col-sm-6 col-xs-12 paginDiv">
                  <a href="{{ url('product-service/' . $newPSTitle) }}" class="img-box" data-background-image="{{ url('custom-images/product-service/'. $productAndServiceRow['ps_image'] . '') }}">
                      <div class="utf_img_content_box visible">
                          <h4> {{ Str::substr($productAndServiceRow['ps_title'], 0, 27) }} </h4>
                          <span style="background: #3fb4e4">View Details</span>
                      </div>
                  </a>
              </div>
          @endforeach

          <div class="col-xl-12 col-md-12 col-12" align="center">
              <div class="product-pagination mb-2">
                  <div class="theme-paggination-block">
                      <div class="row">
                          <div class="col-xl-12 col-md-12 col-sm-12">
                              <nav aria-label="Page navigation">
                                  <div class="pagination">
                                      <ul id="pagin1">
                                      </ul>
                                  </div>
                          </div>
                          <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="product-search-count-bottom">
                                  <h5>Showing Product & Service Result {{ count($productAndServiceData) }} Result</h5>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script src="{{ asset('frontend/scripts/jquery-3.4.1.min.js') }}"></script>
  <script type="text/javascript">
      pageSize = 20;
      var pageCount = $(".paginDiv").length / pageSize;
      for (var i = 0; i < pageCount; i++) {
          $("#pagin1").append('<li class="page-item"><a  href="#' + (i + 1) +
              '" class="page-link" style="cursor:pointer;">' + (i + 1) + '</a></li> ');
      }
      $("#pagin1 li").first().find("a").addClass("active")
      showPage = function(page) {
          $(".paginDiv").hide();
          $(".paginDiv").each(function(n) {
              if (n >= pageSize * (page - 1) && n < pageSize * page)
                  $(this).show();
          });
      }
      showPage(1);
      $("#pagin1 li a").click(function() {
          $("#pagin1 li a").removeClass("active");
          $(this).addClass("active");
          showPage(parseInt($(this).text()))

          $('html, body').animate({
              scrollTop: $("#scrollTopId").offset().top
          }, 2000);

      });
  </script>
@endsection
