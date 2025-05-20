@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="text-center mb-4">
                {{-- Logotipo de la aplicación --}}
                <img src="{{ asset('imatges/logo.jpg') }}" alt="EduCat Logo" class="mb-3" style="max-width: 150px;">
                
                {{-- Título de la aplicación --}}
                <h2 class="h3 text-primary">EduCat</h2>

                {{-- Breve descripción --}}
                <p class="text-muted">
                    La millor plataforma per gestionar estudiants i cicles formatius de manera senzilla i eficient.
                </p>
            </div>

            <div class="card shadow-lg rounded">
                <div class="card-header text-center bg-primary text-white">{{ __('Iniciar Sessió') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Formulario de inicio de sesión --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correu electrònic') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contrasenya') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Recorda’m') }}
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Inicia Sessió') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="mt-3 text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Has oblidat la contrasenya?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Enlace para registrarse --}}
            <div class="text-center mt-3">
                <p>No tens un compte? <a href="{{ route('register') }}">Registra't ara</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
