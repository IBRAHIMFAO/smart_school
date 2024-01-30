
@extends('dashboard.master')

@section('content')
    {{-- <h3 class="text-dark mb-4 fw-bold">Dashboard</h3> --}}
    {{-- @if (Auth::user()->role == 'admin') --}}
   

    <div class="container-fluid">
        <div class="row justify-content-center">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

         </div>

        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0" style="font-weight: bold; font-size: 31px; color: var(--bs-warning-text-emphasis);">{{ __('Dashboard') }}</h3>
            <a class="btn btn-primary btn-sm d-block d-sm-inline-block" role="button" href="#">
                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report
            </a>
        </div>


        {{-- <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card h-100 shadow border-start-primary" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-uppercase text-dark fw-bold">Groups</h5>
                            <i class="fas fa-users-cog fa-2x"></i>
                        </div>
                        <div class="text-white fw-bold h3 mb-0">00{{ $totalgroups }}</div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card h-100 shadow border-start-primary" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-uppercase text-dark fw-bold">Salles</h5>
                            <i class="fas fa-door-open fa-2x"></i>
                        </div>
                        <div class="text-white fw-bold h3 mb-0">00{{ $salles }}</div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card h-100 shadow border-start-success" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-uppercase text-dark fw-bold">Professeurs</h5>
                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                        </div>
                        <div class="text-white fw-bold h3 mb-0">00{{ $totalprofs }}</div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card h-100 shadow border-start-warning" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-uppercase text-dark fw-bold">Départements</h5>
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                        <div class="text-white fw-bold h3 mb-0">0001</div>
                    </div>
                </div>
            </div>
    
            <!-- Add more cards as needed -->
    
        </div> --}}







        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-primary py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>Groups</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>00{{ $totalgroups }}</span></div>
                            </div>
                            <div class="col-auto">
                                <a class="nav-link d-block" href="{{ route('dash-groupe.index') }}">
                                    <i class="fas fa-users-cog fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow border-start-primary py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>Séances</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>00010</span></div>
                            </div>
                            <div class="col-auto">
                                <a class="nav-link d-block" href="{{ route('dash-groupe.index') }}">
                                    <i class="fas fa-users fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-success py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>Salles</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>00{{ $salles }}</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-door-open fa-2x"></i></div>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-start-success py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>PROFESSEURES</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>00{{ $totalprofs }}</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-chalkboard-teacher fa-2x"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-warning py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>DÉPARTEMENTS</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>0001</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-building fa-2x"></i></div>
                        </div>
                    </div>
                </div>

                <div class="card shadow border-start-primary py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>ÉTUDIANTS</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>00{{ $students }}</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-user-graduate fa-2x"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-warning py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>FILIÈRES</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>00003</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-graduation-cap fa-2x"></i></div>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-start-success py-2" style="background: rgb(81, 170, 208); color: #FFFFFF;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-dark fw-bold text-xs mb-1" style="font-size: 19px;">
                                    <span>NIVEAUX SCOLAIRES</span>
                                </div>
                                <div class="text-white fw-bold h5 mb-0"><span>0001</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-school fa-2x"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-xl-6">
                @include('charts.canvas-line-dash')
            </div>

            <div class="col-lg-7 col-xl-6" style="margin: 58px 0px">
                <div class="card-header py-3" style="background: #36b9cc;">
                    <h6 class="text fw-bold m-0" style="font-size: 20px; color:#ffffff">Séances en cours et passées</h6>
                </div>
                <ul class="list-group list-group-flush" style="height: 430px; overflow: auto;">
                    @foreach ($seancesToDo as $index => $seance)
                    <li class="list-group-item" style="background: {{ $index % 2 == 0 ? 'rgba(211,211,211,0.5)' : '#C0C0C0' }}; ">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2" style="box-shadow: 0px 0px;">
                                <h6 class="mb-0" style="color: #171819;">
                                    <div class="row col-9">
                                        <div class="col">
                                            <strong>{{ $seance->group->niveauxscolaire->niveauxscolaire }}</strong>
                                        </div>
                                        <div class="col">
                                            <strong>{{ $seance->group->nom_group }}</strong>
                                        </div>
                                        <div class="col">
                                            <strong>{{ $seance->matiere->nom_matiere }}</strong>
                                        </div>
                                        <div class="col">
                                            <strong>{{ $seance->prof->lastName }}</strong>
                                        </div>
                                    </div>
                                </h6>
                                <span class="text-xs" style="margin: 15px;color: #090909;">{{ $seance->heure_debut }}</span>
                                <span class="text-xs" style="margin: 15px;color: #090909;">{{ $seance->heure_fin }}</span>
                                <span class="text-xs" style="margin: 35px;color: #090909;front()">{{ $seance->date }}</span>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('dash.attendance', $seance->id) }}" class="btn btn-success" style="margin:2%">Attendance</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card custom-card" style="margin: 0% 04%">
            <div class="card-body text-center">
                <h5 class="card-text">Le nombre d'absences pour tous les groupes</h5>
                <div class="chart-container">
                    @include('charts.lineplus')
                </div>
            </div>
        </div>
    </div>

    


@endsection
