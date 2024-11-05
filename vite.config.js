import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    base: '/',  // Adjust this if your app is served from a subdirectory
    plugins: [
        laravel({
            input: [ 
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true, // Ensure this does not affect production
        }),
        vue({
            template: {
                transformAssetUrls: {  
                    base: null,   
                    includeAbsolute: false,  
                },
            },    
        }),   
    ],   
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': path.resolve(__dirname, 'resources/js/components'),
            '@func': path.resolve(__dirname, 'resources/js'),
        },
    },
});