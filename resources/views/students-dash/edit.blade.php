@extends('dashboard.master')

@section('content')

<div class="container">
    <h1 class="text-center">Modifier un étudiant</h1>
    <form action="{{ route('dash-student.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="firstName">Prénom:</label>
            <input type="text" class="form-control" name="firstName" value="{{ $student->firstName }}" required>
        </div>

        <div class="form-group">
            <label for="lastName">Nom de famille:</label>
            <input type="text" class="form-control" name="lastName" value="{{ $student->lastName }}" required>
        </div>

        <div class="form-group">
            <label for="group_id">Groupe:</label>
            <select name="group_id" class="form-control" required>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $group->id == $student->group_id ? 'selected' : '' }}>
                        {{ $group->nom_group }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="codeRFID">Code RFID:</label>
            <input type="text" class="form-control" name="codeRFID" value="{{ $student->codeRFID }}" required>
        </div>

        <div class="form-group">
            <label for="tuteur_firstName">Prénom du tuteur:</label>
            <input type="text" class="form-control" name="tuteur_firstName" value="{{ $student->tuteur->firstName ?? '' }}">
        </div>

        <div class="form-group">
            <label for="tuteur_lastName">Nom de famille du tuteur:</label>
            <input type="text" class="form-control" name="tuteur_lastName" value="{{ $student->tuteur->lastName ?? '' }}">
        </div>

        <div class="form-group">
            <label for="tuteur_numero_tel">Numéro de téléphone du tuteur:</label>
            <input type="text" class="form-control" name="tuteur_numero_tel" value="{{ $student->tuteur->numero_tel ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>

@endsection
