import React from "react";
import getFlights from "../../../../public/frontend-assets/images/resources/get-flight-img-1.png";
import getFlightsShape1 from "../../../../public/frontend-assets/images/shapes/get-flight-shape-1.png";
import getFlightsShape2 from "../../../../public/frontend-assets/images/shapes/get-flight-shape-2.png";

import { useEffect } from "react";

export default function Booking() {
    
    useEffect(() => {
        if ($.fn.niceSelect) {
            $(".wide").niceSelect();
        }
    }, []);
    return (
        <>
            {/*Get Flight Start*/}
            <section className="get-flight">
                <div className="get-flight-img">
                    <img src={getFlights} alt />
                </div>
                <div className="get-flight__shape-1 float-bob-x">
                    <img src={getFlightsShape1} alt />
                </div>
                <div className="get-flight__shape-2 float-bob-x">
                    <img src={getFlightsShape2} alt />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xl-8">
                            <div className="get-flight__content-box">
                                <div className="section-title text-left">
                                    <span className="section-title__tagline">
                                        Get your flight
                                    </span>
                                    <h2 className="section-title__title">
                                        Request for private flight
                                    </h2>
                                </div>
                                <form
                                    action="assets/inc/sendemail.php"
                                    className="get-flight__form contact-form-validated"
                                    noValidate="novalidate"
                                >
                                    <div className="row">
                                        <div className="col-xl-6 col-lg-6">
                                            <div className="get-flight__form-input-box">
                                                <input
                                                    type="text"
                                                    placeholder="Fly from"
                                                />
                                            </div>
                                        </div>
                                        <div className="col-xl-6 col-lg-6">
                                            <div className="get-flight__form-input-box">
                                                <input
                                                    type="text"
                                                    placeholder="Fly to"
                                                />
                                            </div>
                                        </div>
                                        <div className="col-xl-6 col-lg-6">
                                            <div className="get-flight__form-input-box">
                                                <input
                                                    type="text"
                                                    name="date"
                                                    placeholder="Select date"
                                                    id="datepicker"
                                                />
                                                <div className="get-flight__icon-box">
                                                    <i className="far fa-calendar-alt" />
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-xl-6 col-lg-6">
                                            <div className="row">
                                                {/* Time */}
                                                <div className="col-xl-6 col-lg-6">
                                                    <div className="get-flight__form-input-box">
                                                        <input
                                                            type="text"
                                                            name="time"
                                                            placeholder="Select time"
                                                        />
                                                    </div>
                                                </div>

                                                {/* Passengers */}
                                                <div className="col-xl-6 col-lg-6">
                                                    <div className="get-flight__form-input-box">
                                                        <div className="select-box">
                                                            <select className="wide">
                                                                <option data-display="Select passengers">
                                                                    Passengers
                                                                </option>
                                                                <option value="1">
                                                                    Passengers
                                                                    01
                                                                </option>
                                                                <option value="2">
                                                                    Passengers
                                                                    02
                                                                </option>
                                                                <option value="3">
                                                                    Passengers
                                                                    03
                                                                </option>
                                                                <option value="4">
                                                                    Passengers
                                                                    04
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {/* Baggage */}
                                        <div className="col-xl-6 col-lg-6">
                                            <div className="get-flight__form-input-box">
                                                <div className="select-box">
                                                    <select className="wide">
                                                        <option data-display="Select baggage">
                                                            Select baggage
                                                        </option>
                                                        <option value="1">
                                                            Select baggage 01
                                                        </option>
                                                        <option value="2">
                                                            Select baggage 02
                                                        </option>
                                                        <option value="3">
                                                            Select baggage 03
                                                        </option>
                                                        <option value="4">
                                                            Select baggage 04
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-xl-6 col-lg-6">
                                            <div className="get-flight__form-input-box">
                                                <button
                                                    type="submit"
                                                    className="thm-btn get-flight__btn"
                                                >
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p className="get-flight__content-text">
                                    {" "}
                                    <span>*</span> After sending request. We’ll
                                    contact you for more details about charter.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {/*Get Flight End*/}
        </>
    );
}
