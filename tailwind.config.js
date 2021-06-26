module.exports = {
    purge: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    darkMode: "media",
    variants: {
        extend: {
            backgroundColor: ["odd", "even"],
        },
    },
    plugins: [],
};
