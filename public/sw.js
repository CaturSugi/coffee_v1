const CACHE_NAME = 'coffee-pos-v1';
const urlsToCache = [
  '/',
  '/resources/css/app.css',
  // Add other assets here
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});
