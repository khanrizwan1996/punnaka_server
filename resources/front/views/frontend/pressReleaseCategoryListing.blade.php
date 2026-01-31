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
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .content {
            flex: 1;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #111827;
            margin: 0 0 12px 0;
            line-height: 1.3;
        }

        .excerpt {
            color: #4b5563;
            font-size: 16px;
            margin: 0;
        }


        @media (max-width: 768px) {
            .card {
                flex-direction: column;
                padding: 20px;
            }

            .image-wrapper {
                width: 100%;
                height: 200px;
            }

            .title {
                font-size: 22px;
            }

            .excerpt {
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .card {
                padding: 16px;
                margin-bottom: 24px;
            }

            .title {
                font-size: 20px;
            }
        }
        .arrow {
            font-size: 24px;
            color: #999;
        }
        </style>
    @section('main-container')
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Press Release Filter</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('submit-press-release') }}">Submit Press Release</a></li>
                                <li>Press Release Filter</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="scrollTopId">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <center>
                        <div class="utf_box_widget" style="border-radius: 25px;width: 270px;">
                            <a href="mailto:info@punnaka.com">
                                <img src="{{ url('custom-images/guess-post.jpeg') }}"style="width:300px">
                            </a>
                        </div>
                    </center>

                    <div class="sidebar">
                        <div class="utf_box_widget margin-top-35 margin-bottom-75">
                            <h3><i class="sl sl-icon-folder-alt"></i> Recent Press Release</h3>
                            <ul class="utf_listing_detail_sidebar">
                               @if(isset($getLatestPressReleaseListing) && $getLatestPressReleaseListing->isNotEmpty())
                            @foreach ($getLatestPressReleaseListing as $getLatestPressReleaseRow)
                                @php
                                    $newPrTitle = str_replace(' ', '-', $getLatestPressReleaseRow->pr_title);
                                @endphp
                                    <li><i class="fa fa-angle-double-right"></i>
                                        <a href="{{ url('press-release/' . $newPrTitle) }}">
                                            {{ $getLatestPressReleaseRow->pr_title }}
                                        </a>
                                    </li>
                                @endforeach
                                 @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 listing_grid_item">
                    <div class="row">

                        @if(isset($getPressReleaseCategoryData) && $getPressReleaseCategoryData->isNotEmpty())
                            @foreach ($getPressReleaseCategoryData as $getPressReleaseCategoryRow)
                                @php
                                    $prTitle = str_replace(' ', '-', $getPressReleaseCategoryRow->pr_title);
                                @endphp

                            <div class="col-lg-6 col-md-6 paginDiv">
                                {{-- <a href="{{ url('press-release/' . $newPrTitle) }}"> --}}
                                   <div class="card">
                                    <div class="content">
                                        <h2 class="title">{{ $getPressReleaseCategoryRow->pr_title1 }}</h2>

                                        <div class="utf_listing_prige_block">
                                                <span class="utf_meta_listing_price" style="background: #3fb4e4; color:white">{{ $getPressReleaseCategoryRow->pr_main_cat }}</span>
                                            </div>

                                        {{-- <p class="excerpt">{{ $getPressReleaseCategoryRow->pr_main_cat }}</p> --}}
                                        <a href="{{ url('press-release/' . $prTitle) }}" class="read-more">Read More
                                        <span class="arrow">→</span>
                                    </a>

                                    </div>
                                    {{-- <div class="image-wrapper">
                                        <img src="{{ url('custom-images/press-release/' . $getPressReleaseCategoryRow->pr_logo) }}">
                                    </div> --}}
                                </div>
                                {{-- </a> --}}
                            </div>
                        @endforeach
                         @endif
                    </div>
                    <div class="clearfix"></div>

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
                                            <h5>Showing Press Release {{ count($getLatestPressReleaseListing) }} Result</h5>
                                        </div>
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
            pageSize = 18;
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
