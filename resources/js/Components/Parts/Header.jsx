import React, { useMemo } from "react";
import { Link, usePage } from "@inertiajs/react";
import logo from "../../../../public/frontend-assets/images/resources/logo-2.png";

export default function Header({ transparent = false }) {
    const { props } = usePage();
    const user = props?.auth?.user ?? null;
    const cartCount = props?.cartCount ?? 0;
    const menuDestinations = props?.menuDestinations ?? [];

    const accountLink = useMemo(() => {
        if (!user) return null;
        if (user.role === "admin") return { href: "/admin/dashboard", label: "Admin Dashboard" };
        if (user.role === "agent") return { href: "/agent/dashboard", label: "Agent Dashboard" };
        if (user.role === "customer") return { href: "/customer/dashboard", label: "My Dashboard" };
        return { href: "/profile", label: "My Profile" };
    }, [user]);

    const loginHref = typeof route === "function" ? route("login") : "/login";

    return (
        <>
            <header className={`main-header-three${transparent ? "" : " main-header-three--solid"}`}>
                <div className="main-header-three__top">
                    <div className="main-header-three__top-inner">
                        <div className="main-header-three__top-left">
                            <ul className="list-unstyled main-header-three__contact-list">
                                <li>
                                    <div className="icon">
                                        <i className="fas fa-map-marker-alt" />
                                    </div>
                                    <div className="text">
                                        <p>Dhaka, Bangladesh</p>
                                    </div>
                                </li>
                                <li>
                                    <div className="icon">
                                        <i className="fas fa-envelope" />
                                    </div>
                                    <div className="text">
                                        <p>
                                            <a href="mailto:needhelp@airticket.com">
                                                needhelp@airticket.com
                                            </a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div className="main-header-three__top-right">
                            <div className="main-header-three__social">
                                <a href="#"><i className="fab fa-twitter" /></a>
                                <a href="#"><i className="fab fa-facebook" /></a>
                                <a href="#"><i className="fab fa-pinterest-p" /></a>
                                <a href="#"><i className="fab fa-instagram" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <nav className="main-menu main-menu-three">
                    <div className="main-menu-three__wrapper">
                        <div className="main-menu-three__wrapper-inner">
                            <div className="main-menu-three__left">
                                <div className="main-menu-three__logo">
                                    <Link href="/">
                                        <img src={logo} alt="logo" />
                                    </Link>
                                </div>
                            </div>
                            <div className="main-menu-three__main-menu-box">
                                <a href="#" className="mobile-nav__toggler">
                                    <i className="fa fa-bars" />
                                </a>
                                <ul className="main-menu__list">
                                    <li className="dropdown current">
                                        <Link href="/">Home</Link>
                                    </li>
                                    <li className="dropdown">
                                        <a href="#">Destinations</a>
                                        {menuDestinations.length > 0 && (
                                            <ul>
                                                {menuDestinations.map((airport) => (
                                                    <li key={airport.id}>
                                                        <Link href={`/flights?to=${encodeURIComponent(airport.city)}`}>
                                                            {airport.city} ({airport.code})
                                                        </Link>
                                                    </li>
                                                ))}
                                                <li>
                                                    <Link href="/destinations">View all destinations</Link>
                                                </li>
                                            </ul>
                                        )}
                                    </li>
                                    <li>
                                        <Link href="/flights">Flights</Link>
                                    </li>
                                    <li>
                                        <Link href="/about">About Us</Link>
                                    </li>
                                    <li>
                                        <Link href="/contact">Contact</Link>
                                    </li>
                                    {user ? (
                                        <li className="dropdown">
                                            <a href="#">{user.name}</a>
                                            <ul>
                                                {accountLink && (
                                                    <li>
                                                        <Link href={accountLink.href}>{accountLink.label}</Link>
                                                    </li>
                                                )}
                                                <li>
                                                    <Link href="/profile">Account Settings</Link>
                                                </li>
                                                <li>
                                                    <Link href="/logout" method="post" as="button">
                                                        Logout
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>
                                    ) : (
                                        <li>
                                            <Link href={loginHref}>Login</Link>
                                        </li>
                                    )}
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
                                        <Link
                                            href="/cart"
                                            className="main-menu-three__cart icon-shopping-cart"
                                            style={{ position: "relative" }}
                                        >
                                            {cartCount > 0 && (
                                                <span
                                                    style={{
                                                        position: "absolute",
                                                        top: "-8px",
                                                        right: "-10px",
                                                        background: "#d4a017",
                                                        color: "#fff",
                                                        borderRadius: "50%",
                                                        width: "18px",
                                                        height: "18px",
                                                        fontSize: "11px",
                                                        lineHeight: "18px",
                                                        textAlign: "center",
                                                    }}
                                                >
                                                    {cartCount}
                                                </span>
                                            )}
                                        </Link>
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
