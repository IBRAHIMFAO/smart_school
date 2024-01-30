@extends("dashboard.master")

@section('content')

<div class="container">


    <div class="card">
        <h1 class="card-header">Détails de la Séance</h1>

        <div class="card-body">
            <h5 class="card-title">Informations de la Séance</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Année Scolaire:</strong> {{ $seance->annee_scolaire }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>École:</strong> {{ $seance->group->niveauxscolaire->filiere->departement->ecole->nom_ecole }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Département:</strong> {{ $seance->group->niveauxscolaire->filiere->departement->label }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Filière:</strong> {{ $seance->group->niveauxscolaire->filiere->nom_filiere }}</p>
                </div>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Niveaux Scolaire:</strong> {{ $seance->group->niveauxscolaire->label }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Groupe:</strong> {{ $seance->group->nom_group }}</p>
                </div>
            </div>

        </div>


            <hr>
            <h5 class="card-title">Statut de la Séance</h5>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Statut:</strong> {{ $seance->status }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Type:</strong> {{ $seance->type }}</p>
                </div>
            </div>

            <p style="margin-inline: 20%"><strong>Date:</strong> {{ $seance->date }}</p>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Heure de Début:</strong> {{ $seance->heure_debut }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Heure de Fin:</strong> {{ $seance->heure_fin }}</p>
                </div>
            </div>


            <hr>
            <h5 class="card-title">Informations de la Séance (Suite)</h5>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Salle:</strong> {{ $seance->salle->label }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Pavillon:</strong> {{ $seance->salle->pavilion->label }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Matière:</strong> {{ $seance->matiere->label }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Professeur:</strong> {{ $seance->prof->first_name }} {{ $seance->prof->last_name }}</p>
                </div>
            </div>


            <div class="">
                <strong>Notes:</strong>
                <textarea class="form-control" id="notes" name="notes" rows="3" readonly>{{ $seance->notes ?: 'Aucune Notes disponible' }}</textarea>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('dash-seance.edit', $seance->id) }}" class="btn btn-primary mt-3">Modifier la Séance</a>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('dash-seance.index') }}" class="btn btn-secondary mt-3">Retour à la liste des séances</a>
        </div>
    </div>
</div>

<style>
    .card h1 {
        font-size: 1.8rem;
        font-weight: 500;
        line-height: 1.22;
        font-style: italic;
        color: #000;
        padding: 10px 20px;
        margin-bottom: 0;
    }

    .card-title {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .card-body {
        padding: 20px;
    }

    .card-body p {
        margin-bottom: 0;
    }

    .card-body p strong {
        margin-right: 10px;
    }

    .card-body hr {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .card-body .form-group {
        margin-bottom: 0;
    }

    p {
        margin-bottom: 0;
        font-display: block;
        font: 1em sans-serif;
        padding: 0.5em 0;
        color: royalblue;
    }

    strong {
        font-weight: bold;
        color: #000;
    }

   .card-body h5 {
        font-size: 1.25rem;
        font-weight: 500;
        line-height: 1.22;
        color: #000;
    }

</style>

@endsection
