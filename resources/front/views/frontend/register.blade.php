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
    <div id="titlebar" class="gradient margin-bottom-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Sign up for New User</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Sign up for New User</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-7">
                <br><br>
                <section id="contact" class="margin-bottom-70">
                    @if (session('message'))
                        <div class="alert alert-warning">
                                <h4> <span style="color:red">{{ session('message') }}</h4>
                        </div>
                    @endif

                    @if ($errors->any())
                        <ul class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <h4><i class="sl sl-icon-user"></i> Registeration Detail</h4>
                    <form method="POST" action="register">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input name="user_name" type="text" placeholder="Enter Your Full Name" />
                            </div>
                            <div class="col-md-12">
                                <input name="user_contact_no" type="text" placeholder="Enter Contact Number" />
                            </div>
                            <div class="col-md-12">
                                <input name="user_email" type="email" placeholder="Enter Email Address" />
                            </div>
                            <div class="col-md-12">
                                <input name="user_password" type="password" placeholder="Enter New Password" />
                            </div>
                            <div class="col-md-4">
                                <input name="user_country" type="text" placeholder="Enter Country Name" />
                            </div>
                            <div class="col-md-4">
                                <input name="user_city" type="text" placeholder="Enter City Name" />
                            </div>
                            <div class="col-md-4">
                                <input name="user_pincode" type="text" placeholder="Enter Pin Code" />
                            </div>
                            <div class="col-md-12">
                                <textarea name="user_address" cols="40" rows="2" placeholder="Enter Address"></textarea>
                            </div>
                        </div>
                        <input type="submit" class="submit button" id="submit" value="Submit" />
                    </form>
                </section>
            </div>

            <div class="col-md-3">
            </div>
        </div>
    </div>
@endsection
