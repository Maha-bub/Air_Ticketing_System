import React from "react";
import { Head, Link } from "@inertiajs/react";
import Header from "@/Components/Parts/Header";
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from "@/Components/Parts/Footer";

export default function Confirmation({ booking }) {
    return (
        <>
            <Head title="Booking Confirmed" />
            <Header />

            <PageHeader title="Booking Confirmed" crumb="Confirmation" />

            <section className="cart-page">
                <div className="container">
                    <div className="alert alert-success">
                        Your booking is confirmed! A copy of your e-ticket is available below.
                    </div>

                    <div className="p-4" style={{ border: "1px solid #eee", borderRadius: 8, maxWidth: 640 }}>
                        <h3 className="mb-3">Booking Reference: {booking.pnr}</h3>

                        <p className="mb-1"><strong>Passenger:</strong> {booking.passenger_name}</p>
                        <p className="mb-1"><strong>Email:</strong> {booking.passenger_email}</p>
                        <p className="mb-3"><strong>Phone:</strong> {booking.passenger_phone}</p>

                        <hr />

                        <p className="mb-1">
                            <strong>{booking.schedule.flight_number}</strong> &middot; {booking.schedule.airline}
                        </p>
                        <p className="mb-1">
                            {booking.schedule.origin.city} ({booking.schedule.origin.code}) &rarr;{" "}
                            {booking.schedule.destination.city} ({booking.schedule.destination.code})
                        </p>
                        <p className="mb-1">
                            Departure: {booking.schedule.departure_time} &middot; Arrival: {booking.schedule.arrival_time}
                        </p>
                        <p className="mb-3">Aircraft: {booking.schedule.airplane ?? "—"}</p>

                        <hr />

                        <p className="mb-1"><strong>Seats:</strong> {booking.seats.join(", ")}</p>
                        <p className="mb-1"><strong>Payment method:</strong> {booking.payment_method}</p>
                        {booking.payment_status && (
                            <p className="mb-1">
                                <strong>Payment status:</strong>{" "}
                                {booking.payment_status === "paid"
                                    ? "Paid"
                                    : booking.payment_status === "pay_at_counter"
                                    ? "Pay at counter"
                                    : booking.payment_status}
                                {booking.payment_transaction_id && ` (Ref: ${booking.payment_transaction_id})`}
                            </p>
                        )}
                        <p className="mb-1">
                            <strong>Total paid:</strong> ৳{booking.total_amount.toLocaleString()}
                        </p>
                        <p className="mb-3 text-muted" style={{ fontSize: 13 }}>
                            Booked on {booking.booked_at}
                        </p>

                        <a href={`/booking/${booking.id}/ticket`} className="thm-btn">
                            Download E-Ticket (PDF)
                        </a>
                    </div>
                </div>
            </section>

            <Footer />
        </>
    );
}
