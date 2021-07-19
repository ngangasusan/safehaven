module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},

    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      green: {
        light: '#00FFC2',
        DEFAULT: '#1fb6ff',
        dark: '#009eeb',
      },
    }
  },
  variants: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography")],
}
