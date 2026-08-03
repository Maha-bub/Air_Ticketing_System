import React from "react";
import { Head, Link, useForm } from "@inertiajs/react";
import Header from "@/Components/Parts/Header";
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from "@/Components/Parts/Footer";

export default function Checkout({ item, passenger, paymentSandbox }) {
    const { data, setData, post, processing, errors } = useForm({
        passenger_name: passenger?.name ?? "",
        passenger_email: passenger?.email ?? "",
        passenger_phone: "",
        payment_method: "cash_on_counter",
        card_holder: "",
        card_number: "",
        card_expiry: "",
        card_cvc: "",
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

                                        {data.payment_method === "card" && (
                                            <div className="checkout__card-form" style={{ marginTop: 20 }}>
                                                {paymentSandbox?.card && (
                                                    <p className="text-muted" style={{ fontSize: 13, marginBottom: 12 }}>
                                                        Sandbox mode &mdash; use test card{" "}
                                                        <strong>{paymentSandbox.card.success}</strong> (any future expiry, any CVC) to
                                                        simulate a successful payment, or{" "}
                                                        <strong>{paymentSandbox.card.decline}</strong> to simulate a decline.
                                                    </p>
                                                )}
                                                <div className="row bs-gutter-x-20">
                                                    <div className="col-xl-12">
                                                        <div className="billing_input_box">
                                                            <input
                                                                type="text"
                                                                placeholder="Cardholder name"
                                                                value={data.card_holder}
                                                                onChange={(e) => setData("card_holder", e.target.value)}
                                                            />
                                                            {errors.card_holder && (
                                                                <small className="text-danger">{errors.card_holder}</small>
                                                            )}
                                                        </div>
                                                    </div>
                                                    <div className="col-xl-12">
                                                        <div className="billing_input_box">
                                                            <input
                                                                type="text"
                                                                placeholder="Card number (e.g. 4242 4242 4242 4242)"
                                                                inputMode="numeric"
                                                                maxLength={24}
                                                                value={data.card_number}
                                                                onChange={(e) => setData("card_number", e.target.value)}
                                                            />
                                                            {errors.card_number && (
                                                                <small className="text-danger">{errors.card_number}</small>
                                                            )}
                                                        </div>
                                                    </div>
                                                    <div className="col-xl-6">
                                                        <div className="billing_input_box">
                                                            <input
                                                                type="text"
                                                                placeholder="MM/YY"
                                                                maxLength={5}
                                                                value={data.card_expiry}
                                                                onChange={(e) => setData("card_expiry", e.target.value)}
                                                            />
                                                            {errors.card_expiry && (
                                                                <small className="text-danger">{errors.card_expiry}</small>
                                                            )}
                                                        </div>
                                                    </div>
                                                    <div className="col-xl-6">
                                                        <div className="billing_input_box">
                                                            <input
                                                                type="text"
                                                                placeholder="CVC"
                                                                inputMode="numeric"
                                                                maxLength={4}
                                                                value={data.card_cvc}
                                                                onChange={(e) => setData("card_cvc", e.target.value)}
                                                            />
                                                            {errors.card_cvc && (
                                                                <small className="text-danger">{errors.card_cvc}</small>
                                                            )}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        )}

                                        {data.payment_method === "bkash" && paymentSandbox?.bkash && (
                                            <p className="text-muted" style={{ fontSize: 13, marginTop: 20 }}>
                                                {paymentSandbox.bkash.enabled
                                                    ? "You'll be redirected to bKash's sandbox checkout page to approve this payment, then brought back here automatically."
                                                    : "bKash sandbox isn't configured on the server yet, so this payment may not complete."}
                                            </p>
                                        )}

                                        {errors.payment && (
                                            <p className="text-danger" style={{ marginTop: 12 }}>{errors.payment}</p>
                                        )}

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
