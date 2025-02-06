import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
		"./resources/**/*.blade.php",
		 "./resources/**/*.js",
         "./app/View/Components/**/**/*.php",
         "./app/Livewire/**/**/*.php",
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
         './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
	],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
		require("daisyui")
	],
};
