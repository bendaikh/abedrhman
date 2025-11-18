import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    },
    build: {
        // Use terser instead of esbuild for minification to avoid deadlocks
        // esbuild can have issues on resource-constrained servers (goroutine deadlocks)
        // Setting GOMAXPROCS=1 in the build script limits esbuild concurrency
        minify: process.env.USE_ESBUILD_MINIFY === 'true' ? 'esbuild' : 'terser',
        target: 'es2015',
        // Limit chunk size to reduce memory pressure
        chunkSizeWarningLimit: 1000,
        // Reduce sourcemap generation to save memory
        sourcemap: false,
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
    optimizeDeps: {
        // Limit concurrent dependency optimization
        entries: ['resources/js/app.js'],
    },
    esbuild: {
        // Reduce concurrency to prevent deadlocks
        // This helps on resource-constrained servers
        target: 'es2015',
    },
    // Server configuration for development (doesn't affect production build)
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
