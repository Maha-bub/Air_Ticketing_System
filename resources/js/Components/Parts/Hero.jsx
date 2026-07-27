import React, { useEffect, useRef } from "react";
import bgimage from "../../../../public/frontend-assets/images/backgrounds/cloud-1.png";
import heroimage from "../../../../public/frontend-assets/images/resources/main-slider-three-img-1.png";

export default function Hero() {
    const sliderRef = useRef(null);
    const swiperInstance = useRef(null);

    useEffect(() => {
        // window.Swiper comes from public/frontend-assets/vendors/swiper/swiper.min.js
        // (loaded as a classic <script> in app.blade.php). We init it here, after
        // React has actually rendered the markup, instead of relying on jetly.js
        // (which runs before React mounts and finds nothing).
        if (window.Swiper && sliderRef.current) {
            swiperInstance.current = new window.Swiper(sliderRef.current, {
                slidesPerView: 1,
                allowTouchMove: false,
                loop: false,
                effect: "fade",
                pagination: {
                    el: "#main-slider-pagination",
                    type: "bullets",
                    clickable: true,
                },
                navigation: {
                    nextEl: "#main-slider__swiper-button-next",
                    prevEl: "#main-slider__swiper-button-prev",
                },
            });
        } else if (!window.Swiper) {
            console.warn(
                "Swiper not found on window — check that frontend-assets/vendors/swiper/swiper.min.js is loading before the hero mounts."
            );
        }

        return () => {
            // destroy on unmount so Inertia page navigation doesn't leave a stale instance
            if (swiperInstance.current) {
                swiperInstance.current.destroy(true, true);
                swiperInstance.current = null;
            }
        };
    }, []);

    return (
        <>
            <section className="main-slider-three clearfix">
                <div
                    ref={sliderRef}
                    className="swiper-container thm-swiper__slider"
                >
                    <div className="swiper-wrapper">
                        <div className="swiper-slide">
                            <div
                                className="image-layer-three"
                                style={{
                                    backgroundImage: `url(${bgimage})`,
                                }}
                            />
                            {/* /.image-layer */}
                            <div className="main-slider-three__img">
                                <img
                                    src={heroimage}
                                    alt="Main Slider true"
                                    className="float-bob-y"
                                />
                            </div>
                            <div className="container">
                                <div className="row">
                                    <div className="col-xl-6">
                                        <div className="main-slider-three__content">
                                            <p className="main-slider-three__sub-title">
                                                Private Jets Charters
                                            </p>
                                            <h2 className="main-slider-three__title">
                                                Save Time &amp; <br /> Fly with
                                                Comfort
                                            </h2>
                                            <div className="main-slider-three__btn-box">
                                                <a
                                                    href="contact.html"
                                                    className="thm-btn main-slider__btn"
                                                >
                                                    Book Now
                                                </a>
                                                <a
                                                    href="about.html"
                                                    className="thm-btn main-slider__btn-two"
                                                >
                                                    Read More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    {/* If we need navigation buttons */}
                </div>
            </section>
        </>
    );
}
