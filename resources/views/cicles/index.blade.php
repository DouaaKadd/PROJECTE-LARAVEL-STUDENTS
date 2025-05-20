@extends('layouts.navbar')
@section('title', 'Cicles Formatius')

@section('alumnos')
<h1 class="mb-4">Cicles Formatius</h1>

<div class="row">
    @foreach ($cicles as $cicle)
        <div class="col-md-4 mb-4 d-flex">
            <div class="card w-100 h-100 d-flex flex-column">
                <img src="{{ asset('imatges/'.$cicle->imatge) }}" class="card-img-top object-fit-cover" alt="{{ $cicle->nom }}" style="height: 200px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $cicle->nom }}</h5>
                    <p class="card-text flex-grow-1">{{$cicle->descripcio}}</p>
                    <a href="{{ route('cicles.show', $cicle->id) }}" class="btn btn-primary mt-auto">Veure més</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<a href="{{ route('dashboard') }}" class="btn btn-success mb-3">Tornar al Panell</a>

@endsection
