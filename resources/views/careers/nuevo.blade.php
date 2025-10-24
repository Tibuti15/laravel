@extends('layouts.app')

@section('content')
<h1>Crear Nueva Carrera</h1>

<form action="{{ route('careers.guardar') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name_career" class="form-label">Nombre de la Carrera</label>
        <input type="text" class="form-control" name="name_career" id="name_career" required>
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
</form>
@endsection
