<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\UsuariosController;

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
    // return view('welcome');
    return redirect('/login');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // para usuarios
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/usuario/registrar', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/usuario/registrar', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::get('/usuario/editar/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuario/editar/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('/usuario/ver/{id}', [UsuariosController::class, 'show'])->name('usuarios.show');
    Route::delete('/usuario/eliminar/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

    // para cursos
    Route::get('/cursos', [CursosController::class, 'index'])->name('cursos.index');
    Route::get('/curso/registrar', [CursosController::class, 'create'])->name('cursos.create');
    Route::post('/curso/registrar', [CursosController::class, 'store'])->name('cursos.store');
    Route::get('/curso/editar/{id}', [CursosController::class, 'edit'])->name('cursos.edit');
    Route::put('/curso/editar/{id}', [CursosController::class, 'update'])->name('cursos.update');
    Route::get('/curso/ver/{id}', [CursosController::class, 'show'])->name('cursos.show');
    Route::delete('/curso/eliminar/{id}', [CursosController::class, 'destroy'])->name('cursos.destroy');
    Route::get('/curso/estado/{id}', [CursosController::class, 'estado'])->name('cursos.estado');

});


