{{-- @extends('dashboard.master')

@section('content')

 <a href="{{ route('emploi-du-temps.prof.index',
 ['export' => 1] + request()->except('export')) }}" class="btn btn-success">Export to Excel</a>



<div style="margin: 06% 03%">
    <h1>Emploi du Temps - Professeurs</h1>

    <form action="{{ route('emploi-du-temps.prof.index') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="prof">Professeur:</label>
            <select name="chosen_prof" id="prof" class="form-control">
                <option value="">Select Professeur</option>
                @foreach ($profs as $prof)
                    <option value="{{ $prof->id }}" {{ $chosenProfId == $prof->id ? 'selected' : '' }}>
                        {{ $prof->first_name }} {{ $prof->last_name }}
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

    <!-- Similar timetable structure as before salle -->

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
                            <td>{{ $interval }}</td>
                            @foreach ($daysOfWeek as $dayIndex => $day)
                                <td class="{{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? 'has-seance' : 'no-seance' }}"
                                    rowspan="{{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? count($filteredSeances[$dayIndex][$intervalIndex]) : 1 }}">

                                    @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                                    @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seance)
                                        {{ $seance->id }} - {{ $seance->prof->firstName }} {{ $seance->prof->lastName }}<br>
                                        Matière: {{ $seance->matiere->nom_matiere }}<br>
                                        Salle: {{ $seance->salle->label }}<br>
                                        Heure de début: {{ $seance->heure_debut }}<br>
                                        Heure de fin: {{ $seance->heure_fin }}<br>
                                        Groupe: {{ $seance->group->nom_group }}<br>
                                        <hr>
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
    </div>

</div>
@endsection --}}


@extends('dashboard.master')

@section('content')
{{--
<a href="{{ route('emploi-du-temps.prof.index',
['export' => 1] + request()->except('export')) }}" class="btn btn-success">Export to Excel</a> --}}

<div style="margin: 06% 03%">
    <h1>Emploi du Temps - Professeurs</h1>

    <form action="{{ route('emploi-du-temps.prof.index') }}" method="GET">
        @csrf

        <div class="card">
            <div class="row mt-4">
                <div class="col-md-3">
                    <!-- Department -->
                    <div class="form-group">
                        <label for="departement">Choose a Department:</label>
                        <select class="form-select" name="departement" id="departement">
                            <option value="">Select a Department</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Professor -->
                    <div class="form-group">
                        <label for="prof">Choose a Professor:</label>
                        <select class="form-select" name="chosen_prof" id="prof">
                            <option value="">Select Professor</option>
                            {{-- Professors will be populated dynamically using JavaScript --}}
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Choose the Week -->
                    <div class="form-group">
                        <label for="chosen_week">Choose the Week:</label>
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

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>




    <!-- Similar timetable structure as before salle -->

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
                            <td>{{ $interval }}</td>
                            @foreach ($daysOfWeek as $dayIndex => $day)
                                <td class="{{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? 'has-seance' : 'no-seance' }}"
                                    rowspan="{{ isset($filteredSeances[$dayIndex][$intervalIndex]) ? count($filteredSeances[$dayIndex][$intervalIndex]) : 1 }}">

                                    @if (isset($filteredSeances[$dayIndex][$intervalIndex]))
                                    @foreach ($filteredSeances[$dayIndex][$intervalIndex] as $seance)
                                        {{ $seance->id }} - {{ $seance->prof->first_name }} {{ $seance->prof->last_name }}<br>
                                        Matière: {{ $seance->matiere->nom_matiere }}<br>
                                        Salle: {{ $seance->salle->label }}<br>
                                        Heure de début: {{ $seance->heure_debut }}<br>
                                        Heure de fin: {{ $seance->heure_fin }}<br>
                                        Groupe: {{ $seance->group->nom_group }}<br>
                                        <hr>
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
    </div>
</div>

    <style>
                /* Add CSS styles for the department filter */
        #department-filter {
            margin: 10px 0;
        }

        /* Add styles for the filtered results container */
        #filtered-results {
            margin: 10px 0;
        }

        /* Customize the appearance of the department filter button */
        #filter-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        /* Style the department list items */
        .department-item {
            margin-right: 10px;
            cursor: pointer;
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
                url: '{{ route('get-professors-by-department') }}', // Use the appropriate route URL
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

