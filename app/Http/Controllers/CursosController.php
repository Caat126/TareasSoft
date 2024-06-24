<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Cursos::orderBy('id', 'desc')->paginate(5);
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'imagen' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required',
            'status' => 'nullable',
        ]);

        if($request->file('imagen')){
            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('curso_') . '.png';
            if(!is_dir(public_path('imagenes/cursos'))){
                File::makeDirectory(public_path().'imagenes/cursos', 0777, true);
            }
            $subido = $imagen->move(public_path('imagenes/cursos'), $nombreImagen);
        } else {
            $nombreImagen = 'default.png';
        }

        $curso = new Cursos();
        $curso->name = $request->name;
        $curso->description = $request->description;
        $curso->imagen = $nombreImagen;
        $curso->price = $request->price;
        $curso->status = true;
        if ($curso->save()) {
            return redirect('/cursos')->with('success', 'Curso creado con éxito');
        } else {
            return back()->with('error', 'Error al crear el curso');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $curso = Cursos::find($id);
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $curso = Cursos::find($id);
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg',
            'price' => 'nullable',
            'status' => 'nullable',
        ]);

        $curso = Cursos::find($id);

        if($request->file('imagen')){
            // Eliminar imagen anterior
            if($curso->imagen != 'default.png'){
                if(file_exists(public_path('imagenes/cursos/'.$curso->imagen))){
                    unlink(public_path('imagenes/cursos/'.$curso->imagen));
                }
            }

            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('curso_') . '.png';
            if(!is_dir(public_path('imagenes/cursos'))){
                File::makeDirectory(public_path().'imagenes/cursos', 0777, true);
            }
            $subido = $imagen->move(public_path('imagenes/cursos'), $nombreImagen);
            $curso->imagen = $nombreImagen;
        }

        $curso->name = $request->name;
        $curso->description = $request->description;
        $curso->price = $request->price;
        $curso->status = true;
        if ($curso->save()) {
            return redirect('/cursos')->with('success', 'Curso actualizado con exito');
        } else {
            return back()->with('error', 'Error al actualizar el curso');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $curso = Cursos::find($id);
        // Eliminar la imagen anterior
        if($curso->imagen != 'default.png'){
            if(file_exists(public_path('imagenes/cursos/'.$curso->imagen))){
                unlink(public_path('imagenes/cursos/'.$curso->imagen));
            }
        }
        if($curso->delete()){
            return redirect('/cursos')->with('success', 'Curso eliminado con exito');
        } else {
            return back()->with('error', 'Error al eliminar el curso');
        }
    }

    public function estado($id)
    {
        $curso = Cursos::find($id);
        $curso->status = !$curso ->status;
        if($curso->save()){
            return redirect('/cursos')->with('success', 'Estado del curso actualizado con exito');
        } else {
            return back()->with('error', 'Error al actualizar el estado del curso');
        }
    }
}
