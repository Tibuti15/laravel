<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Facultades</title>
</head>
<body>
    <h1>Facultades</h1>

    <a href="{{ route('faculties.create') }}">Crear nueva facultad</a>
    <br><br>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acrónimo</th>
            <th>Decano</th>
            <th>Acciones</th>
        </tr>

        @foreach ($faculties as $faculty)
        <tr>
            <td>{{ $faculty->id_fac }}</td>
            <td>{{ $faculty->name_fac }}</td>
            <td>{{ $faculty->acronym_fac }}</td>
            <td>{{ $faculty->dean_name_fac }}</td>
            <td>
                <a href="{{ route('faculties.show', $faculty->id_fac) }}">Ver</a> |
                <a href="{{ route('faculties.edit', $faculty->id_fac) }}">Editar</a> |
                <form action="{{ route('faculties.destroy', $faculty->id_fac) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar facultad?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
