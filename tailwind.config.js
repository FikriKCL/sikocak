import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views//*.blade.php',
    ],

    theme: {
        extend: {
        fontFamily: {
            jost: ["Jost", "sans-serif"], 
        },

        boxShadow: {
            bottom: "0 10px 0 0 rgba(0,0,0,1)",      
            bottomSm: "0 5px 0 0 rgba(0,0,0,1)",    
        },
        },

          screens: {
                xxs: '320px',
                xs: '380px',
                sm: '640px',
                md: '768px',
                lg: '1024px',
            },

            backgroundImage: {
            'auth-bg': "url('/images/background.png')",
         },
    },

    

    plugins: [forms],
};
