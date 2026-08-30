import React from "react";
import { Head, Link, router } from "@inertiajs/react";
import Header from "@/Components/Parts/Header";
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from "@/Components/Parts/Footer";

export default function Flights({ results = [], filters = {} }) {
    function clearFilters() {
        router.get("/flights");
    }

    return (
        <>
            <Head title="Search Flights" />
            <Header />

            <PageHeader title="Search Results" crumb="Flights" />

            <section className="cart-page">
                <div className="container">
                    {(filters.from || filters.to || filters.date) && (
                        <p className="mb-4">
                            Showing flights
                            {filters.from ? <> from <strong>{filters.from}</strong></> : null}
                            {filters.to ? <> to <strong>{filters.to}</strong></> : null}
                            {filters.date ? <> on <strong>{filters.date}</strong></> : null}
                            {filters.passengers ? <> for <strong>{filters.passengers}</strong> passenger(s)</> : null}
                            {" "}
                            <button type="button" className="btn btn-link p-0" onClick={clearFilters}>
                                (clear filters)
                            </button>
                        </p>
                    )}

                    {results.length === 0 ? (
                        <div className="alert alert-info">
                            No flights matched your search. Try a different route, or{" "}
                            <Link href="/flights">browse all available flights</Link>.
                        </div>
                    ) : (
                        <div className="table-responsive">
                            <table className="table cart-table">
                                <thead>
                                    <tr>
                                        <th>Flight</th>
                                        <th>Route</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Seats Left</th>
                                        <th>Price</th>
                                        <th />
                                    </tr>
                                </thead>
                                <tbody>
                                    {results.map((flight) => (
                                        <tr key={flight.id}>
                                            <td>
                                                <strong>{flight.flight_number}</strong>
                                                <div className="text-muted" style={{ fontSize: "13px" }}>
                                                    {flight.airline} · {flight.airplane ?? "Airplane TBA"}
                                                </div>
                                            </td>
                                            <td>
                                                {flight.origin.city} ({flight.origin.code}) &rarr;{" "}
                                                {flight.destination.city} ({flight.destination.code})
                                            </td>
                                            <td>{flight.departure_time}</td>
                                            <td>{flight.arrival_time}</td>
                                            <td>
                                                {flight.available_seats === null ? (
                                                    <span className="text-muted">—</span>
                                                ) : flight.available_seats > 0 ? (
                                                    `${flight.available_seats} / ${flight.total_seats}`
                                                ) : (
                                                    <span className="text-danger">Sold out</span>
                                                )}
                                            </td>
                                            <td>৳{flight.price.toLocaleString()}</td>
                                            <td>
                                                {flight.available_seats > 0 ? (
                                                    <Link
                                                        href={`/flights/${flight.id}/seats${
                                                            filters.passengers ? `?passengers=${filters.passengers}` : ""
                                                        }`}
                                                        className="thm-btn thm-btn--sm"
                                                    >
                                                        Select Seats
                                                    </Link>
                                                ) : (
                                                    <button className="thm-btn thm-btn--sm" disabled>
                                                        Sold out
                                                    </button>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    )}
                </div>
            </section>

            <Footer />
        </>
    );
}
