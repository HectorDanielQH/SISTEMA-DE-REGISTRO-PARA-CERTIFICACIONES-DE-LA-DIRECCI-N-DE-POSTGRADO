<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folders';
    protected $fillable = ['numero_folder','Objeto','fecha_ingreso','fecha_salida','ci'];

    public function persona()
    {
        return $this->belongsTo(Persona::class,'ci','ci');
    }
}
