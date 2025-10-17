<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::controller(DashboardController::class)->group(function(){

    // Ruta Principal
    Route::get('/','index')
        ->name('index');

    // Login
    Route::get('/login','loginIndex')
        ->name('loginIndex');
        
    // Login
    Route::post('/login','login')
        ->name('login');

    // Logout
    Route::get('/logout','logout')
        ->name('logout');

    // Admin
    Route::get('/admin','adminIndex')
        ->name('admin.index');

});