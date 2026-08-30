import React from "react";
import charter1 from "../../../../public/frontend-assets/images/privet_jet.jpg";
import charter2 from "../../../../public/frontend-assets/images/helicopter.jpg";
import charter3 from "../../../../public/frontend-assets/images/resources/charters-1-3.jpg";

const charters = [
    {
        image: charter1,
        seats: "6 - 8 seats",
        title: "Executive jet",
        text: "Non augue egestas, commodo simply free velit eget, tellus.",
    },
    {
        image: charter2,
        seats: "4 - 6 seats",
        title: "Helicopter",
        text: "Non augue egestas, commodo simply free velit eget, tellus.",
    },
    {
        image: charter3,
        seats: "4 - 8 seats",
        title: "Turbo prop",
        text: "Non augue egestas, commodo simply free velit eget, tellus.",
    },
];

export default function Charter() {
    return (
        <>
            {/*Charters Start*/}
            <section className="charters">
                <div className="container">
                    <div className="section-title text-center">
                        <span className="section-title__tagline">
                            luxury charters
                        </span>
                        <h2 className="section-title__title">
                            Select the charters
                            <br /> according to your need
                        </h2>
                    </div>
                    <div className="row">
                        {charters.map((charter) => (
                            <div className="col-xl-4 col-lg-4" key={charter.title}>
                                <div className="charters__single">
                                    <div
                                        className="charters__img"
                                        style={{ height: "260px" }}
                                    >
                                        <img
                                            src={charter.image}
                                            alt={charter.title}
                                            style={{
                                                width: "100%",
                                                height: "100%",
                                                objectFit: "cover",
                                                display: "block",
                                            }}
                                        />
                                    </div>
                                    <div className="charters__content">
                                        <p className="charters__date">{charter.seats}</p>
                                        <h3 className="charters__title">
                                            <a href="/service">{charter.title}</a>
                                        </h3>
                                        <p className="charters__text">{charter.text}</p>
                                        <a href="/service" className="thm-btn charters__btn">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
            {/*Charters End*/}
        </>
    );
}
