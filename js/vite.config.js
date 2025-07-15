import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import symfony from 'vite-plugin-symfony'
import { fileURLToPath, URL } from "url";

export default defineConfig({
    plugins: [
        vue(),
        symfony(), // подключает Symfony public path
    ],
    resolve: {
        alias: {
            "@": fileURLToPath(new URL("./src", import.meta.url)),
        },
    },
    build: {
        rollupOptions: {
            input: {
                home: './src/pages/home.js',
                login: './src/pages/login.js',
                schedule: './src/pages/schedule.js',
                users: './src/pages/users.js',
                requests: './src/pages/requests.js',
                materials: './src/pages/materials.js',

            },
            output: {
                entryFileNames: 'js/[name].js',
                chunkFileNames: 'js/[name].[hash].js',
                assetFileNames: 'assets/[name].[ext]'
            }
        },
        outDir: '../public/build',
        emptyOutDir: true
    }
})
