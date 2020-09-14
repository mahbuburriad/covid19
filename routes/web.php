<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\FrontendController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/live', [LiveController::class, 'today'])->name('live');
Route::get('/yesterday', [LiveController::class, 'yesterday'])->name('yesterday');
Route::get('/data', [LiveController::class, 'data'])->name('data');
Route::get('/bangladeshDistrictData', [LiveController::class, 'bangladeshDistrictData'])->name('bangladeshDistrictData');


Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('yesterdayData', [FrontendController::class, 'yesterday'])->name('yesterdayData');
Route::get('country/{data}', [FrontendController::class, 'country'])->name('country');
