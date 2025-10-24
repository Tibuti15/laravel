@extends('index') <!-- Extiende tu plantilla base -->

@section('contenido')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 bg-light p-4 rounded shadow-sm">
        <h2>Nueva Carrera</h2>
        <form action="{{ route('careers.guardar') }}" method="POST" id="careerForm">
            @csrf

            <div class="mb-3">
                <label for="name_career" class="form-label">Nombre de la Carrera</label>
                <input type="text" class="form-control" name="name_career" id="name_career" required placeholder="Nombre de la carrera">
            </div>

            <div class="mb-3">
                <label for="id_fac" class="form-label">Facultad</label>
                <select name="id_fac" id="id_fac" class="form-select" required>
                    <option value="">-- Seleccione Facultad --</option>
                    @foreach($faculties as $fac)
                        <option value="{{ $fac->id_fac }}">{{ $fac->name_fac }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('careers.listar') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection

@section('extra_js')
<script>
$(document).ready(function(){

    $("#careerForm").validate({
        rules:{
            name_career: { required: true, minlength: 3 },
            id_fac: { required: true }
        },
        messages:{
            name_career: { required: "Ingrese el nombre de la carrera", minlength: "Debe tener al menos 3 caracteres" },
            id_fac: { required: "Seleccione una facultad" }
        }
    });

});
</script>
@endsection
