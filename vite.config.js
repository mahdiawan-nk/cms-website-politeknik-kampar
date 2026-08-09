import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { bunny } from "laravel-vite-plugin/fonts";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/filament/cms/theme.css",
            ],
            refresh: true,
            fonts: [
                bunny("Instrument Sans", {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        host: "0.0.0.0",
        port: 5173,
        strictPort: true,
        cors: true,
        hmr: {
            host: "localhost",
            clientPort: 25173, // Menghubungkan port internal docker dengan port ekspos luar
        },
        watch: {
            ignored: ["**/storage/framework/views/**"],
            usePolling: true,
            interval: 300,
        },
    },
});
