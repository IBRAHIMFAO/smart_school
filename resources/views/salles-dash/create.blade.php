@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Ajouter une salle</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('dash-salle.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="label"> la salle</label>
            <input type="text" name="label" id="label" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status de la salle</label>
            <select name="status" id="status" class="form-control" required>
                <option value="salle">Salle</option>
                <option value="atelier">Atelier</option>
                <option value="salle informatique">Salle Informatique</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pavilion">Pavilion</label>
            <select name="pavilion" id="pavilion" class="form-control" required>
                @foreach ($pavilions as $pavilion)
                    <option value="{{ $pavilion->id }}">{{ $pavilion->label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Ajouter la salle</button>
        </div>
    </form>
</div>
@endsection
