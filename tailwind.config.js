/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'anakiwa': '#a6d9ff',
        'aqua-haze': '#f6f8fa',
        'armadillo': '#36332a',

        'botticelli': '#cdd9e5',
        'bright-gray': '#373e47',

        'cadet-blue': '#adbac7',
        'cornflower-blue': '#539bf5',
        'curious-blue': '#207ade',

        'dallas': '#665021',
        'denim': '#0c5dbf',
        'dodger-blue': '#218bff',

        'flax': '#eed888',
        'flush-mahogany': '#c93c37',
        'fruit-salad': '#46954a',

        'geyser': '#d0d7de',
        'goblin': {
          100: '#44864b',
          200: '#347d39',
        },

        'iron': '#d5d7da',

        'lemon-chiffon': '#fff8c5',

        'mako': '#444c56',
        'mandy': '#e5534b',

        'outer-space': '#2d333b',

        'pattens-blue': '#ddf4ff',
        'pickled-bluewood': '#263549',

        'river-bed': {
          100: '#4a5462',
          200: '#414b55',
        },

        'san-marino': '#42689b',
        'science-blue': '#0969da',
        'shark': {
          100: '#24292f',
          200: '#22272e',
          300: '#1c2128',
        },
        'shiraz': '#a40e26',
        'silver-sand': '#bdbfc1',

        'tamarillo': '#901025',

        'valencia': '#d5404a',

        'white': '#ffffff',
      },
    },
  },
  plugins: [],
  darkMode: 'class'
}
