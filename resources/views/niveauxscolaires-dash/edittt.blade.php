@extends('dashboard.master')

@section('content')

<div class="container">
    <h1>Modifier Niveau Scolaire</h1>
    <form action="{{ route('dash-niveauxscolaire.update', $niveauScolaire->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="label">Nom du Niveau Scolaire:</label>
            <input type="text" name="label" id="label" class="form-control" value="{{ $niveauScolaire->label }}" required>
        </div>

        <div class="form-group">
            <label for="departement">Département</label>
            <select name="departement" id="departement" class="form-control" required>
                <option value="">Sélectionner le Département</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}" @if($niveauScolaire->filiere->departement->id == $department->id) selected @endif>{{ $department->label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="filiere">Filière</label>
            <select name="filiere" id="filiere" class="form-control" required>
                <!-- Options will be populated dynamically using JavaScript -->
            </select>

            {{-- ############## 2 eme methode ############## --}}
            {{-- <select name="filiere" id="filiere" class="form-control" required>
                <option value="">Select Filière</option>
                @foreach($departments as $department)
                    <optgroup label="{{ $department->label }}">
                        @foreach($department->filieres as $filiere)
                            <option value="{{ $filiere->id }}" @if($filiere->id === $niveauScolaire->code_filiere) selected @endif>
                                {{ $filiere->nom_filiere }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div> --}}
    {{-- ############## 2 eme methode ############## --}}

        <button type="submit" class="btn btn-primary">Modifier</button>
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
    // Set the initially selected Filière based on the current value
    const selectedFiliere = '{{ $niveauScolaire->code_filiere }}';
    filiereSelect.value = selectedFiliere;

    // Set the initially selected Filière based on the provided value
    const currentFiliereId = '{{ $currentFiliereId }}';
    filiereSelect.value = currentFiliereId;

</script>


@endsection
