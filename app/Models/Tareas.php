<?php

namespace App\Models;

use App\Models\Asignaciones;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tareas extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'asig_id',
        'usuario_id',
        'descripcion',
        'entrega',
        'nota'
    ];

    // Relacion con asignaciones
    public function asignacion()
    {
        return $this->belongsTo(Asignaciones::class, 'asig_id');
    }

    // Relacion con usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
