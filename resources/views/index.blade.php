<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UTC')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <style>
        body {
            background-color: #f4f6fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header */
        header.navbar {
            background-color: #0d6efd;
            padding: 0.8rem 2rem;
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        header.navbar .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
        }

        header.navbar .nav-link {
            color: white;
            font-weight: 500;
            margin-left: 1rem;
        }

        header.navbar .nav-link:hover {
            color: #ffdd57;
        }

        /* Main content */
        main.container {
            margin-top: 2rem;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        /* Footer */
        footer {
            margin-top: 2rem;
            padding: 1rem 0;
            background-color: white;
            text-align: center;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{ route('home') }}">Mi Aplicación</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('faculties.listar') }}">Facultades</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('careers.listar') }}">Carreras</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('teachers.listar') }}">Profesores</a></li>
            </ul>
        </div>
    </header>

    <!-- Main content -->
    <main class="container">
        <div class="py-4">
            <div class="card p-4">
                @yield('contenido')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p class="mb-0 small">
            © <strong>iPortfolio</strong> - Todos los derechos reservados.
            Diseñado por <a href="https://bootstrapmade.com/" class="text-decoration-none">BootstrapMade</a>
        </p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

    @yield('extra_js')

    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "CONFIRMACIÓN",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
    @endif

</body>
</html>
