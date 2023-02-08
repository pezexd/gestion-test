<?php

use App\Http\Controllers\V1\GeneralController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\PDFController as PDFController_V1;

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
Route::get('rollback', function () {
    Artisan::call('migrate:refresh --seed');
    echo '<a href=' . url('/') . '>Se ha reestablecido la configuración, volver al sistema.</a>';
});
Route::get('config-clear', function () {

    Artisan::call('config:clear');
    echo '<a href=' . url('/') . '>Se ha limpiado la configuración, volver al sistema.</a>';
});

// Route::post('format-image', [GeneralController::class, 'store'])->name('format-image');

route::get('/consultas',[PDFController_V1::class, 'consultas']);
