<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\LocalizationController;
use App\Http\Controllers\Frontend\UserController;
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

Route::group(['middleware' => ['web']], function () {

    // Route qui permet de connaître la langue active
    Route::get('locale', [LocalizationController::class, 'getLang'])->name('getlang');
    // Route qui permet de modifier la langue
    Route::get('locale/{lang}', [LocalizationController::class, 'setLang'])->name('setlang');

    Route::get('/contactez-nous', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/a-propos-de-nous', [AboutController::class, 'index'])->name('about.index');

    Route::resource('creer-compte', UserController::class);

    Route::get('/', function () {
        return view('frontend.accueil');
    })->name('/');

});



Route::group(['middleware' => ['web','auth']], function () {

    Route::get('/home', function () {
        return view('frontend.dashboard.index');
    })->name('/');

    Route::get('/mon-profil', [DashboardController::class, 'profil'])->name('mon-profil.index');
    Route::put('/update-mon-profil/{id}', [DashboardController::class, 'updateProfil'])->name('mon-profil.update');

    Route::get('/mes-vols', [DashboardController::class, 'vols'])->name('mes-vols.index');
    Route::get('/mes-hotels', [DashboardController::class, 'hotels'])->name('mes-hotels.index');
    Route::get('/mes-voitures', [DashboardController::class, 'voitures'])->name('mes-voitures.index');

});
