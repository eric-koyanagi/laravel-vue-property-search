<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheTrait
{
    public function hasCached(string $key): bool
    {
        return Cache::has($key);
    }

    public function getCached(string $key)
    {
        return Cache::get($key);
    }

    public function setCached(string $key, $obj)
    {
        Cache::put($key, $obj, now()->addMinutes(10));
    }
}