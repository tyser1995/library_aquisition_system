/* eslint-disable object-curly-newline */
/* eslint-disable global-require */
/* eslint-disable quotes */
/* eslint-disable jsx-a11y/heading-has-content */
/* eslint-disable react/jsx-indent */
/* eslint-disable react/self-closing-comp */
/* eslint-disable react/no-this-in-sfc */
/* eslint-disable react/jsx-filename-extension */
/* eslint-disable no-restricted-syntax */
/* eslint-disable no-extend-native */
/* eslint-disable no-unused-vars */
const colors = require("tailwindcss/colors");

module.exports = {
  purge: ["./pages/**/*.{js,ts,jsx,tsx}", "./components/**/*.{js,ts,jsx,tsx}"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        primary: {
          light: "#001E6C",
          DEFAULT: "#001E6C",
          dark: "#001E6C",
        },
        secondary: {
          light: "#FFAA4C",
          DEFAULT: "#FFAA4C",
          dark: "#FFAA4C",
        },
        navbg: "#001E6C",
        form: " #F8F0DF",
        base: {
          DEFAULT: "#EEEEEE",
        },
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms")],
};
