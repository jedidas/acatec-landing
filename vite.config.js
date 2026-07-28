import { resolve } from 'path';
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/ts/app.ts',
                'resources/ts/detail.ts',
                'resources/ts/cart-favorites-app.tsx',

                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/sass/detail.scss',
                'resources/sass/cart-favorites.scss',
            ],
            refresh: true,
        }),
        tailwindcss(),
        react(),
    ],
    resolve: {
        alias: {
            '@helps': resolve(__dirname, 'resources/ts/helps'),
            '@modules': resolve(__dirname, 'resources/ts/modules'),
            '@react': resolve(__dirname, 'resources/react'),
            '@resources': resolve(__dirname, 'resources'),
            '@services': resolve(__dirname, 'resources/ts/services'),
        },
    },
});
