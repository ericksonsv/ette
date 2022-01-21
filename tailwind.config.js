const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    darkMode: false,
    content: [
        "./resources/**/*.blade.php",
        "./vendor/rappasoft/laravel-livewire-tables/resources/views/tailwind/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
