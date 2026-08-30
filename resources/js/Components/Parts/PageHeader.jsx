import React from "react";
import { Link } from "@inertiajs/react";
import cloudShape from "../../../../public/frontend-assets/images/backgrounds/cloud-1.png";
import planeShape from "../../../../public/frontend-assets/images/resources/main-slider-three-img-1.png";

/**
 * Shared, animated hero/banner used at the top of every inner page
 * (About, Contact, Flights, Cart, Checkout, ...). Mirrors the homepage
 * Hero's look — background image + floating decorative shapes — so every
 * page feels like part of the same site instead of a plain title bar.
 *
 * @param {string} title      Big heading text.
 * @param {string} crumb      Last breadcrumb item (current page name).
 */
export default function PageHeader({ title, crumb }) {
    return (
        <section className="page-header">
            <div
                className="page-header-bg"
                style={{ backgroundImage: "url(/frontend-assets/images/backgrounds/page-header-bg.jpg)" }}
            />
            <div className="page-header__shape-1 float-bob-x" aria-hidden="true">
                <img src={cloudShape} alt="" />
            </div>
            <div className="page-header__shape-2 float-bob-y" aria-hidden="true">
                <img src={planeShape} alt="" />
            </div>
            <div className="container">
                <div className="page-header__inner">
                    <h2>{title}</h2>
                    <ul className="thm-breadcrumb list-unstyled">
                        <li>
                            <Link href="/">Home</Link>
                        </li>
                        <li>
                            <span>/</span>
                        </li>
                        <li>{crumb}</li>
                    </ul>
                </div>
            </div>
        </section>
    );
}
