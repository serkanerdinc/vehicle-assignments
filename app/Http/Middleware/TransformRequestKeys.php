<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class TransformRequestKeys
{
    public function handle($request, Closure $next)
    {
        // Gelen request verilerini dönüştür
        $data = collect($request->all())->mapWithKeys(function ($value, $key) {
            return [Str::snake($key) => $value];
        });

        // Yeni verileri request'e ayarla
        $request->merge($data->toArray());

        return $next($request);
    }
}
