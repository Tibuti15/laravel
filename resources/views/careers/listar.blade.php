@extends('layouts.app')

@section('content')
<h1>Listado de Carreras</h1>
<a href="{{ route('careers.nuevo') }}" class="btn btn-primary mb-3">Nueva Carrera</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Facultad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($careers as $career)
        <tr>
            <td>{{ $career->id_career }}</td>
            <td>{{ $career->name_career }}</td>
            <td>{{ $career->faculty->name_fac ?? 'Sin Facultad' }}</td>
            <td>
                <a href="{{ route('careers.editar', $career->id_career) }}" class="btn btn-sm btn-warning">Editar</a>
                <a href="{{ route('careers.eliminar', $career->id_career) }}" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
