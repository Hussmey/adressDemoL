<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>العنونة</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- leaflet map lind cdn -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>

<body>
    <div class="container-fluid ">
        <div class="row">
        @if(!in_array(request()->route()->getName(), ['login', 'register']))

<!-- Sidebar -->
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky">
        <ul class="nav flex-column nav-itemHeader mt-5">
            <li class="nav-item  py-2">
                <a class="nav-link  d-flex align-items-center d-flex justify-content-between" href="{{ route('home') }}"> <p class="mt-2 ">عناوين ليبيا</p> <i class="fa-solid fa-house-chimney  mb-2"></i> </a>
            </li>
            <li class="nav-item">
                @can('city-list')
                    <a class="nav-link d-flex justify-content-between" href="{{ route('cities.index') }}"> <p>المدن</p> <i class="fa-solid fa-city mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('area-list')
                    <a class="nav-link  d-flex justify-content-between" href="{{ route('areas.index') }}"> <p>المناطق</p><i class="fa-solid fa-building-flag mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('street-list')
                    <a class="nav-link  d-flex justify-content-between" href="{{ route('streets.index') }}"> <p>الشوارع</p> <i class="fa-solid fa-road mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('house-list')
                    <a class="nav-link  d-flex justify-content-between" href="{{ route('houses.index') }}"> <p>المنازل</p>  <i class="fa-solid fa-house-circle-check mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('postcode-list')
                    <a class="nav-link d-flex justify-content-between" href="{{ route('postCodes.index') }}">  <p>الرموز البريدية للمدن</p> <i class="fa-brands fa-usps"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('postcodearea-list')
                    <a class="nav-link d-flex justify-content-between" href="{{ route('postCodeAreas.index') }}">  <p>الرموز البريدية للمناطق </p><i class="fa-solid fa-signs-post mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('addresses-view')
                    <a class="nav-link d-flex justify-content-between" href="{{ route('addresses.index') }}"><p>العناوين الكاملة </p><i class="fa-solid fa-map-location mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('user-list')
                    <a class="nav-link d-flex justify-content-between" href="{{ route('users.index') }}"> <p>المستخدمين</p><i class="fa-solid fa-users mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('role-list')
                    <a class="nav-link d-flex justify-content-between" href="{{ route('roles.index') }}"><p>الأدوار</p> <i class="fa-solid fa-user-lock mb-2"></i></a>
                @endcan
            </li>
            <li class="nav-item">
            <a class="nav-link d-flex justify-content-between" href="{{ route('opinions.index') }}">
                <p>آراء العناوين</p>
                <i class="fa-brands fa-slideshare mb-2"></i>
            </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between" href="{{ route('homeClient.index') }}">
            <p>الصفحة الرئيسية للعميل</p>
            <i class="fa-solid fa-home-lg mb-2"></i>
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link d-flex justify-content-between" href="{{ route('opinions.adressClientConfirme') }}">
        <p> آراء العناوين المراجعة</p>
        <i class="fa-brands fa-slideshare mb-2"></i>
    </a>
</li>
        </ul>
        
    </div>
    
</nav>
@endif

@php
    $mainContentClass = (!in_array(request()->route()->getName(), ['login', 'register'])) ? 'col-md-9 ml-sm-auto col-lg-10 px-md-4' : 'col-md-12';
    @endphp
            <!-- Page Content -->
            <main role="main" class="{{ $mainContentClass }}">
                <!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light position-relative">
    <!-- Navbar Links -->
    <div class="navbar-collapse d-flex justify-content-between" id="navbarNav">
    <button class="navbar-toggler mr-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
            <i class="fas fa-bars-staggered"></i>
        </button>
        <ul class="navbar-nav">
            <!-- Left-aligned link -->
            <li class="nav-item">
                @yield('navbar-title') 
            </li>
        </ul>
        <!-- Centered navbar-text -->
        <div class="navbar-text">
            @guest
                <!-- Display login and register links for guests -->
                <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <a id="authDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img src="{{ asset('img/navSingin.jpg') }}" alt="singin">
        </a>
        <div class="dropdown-menu z-3 position-absolute" aria-labelledby="authDropdown">
        <a class="dropdown-item" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
<a class="dropdown-item" href="{{ route('register') }}">{{ __('إنشاء حساب') }}</a>

        </div>
    </li>
</ul>

            @else
                <!-- Display links for authenticated users -->
                <ul class="navbar-nav ms-auto text-white">
    <li class="nav-item dropdown">
        <a id="profileDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('img/profile.jpg')}}" alt="Profile Image" class="profile-image">
        </a>
        <div class="dropdown-menu z-3 position-absolute " aria-labelledby="profileDropdown">
            <p class="dropdown-item">{{ Auth::user()->name }}</p>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('خروج') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>

            @endguest
        </div>
    </div>
</nav>


                <!-- Main Content -->
                <div class="container mt-4 ">
                    <div class="card shadow ">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <footer class="footer mt-auto py-1 bg-light">
        <div class="container text-center">
            <p>شركة المتحد الأول للاتصالات والتقنية 2024</p>
        </div>
    </footer>

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
   <!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <!-- leaflet map js -->
     <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  

<script src="{{ asset('js/map.js') }}"></script>
<script src="{{ asset('js/mapHome.js') }}"></script>

  <!-- Your custom JavaScript files -->
  <script src="{{ asset('js/toast.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <!-- Blade template - app.blade.php -->
<!-- Blade template - app.blade.php -->
<script src="{{ asset('js/chart.js') }}" 
        data-cities-count="{{ isset($citiesCount) ? $citiesCount : 0 }}" 
        data-areas-count="{{ isset($areasCount) ? $areasCount : 0 }}" 
        data-streets-count="{{ isset($streetsCount) ? $streetsCount : 0 }}">
    </script>


</body>

</html>
