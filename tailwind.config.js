const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    safelist: [
        'bg-danger-100',
        'bg-info-100',
        'bg-green-100',
        'bg-deleted-100',
        'bg-info-100',
        'bg-primary-100',
        'bg-green-100',
        'text-danger-800',
        'text-info-800',
        'text-green-800',
        'text-deleted-800',
        'text-info-800',
        'text-primary-800',
        'text-green-800',
    ],

    theme: {
        extend: {
            colors: {
                'primary': {
                    light: '#5ca3fc',
                    DEFAULT: '#0350b1',
                    dark: '#033f8c',
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('flowbite/plugin'),
    ],
};
