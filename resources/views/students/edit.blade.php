@extends('layouts.navbar')

@section('title', 'Editar Estudiant')

@section('alumnos')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Editar Estudiant</h3>
    </div>
    <div class="card-body">
        {{-- Este formulario lo controla el metodo update del controller y le paso el id de cada estudiante --}}
        <form action="{{ route('students.update', ['student' => $student->id]) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Campo para el nombre --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $student->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para el correo electrónico --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $student->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para la dirección --}}
            <div class="mb-3">
                <label for="address" class="form-label">Direcció</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $student->address) }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para fecha de nacimiento --}}
            <div class="mb-3">
                <label for="birth_date" class="form-label">Data de Naixement</label>
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $student->birth_date) }}" required>
                @error('birth_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para número de teléfono --}}
            <div class="mb-3">
                <label for="num_telefon" class="form-label">Telèfon</label>
                <input type="text" class="form-control @error('num_telefon') is-invalid @enderror" id="num_telefon" name="num_telefon" value="{{ old('num_telefon', $student->num_telefon) }}" required>
                @error('num_telefon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para seleccionar ciclo formativo --}}
           {{-- Campo para seleccionar ciclo formativo --}}
        <div class="mb-3">
            <label for="cicle_id" class="form-label">Cicle Formatiu</label>
            <select class="form-control @error('cicle_id') is-invalid @enderror" id="cicle_id" name="cicle_id" required>
                <option value="" disabled>Selecciona un cicle</option>
                @foreach ($cicles as $cicle)
                    <option value="{{ $cicle->id }}" @if(old('cicle_id', $student->cicle_id) == $cicle->id) selected @endif>
                        {{ $cicle->nom }}
                    </option>
                @endforeach
            </select>
            @error('cicle_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
            {{-- Campo oculto para el ID del usuario --}}
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            {{-- Botones para actualizar y cancelar --}}
            <button type="submit" class="btn btn-success">Actualitzar Estudiant</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
