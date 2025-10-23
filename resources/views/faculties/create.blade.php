<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Facultad</title>
</head>
<body>
    <h1>Crear nueva facultad</h1>
    <a href="{{ route('faculties.index') }}">Volver</a>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('faculties.store') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="name_fac" required><br><br>

        <label>Acrónimo:</label>
        <input type="text" name="acronym_fac"><br><br>

        <label>Decano:</label>
        <input type="text" name="dean_name_fac"><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
