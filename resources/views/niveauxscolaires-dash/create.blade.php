@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 style="margin: 10%">Créer Nouveau Niveau Scolaire</h1>
    <form action="{{ route('dash-niveauxscolaire.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="label">Label Niveau Scolaire</label>
            <input type="text" name="label" id="label" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="departement">Département</label>
            <select name="departement" id="departement" class="form-control" required>
                <option value="">Sélectionner le Département</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="filiere">Filière</label>
            <select name="filiere" id="filiere" class="form-control" required>
                <!-- Options will be populated dynamically using JavaScript -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>

<script>
    // JavaScript code to populate Filière dropdown based on selected Département
    const departementSelect = document.getElementById('departement');
    const filiereSelect = document.getElementById('filiere');

    departementSelect.addEventListener('change', () => {
        const selectedDepartement = departementSelect.value;

        // Fetch the filières based on the selected département via AJAX
        fetch(`/fetch-filieres/${selectedDepartement}`)
            .then(response => response.json())
            .then(data => {
                filiereSelect.innerHTML = '<option value="">Sélectionner la Filière</option>';

                // Populate the Filière dropdown with options
                data.forEach(filiere => {
                    const option = document.createElement('option');
                    option.value = filiere.id;
                    option.textContent = filiere.nom_filiere;
                    filiereSelect.appendChild(option);
                });
            });
    });
</script>

@endsection
