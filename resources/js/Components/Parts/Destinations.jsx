import $ from "jquery";
import "owl.carousel/dist/assets/owl.carousel.css";
import "owl.carousel/dist/assets/owl.theme.default.css";
import "owl.carousel";

import React, { useEffect, useRef } from "react";
import shape1 from "../../../../public/frontend-assets/images/shapes/destination-three-shape-1.png";
import destination1 from "../../../../public/frontend-assets/images/resources/destination-2-1.jpg";
import destination2 from "../../../../public/frontend-assets/images/resources/destination-1-2.jpg";
import destination3 from "../../../../public/frontend-assets/images/resources/destination-1-3.jpg";

export default function Destinations() {
    const carouselRef = useRef(null);

    useEffect(() => {
        const $carousel = $(carouselRef.current);
        if ($carousel.length && $.fn.owlCarousel) {
            $carousel.owlCarousel({
                loop: true,
                autoplay: false,
                margin: 30,
                nav: true,
                dots: false,
                smartSpeed: 500,
                autoplayTimeout: 10000,
                navText: [
                    '<span class="icon-left-arrow"></span>',
                    '<span class="icon-right-arrow"></span>',
                ],
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    992: { items: 2 },
                    1200: { items: 2.93 },
                },
            });
        }

        return () => {
            // destroy on unmount so Inertia navigation doesn't stack up duplicate instances
            if ($carousel.length && $carousel.data("owl.carousel")) {
                $carousel.trigger("destroy.owl.carousel");
            }
        };
    }, []);

    return (
        <>
            {/*destination Three Start*/}
            <section className="destination-three">
                <div className="destination-three__shape-1 float-bob-y">
                    <img src={shape1} alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xl-4">
                            <div className="destination-three__left">
                                <div className="section-title text-left">
                                    <span className="section-title__tagline">
                                        What will you get
                                    </span>
                                    <h2 className="section-title__title">
                                        Popular charter destinations
                                    </h2>
                                </div>
                                <p className="destination-three__text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Curabitur condimentum,
                                    lacus <br /> non faucibus congue, lectus
                                    quam viverra nulla, quis egestas neque
                                    sapien ac magna.
                                </p>
                            </div>
                        </div>
                        <div className="col-xl-8">
                            <div className="destination-three__right">
                                <div
                                    ref={carouselRef}
                                    className="destination-three__carousel owl-carousel owl-theme thm-owl__carousel"
                                >
                                    {/*destination One Single Start*/}
                                    <div className="item">
                                        <div className="destination-one__single">
                                            <div className="destination-one__img-box">
                                                <div className="destination-one__img">
                                                    <img
                                                        src={destination1}
                                                        alt=""
                                                    />
                                                </div>
                                                <div className="destination-one__content">
                                                    <h3 className="destination-one__title">
                                                        <a href="destination-details.html">
                                                            Paris - Barcelona
                                                        </a>
                                                    </h3>
                                                    <div className="destination-one__time">
                                                        <div className="destination-one__paris-time">
                                                            <p>
                                                                Departure:{" "}
                                                                <span>
                                                                    16:50
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div className="destination-one__barcelona-time">
                                                            <p>
                                                                Arrival:{" "}
                                                                <span>
                                                                    20:42
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/*destination One Single End*/}
                                    {/*destination One Single Start*/}
                                    <div className="item">
                                        <div className="destination-one__single">
                                            <div className="destination-one__img-box">
                                                <div className="destination-one__img">
                                                    <img
                                                        src={destination2}
                                                        alt=""
                                                    />
                                                </div>
                                                <div className="destination-one__content">
                                                    <h3 className="destination-one__title">
                                                        <a href="destination-details.html">
                                                            Hamburg – London
                                                        </a>
                                                    </h3>
                                                    <div className="destination-one__time">
                                                        <div className="destination-one__paris-time">
                                                            <p>
                                                                Departure:{" "}
                                                                <span>
                                                                    16:50
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div className="destination-one__barcelona-time">
                                                            <p>
                                                                Arrival:{" "}
                                                                <span>
                                                                    20:42
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/*destination One Single End*/}
                                    {/*destination One Single Start*/}
                                    <div className="item">
                                        <div className="destination-one__single">
                                            <div className="destination-one__img-box">
                                                <div className="destination-one__img">
                                                    <img
                                                        src={destination3}
                                                        alt=""
                                                    />
                                                </div>
                                                <div className="destination-one__content">
                                                    <h3 className="destination-one__title">
                                                        <a href="destination-details.html">
                                                            London – Madrid
                                                        </a>
                                                    </h3>
                                                    <div className="destination-one__time">
                                                        <div className="destination-one__paris-time">
                                                            <p>
                                                                Departure:{" "}
                                                                <span>
                                                                    16:50
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div className="destination-one__barcelona-time">
                                                            <p>
                                                                Arrival:{" "}
                                                                <span>
                                                                    20:42
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/*destination One Single End*/}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {/*destination Three End*/}
        </>
    );
}
