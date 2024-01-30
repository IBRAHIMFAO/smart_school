@extends('dashboard.master')

@section('content')
<div class="container" style="margin-top: 10%">
    <div class="custom-card">
        <h1 class="mb-4 text-center">{{ __('Détails du Groupe') }}</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title ">*********{{ __('Informations sur le Groupe') }} :</h5>
                <table class="table">
                    <tbody>
                        
                        <tr>
                            <th scope="row ">{{ __('Département') }}   :</th>
                            <td class="text-primary font-weight-bold">{{ $group->niveauxscolaire->filiere->departement->label }} </td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Filière') }}         :</th>
                            <td class="text-primary font-weight-bold">{{ $group->niveauxscolaire->filiere->nom_filiere }} </td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Niveau Scolaire') }} :</th>
                            <td class="text-primary font-weight-bold">{{ $group->niveauxscolaire->label }} </td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Nom du Groupe') }}   : </th>
                            <td class="text-primary font-weight-bold">{{ $group->nom_group }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('dash-groupe.index') }}" class="btn btn-primary mt-3">{{ __('Retour') }}</a>
    </div>
</div>
@endsection
