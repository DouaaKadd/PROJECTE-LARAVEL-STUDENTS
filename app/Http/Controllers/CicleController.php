<?php

namespace App\Http\Controllers;
use App\Models\Cicle;
use Illuminate\Http\Request;

class CicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cicles=Cicle::all();
        return view ('cicles.index', ['cicles'=> $cicles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('cicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
        'nom' => 'required|string|max:255|min:3',
            'descripcio' => 'nullable|string',
            'imatge' => 'nullable|string',
            'num_cursos' => 'required|integer|min:1',
            'codi' => 'required|string|max:10|unique:cicles,codi,'
        ]);

        // Crear un nou estudiant a la BD
        $cicle = new Cicle();
        $cicle->codi = $request ->input('codi');
        $cicle->num_cursos = $request ->input('num_cursos');
        $cicle->imatge = $request ->input('imatge');
        $cicle->nom = $request ->input('nom');
        $cicle->descripcio = $request ->input('descripcio');
        $cicle->save();


        return redirect()->route('cicles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cicle $cicle)
    {
        
        return view('cicles.show',['cicle' => $cicle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cicle $cicle)
    {
        
        return view('cicles.edit',['cicle'=> $cicle]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([ 
            'nom' => 'required|string|max:255|min:3',
            'descripcio' => 'nullable|string',
            'imatge' => 'nullable|string',
            'num_cursos' => 'required|integer|min:1',
            'codi' => 'required|string|max:10|unique:cicles,codi, '.$id,
        ]);

        $cicle = Cicle::findOrFail($id);
        $cicle->codi = $request ->input('codi');
        $cicle->num_cursos = $request ->input('num_cursos');
        $cicle->imatge = $request ->input('imatge');
        $cicle->nom = $request ->input('nom');
        $cicle->descripcio = $request ->input('descripcio');
        $cicle->save();

        return redirect()->route('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cicle = Cicle::findOrFail($id) -> delete();
        return redirect ()-> route ('dashboard');
    }

  
}
