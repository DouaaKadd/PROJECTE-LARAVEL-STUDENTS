@extends('layouts.navbar')

@section('title', 'Afegir Estudiant')

@section('alumnos')
<div class="container-sm mt-4"> {{--cont con márgenes--}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Afegir Estudiant</h3>
        </div>
        <div class="card-body"> {{--Envío los datos al store del controller, es el que tratará los datos del form--}}
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nom</label>
                        {{--@error es para mostrar mensajes de error si no cumple con las validaciones que le he puesto en el controller--}} 
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        {{--el old se usa para que no se borren los datos que ha puesto el usuario anteriormente--}}
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adreça</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo para la fecha de nacimiento --}}
                <div class="mb-3">
                    <label for="birth_date" class="form-label">Data de Naixement</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                    {{-- Mensaje de error para fecha de nacimiento --}}
                    @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo para el número de teléfono --}}
                <div class="mb-3">
                    <label for="num_telefon" class="form-label">Telèfon</label>
                    <input type="text" class="form-control @error('num_telefon') is-invalid @enderror" id="num_telefon" name="num_telefon" value="{{ old('num_telefon') }}" required>
                    {{-- Mensaje de error para el teléfono --}}
                    @error('num_telefon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                
               {{-- Campo para seleccionar ciclo formativo --}}
                <select class="form-control @error('cicle_id') is-invalid @enderror" id="cicle_id" name="cicle_id" required>
                    <option value="" disabled selected>Selecciona un cicle</option>
                    @foreach ($cicles as $cicle)
                        <option value="{{ $cicle->id }}" @if(old('cicle_id') == $cicle->id) selected @endif>
                            {{ $cicle->nom }}
                        </option>
                    @endforeach
                </select>

                
                <input type="hidden" name="user_id" value="{{ Auth::id() }}"> {{-- Campo oculto para el ID del usuario --}}

                    
                    {{-- Mensaje de error para ciclo formativo --}}
                    @error('cicle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    {{-- Botón para guardar el estudiante --}}
                    <button type="submit" class="btn btn-success" style="margin-right: 15px;">Desa l'estudiant</button>
                    {{-- Botón para cancelar la operación --}}
                    <a href="{{ route('students.index') }}" class="btn btn-secondary" style="margin-right: 15px;">Cancel·la</a>
                    {{-- Botón para volver a la lista de estudiantes --}}
                    <a href="{{ route('students.index') }}" class="btn btn-primary">Tornar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
