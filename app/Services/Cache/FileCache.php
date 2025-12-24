<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache as LaravelCache;

class FileCache implements Cache
{
    public function flush(): void
    {
        LaravelCache::flush();
    }

    public function get($key): mixed
    {
        return LaravelCache::get($key);
    }

    public function put($key, $value, $ttl = null): void
    {
        if ($ttl && $ttl > 0) {
            LaravelCache::put($key, $value, $ttl);
        } else {
            LaravelCache::forever($key, $value);
        }
    }

    public function forget($key): void
    {
        LaravelCache::forget($key);
    }

    public function has($key): bool
    {
        return LaravelCache::has($key);
    }
}
