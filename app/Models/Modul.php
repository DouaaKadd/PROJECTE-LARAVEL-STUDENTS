<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $fillable = [
        'nom',
        'codi',
        'descripcio',
        'total_hores',
        'imatge',
        'cicle_id'
    ];

public function students(){
    return $this->belongsToMany(Student::class, 'alumne_modul')->withPivot('nota');
}

public function cicle()
{
    return $this->belongsTo(Cicle::class);

}

}