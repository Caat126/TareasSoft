<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tareas;
use App\Models\Asignaciones;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tareas::with('asignacion', 'usuario')->orderBy('id', 'desc')->paginate(5);
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        $asigs = Asignaciones::all();
        return view('tareas.create', compact('asigs', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'asig_id' => 'required|exists:asignaciones,id',
            'usuario_id' => 'required|exists:users,id',
            'descripcion' => 'required',
            'entrega' => 'required',
            'nota' => 'required'
        ]);

        $tarea = new Tareas();
        $tarea->asig_id = $request->asig_id;
        $tarea->usuario_id = $request->usuario_id;
        $tarea->descripcion = $request->descripcion;
        $tarea->entrega = $request->entrega;
        $tarea->nota = $request->nota;
        if ($tarea->save()) {
            return redirect('/tareas')->with('success', 'Tarea creada correctamente');
        } else {
            return back()->with('error', 'Error al crear la tarea');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tarea = Tareas::with('asignacion', 'usuario')->find($id);
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarea = Tareas::find($id);
        $asigs = Asignaciones::all();
        $usuarios = User::all();
        return view('tareas.edit', compact('tarea', 'asigs', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'asig_id' => 'required|exists:asignaciones,id',
            'usuario_id' => 'required|exists:users,id',
            'descripcion' => 'required',
            'entrega' => 'required',
            'nota' => 'required'
        ]);

        $tarea = Tareas::find($id);
        $tarea->asig_id = $request->asig_id;
        $tarea->usuario_id = $request->usuario_id;
        $tarea->descripcion = $request->descripcion;
        $tarea->entrega = $request->entrega;
        $tarea->nota = $request->nota;
        if ($tarea->save()) {
            return redirect('/tareas')->with('success', 'Tarea actualizada correctamente');
        } else {
            return back()->with('error', 'Error al actualizar la tarea');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tarea = Tareas::find($id);
        if ($tarea->delete()) {
            return redirect('/tareas')->with('success', 'Tarea eliminada correctamente');
        } else {
            return back()->with('error', 'Error al eliminar la tarea');
        }
    }
}
