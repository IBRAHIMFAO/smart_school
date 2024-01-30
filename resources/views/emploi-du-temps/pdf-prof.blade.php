

@extends('dashboard.pdf')

@section("content")


<div >

    {{-- <img src="{{ $pic }}" alt="Logo de l'école" width="170px">
      <img src="{{ $pic_mdlnational }}" alt="Logo de l'école" width="300px" style="margin-left: 20%" > --}}
      <img src="data:image/png;base64,{{ base64_encode(file_get_contents( asset('storage/' . $ecole->logo) )) }}" width="170px"> 
      <img src="data:image/png;base64,{{ base64_encode(file_get_contents( asset('storage/images/logos/mdlnationale.png') )) }}" width="300px" style="margin-left: 20%" >
    

    {{-- <h1 style="font-size: 23px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center; margin-bottom: 20px;">Emploi du temps - {{$salle->pavilion->label}} - {{ $salle->label }} </h1> --}}

    <h1 style="font-size: 23px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-align: center; margin-bottom: 20px;">Emploi du temps - {{ $prof->first_name }} {{ $prof->last_name }} </h1>

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



<style>
     tbody td.no-seance{
        background-color: #ccc;
        /* background-color:#A9A9A9; */

    }

    /* Style for the greyed out time intervals */
    td.seance-cell.is-disabled {
        background-color:#B2BEB5;

        /* background-color: #ccc; Grey background color */
        pointer-events: none; /* Disable selection */
        height: 20px;
    }
    td.interval-cell.is-disabled {
        background-color:#B2BEB5;

        /* background-color: #ccc; Grey background color */
        pointer-events: none; /* Disable selection */
        height: 20px;
    }



    table {
        border-collapse: collapse; /* Collapse table borders */
        width: 100%; /* Ensure the table occupies the full width */
        height: 70%;
        border: 1px solid #b0acac; /* Add a black border to the table */

    }

    .timetable {
        margin: 0;
        padding: 0;
        /* width: 100%;
        height: 100%; */
        overflow: auto;
        /* height: 600px; */
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
        font-size: 10px;
        font-family: Arial, Helvetica, sans-serif;
    }

    td.seance-cell {
        padding: 0;
        margin: 0;
        height: 30px;
        width: 50px;
        position: relative;
        font-size: 6px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        fill-opacity: 0.7;

    }
    td.interval-cell {
        text-align: center;
        padding: 0;
        margin:0;
        height: 30px;
        width: 20px;
        position: relative;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        fill-opacity: 0.7;

    }




</style>






@endsection
