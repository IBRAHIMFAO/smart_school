{{-- @extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Modifier une Matière</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('dash-matiere.update', $matiere->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="label">Label de la Matière</label>
            <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $matiere->label) }}" required>
        </div>

        <div class="form-group">
            <label for="filiere">Filière</label>
            <select class="form-control" id="filiere" name="filiere">
                @foreach ($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ $filiere->id == $matiere->filiere_id ? 'selected' : '' }}>
                        {{ $filiere->nom_filiere }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description de la Matière</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $matiere->description) }}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</div>
@endsection --}}

@extends('dashboard.master')

@section('content')
<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>Modifier la Matière</h1>

    <form action="{{ route('dash-matiere.update', $matiere->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="label">Matière</label>
            <input type="text" name="label" class="form-control" value="{{ old('label', $matiere->label) }}">
        </div>

        <div class="form-group">
            <label for="niveauxscolaire">Niveau Scolaire</label>
            <select name="niveauxscolaire" class="form-control">
                @foreach ($niveauxscolaires as $niveauxcolaire)
                    <option value="{{ $niveauxcolaire->id }}" @if ($matiere->code_niveauxscolaire == $niveauxcolaire->id) selected @endif>{{ $niveauxcolaire->label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $matiere->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection

