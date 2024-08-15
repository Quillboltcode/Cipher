/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [ 
    './*.php',
    './app/**/*.{php,html,html.php}',
    './views/**/*.{php,html,html.php}',
    './views/partials/*.{php,html,html.php}',
    './views/*.php',   
    './**/*.php',
    './**/*.html',
    './**/*.html.php',],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

