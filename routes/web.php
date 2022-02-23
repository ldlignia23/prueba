<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;

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

Auth::routes();


Route::get('/home', [App\Http\Controllers\PersonaController::class, 'persAdd'])->name('registro');
Route::get('/filtrado', [App\Http\Controllers\PersonaController::class, 'persList'])->name('filtrado');

Route::apiresource('/registros',PersonaController::class);