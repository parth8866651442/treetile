<section id="footer">
    <div class="wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="logo">
                    <img src="<?php echo SITEURL; ?>assets/images/logo.svg" alt="treetile" title="treetile" />
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_widgets">
                    <h4>COMPANY</h4>
                    <ul>
                        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                        <li><a href="<?php echo SITEURL; ?>ourstory">Our Story</a></li>
                        <li><a href="<?php echo SITEURL; ?>quality">Certified Quality</a></li>
                        <li><a href="<?php echo SITEURL; ?>product">Collection</a></li>
                        <li><a href="<?php echo SITEURL; ?>worldwide">World Wide</a></li>
                        <li><a href="<?php echo SITEURL; ?>downloads">Downloads</a></li>
                        <li><a href="<?php echo SITEURL; ?>socialism">Socialism</a></li>
                        <li><a href="<?php echo SITEURL; ?>contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_widgets">
                    <h4>CONTACTS</h4>
                    <p class="head">Tree Tile LLP</p>
                    <ul>
                        <li>
                            <a>
                                <?php echo $fc['address']; ?>
                            </a>
                        </li>
                        <li>&nbsp;</li>
                        <?php foreach($mobile as $m) { ?>
                        <li><a href="tel:<?php echo str_replace(' ','',$m); ?>">Phone : <?php echo $m; ?></a></li>
                        <?php } ?>
                        <?php foreach($email as $e) { ?>
                        <li><a href="mailto:<?php echo str_replace(' ','',$e); ?>"> Email : <?php echo $e; ?></a></li>
                            <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_widgets">
                    <h4>FOLLOW US</h4>
                    <ul class="social">
                        <li>
                            <a href="<?php echo $fb; ?>" <?php echo $fbtar; ?>><img src="<?php echo SITEURL; ?>assets/img/social/facebook.png" /></a>
                        </li>
                        <li>
                            <a href="<?php echo $instagram; ?>" <?php echo $fbtar; ?>><img src="<?php echo SITEURL; ?>assets/img/social/instagram.png" /></a>
                        </li>
                        <li>
                            <a href="<?php echo $linkedin; ?>" <?php echo $fbtar; ?>><img src="<?php echo SITEURL; ?>assets/img/social/linkedin.png" /></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="design_by">
                <p>
                   <?php /* &copy;Copyright | */ ?> <?php echo date("Y"); ?> Tree Tile LLP | All rights reserved
                </p>
            </div>
        </div>
        <div class="col-md-5">
            <div class="design_by">
                <p>
                    <a href="https://antiquetouch.in/" target="_blank">Design By : <span style="color: #00a859;"> Antique Touch - INDIA</span>. <?php /* <img src="https://antiquetouch.in/img/logo.png" style="width: 60px" />*/ ?></a>
                </p>
            </div>
            <div class="trasnlter">
                <div id="google_translate_element"></div>
            </div>
        </div>
    </div>
</section>
<?php 
        if($metapage != 'download' ){ ?>
		</div>
		<!-- scroll div over -->
    <?php } ?>
		
        <a href="#" id="back-to-top" title="Back to top">&#x25B2;</a>
        <script type="text/javascript" src="<?php echo SITEURL; ?>assets/vender/menu/base-js.js"></script>
        <script type="text/javascript" src="<?php echo SITEURL; ?>assets/vender/slider/owl.js"></script>


        <script>
            /******************Slider Script*********************/
            jQuery(document).ready(function () {
                jQuery("[data-bg-img]").each(function () {
                    var _this = jQuery(this);
                    _this.css("background-image", "url(" + _this.data("bg-img") + ")");
                });
                var mainSlider = jQuery("#main-slider");
                if (mainSlider.length > 0 && jQuery.fn.owlCarousel) {
                    // Main Slider
                    mainSlider.owlCarousel({
                        navigation: 0,
                        singleItem: !0,
                        addClassActive: !0,
                        autoPlay: !0,
                        pagination: !1,
                        navigationText: ["<span></span>", "<span></span>"],
                    });
                }
            });
            if ($("#back-to-top").length) {
                var scrollTrigger = 100, // px
                    backToTop = function () {
                        var scrollTop = $(window).scrollTop();
                        if (scrollTop > scrollTrigger) {
                            $("#back-to-top").addClass("show");
                        } else {
                            $("#back-to-top").removeClass("show");
                        }
                    };
                backToTop();
                $(window).on("scroll", function () {
                    backToTop();
                });
                $("#back-to-top").on("click", function (e) {
                    e.preventDefault();
                    $("html,body").animate(
                        {
                            scrollTop: 0,
                        },
                        700
                    );
                });
            }
            $(function () {
                var pgurl = window.location.href.substr(window.location.href.lastIndexOf("index.html") + 1);
                $(".menu_list ul li a").each(function () {
                    if ($(this).attr("href") == pgurl || $(this).attr("href") == "") $(this).addClass("active");
                });
            });
        </script>

        


<?php 
        if($metapage != 'download'){ ?>
        <link href="<?php echo SITEURL; ?>assets/css/locomotive-scroll.css" type="text/css" rel="stylesheet">
        <script src="<?php echo SITEURL; ?>assets/js/locomotive-scroll.min.js"></script>
        <?php } ?>
        <script src="<?php echo SITEURL; ?>assets/js/gsap.min.js"></script>
    	<script src="<?php echo SITEURL; ?>assets/js/ScrollTrigger.min.js"></script>
    	
        <script type="text/javascript" src="<?php echo SITEURL; ?>assets/js/main.js"></script>
        
        <script>

        $('.accordion__header').click(function (e) {

            e.preventDefault();

            var currentIsActive = $(this).hasClass('is-active');

            $(this).parent('.accordion').find('> *').removeClass('is-active');

            if (currentIsActive != 1) {

                $(this).addClass('is-active');

                $(this).next('.accordion__body').addClass('is-active');

            }

        });

    </script>
    

<div class="stic_btns">
    <a class="stic stic_email" href="mailto:export@treetile.in" target="_blank">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="width: 100%; height: 100%; fill: rgb(255, 255, 255); stroke: none;"><path d="M19.6,19.47A5,5,0,1,1,21,16v1.5a1.5,1.5,0,0,0,3,0V16a8,8,0,1,0-4.94,7.4A1,1,0,0,1,20,25.18l-.14.06A10,10,0,1,1,26,16v1.5a3.5,3.5,0,0,1-6.4,2ZM16,19a3,3,0,1,0-3-3A3,3,0,0,0,16,19Z"></path></svg>
    </a>
    <?php $w = $obj_fun->getMetaData('whatsapp'); ?>
    <a class="stic stic_whatsapp" href="<?php echo SITEURL; ?>includes/whatsappcounter.php?file=<?php echo base64_encode($w); ?>" target="_blank">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="width: 100%; height: 100%; fill: rgb(255, 255, 255); stroke: none;"><path d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"></path></svg>
    </a>
</div>
<?php /*
<div class="color-t">
    <a href="https://webapplication.tilesdisplay.in/frontend/login-with/api-key/eyJpdiI6ImZVdE9UWTdZZTNvbkNFUGhlNDFGM1E9PSIsInZhbHVlIjoiYitiVkpBbDMwVDJ2NUV4b0lzNGJcL3c9PSIsIm1hYyI6Ijg4ZDk3ZTJjZmIyN2VhZmRkZjM5N2NiZDg4OWQzNDhmODU0ZWJlMGZjZWMzMDNjYjY5MGQ4NDNjOThhMTU4N2UifQ==" target="_blank" style="color:#fff !important;text-decoration:none !important;">
        <img src="<?php echo SITEURL; ?>assets/images/tilesdisplay.png">&nbsp; <strong>Tiles Display</strong>
    </a>
</div> */ ?>
<style>
.stic_btns {
    position: fixed;
    left: 25px;
    bottom: 25px;
    width: 50px;
    z-index: 111;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.stic_btns a {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 100px;
    padding: 10px;
    transition: all 200ms ease;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
}
.stic_btns a:hover {
    filter: brightness(0.8);
}
.stic_whatsapp {
    background: #4dc247;
}
.stic_email {
    background: #eb8a32;
}
span a.VIpgJd-ZVi9od-l4eHX-hSRGPd img {
    display: none;
}
        .goog-logo-link{
                display: none;
        }
        .google_translate_element{
                color: #fff;
        }
        .trasnlter{
             
                text-align:center;
        }
        .goog-te-combo{
                width: 150px;
                height: 30px;
                border: 1px solid #ccc;
        }
</style>




<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    </body>
</html>
