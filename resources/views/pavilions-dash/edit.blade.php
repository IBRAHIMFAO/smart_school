
@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Modifier un Pavilion</h1>
    <form action="{{ route('dash-pavilion.update', $pavilion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="label">Label du Pavilion:</label>
            <input type="text" class="form-control" id="label" name="label" value="{{ $pavilion->label }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $pavilion->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('dash-pavilion.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
