module.exports = {
    purge: {
        content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
        safelist: ["hidden"],
    },
    darkMode: "class",
    variants: {
        extend: {
            backgroundColor: ["odd", "even"],
        },
    },
    plugins: [],
    theme: {
        colors: {
            backgrounddark: "#1d2b2c",
            columnlight: "#a5c0c5",
            columndark: "#7da4aa",
            columngroup: "#a5c0c5",
            columnheader: "#b8cdd1",
            navbutton: {
                base: "#e8fcff",
                active: "#89acb1",
            },
            reservation: {
                background: "#e8fcff",
                backgroundevent: "#ffff59",
                backgroundlate: "#fd0000",
            },
            save: "#64ff50",
            cancel: "#fd0000",

            textblack: "#000000",
            textwhite: "#ffffff",

            light: "#f7f5e8",
            "light-gray": "#becec0",
            "dark-gray": "#5e696b",
            dark: "#010521",
            dim: "#01052188",
            highlight: "#162f9e",
            "button-dim": "#23232322",
            warning: {
                high: "#ff7272",
                low: "#ffcf72",
            },
            save: "#25FD02",
        },
        fontFamily: {
            sans: ["Oxygen", "sans-serif"],
            serif: ["'Noto Serif'", "serif"],
        },
    },
};
