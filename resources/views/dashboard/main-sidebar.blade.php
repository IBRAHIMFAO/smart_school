{{-- <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
style="background: rgb(81,170,208);">
<div class="container-fluid d-flex flex-column p-0">
    
    <img  src="{{ asset('storage/images/logos/NADplXnUdYZ3maKOSLVAc0MUaw8yJ8uiEr6sOec4.png') }}" alt="logos ecole" title="logo" width="220" height="100" />
   

    <hr class="sidebar-divider my-0">
    <ul class="navbar-nav text-light" id="accordionSidebar" style="margin-top: 10px">

                <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}" style="margin: 0px;"><i
                    class="fas fa-tachometer-alt"></i><span style="font-weight: bold;font-size: 16px;">Dashboard 1</span></a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dash-ecole.index') }}">
                        <i class="fas fa-school"></i> <!-- Font Awesome icon for school -->
                        <span style="font-weight: bold; font-size: 16px;">Ecoles</span>
                    </a>
                </li>

                <li class="nav-item"><a class="nav-link " href="{{ route('dash-groupe.index') }}">
                            <i class="fas fa-table">  </i><span style="font-weight: bold;font-size: 16px;">Groups</span></a>

                            <a class="nav-link" href="{{ route('dash-seance.index') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512"
                        width="1em" height="1em" fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 248H128V192H48V248zM48 296V360H128V296H48zM176 296V360H272V296H176zM320 296V360H400V296H320zM400 192H320V248H400V192zM400 408H320V464H384C392.8 464 400 456.8 400 448V408zM272 408H176V464H272V408zM128 408H48V448C48 456.8 55.16 464 64 464H128V408zM272 192H176V248H272V192z">
                        </path>
                    </svg><span style="font-weight: bold;font-size: 16px;">&nbsp;Séances</span></a>
                </li>

                <li class="nav-item"><a class="nav-link" href="{{ route('dash-student.index') }}"><i class="fas fa-user-graduate"></i>
                    <span style="font-weight: bold;font-size: 16px;">Étudiants</span></span></a>
                </li>

               <li class="nav-item">
                <a class="nav-link" href="{{ route('dash-prof.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span style="font-weight: bold;font-size: 16px;">Professeurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dash-niveauxscolaire.index') }}">
                    <i class="fas fa-school"></i>
                    <span style="font-weight: bold;font-size: 16px;">Niveaux Scolaires</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dash-matiere.index') }}">
                    <i class="fas fa-book"></i>
                    <span style="font-weight: bold;font-size: 16px;">Matières</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dash-filiere.index') }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span style="font-weight: bold;font-size: 16px;">Filieres</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dash-salle.index') }}">
                    <i class="fas fa-building"></i> <!-- Font Awesome icon for building -->
                    <span style="font-weight: bold; font-size: 16px;">Salles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('emploi-du-temps.index') }}">
                    <i class="fas fa-calendar-alt"></i> <!-- Font Awesome icon for calendar -->
                    <span style="font-weight: bold; font-size: 16px;">Emplois</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('payment.index') }}">
                    <i class="fas fa-money-bill-wave"></i> <!-- Font Awesome icon for money -->
                    <span style="font-weight: bold; font-size: 16px;">Paiements</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('post.index') }}">
                    <i class="fas fa-bullhorn"></i> <!-- Font Awesome icon for bullhorn -->
                    <span style="font-weight: bold; font-size: 16px;">Postes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog"></i> <!-- Font Awesome icon for cog -->
                    <span style="font-weight: bold; font-size: 16px;">Paramètres</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> <!-- Font Awesome icon for users -->
                    <span style="font-weight: bold; font-size: 16px;">Utilisateurs</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('attendance.index') }}">
                    <i class="fas fa-user-check"></i> <!-- Font Awesome icon for user-check -->
                    <span style="font-weight: bold; font-size: 16px;">Présences</span>
                </a>
            </li>

        






              
    </ul>
   

    <style>
        #sidebarToggle {
            display: block;
        }
    </style>


    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button">
        <!-- Your button icon or content goes here -->
    </button>
    <a class="border rounded d-inline scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>






</div>
</nav>



<script>
    // JavaScript code to toggle the sidebar when the button is clicked
    const sidebar = document.querySelector('.sidebar'); // Use the correct selector for your sidebar
    const sidebarToggle = document.getElementById('sidebarToggle');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('d-none');
    });
</script> --}}



<nav id="sidebar">
   
    <!-- Sidebar content -->
        <div class="sidebar-header">
            <h5><i class="fas fa-italic">nstitution </i><strong style="color:#FFFF00">Albita2</strong></h5>
        </div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="{{ url('/') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('dash-ecole.index') }}"><i class="fas fa-school"></i> Écoles</a>
                <a href="{{ route('dash-groupe.index') }}"><i class="fas fa-table"></i> Groups</a>
                <a href="{{ route('dash-seance.index') }}"><i class="fas fa-table"></i> Séances</a>
                <a href="{{ route('dash-student.index') }}"><i class="fas fa-user-graduate"></i> Étudiants</a>
                <a href="{{ route('dash-prof.index') }}"><i class="fas fa-chalkboard-teacher"></i> Professeurs</a>
                <a href="{{ route('dash-niveauxscolaire.index') }}"><i class="fas fa-school"></i> Niveaux Scolaires</a>
                <a href="{{ route('dash-matiere.index') }}"><i class="fas fa-book"></i> Matières</a>
                <a href="{{ route('dash-filiere.index') }}"><i class="fas fa-graduation-cap"></i> Filieres</a>
                <a href="{{ route('dash-salle.index') }}"><i class="fas fa-building"></i> Salles</a>
                <a href="{{ route('emploi-du-temps.index') }}"><i class="fas fa-calendar-alt"></i> Emplois</a>
                <a href="{{ route('payment.index') }}"><i class="fas fa-money-bill-wave"></i> Paiements</a>
                <a href="{{ route('post.index') }}"><i class="fas fa-bullhorn"></i> Postes</a>
                <a href="#"><i class="fas fa-cog"></i> Paramètres</a>
                {{-- <a href="#"><i class="fas fa-users"></i> Utilisateurs</a> --}}
                <a href="{{ route('users.index') }}"><i class="fas fa-users"></i> Utilisateurs</a>
                <a href="{{ route('attendance.index') }}"><i class="fas fa-user-check"></i> Présences</a>

            </li>
            <!-- Add other menu items as needed -->
             {{-- <li>
                <a href="#">Menu item </a>
            </li>  --}}
            

        </ul>
       
         <!-- Example toggle button -->
 
        {{-- <button type="button" id="sidebarCollapse">
            <i class="fas fa-bars"></i>
        </button> --}}
   

     
</nav>



    <style>
                /* Add your custom styles here */
            body {
                font-family: 'Arial', sans-serif;
            }

            /* .wrapper {
                display: flex;
            } */

           /* .wrapper {
                display: flex;
                align-items: stretch;
            } */

            .sidebar-header {
                padding: 20px;
                background: #4e73df;
                color: #fff;
                font-size: 1.5em;
                font-weight: 900;
                
            }
        

            #sidebar {
                min-width: 200px;
                max-width: 250px;
                /* height: 100vh; */
                background: #4e73df;
                color: #fff;
                transition: all 0.3s;
                
                position: fixed;
                height: 100%;
                overflow-y: auto; /* Enable vertical scrolling if content overflows */
    
            }

            #sidebar.active {
                margin-left: -250px;
            }

            #sidebar .sidebar-header {
                padding: 20px;
                background: #4e73df;
            }

            #sidebar ul.components {
                padding: 20px 0;
                border-bottom: 1px solid #47748b;
            }

            #sidebar ul p {
                color: #fff;
                padding: 10px;
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 1.1em;
                display: block;
                color: #fff;
            }

            #sidebar ul li a:hover {
                color: #4e73df;
                background: #fff;
                text-decoration: none;
            }

            /* Adjust content margin to avoid overlap with fixed sidebar */
            #content {
                margin-left: 250px; /* Width of the sidebar */
                transition: margin-left 0.3s;
            }

            /* Adjust margin when the sidebar is in the active state (collapsed) */
            #sidebar.active + #content {
                margin-left: 0;
            }

    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="scripts.js">
       
        // JavaScript code to toggle the sidebar when the button is clicked
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

    </script>
   



