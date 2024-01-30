@extends('layouts')

<?php //use Carbon/Carbon ?>

@section('content')

{{-- @foreach ($seances as $seance)
<h2>Seance Numéro: {{$loop->index+1}}</h2>
<h4>Séance ID: {{$seance->id}} </h4>
<h4>Groupe Name: {{$seance->group->label}}</h4>
<h4>Filiere: {{$seance->group->filiere->label}}</h4>
<h4>Niveau Scolaire: {{$seance->group->niveauxscolaire->label}}</h4>
<h4>Course Name: {{$seance->matiere->label}}</h4>
<h4>Professor:  {{$seance->prof->firstName}} {{$seance->prof->lastName}}</h4>
<h4>temps: de {{$seance->heure_debut}} à {{$seance->heure_fin}}</h4>
<h4>Salle: {{$seance->salle->label}}</h4>
    <hr>

@endforeach --}}
<div class="container">
    <h1 class="display-4">Séance de {{$datetime}}</h1>
  <div class="table-responsive">
        <table class="table  table-hover table-stripe">
            <thead>
                <tr>
                    <th scope="col">Seance ID</th>
                    <th scope="col">Matière</th>
                    <th scope="col">Groupe</th>
                    <th scope="col">Filiere</th>
                    <th scope="col">Niveau Scolaire</th>
                    <th scope="col">Professeur</th>
                    <th scope="col">Salle</th>
                    <th scope="col">Temps</th>
                    <th scope="col">Date de séance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seances as $seance)
                <tr class="">
                    {{-- <td>{{ $seance->group->label }}</td> --}}
                    <td scope="row">{{$seance->id}}</td>
                    <td scope="row">{{$seance->matiere->nom_matiere}}</td>
                    <td scope="row">{{$seance->group->label}}</td>
                    <td scope="row">{{$seance->group->filiere->label}}</td>
                    <td scope="row">{{$seance->group->niveauxscolaire->label}}</td>
                    <td scope="row">{{$seance->prof->firstName}} {{$seance->prof->lastName}} </td>
                    <td scope="row">{{$seance->salle->label}}</td>
                    {{-- <td scope="row">dgge {{\Carbon\Carbon::parse($seance->heure_debut)->format("s:m:h")}} à {{\Carbon\Carbon::parse($seance->heure_fin)->format("H:m:s")}}</td> --}}
                    <td scope="row">le {{$seance->date}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

{{-- @foreach ($groups as $group)
<h3>{{$group->label}}</h3>
    <h5>prof: {{$group->seance->prof->firstName}} {{$group->seance->prof->lastName}}</h5>
    <h5>salle: {{$group->seance->salle->label}}</h5>
    <h5>cours: {{$group->seance->matiere->label}}</h5>
    <h5>date: {{$group->seance->date}}</h5>
    <h5>de: {{$group->seance->heure_debut}} à {{$group->seance->heure_fin}}</h5>

    <hr>
@endforeach --}}

<h2>All Students:</h2>
@foreach ($s as $ss)
    <h5>{{$ss->firstName}} {{$ss->lastName}}   -   codeRFID:{{$ss->rfid_code}}</h5>
@endforeach

<h2>Students of Group 1:</h2>
{{-- @foreach ($g1 as $g)
    <h5>{{$g->firstName}} {{$g->lastName}}</h5>
@endforeach --}}

@foreach($a as $groupLabel => $students)
    <h2>Groupe:{{ $groupLabel }}</h2>
    <ul>
        @foreach($students as $student)
            <li>{{ $student->firstName }} {{ $student->lastName }}   |   codeRFID:{{$student->rfid_code}}</li>


        @endforeach
    </ul>
@endforeach




<table>
    <thead>
      <tr>
        <th></th>
        <th>Lundi</th>
        <th>Mardi</th>
        <th>Mercredi</th>
        <th>Jeudi</th>
        <th>Vendredi</th>
        <th>Samedi</th>
        <th>Dimanche</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>08:00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>08:30</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      ...
    </tbody>
  </table>








</div>

@endsection
