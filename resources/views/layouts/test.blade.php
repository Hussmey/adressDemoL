<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العنونة</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('cities.index') }}">المدن</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('postCodes.index') }}">الرموز البريدية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('areas.index') }}">المناطق</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('streets.index') }}">الشوارع</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('houses.index') }}">المنازل</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('addresses.index') }}">العناوين الكاملة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('postCodeAreas.index') }}">مناطق الرموز البريدية</a>
                        </li>
                    </ul>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                            <span class="navbar-toggler-icon">
                                <i class="fas fa-bars-staggered"></i>
                            </span>
                        </button>

                </div>
            </nav>

            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light position-relative">
                    <!-- Navbar Links -->
                    <div class=" navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <!-- Left-aligned link -->
                            <li class="nav-item">
                                <a class="nav-link textColorNavbar mr-3" href="{{ route('home') }}">عناوين ليبيا</a>
                            </li>
                        </ul>

                        <!-- Centered navbar-text -->
                        <div class="navbar-text position-absolute w-100 text-center textColorNavbar">
                            @yield('navbar-title')
                        </div>
                    </div>
                </nav>

                <!-- Main Content -->
                <div class="container mt-4">
                    <div class="card shadow">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function () {
            $('#citiesTable').DataTable();
            $('#areasTable').DataTable();
            $('#housesTable').DataTable();
            $('#postCodesTable').DataTable();
            $('#streetsTable').DataTable();
            $('#addressesTable').DataTable();
        });
    </script>
    /* function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    } */
</body>

</html>



