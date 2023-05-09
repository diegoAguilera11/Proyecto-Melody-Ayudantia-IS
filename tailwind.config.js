/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    colors: {
        transparent: 'transparent',
        'red-custom': {
            50: '#fb4d42',
            100: '#f62e2f',
            150: '#d42628',
            200: '#a00318'
        }
    },
    extend: {},
  },
  plugins: [],
}

