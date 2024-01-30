@extends('dashboard.master')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('dash-filiere.index') }}" class="btn btn-primary">Retour à la liste des filières</a>
    </div>

    <div class="card">
        <div class="card-header">
            Créer Nouvelle Filière
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('dash-filiere.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="code_departement">Département</label>
                    <select class="form-control @error('code_departement') is-invalid @enderror" id="code_departement" name="code_departement" required>
                        <option value="">Sélectionnez le département</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}" {{ old('code_departement') == $departement->id ? 'selected' : '' }}>
                                {{ $departement->label }}
                            </option>
                        @endforeach
                    </select>
                    @error('code_departement')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nom_filiere">Nom de la Filière</label>
                    <input type="text" class="form-control @error('nom_filiere') is-invalid @enderror" id="nom_filiere" name="nom_filiere" value="{{ old('nom_filiere') }}" required>
                    @error('nom_filiere')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description (optionnel)</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Créer Filière</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
