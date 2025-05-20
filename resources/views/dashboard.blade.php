@extends('layouts.navbar')

@section('alumnos')

<div class="container my-4">
    @if (Auth::user()->email === 'admin@admin.cat')
        {{-- Contenido para administradores --}}
        <h1 class="mb-4">Panell d'Administració</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total d'Estudiants</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalEstudiants }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total de Cicles</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalCicles }}</h5>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Moduls</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalModuls }}</h5>
                    </div>
                </div>
        </div>
        
        <h2 class="mt-4">Estudiants Recents</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Cicle</th>
                    <th>Data de Creació</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ultimsEstudiants as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @if ($student->cicle)
                                <span style="display: inline-block; padding: 3px 6px; background-color: #add8e6; color: black; border-radius: 3px; font-size: 14px;">
                                    {{ $student->cicle->nom }}
                                </span>
                            @else
                                <span style="display: inline-block; padding: 3px 6px; background-color: #fa8072; color: white; border-radius: 3px; font-size: 14px;">
                                    Sense Cicle
                                </span>
                            @endif
                        </td>
                        <td>{{ $student->created_at->format('d/m/Y') }}</td> {{--Consultado en : https://laravel.com/docs/12.x/eloquent-mutators#date-casting--}} 
                    

                    </tr>
                @endforeach
            </tbody>
        </table>
            

        <h2 class="mt-4">Llista Completa</h2>
        <div class="mb-3">
            <a href="{{ route('students.index') }}" class="btn btn-info">Veure Llista Completa d'Estudiants</a>
        </div>

        <h2 class="mt-4">Cicles Formatius</h2>
        <div class="row">
            @foreach ($cicles as $cicle)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100 d-flex flex-column h-100">
                        <img src="{{ asset('imatges/'.$cicle->imatge) }}" class="card-img-top" alt="{{ $cicle->nom }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $cicle->nom }}</h5>
                            <p class="card-text flex-grow-1">{{ ($cicle->descripcio) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('cicles.show', $cicle->id) }}" class="btn btn-info me-1">Veure</a>
                                <a href="{{ route('cicles.edit', $cicle->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('cicles.destroy', $cicle->id) }}" method="POST" class="d-inline ms-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3 text-center">
            <a href="{{ route('cicles.create') }}" class="btn btn-success"> Afegir un nou Cicle</a>
        </div>
        
<h2 class="mt-5">Mòduls Formatius per Cicle</h2>

@foreach ($cicles as $cicle)
    @if ($cicle->moduls && $cicle->moduls->count() > 0) 
        <div class="mt-5 mb-5">
<h3 class="mb-4 text-primary fw-bold border-bottom pb-2">{{ $cicle->nom }}</h3>
            <div id="carouselModuls{{ $cicle->id }}" class="carousel slide" data-bs-ride="carousel" style="padding: 0 60px;">
                <div class="carousel-inner">
                    @foreach ($cicle->moduls->chunk(3) as $tresmoduls => $tres) <!-- Agrupem els mòduls en grups de 3 : https://laravel.com/docs/12.x/queries#chunking-results-->
                        @if ($tresmoduls === 0)
                            <div class="carousel-item active">
                        @else
                            <div class="carousel-item">
                        @endif
                            <div class="row gx-4">
                                @foreach ($tres as $modul)
                                    <div class="col-md-4 mb-4 d-flex">
                                        <div class="card w-100 d-flex flex-column h-100">
                                            <img src="{{ asset('imatges/' . $modul->imatge) }}" class="card-img-top" alt="{{ $modul->nom }}" style="height: 200px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $modul->nom }}</h5>
                                                <p class="card-text flex-grow-1">{{ $modul->descripcio }}</p>
                                                <div class="mt-auto">
                                                    <a href="{{ route('moduls.show', $modul->id) }}" class="btn btn-info me-2">Veure</a>
                                                    <a href="{{ route('moduls.edit', $modul->id) }}" class="btn btn-warning me-2">Editar</a>
                                                    <a href="{{ route('moduls.notes', $modul->id) }}" class="btn btn-primary me-2">Notes</a> 


                                                    <form action="{{ route('moduls.destroy', $modul->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button"
                        data-bs-target="#carouselModuls{{ $cicle->id }}" data-bs-slide="prev"
                        style="width: 5%; left: 0; top: 50%; transform: translateY(-50%); z-index: 2;">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                </button>

                <button class="carousel-control-next" type="button"
                        data-bs-target="#carouselModuls{{ $cicle->id }}" data-bs-slide="next"
                        style="width: 5%; right: 0; top: 50%; transform: translateY(-50%); z-index: 2;">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                </button>



            </div>
        </div>
    @endif
@endforeach
                <div class="mt-3 text-center">
                    <a href="{{ route('moduls.create') }}" class="btn btn-success">
                        Afegir un nou Mòdul
                    </a>
                </div>
    @else

        <h1 class="mb-4">Benvingut/da, {{ Auth::user()->name }}</h1>

        <div class="card mb-4 border-1">
           
            <div class="card-body">
                <h4 class="card-title">Les Teves Dades</h4>
                <p class="card-text"><strong>Nom:</strong> {{ Auth::user()->name }}</p>
                <p class="card-text"><strong>Correu Electrònic:</strong> {{ Auth::user()->email }}</p>
                <p class="card-text"><strong>Gènere:</strong> 
                @if (Auth::user()->student->genere === 'home')
                    Home
                @elseif (Auth::user()->student->genere === 'dona')
                    Dona
                @else
                    No especificat
                @endif
            </p>
                <p class="card-text"><strong>Cicle:</strong> 
                    @if (Auth::user()->student->cicle)
                        {{ Auth::user()->student->cicle->nom }}
                    @else
                        No matriculat
                    @endif
                </p>
                @php
                $genere = Auth::user()->student->genere;
                $avatar = $genere === 'dona' ? 'chica.jpg' : 'chico.jpg'; // si el gènere és 'dona', mostra 'chica.jpg', sinó mostra 'chico.jpg'
            @endphp

            <img src="{{ asset('imatges/' . $avatar) }}" class="rounded-circle mb-3" alt="Avatar" style="width: 120px; height: 120px; object-fit: cover;">
            </div>
        </div>

        @if ( Auth::user()->student->cicle_id)

    {{-- Mostrar cicle i mòduls matriculats --}}
    <div class="card mb-4">
        <img src="{{ asset('imatges/'.Auth::user()->student->cicle->imatge) }}" class="card-img-top" alt="{{ Auth::user()->student->cicle->nom }}" style="height: 400px; object-fit: cover;">
        <div class="card-body">
            <h4 class="card-title">{{ Auth::user()->student->cicle->nom }}</h4>
            <p class="card-text">{{ Auth::user()->student->cicle->descripcio }}</p>
            <p class="card-text"><strong>Nombre de Cursos:</strong> {{ Auth::user()->student->cicle->num_cursos }}</p>
            <form action="{{ route('student.desmatricularCicle', Auth::user()->student->cicle->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Desmatricula't</button>
            </form>
        </div>
    </div>

    @if ($modulsMatriculats->count() > 0)
        <h3 class="mt-4">Mòduls Matriculats</h3>
        <div class="row">
            @foreach ($modulsMatriculats as $modul)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100 d-flex flex-column h-100">
                        <img src="{{ asset('imatges/'.$modul->imatge) }}" class="card-img-top" alt="{{ $modul->nom }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $modul->nom }}</h5>
                            <p class="card-text flex-grow-1">{{ $modul->descripcio }}</p>
                            <p class="card-text"><strong>Nota:</strong> {{ $modul->pivot->nota }}</p>
                            <form action="{{ route('student.desmatricularModul', $modul->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" class="btn btn-warning">Desmatricula't</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
        {{ $modulsMatriculats->links() }}
    </div>
        </div>
        
    @else
        <p class="text-muted">No estàs matriculat en cap mòdul.</p>
    @endif

@else
    {{-- Mostrar cicles disponibles --}}
    
    <h2 class="mt-4">Cicles Disponibles</h2>
    <div class="row">
        @foreach ($cicles as $cicle)
            <div class="col-md-4 mb-4 d-flex">
                <div class="card w-100 d-flex flex-column h-100">
                    <img src="{{ asset('imatges/'.$cicle->imatge) }}" class="card-img-top" alt="{{ $cicle->nom }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $cicle->nom }}</h5>
                        <p class="card-text flex-grow-1">{{ $cicle->descripcio }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('cicles.show', $cicle->id) }}" class="btn btn-info">Veure</a>
                            <form action="{{ route('student.matricularCicle', $cicle->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Matricula't</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
    @endif
</div>  
@endsection
