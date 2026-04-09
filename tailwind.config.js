import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#eef2ff',
                    100: '#e0e7ff',
                    200: '#c7d2fe',
                    300: '#a5b4fc',
                    400: '#818cf8',
                    500: '#6366f1',
                    600: '#4f46e5', // Indigo-600 Primary
                    700: '#4338ca',
                    800: '#3730a3',
                    900: '#312e81',
                    950: '#1e1b4b',
                },
                zinc: {
                    50: '#fafafa', // Minimalist base
                }
            },
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'premium': '0 4px 24px -8px rgba(79, 70, 229, 0.1)',
                'premium-hover': '0 8px 32px -12px rgba(79, 70, 229, 0.2)',
            },
            borderRadius: {
                '2xl': '1rem',
            }
        },
    },

    plugins: [forms],
};

