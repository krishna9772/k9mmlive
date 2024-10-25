import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js"
    ],
    plugins: [
        require('flowbite/plugin'),
        require('@tailwindcss/line-clamp'),
    ],
    theme: {
        extend: {
        fontFamily: {
                "bebas": ['Bebas Neue', 'sans-serif'],
                "inter": ['Inter', 'sans-serif']
            },
          colors: {
            //primary: { 50: '#FFF5F2', 100: '#FFF1EE', 200: '#FFE4DE', 300: '#FFD5CC', 400: '#FFBCAD', 500: '#FE795D', 600: '#EF562F', 700: '#EB4F27', 800: '#CC4522', 900: '#A5371B' },
            primary: {"50":"#fef2f2","100":"#fee2e2","200":"#fecaca","300":"#fca5a5","400":"#f87171","500":"#ef4444","600":"#dc2626","700":"#b91c1c","800":"#991b1b","900":"#7f1d1d"},
            "primary-color": "var(--primary-color)",
            "secondary-color": "var(--secondary-color)",
            "active-color": "var(--active-color)",
            "dark-color": "#222222",
            "alice-blue-color": "#F0F6FA",
            "dark-alice-blue-color": "#002e57",

          },
        },
      },
}
