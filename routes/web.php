<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\FrontendController;

//Insert Data
Route::get('liveInsert', [LiveController::class, 'today'])->name('live');
Route::get('yesterdayInsert', [LiveController::class, 'yesterday'])->name('yesterday');
Route::get('dataInsert', [LiveController::class, 'data'])->name('data');
Route::get('stateInsert', [LiveController::class, 'bangladeshDistrictData'])->name('bangladeshDistrictData');
Route::get('vaccineInsert', [LiveController::class, 'vaccineInsert'])->name('vaccineInsert');

Route::get('dataGet/{dataFor}', [ApiController::class, 'dataInsert']);

//For testing
Route::get('test', [LiveController::class, 'test'])->name('test');


//Frontend Show
Route::get('/', [FrontendController::class, 'index'])->name('fIndex');
Route::get('yesterday', [FrontendController::class, 'yesterday'])->name('yesterdayData');
Route::get('country/{name}', [FrontendController::class, 'country'])->name('country');
Route::get('optimize/{todo}', [ArtisanController::class, 'optimize']);
Route::get('sitemap', [ArtisanController::class, 'sitemap'])->name('sitemap');



//Admin Panel
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->group(function () {
    Route::get('/', [dashboardController::class, 'index' ])->name('index');
});

Route::prefix('settings')->group(function (){
    Route::resource('user', AdminController::class);
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::patch('profileChange', [AdminController::class, 'profileChange'])->name('profileChange');
    Route::patch('password', [AdminController::class, 'passwordChange'])->name('password');
    Route::get('passwordChange', [AdminController::class, 'password'])->name('passwordChange');
    Route::get('/', [SettingsController::class, 'index'])->name('basicSettings');
    Route::patch('settingUpdate', [SettingsController::class, 'update'])->name('settingsUpdate');
});

Route::prefix('data')->group(function (){
    Route::get('live', [dashboardController::class, 'liveData'])->name('liveData');
    Route::get('yesterdayShow', [dashboardController::class, 'yesterdayData'])->name('yesterdayShow');
    Route::get('worldometer', [dashboardController::class, 'worldometer'])->name('worldometer');
    Route::get('jhpomber', [dashboardController::class, 'jhpomber'])->name('jhpomber');
    Route::get('vaccineData', [dashboardController::class, 'vaccineData'])->name('vaccineData');
});

Route::prefix('state')->group(function (){
    Route::get('bangladeshToday', [dashboardController::class, 'bangladeshToday'])->name('bangladeshToday');
    Route::get('bangladeshAll', [dashboardController::class, 'bangladeshAll'])->name('bangladeshAll');
});


