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

        <div id="titlebar" class="gradient margin-bottom-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Write for us</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('home') }}">Home</a></li>
                                <li>Write for us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 66px;">
            <div class="row">
                <br>
                 <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="utf_box_widget margin-bottom-70">
                        <h3 style="color:black;font-weight: bold;"><i class="sl sl-icon-map"></i> ACCEPT GUEST POST / WRITE FOR US</h3>
                        <div class="utf_sidebar_textbox">
                            <p style="text-align:justify;font-size: 16px; line-height: 2;">We are accepting Guest Post on
                                our punnaka.com website for all categories. You can share your content with us at
                                <b style="color: black">info@punnaka.com</b></p>
                            <p style="text-align:justify;font-size: 16px; line-height: 2;">We will publish your content on
                                our punnaka.com website and give the live URL to you on priority. Please make sure, your
                                content is unique and plagiarism free. If you share duplicate content, then we will not
                                publish it on our website.</p>
                                <b style="color: black">Terms & Conditions for Guest Post / write for us :</b>
                            <ul class="utf_contact_detail">
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> Content should be minimum 1000 words.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> Accept only Original, Plagiarism-Free Content.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> Content needs to be proofread.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> The content must be free of grammatical and spelling mistakes.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> The content should not be published anywhere else.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> Links count should not be more than 2 in one Article or Blog, etc.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> We do not accept (Casino, Gambling, Cryptocurrency, CBD Post) etc.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> While sharing content, add a featured Image.</li>
                                {{-- <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> Please add one internal link in the post. It’s necessary to live your blog / article.
                                </li> --}}
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> Please don’t post 18+ content & Images.</li>
                                <li><img style="height: 8px;margin-top: -2px;" src="{{asset('custom-images/dot_black.png')}}"/> If your Post is against our Guidelines, then we have the authority to modify and delete
                                    your post.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <section id="contact" class="margin-bottom-70">
                        <h4><i class="sl sl-icon-phone"></i> Contact Form</h4>
                        <form action="{{url('/writeForUsStore/')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input name="wfu_user_name" type="text" placeholder="Full Name" required />
                                </div>
                                <div class="col-md-12">
                                    <input name="wfu_user_contact_no" type="text" placeholder="Contact Number" required />
                                </div>
                                <div class="col-md-12">
                                    <input name="wfu_user_email" type="email" placeholder="Email" required />
                                </div>
                                <div class="col-md-12">
                                    <textarea name="wfu_message" cols="40" rows="2" id="comments" placeholder="Your Message" required></textarea>
                                </div>
                            </div>
                            <input type="submit" class="submit button" id="submit" value="Submit" />
                        </form>
                    </section>
                </div> --}}


            </div>
        </div>
    @endsection
