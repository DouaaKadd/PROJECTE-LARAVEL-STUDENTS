@extends('layouts.navbar')
@section('title', 'Notes del Mòdul: ' . $modul->nom)

@section('alumnos')
<div class="container">
    <h1 class="mb-4">Editar Notes del Mòdul: {{ $modul->nom }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Estudiant</th>
                <th>Nota Actual</th>
                <th>Modificar Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modul->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>
                        @if (!is_null($student->pivot->nota))
                            {{ $student->pivot->nota }}
                        @else
                            Sense nota
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('moduls.notes.update', [$modul->id, $student->id]) }}" method="POST" class="d-flex">
                            @csrf
                            @method('PUT')
                            <input type="number" name="nota" class="form-control me-2" value="{{ old('nota', $student->pivot->nota) }}" min="0" max="10" step="0.1" >
                            <button type="submit" class="btn btn-success">Desar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Tornar al panell</a>
</div>
@endsection
