<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Facultad</title>
</head>
<body>
    <h1>Detalle de la Facultad</h1>
    <a href="{{ route('faculties.index') }}">Volver</a>

    <p><strong>ID:</strong> {{ $faculty->id_fac }}</p>
    <p><strong>Nombre:</strong> {{ $faculty->name_fac }}</p>
    <p><strong>Acrónimo:</strong> {{ $faculty->acronym_fac }}</p>
    <p><strong>Decano:</strong> {{ $faculty->dean_name_fac }}</p>
</body>
</html>
