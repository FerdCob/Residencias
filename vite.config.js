import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/js/form-calculations.js','resources/js/get-datos.js',],
            refresh: true,
        }),
    ],
});
