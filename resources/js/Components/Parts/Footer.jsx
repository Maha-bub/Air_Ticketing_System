import React from "react";
import footerShape1 from "../../../../public/frontend-assets/images/shapes/site-footer-shape-1.png";
import footerLogo from "../../../../public/frontend-assets/images/resources/footer-logo.png";

export default function Footer() {
    return (
        <>
            {/*Site Footer Start*/}
            <footer className="site-footer">
                <div className="container">
                    <div className="site-footer__inner">
                        <div className="site-footer__shape-1 zoom-fade-3">
                            <img src={footerShape1} alt="" />
                        </div>
                        <div className="site-footer__top">
                            <div className="row">
                                <div
                                    className="col-xl-4 col-lg-6 col-md-6 wow fadeInUp"
                                    data-wow-delay="100ms"
                                >
                                    <div className="footer-widget__column footer-widget__about">
                                        <div className="footer-widget__logo">
                                            <a href="#">
                                                <img
                                                    src={footerLogo}
                                                    alt=""
                                                />
                                            </a>
                                        </div>
                                        <div className="footer-widget__about-text-box">
                                            <p className="footer-widget__about-text">
                                                Private jet charters save your
                                                time and give you comfort.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    className="col-xl-3 col-lg-6 col-md-6 wow fadeInUp"
                                    data-wow-delay="200ms"
                                >
                                    <div className="footer-widget__column footer-widget__Explore">
                                        <div className="footer-widget__title-box">
                                            <h3 className="footer-widget__title">
                                                Explore
                                            </h3>
                                        </div>
                                        <ul className="footer-widget__Explore-list list-unstyled">
                                            <li>
                                                <a href="about.html">About</a>
                                            </li>
                                            <li>
                                                <a href="jet-rentals.html">
                                                    Private Jet Catering
                                                </a>
                                            </li>
                                            <li>
                                                <a href="destinations.html">
                                                    Destinations
                                                </a>
                                            </li>
                                            <li>
                                                <a href="contact.html">
                                                    Flight Search
                                                </a>
                                            </li>
                                            <li>
                                                <a href="contact.html">
                                                    Book Flight
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div
                                    className="col-xl-2 col-lg-6 col-md-6 wow fadeInUp"
                                    data-wow-delay="300ms"
                                >
                                    <div className="footer-widget__column footer-widget__links">
                                        <div className="footer-widget__title-box">
                                            <h3 className="footer-widget__title">
                                                Links
                                            </h3>
                                        </div>
                                        <ul className="footer-widget__Explore-list list-unstyled">
                                            <li>
                                                <a href="about.html">
                                                    Terms of Use
                                                </a>
                                            </li>
                                            <li>
                                                <a href="contact.html">
                                                    Contact
                                                </a>
                                            </li>
                                            <li>
                                                <a href="news.html">
                                                    News &amp; Press
                                                </a>
                                            </li>
                                            <li>
                                                <a href="about.html">Games</a>
                                            </li>
                                            <li>
                                                <a href="faq.html">FAQs</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div
                                    className="col-xl-3 col-lg-6 col-md-6 wow fadeInUp"
                                    data-wow-delay="400ms"
                                >
                                    <div className="footer-widget__column footer-widget__Contact">
                                        <div className="footer-widget__title-box">
                                            <h3 className="footer-widget__title">
                                                Contact
                                            </h3>
                                        </div>
                                        <ul className="footer-widget__Contact-list list-unstyled">
                                            <li>
                                                <div className="icon">
                                                    <span className="fas fa-phone" />
                                                </div>
                                                <div className="text">
                                                    <p>
                                                        <a href="tel:+9288006780">
                                                            +92 ( 8800 ) - 6780
                                                        </a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div className="icon">
                                                    <span className="fas fa-envelope" />
                                                </div>
                                                <div className="text">
                                                    <p>
                                                        <a href="mailto:needhelp@company.com">
                                                            needhelp@company.com
                                                        </a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div className="icon">
                                                    <span className="fas fa-map-marker" />
                                                </div>
                                                <div className="text">
                                                    <p>
                                                        30 broklyn golden
                                                        street. New York
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="site-footer__bottom">
                            <div className="site-footer__bottom-inner">
                                <div className="site-footer__bottom-left">
                                    <p className="site-footer__bottom-text">
                                        © Copyright 2022 by{" "}
                                        <a href="#">Jetly.com</a>
                                    </p>
                                </div>
                                <div className="site-footer__bottom-right">
                                    <div className="site-footer__social">
                                        <a href="#">
                                            <i className="fab fa-twitter" />
                                        </a>
                                        <a href="#">
                                            <i className="fab fa-facebook" />
                                        </a>
                                        <a href="#">
                                            <i className="fab fa-pinterest-p" />
                                        </a>
                                        <a href="#">
                                            <i className="fab fa-instagram" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            {/*Site Footer End*/}
        </>
    );
}
