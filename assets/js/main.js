let scroller;
		$(document).ready(function () {
		    /* Preload image */
		    pic = new Image();
		    pic.src = "../img/right-arrow.svg";

		    /* Smoothscroll */
		    scroller = new LocomotiveScroll({
		        el: document.querySelector("[data-scroll-container]"),
		        smooth: true,
		    });
		    $(window).on("load resize", function () {
		        if ($(window).width() <= 900) {
		            scroller.destroy();
		        }
		    });
		    gsap.registerPlugin(ScrollTrigger);
		    scroller.on("scroll", ScrollTrigger.update);
		    ScrollTrigger.scrollerProxy(".swrapper", {
		        scrollTop(value) {
		            return arguments.length ? scroller.scrollTo(value, 0, 0) : scroller.scroll.instance.scroll.y;
		        },
		        getBoundingClientRect() {
		            return {
		                left: 0,
		                top: 0,
		                width: window.innerWidth,
		                height: window.innerHeight,
		            };
		        },
		    });
		    ScrollTrigger.addEventListener("refresh", () => scroller.update());
		    ScrollTrigger.refresh();

		    $(window).on("resize", function () {
		        scroller.update();
		    });


		    if ($(".main .img1 .img-w").length) {
		        $(".main .img1 .img-w").each(function () {
		            var timeline = gsap.timeline({
		                scrollTrigger: {
		                    trigger: '.header',
		                    scroller: '.swrapper',
		                    start: 'top top',
		                    ease: "none",
		                    scrub: true,
		                    end: "+=200%"
		                }
		            })
		                .to(this, {
		                    height: '100%',
		                    ease: "none"
		                })
		        });
		    }

		    /* Card-width */
		    if ($(".card .img-w").length) {
		        $(".card .img-w").each(function () {
		            var timeline = gsap.timeline({
		                scrollTrigger: {
		                    trigger: this,
		                    scroller: '.swrapper',
		                    start: "top bottom",
		                    ease: "power4.out",
		                }
		            })
		                .to($(this), {
		                    x: 0,
		                    duration: 2,
		                    ease: "power4.out"
		                })
		        });
		    }
		    if ($(".card .img-w span").length) {
		        $(".card .img-w span").each(function () {
		            var timeline = gsap.timeline({
		                scrollTrigger: {
		                    trigger: this,
		                    scroller: '.swrapper',
		                    start: "top bottom",
		                    ease: "power4.out",
		                }
		            })
		                .to($(this), {
		                    x: 0,
		                    duration: 2,
		                    ease: "power4.out"
		                })
		        });
		        $(window).on('load resize', function () {
		            if ($(window).width() <= 900) {
		                $(".card .img-w").each(function () {
		                    var timeline = gsap.timeline({
		                        scrollTrigger: {
		                            trigger: this,
		                            start: "top bottom",
		                            ease: "none",
		                        }
		                    })
		                        .to($(this), {
		                            x: 0,
		                            duration: 1,
		                            ease: "none"
		                        })
		                });
		                $(".card .img-w span").each(function () {
		                    var timeline = gsap.timeline({
		                        scrollTrigger: {
		                            trigger: this,
		                            start: "top bottom",
		                            ease: "none",
		                        }
		                    })
		                        .to($(this), {
		                            x: 0,
		                            duration: 1,
		                            ease: "none"
		                        })
		                });
		            }
		        });
		    }

		});