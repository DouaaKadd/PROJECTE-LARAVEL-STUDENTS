<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Cicle;
use App\Models\Modul;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    
        {
          
        // Obtener todos los estudiantes paginados
        $students = Student::paginate(10);
        $totalEstudiants = Student::count(); // Total d'estudiants amb el count
        $totalCicles = Cicle::count(); 
        $totalModuls = Modul::count();// Total de cicles amb el count

        // Obtener todos los ciclos formativos
        $cicles = Cicle::with('moduls')->get();
        $moduls = Modul::all(); //Obtenim tots els moduls
        $ultimsEstudiants = Student::latest()->take(5)->get(); //Amb la funcio latest() agafem els 5 últims estudiants creats 
        //Consultat a -> https://laravel.com/docs/12.x/queries#limit-and-offset
        $student = Auth::user()->student;
        //Obtenim l'usuari autenticat i el seu estudiant associat
        //Amb la funcio Auth::user() obtenim l'usuari autenticat i amb la funcio ->student accedim al seu estudiant associat
        //Comprovem si l'usuari autenticat té un estudiant associat
        //Si l'usuari autenticat té un estudiant associat, obtenim els mòduls matriculats
        //Si no té un estudiant associat, assignem null a la variable $modulsMatriculats
        if ($student) {
        $modulsMatriculats = $student->moduls()->paginate(3);
        } else {
         $modulsMatriculats = null; 
        }
        
        
            return view('dashboard', compact(
            'students',
            'cicles',
            'totalEstudiants',
            'totalCicles',
            'ultimsEstudiants',
            'moduls',
            'totalModuls',
            'modulsMatriculats'
        ));


        }
    }

