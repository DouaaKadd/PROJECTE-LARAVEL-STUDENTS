<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cicle;
use App\Models\Modul;
use App\Models\Student;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtenir tots els estudiants de la BD
        // Retornar la vista amb les dades dels estudiants
        $students = Student::with('moduls')->orderBy('id', 'asc')->paginate(10);
    //LLama a todos los estudiantes
        return view('students.index', ['students' => $students]); // devuelve la vista y pasa todos los estudaintes
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cicles = Cicle::all();
        return view('students.create', compact('cicles')); // devuelve la vista de crear estudiante y pasa todos los ciclos
    }

    /**
     * Store a newly created resource in storage.
     */
    // Rebre les dades del formulari per guardar l'element a la BD
    public function store(Request $request)
    {
        // Validació de les dades del formulari
        $request->validate([ 
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:students,email' ,
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'num_telefon' => 'required|string|max:15',
            // 'cicle_id' => 'nullable|exists:cicles,id', // Asegura que el valor sea uno de los ciclos específicos
            //'user_id' => 'required|exists:users,id', // Assegura que el user_id existeix a la taula users

        ]);

        // Crear un nou estudiant a la BD
        $student = new Student(); // nuevo objeto student y le asigna los valores del form
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->birth_date = $request->input('birth_date');
        $student->num_telefon = $request->input('num_telefon');
        
        $student->user_id = Auth::id();
        $student->save(); 
        return redirect()->route('students.index');
    }// guarda el estudiante en la base de datos
    /**
     * Display the specified resource.
     */
    // Mostrar un únic element del CRUD 
    public function show($id)
    {
        // Buscar l'estudiant per ID
        $student = Student::findOrFail($id); //busca el estudiante por su id si no lo encuetra muestra el tipico error 404

        // Retornar la vista amb l'estudiant trobat
        return view('students.show', ['student' => $student]); //pasa el estudiante para mostrar lso detalles
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Editar les dades dels alumnes
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $cicles = Cicle::all(); // Obtener todos los ciclos formativos
        // Retornar la vista d'edició amb l'estudiant corresponent
        return view('students.edit', ['student' => $student], ['cicles' => $cicles]); // pasa el estudiante y todos los ciclos para mostrar en el formulario
    }

    /**
     * Update the specified resource in storage.
     */
    // Actualitzar un element ja existent en la BD
    public function update(Request $request, string $id)
    {
        // Validació de les dades del formulari per a l'actualització
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:students,email,' . $id,
            'address' => 'required|string|max:500',
            'birth_date' => 'required|date',
            'num_telefon' => 'required|string|max:15',
            'cicle_id' => 'nullable|exists:cicles,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Actualitzar les dades de l'estudiant
        $student= Student::findOrFail($id); //busca al estudiante mediante el id
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->birth_date = $request->input('birth_date');
        $student->num_telefon = $request->input('num_telefon');
        $student->cicle_id = $request->input('cicle_id');
        $student->save(); 
        // Redirigir a la llista d'estudiants 
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Eliminar de la BD l'element seleccionat
    public function destroy(string $id)
    {
        // Esborrar l'estudiant de la BD
        $student = Student::findOrFail($id) -> delete(); 
        // Redirigir a la llista d'estudiants 
        return redirect()->route('students.index');
    }

public function matricularCicle(Request $request, $id)
{
   $user = Auth::user(); // Obtener el usuario autenticado
   $student= $user->student; // Obtener el estudiante asociado al usuario
   $cicle = Cicle::findOrFail($id); // Busco el ciclo por su ID
   $student->cicle_id = $cicle->id; // Asigno el ID del ciclo al estudiante
   $student->save(); // Guardo los cambios en la base de datos
    return redirect()->route('dashboard');
}

public function desmatricularCicle(Request $request, $id)
{
    $user = Auth::user(); // Obtener el usuario autenticado
    $student= $user->student; // Obtener el estudiante asociado al usuario
    $student->cicle_id = null; // Asignar el ID del ciclo al estudiante = null para desmatricularlo
    $student->save(); // Guardar los cambios en la base de datosç
    $modulsCicle = Modul::where('cicle_id', $id)->get(); // Obtener todos los módulos del ciclo con el ID especificado gracias al where i el get
    foreach ($modulsCicle as $modul) { //para cada módulo del ciclo
        // Desmatriculo el estudiante de cada módulo con el ID especificado para que cuando se desmatricule el ciclo se desmatricule de todos los módulos
        $student->moduls()->detach($modul->id); 
    } 
    
     return redirect()->route('dashboard');
}

public function matricularModul(Request $request, $id)
{
   $student = Auth::user()->student; // Obtener el estudiante asociado al usuario
   $modul = Modul::findOrFail($id); // Buscar el módulo por su ID
   if (is_null($student->cicle_id)) { //si el estudiante no está matriculado en un ciclo
       $student->cicle_id = $modul->cicle_id; //Assigno el ID del ciclo al estudiante para que se matricule en el ciclo del módulo
        $student->save();
   } 
   $notaAleatoria = rand(0, 10); // Genero una nota aleatoria entre 0 y 10
   $student->moduls()->syncWithoutDetaching([$id => ['nota' => $notaAleatoria]] ); // Matricular el estudiante en el módulo con el syncWithoutDetaching para no eliminar las notas existentes
    //return redirect()->route('dashboard');
    return redirect()->back(); // Redirigir a la página anterior ( la misma página)
} 

public function desmatricularModul(Request $request, $id)
{
    $student = Auth::user()->student;
    $student->moduls()->detach($id); // Desmatricular el estudiante del módulo
     //return redirect()->route('dashboard');
    return redirect()->back(); // Redirigir a la página anterior ( la misma página)
}


}
