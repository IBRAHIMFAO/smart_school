@extends('dashboard.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Détails du Niveau Scolaire</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="departement">Nom Département</label>
                <input type="text" id="departement" class="form-control" value="{{ $niveauScolaire->filiere->departement->label }}" readonly>
            </div>
            <div class="form-group">
                <label for="filiere">Filière</label>
                <input type="text" id="filiere" class="form-control" value="{{ $niveauScolaire->filiere->nom_filiere }}" readonly>
            </div>
            <div class="form-group">
                <label for="label">Niveau Scolaire</label>
                <input type="text" id="label" class="form-control" value="{{ $niveauScolaire->label }}" readonly>
            </div>
            <div class="form-group">
                <a href="{{ route('dash-niveauxscolaire.edit', $niveauScolaire->id) }}" class="btn btn-primary">Modifier</a>
                <a href="{{ route('dash-niveauxscolaire.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection
