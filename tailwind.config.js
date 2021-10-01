module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        my: {
          'pink': '#EA6DC5',
          'purple': '#CB89F3',
          'dark': '#44314F',
        }
      },
      fontFamily: {
        'viga': '"viga", sans-serif',
        'montserrat': '"montserrat", sans-serif'
      },
      minWidth: {
        '7rem': '7rem',
      },
      maxWidth: {
        '7rem': '7rem',
      },
      minHeight: {
        '7rem': '7rem',
      },
      maxHeight: {
        '7rem': '7rem',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
