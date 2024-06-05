import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import { space } from 'postcss/lib/list';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Press Start 2P', ...defaultTheme.fontFamily.sans],
                space: ['Space Mono', ...defaultTheme.fontFamily.sans],

            },
            backgroundImage: {
                'sandbrick': "url('/background-2.png')",
                
            },
        },
    },

    plugins: [forms],
};
