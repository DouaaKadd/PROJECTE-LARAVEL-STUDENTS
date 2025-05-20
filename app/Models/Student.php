<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function cicle()
{
    return $this->belongsTo(Cicle::class);
}

    protected $fillable = [
        'name',
        'email',
        'address',
        'birth_date',
        'num_telefon',
        'cicle_id',
        'genere',
        'user_id'
    ];
    public function user() {
        return $this ->belongsTo(User::class);

    }

    public function moduls()
    {
        return $this->belongsToMany(Modul::class, 'alumne_modul')->withPivot('nota');
    }
    
   
}

