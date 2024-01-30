
@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Liste des Pavilions</h1>
    <a href="{{ route('dash-pavilion.create') }}" class="btn btn-primary mb-2">Ajouter un Pavilion</a>

    <table class="table">
        <thead>
            <tr>
                <th>Label</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pavilions as $pavilion)
                <tr>
                    <td>{{ $pavilion->label }}</td>
                    <td>{{ $pavilion->description ?: 'Aucune description disponible' }}</td>
                    <td>
                        <a href="{{ route('dash-pavilion.show', $pavilion->id) }}" class="btn btn-primary btn-sm">Voir</a>
                        <a href="{{ route('dash-pavilion.edit', $pavilion->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('dash-pavilion.destroy', $pavilion->id) }}" method="POST" style="display: inline">
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
@endsection
