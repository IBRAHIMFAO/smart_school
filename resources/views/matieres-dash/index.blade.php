@extends('dashboard.master')

@section('content')

<div class="container">
    @if (session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session()->has('error') )
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

    <h1>Liste des Matières</h1>

    <a href="{{ route('dash-matiere.create') }}" class="btn btn-primary mb-2">Ajouter une Matière</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Matières</th>
                    <th>Niveau Scolaire</th>
                    <th>Filière</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matieres as $matiere)
                <tr>
                    <td>{{ $matiere->label }}</td>
                    <td>{{ $matiere->niveauxscolaire->label }}</td>
                    <td>{{ $matiere->niveauxscolaire->filiere->nom_filiere }}</td>
                    <td>{{ $matiere->description }}</td>
                    <td>
                        <a href="{{ route('dash-matiere.edit', $matiere->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="{{ route('dash-matiere.show', $matiere->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <form action="{{ route('dash-matiere.destroy', $matiere->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
