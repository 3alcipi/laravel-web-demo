import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fg from 'fast-glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                ...fg.sync('resources/js/pages/**/*.js'), // 🔥 Agrega todos los scripts JS de "pages"
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        emptyOutDir: true, // 🔄 Limpia antes de compilar
    },
});
