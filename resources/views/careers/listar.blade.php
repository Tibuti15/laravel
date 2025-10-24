@extends('index') <!-- Usamos la misma plantilla base del diseño anterior -->

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10 bg-light p-4 shadow rounded">
            <h2 class="text-center mb-4 text-primary">Listado de Carreras</h2>

            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('careers.nuevo') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Nueva Carrera
                </a>
            </div>

            <table class="table table-bordered table-striped table-hover align-middle" id="tbl_careers">
                <thead class="table-primary text-center">
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
                        <td class="text-center">{{ $career->id_career }}</td>
                        <td>{{ $career->name_career }}</td>
                        <td>{{ $career->faculty->name_fac ?? 'Sin Facultad' }}</td>
                        <td class="text-center">
                            <a href="{{ route('careers.editar', $career->id_career) }}" 
                               class="btn btn-outline-warning btn-sm" 
                               title="Editar">
                                <i class="fa fa-pen"></i>
                            </a>

                            <a href="#" 
                               data-id="{{ $career->id_career }}" 
                               class="btn btn-outline-danger btn-sm btnEliminar" 
                               title="Eliminar">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
$(document).ready(function() {

    // --- Confirmación de eliminación ---
    $('.btnEliminar').click(function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/careers/eliminar/${id}`;
            }
        });
    });

    // --- Inicialización de DataTable ---
    $('#tbl_careers').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });

});
</script>
@endsection
