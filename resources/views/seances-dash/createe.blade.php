@extends("dashboard.master")

@section("content")


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@php
    use Carbon\Carbon;
@endphp



<!-- create_seance.blade.php -->

<form method="POST" action="{{ route('dash-seance.store') }}" class="needs-validation">
    @csrf
    {{-- @method('POST') --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Create Seance</h1>

                <div class="form-group">
                    <label for="annee_scolaire">Année scolaire:</label>
                    <select class="form-control" id="annee_scolaire" name="annee_scolaire" required>
                        <option value="">Select Année scolaire:</option>
                        @foreach ($anneeScolaires as $anneeScolaire)
                            @php
                                $startYear = Carbon::parse($anneeScolaire->start_date)->format('Y');
                                $endYear = Carbon::parse($anneeScolaire->end_date)->format('Y');
                            @endphp
                            <option value="{{ $anneeScolaire->id }}">{{ $startYear }} / {{ $endYear }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                        <label for="group">Group:</label>
                            <select class="form-control" id="group" name="group" required>
                                <option value="">Select Group</option>
                                @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->nom_group }}->{{ $group->niveauxscolaire->niveauxscolaire }}->{{  $group->filiere->nom_filiere  }}</option>
                                @endforeach
                            </select>
                </div>

                        <div class="form-group">
                            <label for="matiere">Matiere:</label>
                            <select class="form-control" id="matiere" name="matiere" required>
                                <option value="">Select Matiere</option>
                                @foreach ($matieres as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prof">Prof:</label>
                            <select class="form-control" id="prof" name="prof" required>
                                <option value="">Select Prof</option>
                                @foreach ($profs as $prof)
                                <option value="{{ $prof->id }}">{{ $prof->firstName }} {{ $prof->lastName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="salle">Salle:</label>
                            <select class="form-control" id="salle" name="salle" required>
                                <option value="">Select Salle</option>
                                @foreach ($salles as $salle)
                                <option value="{{ $salle->id }}">{{ $salle->status }} N: {{ $salle->numero_salle }} </option>
                                @endforeach
                            </select>
                        </div>

                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>

                                <div class="form-group">
                                    <label for="heure_debut">Heure début:</label>
                                    <input type="time" class="form-control" id="heure_debut" name="heure_debut" required>
                                </div>

                                <div class="form-group">
                                    <label for="heure_fin">Heure fin:</label>
                                    <input type="time" class="form-control" id="heure_fin" name="heure_fin" required>
                                </div>

                                 <!-- Add the periodicite field -->
                                {{-- <div class="form-group">
                                    <label for="periodicite">Periodicite:</label>
                                    <select class="form-control" id="periodicite" name="periodicite" required>
                                        <option value="">Select Periodicite</option>
                                        <option value="1">Every day</option>
                                        <option value="7">Every week</option>
                                        <option value="30">Every month</option>
                                        <option value="365">Every year</option>
                                    </select>
                                </div> --}}

                                <!-- Add the periodicite field -->
                <div class="form-group">
                    <label for="periodicite">Periodicite:</label>
                    <select class="form-control" id="periodicite" name="periodicite" required>
                        <option value="">Select Periodicite</option>
                        <option value="Annee">Annee</option>
                        <option value="Mois">Mois</option>
                        <option value="Semaine">Semaine</option>
                        <option value="Jour">Jour</option>
                    </select>
                </div>

                                <br><br>


                            <button type="submit" class="btn btn-primary " >Create Seance</button>

        </div>

            </div>

                </div>

</form>








@endsection
