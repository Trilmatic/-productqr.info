const colors = require("tailwindcss/colors");
const defaultTheme = require("tailwindcss/defaultTheme");

const customColors = {
    primary: colors.blue[500],
    "primary-focus": colors.blue[400],
    secondary: colors.pink[500],
    "secondary-focus": colors.pink[400],
    info: colors.emerald[600],
    "info-focus": colors.emerald[500],
    warning: colors.amber[400],
    "warning-focus": colors.amber[300],
    error: colors.red[500],
    "error-focus": colors.red[400],
    success: colors.green[600],
    "success-focus": colors.green[500],
};

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                aspekta: ['Aspekta', 'sans-serif'],
                'cabinet-grotesk': ['Cabinet Grotesk', 'sans-serif'],
            },
            colors: customColors,
            fontSize: {
                xs: ['0.75rem', { lineHeight: '1.5' }],
                sm: ['0.875rem', { lineHeight: '1.5715' }],
                base: ['1rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                lg: ['1.125rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                xl: ['1.25rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                '2xl': ['1.5rem', { lineHeight: '1.415', letterSpacing: '0' }],
                '3xl': ['1.875rem', { lineHeight: '1.333', letterSpacing: '0' }],
                '4xl': ['2.25rem', { lineHeight: '1', letterSpacing: '0' }],
                '5xl': ['3rem', { lineHeight: '1', letterSpacing: '0' }],
                '6xl': ['3.75rem', { lineHeight: '1', letterSpacing: '0' }],
                '7xl': ['4.5rem', { lineHeight: '1', letterSpacing: '0' }],
            },
            letterSpacing: {
                tighter: '-0.02em',
                tight: '-0.01em',
                normal: '0',
                wide: '0.01em',
                wider: '0.02em',
                widest: '0.4em',
            },
            zIndex: {
                1: "1",
                2: "2",
                3: "3",
                4: "4",
                5: "5",
            },
        },
    },
    plugins: [
        // eslint-disable-next-line global-require
        require('@tailwindcss/forms'),
    ],
};
