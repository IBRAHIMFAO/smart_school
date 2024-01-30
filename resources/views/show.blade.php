@extends('layouts')

@section('content')
    <div class="container">

        <h1 class="display-5">Info about session of {{ date('l d M Y') }}</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>matiere</th>
                    <th>Professor Name</th>
                    <th>Salle </th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Group</th>
                    <th>View attendance</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $session->id }}</td>
                    <td>{{ $session->matiere->label }}</td>
                    <td>{{ $session->prof->firstName }} {{ $session->prof->lastName }}</td>
                    <td>{{ $session->salle->label }}</td>
                    {{-- <td>{{ \Carbon\Carbon::parse($session->heure_debut)->format('s:m:H') }}</td>
                    <td>{{ \Carbon\Carbon::parse($session->heure_fin)->format('s:m:H') }}</td> --}}
                    <td>{{ $session->heure_debut }} </td>
                    <td>  {{ $session->heure_fin }} </td>
                    <td>{{ $session->group->label }}</td>
                    <td><a href="">See</a></td>
                </tr>
            </tbody>
        </table>

        <h3>Attendances</h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Student Name</th>
                    <th>Student Status</th>
                </tr>
                @foreach( $students as $student)
                    <tr>
                        <td>{{$student->student->firstName}}</td>
                        {{-- <td>{{$student->status===1 ? "present":"absent"}}</td> --}}
                        <td>{{ $student->status }}</td>
                    </tr>
                @endforeach
            </table>
    </div>
@endsection
