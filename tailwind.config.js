/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: '1rem',
                    sm: '2rem',
                    lg: '4rem',
                    xl: '5rem',
                    '2xl': '6rem',
                },
            },
            colors: {
                'bunker': {
                    '50': '#F3F1FF',
                    '100': '#E9E6FF',
                    '200': '#D6D1FF',
                    '300': '#B8ACFF',
                    '400': '#947DFF',
                    '500': '#7348FF',
                    '600': '#6223FF',
                    '700': '#5411F0',
                    '800': '#4B0FD7',
                    '900': '#3C0EA4',
                    '950': '#210570',
                },
                // 'bunker': {
                //     '50': '#FFF7ED',
                //     '100': '#FEEDD6',
                //     '200': '#FCD8AC',
                //     '300': '#FBBB76',
                //     '400': '#F8933F',
                //     '500': '#F5761A',
                //     '600': '#D7550F',
                //     '700': '#BF430F',
                //     '800': '#983614',
                //     '900': '#7A2F14',
                //     '950': '#421508',
                // },
                // 'bunker': {
                //     50: '#F1F1F3',
                //     100: '#E3E3E8',
                //     200: '#C8C8D0',
                //     300: '#ACACB9',
                //     400: '#9191A1',
                //     500: '#75758A',
                //     600: '#5E5E6E',
                //     700: '#464653',
                //     800: '#2C2C34',
                //     900: '#16161A',
                //     950: '#0C0C0E',
                // },
            },
        },
    },
    plugins: [],
};

