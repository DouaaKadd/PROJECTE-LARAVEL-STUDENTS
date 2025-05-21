<?php

use App\Http\Controllers\CicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModulController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

/*Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('dashboard');
});
*/


Route::get('/dashboard', [DashboardController::class, '__invoke'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route::get('/', [StudentController::class, 'index'])->name('students.index'); 
    //
    //Verifico si el usuario es admin para que el estudiante no pueda acceder a las rutas de admin
    Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/students', [StudentController::class, 'index'])->name('students.index'); 
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create'); 
    Route::post('/students', [StudentController::class, 'store'])->name('students.store'); 
    Route::get('/students/edit/{student}', [StudentController::class, 'edit'])->name('students.edit'); 
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update'); 
    Route::get('/students/destroy/{student}', [StudentController::class, 'destroy'])->name('students.destroy'); 

    //CICLES
    Route::get('/cicles/create',[CicleController::class,'create'])->name('cicles.create');
    Route::post('/cicles',[CicleController::class,'store'])->name('cicles.store');
    Route::get('/cicles/edit/{cicle}',[CicleController::class,'edit'])->name('cicles.edit');
    Route::put('/cicles/{cicle}',[CicleController::class,'update'])->name('cicles.update');
    Route::delete('/cicles/eliminar/{cicle}', [CicleController::class, 'destroy'])->name('cicles.destroy');
    //MODULS
    Route::get('/moduls/create',[ModulController::class,'create'])->name('moduls.create');
    Route::post('/moduls',[ModulController::class,'store'])->name('moduls.store');
    Route::get('/moduls/edit/{modul}',[ModulController::class,'edit'])->name('moduls.edit');
    Route::put('/moduls/{modul}',[ModulController::class,'update'])->name('moduls.update');
    Route::delete('/moduls/eliminar/{modul}', [ModulController::class, 'destroy'])->name('moduls.destroy');

    Route::get('/moduls/{modul}/notes/edit', [ModulController::class, 'editarNotes'])->name('moduls.notes');
    Route::put('/moduls/{modul}/notes/{student}', [ModulController::class, 'modificarNota'])->name('moduls.notes.update');

     });

    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/cicles', [CicleController::class, 'index'])->name('cicles.index');
    Route::get('cicles/{cicle}',[CicleController::class,'show'])->name('cicles.show');
    Route::get('/moduls', [ModulController::class, 'index'])->name('moduls.index');
    Route::get('/moduls/{modul}', [ModulController::class, 'show'])->name('moduls.show');


    Route::post('/students/matricular-cicle/{id}', [StudentController::class, 'matricularCicle'])->name('student.matricularCicle');
    Route::post('/students/desmatricular-cicle/{id}', [StudentController::class, 'desmatricularCicle'])->name('student.desmatricularCicle');
    Route::post('/students/matricular-modul/{id}', [StudentController::class, 'matricularModul'])->name('student.matricularModul');
    Route::post('/students/desmatricular-modul/{id}', [StudentController::class, 'desmatricularModul'])->name('student.desmatricularModul');
    

});    
require __DIR__.'/auth.php';
