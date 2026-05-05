<?php

use Illuminate\Support\Facades\Route;

/*
 * PNG servido na URL /favicon.ico com Content-Type image/png: evita tela branca quando o servidor
 * associa .ico a image/x-icon e o corpo é PNG (ICO com PNG embutido mal interpretado).
 */
Route::get('/favicon.ico', function () {
    $path = public_path('images/favicon-48x48.png');

    return is_readable($path)
        ? response()->file($path, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=604800',
            'X-Content-Type-Options' => 'nosniff',
        ])
        : abort(404);
});

Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Allow: /',
        '',
        'Sitemap: '.url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines), 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
});

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => url('/delivery'), 'changefreq' => 'weekly', 'priority' => '0.9'],
        ['loc' => url('/delivery/changelog'), 'changefreq' => 'weekly', 'priority' => '0.7'],
        ['loc' => url('/status'), 'changefreq' => 'daily', 'priority' => '0.6'],
    ];
    $lastmod = now()->toAtomString();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $u) {
        $xml .= '<url>';
        $xml .= '<loc>'.e($u['loc']).'</loc>';
        $xml .= '<lastmod>'.$lastmod.'</lastmod>';
        $xml .= '<changefreq>'.$u['changefreq'].'</changefreq>';
        $xml .= '<priority>'.$u['priority'].'</priority>';
        $xml .= '</url>';
    }
    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/delivery', function () {
    return view('restaurante');
});

Route::get('/delivery/changelog', 'App\Http\Controllers\DeliveryChangelogController');

Route::get('/status', 'App\Http\Controllers\ServerStatusController');
