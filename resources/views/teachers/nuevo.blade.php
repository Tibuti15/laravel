@extends('index') <!-- Extiende tu plantilla base -->

@section('contenido')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 bg-light p-4 rounded shadow-sm">
        <h2>Nuevo Profesor</h2>
        <form action="{{ route('teachers.guardar') }}" method="POST" id="teacherForm">
            @csrf

            <div class="mb-3">
                <label for="name_teacher" class="form-label">Nombre del Profesor</label>
                <input type="text" class="form-control" name="name_teacher" id="name_teacher" required placeholder="Nombre del profesor">
            </div>

            <div class="mb-3">
                <label for="id_career" class="form-label">Carrera</label>
                <select name="id_career" id="id_career" class="form-select" required>
                    <option value="">-- Seleccione Carrera --</option>
                    @foreach($careers as $career)
                        <option value="{{ $career->id_career }}">{{ $career->name_career }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('teachers.listar') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection

@section('extra_js')
<script>
$(document).ready(function(){

    $("#teacherForm").validate({
        rules:{
            name_teacher: { required: true, minlength: 3 },
            id_career: { required: true }
        },
        messages:{
            name_teacher: { required: "Ingrese el nombre del profesor", minlength: "Debe tener al menos 3 caracteres" },
            id_career: { required: "Seleccione una carrera" }
        }
    });

});
</script>
@endsection
