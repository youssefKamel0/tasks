<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->name('dashboard')->middleware(['auth','verified'])->group(function(){
    Route::get('/',[DashboardController::class,'index']);
    Route::prefix('products')->name('.products.')->controller(ProductController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/insert','insert')->name('insert');
        Route::put('/update/{id}','update')->name('update');
        Route::delete('/delete/{id}','delete')->name('delete');
    });
});

// Route::get('/', [DashboardController::class,'index']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
