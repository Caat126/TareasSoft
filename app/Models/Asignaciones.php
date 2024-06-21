<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cursos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asignaciones extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'usuario_id',
        'curso_id',
        'nombre',
        'fecha_inicio',
        'fecha_finalizacion',
        'importe',
        'estado'
    ];

    // Relacion con usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relacion con cursos
    public function curso()
    {
        return $this->belongsTo(Cursos::class, 'curso_id');
    }
}
