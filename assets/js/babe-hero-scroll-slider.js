// babe-hero-scroll-slider.js
// hero slider gsap

/* window.addEventListener("DOMContentLoaded", () => {
    window.addEventListener("load", () => {
        "use strict";

        gsap.registerPlugin(ScrollTrigger);

        const animateImages = (selector, easeOutTime = 1.8) => {
            const timeline = gsap.timeline();
            const imageClasses = [
                ".ba-images07", ".ba-images02", ".ba-images05", 
                ".ba-images04", ".ba-images03", ".ba-images01", 
                ".ba-images06"
            ];

            imageClasses.forEach((imageClass, index) => {
                timeline.to(`${selector} ${imageClass}`, easeOutTime, { 
                    scale: 1, 
                    clipPath: 'inset(0%)', 
                    ease: "expo.out" 
                }, `-=${0.85 * easeOutTime * index}`);
            });

            timeline.to('.intro_hold_h1 .h2g', 1.8, { y: 0, ease: 'expo.out' }, '-=1.9');
            return timeline;
        };

        const screenAnimations = () => {
            const animationTime = 1.8;
            animateImages('.banner-animation-images-wraper .images-holder', animationTime);
        };

        screenAnimations();

        const animateOnScroll = (pinEndFactor = 1.2, autoAlphaValue = 0.3) => {
            const h = window.innerHeight;
            const animationData = [
                { imageClass: '.ba-images01', xPercent: -250, yPercent: 220 },
                { imageClass: '.ba-images02', xPercent: -180, yPercent: -250 },
                { imageClass: '.ba-images05', xPercent: 165, yPercent: -150 },
                { imageClass: '.ba-images06', xPercent: 195, yPercent: 235 },
                { imageClass: '.ba-images04', xPercent: 50, yPercent: 270 },
                { imageClass: '.ba-images07', xPercent: 135, yPercent: -260 },
                { imageClass: '.ba-images03', xPercent: -120, yPercent: -180 }
            ];

            gsap.timeline({
                scrollTrigger: {
                    trigger: '.banner-animation-images-wraper',
                    pin: true,
                    pinSpacing: true,
                    scrub: 1,
                    start: 'top top',
                    end: `+=${h * pinEndFactor}`,
                }
            });

            animationData.forEach(({ imageClass, xPercent, yPercent }) => {
                gsap.timeline({
                    scrollTrigger: {
                        trigger: imageClass,
                        scrub: 1,
                        start: 'top top',
                        end: `+=${h}`,
                    }
                }).to(imageClass, { xPercent, yPercent, ease: 'none' });

                gsap.timeline({
                    scrollTrigger: {
                        trigger: imageClass,
                        scrub: 1,
                        start: 'top top',
                        end: '+=50',
                    }
                }).to(imageClass, { autoAlpha: autoAlphaValue, ease: 'none' });
            });
        };

        ScrollTrigger.matchMedia({
            "(min-width: 320px) and (max-width: 760px)": function () {
                animateOnScroll(1.25, 0);
            },
            "(min-width: 761px)": function () {
                animateOnScroll(1.2, 0.3);
            }
        });
    });
});*/



window.addEventListener("DOMContentLoaded", () => {
    window.addEventListener("load", () => {
        "use strict";
        gsap.registerPlugin(ScrollTrigger);

        const animateImages = (selector, easeOutTime) => {
            const timeline = gsap.timeline();
            timeline
                .to(`${selector} .ba-images07`, easeOutTime, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" })
                .add('a')
                .to(`${selector} .ba-images02`, easeOutTime, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * easeOutTime}`)
                .to(`${selector} .ba-images05`, easeOutTime, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * easeOutTime}`)
                .to(`${selector} .ba-images04`, easeOutTime, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * easeOutTime}`)
                .to(`${selector} .ba-images03`, easeOutTime, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * easeOutTime}`)
                .to(`${selector} .ba-images01`, easeOutTime, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * easeOutTime}`)
                .to(`${selector} .ba-images06`, easeOutTime, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * easeOutTime}`)
                .to('.intro_hold_h1 .h2g', 1.8, { y: 0, ease: 'expo.out' }, `-=1.9`)
                // .to('.ms_txt', 1.5, { autoAlpha: 1, y: 0, ease: 'expo.out' }, 'a+=1');
            return timeline;
        };

        const screenAnimations = () => {
            if (window.innerWidth <= 760) {
                animateImages('.banner-animation-images-wraper .images-holder', 1.8);
            } else {
                animateImages('.banner-animation-images-wraper .images-holder', 1.8)
                    // .to('.ms_txt', 1.8, { autoAlpha: 1, y: 0, ease: 'expo.out' }, 'a+=.7');
            }
        };
        screenAnimations();

        const animateOnScroll = (minWidth, maxWidth, pinEndFactor, autoAlphaValue) => {
            const h = window.innerHeight;
            // if ($('.banner-animation-images-wraper').length) {
                gsap.timeline({
                    scrollTrigger: {
                        trigger: '.banner-animation-images-wraper',
                        pin: true,
                        pinSpacing: true,
                        scrub: 1,
                        start: `top top`,
                        end: `+=${h * pinEndFactor}`,
                    },
                });

                const animationData = [
                    { trigger: '', imageClass: '.ba-images01', xPercent: -250, yPercent: 220, fadeTrigger: '' },
                    { trigger: '', imageClass: '.ba-images02', xPercent: -180, yPercent: -250, fadeTrigger: '' },
                    { trigger: '', imageClass: '.ba-images05', xPercent: 165, yPercent: -150, fadeTrigger: '' },
                    { trigger: '', imageClass: '.ba-images06', xPercent: 195, yPercent: 235, fadeTrigger: '' },
                    { trigger: '', imageClass: '.ba-images04', xPercent: 50, yPercent: 270, fadeTrigger: '' },
                    { trigger: '', imageClass: '.ba-images07', xPercent: 135, yPercent: -260, fadeTrigger: '' },
                    { trigger: '', imageClass: '.ba-images03', xPercent: -120, yPercent: -180, fadeTrigger: '' },
                ];

                animationData.forEach(({ trigger, imageClass, xPercent, yPercent, fadeTrigger }) => {
                    gsap.timeline({
                        scrollTrigger: {
                            trigger: trigger,
                            scrub: 1,
                            start: 'top top',
                            end: `+=${h}`,
                        },
                    }).to(imageClass, { xPercent, yPercent, ease: 'none' });

                    gsap.timeline({
                        scrollTrigger: {
                            trigger: fadeTrigger,
                            scrub: 1,
                            start: 'top top',
                            end: '+=50',
                        },
                    }).to(imageClass, { autoAlpha: autoAlphaValue, ease: 'none' });
                });
            // }
        };

        ScrollTrigger.matchMedia({
            "(min-width: 320px) and (max-width: 760px)": function () {
                animateOnScroll(320, 760, 1.25, 0);
                gsap.timeline({
                    scrollTrigger: {
                        trigger: '#mns_id_set1',
                        scrub: 1,
                        start: 'top top',
                        end: `+=${window.innerHeight}`,
                    },
                })
                    // .to('.ms_txt', { autoAlpha: 0, ease: 'none' })
                    // .to('.mdl_cnt', { autoAlpha: 1, ease: 'none' })
                    // .to('.we_guarantee_quality', { autoAlpha: 1, ease: 'none' });
            },
            "(min-width: 761px) and (max-width: 6500px)": function () {
                animateOnScroll(761, 6500, 1.2, 0.3);
            }
        });
    }, false);
});




/* window.addEventListener("DOMContentLoaded", (event) => {
	window.addEventListener("load", function (e) {

		"use strict";
		gsap.registerPlugin(ScrollTrigger);
	
		if (window.innerWidth <= 760) {
			let $h2Mm = gsap.timeline();
			$h2Mm
				.to('.banner-animation-images-wraper .images-holder .ba-images07', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" })
				.add('a')
				.to('.banner-animation-images-wraper .images-holder .ba-images02', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images05', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images04', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images03', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images01', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images06', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.intro_hold_h1 .h2g', 1.8, {y: 0, ease: 'expo.out' }, `-=1.9`)
				// .to('.ms_txt', 1.5, { autoAlpha: 1, y: 0, ease: 'expo.out' }, 'a+=1')
		} else if(window.innerWidth > 760) {
			let $h2M = gsap.timeline();
			$h2M
				.to('.banner-animation-images-wraper .images-holder .ba-images07', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" })
				.add('a')
				.to('.banner-animation-images-wraper .images-holder .ba-images02', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images05', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images04', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images03', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images01', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.banner-animation-images-wraper .images-holder .ba-images06', 1.8, { scale: 1, clipPath: 'inset(0%)', ease: "expo.out" }, `-=${0.85 * 1.8}`)
				.to('.intro_hold_h1 .h2g', 1.8, {y: 0, ease: 'expo.out' }, `-=1.9`)
				// .to('.ms_txt', 1.8, { autoAlpha: 1, y: 0, ease: 'expo.out' }, 'a+=.7')
		}

		
			ScrollTrigger.matchMedia({
				"(min-width: 320px) and (max-width: 760px)": function () {
					const h = window.innerHeight;
					const w = window.innerWidth;

					// if(document.querySelector('.banner-animation-images-wraper').length){
						let tlFixFirstScreen = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreen",
								trigger: '.banner-animation-images-wraper',
								pin: true,
								pinSpacing: true,
								scrub: 1,
								start: `top top`,
								end: `+=${h * 1.25}`,
							}
						});
						


						let tlFixFirstScreenMove01 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreen",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove01
							.add('f')
							.to('.ba-images01', 1, {xPercent: -250, yPercent: 220, ease: 'none'}, 'f')
							.to('.ms_txt', .5, {autoAlpha: 0, ease: 'none'}, 'f')
							.to('.mdl_cnt', .1, {autoAlpha: 1, ease: 'none'}, 'f')
							.to('.we_guarantee_quality', .1, {autoAlpha: 1, ease: 'none'}, 'f');

						let tlFixFirstScreenMove01Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove01Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove01Ops
							.to('.ba-images01', {autoAlpha: 0,  ease: 'none'});


						let tlFixFirstScreenMove02 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove02",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove02
							.to('.ba-images02', {xPercent: -180, yPercent: -250, ease: 'none'});
							
						let tlFixFirstScreenMove02Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove02Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove02Ops
							.to('.ba-images02', {autoAlpha: 0,  ease: 'none'});



						let tlFixFirstScreenMove06 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove06",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove06
							.to('.ba-images06', {xPercent: 195, yPercent: 235, ease: 'none'});

						let tlFixFirstScreenMove06Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove06Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove06Ops
							.to('.ba-images06', {autoAlpha: 0,  ease: 'none'});

						let tlFixFirstScreenMove04 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove04",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove04
							.to('.ba-images04', {xPercent: 50, yPercent: 270, ease: 'none'});	
							
						let tlFixFirstScreenMove04Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove04Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove04Ops
							.to('.ba-images04', {autoAlpha: 0,  ease: 'none'});							


						let tlFixFirstScreenMove07 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove07",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`, 
							}
						});
						tlFixFirstScreenMove07
							.to('.ba-images07', {xPercent: 135, yPercent: -260, ease: 'none'});

						let tlFixFirstScreenMove07Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove07Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove07Ops
							.to('.ba-images07', {autoAlpha: 0,  ease: 'none'});

						let tlFixFirstScreenMove03 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove03",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove03
							.to('.ba-images03', {xPercent: -120, yPercent: -180, ease: 'none'});	
							
						let tlFixFirstScreenMove03Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove03Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove03Ops
							.to('.ba-images03', {autoAlpha: 0,  ease: 'none'});
										
					// }

				},
				"(min-width: 761px) and (max-width: 6500px)": function () {

					const h = window.innerHeight;
					const w = window.innerWidth;

					const hBurger = document.querySelector('.banner-animation').getBoundingClientRect().top;


					// if(document.querySelector('.banner-animation-images-wraper').length){
						let tlFixFirstScreen = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreen",
								trigger: '.banner-animation-images-wraper',
								pin: true,
								pinSpacing: true,
								scrub: 1,
								start: `top top`,
								end: `+=${h * 1.2}`,
							}
						});
						


						let tlFixFirstScreenMove01 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreen",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove01
							.add('f')
							.to('.ba-images01', 1, {xPercent: -250, yPercent: 220, ease: 'none'}, 'f')
							.to('.ms_txt', 1, {autoAlpha: 0, ease: 'none'}, 'f')
							.to('.mdl_cnt', .1, {autoAlpha: 1, ease: 'none'}, 'f');

						let tlFixFirstScreenMove01Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove01Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove01Ops
							.to('.ba-images01', {autoAlpha: .3,  ease: 'none'});


						let tlFixFirstScreenMove02 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove02",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove02
							.to('.ba-images02', {xPercent: -180, yPercent: -250, ease: 'none'});
							
						let tlFixFirstScreenMove02Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove02Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`, 
							}
						});
						tlFixFirstScreenMove02Ops
							.to('.ba-images02', {autoAlpha: .3,  ease: 'none'});



						let tlFixFirstScreenMove06 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove06",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove06
							.to('.ba-images06', {xPercent: 195, yPercent: 255, ease: 'none'});

						let tlFixFirstScreenMove06Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove06Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove06Ops
							.to('.ba-images06', {autoAlpha: .3,  ease: 'none'});



						let tlFixFirstScreenMove05 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove05",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove05
							.to('.ba-images05', {xPercent: 165, yPercent: -150, ease: 'none'});	

						let tlFixFirstScreenMove05Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove05Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove05Ops
							.to('.ba-images05', {autoAlpha: .3,  ease: 'none'});



						let tlFixFirstScreenMove04 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove04",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove04
							.to('.ba-images04', {xPercent: 250, yPercent: 320, ease: 'none'});	
							
						let tlFixFirstScreenMove04Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove04Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`,
							}
						});
						tlFixFirstScreenMove04Ops
							.to('.ba-images04', {autoAlpha: 0.3,  ease: 'none'});							


						let tlFixFirstScreenMove07 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove07",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove07
							.to('.ba-images07', {xPercent: 235, yPercent: -360, ease: 'none'});

						let tlFixFirstScreenMove07Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove07Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`, 
							}
						});
						tlFixFirstScreenMove07Ops
							.to('.ba-images07', {autoAlpha: 0.3,  ease: 'none'});

						let tlFixFirstScreenMove03 = gsap.timeline({
							scrollTrigger: { 
								id: "tlFixFirstScreenMove03",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=${h}`,
							}
						});
						tlFixFirstScreenMove03
							.to('.ba-images03', {xPercent: -220, yPercent: -280, ease: 0.05});	
							
						let tlFixFirstScreenMove03Ops = gsap.timeline({
							scrollTrigger: {
								id: "tlFixFirstScreenMove03Ops",
								trigger: '',
								pin: false,
								pinSpacing: false,
								scrub: 1,
								start: `top top`,
								end: `+=50`, 
							}
						});
						tlFixFirstScreenMove03Ops
							.to('.ba-images03', {autoAlpha: 0.3,  ease: 'none'});
												
					// }



				},
				


			});
		


	}, false);

}); */















