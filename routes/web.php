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

Route::redirect('/', 'tr');

Route::namespace('App\Http\Controllers')->prefix('')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    
    require __DIR__.'/auth.php';

    Route::group(['prefix' => '{language}'], function () {

        Route::get('/', function () {
            return view('home.index');
        });
    });
});


