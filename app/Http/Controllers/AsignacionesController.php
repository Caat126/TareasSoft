<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cursos;
use App\Models\Asignaciones;
use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asigs = Asignaciones::with('usuario', 'curso')->orderBy('id', 'desc')->paginate(5);
        return view('asignaciones.index', compact('asigs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        $cursos = Cursos::where('status', true)->get();
        return view('asignaciones.create', compact('cursos', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'usuario_id' => 'required|exists:users,id',
            'curso_id' => 'required|exists:cursos,id',
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'fecha_finalizacion' => 'required',
            'importe' => 'required',
            'estado' => 'nullable',
        ]);

        $asig = new Asignaciones();
        $asig->usuario_id = $request->usuario_id;
        $asig->curso_id = $request->curso_id;
        $asig->nombre = $request->nombre;
        $asig->fecha_inicio = $request->fecha_inicio;
        $asig->fecha_finalizacion = $request->fecha_finalizacion;
        $asig->importe = $request->importe;
        $asig->estado = true;
        if ($asig->save()) {
            return redirect('/asignaciones')->with('success', 'Asignación creada con éxito');
        } else {
            return back()->with('error', 'Error al crear la asignación');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asig = Asignaciones::with('usuario', 'curso')->find($id);
        return view('asignaciones.show', compact('asig'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $asig = Asignaciones::find($id);
        $usuarios = User::all();
        $cursos = Cursos::where('status', true)->get();
        return view('asignaciones.edit', compact('asig', 'usuarios', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'usuario_id' => 'required|exists:users,id',
            'curso_id' => 'required|exists:cursos,id',
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'fecha_finalizacion' => 'required',
            'importe' => 'required',
            'estado' => 'nullable',
        ]);

        $asig = Asignaciones::find($id);
        $asig->usuario_id = $request->usuario_id;
        $asig->curso_id = $request->curso_id;
        $asig->nombre = $request->nombre;
        $asig->fecha_inicio = $request->fecha_inicio;
        $asig->fecha_finalizacion = $request->fecha_finalizacion;
        $asig->importe = $request->importe;
        $asig->estado = true;
        if ($asig->save()) {
            return redirect('/asignaciones')->with('success', 'Asignación actualizada con éxito');
        } else {
            return back()->with('error', 'Error al actualizar la asignación');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asig = Asignaciones::find($id);
        if($asig->delete()){
            return redirect('/asignaciones')->with('success', 'Asignación eliminada con éxito');
        } else {
            return back()->with('error', 'Error al eliminar la asignación');
        }
    }

    public function estado($id)
    {
        $asig = Asignaciones::find($id);
        $asig->estado = !$asig->estado;
        if($asig->save()){
            return redirect('/asignaciones')->with('success', 'Estado de la asignación actualizado con éxito');
        } else {
            return back()->with('error', 'Error al actualizar el estado de la asignación');
        }
    }
}
