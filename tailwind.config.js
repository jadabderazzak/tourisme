/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./node_modules/flowbite/**/*.js",
     "./node_modules/tw-elements/js/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Poppins', 'Arial', 'sans-serif'], // Ajouter Arial comme police de secours
      },
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require("tw-elements/dist/plugin")
  ],
}

