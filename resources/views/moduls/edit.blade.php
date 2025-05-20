@extends('layouts.navbar')
@section('title', 'Editar Mòdul')

@section('alumnos')
<div class="container my-4">
    <h1 class="mb-4">Editar Mòdul</h1>

    <form action="{{ route('moduls.update', $modul->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom del Mòdul</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $modul->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="codi" class="form-label">Codi</label>
            <input type="text" name="codi" id="codi" class="form-control" value="{{ old('codi', $modul->codi) }}" required>
        </div>

        <div class="mb-3">
            <label for="total_hores" class="form-label">Hores Totals</label>
            <input type="number" name="total_hores" id="total_hores" class="form-control" value="{{ old('total_hores', $modul->total_hores) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcio" class="form-label">Descripció</label>
            <textarea name="descripcio" id="descripcio" class="form-control" rows="4" required>{{ old('descripcio', $modul->descripcio) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="imatge" class="form-label">Imatge </label>
            <input type="url" name="imatge" id="imatge" class="form-control">
            @if ($modul->imatge)
                <small class="d-block mt-2">Imatge actual: <strong>{{ $modul->imatge }}</strong></small>
                <img src="{{ asset('imatges/' . $modul->imatge) }}" alt="{{ $modul->nom }}" class="img-fluid mt-2" style="max-height: 150px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="cicle_id" class="form-label">Cicle Formatiu</label>
            <select name="cicle_id" id="cicle_id" class="form-select" required>
                <option value="">-- Selecciona un cicle --</option>
                @foreach ($cicles as $cicle)
                    @if (old('cicle_id', $modul->cicle_id) == $cicle->id)
                        <option value="{{ $cicle->id }}" selected>{{ $cicle->nom }}</option>
                    @else
                        <option value="{{ $cicle->id }}">{{ $cicle->nom }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualitzar</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection
