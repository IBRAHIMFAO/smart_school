@extends('dashboard.master')

@section('content')
<div class="container">
    <h2 class="my-4">Modifier la Filière</h2>
    <form action="{{ route('dash-filiere.update', $filiere->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code_departement">Département</label>
            <select class="form-control @error('code_departement') is-invalid @enderror" id="code_departement" name="code_departement" required>
                <option value="">Sélectionner le Département</option>
                @foreach($departements as $departement)
                    <option value="{{ $departement->id }}" {{ old('code_departement', $filiere->code_departement) == $departement->id ? 'selected' : '' }}>
                        {{ $departement->label }}
                    </option>
                @endforeach
            </select>
            @error('code_departement')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nom_filiere">Nom de la Filière</label>
            <input type="text" class="form-control @error('nom_filiere') is-invalid @enderror" id="nom_filiere" name="nom_filiere" value="{{ old('nom_filiere', $filiere->nom_filiere) }}" required>
            @error('nom_filiere')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $filiere->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
