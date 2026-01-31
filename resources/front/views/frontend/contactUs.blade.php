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
        <!-- Content -->
        @php
            $websiteContentControllerContactUsObj = new App\Http\Controllers\frontend\websiteContentController();
            $websiteContentControllerContactUsRow = $websiteContentControllerContactUsObj->websiteContentDetails();
        @endphp

        <div id="titlebar" class="gradient margin-bottom-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Contact Us</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('home') }}">Home</a></li>
                                <li>Contact Us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <br><br>
                    <section id="contact" class="margin-bottom-70">
                        <h4><i class="sl sl-icon-phone"></i> Contact Form</h4>
                        <form id="contactform">
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="name" type="text" placeholder="First Name" required />
                                </div>
                                <div class="col-md-6">
                                    <input name="name" type="text" placeholder="Last Name" required />
                                </div>
                                <div class="col-md-6">
                                    <input name="email" type="email" placeholder="Email" required />
                                </div>
                                <div class="col-md-6">
                                    <input name="subject" type="text" placeholder="Subject" required />
                                </div>
                                <div class="col-md-12">
                                    <textarea name="comments" cols="40" rows="2" id="comments" placeholder="Your Message" required></textarea>
                                </div>
                            </div>
                            <input type="submit" class="submit button" id="submit" value="Submit" />
                        </form>
                    </section>
                </div>

                <div class="col-md-4">
                    <br><br>
                    <div class="utf_box_widget margin-bottom-70">
                        <h3><i class="sl sl-icon-map"></i> Office Address</h3>
                        <div class="utf_sidebar_textbox">
                            <ul class="utf_contact_detail">
                                <li><strong>Phone:-</strong> <span><a
                                            href="tel:{{ $websiteContentControllerContactUsRow['wc_contact_no'] }}">{{ $websiteContentControllerContactUsRow['wc_contact_no'] }}
                                        </a></span></li>
                                <li><strong>Web:-</strong> <span><a href="www.punnaka.com">www.punnaka.com</a></span></li>
                                <li><strong>E-Mail:-</strong> <span><a
                                            href="mailto:{{ $websiteContentControllerContactUsRow['wc_email_address'] }}">{{ $websiteContentControllerContactUsRow['wc_email_address'] }}</a></span>
                                </li>
                                <li><strong>Address:-</strong>
                                    <span>{{ $websiteContentControllerContactUsRow['wc_address'] }}</span></li>
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
                                        <input class="form-control" type="email" placeholder="Enter your email"
                                            required="">
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
