import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // --- KLUCZOWE WPISY DLA MARY UI ---
        './vendor/mary-ui/src/View/Components/**/*.php', // Ścieżka do komponentów Mary UI
        './vendor/mary-ui/src/mary-ui.php',             // Ścieżka do głównego pliku Mary UI (opcjonalnie, ale zalecane)
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('daisyui'),
    ],
    daisyui: {
        themes: ["light"], // Tutaj wpisz motywy, między którymi chcesz się przełączać
    },
};
