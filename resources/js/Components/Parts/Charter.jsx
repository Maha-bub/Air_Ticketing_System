import React from "react";
import "animate.css";
import { useEffect } from "react";
import * as WOW from "wowjs";
import charter1 from "../../../../public/frontend-assets/images/resources/charters-1-1.jpg";
import charter2 from "../../../../public/frontend-assets/images/resources/charters-1-2.jpg";
import charter3 from "../../../../public/frontend-assets/images/resources/charters-1-3.jpg";

export default function Charter() {
    useEffect(() => {
        new WOW.WOW({
            live: false,
        }).init();
    }, []);
    return (
        <>
            {/*Charters Start*/}
            <section className="charters">
                <div className="container">
                    <div className="section-title text-center">
                        <span className="section-title__tagline">
                            luxury charters
                        </span>
                        <h2 className="section-title__title">
                            Select the charters
                            <br /> according to your need
                        </h2>
                    </div>
                    <div className="row">
                        {/*charters Single Start*/}
                        <div
                            className="col-xl-4 col-lg-4 wow fadeInUp"
                            data-wow-delay="100ms"
                        >
                            <div className="charters__single">
                                <div className="charters__img">
                                    <img src={charter1} alt="" />
                                </div>
                                <div className="charters__content">
                                    <p className="charters__date">
                                        6 - 8 seats
                                    </p>
                                    <h3 className="charters__title">
                                        <a href="jet-rentals.html">
                                            Executive jet
                                        </a>
                                    </h3>
                                    <p className="charters__text">
                                        Non augue egestas, commodo simply free
                                        velit eget, tellus.
                                    </p>
                                    <a
                                        href="jet-rentals.html"
                                        className="thm-btn charters__btn"
                                    >
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        {/*charters Single End*/}
                        {/*charters Single Start*/}
                        <div
                            className="col-xl-4 col-lg-4 wow fadeInUp"
                            data-wow-delay="200ms"
                        >
                            <div className="charters__single">
                                <div className="charters__img">
                                    <img src={charter2} alt="" />
                                </div>
                                <div className="charters__content">
                                    <p className="charters__date">
                                        4 - 6 seats
                                    </p>
                                    <h3 className="charters__title">
                                        <a href="high-profile-people.html">
                                            Helicopter
                                        </a>
                                    </h3>
                                    <p className="charters__text">
                                        Non augue egestas, commodo simply free
                                        velit eget, tellus.
                                    </p>
                                    <a
                                        href="high-profile-people.html"
                                        className="thm-btn charters__btn"
                                    >
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        {/*charters Single End*/}
                        {/*charters Single Start*/}
                        <div
                            className="col-xl-4 col-lg-4 wow fadeInUp"
                            data-wow-delay="300ms"
                        >
                            <div className="charters__single">
                                <div className="charters__img">
                                    <img src={charter3} alt="" />
                                </div>
                                <div className="charters__content">
                                    <p className="charters__date">
                                        4 - 8 seats
                                    </p>
                                    <h3 className="charters__title">
                                        <a href="business-charter.html">
                                            Turbo prop
                                        </a>
                                    </h3>
                                    <p className="charters__text">
                                        Non augue egestas, commodo simply free
                                        velit eget, tellus.
                                    </p>
                                    <a
                                        href="business-charter.html"
                                        className="thm-btn charters__btn"
                                    >
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        {/*charters Single End*/}
                    </div>
                </div>
            </section>
            {/*Charters End*/}
        </>
    );
}
