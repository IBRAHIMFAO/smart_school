{{-- @extends('dashboard.master')

@section("content")
<div style="margin: 06% 03%">
    <h1>Emploi du Temps - Salle</h1>

    <form action="{{ route('emploi-du-temps.salle.index') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="salle">Salle:</label>
            <select name="chosen_salle" id="salle" class="form-control">
                <option value="">Select Salle</option>
                @foreach ($salles as $salle)
                    <option value="{{ $salle->id }}" {{ $selectedSalle && $selectedSalle->id == $salle->id ? 'selected' : '' }}>
                        {{ $salle->label }}
                    </option>

                @endforeach
            </select>
        </div>


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

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>







    <div class="timetable">
        <div class="table-responsive">
            <table class="table table-bordered " >
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
                            <td>{{ $interval }}</td>
                            @foreach ($daysOfWeek as $dayIndex => $day)
                        <div class="td">
                            <td class="{{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? 'has-seance' : 'no-seance' }}"
                                    rowspan="{{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? count($filteredSeances[$dayIndex][$intervalIndex]) : 1 }}">

                                    @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                                    @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seance)

                                        @php
                                            // Get the seance ID
                                            $seanceId = $seance->id;

                                            // Check if a color is already assigned to this ID, otherwise assign one
                                            if (!isset($colorMap[$seanceId])) {
                                                $colorIndex = $lastColorIndex % count($colors);
                                                $colorMap[$seanceId] = $colors[$colorIndex];
                                                $lastColorIndex++;
                                            }

                                            $seanceColor = $colorMap[$seanceId];
                                        @endphp

                                        <div  style="background-color: {{ $seanceColor }}">
                                        <p style="color: black">
                                            <strong>id :</strong> {{ $seance->id }}<br>
                                            <strong>Prof :</strong>{{ $seance->prof->first_name }} {{ $seance->prof->last_name }}<br>
                                            <strong>Matière :</strong> {{ $seance->matiere->label }}<br>
                                            <strong>Salle : </strong> {{ $seance->salle->label }}<br>
                                            Heure de début: {{ $seance->heure_debut }}<br>
                                            Heure de fin: {{ $seance->heure_fin }}<br>
                                            <strong>Groupe :</strong>{{ $seance->group->nom_group }}<br>
                                        </p>
                                    </div>
                                        <hr>
                                    @endforeach
                                @else
                                    No seances found.
                                @endif

                                </td>
                        </div>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</div>
@endsection --}}



@extends('dashboard.master')


@section("content")

<div class=" ">    
    <div class="d-flex flex-row">
        <div class="p-2"><a href="{{ route('emploi-du-temps.index') }}" > L'emploi du temps de group</a> </div>
        <div class="p-2"><a href="{{ route('emploi-du-temps.prof.index') }}" >L'emploi du temps de prof  </a> </div>
        <div class="p-2"><a  href="{{ route('emploi-du-temps.salle.index') }}">L'emploi du temps de salle </a> </div>
      </div>
      <div class="d-flex flex-row-reverse">
        <div class="p-2">Flex item 1</div>
        <div class="p-2">Flex item 2</div>
        <div class="p-2">Flex item 3</div>
      </div>

</div>




@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li style="font-size: 20px; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif




<div style="margin: 3% 3%">
    <h1>Emploi du Temps - Salle</h1>

    <form action="{{ route('emploi-du-temps.salle.index') }}" method="GET">
        @csrf

        <div class="card">
            <div class="row mt-4">
                <div class="col-md-3">
                    {{-- <div class="form-group">
                        <label for="salle">Salle:</label>
                        <select name="chosen_salle" id="salle" class="form-control">
                            <option value="">Select Salle</option>
                            @foreach ($salles as $salle)
                                <option value="{{ $salle->id }}" {{ $selectedSalle && $selectedSalle->id == $salle->id ? 'selected' : '' }}>
                                    {{ $salle->label }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                     <!-- Pavillon -->
                    <div class="form-group">
                        <label for="pavillon">Pavillon :</label>
                        <select class="form-select" name="pavillon" id="pavillon" class="form-control">
                            <option value="">Sélectionnez un pavillon </option>
                            @foreach ($pavilions as $pavillon)
                                <option value="{{ $pavillon->id }}" {{ old('pavillon') == $pavillon->id ? 'selected' : '' }}>
                                    {{ $pavillon->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Salle (Will be populated dynamically) -->
                    <div class="form-group">
                        <label for="salle">Salle :</label>
                        <select  class="form-select" name="chosen_salle" id="salle" class="form-control">
                            <option value="">Sélectionnez un pavillon pour afficher les salles</option>
                        </select>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="form-group">
                        <label for="chosen_week">Choisir la semaine:</label>
                        <select  class="form-select" name="week" class="form-control">
                            @for ($week = 1; $week <= 52; $week++)
                                <option value="{{ $week }}" @if ($week == $chosenWeek) selected @endif>
                                    {{ $week }} - {{ now()->setISODate(now()->year, $week)->startOfWeek()->format('M d') }}
                                    {{ now()->setISODate(now()->year, $week)->endOfWeek()->format('M d') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                 <!-- Année Scolaire -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="annee_scolaire">Année Scolaire :</label>
                        <select class="form-select" name="annee_scolaire" id="annee_scolaire" class="form-control">
                            <option value="">Sélectionnez une année scolaire</option>
                            @foreach ($anneeScolaires as $anneeScolaire)
                                <option value="{{ $anneeScolaire->id }}" {{ old('annee_scolaire') == $anneeScolaire->id ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>


        </div>
    </form>

    <div class="timetable">
        <div class="table-responsive">
            <table class="table">
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
                                    @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                                        @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seance)
                                            @php
                                                // Get the seance ID
                                                $seanceId = $seance->id;

                                                // Check if a color is already assigned to this ID, otherwise assign one
                                                if (!isset($colorMap[$seanceId])) {
                                                    $colorIndex = $lastColorIndex % count($colors);
                                                    $colorMap[$seanceId] = $colors[$colorIndex];
                                                    $lastColorIndex++;
                                                }

                                                $seanceColor = $colorMap[$seanceId];
                                            @endphp
                                            <div class="seance" style="background-color: {{ $seanceColor }}">
                                                <p style="color: black">
                                                    <strong>id :</strong> {{ $seance->id }}<br>
                                                    <strong>Prof :</strong> {{ $seance->prof->first_name }} {{ $seance->prof->last_name }}<br>
                                                    <strong>Matière :</strong> {{ $seance->matiere->label }}<br>
                                                    <strong>Salle :</strong> {{ $seance->salle->label }}<br>
                                                    {{-- Heure de début: {{ $seance->heure_debut }}<br>
                                                    Heure de fin: {{ $seance->heure_fin }}<br> --}}
                                                    <strong>Horaires de séance : </strong>{{ Carbon\Carbon::parse($seance->heure_debut)->format('H\hi') }} - {{ Carbon\Carbon::parse($seance->heure_fin)->format('H\hi') }}
                                                    <br>
                                                    <strong>Groupe :</strong> {{ $seance->group->nom_group }}<br>
                                                </p>
                                            </div>
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
</div>

{{-- <a href="{{ url('/download-pdf.') }}" class="btn btn-primary">Download PDF</a> --}}

 {{-- <a href="{{ url('/download-pdf.' ,[
     'chosenSalle' => $chosenSalle,
    'filteredSeances' => $filteredSeances,
    'chosenWeek' => $chosenWeek,
    'selectedSalle' => $selectedSalle,
    ' seanceColor' => $seanceColor,]) }}" class="btn btn-primary">Download PDF</a> --}}


  <a href="{{ route('download-pdf', [
    'chosenSalle' => $chosenSalle,
    'chosenWeek' => $chosenWeek,
    // 'filteredSeances' => $filteredSeances,
    // 'seance' => $seance,
    // 'selectedSalle' => $selectedSalle,
     // 'daysOfWeek' => $daysOfWeek,
    // 'timeIntervals' => $timeIntervals,

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

    .timetable {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        height: 600px;
    }

    th, td {
        border: 1px solid #b0acac; /* Add a black border to table cells */
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

    form .card {
        padding: 20px;
        margin: 20px 0;
        border-radius: 10px;
        background-color: #f5f5f5;
    }

    form .btn {
        margin-top: 20px;
        height: 40px;
        width: 100px;


    }
    h1 {
        font-size: 30px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        font-size: 20px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
    }

    .form-select {
        height: 40px;
        width: 100%;
        font-size: 15px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        color: #0e2bcb;
    }


</style>




        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('pavillon').addEventListener('change', function() {
                    var pavillonId = this.value;
                    var salleSelect = document.getElementById('salle');
                    if (pavillonId) {
                        axios.get(`/get-salles/${pavillonId}`)
                            .then(function(response) {
                                salleSelect.innerHTML = '<option value="">Sélectionnez une salle</option>';
                                for (var key in response.data) {
                                    salleSelect.innerHTML += `<option value="${key}">${response.data[key]}</option>`;
                                }
                            })
                            .catch(function(error) {
                                console.error('Error:', error);
                            });
                    } else {
                        salleSelect.innerHTML = '<option value="">Sélectionnez une salle</option>';
                    }
                });
            });
        </script>

@endsection
