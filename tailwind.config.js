import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // Added darkMode setting
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: { DEFAULT: '#4e73df', dark: '#3a5bd9' },
                secondary: { light: '#f8f9fc', dark: '#2a3042' },
                text: { light: '#5a5c69', dark: '#d1d5db' },
                bg: { light: '#ffffff', dark: '#1a1f36' },
                card: { light: '#f8f9fc', dark: '#2a3042' },
                border: { light: '#e3e6f0', dark: '#3a3f58' },
                company: { light: '#6c757d', dark: '#adb5bd' },
            },
            boxShadow: {
                card: '0 10px 30px rgba(0, 0, 0, 0.1)',
                button: '0 5px 15px rgba(78, 115, 223, 0.3)',
            },
        },
    },

    plugins: [forms],
};
