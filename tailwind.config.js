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
                    DEFAULT: '#4A732E',
                    hover: '#356517',
                    border: '#215600',
                    boarderhover: '#356517',
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
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
