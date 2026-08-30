import Booking from "@/Components/Parts/Booking";
import Footer from "@/Components/Parts/Footer";
import Header from "@/Components/Parts/Header";
import Hero from "@/Components/Parts/Hero";
import React from "react";
import Charter from "@/Components/Parts/Charter";
import Destinations from "@/Components/Parts/Destinations";

export default function Home({ airports = [], destinations = [] }) {
    return (
        <>
            <Header transparent />
            <Hero />
            <Booking airports={airports} />
            <Charter />
            <Destinations destinations={destinations} />

            <Footer />
        </>
    );
}
