<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;

// Login
Route::get('/', [AuthController::class, 'mostrarLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'iniciarSesion'])
    ->name('login.post');

// Rutas que requieren una sesión iniciada
Route::middleware('auth')->group(function () {

    // Home
    Route::get('/home', function () {
        return view('home');
    })->middleware('home.seguro')->name('home');

    // Verificación exclusiva para administradores
    Route::get('/verificacion', function () {
        return view('auth.verificacion');
    })->middleware('rol:admin')->name('verificacion');

    // Validar código
    Route::post('/verificacion', [AuthController::class, 'verificarCodigo'])
        ->middleware('rol:admin')
        ->name('verificacion.validar');

    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'cerrarSesion'])
        ->name('logout');

    // CRUD: rutas permitidas para empleados y administradores
    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->name('usuarios.index');

    Route::get('/usuarios/crear', [UsuarioController::class, 'crear'])
        ->name('usuarios.crear');

    Route::post('/usuarios', [UsuarioController::class, 'guardar'])
        ->name('usuarios.guardar');

});
// Ver detalles de un usuario
Route::get('/usuarios/{id}', [UsuarioController::class, 'mostrar'])
    ->name('usuarios.mostrar');
    

    // Mostrar formulario para editar un usuario
Route::get('/usuarios/{id}/editar', [UsuarioController::class, 'editar'])
    ->name('usuarios.editar');

    // Procesar la actualización de un usuario
Route::put('/usuarios/{id}', [UsuarioController::class, 'actualizar'])
    ->name('usuarios.actualizar');

    // Rutas exclusivas para administradores
Route::middleware('rol:admin')->group(function () {

    // Eliminación lógica de usuarios
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'eliminar'])
        ->name('usuarios.eliminar');

        // Mostrar usuarios eliminados
    Route::get('/usuarios-eliminados', [UsuarioController::class, 'eliminados'])
    ->name('usuarios.eliminados');

    // Restaurar un usuario eliminado
    Route::put('/usuarios/{id}/restaurar', [UsuarioController::class, 'restaurar'])
    ->name('usuarios.restaurar');

    //Eliminar permanentemente
    Route::delete('/usuarios/{id}/eliminar-permanente',
    [UsuarioController::class, 'eliminarPermanente'])
    ->name('usuarios.eliminarPermanente');

});


