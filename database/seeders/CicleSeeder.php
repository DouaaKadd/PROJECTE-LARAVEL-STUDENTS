<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('cicles')->insert([
            [
                'nom' => 'DAW',
                'descripcio' => 'Desenvolupament d’Aplicacions Web, un cicle on aprendràs a dissenyar i desenvolupar pàgines web i aplicacions interactives.',
                'codi' => 'DAW245',
                'num_cursos' => 2,
                'imatge' => 'daw.png',
            ],
            [
                'nom' => 'DAM',
                'descripcio' => 'Desenvolupament d’Aplicacions Multiplataforma, un cicle on aprendràs a crear aplicacions per a dispositius mòbils i entorns d’escriptori.',
                'codi' => 'DAM245',
                'num_cursos' => 2,
                'imatge' => 'dam.png',
            ],
            [
                'nom' => 'ASIX',
                'descripcio' => 'Administració de Sistemes Informàtics en Xarxa, un cicle on aprendràs a gestionar sistemes informàtics i configurar xarxes de manera eficient.',
                'codi' => 'ASIX245',
                'num_cursos' => 2,
                'imatge' => 'asix.jpg',
            ],
        ]);
    }
}
