import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                accent: "#D4B157",
                oren: "#FDB82D",

                richblack: "#141A22ff",
                raisinblack: "#191F28ff",
                lion: "#C69F68ff",
                ashgray: "#B6B7A4ff",
                yimblue: "#4B5975ff",
            },
        },
    },

    darkMode: "class",

    plugins: [forms],
};
