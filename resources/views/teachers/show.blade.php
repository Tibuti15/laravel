@extends('layouts.app')

@section('content')
<h1>Detalles del Profesor</h1>

<p><strong>ID:</strong> {{ $teacher->id_teacher }}</p>
<p><strong>Nombre:</strong> {{ $teacher->name_teacher }}</p>
<p><strong>Carrera:</strong> {{ $teacher->career->name_career ?? 'Sin Carrera' }}</p>
<p><strong>Facultad:</strong> {{ $teacher->career->faculty->name_fac ?? 'Sin Facultad' }}</p>
@endsection
