import React, { useState } from "react";
import { router } from "@inertiajs/react";

import getFlightsShape3 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-3.png";
import getFlightsShape4 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-4.png";
import getFlightsShape1 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-1.png";
import getFlightsShape2 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-2.png";

/**
 * Homepage "Search & book a flight" widget.
 *
 * This is a plain, fully-native HTML form (no jQuery/nice-select2 plugin) —
 * every field is a regular controlled React <select>/<input>, so there is
 * nothing that can silently fail to wire up. Submitting runs a real
 * database-backed search (FrontendController::searchFlights) and lands the
 * passenger on /flights with the matching results.
 */
export default function Booking({ airports = [] }) {
    const [from, setFrom] = useState("");
    const [to, setTo] = useState("");
    const [date, setDate] = useState("");
    const [passengers, setPassengers] = useState(1);
    const [submitting, setSubmitting] = useState(false);

    function handleSearch(e) {
        e.preventDefault();
        setSubmitting(true);

        router.get(
            "/flights",
            {
                from: from || undefined,
                to: to || undefined,
                date: date || undefined,
                passengers,
            },
            {
                onFinish: () => setSubmitting(false),
            }
        );
    }

    return (
      <section className="get-flight-two">
  <div className="get-flight-two__shape-3 zoom-fade-2">
    <img src={getFlightsShape3} alt="" />
  </div>
  <div className="get-flight-two__shape-4 float-bob-x">
    <img src={getFlightsShape4} alt="" />
  </div>
  <div className="container">
    <div className="get-flight-two__content-box">
      <div className="get-flight-two__shape-2 wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
        <img src={getFlightsShape2} alt="" className="float-bob-y" />
      </div>
      <div className="get-flight-two__inner">
        <div className="get-flight-two__shape-1 float-bob-x">
          <img src={getFlightsShape1} alt="" />
        </div>
        <div className="section-title text-left">
          <span className="section-title__tagline">Get your flight</span>
          <h2 className="section-title__title">Search &amp; book a flight</h2>
        </div>
        <form onSubmit={handleSearch} className="get-flight__form">
          <div className="row">
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <select
                  className="native-select"
                  value={from}
                  onChange={(e) => setFrom(e.target.value)}
                  aria-label="Fly from"
                >
                  <option value="">Fly from (any city)</option>
                  {airports.map((airport) => (
                    <option key={airport.id} value={airport.city}>
                      {airport.city} ({airport.code})
                    </option>
                  ))}
                </select>
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <select
                  className="native-select"
                  value={to}
                  onChange={(e) => setTo(e.target.value)}
                  aria-label="Fly to"
                >
                  <option value="">Fly to (any city)</option>
                  {airports.map((airport) => (
                    <option key={airport.id} value={airport.city}>
                      {airport.city} ({airport.code})
                    </option>
                  ))}
                </select>
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <input
                  type="date"
                  name="date"
                  aria-label="Select date"
                  value={date}
                  onChange={(e) => setDate(e.target.value)}
                />
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <select
                  className="native-select"
                  value={passengers}
                  onChange={(e) => setPassengers(Number(e.target.value))}
                  aria-label="Passengers"
                >
                  <option value={1}>1 Passenger</option>
                  <option value={2}>2 Passengers</option>
                  <option value={3}>3 Passengers</option>
                  <option value={4}>4 Passengers</option>
                </select>
              </div>
            </div>
            <div className="col-xl-12">
              <div className="get-flight__form-input-box">
                <button type="submit" className="thm-btn get-flight__btn" disabled={submitting}>
                  {submitting ? "Searching..." : "Search Flights"}
                </button>
              </div>
            </div>
          </div>
        </form>
        <p className="get-flight__content-text">
          <span>*</span> Prices and seat availability are pulled live from
          our current flight schedules.
        </p>
      </div>
    </div>
  </div>
</section>
    );
}
