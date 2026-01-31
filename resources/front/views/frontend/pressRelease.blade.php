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

        .image-wrapper {
            flex-shrink: 0;
            width: 240px;
            height: 160px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .item {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            margin-right: 16px;
            flex-shrink: 0;
            overflow: hidden;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon img {
            width: 32px;
            height: 32px;
        }

        .text {
            flex: 1;
        }

        .title1 {
            font-weight: 600;
            font-size: 17px;
            color: #111;
            margin: 0 0 4px 0;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin: 0;
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
                        <h2>{{ Route::input('country') }} Press Release</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 listing_grid_item">
                    <div class="row">
                        <div class="card">
                            <div class="content">
                                <h2 class="title" style="font-size: 25px">Press Release Publishing on Punnaka.com</h2>
                                <h2 style="font-size: 20px">A Professional Platform for Publishing Official Announcements
                                </h2>
                                <p class="excerpt text-justify">Punnaka.com offers a professional press release publishing platform designed for businesses, startups, organizations, and industry professionals seeking to share official announcements with a global audience.</p>
                                <p class="excerpt text-justify">We invite companies and content creators to publish credible, high-quality press releases that communicate important updates, product launches,
                                    business milestones, and industry developments.</p>
                                <hr />

                                <h2 class="title" style="font-size: 25px">Press Release Submissions on Punnaka.com</h2>

                                <p class="excerpt text-justify">Punnaka.com is now accepting press release submissions from businesses,
                                    brands, startups, and professionals worldwide.</p>
                                <p class="excerpt text-justify">Our platform provides a trusted environment for publishing original and
                                    authoritative press releases across a wide range of categories, including:</p>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Business and
                                corporate announcements<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Product launches
                                and service updates<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Company news and
                                milestones<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Technology and
                                innovation updates<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Industry insights
                                and professional developments<br><br>

                                <p class="excerpt text-justify">All submissions must meet the following requirements:</p>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Original and
                                unpublished content<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Free from
                                plagiarism<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Written in a
                                professional and factual tone<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Fully compliant
                                with Punnaka.com editorial standards<br>
                                <br>
                                <p class="excerpt text-justify">Approved press releases are published on a priority basis and assigned a
                                    live, permanent URL, enabling contributors to expand their digital presence and reach a
                                    broader international audience.</p>
                                <br>

                                <h2 style="font-size: 20px">Restricted Content Notice:</h2>
                                <p class="excerpt text-justify">Press releases related to gambling, casino, CBD, cryptocurrency, adult
                                    content, or other restricted niches are not accepted.</p>
                                <hr />

                                <h2 class="title" style="font-size: 25px">About Punnaka.com</h2>
                                <p class="excerpt text-justify">Punnaka.com is a comprehensive online business and content hub that
                                    connects users with:</p>
                                <br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Global brands and
                                franchises<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Shopping malls,
                                offers, and coupons<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Business listings
                                and insights<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Articles, blogs,
                                and press releases<br>

                                <p class="excerpt text-justify">Our platform is designed to enhance visibility, credibility, and
                                    engagement for businesses and content creators worldwide.</p>
                                <hr />

                                <h2 class="title" style="font-size: 25px">How to Publish a Press Release on Punnaka.com
                                </h2>
                                <p class="excerpt text-justify">Publishing a press release on Punnaka.com is a straightforward,
                                    email-based process.</p>
                                <br>

                                <h2 class="title" style="font-size: 20px">Submission Method</h2>
                                <p class="excerpt text-justify">Submit your press release in Word file format via email:
                                    <a href="mailto:info@punnaka.com"
                                        class="text-primary"><strong>info@punnaka.com</strong></a>
                                </p>
                                <p class="excerpt text-justify"><b>Publication Process</b></p>
                                <p class="excerpt text-justify">1. Prepare Your Press Release</p>
                                <p class="excerpt text-justify">Draft a clear, accurate, and newsworthy announcement aligned with
                                    professional PR standards.</p>
                                <p class="excerpt text-justify">2. Submit by Email</p>
                                <p class="excerpt text-justify">Email your press release to our editorial team for evaluation.</p>
                                <p class="excerpt text-justify">3. Editorial Review</p>
                                <p class="excerpt text-justify">Submissions are reviewed for quality, originality, and compliance with
                                    editorial guidelines.</p>
                                <p class="excerpt text-justify">4. Publication</p>
                                <p class="excerpt text-justify">Approved press releases are published in the Punnaka Press Release
                                    section.</p>
                                <hr />

                                <h2 class="title" style="font-size: 25px">Punnaka.com – Press Release Platform Features
                                </h2>
                                <p class="excerpt text-justify">Publishing your press release on Punnaka.com includes the following
                                    advantages:</p>
                                <br>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Feature Category</th>
                                            <th scope="col">Punnaka.com Features</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <th scope="row">Publishing & Visibility</th>
                                            <td>Professional press release publication, permanent live URLs (no expiry),
                                                lifetime visibility, fast editorial review, priority publishing, global
                                                reach, homepage and category-level featured press releases, optional
                                                featured placement opportunities, long-term online press release archive
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">SEO & Search Optimization</th>
                                            <td>SEO-optimized press release structure, Google indexing, keyword optimization
                                                fields (headline, meta title, meta keywords, meta description), category and
                                                industry tagging, keyword-friendly headlines, do-follow links, structured
                                                content for better search visibility</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Content & Media Support</th>
                                            <td>Featured images, company logo display, video embedding (planned), PDF and
                                                document attachment support (planned)</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Author & Company Identity</th>
                                            <td>Author attribution (individual and/or company)</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Submission & User Experience</th>
                                            <td>Simple email based Press release submission, revision support, email
                                                notifications for publishing, editorial quality control</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Pricing & Access</th>
                                            <td>affordable pricing for startups and SMEs, lifetime listing options, bulk
                                                submission discounts for agencies</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Trust & Compliance</th>
                                            <td>Editorial moderation to ensure quality and accuracy, manual editorial
                                                review, plagiarism-free content policy, clear publishing guidelines,
                                                restricted niche filtering, content moderation</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr/>

                                <h2 class="title" style="font-size: 25px">Email Submission Requirements</h2>
                                <p class="excerpt text-justify">To ensure efficient processing, please include the following details in your email submission:</p>
                                <br>
                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Email Subject Line<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Press release title<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Press release content attached in <b>Word file format</b><br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Official website URL<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Contact email address<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Industry category and sub-category<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Location (City and Country)<br>
                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Company logo or image (optional attachment)
                                <hr/>

                                <h2 class="title" style="font-size: 25px">Editorial Guidelines</h2>
                                <p class="excerpt text-justify text-primary"><strong>Press Release Editorial Standards</strong></p>
                                <p class="excerpt text-justify">All submitted press releases must adhere to the following editorial guidelines:</p>
                                <br>
                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Content must be original, accurate, and verifiable<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Submissions must be newsworthy and relevant<br>
                                
                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> No misleading, adult, gambling, casino, CBD, or restricted content<br>

                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> Promotional language should remain professional and factual<br>
                                <img style="height: 6px;" src="{{ url('custom-images/dot_black.png') }}"> All submissions are subject to editorial approval<br>
                                <p class="excerpt text-justify">Punnaka.com reserves the right to edit or decline submissions that do not meet these standards.</p>
                                <hr/>
                                
                                <h2 class="title" style="font-size: 25px">Press Release – Frequently Asked Questions (FAQs)</h2>
                                <strong class="text-primary">1. How long does the editorial review process take?</strong>
                                <p class="excerpt text-justify">Editorial review times may vary based on submission volume; however, most press releases are published within 24 to 72 hours after approval.</p>
                                
                                <strong class="text-primary">2. Can links and images be included in a press release?</strong>
                                <p class="excerpt text-justify">Yes. Relevant links and images may be included to support the content of your press release.</p>
                                
                                <strong class="text-primary">3. Will my press release be searchable online?</strong>
                                <p class="excerpt text-justify">Yes. All published press releases are optimized for search engines and remain accessible online.</p>
                                
                                <strong class="text-primary">4. Does Punnaka.com edit submitted press releases?</strong>
                                <p class="excerpt text-justify">Minor edits may be made to improve clarity, formatting, or compliance with editorial standards.</p>

                                <hr/>
                                <h2 class="title" style="font-size: 25px">Submit Your Press Release</h2>
                                <p class="excerpt text-justify">Share your business announcements and official updates with a global audience through <b>Punnaka.com.</b></p>
                                
                                <p><b>📧 Email your press release in word file format to: <a class="text-primary" href="mailto:info@punnaka.com">info@punnaka.com</a> </b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
