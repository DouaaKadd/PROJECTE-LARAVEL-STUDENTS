@extends('layouts.navbar')

@section('title', 'Llista d’Estudiants')

@section('alumnos')
<div class="container mt-4"> {{--cont con márgenes--}}
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Llista d’Estudiants</h3>
            {{-- Si le da click a crear estudiante le redirijo al create --}}
            <a href="{{ route('students.create') }}" class="btn btn-light">+ Afegir Estudiant</a>
        </div>
        <div class="table-responsive"> {{-- Hace que la tabla sea responsiva para móviles --}}
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Correu Electrònic</th>
                        <th>Adreça</th>
                        <th>Cicle Formatiu</th>
                        <th>Accions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Recorre todos los estudiantes y muestra cada fila --}}
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>

                        {{-- Verificar si el estudiante tiene un ciclo asignado --}}
                        @if($student->cicle)
                            <td>{{ $student->cicle->nom }}</td>
                        @else
                            <td>Sense cicle</td> {{-- Si no tiene ciclo, mostrar este texto --}}
                        @endif

                        <td>
                            {{-- Botón para editar --}}
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                            </a>
                            {{-- Botón para ver detalles --}}
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </a>
                            {{-- Botón para eliminar con modal --}}
                            <a class="btn btn-danger btn-sm btn-eliminar"
                               data-id="{{ $student->id }}" 
                               data-name="{{ $student->name }}" 
                               data-bs-toggle="modal" 
                               data-bs-target="#Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5.5 0 0 1 6.5 0h3A1.5.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $students->links() }} 
        </div>
    </div>
</div>

{{-- Botón para volver al panel --}}
<div class="text-center mt-4">
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
        Tornar al Panell
    </a>
</div>

{{-- Modal de confirmación --}}
<div class="modal fade" id="Eliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Eliminar Alumne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Estàs segur que vols eliminar l'alumne: <strong id="modalStudentName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tancar</button>
                <a href="#" id="modalDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript para actualizar el enlace del modal --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalStudentName = document.getElementById("modalStudentName");
        const modalDeleteButton = document.getElementById("modalDeleteButton");

        document.querySelectorAll(".btn-eliminar").forEach(button => {
            button.addEventListener("click", function() {
                const studentId = this.getAttribute("data-id");
                const studentName = this.getAttribute("data-name");

                modalStudentName.textContent = studentName;
                modalDeleteButton.href = "/students/destroy/" + studentId;
            });
        });
    });
</script>
@endsection
