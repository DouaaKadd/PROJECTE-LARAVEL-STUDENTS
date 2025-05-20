<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modul;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Modul::create([
            'nom' => 'Desenvolupament Web amb PHP',
            'codi' => 'PHP101',
            'descripcio' => 'Curs introductori a PHP i Laravel.',
            'total_hores' => 120,
            'imatge' => 'php.jpg',
            'cicle_id' => 1,
        ]);

        Modul::create([
            'nom' => 'Bases de Dades MySQL',
            'codi' => 'DB201',
            'descripcio' => 'Gestió i administració de bases de dades.',
            'total_hores' => 150,
            'imatge' => 'mysql.jpg',
            'cicle_id' => 1,
        ]);

        Modul::create([
            'nom' => 'HTML i CSS avançat',
            'codi' => 'HTML301',
            'descripcio' => 'Desenvolupament web modern amb HTML5 i CSS3.',
            'total_hores' => 100,
            'imatge' => 'html.jpg',
            'cicle_id' => 1,
        ]);

        Modul::create([
            'nom' => 'JavaScript i Frameworks',
            'codi' => 'JS401',
            'descripcio' => 'Programació avançada amb JavaScript, React i Vue.',
            'total_hores' => 130,
            'imatge' => 'js.png',
            'cicle_id' => 1,
        ]);

        Modul::create([
            'nom' => 'Testing i Qualitat del Codi',
            'codi' => 'TEST501',
            'descripcio' => 'Bones pràctiques per assegurar la qualitat del codi.',
            'total_hores' => 120,
            'imatge' => 'test.jpg',
            'cicle_id' => 1,
        ]);

        Modul::create([
            'nom' => 'Backend amb Node.js',
            'codi' => 'NODE601',
            'descripcio' => 'Creació de APIs amb Node.js i Express.',
            'total_hores' => 140,
            'imatge' => 'node.jpg',
            'cicle_id' => 1,
        ]);

        // Módulos para DAM (Desenvolupament d'Aplicacions Multiplataforma)
        Modul::create([
            'nom' => 'Programació en Java',
            'codi' => 'JAVA101',
            'descripcio' => 'Fundamentals de Java per aplicacions multiplataforma.',
            'total_hores' => 130,
            'imatge' => 'java.jpg',
            'cicle_id' => 2,
        ]);

        Modul::create([
            'nom' => 'Desenvolupament d\'Aplicacions Android',
            'codi' => 'ANDROID201',
            'descripcio' => 'Creació d\'apps per Android amb Kotlin.',
            'total_hores' => 140,
            'imatge' => 'android.jpg',
            'cicle_id' => 2,
        ]);

        Modul::create([
            'nom' => 'Programació en Swift per iOS',
            'codi' => 'SWIFT301',
            'descripcio' => 'Desenvolupament d\'apps per iOS amb Swift.',
            'total_hores' => 120,
            'imatge' => 'swift.jpg',
            'cicle_id' => 2,
        ]);

        Modul::create([
            'nom' => 'Desenvolupament de Videojocs',
            'codi' => 'GAME401',
            'descripcio' => 'Creació de videojocs amb Unity i C#.',
            'total_hores' => 150,
            'imatge' => 'game.jpg',
            'cicle_id' => 2,
        ]);

        Modul::create([
            'nom' => 'Arquitectura de Software',
            'codi' => 'ARCH501',
            'descripcio' => 'Patrons de disseny i arquitectura de programari.',
            'total_hores' => 110,
            'imatge' => 'software.jpg',
            'cicle_id' => 2,
        ]);

        Modul::create([
            'nom' => 'Intel·ligència Artificial i Machine Learning',
            'codi' => 'AI601',
            'descripcio' => 'Introducció a la intel·ligència artificial.',
            'total_hores' => 135,
            'imatge' => 'ai.jpg',
            'cicle_id' => 2,
        ]);

        // Módulos para ASIX 
        Modul::create([
            'nom' => 'Administració de Xarxes',
            'codi' => 'NET101',
            'descripcio' => 'Gestió i configuració de xarxes.',
            'total_hores' => 160,
            'imatge' => 'xarxes.jpg',
            'cicle_id' => 3,
        ]);

        Modul::create([
            'nom' => 'Seguretat Informàtica',
            'codi' => 'SEC201',
            'descripcio' => 'Principis de seguretat en sistemes i xarxes.',
            'total_hores' => 170,
            'imatge' => 'seguretat.jpg',
            'cicle_id' => 3,
        ]);

        Modul::create([
            'nom' => 'Virtualització i Cloud Computing',
            'codi' => 'CLOUD301',
            'descripcio' => 'Conceptes i pràctiques de virtualització i cloud.',
            'total_hores' => 140,
            'imatge' => 'cloud.jpg',
            'cicle_id' => 3,
        ]);

        Modul::create([
            'nom' => 'Administració de Servidors Linux',
            'codi' => 'LINUX401',
            'descripcio' => 'Administració de sistemes Linux.',
            'total_hores' => 130,
            'imatge' => 'linux.jpg',
            'cicle_id' => 3,
        ]);

        Modul::create([
            'nom' => 'Gestió de Bases de Dades NoSQL',
            'codi' => 'NOSQL501',
            'descripcio' => 'Bases de dades NoSQL i Big Data.',
            'total_hores' => 140,
            'imatge' => 'nosql.jpg',
            'cicle_id' => 3,
        ]);

        Modul::create([
            'nom' => 'Hacking Ètic',
            'codi' => 'ETHIC601',
            'descripcio' => 'Pràctiques de seguretat i auditoria informàtica.',
            'total_hores' => 160,
            'imatge' => 'hacking.jpg',
            'cicle_id' => 3,
        ]);
    }
}
