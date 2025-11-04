@extends('index')

@section('contenido')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 bg-light p-4 rounded shadow-sm">
        <h2>Editar Facultad</h2>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="facultyEditForm" action="{{ route('faculties.procesarEdicion', $faculty->id_fac) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @php
                $fields = [
                    ['name' => 'name_fac', 'label' => 'Nombre', 'type' => 'text'],
                    ['name' => 'acronym_fac', 'label' => 'Acrónimo', 'type' => 'text'],
                    ['name' => 'dean_name_fac', 'label' => 'Decano', 'type' => 'text'],
                    ['name' => 'phone_fac', 'label' => 'Teléfono', 'type' => 'text'],
                    ['name' => 'email_fac', 'label' => 'Email', 'type' => 'email'],
                    ['name' => 'year_foundation_fac', 'label' => 'Año Fundación', 'type' => 'number']
                ];
            @endphp

            @foreach($fields as $field)
            <div class="mb-3">
                <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}</label>
                <input type="{{ $field['type'] }}" class="form-control @error($field['name']) is-invalid @enderror" 
                       name="{{ $field['name'] }}" id="{{ $field['name'] }}" 
                       value="{{ old($field['name'], $faculty->{$field['name']}) }}" required>
                @error($field['name'])
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @endforeach

            <div class="mb-3">
                <label for="logo_fac" class="form-label">Logo</label>
                <input type="file" class="form-control @error('logo_fac') is-invalid @enderror" name="logo_fac" id="logo_fac">
                @if($faculty->logo_fac)
                    <div class="mt-2">
                        <p class="mb-1">Logo actual:</p>
                        <img src="{{ asset('storage/'.$faculty->logo_fac) }}" alt="Logo" class="img-thumbnail" width="100">
                    </div>
                @endif
                @error('logo_fac')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('faculties.listar') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection

@section('extra_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    // Configuración común para validación única
    function createUniqueValidator(route, currentValue, errorMessage) {
        return function(value, element) {
            if (value.toLowerCase() === currentValue.toLowerCase()) return true;
            
            var isValid = true;
            $.ajax({
                url: route,
                type: "POST",
                async: false,
                data: {
                    value: value,
                    faculty_id: "{{ $faculty->id_fac }}",
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    isValid = !response.exists;
                }
            });
            return isValid;
        };
    }

    // Métodos de validación
    jQuery.validator.addMethod("acronymUnique", 
        createUniqueValidator("{{ route('faculties.checkAcronym') }}", "{{ $faculty->acronym_fac }}"), 
        "Este acrónimo ya está en uso"
    );

    jQuery.validator.addMethod("nameUnique", 
        createUniqueValidator("{{ route('faculties.checkName') }}", "{{ $faculty->name_fac }}"), 
        "Este nombre de facultad ya existe"
    );

    // Configuración de validación
    const validationConfig = {
        rules: {
            name_fac: { required: true, minlength: 3, nameUnique: true },
            acronym_fac: { required: true, minlength: 2, acronymUnique: true },
            dean_name_fac: { required: true, minlength: 3 },
            phone_fac: { required: true, minlength: 10, maxlength: 15, digits: true },
            email_fac: { email: true },
            year_foundation_fac: { required: true, number: true, min: 1994, max: {{ date('Y') }} },
            logo_fac: { extension: "jpg|jpeg|png|webp" }
        },
        messages: {
            name_fac: { required: "Ingrese el nombre", minlength: "Mínimo 3 caracteres" },
            acronym_fac: { required: "Ingrese el acrónimo", minlength: "Mínimo 2 caracteres" },
            dean_name_fac: { required: "Ingrese el decano", minlength: "Mínimo 3 caracteres" },
            phone_fac: { 
                required: "Ingrese el teléfono", 
                minlength: "Mínimo 10 dígitos", 
                maxlength: "Máximo 15 dígitos",
                digits: "Solo números permitidos"
            },
            email_fac: { email: "Formato incorrecto" },
            year_foundation_fac: { 
                required: "Ingrese el año", 
                number: "Debe ser número", 
                min: "Mínimo 1994", 
                max: "No mayor al actual" 
            },
            logo_fac: {
                extension: "Solo imágenes JPG, JPEG, PNG o WEBP"
            }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.after(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function(form) {
            $('button[type="submit"]').prop('disabled', true).html('Guardando...');
            form.submit();
        }
    };

    $("#facultyEditForm").validate(validationConfig);
});
</script>
@endsection