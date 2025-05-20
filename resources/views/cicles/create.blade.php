@extends('layouts.navbar')
@section('title', 'Crear  Cicle')  

@section('alumnos')
<h1 class="mb-4">Crear Cicle</h1>
<form action="{{ route('cicles.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="codi" class="form-label">Codi del Cicle</label>
        <input type="text" class="form-control @error('codi') is-invalid @enderror" id="codi" name="codi" required>
        @error('codi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nom" class="form-label">Nom del Cicle</label>
        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" required>
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="descripcio" class="form-label">Descripció</label>
        <textarea class="form-control @error('descripcio') is-invalid @enderror" id="descripcio" name="descripcio" rows="4"></textarea>
        @error('descripcio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="num_cursos" class="form-label">Nombre de Cursos</label>
        <input type="number" class="form-control @error('num_cursos') is-invalid @enderror" id="num_cursos" name="num_cursos" min="1" required>
        @error('num_cursos')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="imatge" class="form-label">Imatge (URL)</label>
        <input type="url" class="form-control @error('imatge') is-invalid @enderror" id="imatge" name="imatge" accept="image/*">
        @error('imatge')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Crear Cicle</button>
    <a href="{{ route('cicles.index') }}" class="btn btn-secondary">Cancel·lar</a>
</form>
@endsection
