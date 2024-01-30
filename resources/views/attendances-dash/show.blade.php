{{-- @extends('dashboard.master')

@section('content')

<div class="container">
    <h1>Détails de l'absence </h1>

    <div class="card">
        <div class="card-header">
            <h2>Informations sur l'absence</h2>
        </div>
        <div class="card-body">
            <p><strong>Date de l'absence :</strong> {{ $absence->date}}</p>
            <p><strong>Étudiant :</strong> {{ $absence->student->first_name }} {{ $absence->student->last_name }}</p>
            <p><strong>Statut :</strong> {{ $absence->status }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h2>Détails de la séance</h2>
        </div>
        <div class="card-body">
            <p><strong>Matière :</strong> {{ $seanceDetails->matiere->name }}</p>
            <p><strong>Professeur :</strong> {{ $seanceDetails->prof->first_name }} {{ $seanceDetails->professeur->last_name }}</p>
            <p><strong>Date de la séance :</strong> {{ $seanceDetails->date }}</p>
            <p><strong>Nombre d'heures :</strong> {{ $seanceDetails->number_of_hours }}</p>
        </div>
    </div>

    <a href="#" class="btn btn-primary mt-4">Retour</a>
</div>

@endsection --}}

@extends('dashboard.master')

@section("content")


{{-- 
<div class="container">
    <h2>Record Attendance for {{ $seance->date->formt('H:i:s') }} - {{ $seance->heure_debut->format('H:i:s') }}->{{ $seance->heure_fin }} </h2>
    <h3>Group: {{ $seance->group->nom_group }}</h3>

    <form method="post" action="{{ route('dashboard.attendance.record.manual', $seance->id) }}">
        @csrf
        <input type="hidden" name="seance_id" value="{{ $seance->id }}">

        <select type="type_record" name="type_record" class="form-control">
            <option value="manual">Manual</option>
            <option value="rfid_code">RFID Code (automatique)</option>
        </select>


        <h4>Manual Attendance</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Attendance</th>
                    <th>Motif Absence</th>
                </tr>
            </thead>
            <tbody>
                @foreach($StudentdGroup as $student)
                    <tr>
                        <td>{{ $student->first_name}} {{  $student->last_name }} </td>
                        <td>
                            <select name="attendances[{{ $student->id }}][status]" class="form-control">
                                <option value="present">Present</option>
                                <option value="tardy">Tardy</option>
                                <option value="absent">Absent</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="attendances[{{ $student->id }}][motif_absence]" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit Attendance</button>
    </form>
</div> --}}

<div class="container">
    <h2>Enregistrer la présence pour {{ $seance->date }} - {{ $seance->heure_debut->format('H:i:s') }} à {{ $seance->heure_fin->format('H:i:s') }}</h2>
    <h3>Groupe : {{ $seance->group->nom_group }}</h3>

    <form method="post" action="{{ route('dashboard.attendance.record.manual', $seance->id) }}">
        @csrf
        <input type="hidden" name="seance_id" value="{{ $seance->id }}">

        <select type="type_record" name="type_record" class="form-control">
            <option value="manual">Manuel</option>
            <option value="rfid_code">Code RFID (automatique)</option>
        </select>


        <h4>Présence manuelle</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom de l'élève</th>
                    <th>Présence</th>
                    <th>Motif de l'absence</th>
                </tr>
            </thead>
            <tbody>
                @foreach($StudentdGroup as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>
                            <select name="attendances[{{ $student->id }}][status]" class="form-control">
                                <option value="present">Présent</option>
                                <option value="tardy">En retard</option>
                                <option value="absent">Absent</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="attendances[{{ $student->id }}][motif_absence]" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Enregistrer la présence</button>
    </form>
</div>

@endsection
