<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cicle extends Model
{
    protected $fillable = 
    ['codi', 
    'nom', 
    'descripcio',
    'num_cursos',
    'imatge'
    ]; 
    public function students()
    {
        return $this->hasMany(Student::class, 'cicle_id');
    }

    
    public function moduls()
    {
        return $this->hasMany(Modul::class, 'cicle_id');
    }
  

}
