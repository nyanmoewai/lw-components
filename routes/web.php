<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auto-complete-input', function () {
    return view('auto-complete-input');
});

Route::get('/multiple-choice-quiz', function() {
    return view('multiple-choice-quiz');
});
