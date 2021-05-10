<?php

use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\PedidoController;
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

Route::resource('distribucionmesas', DistribucionController::class);
Route::resource('mesas', MesaController::class);

Route::get('pedidos/{mesa}/create','App\Http\Controllers\PedidoController@create')->name('pedidos.create');
Route::post('pedidos/{mesa}','App\Http\Controllers\PedidoController@store')->name('pedidos.store');
Route::put('pedidos/{pedido}','App\Http\Controllers\PedidoController@actualizarEstado')->name('pedidos.actualizarEstado');
Route::resource('pedidos', PedidoController::class)->except([
'create', 'store']);
Route::get('/download-pdf', [PedidoController::class, 'downloadPDF']);


Route::resource('facturas', FacturaController::class)->only(['show','update']);
