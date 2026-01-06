<?php
// Quick script to clear route cache
// Run: php clear-route-cache.php

$cacheFile = __DIR__ . '/bootstrap/cache/routes-v7.php';

if (file_exists($cacheFile)) {
    unlink($cacheFile);
    echo "Route cache cleared!\n";
} else {
    echo "No route cache file found.\n";
}

echo "Now run: php artisan route:clear\n";

