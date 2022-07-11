const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        fontFamily: {
            "gilroy-700": ['Gilroy-Bold', 'sans-serif'],
            "gilroy-400": ['Gilroy-Regular', 'sans-serif'],
            "gilroy-600": ['Gilroy-SemiBold', 'sans-serif'],
            "gilroy-500": ['Gilroy-Medium', 'sans-serif'],
            "gilroy-300": ['Gilroy-Light', 'sans-serif'],
        },
        fontSize: {
            14: ['14px', '18px'],
            16: ['16px', '20px'],
            18: ['18px', '22px'],
            20: ['20px', '24px'],
        },
        extend: {
            fontFamily: {
                sans: ['Gilroy-Regular', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'form': '0px 4px 10px 3px rgba(0, 0, 0, 0.11)',
                'card': '0px 2px 1px rgba(0, 0, 0, 0.14)',
                'card-active': '0px 10px 30px rgba(0, 0, 0, 0.15), 0px 2px 1px rgba(0, 0, 0, 0.14)',
            },
            flex: {
                '23': '0 1 23%',
                '34': '0 1 34%',
                '41': '0 1 41%',
                '50': '0 1 50%',
            },
            flexBasis: {
                '48': '48%',
                '24': '24%',
                '75': '75%',
            },
            screens: {
                'mobile-m': '375px',
                'mobile-l': '425px',
                'laptop': '1024px',
            },
            colors: {
                'blue': '#405FD4',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
