@extends('index') <!-- Plantilla base -->

@section('contenido')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 bg-light p-4">
        <h2>Editar Facultad</h2>
        <form id="facultyEditForm" action="{{ route('faculties.procesarEdicion', $faculty->id_fac) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name_fac" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name_fac" id="name_fac" value="{{ old('name_fac', $faculty->name_fac) }}" required>
            </div>

            <div class="mb-3">
                <label for="acronym_fac" class="form-label">Acrónimo</label>
                <input type="text" class="form-control" name="acronym_fac" id="acronym_fac" value="{{ old('acronym_fac', $faculty->acronym_fac) }}" required>
            </div>

            <div class="mb-3">
                <label for="dean_name_fac" class="form-label">Decano</label>
                <input type="text" class="form-control" name="dean_name_fac" id="dean_name_fac" value="{{ old('dean_name_fac', $faculty->dean_name_fac) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone_fac" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="phone_fac" id="phone_fac" value="{{ old('phone_fac', $faculty->phone_fac) }}" required>
            </div>

            <div class="mb-3">
                <label for="email_fac" class="form-label">Email</label>
                <input type="email" class="form-control" name="email_fac" id="email_fac" value="{{ old('email_fac', $faculty->email_fac) }}" required>
            </div>

            <div class="mb-3">
                <label for="year_foundation_fac" class="form-label">Año Fundación</label>
                <input type="number" class="form-control" name="year_foundation_fac" id="year_foundation_fac" value="{{ old('year_foundation_fac', $faculty->year_foundation_fac) }}" required>
            </div>

            <div class="mb-3">
                <label for="logo_fac" class="form-label">Logo</label>
                <input type="file" class="form-control" name="logo_fac" id="logo_fac">
                @if($faculty->logo_fac)
                    <img src="{{ asset('storage/'.$faculty->logo_fac) }}" alt="Logo" class="img-thumbnail mt-2" width="100" height="100">
                @endif
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('faculties.listar') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection

@section('extra_js')
<script>
$(document).ready(function() {
    $("#facultyEditForm").validate({
        rules:{
            name_fac:{ required:true, minlength:3 },
            acronym_fac:{ required:true, minlength:2 },
            dean_name_fac:{ required:true, minlength:3 },
            phone_fac:{ required:true, minlength:6 },
            email_fac:{ required:true, email:true },
            year_foundation_fac:{ required:true, number:true, min:1800, max:2100 }
        },
        messages:{
            name_fac:{ required:"Ingrese el nombre de la facultad", minlength:"Mínimo 3 caracteres" },
            acronym_fac:{ required:"Ingrese el acrónimo", minlength:"Mínimo 2 caracteres" },
            dean_name_fac:{ required:"Ingrese el nombre del decano", minlength:"Mínimo 3 caracteres" },
            phone_fac:{ required:"Ingrese el teléfono", minlength:"Mínimo 6 dígitos" },
            email_fac:{ required:"Ingrese el email", email:"Formato incorrecto" },
            year_foundation_fac:{ required:"Ingrese el año", number:"Debe ser un número", min:"Año inválido", max:"Año inválido" }
        }
    });
});
</script>
@endsection
