<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json([
    'message' => 'API is running',
    'docs' => url('/swagger'),
]));

Route::get('/api-docs/openapi.yaml', function () {
    return response()->file(storage_path('app/docs/openapi.yaml'));
});

Route::get('/api-docs', function () {
    return redirect('/swagger');
});

Route::get('/swagger', function () {
    return file_get_contents(public_path('swagger/index.html'));
});

Route::get('/api-docs/{any}', function ($any) {
    $path = storage_path("app/docs/{$any}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('any', '.*');

//Route::fallback(function () {
//    return response()->view('errors.404', [], 404);
//});
