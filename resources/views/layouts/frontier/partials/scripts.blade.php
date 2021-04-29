<script type='text/javascript' src='front/js/jquery/jquery.js?ver=1.12.4-wp' id='jquery-core-js'></script>
<script type='text/javascript' src=front/plugins/pagelayer/js/givejs.php?give=pagelayer-frontend.js%2Cnivo-lightbox.min.js%2Cwow.min.js%2Cjquery-numerator.js%2CsimpleParallax.min.js%2Cowl.carousel.min.js&#038;ver=1.2.2' id='pagelayer-frontend-js'></script>
<script type='text/javascript' src='front/js/jquery.nivo.slider.js' id='spangle-pro-nivo-slider-js'></script>
<script type='text/javascript' src='front/js/custom.js' id='spangle-pro-customscripts-js'></script>
<script type='text/javascript' src='front/testimonialsrotator/js/jquery.quovolver.min.js' id='spangle-pro-testimonialsminjs-js'></script>
<script type='text/javascript' src='front/testimonialsrotator/js/owl.carousel.js' id='spangle-pro-owljs-js'></script>
<script type='text/javascript' src='front/counter/js/jquery.counterup.min.js' id='spangle-pro-counterup-js'></script>
<script type='text/javascript' src='front/counter/js/waypoints.min.js' id='spangle-pro-waypoints-js'></script>
<script type='text/javascript' src='front/mixitup/jquery_013.js' id='spangle-pro-jquery_013-script-js'></script>
<script type='text/javascript' src='front/mixitup/jquery_003.js' id='spangle-pro-jquery_003-script-js'></script>
<script type='text/javascript' src='front/mixitup/screen.js' id='spangle-pro-screen-script-js'></script>
<script type='text/javascript' src='front/mixitup/jquery.prettyPhoto5152.js' id='spangle-pro-prettyphoto-script-js'></script>
<script type='text/javascript' src='front/js/jquery.flexisel.js' id='spangle-pro-flexisel-js'></script>
<script type='text/javascript' src='front/js/custom-animation.js' id='spangle-pro-custom-animation-js'></script>

@yield('script')

<script>
    jQuery(window).bind('scroll', function() {
        var wwd = jQuery(window).width();
        if( wwd > 939 ){
            var navHeight = jQuery( window ).height() - 575;
                    if (jQuery(window).scrollTop() > navHeight) {
                jQuery(".header").addClass('fixed');
            }else {
                jQuery(".header").removeClass('fixed');
            }
                }
    });

    jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({
            effect:'random', //sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse
            animSpeed: 500,
            pauseTime: 4000,
            directionNav: true,
            controlNav: true,
            pauseOnHover: false,
        });
    });


    jQuery(window).load(function() {
        jQuery('.owl-carousel').owlCarousel({
            loop:true,
            autoplay: true,
            autoplayTimeout: 8000,
            margin:20,
            nav:true,
            dots: false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })

    });


    jQuery(document).ready(function() {

        jQuery('.link').on('click', function(event){
            var $this = jQuery(this);
            if($this.hasClass('clicked')){
            $this.removeAttr('style').removeClass('clicked');
            } else{
            $this.css('background','#7fc242').addClass('clicked');
            }
        });

    });
</script>
