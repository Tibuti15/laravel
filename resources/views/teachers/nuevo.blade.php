@extends('layouts.app')

@section('content')
<h1>Crear Nuevo Profesor</h1>

<form action="{{ route('teachers.guardar') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name_teacher" class="form-label">Nombre del Profesor</label>
        <input type="text" class="form-control" name="name_teacher" id="name_teacher" required>
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
</form>
@endsection
