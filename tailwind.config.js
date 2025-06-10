import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                primary: '#22c55e', // Green
                secondary: '#f59e0b', // Amber
                dark: '#1b1b18', // You can still keep this if needed

                // 👇 New Light Theme Colors
                background: '#fffaf0', // Light skin-like background (Floral White)
                surface: '#fefce8', // Pale yellow surface
                textPrimary: '#1f2937', // Gray-800
                textSecondary: '#4b5563', // Gray-600
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        plugin(function ({ addComponents }) {
            addComponents({
                '.logo-sm': {
                    width: '32px',
                    height: '32px',
                    borderRadius: '9999px',
                    overflow: 'hidden',
                    backgroundColor: '#DCE8D0',
                    boxShadow: '0 2px 4px rgba(0, 0, 0, 0.1)',
                }
            });
        }),
    ],
};