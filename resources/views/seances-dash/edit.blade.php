@extends("dashboard.master")

@section('content')
<div class="container">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1>Modifier une Séance</h1>

    <form method="POST" action="{{ route('dash-seance.update', $seance->id) }}">
        @csrf
        @method('PUT')

        <!-- Année Scolaire -->
        <div class="form-group">
            <label for="annee_scolaire">Année Scolaire</label>
            <select name="annee_scolaire" id="annee_scolaire" class="form-control">
                <option value="">Sélectionnez une année scolaire</option>
                @foreach ($anneeScolaires as $anneeScolaire)
                    <option value="{{ $anneeScolaire->id }}" {{ $seance->annee_scolaire == $anneeScolaire->id ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- École -->
        <div class="form-group">
            <label for="ecole">École</label>
            <select name="ecole" id="ecole" class="form-control">
                <option value="">Sélectionnez une école</option>
                @foreach($ecoles as $ecole)
                    <option value="{{ $ecole->id }}" {{ $seance->ecole == $ecole->id ? 'selected' : '' }}>
                        {{ $ecole->nom_ecole }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Département -->
        <div class="form-group">
            <label for="departement">Département</label>
            <select name="departement" id="departement" class="form-control">
                <option value="">Sélectionnez un département</option>
                @foreach($departements as $departement)
                    <option value="{{ $departement->id }}" {{ $seance->departement == $departement->id ? 'selected' : '' }}>
                        {{ $departement->label }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filière -->
        <div class="form-group">
            <label for="filiere">Filière</label>
            <select name="filiere" id="filiere" class="form-control">
                <option value="">Sélectionnez une filière</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ $seance->filiere == $filiere->id ? 'selected' : '' }}>
                        {{ $filiere->nom_filiere }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Niveaux Scolaire -->
        <div class="form-group">
            <label for="niveaux_scolaire">Niveaux Scolaire</label>
            <select name="niveaux_scolaire" id="niveaux_scolaire" class="form-control">
                <option value="">Sélectionnez un niveau scolaire</option>
                @foreach($niveauxScolaires as $niveauScolaire)
                    <option value="{{ $niveauScolaire->id }}" {{ $seance->niveaux_scolaire == $niveauScolaire->id ? 'selected' : '' }}>
                        {{ $niveauScolaire->label }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Groupe -->
        <div class="form-group">
            <label for="groupe">Groupe</label>
            <select name="groupe" id="groupe" class="form-control">
                <option value="">Sélectionnez un groupe</option>
                @foreach($groupes as $groupe)
                    <option value="{{ $groupe->id }}" {{ $seance->group->id == $groupe->id ? 'selected' : '' }}>
                        {{ $groupe->nom_group }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pavillon -->
        <div class="form-group">
            <label for="pavillon">Pavillon</label>
            <select name="pavillon" id="pavillon" class="form-control">
                <option value="">Sélectionnez un pavillon</option>
                @foreach ($pavillons as $pavillon)
                    <option value="{{ $pavillon->id }}" {{ $seance->pavillon == $pavillon->id ? 'selected' : '' }}>
                        {{ $pavillon->label }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Salle -->
        <div class="form-group">
            <label for="salle">Salle</label>
            <select name="salle" id="salle" class="form-control">
                <option value="">Sélectionnez une salle</option>
                @foreach ($salles as $salle)
                    <option value="{{ $salle->id }}" {{ $seance->salle->id == $salle->id ? 'selected' : '' }}>
                        {{ $salle->label }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Matière -->
        <div class="form-group">
            <label for="matiere">Matière</label>
            <select class="form-control" id="matiere" name="matiere">
                <option value="">Sélectionnez une matière</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $seance->matiere->id == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->label }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Professeur -->
        <div class="form-group">
            <label for="prof">Professeur</label>
            <select class="form-control" id="prof" name="prof">
                <option value="">Sélectionnez un professeur</option>
                @foreach($profs as $prof)
                    <option value="{{ $prof->id }}" {{ $seance->prof->id == $prof->id ? 'selected' : '' }}>
                        {{ $prof->first_name }} {{ $prof->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Type -->
        <div class="form-group">
            <label for="type">Type de Séance</label>
            <select class="form-control" id="type" name="type">
                <option value="Cours" {{ $seance->type == 'Cours' ? 'selected' : '' }}>Cours</option>
                <option value="Examen" {{ $seance->type == 'Examen' ? 'selected' : '' }}>Examen</option>
                <option value="Devoir" {{ $seance->type == 'Devoir' ? 'selected' : '' }}>Devoir</option>
                <option value="Controle" {{ $seance->type == 'Controle' ? 'selected' : '' }}>Controle</option>
                <option value="TP" {{ $seance->type == 'TP' ? 'selected' : '' }}>TP</option>
                <option value="TD" {{ $seance->type == 'TD' ? 'selected' : '' }}>TD</option>
                <option value="Autre" {{ $seance->type == 'Autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>

        <!-- Statut de la Séance -->
        <div class="form-group">
            <label for="status">Statut de la Séance</label>
            <select class="form-control" id="status" name="status">
                <option value="Scheduled" {{ $seance->status == 'Scheduled' ? 'selected' : '' }}>Planifié</option>
                <option value="In Progress" {{ $seance->status == 'In Progress' ? 'selected' : '' }}>En Cours</option>
                <option value="Completed" {{ $seance->status == 'Completed' ? 'selected' : '' }}>Terminé</option>
                <option value="Cancelled" {{ $seance->status == 'Cancelled' ? 'selected' : '' }}>Annulé</option>
                <option value="Rescheduled" {{ $seance->status == 'Rescheduled' ? 'selected' : '' }}>Reporté (Date et Heure modifiées)</option>
                <option value="Postponed" {{ $seance->status == 'Postponed' ? 'selected' : '' }}>Reporté (Attente d'une nouvelle date)</option>
                <option value="No Show" {{ $seance->status == 'No Show' ? 'selected' : '' }}>Absent</option>
            </select>
        </div>

        <!-- Date -->
        <div class="form-group">
            <label for="date">Date de la Séance</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $seance->date }}">
        </div>

        <!-- Heure de Début -->
        <div class="form-group">
            <label for="heure_debut">Heure de Début</label>
            <input type="time" class="form-control" id="heure_debut" name="heure_debut" value="{{ $seance->heure_debut }}">
        </div>

        <!-- Heure de Fin -->
        <div class="form-group">
            <label for="heure_fin">Heure de Fin</label>
            <input type="time" class= "form-control" id="heure_fin" name="heure_fin" value="{{ $seance->heure_fin }}">
        </div>

        <!-- Périodicité -->
        <div class="form-group">
            <label for="periodicite">Périodicité de la Séance</label>
            <select class="form-control" id="periodicite" name="periodicite" disabled>
                <option value="Année" {{ $seance->periodicite == 'Année' ? 'selected' : '' }}>Année</option>
                <option value="Mois" {{ $seance->periodicite == 'Mois' ? 'selected' : '' }}>Mois</option>
                <option value="Semaine" {{ $seance->periodicite == 'Semaine' ? 'selected' : '' }}>Semaine</option>
                <option value="Jour" {{ $seance->periodicite == 'Jour' ? 'selected' : '' }}>Jour</option>
            </select>
        </div>

        <!-- Notes -->
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ $seance->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Modifier Séance</button>
    </form>
</div>







<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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




        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Filter fields
                $('#annee_scolaire').on('change', function() {
                    var anneeScolaireId = $(this).val();
                    if (anneeScolaireId) {
                        // Fetch and populate écoles
                        $.ajax({
                            type: 'GET',
                            url: '/get-ecoles',
                            data: { annee_scolaire: anneeScolaireId },
                            dataType: 'json',
                            success: function(data) {
                                // populateDropdown('#ecole', data);
                                $('#ecole').empty();
                                $('#ecole').append('<option value="">Sélectionnez une école</option>');
                                $.each(data, function(index, item) {
                                    $('#ecole').append('<option value="' + item.id + '">' + item.nom_ecole + '</option>');
                                });

                            }
                        });
                    }
                });

                $('#ecole').on('change', function() {
                    var ecoleId = $(this).val();
                    if (ecoleId) {
                        // Fetch and populate départements
                        $.ajax({
                            type: 'GET',
                            url: '/get-departements',
                            data: { ecole: ecoleId },
                            dataType: 'json',
                            success: function(data) {
                                // populateDropdown('#departement', data );
                                $('#departement').empty();
                                $('#departement').append('<option value="">Sélectionnez un département</option>');
                                $.each(data, function(index, item) {
                                    $('#departement').append('<option value="' + item.id + '">' + item.label + '</option>');
                                });

                            }
                        });
                    }
                });


                $('#departement').on('change', function() {
                    var departementId = $(this).val();
                    if (departementId) {
                        // Fetch and populate filières
                        $.ajax({
                            type: 'GET',
                            url: '/get-filieres',
                            data: { departement: departementId },
                            dataType: 'json',
                            success: function(data) {
                                // populateDropdown('#filiere', data);
                                $('#filiere').empty();
                                $('#filiere').append('<option value="">Sélectionnez une filière</option>');
                                $.each(data, function(index, item) {
                                    $('#filiere').append('<option value="' + item.id + '">' + item.nom_filiere + '</option>');
                                });
                            }
                        });
                    }
                });

                $('#filiere').on('change', function() {
                    var filiereId = $(this).val();
                    if (filiereId) {
                        // Fetch and populate niveaux scolaires
                        $.ajax({
                            type: 'GET',
                            url: '/get-niveaux-scolaires',
                            data: { filiere: filiereId },
                            dataType: 'json',
                            success: function(data) {
                                // populateDropdown('#niveaux_scolaire', data);
                                $('#niveaux_scolaire').empty();
                                $('#niveaux_scolaire').append('<option value="">Sélectionnez un niveau scolaire</option>');
                                $.each(data, function(index, item) {
                                    $('#niveaux_scolaire').append('<option value="' + item.id + '">' + item.label + '</option>');
                                });
                            }
                        });
                    }
                });

                $('#niveaux_scolaire').on('change', function() {
                    var niveauScolaireId = $(this).val();
                    if (niveauScolaireId) {
                        // Fetch and populate groupes
                        $.ajax({
                            type: 'GET',
                            url: '/get-groups',
                            data: { niveaux_scolaire: niveauScolaireId },
                            dataType: 'json',
                            success: function(data) {
                                // populateDropdown('#groupe', data);
                                $('#groupe').empty();
                                $('#groupe').append('<option value="">Sélectionnez un groupe</option>');
                                $.each(data, function(index, item) {
                                    $('#groupe').append('<option value="' + item.id + '">' + item.nom_group + '</option>');
                                });
                            }
                        });
                    }
                });

                // function populateDropdown(elementId, data) {
                //     var dropdown = $(elementId);
                //     dropdown.empty();
                //     dropdown.append('<option value="">Sélectionnez une option</option>');
                //     $.each(data, function(key, value) {
                //         dropdown.append($('<option></option>').attr('value', key).text(value));
                //     }); }




            });
        </script>

        <!-- Include this script in your edit.blade.php -->




@endsection
