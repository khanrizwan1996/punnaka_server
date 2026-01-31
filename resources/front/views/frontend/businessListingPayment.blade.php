@extends('frontend.layouts.main')
<!DOCTYPE html>
<html lang="zxx">
   <head>
      <title>Mall info | Malls in India | Free Business Listing Directory</title>
      <meta name="description"
         content="Free Local Business Listing Directory Site in India. Check out information of Top Malls in India. Offers Services of Digital Marketing, Web & Mobile Development, E-Commerce solutions" />
      <meta name="keywords"
         content="shopping malls in pune, shopping malls in mumbai, shopping malls in navi mumbai, shopping malls in thane, shopping malls in hyderabad, shopping malls in delhi, shopping malls in noida, shopping malls in ghaziabad, shopping malls in bengaluru, shopping malls in chennai, malls offer, malls market, mallsmarket, malls gurgaon,malls in mumbai,malls india,malls hyderabad,mumbai mall,mall in chennai,gurgaon mall,shopping mall chennai,chennai mall,malls pune,pune mall,india's biggest mall,malls in bangalore,hyerabad shopping mall,best mall of delhi,shopping mall delhi,biggest mall in india,mumbai shopping mall,india biggest mall,new delhi mall,shopping new delhi malls,shopping mall bangalore,the biggest shopping mall india,shopping malls in pune,best mall in mumbai,largest malls of india,shopping malls in india,india shopping mall,malls in hyderabad india,shopping bangalore,shopping mall india,new delhi shopping mall,popular malls in delhi,best shopping mall in delhi,malls in east delhi,top mall in delhi,pune shopping malls,best mall bangalore,mall near me,shopping mall near me,nearby mall,nearest mall,pune best mall,biggest mall in pune,pune mall list,malls of pune,punnaka, punaka." />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="author" content="Punnaka">
      @section('main-container')
      @if (!isset(Auth::user()->id))
      <script LANGUAGE='JavaScript'>
         window.alert('Please Login First');
         window.location.href = '/user-admin/login';
      </script>
      @endif
      @php
      $planType = session('planType');
      if (isset($planType)) {
         $planCurrency = session('planCurrency');
         $planAmount = session('planAmount');
          if(session('planType') == 'FL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'BL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'PSL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'OCFL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }


        /* if(session('planType') == 'Priority') {
            $planAmount = 1;
            $totalAmount = $planAmount * 100;
         }elseif (session('planType') == 'SEO Optimize') {
            $planAmount = 2;
            $totalAmount = $planAmount * 100;
         }elseif (session('planType') == 'Premium') {
            $planAmount = 5;
            $totalAmount = $planAmount * 100;
         }
        
         if(session('planType') == 'SEO Optimize') {
            $planName = 'SEO Optimize Listing';
         }else{
            $planName = session('planType') . ' Listing';
         }*/


      }else{
      echo '<script LANGUAGE="JavaScript">
         window.alert("Please select plan");
         window.location.href = "/business-listing";
      </script>';
      die();
      }
      @endphp
      <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
      <body  onload="startPayment()">
      <div id="titlebar" class="gradient margin-bottom-0">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2>Business Payment</h2>
                  <nav id="breadcrumbs">
                     <ul>
                        <li><a href="{{ url('home') }}">Home</a></li>
                        <li>Business Payment</li>
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
                  <h2 class="headline_part centered margin-top-80" style="font-size: 21px">Business Listing - Processing Payment...
                  </h2>
               </div>
            </div>
            <div class="row container_icon">
               <form name="razorpayForm" action="{{ route('razorpay.success') }}" method="POST">
                  @csrf
                  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                  <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                  <input type="hidden" name="razorpay_signature" id="razorpay_signature">
               </form>
            </div>
         </div>
      </section>
      <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
       <script>
        function startPayment() {
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": "{{$totalAmount}}",
                "currency": "{{ $planCurrency }}",
                "name": "Punnaka",
                "description": "Test Transaction",
                "order_id": "{{ $orderId }}",
                "handler": function (response){
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.forms['razorpayForm'].submit();
                },
               "modal": {
                "ondismiss": function(){
                    alert("Payment window was closed!");
                    window.location.href = '/';
                }
            },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
      </body>
      @endsection
