@extends('dashboard.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ecole Details') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nom Ecole</th>
                                <td>{{ $ecole->nom_ecole }}</td>
                            </tr>
                            <tr>
                                <th>Adresse</th>
                                <td>{{ $ecole->adresse }}</td>
                            </tr>
                            <tr>
                                <th>Directeur</th>
                                <td>
                                    @if ($ecole->directeur)
                                        {{ $ecole->directeur->first_name }} {{ $ecole->directeur->last_name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $ecole->phone }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $ecole->email }}</td>
                            </tr>
                            <tr>
                                <th>Lien Facebook</th>
                                <td>{{ $ecole->lien_facebook }}</td>
                            </tr>
                            <tr>
                                <th>Lien Instagram</th>
                                <td>{{ $ecole->lien_instagram }}</td>
                            </tr>
                            <tr>
                                <th>Map Iframe</th>
                                <td>{{ $ecole->map_iframe }}</td>
                            </tr>
                            <tr>
                                <th>Logo</th>
                                <td>
                                    @if ($ecole->logo)
                                        <img src="{{ asset('storage/' . $ecole->logo) }}" alt="Ecole Logo" class="img-thumbnail" style="max-width: 150px;">
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('dash-ecole.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
