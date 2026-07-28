import "../css/app.css";
import "./bootstrap";
import "animate.css";

import $ from "jquery";
window.$ = window.jQuery = $;

// Nice Select
import "nice-select2/dist/js/nice-select2.js";
import "nice-select2/dist/css/nice-select2.css";

// Owl Carousel
import "owl.carousel/dist/assets/owl.carousel.css";
import "owl.carousel/dist/assets/owl.theme.default.css";
import "owl.carousel";

import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createRoot } from "react-dom/client";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.jsx`,
            import.meta.glob("./Pages/**/*.jsx")
        ),

    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(<App {...props} />);
    },

    progress: {
        color: "#4B5563",
    },
});