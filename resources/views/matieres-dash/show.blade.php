@extends('dashboard.master')

@section('content')
<style>
    .matiere-details {
        background-color: #f8f9fa;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 20px;
        margin-right : 20%;
        font-size: 18px; /* Increase font size */
    }

    .matiere-details h5 {
        font-size: 24px; /* Increase font size for Matiere label */
    }

    .matiere-details p {
        margin: 0;
    }

    .btn-custom {
        font-size: 18px; /* Increase font size for buttons */
    }


    .btn-custom:hover {
        transform: scale(1.1);
    }

    .btn-custom:focus {
        outline: none;
    }


    p.card-text {
        font-size: 18px; /* Increase font size for Matiere description */    }
</style>

<div class="container">
    <h1 style="margin-bottom: 05%">Détails de la Matière</h1>

    <div class="matiere-details card">
        <div class="card-body">
            <h5 class="card-title"><strong>Matière:</strong> {{ $matiere->label }}</h5>
            <p class="card-text"><strong>Niveau Scolaire:</strong> {{ $matiere->niveauxscolaire->label }}</p>
            <p class="card-text"><strong>Filière:</strong> {{ $matiere->niveauxscolaire->filiere->nom_filiere }}</p>
            <p class="card-text"><strong>Département:</strong> {{ $matiere->niveauxscolaire->filiere->departement->label }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $matiere->description ?: 'Aucune description disponible' }}</p>
        </div>
    </div>

    <a href="{{ route('dash-matiere.edit', $matiere->id) }}" class="btn btn-primary btn-custom mt-3">Modifier</a>
    <a href="{{ route('dash-matiere.index') }}" class="btn btn-secondary btn-custom mt-3">Retour à la liste des Matières</a>
</div>
@endsection

