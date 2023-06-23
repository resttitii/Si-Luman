//fix
//bundler yang cepat untuk aplikasi web modern
//dapat menjalankan Vite untuk mengembangkan aplikasi Laravel dengan kecepatan bundling yang tinggi dan fitur pembaruan otomatis

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
