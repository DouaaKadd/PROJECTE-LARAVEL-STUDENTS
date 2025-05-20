@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="text-center mb-4">
                {{-- Logotipo de la aplicación --}}
                <img src="{{ asset('imatges/logo.jpg') }}" alt="EduCat Logo" class="mb-3" style="max-width: 150px;">
                
                {{-- Título de la aplicación --}}
                <h3 class="h3 text-primary">EduCat</h3>

                {{-- Breve descripción --}}
                <p class="text-muted">
                    La millor plataforma per gestionar estudiants i cicles formatius de manera senzilla i eficient.
                </p>
            </div>

            <div class="card shadow-lg rounded">
                <div class="card-header text-center bg-primary text-white">{{ __('Registrar-se') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nombre del usuario --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nom') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correu Electrònic') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Adreça (Dirección) del estudiante --}}
                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('Adreça') }}</label>
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Data de Naixement (Fecha de nacimiento) --}}
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">{{ __('Data de Naixement') }}</label>
                            <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Número de Telèfon --}}
                        <div class="mb-3">
                            <label for="num_telefon" class="form-label">{{ __('Número de Telèfon') }}</label>
                            <input id="num_telefon" type="text" class="form-control @error('num_telefon') is-invalid @enderror" name="num_telefon" value="{{ old('num_telefon') }}" required>
                            @error('num_telefon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Gènere --}}
                        <div class="mb-3">
                        <label for="genere" class="form-label">{{ __('Gènere') }}</label>
                        <select id="genere" class="form-select @error('genere') is-invalid @enderror" name="genere" required>
                            <option value="">Selecciona una opció</option>
                            <option value="home" @selected(old('genere') === 'home')>Home</option>
                            <option value="dona" @selected(old('genere') === 'dona')>Dona</option>
                        </select>
                        @error('genere')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contrasenya') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Contrasenya') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrar-me') }}
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Ja tens un compte? Inicia Sessió.') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
