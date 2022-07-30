/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        // white
        'white': '#ffffff',

        // blue
        'anakiwa': '#a6d9ff',
        'curious-blue': '#207ade',
        'denim': '#0c5dbf',
        'dodger-blue': '#218bff',
        'french-pass': '#badfff',
        'pattens-blue': '#ddf4ff',
        'san-marino': '#42689b',
        'science-blue': '#0969da',

        // red
        'flush-mahogany': '#c93c37',
        'mandy': '#e5534b',
        'shiraz': '#a40e26',
        'tamarillo': '#901025',
        'valencia': '#d5404a',

        // yellow
        'flax': '#eed888',
        'lemon-chiffon': '#fff8c5',

        // gray
        'armadillo': '#36332a',
        'aqua-haze': '#f6f8fa',
        'botticelli': '#cdd9e5',
        'cadet-blue': '#adbac7',
        'geyser': '#d0d7de',
        'iron': '#d5d7da',
        'mako': '#444c56',
        'outer-space': '#2d333b',
        'river-bed': {
          100: '#4a5462',
          200: '#414b55',
        },
        'silver-sand': '#bdbfc1',

        // brown
        'buccaneer': '#70383a',
        'dallas': '#665021',
        'mandalay': '#ae7c14',

        // green
        'fruit-salad': '#46954a',

        // black
        'pickled-bluewood': '#263549',
        'shark': {
          100: '#24292f',
          200: '#22272e',
          300: '#1c2128',
        },

        // purple
        'regent-gray': '#9099a4',
      },
    },
  },
  plugins: [],
  darkMode: 'class'
}
