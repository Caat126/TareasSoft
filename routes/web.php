<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

});


