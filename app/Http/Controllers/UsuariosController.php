<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::orderBy('id', 'desc')->paginate(5);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        if ($usuario->save()) {
            return redirect('/usuarios')->with('success', 'Usuario creado con éxito');
        } else {
            return back()->with('error', 'Error al crear el usuario');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,' . $id,
        ]);

        $usuario = User::find($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        if ($usuario->save()) {
            return redirect('/usuarios')->with('success', 'Usuario actualizado con éxito');
        } else {
            return back()->with('error', 'Error al actualizar el usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario->delete()) {
            return redirect('/usuarios')->with('success', 'Usuario eliminado con éxito');
        } else {
            return back()->with('error', 'Error al eliminar el usuario');
        }
    }
}
