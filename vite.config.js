import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        host: "0.0.0.0",
        port: 5173,
        strictPort: true,
        allowedHosts: ["nginx", "localhost", "127.0.0.1"],
        hmr: {
            host: "localhost",
            port: 5173,
        },
        watch: {
            usePolling: true,
            interval: 100, // Sprawdzaj co 100ms
        },
    },
});
