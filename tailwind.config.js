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
                heading: "'Poppins', sans-serif",
                body: "'Poppins', sans-serif",
            },
            container: {
                center: true,
                padding: '1rem',
            },
            colors: {
                current: 'currentColor',
                transparent: 'transparent',
                primary: '#F3F4F8',
                secondary: '#8C97A8',
                tertiary: '#40407b',
                quaternary: '#94A2BC',
                black: '#23235F',
                white: '#FFFFFF',
                'sky-light': '#E0E7FF',
                'blue-pale': '#F0F4FF',
             },
            screens: {
                sm: '540px',
                // => @media (min-width: 576px) { ... }
                md: '768px',
                // => @media (min-width: 768px) { ... }
                lg: '992px',
                // => @media (min-width: 992px) { ... }
                xl: '1140px',
                // => @media (min-width: 1200px) { ... }
                '2xl': '1320px',
                // => @media (min-width: 1400px) { ... }
            },
            dropShadow: {
                light: 'drop-shadow(0px 1px 5px rgba(0, 0, 0, 0.1))',
            },
            backgroundColor: ['visited'],
            scrollbar: {
                DEFAULT: {
                    track: 'bg-gray-100',
                    thumb: 'bg-gray-400 hover:bg-gray-500',
                },
            },
        },
    },
    plugins: [
        forms
    ],
};
