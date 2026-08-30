import React, { useMemo, useState } from "react";
import { Head, Link, router, usePage } from "@inertiajs/react";
import Header from "@/Components/Parts/Header";
import PageHeader from "@/Components/Parts/PageHeader";
import Footer from "@/Components/Parts/Footer";

export default function SeatMap({ schedule, airplane, seats = [], bookedSeats = [], passengers = 1 }) {
    const { props } = usePage();
    const flashError = props?.flash?.error;

    const [selected, setSelected] = useState([]);
    const bookedSet = useMemo(() => new Set(bookedSeats), [bookedSeats]);

    const rows = useMemo(() => {
        const grouped = {};
        seats.forEach((code) => {
            const row = code.match(/^\d+/)[0];
            grouped[row] = grouped[row] || [];
            grouped[row].push(code);
        });
        return Object.keys(grouped)
            .sort((a, b) => Number(a) - Number(b))
            .map((row) => grouped[row]);
    }, [seats]);

    const leftCount = Math.ceil(airplane.seat_columns / 2);

    function toggleSeat(code) {
        if (bookedSet.has(code)) return;

        setSelected((prev) => {
            if (prev.includes(code)) {
                return prev.filter((s) => s !== code);
            }
            if (prev.length >= passengers) {
                return prev; // already picked enough seats for the passenger count
            }
            return [...prev, code];
        });
    }

    function handleBookNow() {
        if (selected.length === 0) return;

        router.post(`/flights/${schedule.id}/seats`, { seats: selected });
    }

    return (
        <>
            <Head title="Select Seats" />
            <Header />

            <PageHeader title="Select Your Seats" crumb="Seat Selection" />

            <section className="cart-page">
                <div className="container">
                    {flashError && <div className="alert alert-danger">{flashError}</div>}

                    <div className="row">
                        <div className="col-lg-4 order-lg-2 mb-4">
                            <div className="p-3" style={{ border: "1px solid #eee", borderRadius: 8 }}>
                                <h4 className="mb-3">{schedule.flight_number}</h4>
                                <p className="mb-1">
                                    {schedule.origin.city} ({schedule.origin.code}) &rarr;{" "}
                                    {schedule.destination.city} ({schedule.destination.code})
                                </p>
                                <p className="mb-1">Departure: {schedule.departure_time}</p>
                                <p className="mb-1">Arrival: {schedule.arrival_time}</p>
                                <p className="mb-1">Aircraft: {airplane.name}</p>
                                <p className="mb-3">Price per seat: ৳{schedule.price.toLocaleString()}</p>

                                <hr />

                                <p className="mb-1">
                                    Passengers: <strong>{passengers}</strong>
                                </p>
                                <p className="mb-1">
                                    Selected seats:{" "}
                                    <strong>{selected.length > 0 ? selected.join(", ") : "none yet"}</strong>
                                </p>
                                <p className="mb-3">
                                    Total: <strong>৳{(schedule.price * selected.length).toLocaleString()}</strong>
                                </p>

                                <button
                                    type="button"
                                    className="thm-btn w-100"
                                    disabled={selected.length === 0}
                                    onClick={handleBookNow}
                                >
                                    Book Now
                                </button>
                            </div>
                        </div>

                        <div className="col-lg-8 order-lg-1">
                            <div className="mb-3 d-flex gap-3" style={{ display: "flex", gap: "16px" }}>
                                <LegendDot color="#e5e5e5" label="Available" />
                                <LegendDot color="#d4a017" label="Selected" />
                                <LegendDot color="#9e9e9e" label="Booked" />
                            </div>

                            <div style={{ overflowX: "auto" }}>
                                <div style={{ display: "inline-block", minWidth: 280 }}>
                                    {rows.map((row, i) => (
                                        <div
                                            key={i}
                                            style={{ display: "flex", justifyContent: "center", marginBottom: 8 }}
                                        >
                                            {row.map((code, colIndex) => (
                                                <React.Fragment key={code}>
                                                    <SeatButton
                                                        code={code}
                                                        booked={bookedSet.has(code)}
                                                        selected={selected.includes(code)}
                                                        onClick={() => toggleSeat(code)}
                                                    />
                                                    {colIndex === leftCount - 1 && (
                                                        <div style={{ width: 24 }} />
                                                    )}
                                                </React.Fragment>
                                            ))}
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <Footer />
        </>
    );
}

function LegendDot({ color, label }) {
    return (
        <span style={{ display: "inline-flex", alignItems: "center", gap: 6 }}>
            <span
                style={{
                    display: "inline-block",
                    width: 14,
                    height: 14,
                    borderRadius: 4,
                    background: color,
                }}
            />
            {label}
        </span>
    );
}

function SeatButton({ code, booked, selected, onClick }) {
    let background = "#e5e5e5";
    if (booked) background = "#9e9e9e";
    if (selected) background = "#d4a017";

    return (
        <button
            type="button"
            title={code}
            disabled={booked}
            onClick={onClick}
            style={{
                width: 34,
                height: 34,
                margin: 3,
                borderRadius: 6,
                border: "none",
                background,
                color: booked ? "#fff" : "#333",
                fontSize: 11,
                cursor: booked ? "not-allowed" : "pointer",
            }}
        >
            {code}
        </button>
    );
}
