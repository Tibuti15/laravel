@extends('index') <!-- Usamos la plantilla -->

@section('title', 'Listado de Facultades')

@section('contenido')

<br>
<h1 class="text-center">Listado de Facultades</h1>
<hr>

<div class="row">
    <div class="col text-end mb-3">
        <a href="{{ route('faculties.nuevo') }}" class="btn btn-info">
            Agregar Facultad
        </a>
    </div>
</div>

<table class="table table-bordered table-striped table-hover" id="tbl_faculties">
    <thead>
        <tr class="big-primary text-white">
            <th>ID</th>
            <th>Nombre</th>
            <th>Acrónimo</th>
            <th>Decano</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Año Fundación</th>
            <th>Logo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faculties as $faculty)
        <tr>
            <td>{{ $faculty->id_fac }}</td>
            <td>{{ $faculty->name_fac }}</td>
            <td>{{ $faculty->acronym_fac }}</td>
            <td>{{ $faculty->dean_name_fac }}</td>
            <td>{{ $faculty->phone_fac }}</td>
            <td>{{ $faculty->email_fac }}</td>
            <td>{{ $faculty->year_foundation_fac }}</td>
            <td>
                @if($faculty->logo_fac)
                    <img src="{{ asset('storage/' . $faculty->logo_fac) }}" alt="Logo" width="100" height="100" class="img-thumbnail mb-2"><br>
                    <a href="{{ asset('storage/' . $faculty->logo_fac) }}" download class="btn btn-sm btn-outline-secondary">Descargar</a>
                @else
                    <span class="text-muted">Ninguno</span>
                @endif
            </td>
            <td>
                <a href="{{ route('faculties.editar', $faculty->id_fac) }}" class="btn btn-outline-warning btn-sm" title="Editar">
                    <i class="fa fa-pen"></i>
                </a>
                <a href="#"
                   data-id="{{ $faculty->id_fac }}"
                   class="btn btn-outline-danger btn-sm btnEliminar"
                   title="Eliminar">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('extra_js')
<script>
$(document).ready(function() {

    $('.btnEliminar').click(function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/faculties/eliminar/${id}`;
            }
        });
    });

    $('#tbl_faculties').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });

});
</script>
@endsection
