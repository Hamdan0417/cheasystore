module.exports = {
  content: [
    './wp-content/themes/cheasy/**/*.{php,js}',
    './wp-content/plugins/cheasy-web3/**/*.{php,js}',
    './wp-content/plugins/cheasy-seo-gen/**/*.{php,js}'
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FF6A00',
        secondary: '#1464F4',
        accent: '#00C2A8',
        dark: '#111111',
        surface: '#F5F7FA'
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
        mono: ['Roboto Mono', 'monospace']
      }
    }
  },
  plugins: [require('@tailwindcss/typography')]
};
