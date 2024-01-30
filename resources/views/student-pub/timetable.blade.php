@extends('dashboard.public.master')

@section('title', 'Emploi du temps')

@section('content')
<div class="container">
    <h1 class="mt-3">Emploi du Temps - Groupe :{{ $group->nom_group}} </h1>

    <form action="{{ route('student.timetable.index') }}" method="get" class="mb-3">
        <!-- Your form for filtering the timetable -->
            <div class="form-group">
                <label for="chosen_week">Choisir la semaine:</label>
                <select name="week" id="chosenWeek" class="form-control">
                    @for ($week = 1; $week <= 52; $week++)
                    <option value="{{ $week }}" @if ($week == $chosenWeek) selected @endif>
                        {{ $week }} - {{ now()->setISODate(now()->year, $week)->startOfWeek()->format('M d') }}
                        {{ now()->setISODate(now()->year, $week)->endOfWeek()->format('M d') }}
                    </option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrer</button>

    </form>


    <div class="timetable table-responsive">
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
                        ($interval === '12:00:00 - 13:00:00' || $interval === '13:00:00 - 14:00:00' ? 'is-disabled' : 'no-seance') }}">

                            @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                            @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seance)
                                <p>Matière :{{ $seance->matiere->label }} </p>
                                <p>{{ $seance->prof->firstName }} {{ $seance->prof->lastName }} </p>
                                <p> Salle: {{ $seance->salle->label }} </p>
                                <p>Start: {{ $seance->heure_debut }} </p>
                                <p>End: {{ $seance->heure_fin }} </p>
                                {{-- Group: {{ $seance->group->nom_group }}<br> --}}
                                <hr>
                            @endforeach
                            @else
                            <!-- No seances found for this interval -->
                            @endif

                    </td>

                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Your custom CSS styles */

    .container {
        margin-top: 15%;
    }

    h1 {
        font-size: 20px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
    }

    tbody td.no-seance {
        background-color: #ccc;
    }

    /* Style for the greyed out time intervals */
    td.seance-cell.is-disabled {
        background-color: #B2BEB5;
        pointer-events: none;
    }

    td.interval-cell.is-disabled {
        text-align: center;
        background-color: #B2BEB5;
        pointer-events: none;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #b0acac;
    }

    .table th,
    .table td {
        border: 1px solid #dee2e6;
    }

    .timetable {
        margin: 0;
        padding: 0;
        width: 100%;
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
        margin: 0;
        height: 50px;
        width: 20px;
        position: relative;
        font-size: 15px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        fill-opacity: 0.7;
    }

    td.seance-cell.has-seance {
        color: rgb(19, 18, 18);
        padding: 0;
        margin: 0;
    }

    /* Add responsive styling for smaller screens */
    @media (max-width: 576px) {
        .seance-cell {
            font-size: 12px; /* Adjust font size for smaller screens */

        }
        .timetable {
            height: 100% ; /* Adjust height for smaller screens */
            width: 100%;
        }
    }
</style>

@endsection










