@extends('layouts.app')

@section('content')
<h1>Detalles de la Carrera</h1>

<p><strong>ID:</strong> {{ $career->id_career }}</p>
<p><strong>Nombre:</strong> {{ $career->name_career }}</p>
<p><strong>Facultad:</strong> {{ $career->faculty->name_fac ?? 'Sin Facultad' }}</p>

<h3>Profesores relacionados</h3>
<ul>
    @forelse($career->teachers as $teacher)
        <li>{{ $teacher->name_teacher }}</li>
    @empty
        <li>No hay profesores asignados.</li>
    @endforelse
</ul>
@endsection
