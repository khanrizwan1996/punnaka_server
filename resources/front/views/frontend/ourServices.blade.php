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
                        <h2>Our Services</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('home') }}">Home</a></li>
                                <li>Our Services</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="fullwidth_block padding-bottom-75">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="headline_part centered margin-top-80">Our Services<span class="margin-top-10">Discover & connect with great local businesses</span> </h2>
                    </div>
                </div>
                <div class="row container_icon">
                    <div class="col-md-8">
                        <div class="row container_icon">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="box_icon_two box_icon_with_line"><img src="{{asset('custom-images/web-desgin.png')}}" alt="" srcset=""></i>
                                    <h3>Web Design</h3>
                                    <p style="text-align: left">We design attractive websites using the latest UI/UX design patterns. We design websites using Html5, Angular2, Angular6, ReactJs.</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="box_icon_two box_icon_with_line"><img src="{{asset('custom-images/Digital-Marketing.png')}}" alt="" srcset=""></i>
                                    <h3>Digital Marketing</h3>
                                    <p style="text-align: left">Our Marketing team creates the best marketing strategy that gives you the best ROI and the best per click conversion</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="box_icon_two"><img src="{{asset('custom-images/Web-Application.png')}}" alt="" srcset="">
                                <h3>Web Application</h3>
                                    <p style="text-align: left">We also develop web-based applications for the desired clients. Our web applications come with a mobile app to give an advantage to the business.</p>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="box_icon_two"><img src="{{asset('custom-images/Mobile-Development.png')}}" alt="" srcset=""></i>
                                    <h3>Mobile Development</h3>
                                    <p style="text-align: left">Our Expert Mobile Development team with its vast experience gives the mobile application solution for your business.</p>
                                </div>
                            </div>

                            {{-- <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="box_icon_two"> <i class="im im-icon-Administrator"></i>
                                    <h3>Make a Reservation</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque
                                        Nulla finibus.</p>
                                </div>
                            </div> --}}

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="box_icon_two"><img src="{{asset('custom-images/E-Commerce.png')}}" alt="" srcset="">
                                    <h3>E-Commerce</h3>
                                    <p style="text-align: left">We provide e-commerce solutions to our clients that are best suited for them. We make use of open source frameworks as Magento, Open cart, Woo-commerce, Shopify.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <section id="contact" class="margin-bottom-70">
                            <h4><i class="sl sl-icon-phone"></i> Contact Form</h4>
                            <form action="{{url('/ourServiceStore/')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Name <span style="color: red">*</span></label>
                                        <input name="se_user_name" type="text" placeholder="Enter Your Name" required />
                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Contact No <span style="color: red">*</span></label>
                                        <input name="se_user_contact_no" type="text" placeholder="Enter Your Contact No" required />
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="">Email Address <span style="color: red">*</span></label>
                                        <input name="se_user_email" type="email" placeholder="Enter Your Email" required />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Select Services <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="se_services[]" value="Web Design" style="height: 13px; width:30px">Web Design
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="se_services[]" value="Web Development" style="height: 13px; width:30px">Web Development
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="se_services[]" value="Web Application" style="height: 13px; width:30px">Web Application
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="se_services[]" value="Mobile Development" style="height: 13px; width:30px">Mobile Development
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="se_services[]" value="Digital Marketing" style="height: 13px; width:30px">Digital Marketing
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="se_services[]" value="E-commerce" style="height: 13px; width:30px">E-commerce
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="se_services[]" value="Content Writing" style="height: 13px; width:30px">Content Writing
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="se_message" cols="40" rows="2" id="comments" placeholder="Your Message" required></textarea>
                                    </div>

                                </div>

                                
                                <input type="submit" class="submit button" id="submit" value="Submit" />
                            </form>
                        </section>
                    </div>
                </div> 
            </div>
        </section>
    @endsection
