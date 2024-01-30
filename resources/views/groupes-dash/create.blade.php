@extends('dashboard.master')

@section('content')
{{-- 
<div class="container">
    <h1>Create Groupe</h1>

    <form method="POST" action="{{ route('dash-groupe.store') }}">
        @csrf


        <div class="form-group">
            <label for="departement">Département</label>
            <select name="departement" id="departement" class="form-control">
                <option value="">Sélectionnez un département</option>
                @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}">{{ $departement->label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="filiere">Filière</label>
            <select name="filiere" id="filiere" class="form-control">
                <option value="">Sélectionnez une filière</option>
            </select>
        </div>

        <div class="form-group">
            <label for="niveau_scolaire">Niveau Scolaire</label>
            <select name="niveau_scolaire" id="niveau_scolaire" class="form-control">
                <option value="">Sélectionnez un niveau scolaire</option>
            </select>
        </div>

        
        <div class="form-group">
            <label for="nom_group">Nom du Groupe</label>
            <input type="text" name="nom_group" id="nom_group" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary">Créer Groupe</button>
    </form>
</div> --}}


<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="mb-0 text-dark text-center">Créer Groupe</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dash-groupe.store') }}">
                @csrf

                <div class="form-group">
                    <label for="departement">Département</label>
                    <select name="departement" id="departement" class="form-control">
                        <option value="">Sélectionnez un département</option>
                        @foreach ($departements as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="filiere">Filière</label>
                    <select name="filiere" id="filiere" class="form-control">
                        <option value="">Sélectionnez une filière</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="niveau_scolaire">Niveau Scolaire</label>
                    <select name="niveau_scolaire" id="niveau_scolaire" class="form-control">
                        <option value="">Sélectionnez un niveau scolaire</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nom_group">Nom du Groupe</label>
                    <input type="text" name="nom_group" id="nom_group" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mr-2">Créer Groupe</button>
                    <a href="{{ route('dash-groupe.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Add your custom CSS styles here */
    .card {
        margin-top: 20px;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
    }

    .form-control {
        border-radius: 0;
    }

    /* Add more styles as needed */
</style>

<script>
    // JavaScript code to populate Filière dropdown based on selected Département
    const departementSelect = document.getElementById('departement');
    const filiereSelect = document.getElementById('filiere');
    const niveauScolaireSelect = document.getElementById('niveau_scolaire');

    departementSelect.addEventListener('change', () => {
        const selectedDepartement = departementSelect.value;

        // Fetch the filières based on the selected département via AJAX
        fetch(`/fetch-filieres/${selectedDepartement}`)
            .then(response => response.json())
            .then(data => {
                filiereSelect.innerHTML = '<option value="">Sélectionnez une Filière</option>';
                niveauScolaireSelect.innerHTML = '<option value="">Sélectionnez un Niveau Scolaire</option>';

                // Populate the Filière dropdown with options
                data.forEach(filiere => {
                    const option = document.createElement('option');
                    option.value = filiere.id;
                    option.textContent = filiere.nom_filiere;
                    filiereSelect.appendChild(option);
                });
            });
    });

    filiereSelect.addEventListener('change', () => {
        const selectedFiliere = filiereSelect.value;

        // Fetch the niveaux scolaires based on the selected filière via AJAX
        fetch(`/fetch-niveaux-scolaires/${selectedFiliere}`)
            .then(response => response.json())
            .then(data => {
                niveauScolaireSelect.innerHTML = '<option value="">Sélectionnez un Niveau Scolaire</option>';

                // Populate the Niveau Scolaire dropdown with options
                data.forEach(niveauScolaire => {
                    const option = document.createElement('option');
                    option.value = niveauScolaire.id;
                    option.textContent = niveauScolaire.label;
                    niveauScolaireSelect.appendChild(option);
                });
            });
    });
</script>
@endsection