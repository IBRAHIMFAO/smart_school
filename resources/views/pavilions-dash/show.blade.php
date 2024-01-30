
@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Détails du Pavilion</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Label du Pavilion:</strong> {{ $pavilion->label }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $pavilion->description ?: 'Aucune description disponible' }}</p>
        </div>
    </div>
    <a href="{{ route('dash-pavilion.index') }}" class="btn btn-secondary mt-3">Retour à la liste des Pavilions</a>
</div>
@endsection
