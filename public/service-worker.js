// ✅ Name of your cache
const CACHE_NAME = "smapes-cache-v1";

// ✅ Files to cache
const FILES_TO_CACHE = [
    "/",
    "/manifest.json",
    "/scripts/service-worker.js",
    "/images/logo.png",
    "/images/logo-transparent.png",

    "/index.php",
    "/about.php",
    "/drop-it.php",
    "/catalog.php",
    "/catalog-item-details.php",
    "/settings.php",
    "/register.php",
    "/login.php",

    "/styles/style-main.css",
    "/styles/style-page-home.css",
    "/styles/style-page-about.css",
    "/styles/style-page-drop-it.css",
    "/styles/style-page-catalog.css",
    "/styles/style-page-catalog-item-details.css",

    "/scripts/script-main-setup.js",
    "/scripts/script-main.js",
    "/scripts/script-auth.js",  
];

// 🧱 Install event — initial caching
self.addEventListener("install", event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(async cache => {
            await Promise.all(
                FILES_TO_CACHE.map(async (url) => {
                    try {
                        const response = await fetch(url);
                        if (response.ok) await cache.put(url, response);
                    } catch (e) {
                        console.warn("⚠️ Failed to cache:", url);
                    }
                })
            );
        })
    );
    self.skipWaiting();
});

// 🧹 Activate event — remove old caches
self.addEventListener("activate", event => {
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(keys.map(key => {
                if (key !== CACHE_NAME) return caches.delete(key);
            }))
        )
    );
    self.clients.claim();
});

// ⚡ Fetch event — online refresh logic
self.addEventListener("fetch", event => {
    event.respondWith(
        (async () => {
            try {
                const networkResponse = await fetch(event.request);
                const cache = await caches.open(CACHE_NAME);
                cache.put(event.request, networkResponse.clone());
                return networkResponse;
            } catch {
                const cachedResponse = await caches.match(event.request);
                return cachedResponse || caches.match("/offline.html");
            }
        })()
    );
});
