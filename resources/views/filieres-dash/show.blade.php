@extends('dashboard.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ __('Détails de la Filiere') }}
            <a href="{{ route('dash-filiere.index') }}" class="btn btn-secondary float-right">{{ __('Retour') }}</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Informations sur la Filiere</h5>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td>{{ $filiere->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Departement</th>
                        <td>{{ $filiere->departement->label }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nom Filiere</th>
                        <td>{{ $filiere->nom_filiere }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td>{{ $filiere->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
