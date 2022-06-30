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

Route::redirect('/', 'example1');

Route::controller(\App\Http\Controllers\ExampleController::class)->group(function () {
    Route::get('example1', 'example1')->name('example1');
    Route::get('example2', 'example2')->name('example2');
    Route::get('example3', 'example3')->name('example3');
    Route::get('example4', 'example4')->name('example4');
    Route::get('example5', 'example5')->name('example5');
});

require __DIR__.'/auth.php';
