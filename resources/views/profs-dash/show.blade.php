{{-- @extends('dashboard.master')

@section('content')

<h3>Informations Personnelles de proffisseur : {{ $prof->user->fullname }}</h3>

<div class="container ">
    <div class="row">
        <div class="col-md-6">
            <ul>
                <li><strong>Nom :</strong> {{ $prof->first_name }} {{ $prof->last_name }}</li>
                <li><strong>Prénom :</strong> {{ $prof->first_name_ar }}</li>
                <li><strong>Nom de famille :</strong> {{ $prof->last_name_ar }}</li>
                <li><strong>Heures travaillées :</strong> {{ $prof->hours_worked }}</li>
                <li><strong>Date de naissance :</strong> {{ $prof->birthdate }}</li>
                <li><strong>Numéro de CIN :</strong> {{ $prof->cin }}</li>
                <li><strong>Numéro de DOTI :</strong> {{ $prof->Doti }}</li>
                <li><strong>Situation de famille :</strong> {{ $prof->family_status }}</li>
                <li><strong>Adresse :</strong> {{ $prof->address }}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul>
                <li><strong>Genre :</strong> {{ $prof->user->gender }}</li>
                <li><strong>Image :</strong> {{ $prof->user->img }}</li>
                <li><strong>Rôle :</strong> {{ $prof->user->role }}</li>
                <li><strong>Téléphone :</strong> {{ $prof->user->phone }}</li>
                <li><strong>Email :</strong> {{ $prof->user->email }}</li>
                <li><strong>Statut :</strong> {{ $prof->user->is_active ? 'Actif' : 'Inactif' }}</li>
                <li><strong>Département :</strong>
                    <ul>
                        @foreach ($prof->departements as $departement)
                        <li>{{ $departement->label }}</li>
                        @endforeach
                    </ul> </li>
            </ul>
        </div>
    </div>
</div>

<style>
    /* Ajoutez vos styles CSS personnalisés ici */
    .container {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    h1 {
        color: #007BFF;
    }

    /* Ajoutez d'autres styles au besoin */



</style>


@endsection --}}


@extends('dashboard.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Add an image here -->
            <img src="{{ asset('path/to/your/image.jpg') }}" alt="Profile Image" class="img-fluid">
        </div>
        <div class="col-md-9">
            <h3>Informations Personnelles de Professeur : {{ $prof->user->fullname }}</h3>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li><strong>Prénom :</strong>{{ $prof->first_name }} </li>
                        <li><strong>Nom :</strong> {{ $prof->last_name }}</li>
                        <li><strong>Prénom (arabe) :</strong> {{ $prof->first_name_ar }}</li>
                        <li><strong>Nom de famille (arabe):</strong> {{ $prof->last_name_ar }}</li>
                        <li><strong>Heures travaillées :</strong> {{ $prof->hours_worked }}</li>
                        <li><strong>Date de naissance :</strong> {{ $prof->birthdate }}</li>
                        <li><strong>Numéro de CIN :</strong> {{ $prof->cin }}</li>
                        <li><strong>Numéro de DOTI :</strong> {{ $prof->Doti }}</li>
                        <li><strong>Situation de famille :</strong> {{ $prof->family_status }}</li>
                        <li><strong>Adresse :</strong> {{ $prof->address }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li><strong>Genre :</strong> {{ $prof->user->gender }}</li>
                        <li><strong>Image :</strong> {{ $prof->user->img }}</li>
                        <li><strong>Rôle :</strong> {{ $prof->user->role }}</li>
                        <li><strong>Téléphone :</strong> {{ $prof->user->phone }}</li>
                        <li><strong>Email :</strong> {{ $prof->user->email }}</li>
                        <li><strong>Statut :</strong> {{ $prof->user->is_active ? 'Actif' : 'Inactif' }}</li>
                        <li><strong>Département(s) :</strong>
                            <ul>
                                @foreach ($prof->departements as $departement)
                                <li>{{ $departement->label }}</li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Add your custom CSS styles here */
    .container {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    h3 {
        color: #007BFF;
    }
</style>

@endsection


