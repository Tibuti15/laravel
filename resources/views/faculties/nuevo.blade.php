@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Crear Nueva Facultad</h2>

    <form action="{{ route('faculties.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name_fac" class="form-label">Nombre de la Facultad *</label>
            <input type="text" name="name_fac" id="name_fac" class="form-control" value="{{ old('name_fac') }}" required>
            @error('name_fac')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="acronym_fac" class="form-label">Acrónimo *</label>
            <input type="text" name="acronym_fac" id="acronym_fac" class="form-control" value="{{ old('acronym_fac') }}" required>
            @error('acronym_fac')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="dean_name_fac" class="form-label">Nombre del Decano *</label>
            <input type="text" name="dean_name_fac" id="dean_name_fac" class="form-control" value="{{ old('dean_name_fac') }}" required>
            @error('dean_name_fac')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_fac" class="form-label">Teléfono</label>
            <input type="text" name="phone_fac" id="phone_fac" class="form-control" value="{{ old('phone_fac') }}">
            @error('phone_fac')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email_fac" class="form-label">Correo Electrónico</label>
            <input type="email" name="email_fac" id="email_fac" class="form-control" value="{{ old('email_fac') }}">
            @error('email_fac')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="year_foundation_fac" class="form-label">Año de Fundación *</label>
            <input type="number" name="year_foundation_fac" id="year_foundation_fac" class="form-control" 
                   value="{{ old('year_foundation_fac') }}" 
                   min="1994" 
                   max="{{ date('Y') }}" 
                   required>
            @error('year_foundation_fac')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="logo_fac" class="form-label">Logo *</label>
            <input type="file" name="logo_fac" id="logo_fac" class="form-control" required>
            <div class="form-text">Formatos permitidos: JPG, JPEG, PNG, WEBP. Máximo 2MB.</div>
            @error('logo_fac')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('faculties.listar') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar Facultad</button>
        </div>
    </form>
</div>
@endsection