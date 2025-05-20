@extends('layouts.navbar') 

@section('alumnos')
<div class="container my-4">
    <h1 class="mb-4">{{ $modul->nom }}</h1>

    <div class="row">
        <div class="col-md-6">
            @if ($modul->imatge)
                <img src="{{ asset('imatges/' . $modul->imatge) }}" alt="Imatge del mòdul {{ $modul->nom }}" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
            @else
                <p><em>Sense imatge</em></p>
            @endif
        </div>
        <div class="col-md-6">
            <p><strong>Codi:</strong> {{ $modul->codi }}</p>
            <p><strong>Descripció:</strong></p>
            <p>{{ $modul->descripcio }}</p>
            <p><strong>Hores totals:</strong> {{ $modul->total_hores }}</p>
            <p><strong>Cicle formatiu:</strong>
                 
            <?php 
            if ($modul->cicle) {
                echo $modul->cicle->nom;
               } else {
                echo 'Sense cicle';
            }
             ?>
            </p>

            {{-- Botó de matrícula solo si es estudiante y no está matriculado --}}
            @auth
                @if (Auth::user()->email !== 'admin@admin.cat' )
                    @php
                        $matriculat = $modul->students->contains(Auth::user()->student->id);
                    @endphp

                    @if (!$matriculat)
                        <form action="{{ route('moduls.enroll', $modul->id) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-success">Matricula'm</button>
                        </form>
                    @else
                        <p class="mt-3 text-success"><strong>Ja estàs matriculat en aquest mòdul.</strong></p>
                    @endif
                @endif
            @endauth
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Tornar al Panell</a>
    </div>
</div>

@endsection
