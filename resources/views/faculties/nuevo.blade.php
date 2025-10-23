{{-- resources/views/faculties/nuevo.blade.php --}}
@extends('index') <!-- Extiende tu plantilla index.blade.php -->

@section('contenido')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 bg-light p-4 rounded">
        <h2>Nuevo Facultad</h2>
        <form action="{{ route('faculties.guardar') }}" method="POST" enctype="multipart/form-data" id="facultyForm">
            @csrf
            <div class="mb-3">
                <label for="name_fac" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name_fac" id="name_fac" required placeholder="Nombre de la facultad">
            </div>

            <div class="mb-3">
                <label for="acronym_fac" class="form-label">Acrónimo</label>
                <input type="text" class="form-control" name="acronym_fac" id="acronym_fac" required placeholder="Ej: FCE">
            </div>

            <div class="mb-3">
                <label for="dean_name_fac" class="form-label">Decano</label>
                <input type="text" class="form-control" name="dean_name_fac" id="dean_name_fac" required placeholder="Nombre del decano">
            </div>

            <div class="mb-3">
                <label for="phone_fac" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="phone_fac" id="phone_fac" required placeholder="Ingrese teléfono">
            </div>

            <div class="mb-3">
                <label for="email_fac" class="form-label">Email</label>
                <input type="email" class="form-control" name="email_fac" id="email_fac" required placeholder="correo@ejemplo.com">
            </div>

            <div class="mb-3">
                <label for="year_foundation_fac" class="form-label">Año de Fundación</label>
                <input type="number" class="form-control" name="year_foundation_fac" id="year_foundation_fac" required placeholder="Ej: 1990">
            </div>

            <div class="mb-3">
                <label for="logo_fac" class="form-label">Logo</label>
                <input type="file" class="form-control" name="logo_fac" id="logo_fac">
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('faculties.listar') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection

@section('extra_js')
<script>
$(document).ready(function(){

    // Validación simple
    $("#facultyForm").validate({
        rules:{
            name_fac: { required: true, minlength: 3 },
            acronym_fac: { required: true, minlength: 2 },
            dean_name_fac: { required: true, minlength: 3 },
            phone_fac: { required: true, minlength: 7 },
            email_fac: { required: true, email: true },
            year_foundation_fac: { required: true, digits: true, min: 1800, max: new Date().getFullYear() }
        },
        messages:{
            name_fac: { required: "Ingrese el nombre", minlength: "Debe tener al menos 3 caracteres" },
            acronym_fac: { required: "Ingrese acrónimo", minlength: "Debe tener al menos 2 caracteres" },
            dean_name_fac: { required: "Ingrese nombre del decano", minlength: "Debe tener al menos 3 caracteres" },
            phone_fac: { required: "Ingrese teléfono", minlength: "Mínimo 7 caracteres" },
            email_fac: { required: "Ingrese correo", email: "Correo no válido" },
            year_foundation_fac: { required: "Ingrese año", digits: "Solo números", min: "Año inválido", max: "Año inválido" }
        }
    });

});
</script>
@endsection
