import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';  // Add this import
import { createVuePlugin } from 'vite-plugin-vue2';

export default defineConfig({
    plugins: [
        createVuePlugin(), // Add Vue 2 plugin
        laravel({
            input: [
                'resources/scss/app.scss', 
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                // Глобальные переменные если нужны
            }
        }
    },
    
    build: {
        minify: 'esbuild',
        cssCodeSplit: true,
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name.endsWith('.css')) {
                        return 'css/[name].[hash][extname]'
                    }
                    return 'assets/[name].[hash][extname]'
                }
            }
        }
    },    
    resolve: {
        alias: {
            '~bootstrap': 'node_modules/bootstrap',
            '~boxicons': 'node_modules/boxicons',
            '~lightgallery': 'node_modules/lightgallery',
            '~jarallax': 'node_modules/jarallax',
            '~swiper': 'node_modules/swiper',
            'vue': 'vue/dist/vue.esm.js', // Vue 2 ESM build
            '~font-awesome': 'node_modules/font-awesome', // Add this
            '~fe-lib': 'node_modules/fe-lib',
            '~': path.resolve(__dirname, './resources/assets'),
        }
    },
    optimizeDeps: {
        include: ['vue'] // Pre-bundle Vue for better performance
    },
    server: {
        host: true, // Allow external connections
        port: 5173
    },
});