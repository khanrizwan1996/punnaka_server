 @php
    $websiteContentDetailsFooterRowObj = new App\Http\Controllers\frontend\websiteContentController();
    $websiteContentDetailsFooterRow = $websiteContentDetailsFooterRowObj->websiteContentDetails();
@endphp
<!-- Footer -->
<div id="footer" class="footer_sticky_part">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <h4>About Us</h4>
                <p class="text-justify">{{ $websiteContentDetailsFooterRow->wc_footer_content }}</p>

                <a href="{{ url($websiteContentDetailsFooterRow->wc_fb_link) }}" target="_blank">
                    <img src="https://www.punnaka.com/custom-images/icons/fb.png" style="width: 24px; height: 24px;">&nbsp;
                </a>

                <a href="{{ url($websiteContentDetailsFooterRow->wc_insta_link) }}" target="_blank">
                    <img src="https://www.punnaka.com/custom-images/icons/insta.png" style="width: 25px; height: 25px;">&nbsp;
                </a>

                <a href="https://api.whatsapp.com/send?phone=+91-7875155538&text=&source=&data="target="_blank">
                    <img src="https://www.punnaka.com/custom-images/icons/whatsapp.png" style="width: 25px; height: 25px;">&nbsp;
                </a>

                <a href="{{ url($websiteContentDetailsFooterRow->wc_pinterest_link) }}" target="_blank">
                    <img src="https://www.punnaka.com/custom-images/icons/pinterest.png" style="width: 25px; height: 25px;">&nbsp;
                </a>

                <a href="{{ url($websiteContentDetailsFooterRow->wc_quora_link) }}" target="_blank">
                    <img src="https://www.punnaka.com/custom-images/icons/quora.png" style="width: 25px; height: 25px;">
                </a>
            </div>


            <div class="col-md-offset-1 col-md-3 col-sm-12 col-xs-12">
                <ul class="social_footer_link">
                    <a href="{{ url('/') }}"><li>&emsp; Home</li></a>
                    <a href="{{ url('business-listing') }}"><li>&emsp; Add Business / Business Listing</li></a>
                    <a href="{{ url('business-listing') }}"><li>&emsp; Pricing</li></a>
                    <a href="{{ url('business-listing') }}"><li>&emsp; Add Franchise</li></a>
                    <a href="{{ url('blog-list/USA/malls') }}"><li>&emsp; USA Malls</li></a>
                    <a href="{{ url('blogs') }}"><li>&emsp; Shopping Blogs</li></a>
                </ul>
            </div>


            <div class="col-md-offset-1 col-md-3 col-sm-3 col-xs-6">
                <ul class="social_footer_link">
                    <a href="{{ url('about-us') }}"><li>&emsp; About Us</li></a>
                    <a href="{{ url('our-services') }}"><li>&emsp; Our Services</li></a>
                    <a href="{{ url('privacy-policy') }}"><li>&emsp; Privacy Policy</li></a>
                    <a href="{{ url('term-conditions') }}"><li>&emsp; Terms & Conditions</li></a>
                    <a href="{{ url('submit-press-release') }}"><li>&emsp; Submit Press Release</li></a>
                    <a href="{{ url('contact-us') }}"><li>&emsp; Contact Us</li></a>
                </ul>
            </div>

            {{-- <div class="col-md-3 col-sm-12 col-xs-12">
                <ul class="social_footer_link">
                    <p class="text-justify"><b>Information you can trust</b>: &emsp;&emsp;
                        <a style="color:blue;" target="_blank" href="https://www.reuters.com/markets/">Reuters</a>,
                        the news and media division of Thomson Reuters, is the world’s largest multimedia news provider, reaching billions of people worldwide every day, Sign up for our free daily newsletter:
                        <a style="color:blue;" href="mailto:thomson@reutersmarkets.com">thomson@reutersmarkets.com</span></a>
                    </p>
                </ul>
            </div> --}}
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="footer_copyright_part">Punnaka.Com All Rights Reserved | Designed By Weborbitech | Powered
                    By Social Beast |</div>
            </div>
        </div>
    </div>
</div>
<div id="bottom_backto_top"><a href="#"></a></div>
</div>

<!-- Scripts -->
<script src="{{ asset('frontend/scripts/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/chosen.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/slick.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/rangeslider.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/mmenu.js') }}"></script>
<script src="{{ asset('frontend/scripts/tooltips.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/jquery_custom.js') }}"></script>
<script src="{{ asset('frontend/scripts/bootstrap-select.min.js') }}"></script>

<script>
    var tpj = jQuery;
    var revapi4;
    tpj(document).ready(function() {
        if (tpj("#utf_rev_slider_block").revolution == undefined) {
            revslider_showDoubleJqueryError("#utf_rev_slider_block");
        } else {
            revapi4 = tpj("#utf_rev_slider_block").show().revolution({
                sliderType: "standard",
                jsFileLocation: "scripts/",
                sliderLayout: "auto",
                dottedOverlay: "none",
                delay: 6000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "on",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "zeus",
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 600,
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        tmp: '<div class="tp-title-wrap"></div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 40,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 40,
                            v_offset: 0
                        }
                    },
                    bullets: {
                        enable: false,
                        hide_onmobile: true,
                        hide_under: 600,
                        style: "hermes",
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        direction: "horizontal",
                        h_align: "center",
                        v_align: "bottom",
                        h_offset: 0,
                        v_offset: 30,
                        space: 6,
                        tmp: ''
                    }
                },
                viewPort: {
                    enable: true,
                    outof: "pause",
                    visible_area: "80%"
                },
                responsiveLevels: [1200, 992, 768, 480],
                visibilityLevels: [1200, 992, 768, 480],
                gridwidth: [1180, 1024, 778, 480],
                gridheight: [565, 900, 800, 800],
                lazyType: "none",
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 2200,
                    levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 25, 47, 48, 49, 50, 51, 55],
                    type: "mouse",
                },
                shadow: 0,
                spinner: "off",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    });
</script>

<script src="{{ asset('frontend/scripts/extensions/themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('frontend/scripts/extensions/revolution.extension.video.min.js') }}"></script>
</body>

</html>
