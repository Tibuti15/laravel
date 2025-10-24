@extends('layouts.app')

@section('content')
<h1>Listado de Profesores</h1>
<a href="{{ route('teachers.nuevo') }}" class="btn btn-primary mb-3">Nuevo Profesor</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Facultad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr>
            <td>{{ $teacher->id_teacher }}</td>
            <td>{{ $teacher->name_teacher }}</td>
            <td>{{ $teacher->career->name_career ?? 'Sin Carrera' }}</td>
            <td>{{ $teacher->career->faculty->name_fac ?? 'Sin Facultad' }}</td>
            <td>
                <a href="{{ route('teachers.editar', $teacher->id_teacher) }}" class="btn btn-sm btn-warning">Editar</a>
                <a href="{{ route('teachers.eliminar', $teacher->id_teacher) }}" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
