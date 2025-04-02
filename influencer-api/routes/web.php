<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/youtube', function () {
    return view('youtube');
});
Route::post('/youtube', [AuthController::class, 'fetchChannelDetails'])->name('youtube.fetch');
Route::get('/facebook', [AuthController::class, 'getUserDetails']);
