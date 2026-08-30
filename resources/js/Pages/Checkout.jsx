import React from "react";
import { Head, Link, useForm } from "@inertiajs/react";
import Header from "@/Components/Parts/Header";
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from "@/Components/Parts/Footer";

export default function Checkout({ item, passenger }) {
    const { data, setData, post, processing, errors } = useForm({
        passenger_name: passenger?.name ?? "",
        passenger_email: passenger?.email ?? "",
        passenger_phone: "",
        payment_method: "cash_on_counter",
    });

    function submit(e) {
        e.preventDefault();
        post("/checkout");
    }

    return (
        <>
            <Head title="Checkout" />
            <Header />

            <PageHeader title="Checkout" crumb="Checkout" />

            <section className="checkout-page">
                <div className="container">
                    <div className="row">
                        <div className="col-xl-6 col-lg-6">
                            <div className="billing_details">
                                <div className="billing_title">
                                    <h2>Passenger details</h2>
                                </div>
                                <form className="billing_details_form" onSubmit={submit}>
                                    <div className="row bs-gutter-x-20">
                                        <div className="col-xl-12">
                                            <div className="billing_input_box">
                                                <input
                                                    type="text"
                                                    placeholder="Full name"
                                                    value={data.passenger_name}
                                                    onChange={(e) => setData("passenger_name", e.target.value)}
                                                    required
                                                />
                                                {errors.passenger_name && (
                                                    <small className="text-danger">{errors.passenger_name}</small>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-xl-12">
                                            <div className="billing_input_box">
                                                <input
                                                    type="email"
                                                    placeholder="Email address"
                                                    value={data.passenger_email}
                                                    onChange={(e) => setData("passenger_email", e.target.value)}
                                                    required
                                                />
                                                {errors.passenger_email && (
                                                    <small className="text-danger">{errors.passenger_email}</small>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-xl-12">
                                            <div className="billing_input_box">
                                                <input
                                                    type="tel"
                                                    placeholder="Phone number"
                                                    value={data.passenger_phone}
                                                    onChange={(e) => setData("passenger_phone", e.target.value)}
                                                    required
                                                />
                                                {errors.passenger_phone && (
                                                    <small className="text-danger">{errors.passenger_phone}</small>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div className="col-xl-6 col-lg-6">
                            <div className="your_order">
                                <h2>Your order</h2>
                                {item && (
                                    <>
                                        <div className="order_table_box">
                                            <table className="order_table_detail">
                                                <thead className="order_table_head">
                                                    <tr>
                                                        <th>Item</th>
                                                        <th className="right">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td className="pro__title">
                                                            {item.schedule.flight_number}: {item.schedule.origin.city} &rarr;{" "}
                                                            {item.schedule.destination.city}
                                                        </td>
                                                        <td className="pro__price">৳{item.unit_price.toLocaleString()}</td>
                                                    </tr>
                                                    <tr>
                                                        <td className="pro__title">Seats ({item.seat_count})</td>
                                                        <td className="pro__price">{item.seats.join(", ")}</td>
                                                    </tr>
                                                    <tr>
                                                        <td className="pro__title">Total</td>
                                                        <td className="pro__price">৳{item.total.toLocaleString()}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div className="checkout__payment">
                                            {[
                                                { key: "cash_on_counter", label: "Cash at counter" },
                                                { key: "bkash", label: "bKash" },
                                                { key: "card", label: "Credit / Debit card" },
                                            ].map((method) => (
                                                <div
                                                    key={method.key}
                                                    className={`checkout__payment__item ${
                                                        data.payment_method === method.key
                                                            ? "checkout__payment__item--active"
                                                            : ""
                                                    }`}
                                                    style={{ cursor: "pointer" }}
                                                    onClick={() => setData("payment_method", method.key)}
                                                >
                                                    <h3 className="checkout__payment__title">
                                                        <input
                                                            type="radio"
                                                            name="payment_method"
                                                            checked={data.payment_method === method.key}
                                                            onChange={() => setData("payment_method", method.key)}
                                                            style={{ marginRight: 8 }}
                                                        />
                                                        {method.label}
                                                    </h3>
                                                </div>
                                            ))}
                                        </div>

                                        <div className="text-right d-flex justify-content-end">
                                            <button
                                                type="button"
                                                className="thm-btn"
                                                disabled={processing}
                                                onClick={submit}
                                            >
                                                {processing ? "Placing order..." : "Place your order"}
                                            </button>
                                        </div>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <Footer />
        </>
    );
}
