<?php

use App\Http\Controllers\BebidaController;
use App\Http\Controllers\CartaController;
use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TapaController;
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

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::middleware(['auth','verified'])->group(function(){
    
    Route::get('/home',function(){
        return view('home');
    });
    
    Route::resource('distribucionmesas', DistribucionController::class);
    Route::resource('mesas', MesaController::class);
    Route::resource('tapas', TapaController::class);
    Route::resource('bebidas', BebidaController::class);
    Route::resource('facturas', FacturaController::class)->only(['show','update']);

    Route::group(['prefix' => 'pedidos'], function(){
        Route::get('/{mesa}/create','App\Http\Controllers\PedidoController@create')->name('pedidos.create');
        Route::post('','App\Http\Controllers\PedidoController@store')->name('pedidos.store');
        Route::put('/{pedido}','App\Http\Controllers\PedidoController@actualizarEstado')->name('pedidos.actualizarEstado');
    });

    Route::resource('pedidos', PedidoController::class)->except([
        'create', 'store']);
    
    Route::get('/download-pdf/{factura}', [PedidoController::class, 'downloadPDF']);

    Route::resource('cartas', CartaController::class)->only('index');
    Route::get('/generate-carta', [CartaController::class, 'generateCarta']);
});

Route::get('/download-carta', [CartaController::class, 'downloadCarta']);


