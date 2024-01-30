@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Modifier une salle</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('dash-salle.update', $salle->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Use the PUT method for updates -->
        <div class="form-group">
            <label for="label">Label de la salle</label>
            <input type="text" name="label" id="label" class="form-control" value="{{ $salle->label }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status de la salle</label>
            <select name="status" id="status" class="form-control" required>
                <option value="salle" {{ $salle->status === 'salle' ? 'selected' : '' }}>Salle</option>
                <option value="atelier" {{ $salle->status === 'atelier' ? 'selected' : '' }}>Atelier</option>
                <option value="salle informatique" {{ $salle->status === 'salle informatique' ? 'selected' : '' }}>Salle Informatique</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pavilion">Pavilion</label>
            <select name="pavilion" id="pavilion" class="form-control" required>
                @foreach ($pavilions as $pavilion)
                    <option value="{{ $pavilion->id }}" {{ $salle->pavilion->id === $pavilion->id ? 'selected' : '' }}>{{ $pavilion->label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $salle->description }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Mettre à jour la salle</button>
        </div>
    </form>
</div>
@endsection
