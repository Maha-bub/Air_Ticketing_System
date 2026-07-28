import React, { useEffect, useRef } from "react";

import getFlightsShape3 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-3.png";
import getFlightsShape4 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-4.png";
import getFlightsShape1 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-1.png";
import getFlightsShape2 from "../../../../public/frontend-assets/images/shapes/get-flight-two-shape-2.png";

import NiceSelect from "nice-select2";
import "nice-select2/dist/css/nice-select2.css"; // <-- এই লাইনটা ছিল না, এইটাই মূল সমস্যা

export default function Booking() {
    const formRef = useRef(null);

    useEffect(() => {
        const selects = formRef.current.querySelectorAll("select.wide");
        const niceSelects = [];

        selects.forEach((select) => {
            // StrictMode / re-mount এ ডাবল init আটকানোর জন্য গার্ড
            if (select.dataset.niceSelectInit) return;
            select.dataset.niceSelectInit = "true";

            const niceSelect = new NiceSelect(select, {
                searchable: false,
            });
            niceSelects.push(niceSelect);
        });

        return () => {
            niceSelects.forEach((select) => {
                if (select && typeof select.destroy === "function") {
                    select.destroy();
                }
            });
        };
    }, []);

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
          <h2 className="section-title__title">Request for private flight</h2>
        </div>
        <form ref={formRef} action="assets/inc/sendemail.php" className="get-flight__form contact-form-validated" noValidate="novalidate">
          <div className="row">
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <input type="text" placeholder="Fly from" />
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <input type="text" placeholder="Fly to" />
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <input type="text" name="date" placeholder="Select date" id="datepicker" />
                <div className="get-flight__icon-box">
                  <i className="far fa-calendar-alt" />
                </div>
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="row">
                <div className="col-xl-6 col-lg-6">
                  <div className="get-flight__form-input-box">
                    <input type="text" name="time" placeholder="Select time" />
                  </div>
                </div>
                <div className="col-xl-6 col-lg-6">
                  <div className="get-flight__form-input-box">
                    <div className="select-box">
                      <select className="wide">
                        <option value="" disabled selected>Passengers</option>
                        <option value={1}>Passengers 01</option>
                        <option value={2}>Passengers 02</option>
                        <option value={3}>Passengers 03</option>
                        <option value={4}>Passengers 04</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <div className="select-box">
                  <select className="wide">
                    <option value="" disabled selected>Select baggage</option>
                    <option value={1}>Select baggage 01</option>
                    <option value={2}>Select baggage 02</option>
                    <option value={3}>Select baggage 03</option>
                    <option value={4}>Select baggage 04</option>
                  </select>
                </div>
              </div>
            </div>
            <div className="col-xl-6 col-lg-6">
              <div className="get-flight__form-input-box">
                <button type="submit" className="thm-btn get-flight__btn">Book Now</button>
              </div>
            </div>
          </div>
        </form>
        <p className="get-flight__content-text"> <span>*</span> After sending request. We’ll contact you
          for more details about charter.</p>
      </div>
    </div>
  </div>
</section>
    );
}