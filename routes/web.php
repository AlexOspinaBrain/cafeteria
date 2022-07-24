<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
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
    return redirect('dashboard');
});

    /**
     * Rutas y middleware de sesion
     */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * Rutas CRUD producto
     */
    Route::get('inventario',
        [ProductoController::class, 'index']
        )->name('inventario');
    
    Route::get('producto/editar/{id}',
        [ProductoController::class, 'edit']
        )->name('producto.editar');
    
    Route::get('producto/crear',
        [ProductoController::class, 'create']
        )->name('producto.crear');
    
    Route::post('producto/crea',
        [ProductoController::class, 'store']
        )->name('producto.crea');

    Route::put('producto/actualizar/{id}',
        [ProductoController::class, 'update']
        )->name('producto.actualizar');

    Route::delete('producto/borrar/{id}',
        [ProductoController::class, 'destroy']
        )->name('producto.borrar');

    /** 
    * Rutas Ventas
    */
    Route::get('ventas', 
        [VentaController::class, 'index']
        )->name('ventas.index');

    Route::post('ventas/crea', 
        [VentaController::class, 'store']
        )->name('ventas.crea');
    
    /** 
    * Ruta Informe
    */
    Route::get('informes', 
        [VentaController::class, 'informe']
        )->name('informes');

   
});

/**
 * Manage inexistent routes
 */
Route::fallback(function () {
    return redirect('dashboard');
});