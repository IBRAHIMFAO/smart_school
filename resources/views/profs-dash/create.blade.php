{{--
@extends('dashboard.master')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error') )
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<div class="container">
    <h1 class="my-4">Ajouter un Professeur</h1>

    <form method="POST" action="{{ route('dash-prof.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- User Information -->
        <div class="row">
            <div class="col-md-6">
                <h3>Informations de l'Utilisateur</h3>

                <div class="mb-3">
                    <label for="fullname" class="form-label">Nom complet</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Genre</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="male">Masculin</option>
                        <option value="female">Féminin</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <input type="file" class="form-control" id="img" name="img">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <input type="text" class="form-control" id="role" name="role" value="prof" readonly>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Statut</label>
                    <select class="form-select" id="is_active" name="is_active">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Informations du Professeur</h3>

                <div class="mb-3">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Nom de famille</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>

                <div class="mb-3">
                    <label for="first_name_ar" class="form-label">Prénom en arabe (optionnel)</label>
                    <input type="text" class="form-control" id="first_name_ar" name="first_name_ar">
                </div>

                <div class="mb-3">
                    <label for="last_name_ar" class="form-label">Nom de famille en arabe (optionnel)</label>
                    <input type="text" class="form-control" id="last_name_ar" name="last_name_ar">
                </div>

                <div class="mb-3">
                    <label for="hours_worked" class="form-label">Heures travaillées (par défaut à 0)</label>
                    <input type="number" class="form-control" id="hours_worked" name="hours_worked" value="0">
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">Date de naissance (optionnelle)</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                </div>

                <div class="mb-3">
                    <label for="cin" class="form-label">Numéro de CIN (Carte d'identité nationale) unique et optionnel</label>
                    <input type="text" class="form-control" id="cin" name="cin" unique>
                </div>

                <div class="mb-3">
                    <label for="Doti" class="form-label">Numéro de DOTI (Document d'ordre des instituteurs) unique et optionnel</label>
                    <input type="text" class="form-control" id="Doti" name="Doti" unique>
                </div>

                <div class="mb-3">
                    <label for="family_status" class="form-label">Situation de famille</label>
                    <select class="form-select" id="family_status" name="family_status">
                        <option value="">Sélectionnez une situation familiale</option>
                        <option value="Célibataire">Célibataire</option>
                        <option value="Marié(e)">Marié(e)</option>
                        <option value="Divorcé(e)">Divorcé(e)</option>
                        <option value="Veuf/Veuve">Veuf/Veuve</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse (optionnelle)</label>
                    <textarea class="form-control" id="address" name="address"></textarea>
                </div>


                    <div class="mb-3">
                        <label for="code_departements" class="form-label">Départements</label>
                        <select class="form-select" id="code_departements" name="code_departements[]" multiple required>
                            @foreach($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->label }}</option>
                            @endforeach
                        </select>
                    </div>


            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

@endsection --}}


@extends('dashboard.master')

@section('content')

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="my-4">Ajouter un Professeur</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dash-prof.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- User Information -->
                <div class="row">
                    <div class="col-md-6">
                        <h3>Informations de l'Utilisateur</h3>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nom complet</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required value="{{ old('fullname') }}">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Genre</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculin</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Féminin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input type="file" class="form-control" id="img" name="img">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <input type="text" class="form-control" id="role" name="role" value="prof" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Statut</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Actif</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Informations du Professeur</h3>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ old('first_name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Nom de famille</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ old('last_name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="first_name_ar" class="form-label">Prénom en arabe (optionnel)</label>
                            <input type="text" class="form-control" id="first_name_ar" name="first_name_ar" value="{{ old('first_name_ar') }}">
                        </div>

                        <div class="mb-3">
                            <label for="last_name_ar" class="form-label">Nom de famille en arabe (optionnel)</label>
                            <input type="text" class="form-control" id="last_name_ar" name="last_name_ar" value="{{ old('last_name_ar') }}">
                        </div>

                        <div class="mb-3">
                            <label for="hours_worked" class="form-label">Heures travaillées (par défaut à 0)</label>
                            <input type="number" class="form-control" id="hours_worked" name="hours_worked" value="{{ old('hours_worked', 0) }}">
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Date de naissance (optionnelle)</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                        </div>

                        <div class="mb-3">
                            <label for="cin" class="form-label">Numéro de CIN (Carte d'identité nationale) unique et optionnel</label>
                            <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin') }}">
                        </div>

                        <div class="mb-3">
                            <label for="Doti" class="form-label">Numéro de DOTI (Document d'ordre des instituteurs) unique et optionnel</label>
                            <input type="text" class="form-control" id="Doti" name="Doti" value="{{ old('Doti') }}">
                        </div>

                        <div class="mb-3">
                            <label for="family_status" class="form-label">Situation de famille</label>
                            <select class="form-select" id="family_status" name="family_status">
                                <option value="">Sélectionnez une situation familiale</option>
                                <option value="Célibataire" {{ old('family_status') == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                                <option value="Marié(e)" {{ old('family_status') == 'Marié(e)' ? 'selected' : '' }}>Marié(e)</option>
                                <option value="Divorcé(e)" {{ old('family_status') == 'Divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
                                <option value="Veuf/Veuve" {{ old('family_status') == 'Veuf/Veuve' ? 'selected' : '' }}>Veuf/Veuve</option>
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse (optionnelle)</label>
                            <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="code_departements" class="form-label">Départements</label>
                            <select class="form-select" id="code_departements" name="code_departements[]" multiple required>
                                @foreach($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</div>

@endsection
