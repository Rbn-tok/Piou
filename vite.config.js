import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'
import { VitePWA } from 'vite-plugin-pwa'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        VitePWA({
            registerType: 'prompt',
            injectRegister: 'script',
            devOptions: {
                enabled: false
            },
            workbox: {
                globPatterns: ['**/*.{js,css,ico,png,svg,eot,woff,ttf,woff2}'],
                navigateFallback: '/',
            },
            includeAssets: ['**/*'],
            manifest: {
                name: 'Piou',
                short_name: 'Piou',
                description: 'La simplicité !',
                theme_color: '#ffffff',
                start_url: '/',
                id: '/',
                icons: [
                    {
                        src: '/images/icon-192x192.png',
                        sizes: '192x192',
                        type: 'image/png'
                    },
                    {
                        src: '/images/icon-512x512.png',
                        sizes: '512x512',
                        type: 'image/png'
                    },
                    {
                        "src": "/images/maskable-196x196.png",
                        "sizes": "196x196",
                        "type": "image/png",
                        "purpose": "maskable"
                    }
                ],
                display: 'standalone'
            }
        })
    ],
    resolve: {
        alias: {
            '~tabler': path.resolve(__dirname, 'node_modules/@tabler/core'),
            '~icons': path.resolve(__dirname, 'node_modules/@tabler/icons-webfont'),
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    }
});
