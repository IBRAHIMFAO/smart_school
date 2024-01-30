@extends('dashboard.master')

@section('content')

    <div class="list-top ">    
        <div class="d-flex flex-row">
            <div class="p-2"><a href="{{ route('emploi-du-temps.index') }}" > L'emploi du temps de group</a> </div>
            <div class="p-2"><a href="{{ route('emploi-du-temps.prof.index') }}" >L'emploi du temps de prof  </a> </div>
            <div class="p-2"><a  href="{{ route('emploi-du-temps.salle.index') }}">L'emploi du temps de salle </a> </div>
          </div>
          {{-- <div class="d-flex flex-row-reverse">
            <div class="p-2">Flex item 1</div>
            <div class="p-2">Flex item 2</div>
            <div class="p-2">Flex item 3</div>
          </div> --}}

    </div>

    <div class="ContentAll" style="margin: 03% 03%">

        <h1 class="mt-4">Emploi du Temps - Groupe </h1>

        <form action="{{ route('emploi-du-temps.index') }}" method="get" class="mb-3">

        <div class="card mb-3">
            <div class="row mt-4">

                <div class="col-md-3">
                    <!-- Année Scolaire -->
                    <div class="form-group">
                        <label for="annee_scolaire">Année Scolaire</label>
                        <select name="annee_scolaire" id="annee_scolaire" class="form-control">
                            <option value="">Sélectionnez une année scolaire</option>
                            @foreach ($anneeScolaires as $anneeScolaire)
                                <option value="{{ $anneeScolaire->id }}" {{ old('annee_scolaire') == $anneeScolaire->id ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- École -->
                    <div class="form-group">
                        <label for="ecole">École</label>
                        <select name="ecole" id="ecole" class="form-control">
                            <option value="">Sélectionnez une école</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Département -->
                    <div class="form-group">
                        <label for="departement">Département</label>
                        <select name="departement" id="departement" class="form-control">
                            <option value="">Sélectionnez un département</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Filière -->
                    <div class="form-group">
                        <label for="filiere">Filière</label>
                        <select name="filiere" id="filiere" class="form-control">
                            <option value="">Sélectionnez une filière</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Niveaux Scolaire -->
                    <div class="form-group">
                        <label for="niveaux_scolaire">Niveaux Scolaire</label>
                        <select name="niveaux_scolaire" id="niveaux_scolaire" class="form-control">
                            <option value="">Sélectionnez un niveau scolaire</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Groupe -->
                    <div class="form-group">
                        <label for="chosen_group">Groupe</label>
                        <select name="group" id="groupe" class="form-control">
                            <option value="">Sélectionnez un groupe</option>
                        </select>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label for="chosen_group">Choisir le groupe:</label>
                    <select name="group" class="form-control">
                        <option value="">Tous les groupes</option>
                        @foreach ($groupes as $group)
                            <option value="{{ $group->id }}" @if ($group->id == $chosenGroup) selected @endif>
                                {{ $group->nom_group }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="col-md-3">
                    <!-- Semaine -->
                    <div class="form-group">
                        <label for="chosen_week">Choisir la semaine:</label>
                        <select name="week" class="form-control">
                            @for ($week = 1; $week <= 52; $week++)
                                <option value="{{ $week }}" @if ($week == $chosenWeek) selected @endif>
                                    {{ $week }} - {{ now()->setISODate(now()->year, $week)->startOfWeek()->format('M d') }}
                                    {{ now()->setISODate(now()->year, $week)->endOfWeek()->format('M d') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>

        </form>

        </div>


        <div class="timetable ">
            <div class="table-responsive">
                <table class="table table-bordered  ">
                    <thead>
                        <tr class="week-names">
                            <th>Heures / Jours</th>
                            @foreach ($daysOfWeek as $day)
                                <th>{{ ucfirst($day) }}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timeIntervals as $intervalIndex => $interval)
                        <tr>
                            {{-- <td>{{ $interval }}</td> --}}

                            <td class="interval-cell {{ ($interval === '12:00:00 - 13:00:00' || $interval === '13:00:00 - 14:00:00') ? 'is-disabled' : '' }}">
                                {{ $interval }}
                            </td>

                            @foreach ($daysOfWeek as $dayIndex => $day)
                            <td class="seance-cell {{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? 'has-seance' :
                            //  'no-seance'
                            ($interval === '12:00:00 - 13:00:00' || $interval === '13:00:00 - 14:00:00' ? 'is-disabled' : 'no-seance')  }}">

                                {{-- <td class="{{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? 'has-seance' : 'no-seance' }}"> --}}
                                    @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                                        @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seance)
                                            @if (!$chosenGroup || $seance->code_group == $chosenGroup)
                                                {{-- {{ $seance->id }} -  --}}
                                                <div class="text-center table-list-seance">
                                                    <strong style="color: #007bff">Prof:</strong> {{ $seance->prof->first_name }} {{ $seance->prof->last_name }}<br>
                                                   <strong style="color: #007bff"> Matière: </strong> {{ $seance->matiere->label }}<br>
                                                   <strong style="color: #007bff">Salle:</strong>  {{ $seance->salle->label }}<br>
                                                    <strong style="color: #007bff">Heure de début:</strong>  {{ $seance->heure_debut->format('H:i') }}<br>
                                                    <strong style="color: #007bff">Heure de fin: </strong> {{ $seance->heure_fin->format('H:i') }}<br>
                                                    <strong style="color: #007bff"> Groupe: </strong>   {{ $seance->group->nom_group }}

                                                    <a  href="{{ route('dashboard.attendance.record.form', $seance->id) }}" style="color: #0eabdb" >
                                                        <p><i class="fas fa-check" style="margin-left:10px ;color:black"></i> Enregistrer la présence</p>
                                                    </a>
                                                    
                                                    <a  href="{{ route('dashboard.attendance.list', $seance->id) }}" style="color: #0eabdb;" >
                                                        <p><i class="fas fa-list" style="color:black "></i> Voir la liste de présence</p>
                                                    </a>
                                                    
                                                    
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        {{-- No seances found. --}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>


        <a href="{{ route('download-pdf.group', [
            'chosenGroup' => $chosenGroup,
            'chosenWeek' => $chosenWeek,
            ]) }}" class="btn btn-primary btn-download" >Download_PDF </a>
    
    
    </div>


   

    <style>

            /* Add your custom CSS styles here */
            /* a  .btn-download{
                width: 100px;
                margin: 10px;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                border-radius: 10px;

            } */

            .list-top{
                margin:3px;
                background: #f5f5f5;
                padding: 1%;
                border-radius: 10px;
                
            }
            .list-top .p-2{
                margin: 0 1% 0 1%;
                font-size: 20px;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                background-color: #cfd6d3;
                /* border-block: 1px solid #ccc;  */
                border-radius: 10px;
                padding: 4px 10px 4px 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            }
                
            

            h1 {
                font-size: 30px;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                /* color: #0e2bcb; */

            }

            tbody td.no-seance{
                background-color: #ccc;

            }


        /* Style for the greyed out time intervals */
        td.seance-cell.is-disabled {
            background-color:#B2BEB5;
            /* background-color: #ccc; Grey background color */
            pointer-events: none; /* Disable selection */
        }
        td.interval-cell.is-disabled {
            background-color:#B2BEB5;
            /* background-color: #ccc; Grey background color */
            pointer-events: none; /* Disable selection */
        }

        table {
            border-collapse: collapse; /* Collapse table borders */
            width: 100%; /* Ensure the table occupies the full width */
            border: 1px solid #b0acac; /* Add a black border to the table */

        }


            .table th,
            .table td {
                border: 1px solid #dee2e6;
            }

            .timetable {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            height: 600px;
        }

        .seance {
            padding: 5px;
            margin: 0;
        }

        tr.week-names th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        td.seance-cell {
            padding: 0;
            margin: 0;
            height: 50px;
            width: 50px;
            position: relative;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            fill-opacity: 0.7;

        }
        td.interval-cell {
            text-align: center;
            padding: 0;
            margin:0;
            height: 50px;
            width: 20px;
            position: relative;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            fill-opacity: 0.7;

        }


        td.seance-cell.has-seance {
            /* background-color: #0e2bcb; */
            color: rgb(19, 18, 18);
            /* text-align: center; */
            padding: 0;
            margin: 0;

        }

            .row {
                margin-left: 0;
                margin-right: 0;
            }


            form .card {
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            background-color: #f5f5f5;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */

        }



        form .form-group label {
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            /* background-color: #0e2bcb; */
        }

        form .form-select {
            height: 40px;
            width: 100%;
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #0e2bcb;
        }
            /* Style the "Filter" button */
            .btn-primary {
                background-color: #007bff;
                color: #fff;
                margin-top: 20px;
                height: 40px;
                width: 100px;
            }



            /* Style the professor dropdown */
            .form-select {
                width: 100%;
            }

            /* Add some spacing between elements */
            .mt-3 {
                margin-top: 1rem;
                margin-bottom: 0;
            }



    </style>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#annee_scolaire').on('change', function() {
            var anneeScolaireId = $(this).val();
            if (anneeScolaireId) {
                $.ajax({
                    type: 'GET',
                    url: '/get-ecoles',
                    data: { annee_scolaire: anneeScolaireId },
                    dataType: 'json',

                    success: function(data) {
                    $('#ecole').empty();
                    $('#ecole').append('<option value="">Sélectionnez une école</option>');
                    $.each(data, function(index, item) {
                        $('#ecole').append('<option value="' + item.id + '">' + item.nom_ecole + '</option>');
                    });
                }


                });
            }
        });

        $('#ecole').on('change', function() {
            var ecoleId = $(this).val();
            if (ecoleId) {
                $.ajax({
                    type: 'GET',
                    url: '/get-departements',
                    data: { ecole: ecoleId },
                    dataType: 'json',
                    success: function(data) {
                        $('#departement').empty();
                        $('#departement').append('<option value="">Sélectionnez un département</option>');
                        $.each(data, function(id, item) {
                            $('#departement').append('<option value="' + item.id + '">' + item.label + '</option>');
                        });
                    }
                });
            }
        });

        $('#departement').on('change', function() {
            var departementId = $(this).val();
            if (departementId) {
                $.ajax({
                    type: 'GET',
                    url: '/get-filieres',
                    data: { departement: departementId },
                    dataType: 'json',
                    success: function(data) {
                        $('#filiere').empty();
                        $('#filiere').append('<option value="">Sélectionnez une filière</option>');
                        $.each(data, function(id, item ) {
                            $('#filiere').append('<option value="' + item.id + '">' + item.nom_filiere + '</option>');
                        });
                    }
                });
            }
        });

        $('#filiere').on('change', function() {
            var filiereId = $(this).val();
            if (filiereId) {
                $.ajax({
                    type: 'GET',
                    url: '/get-niveaux-scolaires',
                    data: { filiere: filiereId },
                    dataType: 'json',
                    success: function(data) {
                        $('#niveaux_scolaire').empty();
                        $('#niveaux_scolaire').append('<option value="">Sélectionnez un niveau scolaire</option>');
                        $.each(data, function(id, item ) {
                            $('#niveaux_scolaire').append('<option value="' + item.id + '">' + item.label + '</option>');
                        });
                    }
                });
            }
        });

        $('#niveaux_scolaire').on('change', function() {
            var niveauScolaireId = $(this).val();
            if (niveauScolaireId) {
                $.ajax({
                    type: 'GET',
                    url: '/get-groups',
                    data: { niveaux_scolaire: niveauScolaireId },
                    dataType: 'json',
                    success: function(data) {
                        $('#groupe').empty();
                        $('#groupe').append('<option value="">Sélectionnez un groupe</option>');
                        $.each(data, function(id, item) {
                            $('#groupe').append('<option value="' + item.id + '">' + item.nom_group + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

























    {{-- <pre >
        @php
        print_r($filteredSeances[$seance ->code_group->nom_group ]);
        @endphp
    </pre> --}}

   {{-- <pre>
    @php
    print_r($filteredSeances[$seance->code_group ]);
    @endphp
    </pre> --}}

@endsection



































{{--

<div class="timetable">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="week-names">
                    <th>Heures / Jours</th>
                    @foreach ($daysOfWeek as $day)
                        <th>{{ ucfirst($day) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($timeIntervals as $interval)
                    <tr>
                        <td>{{ $interval }}</td>
                        @foreach ($daysOfWeek as $dayIndex => $day)
                            <td  class="{{ isset($filteredSeances[$dayIndex][$interval]) ? 'has-seance' : 'no-seance' }}">
                                @if (isset($filteredSeances[$dayIndex][$interval]))
                                    @foreach ($filteredSeances[$dayIndex][$interval] as $seance)
                                        @if (!$chosenGroup || $seance->code_group == $chosenGroup)
                                            {{ $seance->id }} - {{ $seance->prof->firstName }} {{ $seance->prof->lastName }}<br>
                                            Matière: {{ $seance->matiere->nom_matiere }}<br>
                                            Salle: {{ $seance->salle->label }}<br>
                                            Heure de début: {{ $seance->heure_debut }}<br>
                                            Heure de fin: {{ $seance->heure_fin }}<br>
                                            Groupe: {{ $seance->group->nom_group }}<br>
                                            <hr>
                                        @endif
                                    @endforeach
                                @else
                                    No seances found.
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}


    {{-- //Method tow for timetable --}}
     {{-- @foreach ($timeIntervals as $intervalIndex => $interval)
        <tr>
            <td>{{ $interval }}</td>
            @foreach ($daysOfWeek as $dayIndex => $day)
                @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                    @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seanceIndex => $seance)
                        @if (!$chosenGroup || $seance->code_group == $chosenGroup)
                            @php
                                // Calculate rowspan based on session duration
                                $sessionDuration = Carbon\Carbon::parse($seance->heure_debut)->diffInHours($seance->heure_fin);
                            @endphp
                            <td rowspan="{{ $sessionDuration }}" class="has-seance text-center">
                                <div>
                                    {{ $seance->id }} - {{ $seance->prof->firstName }} {{ $seance->prof->lastName }}<br>
                                    Matière: {{ $seance->matiere->nom_matiere }}<br>
                                    Salle: {{ $seance->salle->label }}<br>
                                    Heure de début: {{ $seance->heure_debut }}<br>
                                    Heure de fin: {{ $seance->heure_fin }}<br>
                                    Groupe: {{ $seance->group->nom_group }}
                                </div>
                            </td>

                        @endif
                    @endforeach
                @else
                    <td class="no-seance"></td>
                @endif

            @endforeach

        </tr>
        @endforeach --}}
