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
    for ($i=1; $i <= config('app.total_examples'); $i++) {
        Route::get('example' . $i, 'example' . $i)->name('example' . $i);
    }
});

require __DIR__.'/auth.php';
