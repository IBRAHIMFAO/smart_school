@extends('dashboard.master')

@section('content')

<div class=" ">    
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


<div class="ContentAll" style="margin: 3% 3%">

    <h1>Emploi du Temps - Professeurs</h1>

    <form action="{{ route('emploi-du-temps.prof.index') }}" method="GET">
        @csrf
        <div class="card mb-3">
            <div class="row mt-4">
                <div class="col-md-3">
                    <!-- Département -->
                    <div class="form-group">
                        <label for="departement">Choisissez un département :</label>
                        <select class="form-select" name="departement" id="departement">
                            <option value="">Sélectionnez un département</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Professeur -->
                    <div class="form-group">
                        <label for="prof">Choisissez un professeur :</label>
                        <select class="form-select" name="chosen_prof" id="prof">
                            <option value="">Sélectionnez un professeur</option>
                            {{-- Les professeurs seront peuplés dynamiquement en utilisant JavaScript --}}
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Choisissez la semaine -->
                    <div class="form-group">
                        <label for="chosen_week">Choisissez la semaine :</label>
                        <select class="form-select" name="week" id="chosen_week">
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

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Structure de l'emploi du temps similaire à celui de salle -->
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
                    @foreach ($timeIntervals as $intervalIndex => $interval)
                        <tr>
                            <td class="interval-cell {{ ($interval === '12:00:00 - 13:00:00' || $interval === '13:00:00 - 14:00:00') ? 'is-disabled' : '' }}">
                                {{ $interval }}
                            </td>
                            @foreach ($daysOfWeek as $dayIndex => $day)
                                <td class="seance-cell {{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? 'has-seance' :
                                    //  'no-seance'
                                    ($interval === '12:00:00 - 13:00:00' || $interval === '13:00:00 - 14:00:00' ? 'is-disabled' : 'no-seance')  }}">
                                    @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                                        @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seance)
                                            {{ $seance->id }} - {{ $seance->prof->first_name }} {{ $seance->prof->last_name }}<br>
                                            Matière : {{ $seance->matiere->nom_matiere }}<br>
                                            Salle : {{ $seance->salle->label }}<br>
                                            Heure de début : {{ $seance->heure_debut->format('H:i') }}<br>
                                            Heure de fin : {{ $seance->heure_fin->format('H:i') }}<br>
                                            Groupe : {{ $seance->group->nom_group }}<br>
                                            <hr>
                                        @endforeach
                                    @else
                                        {{-- Aucune séance trouvée. --}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<a href="{{ route('download-pdf.prof', [
    'chosenProfId' => $chosenProfId,
    'chosenWeek' => $chosenWeek,
    ]) }}" class="btn btn-primary">Download PDF</a>


    <style>

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

        /* th, td {
            border: 1px solid #b0acac;
        } */

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
        }


        form .form-group label {
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
            /* font-weight: bold; */
            /* background-color: #0e2bcb; */
        }
        /* from .form-group label {
            font-size: 10px !important;
            font-family: Arial, Helvetica, sans-serif;
            /* font-weight: bold; */
            /* background-color: #0e2bcb; 
        } */

        form .form-select {
            height: 40px;
            width: 100%;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
            /* font-weight: bold; */
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
    $(document).ready(function () {
        // Listen for changes in the department select
        $('#departement').change(function () {
            var departmentId = $(this).val();

            // Make an Ajax request to get professors by department
            $.ajax({
                url: '{{ route('get-prof-by-department') }}', // Use the appropriate route URL
                type: 'GET',
                data: { department_id: departmentId },
                success: function (data) {
                    // Clear the current professor select
                    $('#prof').empty();

                    // Populate the professor select with the received data
                    $.each(data, function (key, value) {
                        $('#prof').append($('<option>', {
                            value: value.id,
                            text: value.first_name + ' ' + value.last_name
                        }));
                    });
                },
                error: function () {
                    console.log('Error fetching professors by department.');
                }
            });
        });
    });
</script>



@endsection

