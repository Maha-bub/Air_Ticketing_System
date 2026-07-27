import React from "react";
import logo from "../../../../public/frontend-assets/images/resources/logo-2.png";

export default function Header() {
    return (
        <>
            <header className="main-header-three">
                <div className="main-header-three__top">
                    <div className="main-header-three__top-inner">
                        <div className="main-header-three__top-left">
                            <ul className="list-unstyled main-header-three__contact-list">
                                <li>
                                    <div className="icon">
                                        <i className="fas fa-map-marker-alt" />
                                    </div>
                                    <div className="text">
                                        <p>
                                            30 Commercial road fratton,
                                            Australia
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div className="icon">
                                        <i className="fas fa-envelope" />
                                    </div>
                                    <div className="text">
                                        <p>
                                            <a href="mailto:needhelp@company.com">
                                                needhelp@company.com
                                            </a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div className="main-header-three__top-right">
                            <div className="main-header-three__social">
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
                <nav className="main-menu main-menu-three">
                    <div className="main-menu-three__wrapper">
                        <div className="main-menu-three__wrapper-inner">
                            <div className="main-menu-three__left">
                                <div className="main-menu-three__logo">
                                    <a href="index.html">
                                        <img src={logo} alt />
                                    </a>
                                </div>
                            </div>
                            <div className="main-menu-three__main-menu-box">
                                <a href="#" className="mobile-nav__toggler">
                                    <i className="fa fa-bars" />
                                </a>
                                <ul className="main-menu__list">
                                    <li className="dropdown current megamenu">
                                        <a href="index.html">Home </a>
                                        <ul>
                                            <li>
                                                <section className="home-showcase">
                                                    <div className="container">
                                                        <div className="home-showcase__inner">
                                                            <div className="row">
                                                                <div className="col-lg-3">
                                                                    <div className="home-showcase__item">
                                                                        <div className="home-showcase__image">
                                                                            <img
                                                                                src="assets/images/home-showcase/home-showcase-1-1.jpg"
                                                                                alt
                                                                            />
                                                                            <div className="home-showcase__buttons">
                                                                                <a
                                                                                    href="index.html"
                                                                                    className="thm-btn home-showcase__buttons__item"
                                                                                >
                                                                                    Multi
                                                                                    Page
                                                                                </a>
                                                                                <a
                                                                                    href="index-one-page.html"
                                                                                    className="thm-btn home-showcase__buttons__item"
                                                                                >
                                                                                    One
                                                                                    Page
                                                                                </a>
                                                                            </div>
                                                                            {/* /.home-showcase__buttons */}
                                                                        </div>
                                                                        {/* /.home-showcase__image */}
                                                                        <h3 className="home-showcase__title">
                                                                            Home
                                                                            Page
                                                                            01
                                                                        </h3>
                                                                        {/* /.home-showcase__title */}
                                                                    </div>
                                                                    {/* /.home-showcase__item */}
                                                                </div>
                                                                {/* /.col-lg-3 */}
                                                                <div className="col-lg-3">
                                                                    <div className="home-showcase__item">
                                                                        <div className="home-showcase__image">
                                                                            <img
                                                                                src="assets/images/home-showcase/home-showcase-1-2.jpg"
                                                                                alt
                                                                            />
                                                                            <div className="home-showcase__buttons">
                                                                                <a
                                                                                    href="index2.html"
                                                                                    className="thm-btn home-showcase__buttons__item"
                                                                                >
                                                                                    Multi
                                                                                    Page
                                                                                </a>
                                                                                <a
                                                                                    href="index2-one-page.html"
                                                                                    className="thm-btn home-showcase__buttons__item"
                                                                                >
                                                                                    One
                                                                                    Page
                                                                                </a>
                                                                            </div>
                                                                            {/* /.home-showcase__buttons */}
                                                                        </div>
                                                                        {/* /.home-showcase__image */}
                                                                        <h3 className="home-showcase__title">
                                                                            Home
                                                                            Page
                                                                            02
                                                                        </h3>
                                                                        {/* /.home-showcase__title */}
                                                                    </div>
                                                                    {/* /.home-showcase__item */}
                                                                </div>
                                                                {/* /.col-lg-3 */}
                                                                <div className="col-lg-3">
                                                                    <div className="home-showcase__item">
                                                                        <div className="home-showcase__image">
                                                                            <img
                                                                                src="assets/images/home-showcase/home-showcase-1-3.jpg"
                                                                                alt
                                                                            />
                                                                            <div className="home-showcase__buttons">
                                                                                <a
                                                                                    href="index3.html"
                                                                                    className="thm-btn home-showcase__buttons__item"
                                                                                >
                                                                                    Multi
                                                                                    Page
                                                                                </a>
                                                                                <a
                                                                                    href="index3-one-page.html"
                                                                                    className="thm-btn home-showcase__buttons__item"
                                                                                >
                                                                                    One
                                                                                    Page
                                                                                </a>
                                                                            </div>
                                                                            {/* /.home-showcase__buttons */}
                                                                        </div>
                                                                        {/* /.home-showcase__image */}
                                                                        <h3 className="home-showcase__title">
                                                                            Home
                                                                            Page
                                                                            03
                                                                        </h3>
                                                                        {/* /.home-showcase__title */}
                                                                    </div>
                                                                    {/* /.home-showcase__item */}
                                                                </div>
                                                                {/* /.col-lg-3 */}
                                                                <div className="col-lg-3">
                                                                    <div className="home-showcase__item">
                                                                        <div className="home-showcase__image">
                                                                            <img
                                                                                src="assets/images/home-showcase/home-showcase-1-4.jpg"
                                                                                alt
                                                                            />
                                                                            <div className="home-showcase__buttons">
                                                                                <a
                                                                                    href="index-dark.html"
                                                                                    className="thm-btn home-showcase__buttons__item"
                                                                                >
                                                                                    View
                                                                                    Page
                                                                                </a>
                                                                            </div>
                                                                            {/* /.home-showcase__buttons */}
                                                                        </div>
                                                                        {/* /.home-showcase__image */}
                                                                        <h3 className="home-showcase__title">
                                                                            Home
                                                                            Page
                                                                            04
                                                                        </h3>
                                                                        {/* /.home-showcase__title */}
                                                                    </div>
                                                                    {/* /.home-showcase__item */}
                                                                </div>
                                                                {/* /.col-lg-3 */}
                                                            </div>
                                                            {/* /.row */}
                                                        </div>
                                                        {/* /.home-showcase__inner */}
                                                    </div>
                                                    {/* /.container */}
                                                </section>
                                            </li>
                                        </ul>
                                    </li>
                                    <li className="dropdown">
                                        <a href="#">Pages</a>
                                        <ul className="shadow-box">
                                            <li>
                                                <a href="about.html">About</a>
                                            </li>
                                            <li>
                                                <a href="team.html">Team</a>
                                            </li>
                                            <li>
                                                <a href="team-carousel.html">
                                                    Team Carousel
                                                </a>
                                            </li>
                                            <li>
                                                <a href="destinations.html">
                                                    Destinations
                                                </a>
                                            </li>
                                            <li>
                                                <a href="destination-details.html">
                                                    Destination Details
                                                </a>
                                            </li>
                                            <li>
                                                <a href="testimonials.html">
                                                    Testimonials
                                                </a>
                                            </li>
                                            <li>
                                                <a href="testimonials-carousel.html">
                                                    Testimonials Carousel
                                                </a>
                                            </li>
                                            <li>
                                                <a href="gallery.html">
                                                    Gallery
                                                </a>
                                            </li>
                                            <li>
                                                <a href="gallery-carousel.html">
                                                    Gallery Carousel
                                                </a>
                                            </li>
                                            <li>
                                                <a href="faq.html">FAQs</a>
                                            </li>
                                            <li>
                                                <a href="404.html">404 Error</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li className="dropdown">
                                        <a href="#">Services</a>
                                        <ul className="shadow-box">
                                            <li>
                                                <a href="services.html">
                                                    Services
                                                </a>
                                            </li>
                                            <li>
                                                <a href="services-carousel.html">
                                                    Service Carousel
                                                </a>
                                            </li>
                                            <li>
                                                <a href="business-charter.html">
                                                    Business Charter
                                                </a>
                                            </li>
                                            <li>
                                                <a href="private-charter.html">
                                                    Private Charter
                                                </a>
                                            </li>
                                            <li>
                                                <a href="jet-rentals.html">
                                                    Jet Rentals
                                                </a>
                                            </li>
                                            <li>
                                                <a href="high-profile-people.html">
                                                    High Profile People
                                                </a>
                                            </li>
                                            <li>
                                                <a href="music-tours.html">
                                                    Music Tours
                                                </a>
                                            </li>
                                            <li>
                                                <a href="sports-teams.html">
                                                    Sports Teams
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li className="dropdown">
                                        <a href="#">News</a>
                                        <ul className="shadow-box">
                                            <li>
                                                <a href="news.html">News</a>
                                            </li>
                                            <li>
                                                <a href="news-carousel.html">
                                                    News Carousel
                                                </a>
                                            </li>
                                            <li>
                                                <a href="news-sidebar.html">
                                                    News Sidebar
                                                </a>
                                            </li>
                                            <li>
                                                <a href="news-details.html">
                                                    News Details
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li className="dropdown">
                                        <a href="#">Shop</a>
                                        <ul className="shadow-box">
                                            <li>
                                                <a href="products.html">
                                                    Products
                                                </a>
                                            </li>
                                            <li>
                                                <a href="product-details.html">
                                                    Product Details
                                                </a>
                                            </li>
                                            <li>
                                                <a href="cart.html">Cart</a>
                                            </li>
                                            <li>
                                                <a href="checkout.html">
                                                    Checkout
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact</a>
                                    </li>
                                </ul>
                            </div>
                            <div className="main-menu-three__right">
                                <div className="main-menu-three__search-cart-box">
                                    <div className="main-menu-three__search-box">
                                        <a
                                            href="#"
                                            className="main-menu-three__search search-toggler icon-magnifying-glass"
                                        />
                                    </div>
                                    <div className="main-menu-three__cart-box">
                                        <a
                                            href="cart.html"
                                            className="main-menu-three__cart icon-shopping-cart"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div className="stricky-header stricked-menu main-menu main-menu-three">
                <div className="sticky-header__content" />
                {/* /.sticky-header__content */}
            </div>
            {/* /.stricky-header */}
        </>
    );
}
