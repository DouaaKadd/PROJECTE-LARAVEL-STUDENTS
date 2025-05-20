<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul;
use App\Models\Cicle;
use App\Models\Student;
use Illuminate\Validation\ValidationException;


class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moduls=Modul::all();
        return view ('moduls.index', ['moduls'=> $moduls]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cicles = Cicle::all();
        return view ('moduls.create', ['cicles'=> $cicles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $request->validate([ 
            'nom' => 'required|string|max:255|min:2',
            'descripcio' => 'nullable|string',
            'total_hores' => 'required|integer|min:1',
            'codi' => 'required|string|max:10|unique:moduls,codi,',
            'cicle_id' => 'required|exists:cicles,id'
        ]);
               
        // Crear un nou estudiant a la BD
        $modul = new Modul();
        $modul->codi = $request ->input('codi');
        $modul->total_hores = $request ->input('total_hores');
        $modul->imatge = $request ->input('imatge');
        $modul->nom = $request ->input('nom');
        $modul->descripcio = $request ->input('descripcio');
        $modul->cicle_id = $request->input('cicle_id');
        $modul->save();
        
        return redirect()->route('dashboard');
         } catch (ValidationException $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Modul $modul)
    {
        return view('moduls.show',['modul' => $modul]);
    }
    
        //
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modul $modul)
    {
        $cicles = Cicle::all();
        return view('moduls.edit', compact ('modul', 'cicles'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
        $request->validate([ 
            'nom' => 'required|string|max:255|min:2',
            'descripcio' => 'nullable|string',
            'imatge' => 'nullable|string',
            'total_hores' => 'required|integer|min:1',
            'codi' => 'required|string|max:10|unique:moduls,codi,' . $id,
            'cicle_id' => 'required|exists:cicles,id',
        ]);

        // Actualitzar el cicle a la BD
        $modul = Modul::findOrFail($id);
        $modul->codi = $request ->input('codi');
        $modul->total_hores = $request ->input('total_hores');
        $modul->imatge = $request ->input('imatge');
        $modul->nom = $request ->input('nom');
        $modul->descripcio = $request ->input('descripcio');
        $modul->cicle_id = $request->input('cicle_id');
        $modul->save();
        
        return redirect()->route('dashboard');
         } catch (ValidationException $e) {
            dd($e);
        }
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modul=Modul::findOrFail($id) -> delete();
        return redirect()->route('dashboard');
    }   

    public function modificarNota(Request $request, $modul_id, $student_id)
{
    $request->validate([
        'nota' => 'nullable|numeric|min:0|max:10',
    ]);
// Validar que la nota es numérica y está entre 0 y 10
    $student = Student::findOrFail($student_id); // Buscamos el estudiante por su ID
    $student->moduls()->syncWithoutDetaching([ // Sincronizo la relación sin eliminar las notas existentes
        $modul_id => ['nota' => $request->nota] // Actualizo la nota
    ]);

    return redirect()->route('moduls.notes', $modul_id)->with('success', 'Nota actualitzada correctament.');
}

public function editarNotes($modul_id)
{
    $modul = Modul::with('students')->findOrFail($modul_id); // Cargo  los estudiantes
    return view('moduls.notes', compact('modul')); // Paso el módulo a la vista
}

}
