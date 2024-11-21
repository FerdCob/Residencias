<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EvidenceController;
use App\Http\Controllers\Admin\FormularioController;
use App\Http\Controllers\Admin\GraficasController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubproductoController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get("/", function () {
    return view('admin.dashboard');
})
    ->middleware("can:Acceso dashboard")
    ->name("dashboard");

Route::resource("categories", CategoryController::class)
    ->except("show");
//->middleware("can:Gestion categorías"); Dejalo asi we
Route::resource("posts", PostController::class)
    ->middleware("can:Gestion articulos")
    ->except("show");
// Correcto, sin duplicar 'admin'
Route::resource(('roles'), RoleController::class)
    ->middleware('can:Gestion roles')
    ->except('show');

Route::resource(('permissions'), PermissionController::class)
    ->middleware('can:Gestion permisos')
    ->except('show');

Route::resource(('users'), UserController::class)
    ->middleware('can:Gestion usuarios')
    ->except('show', 'create', 'store');

Route::resource('hoteles', HotelController::class)
    ->middleware('can:Gestion hoteles')
    ->parameters(['hoteles' => 'hotel'])
    ->except('show');

Route::resource('subproductos', SubproductoController::class)
    ->middleware('can:Gestion subproductos')
    ->except('show');

Route::resource('evidencias', EvidenceController::class)
    ->middleware('can:Gestion evidencias')
    ->except('show');

// Descomentar lo de abajo si deja de funcionar el show del formulario
//Route::get('forms/{idHotel}/{fecha}', [FormularioController::class, 'showWithDate'])->name('forms.showWithDate');
Route::resource('forms', FormularioController::class)
    ->middleware('can:Gestion formulario');

Route::resource('graficas', GraficasController::class);
// Ruta adicional para obtener datos en JSON
Route::get('graficas/datos', [GraficasController::class, 'obtenerDatos'])->name('graficas.datos');
