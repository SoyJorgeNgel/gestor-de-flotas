<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    <!-- Iconos de boxicons.com -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png" sizes="64x64">
    

    <!-- Styles -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-indigo-950">
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxs-truck'></i>
            <span class="logo_name">Trucker Logistic</span>
        </div>
        <ul class="nav-links">
            @if(Auth::user()->role_id != '3')
            <li>
                <a href="/dashboard">
                    <i class='bx bxs-home'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu">
                    <li><a class="link_name" href="/dashboard">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="/usuarios">
                        <i class='bx bxs-user'></i>
                        <span class="link_name">Usuarios</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="/usuarios">Usuarios</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="/cajas">
                        <i class='bx bx-package'></i>
                        <span class="link_name">Cajas</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="/cajas">Cajas</a></li>
                    <li><a href="/cajas/dashboard">Gestion de cajas</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="/tractores">
                        <i class='bx bxs-truck'></i>
                        <span class="link_name">Tractores</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="/tractores">Tractores</a></li>
                    <li><a href="/tractores/dashboard">Marcas y Modelos</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="/viajes">
                        <i class='bx bxs-directions'></i>
                        <span class="link_name">Viajes</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="/viajes">Viajes</a></li>
                    <li><a href="/viajes/destinos">Destinos</a></li>
                    <li><a href="/viajes/salidas">Puntos de salida</a></li>
                </ul>
            </li>
            <li>
                <a href="/reportes">
                    <i class='bx bxs-report'></i>
                    <span class="link_name">Reportes</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/reportes">Reportes</a></li>
                </ul>
            </li>
            @else
            <li>
                <div class="icon-link">
                    <a href="/viajes">
                        <i class='bx bxs-directions'></i>
                        <span class="link_name">Viajes</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="/viajes">Viajes</a></li>
                </ul>
            </li>
            @endif


            <li>
                <div class="profile-details">
                    <div class="profile-content">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">{{Auth::user()->name;}}</div>
                        <div class="job">{{Auth::user()->role->role}}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <i class='bx bxs-log-out' :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        </i>
                    </form>

                </div>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <header class="header-blue">
            <div class="home-content">
                <i class='bx bx-menu'></i>
                <img src="{{ asset('images/Logo.png') }}" width="80px" height="80px" alt>
            </div>
        </header>
        <!-- Contenido de la pagina -->
        @yield("content")

    </section>
</body>
@livewireScripts
<script>
    let arrows = document.querySelectorAll(".arrow");
    arrows.forEach(function(arrow) {
        arrow.addEventListener("click", function(e) {
            let arrowParent = e.target.parentElement.parentElement;
            arrowParent.classList.toggle("showMenu");
        });
    });

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    sidebarBtn.addEventListener("click", function() {
        sidebar.classList.toggle("close");
    });
</script>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('alert', (event) => {
            const userData = event.detail;
            Swal.fire({
                position: "center",
                icon: "success",
                title: event[0],
                showConfirmButton: false,
                timer: 2000
            });
        });
    });
    document.addEventListener('show-delete-confirmation', event => {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteConfirmed');
            }
        });
    });
    document.addEventListener('show-delete-confirmation2', event => {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteConfirmed2');
            }
        });
    });
    document.addEventListener('show-delete-confirmation2', event => {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteConfirmed2');
            }
        });
    });
    document.addEventListener('show-delete-confirmation3', event => {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteConfirmed3');
            }
        });
    });
    document.addEventListener('show-delete-confirmation4', event => {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteConfirmed4');
            }
        });
    });
</script>

</html>