@extends('layouts.navbar')

@section('title', 'Vista Estudiant')

@section('alumnos')

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Detalls de l’Estudiant</h3>
        </div>
        <div class="card-body">

            <p><strong>ID:</strong> {{ $student->id }}</p>
            <p><strong>Nom:</strong> {{ $student->name }}</p>
            <p><strong>Correu Electrònic:</strong> {{ $student->email }}</p>
            <p><strong>Adreça:</strong> {{ $student->address }}</p>
            <p><strong>Data de Naixement:</strong> {{ $student->birth_date }}</p>
            <p><strong>Telèfon:</strong> {{ $student->num_telefon }}</p>
            <p><strong>Cicle Formatiu:</strong> {{ $student-> cicle_id}}</p>
            <p><strong>Moduls Matriculats:</strong></p>
            <ul>
                @foreach ($student->moduls as $modul)
                    <li>{{ $modul->nom }}</li>
                @endforeach
        </div>
        <div class="card-footer">
            
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Torna</a>
        </div>
    </div>
</div>
@endsection
