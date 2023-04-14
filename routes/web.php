<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CemeteryController;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\RelativeController;
use App\Http\Controllers\PavilionController;
use App\Http\Controllers\NicheController;
use App\Http\Controllers\MausoleumController;
use App\Http\Controllers\InhumationNicheController;
use App\Http\Controllers\InhumationMausoleumController;
use App\Http\Controllers\ExhumationNicheController;
use App\Http\Controllers\ExhumationMausoleumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Login 
Route::get('/home',  [HomeController::class, 'index'])->name('home')->middleware('permission:home');
Route::get('/choice', [HomeController::class, 'choice'])->name('choice');
Route::get('/select/{id}', [HomeController::class, 'select'])->name('select');

// Consultas
Route::get('search', [SearchController::class, 'index'])->name('search');
Route::get('search/niche', [SearchController::class, 'niche']);
Route::get('search/mausoleum', [SearchController::class, 'mausoleum']);

// App
Route::middleware(['auth'])->group( function () {

    Route::apiResource('cemetery', CemeteryController::class)->except(['show'])->middleware('permission:cemetery');
    Route::apiResource('deceased', DeceasedController::class)->except(['show'])->middleware('permission:deceased');
    Route::apiResource('relative', RelativeController::class)->except(['show'])->middleware('permission:relative');
    Route::apiResource('pavilion', PavilionController::class)->except(['show'])->middleware('permission:pavilion');

    Route::apiResource('niche', NicheController::class)->middleware('permission:niche');
    Route::apiResource('mausoleum', MausoleumController::class)->middleware('permission:mausoleum');

    Route::middleware(['permission:inhumation'])->group( function () {

        Route::apiResource('niches/inhumation', InhumationNicheController::class)->names([
            
            'index'   => 'niche.inhumation.index',
            'store'   => 'niche.inhumation.store',
            'update'  => 'niche.inhumation.update',
            'destroy' => 'niche.inhumation.destroy'

        ])->except(['show']);

        Route::apiResource('mausoleums/inhumation', InhumationMausoleumController::class)->names([
            
            'index'   => 'mausoleum.inhumation.index',
            'store'   => 'mausoleum.inhumation.store',
            'update'  => 'mausoleum.inhumation.update',
            'destroy' => 'mausoleum.inhumation.destroy'

        ])->except(['show']);

    });

    Route::middleware(['permission:exhumation'])->group( function () {

        Route::apiResource('niches/exhumation', ExhumationNicheController::class)->names([
            
            'index'   => 'niche.exhumation.index',
            'store'   => 'niche.exhumation.store',
            'update'  => 'niche.exhumation.update',
            'destroy' => 'niche.exhumation.destroy'

        ])->except(['show']);

        Route::apiResource('mausoleums/exhumation', ExhumationMausoleumController::class)->names([
            
            'index'   => 'mausoleum.exhumation.index',
            'store'   => 'mausoleum.exhumation.store',
            'update'  => 'mausoleum.exhumation.update',
            'destroy' => 'mausoleum.exhumation.destroy'

        ])->except(['show']);   

     });

    Route::prefix('api')->group( function () {
        Route::get('pavilion', [PavilionController::class, 'get'])->middleware('permission:pavilion');
        Route::get('deceased', [DeceasedController::class, 'get'])->middleware('permission:deceased');
        Route::get('relative', [RelativeController::class, 'get'])->middleware('permission:relative');

        Route::get('niche', [NicheController::class, 'get'])->middleware('permission:niche');
        Route::get('mausoleum', [MausoleumController::class, 'get'])->middleware('permission:mausoleum');

        Route::get('niches/inhumation', [InhumationNicheController::class, 'get'])->middleware('permission:inhumation');
        Route::get('mausoleums/inhumation', [InhumationMausoleumController::class, 'get'])->middleware('permission:inhumation');
    });
});
