@extends('index') <!-- Plantilla base -->

@section('contenido')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 bg-light p-4 rounded shadow-sm">
        <h2>Editar Carrera</h2>
        
        {{-- ✅ AGREGAR PARA MOSTRAR ERRORES --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="careerEditForm" action="{{ route('careers.procesarEdicion', $career->id_career) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name_career" class="form-label">Nombre de la Carrera</label>
                <input type="text" class="form-control @error('name_career') is-invalid @enderror" 
                       name="name_career" id="name_career" 
                       value="{{ old('name_career', $career->name_career) }}" required>
                {{-- ✅ AGREGAR PARA MOSTRAR ERROR DEL NOMBRE --}}
                @error('name_career')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_fac" class="form-label">Facultad</label>
                <select name="id_fac" id="id_fac" class="form-select @error('id_fac') is-invalid @enderror" required>
                    <option value="">-- Seleccione Facultad --</option>
                    @foreach($faculties as $fac)
                        <option value="{{ $fac->id_fac }}" @if(old('id_fac', $career->id_fac) == $fac->id_fac) selected @endif>
                            {{ $fac->name_fac }}
                        </option>
                    @endforeach
                </select>
                {{-- ✅ AGREGAR PARA MOSTRAR ERROR DE FACULTAD --}}
                @error('id_fac')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('careers.listar') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection

@section('extra_js')
<script>
$(document).ready(function() {
    $("#careerEditForm").validate({
        rules:{
            name_career:{ required:true, minlength:3 },
            id_fac:{ required:true }
        },
        messages:{
            name_career:{ required:"Ingrese el nombre de la carrera", minlength:"Mínimo 3 caracteres" },
            id_fac:{ required:"Seleccione una facultad" }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.after(error);
        }
    });
});
</script>
@endsection