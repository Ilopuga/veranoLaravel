import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(), // Usamos solo el plugin Vue una vez
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"], // Los archivos a procesar
            refresh: true, // Habilitamos el auto-refresh para recargar el navegador
        }),
    ],
});
