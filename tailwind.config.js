const colors = require('tailwindcss/colors');

module.exports = {

  purge: ['./pages/**/*.{js,ts,jsx,tsx}', './components/**/*.{js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {

    extend: {
      colors: {
        primary: {
          light: '#001E6C',
          DEFAULT: '#001E6C',
          dark: '#001E6C',
        },
        secondary: {
          light: '#FFAA4C',
          DEFAULT: '#FFAA4C',
          dark: '#FFAA4C',
        },
        navbg: '#001E6C',
        form: ' #F8F0DF',
        base: {
          DEFAULT: '#EEEEEE',
        },
      },

    },
  },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/forms')]

};
