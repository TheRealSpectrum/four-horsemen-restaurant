module.exports = {
    purge: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    darkMode: "media",
    variants: {
        extend: {
            backgroundColor: ["odd", "even"],
        },
    },
    plugins: [],
    theme: {
        colors: {
            light: "#f7f5e8",
            "light-gray": "#becec0",
            "dark-gray": "#5e696b",
            dark: "#010521",
            highlight: "#162f9e",
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
