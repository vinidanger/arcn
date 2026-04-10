<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/delivery', function () {
    return view('restaurante');
});

Route::get('/delivery/changelog', 'App\Http\Controllers\DeliveryChangelogController');

Route::get('/status', 'App\Http\Controllers\ServerStatusController');
