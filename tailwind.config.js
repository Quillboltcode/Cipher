/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [ 
    './*.php',
    './app/**/*.{php,html,html.php}',
    './app/views/**/*.{php,html,html.php}',
    './app/views/partials/*.{php,html,html.php}',
    './app/views/user/*.{php,html.php}',
    './app/views/*.php',   
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

