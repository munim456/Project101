import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Public Sans', ...defaultTheme.fontFamily.sans],
                display: ['Fraunces', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                primary: {
                    DEFAULT: '#0e6e6e',
                    dark: '#094f4f',
                    50: '#eaf5f5',
                    100: '#d3e9e9',
                    600: '#0e6e6e',
                    700: '#0a5959',
                    900: '#094f4f',
                },
                accent: {
                    DEFAULT: '#c2452c',
                    dark: '#a8371f',
                },
                surface: {
                    DEFAULT: '#ffffff',
                    muted: '#f7faf9',
                },
                ink: {
                    DEFAULT: '#163332',
                    muted: '#52706e',
                },
            },
        },
    },

    plugins: [forms],
};
