import React, { useRef } from "react";
import { Link } from "@inertiajs/react";
import shape1 from "../../../../public/frontend-assets/images/shapes/destination-three-shape-1.png";
import destinationFallback1 from "../../../../public/frontend-assets/images/Lufthansa 747.webp";
import destinationFallback2 from "../../../../public/frontend-assets/images/boeing-us.webp";
import destinationFallback3 from "../../../../public/frontend-assets/images/us-bangla-1.jpg";
import destinationFallback4 from "../../../../public/frontend-assets/images/us_bngla_2.jpg";

const fallbackImages = [destinationFallback1, destinationFallback2, destinationFallback3, destinationFallback4];

/**
 * "Popular charter destinations" — real, database-backed flight schedules.
 *
 * A plain, dependency-free carousel: horizontal scroll + CSS scroll-snap,
 * moved by prev/next buttons calling native scrollBy(). No JS library
 * (owl.carousel etc.) is ever allowed to hide these cards by default —
 * everything here is visible from the very first paint, same approach as
 * the Charter section carousel.
 */
export default function Destinations({ destinations = [] }) {
    const trackRef = useRef(null);
    const animatingRef = useRef(false);

    function easeInOutQuad(t) {
        return t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
    }

    function animateScrollTo(track, targetLeft, duration = 420) {
        const startLeft = track.scrollLeft;
        const distance = targetLeft - startLeft;
        const startTime = performance.now();

        function step(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            track.scrollLeft = startLeft + distance * easeInOutQuad(progress);

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                animatingRef.current = false;
            }
        }

        animatingRef.current = true;
        requestAnimationFrame(step);
    }

    function scrollByCard(direction) {
        const track = trackRef.current;
        if (!track || animatingRef.current) return;

        const card = track.querySelector(".destination-card__slide");
        const cardWidth = card ? card.getBoundingClientRect().width + 30 : 300;
        const maxScroll = track.scrollWidth - track.clientWidth;
        const target = Math.max(0, Math.min(maxScroll, track.scrollLeft + direction * cardWidth));

        animateScrollTo(track, target);
    }

    return (
        <>
            {/*destination Three Start*/}
            <section className="destination-three">
                <div className="destination-three__shape-1 float-bob-y">
                    <img src={shape1} alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xl-4">
                            <div className="destination-three__left">
                                <div className="section-title text-left">
                                    <span className="section-title__tagline">
                                        What will you get
                                    </span>
                                    <h2 className="section-title__title">
                                        Popular charter destinations
                                    </h2>
                                </div>
                                <p className="destination-three__text">
                                    Real routes, real prices, pulled straight
                                    from our current flight schedules — pick
                                    a destination and start booking.
                                </p>
                            </div>
                        </div>
                        <div className="col-xl-8">
                            <div className="destination-three__right">
                                {destinations.length === 0 ? (
                                    <p className="destination-three__text">
                                        No flight schedules are published yet.
                                        Please check back soon.
                                    </p>
                                ) : (
                                    <div style={{ position: "relative" }}>
                                        <div
                                            ref={trackRef}
                                            className="thm-carousel-track"
                                            style={{
                                                display: "flex",
                                                gap: "30px",
                                                overflowX: "auto",
                                                scrollSnapType: "x mandatory",
                                                paddingBottom: "10px",
                                            }}
                                        >
                                            {destinations.map((flight, index) => (
                                                <Link
                                                    key={flight.id}
                                                    href={`/flights/${flight.id}/seats`}
                                                    className="destination-card__slide"
                                                    style={{
                                                        flex: "0 0 min(280px, 80vw)",
                                                        scrollSnapAlign: "start",
                                                        display: "block",
                                                        borderRadius: "8px",
                                                        overflow: "hidden",
                                                        textDecoration: "none",
                                                        boxShadow: "0 4px 16px rgba(0,0,0,0.08)",
                                                        background: "#fff",
                                                        transition: "transform 300ms ease, box-shadow 300ms ease",
                                                    }}
                                                    onMouseEnter={(e) => {
                                                        e.currentTarget.style.transform = "translateY(-6px)";
                                                        e.currentTarget.style.boxShadow = "0 10px 24px rgba(0,0,0,0.15)";
                                                    }}
                                                    onMouseLeave={(e) => {
                                                        e.currentTarget.style.transform = "translateY(0)";
                                                        e.currentTarget.style.boxShadow = "0 4px 16px rgba(0,0,0,0.08)";
                                                    }}
                                                >
                                                    <div style={{ height: "180px", overflow: "hidden" }}>
                                                        <img
                                                            src={fallbackImages[index % fallbackImages.length]}
                                                            alt={`${flight.origin.city} - ${flight.destination.city}`}
                                                            style={{
                                                                width: "100%",
                                                                height: "100%",
                                                                objectFit: "cover",
                                                                display: "block",
                                                            }}
                                                        />
                                                    </div>
                                                    <div
                                                        style={{
                                                            backgroundColor: "#123821",
                                                            padding: "20px 24px",
                                                            color: "#fff",
                                                        }}
                                                    >
                                                        <h3
                                                            style={{
                                                                fontSize: "20px",
                                                                fontWeight: 700,
                                                                color: "#fff",
                                                                marginBottom: "10px",
                                                            }}
                                                        >
                                                            {flight.origin.city} - {flight.destination.city}
                                                        </h3>
                                                        <div
                                                            style={{
                                                                display: "flex",
                                                                gap: "20px",
                                                                fontSize: "14px",
                                                                color: "#cfd8d2",
                                                                marginBottom: "8px",
                                                            }}
                                                        >
                                                            <span>
                                                                Departure: <strong style={{ color: "#a79132" }}>{flight.departure_time}</strong>
                                                            </span>
                                                            <span>
                                                                Arrival: <strong style={{ color: "#a79132" }}>{flight.arrival_time}</strong>
                                                            </span>
                                                        </div>
                                                        <p style={{ color: "#cfd8d2", margin: 0, fontSize: "14px" }}>
                                                            From <strong style={{ color: "#fff" }}>৳{flight.price.toLocaleString()}</strong>
                                                            {" · "}
                                                            {flight.available_seats ?? "?"} seats left
                                                        </p>
                                                    </div>
                                                </Link>
                                            ))}
                                        </div>

                                        <button
                                            type="button"
                                            onClick={() => scrollByCard(-1)}
                                            aria-label="Previous"
                                            className="thm-carousel-arrow thm-carousel-arrow--prev"
                                        >
                                            <i className="fa fa-angle-left" />
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => scrollByCard(1)}
                                            aria-label="Next"
                                            className="thm-carousel-arrow thm-carousel-arrow--next"
                                        >
                                            <i className="fa fa-angle-right" />
                                        </button>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {/*destination Three End*/}
        </>
    );
}
