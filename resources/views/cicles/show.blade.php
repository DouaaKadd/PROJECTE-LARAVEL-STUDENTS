@extends('layouts.navbar')

@section('title', 'Detalls del Cicle')

@section('alumnos')
<div class="container">
    <div class="card mb-4">
        <img src="{{ asset('imatges/'. $cicle->imatge) }}" class="card-img-top img-fluid" alt="{{ $cicle->nom }}" style="max-height: 300px; object-fit: cover;">
        <div class="card-body">
            <h3 class="card-title">{{ $cicle->nom }}</h3>
            <p class="card-text"><strong>Codi:</strong> {{ $cicle->codi }}</p>
            <p class="card-text"><strong>Descripció:</strong> {{ $cicle->descripcio }}</p>
            <p class="card-text"><strong>Nombre de cursos:</strong> {{ $cicle->num_cursos }}</p>
        </div>
    </div>

    @if ($cicle->moduls && $cicle->moduls->count() > 0) {{-- Verifico si moduls no es null porque da error y si moduls tiene al menos 1 modulo  --}}
        <h2 class="text-primary mb-4 fw-bold border-bottom pb-2">Mòduls del Cicle</h2>
        <div class="accordion" id="modulsAccordion">
            @foreach ($cicle->moduls as $index => $modul)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-controls="collapse{{ $index }}">
                            {{ $modul->nom }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#modulsAccordion">
                        <div class="accordion-body">
                            <p><strong>Codi:</strong> {{ $modul->codi }}</p>
                            <p><strong>Hores Totals:</strong> {{ $modul->total_hores }}</p>
                            <p><strong>Descripció:</strong> {{ $modul->descripcio }}</p>
                            <img src="{{ asset('imatges/' . $modul->imatge) }}" alt="{{ $modul->nom }}" class="img-fluid mb-3" style="max-height: 200px; object-fit: cover;">

                            {{-- ADMIN --}}
                            @if (Auth::user()->email === 'admin@admin.cat')
                                <div class="d-flex flex-row">
                                    <a href="{{ route('moduls.show', $modul->id) }}" class="btn btn-info me-2">Veure</a>
                                    <a href="{{ route('moduls.edit', $modul->id) }}" class="btn btn-warning me-2">Editar</a>
                                    <form action="{{ route('moduls.destroy', $modul->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>

                            {{-- ESTUDIANT --}}
                            @else
                                @php
                                    $student = Auth::user()->student; // Obtenemos el estudiante autenticado
                                    // Verificamos si el estudiante está matriculado en el módulo con el ID del módulo
                                    $estaMatriculat = $student && $student->moduls->contains($modul->id); //verifica si el id del módulo actual ($modul) esta en el estudiante.
                                @endphp

                                @if ($student)
                                    @if (!$estaMatriculat)
                                        <form action="{{ route('student.matricularModul', $modul->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Matricula't</button>
                                        </form>
                                    @else
                                        <form action="{{ route('student.desmatricularModul', $modul->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Desmatricula't</button>
                                        </form>
                                    @endif
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Tornar al Panell</a>
    </div>
</div>
@endsection
