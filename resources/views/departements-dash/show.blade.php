@extends('dashboard.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ __('Department Details') }}
            <a href="{{ route('dash-departement.index') }}" class="btn btn-secondary float-right">{{ __('Back') }}</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Department Information</h5>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td>{{ $departement->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Ecole</th>
                        <td>{{ $departement->ecole->nom_ecole }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Departement</th>
                        <td>{{ $departement->label }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td>{{ $departement->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
