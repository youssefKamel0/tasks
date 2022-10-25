<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController2;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('dashboard/products', [ProductController2::class, 'index'] ); // http://127.0.0.1:8000/api/dashboard/products
Route::get('dashboard/products/create', [ProductController2::class, 'create'] ); // http://127.0.0.1:8000/api/dashboard/products/create
Route::get('dashboard/products/edit/{id}', [ProductController2::class, 'edit'] );  // http://127.0.0.1:8000/api/dashboard/products/edit/5
Route::get('dashboard/products/delete/{id}', [ProductController2::class, 'delete'] );// http://127.0.0.1:8000/api/dashboard/products/delete/5

Route::post('dashboard/products/insert', [ProductController2::class, 'insert']); // http://127.0.0.1:8000/api/dashboard/products/insert
