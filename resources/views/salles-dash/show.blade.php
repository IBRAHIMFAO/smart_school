@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Détails de la Salle</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Label:</strong> {{ $salle->label }}</h5>
            <p class="card-text"><strong>Status:</strong> {{ $salle->status }}</p>
            <p class="card-text"><strong>Pavilion:</strong> {{ $salle->pavilion->label }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $salle->description ?: 'Aucune description disponible' }}</p>
        </div>
    </div>

    <a href="{{ route('dash-salle.index') }}" class="btn btn-secondary mt-3">Retour à la liste des Salles</a>
</div>
@endsection
