


<div class="fluid fixed-top"  >
    <nav class="navbar navbar-expand-lg navbar-dark bg-info p-1 " >
        <div class="container-fluid">

            {{-- <img class="img-fluid" src="{{ asset('storage/logos/Albita.png') }}" alt="School Logo" class="navbar-logo"  width="150px"  > --}}
            <a class="navbar-brand" href="#" style="float: left;">
                {{-- <img src="{{ asset('storage/logos/Albita.png') }}" alt="School Logo" class="navbar-logo" width="150px"  > --}}
                <img  class="img-fluid" src="{{ asset('storage/images/logos/LogoAlbita2.png') }}" alt="School Logo" title="logo" width="200px"  />

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class=" collapse navbar-collapse " style="padding-left:15%;"  id="navbarNavDropdown">


                    <ul class="navbar-nav  ms-auto  "  >
                            <li class="nav-item">
                                <a class="nav-link mx-3  active" aria-current="page" href="{{ route('student.home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-4 " href="{{ route('student.timetable.index') }}">L'emploi du temps </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-4" href="#">Presence </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-3" href="#">Notes </a>
                            </li>

                    </ul>


                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <!-- User Profile Dropdown -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#">
                                <span class="d-none d-lg-inline me-2 text-blak-600 " style="margin-left:50px;" >{{ Auth::user()->fullname }}</span>
                                <img src="{{ asset('storage/' . Auth::user()->img) }}" class="img-thumbnail rounded-circle mr-3" width="50" height="50" alt="Profile Image">
                            </a>
                            <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                {{-- <a class="dropdown-item" href="{{ route('profile',["role"=>"student"]) }}"> --}}
                                    <a class="dropdown-item" href="{{ route('profile',["role"=>Auth::user()->role]) }}">
                                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i> Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i> Activity log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>


            </div>
        </div>
    </nav>

</div>



{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add your CSS link or styles here -->
    <link rel="stylesheet" href="your-styles.css">
    <!-- Add your Bootstrap CSS link here -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add your Bootstrap JS scripts here -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
    <title>Your Page Title</title>
    <style>
        /* Add your CSS styles here */
        /* Add your custom styles in your-styles.css */
@media (max-width: 767px)
{
    .navbar-nav .nav-item {
        background-color: rgb(36, 98, 221); /* Change to your desired color */
        margin: 3px;
        border-radius: 5px;

    }
    .navbar-nav .nav-item a {
        color: #fff; /* Change to your desired text color */
    }

    ul {
        margin-right: 15px;
    }
    ul li {
        /* padding-right: 50% */
        width: 50%;
    }

    li a:hover {
        color: #fff; /* Change to your desired text hover color */

    }
}

    </style>
</head>
<body>
    <div class="fluid fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info p-1">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-flex align-items-center">
                        <div>
                            <!-- Logo displayed on the right on smaller screens -->
                            <img class="img-fluid" src="{{ asset('storage/logos/Albita.png') }}" alt="School Logo" class="navbar-logo" width="150px">
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" style="padding-left: 15%;" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link mx-3 active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-4" href="#">L'emploi du temps</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-4" href="#">Presence</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-3" href="#">Notes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>
</html> --}}





{{--
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-4 topbar static-top">
<div class="container">
    <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
        <i class="fas fa-bars"></i>
    </button>

    <a class="navbar-brand" href="#" style="float: left;">
        <img src="{{ asset('storage/logos/mqvOvUz2y1Hwl1Jh0Ecw5KLBXNajtc7MshgjzmIb.png') }}" alt="School Logo" class="navbar-logo" width="100px"  >
    </a>

    <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
            <button class="btn btn-primary py-0" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>


    <a class="navbar-brand" href="#">Navbar</a>
    <a class="navbar-brand" href="#">Navbar</a>
    <a class="navbar-brand" href="#">Navbar</a>

    <ul class="navbar-nav flex-nowrap ms-auto">
        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown no-arrow">
            <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#">
                <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->fullname }}</span>
                <img src="{{ asset('storage/' . Auth::user()->img) }}" class="img-thumbnail rounded-circle mr-3" width="50" height="50" alt="Profile Image">
            </a>
            <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i> Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i> Activity log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </div>
        </li>


    </ul>
</div>
</nav> --}}


