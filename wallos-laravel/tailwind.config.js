/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: 'var(--main-color)',
          hover: 'var(--hover-color)',
        },
        accent: 'var(--accent-color)',
        error: 'var(--error-color)',
        success: 'var(--success-color)',
      },
    },
  },
  plugins: [],
  darkMode: 'class',
}