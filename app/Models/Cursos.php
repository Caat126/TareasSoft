<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'name',
        'description',
        'imagen',
        'price',
        'status'
    ];

    // obtener la imagen
    public function getImagenUrl()
    {
        if($this->imagen && $this->imagen != 'default.png' && $this->imagen != null){
            return asset ('imagenes/cursos/'.$this->imagen);
        } else {
            return asset ('default.png');
        }
    }
}
