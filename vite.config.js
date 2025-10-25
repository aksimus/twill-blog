import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss', //the same as theme.scss in original theme
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': 'node_modules/bootstrap',
            '~boxicons': 'node_modules/boxicons',
            '~lightgallery': 'node_modules/lightgallery',
            '~jarallax': 'node_modules/jarallax',
            '~swiper': 'node_modules/swiper'
        }
    }
});