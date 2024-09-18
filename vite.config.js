import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'public/assets/css/nucleo-icons.css',
                'public/assets/css/nucleo-svg.css',
                'public/assets/css/material-dashboard.min.css',
                'public/assets/js/core/popper.min.js'
            ],
            refresh: true
        })
    ],
    build: {
        rollupOptions: {
            output:{
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString()
                    }
                }
            }
        }
    }
})
