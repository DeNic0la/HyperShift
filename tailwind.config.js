const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                create: {
                    DEFAULT: '#55930a',
                    hover: '#498d1f',
                    border: '#2e7203',
                    boarderhover: '#3e781a',
                },
                answer: {
                    DEFAULT: '#F36423',
                    hover: '#F5541C',
                    border: '#F64C18',
                    boarderhover: '#F5541C',
                },
                result: {
                    DEFAULT: '#3C94D3',
                    hover: '#298CCB',
                    border: '#1784C3',
                    boarderhover: '#055787',
                },
                live: {
                    DEFAULT: '#3A32C2',
                    hover: '#283AD9',
                    border: '#422DB7',
                    boarderhover: '#4B29AB',
                },
                host: {
                    DEFAULT: '#8B1D17',
                    hover: '#9D221E',
                    border: '#79180F',
                    boarderhover: '#661308',
                },
                add: {
                    DEFAULT: '#00B2CA',
                    hover: '#20BAC5',
                    border: '#04A6C2',
                    boarderhover: '#0899BA',
                },
                code: {
                    DEFAULT: '#5EEB5B',
                    hover: '#61FF7E',
                    border: '#62AB37',
                    boarderhover: '#62AB37',
                },
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],// add Tailwind Plugins here
};
