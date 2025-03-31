<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app'); // Your Blade template that loads the Vite frontend
})->where('any', '.*');
