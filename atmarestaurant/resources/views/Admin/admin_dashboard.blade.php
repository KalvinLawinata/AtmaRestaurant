<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Admin-Dashboard</title>
    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        a {
            text-decoration: none;
        }

        .main {
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            background-color: #F0DAA1;
        }

        #sidebar {
            max-width: 264px;
            min-width: 264px;
            transition: all 0.35s ease-in-out;
            background-color: #ED7804;
            display: flex;
            flex-direction: column;
        }

        #sidebar.collapsed {
            margin-left: -264px;
        }

        .toggler-btn {
            background-color: transparent;
            cursor: pointer;
            border: 0;
            padding: 0%;
        }

        .toggler-btn i {
            font-size: 1.75rem;
            color: #ffffff;
            font-weight: 1000;
        }

        .fa-user {
            font-size: 1.75rem;
            color: #ffffff;
            font-weight: 1000;
        }

        .navbar {
            padding: 1.15rem 1.5rem;
            background-color: #F78405;
        }

        .sidebar-nav {
            flex: 1 1 auto;
        }

        .sidebar-logo {
            padding: 1rem 1.5rem;
            text-align: center;
            background-color: #FA9C14;
        }

        .sidebar-logo a {
            color: #FFF;
            font-weight: 800;
            font-size: 1.5rem;
        }

        .sidebar-header {
            color: #ffffff;
            font-size: .75rem;
            padding: 1.5rem 1.5rem .375rem;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: #ffffff;
            position: relative;
            transition: all 0.35s;
            display: block;
            font-size: 1.25rem;
        }

        .sidebar-item {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        a.sidebar-link:hover {
            background-color: #FA9C14;
        }

        .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 .075rem .075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all .2s ease-out;
        }

        .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all .2s ease-out;
        }

        /* Screen size less than 768px */

        @media (max-width:768px) {

            .sidebar-toggle {
                margin-left: -264px;
            }

            #sidebar.collapsed {
                margin-left: 0;
            }
        }

        .main-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-toggle">
            <div class="sidebar-logo">
                <a href="{{ url('admin_dashboard') }}">Atma Restaurant</a>
            </div>
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav p-0">
                <li class="sidebar-item">
                    <a href="{{ url('admin_dashboard_content') }}" class="sidebar-link dashboardSidebar">
                        <i class="fa-solid fa-house"></i>
                        <span> Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ url('admin_user') }}" class="sidebar-link userSidebar">
                        <i class="fa-solid fa-user-group"></i>
                        <span> Pengguna</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ url('admin_menu') }}" class="sidebar-link menuSidebar">
                        <i class="fa-solid fa-bars"></i>
                        <span> Menu</span>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- Navbar -->
        <div class="main">
            <nav class="navbar navbar-expand">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-start">
                        <button class="toggler-btn" type="button">
                            <i class="fa-solid fa-align-left"></i>
                        </button>
                    </div>
                    <form action="{{route('admin.logout')}}" method="POST">
                        @csrf
                        <div class="d-flex align-items-end">
                            <button class="btn btn-danger" type="submit">
                                Log out
                            </button>
                        </div>
                    </form>
                </div>
            </nav>
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const toggler = document.querySelector(".toggler-btn");
        toggler.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>
</body>

</html>
