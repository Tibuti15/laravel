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
        <tr class="bg-primary text-white">
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

                <!-- Botón SweetAlert2 -->
                <a href="#"
                   data-id="{{ $faculty->id_fac }}"
                   class="btn btn-outline-danger btn-sm btnEliminar"
                   title="Eliminar">
                    <i class="fa fa-trash"></i>
                </a>

                <!-- Formulario oculto DELETE -->
                <form id="formEliminar-{{ $faculty->id_fac }}" 
                      action="{{ route('faculties.destroy', $faculty->id_fac) }}" 
                      method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('extra_js')
<!-- jQuery y DataTables (ya debes tenerlos cargados en tu layout) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    // Botón eliminar con SweetAlert2
    $('.btnEliminar').click(function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const form = $(`#formEliminar-${id}`);

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
                form.submit(); // ✅ Se envía el formulario DELETE
            }
        });
    });

    // Inicializar DataTable
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
