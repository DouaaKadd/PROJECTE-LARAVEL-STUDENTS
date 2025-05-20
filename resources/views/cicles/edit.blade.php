@extends('layouts.navbar')
@section('title', 'Editar Cicle')


@section('alumnos')
<h1 class="mb-4">Editar Cicle</h1>
<form action="{{ route('cicles.update', $cicle->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="codi" class="form-label">Codi del Cicle</label>
        <input type="text" class="form-control @error('codi') is-invalid @enderror" id="codi" name="codi" value="{{ old('codi', $cicle->codi) }}" required>
        @error('codi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $cicle->nom) }}" required>
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="descripcio" class="form-label">Descripció</label>
        <textarea class="form-control @error('descripcio') is-invalid @enderror" id="descripcio" name="descripcio" rows="4" required>{{ old('descripcio', $cicle->descripcio) }}</textarea>
        @error('descripcio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="num_cursos" class="form-label">Nombre de Cursos</label>
        <input type="number" class="form-control @error('num_cursos') is-invalid @enderror" id="num_cursos" name="num_cursos" value="{{ old('num_cursos', $cicle->num_cursos) }}" required>
        @error('num_cursos')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="imatge" class="form-label">Imatge</label>
        <input type="text" class="form-control @error('imatge') is-invalid @enderror" id="imatge" name="imatge" value="{{ old('imatge', $cicle->imatge) }}">
        @error('imatge')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Actualitzar</button>
     <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel·lar</a>
    @endsection
