
@extends('dashboard.master')

@section('content')
    <div class="container">
        <h1>Ajouter un Pavilion</h1>

        <form action="{{ route('dash-pavilion.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="label">Label du Pavilion</label>
                <input type="text" name="label" id="label" class="form-control" placeholder="Label du Pavilion" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Description du Pavilion"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
