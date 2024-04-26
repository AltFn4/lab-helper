import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss/plugin';

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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'regal-blue': '#243c5a',
            },
            animation: {
                fade: 'fadeIn .5s ease-in forwards',
                select: 'select .1s ease-in forwards',
            },
            keyframes: theme => ({
                'fadeIn': {
                    '0%': { backgroundColor: theme('colors.transparent') },
                    '100%': { backgroundColor: theme('colors.black') },
                },
                'select': {
                    '0%': { transform: 'scale(1)' },
                    '100%': { transform: 'scale(.95)' },
                }
            }),
            height: {
                '128': '48rem',
            },
            backgroundImage: {
                'uni': "url('/storage/images/uni.jpg')",
                'happy_student': "url('/storage/images/happy_student.jpg')",
                'happy_helper': "url('/storage/images/happy_helper.jpg')",
            },
        },
    },

    plugins: [
        forms,
        plugin(function ({ addVariant }) {
            addVariant('selected', '&.selected');
        })
    ],
};
