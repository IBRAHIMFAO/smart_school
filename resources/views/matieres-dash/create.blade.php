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

    <h1>Ajouter une Matière</h1>

    <form action="{{ route('dash-matiere.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="label">Label de la Matière</label>
            <input type="text" name="label" class="form-control" value="{{ old('label') }}">
        </div>

        <div class="form-group">
            <label for="niveauxscolaire">Niveau Scolaire</label>
            <select name="niveauxscolaire" class="form-control">
                @foreach ($niveauxscolaires as $niveauxscolaire)
                    <option value="{{ $niveauxscolaire->id }}">{{ $niveauxscolaire->label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description (optionnelle)</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection

