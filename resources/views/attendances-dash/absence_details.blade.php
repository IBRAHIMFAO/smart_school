
@extends('dashboard.master');

@section('content')

        <!-- resources/views/attendances-dash/absence_details.blade.php -->

        {{-- <h4>Absence Details for {{ $absenceDetails[0]->student->first_name }} {{ $absenceDetails[0]->student->last_name }}</h4>

        <ul>
            @foreach ($absenceDetails as $absence)
                <li>
                    Date de Seance: {{ $absence->seance->date }}<br>
                    Matiere: {{ $absence->seance->matiere->label }}<br>
                    First Name de Prof: {{ $absence->seance->prof->first_name }}<br>
                    Last Name de Prof: {{ $absence->seance->prof->last_name }}<br>
                    heure de debut la seance: {{ $absence->seance->heure_debut }} <br>
                    heure de fin la seance: {{ $absence->seance->heure_fin }}  <br>
                    Durée de la séance: {{ $absence->seance->duree() }}

                </li>
            @endforeach
        </ul>

        <div class="alert alert-info" style="margin: 50%">
            <p>
                <strong>Nombre d'absences:</strong> {{ $absenceDetails->count() }}<br>
                <strong>Nombre d'heures d'absence:</strong> {{ $absenceDetails->sum(function($absence) {
                    return is_numeric($absence->seance->dureeInMinutes()) ? $absence->seance->dureeInMinutes() : 0;
                }) }}
            </p>
        </div>
        <a href="{{ route('dash-groupe.index') }}" class="btn btn-primary">Back</a> --}}

       <div class="container-fluid">
        <div class="card-head">
            <h4 class="text-center">Détails des absences pour <strong>{{ $absenceDetails[0]->student->first_name }} {{ $absenceDetails[0]->student->last_name }}</strong></h4>
          </div>
        <div class="card">
            
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Matière</th>
                    <th>Professeur</th>
                    <th>Heure de début </th>
                    <th>Heure de fin</th>
                    <th>Durée</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($absenceDetails as $absence)
                    <tr>
                      <td>{{ $absence->seance->date }}</td>
                      <td>{{ $absence->seance->matiere->label }}</td>
                      <td>{{ $absence->seance->prof->last_name }} {{ $absence->seance->prof->first_name }}</td>
                      <td>{{  \Carbon\Carbon::parse($absence->seance->heure_debut)->format('H:i:s')  }}</td>
                      <td>{{  \Carbon\Carbon::parse($absence->seance->heure_fin)->format('H:i:s')  }}</td>
                      {{-- <td>{{ $absence->seance->heure_debut }}</td>
                      <td>{{ $absence->seance->heure_fin }}</td> --}}
                      <td>{{ $absence->seance->duree() }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="alert alert-info">
                <strong>Number of absences:</strong> {{ $absenceDetails->count() }}<br>
                <strong>Total absence duration:</strong> {{ $absenceDetails->sum(function($absence) {
                  return is_numeric($absence->seance->dureeInMinutes()) ? $absence->seance->dureeInMinutes() : 0;
                }) }} minutes
              </div>
              <a href="{{ route('dash-groupe.index') }}" class="btn btn-primary">Back</a>
            </div>
          </div>
          

      
    
       </div>
        
    <style>
        .card-head {
          background-color: #fff;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
          margin: 0 auto;
          margin-top: 5%;
          margin-bottom: 5%;
          padding: 10px;
          width: 100%;
        }

        .card {
          /* margin: 0 5%; */
          margin-top: 05%;
          color: black;
        }
        table thead tr th , table tbody tr td {
          /* width: 100%;
          border-collapse: collapse; */
          color: black;
        }

        </style>
  
@endsection 