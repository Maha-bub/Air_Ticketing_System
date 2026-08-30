import React from "react";
import { Head, Link } from "@inertiajs/react";
import Header from "@/Components/Parts/Header";
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from "@/Components/Parts/Footer";

export default function Destinations({ destinations = [] }) {
    return (
        <>
            <Head title="Destinations" />
            <Header />

            <PageHeader title="Destinations" crumb="Destinations" />

            <section className="cart-page">
                <div className="container">
                    {destinations.length === 0 ? (
                        <div className="alert alert-info">
                            No flight schedules are published yet. Please check back soon.
                        </div>
                    ) : (
                        <div className="row">
                            {destinations.map((flight) => (
                                <div className="col-lg-4 col-md-6 mb-4" key={flight.id}>
                                    <div className="p-3 h-100" style={{ border: "1px solid #eee", borderRadius: 8 }}>
                                        <h4 className="mb-2">
                                            {flight.origin.city} &rarr; {flight.destination.city}
                                        </h4>
                                        <p className="mb-1 text-muted" style={{ fontSize: 13 }}>
                                            {flight.flight_number} &middot; {flight.airline}
                                        </p>
                                        <p className="mb-1">
                                            Departure: {flight.departure_time} &middot; Arrival: {flight.arrival_time}
                                        </p>
                                        <p className="mb-1">Runs: {flight.days_of_operation}</p>
                                        <p className="mb-3">
                                            {flight.available_seats === null
                                                ? "Seat map not configured yet"
                                                : flight.available_seats > 0
                                                ? `${flight.available_seats} / ${flight.total_seats} seats left`
                                                : "Sold out"}
                                        </p>
                                        <div className="d-flex justify-content-between align-items-center">
                                            <strong>৳{flight.price.toLocaleString()}</strong>
                                            {flight.available_seats > 0 ? (
                                                <Link href={`/flights/${flight.id}/seats`} className="thm-btn">
                                                    Select Seats
                                                </Link>
                                            ) : (
                                                <button className="thm-btn" disabled>
                                                    Unavailable
                                                </button>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </section>

            <Footer />
        </>
    );
}
