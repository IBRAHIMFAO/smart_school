@extends('dashboard.master')

@section('content')
<div >
    <div class="mb-3">
        <a href="{{ route('dash-ecole.create') }}" class="btn btn-primary">Create New Ecole</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Nom Ecole</th>
                    <th>Adresse</th>
                    <th>Directeur</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Lien Facebook</th>
                    <th>Lien Instagram</th>
                    <th>Map Iframe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ecoles as $ecole)
                <tr>
                    <td>{{ $ecole->nom_ecole }}</td>
                    <td>{{ $ecole->adresse }}</td>
                    <td>
                        @if ($ecole->directeur)
                            {{ $ecole->directeur->first_name }} {{ $ecole->directeur->last_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $ecole->phone }}</td>
                    <td>{{ $ecole->email }}</td>
                    <td>
                        <a href="{{ $ecole->lien_facebook }}" target="_blank">Facebook Link</a>
                    </td>
                    <td>
                        <a href="{{ $ecole->lien_instagram }}" target="_blank">Instagram Link</a>
                    </td>
                    <td>{{ $ecole->map_iframe }}</td>
                    <td>
                        <a href="{{ route('dash-ecole.show', $ecole->id) }}" class="btn btn-success">Show</a>
                        <a href="{{ route('dash-ecole.edit', $ecole->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('dash-ecole.destroy', $ecole->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
