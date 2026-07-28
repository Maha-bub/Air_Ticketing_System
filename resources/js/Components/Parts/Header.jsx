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

                                    </li>
                                    <li className="dropdown">
                                        <a href="#">Services</a>
                                    </li>
                                    <li>
                                        <a href="about.html">About Us</a>
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
               
            </div>
           
        </>
    );
}
