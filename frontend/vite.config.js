import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import path from 'path'

export default defineConfig({
    plugins: [react()],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './src'),
        },
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            protocol: 'ws',
            host: 'localhost',
            port: 5173
        },
        proxy: {
            '/api': {
                target: 'http://localhost:80',
                changeOrigin: true,
                secure: false,
            },
            '/sanctum': {
                target: 'http://localhost:80',
                changeOrigin: true,
                secure: false,
            },
        },
    },
})
