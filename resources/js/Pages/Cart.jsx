import React from "react";
import { Head, Link, router, usePage } from "@inertiajs/react";
import Header from "@/Components/Parts/Header";
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from "@/Components/Parts/Footer";

export default function Cart({ item }) {
    const { props } = usePage();
    const flashError = props?.flash?.error;

    function removeItem() {
        router.delete("/cart");
    }

    return (
        <>
            <Head title="Cart" />
            <Header />

            <PageHeader title="Cart" crumb="Cart" />

            <section className="cart-page">
                <div className="container">
                    {flashError && <div className="alert alert-danger">{flashError}</div>}

                    {!item ? (
                        <div className="alert alert-info">
                            Your cart is empty. <Link href="/flights">Search for a flight</Link> to get started.
                        </div>
                    ) : (
                        <>
                            <div className="table-responsive">
                                <table className="table cart-table">
                                    <thead>
                                        <tr>
                                            <th>Flight</th>
                                            <th>Seats</th>
                                            <th>Price / Seat</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div className="product-box">
                                                    <h3>
                                                        {item.schedule.flight_number} &middot;{" "}
                                                        {item.schedule.origin.city} &rarr; {item.schedule.destination.city}
                                                    </h3>
                                                    <p className="text-muted mb-0" style={{ fontSize: 13 }}>
                                                        {item.schedule.departure_time} - {item.schedule.arrival_time}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>{item.seats.join(", ")}</td>
                                            <td>৳{item.unit_price.toLocaleString()}</td>
                                            <td>৳{item.total.toLocaleString()}</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    className="cross-icon"
                                                    style={{ border: "none", background: "none" }}
                                                    onClick={removeItem}
                                                    title="Remove"
                                                >
                                                    <i className="icon-close remove-icon" />
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="row">
                                <div className="col-xl-4 col-lg-5 offset-xl-8 offset-lg-7">
                                    <ul className="cart-total list-unstyled">
                                        <li>
                                            <span>Seats</span>
                                            <span>{item.seat_count}</span>
                                        </li>
                                        <li>
                                            <span>Total</span>
                                            <span className="cart-total-amount">৳{item.total.toLocaleString()}</span>
                                        </li>
                                    </ul>
                                    <div className="cart-page__buttons">
                                        <div className="cart-page__buttons-2">
                                            <Link href="/checkout" className="thm-btn">
                                                Proceed to Checkout
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </>
                    )}
                </div>
            </section>

            <Footer />
        </>
    );
}
