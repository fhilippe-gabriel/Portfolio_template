<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('public.layout');
// });

Route::get('/', [PortfolioController::class, 'index'])->name('home');
