@extends('dashboard.master')

@section('content')

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <h1 class="my-4">Modifier le Professeur</h1>

    <form method="POST" action="{{ route('dash-prof.update', $professor->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->

        <!-- User Information -->
        <div class="row">
            <div class="col-md-6">
                <h3>Informations de l'Utilisateur</h3>

                <div class="mb-3">
                    <label for="fullname" class="form-label">Nom complet</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname', $professor->user->fullname) }}" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Genre</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="male" {{ old('gender', $professor->user->gender) == 'male' ? 'selected' : '' }}>Masculin</option>
                        <option value="female" {{ old('gender', $professor->user->gender) == 'female' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>

                {{-- <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <input type="file" class="form-control" id="img" name="img" value="{{ old('img') }}" >
                </div> --}}

                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    @if ($professor->user->img)
                        <p>Image actuelle:</p>
                        <img src="{{ asset('storage/' . $professor->user->img) }}" alt="Current Image" style="width: 200px" >
                    @endif
                    <input type="file" class="form-control" id="img" name="img">
                    @if ($professor->user->img)
                        <input type="hidden" name="current_img" value="{{ $professor->user->img }}">
                    @endif
                </div>


                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <input type="text" class="form-control" id="role" name="role" value="prof" readonly>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $professor->user->phone) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $professor->user->email) }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe (Laissez vide pour ne pas changer)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Statut</label>
                    <select class="form-select" id="is_active" name="is_active">
                        <option value="1" {{ old('is_active', $professor->user->is_active) == '1' ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ old('is_active', $professor->user->is_active) == '0' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Informations du Professeur</h3>

                <div class="mb-3">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $professor->first_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Nom de famille</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $professor->last_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="first_name_ar" class="form-label">Prénom en arabe (optionnel)</label>
                    <input type="text" class="form-control" id="first_name_ar" name="first_name_ar" value="{{ old('first_name_ar', $professor->first_name_ar) }}">
                </div>

                <div class="mb-3">
                    <label for="last_name_ar" class="form-label">Nom de famille en arabe (optionnel)</label>
                    <input type="text" class="form-control" id="last_name_ar" name="last_name_ar" value="{{ old('last_name_ar', $professor->last_name_ar) }}">
                </div>

                <div class="mb-3">
                    <label for="hours_worked" class="form-label">Heures travaillées (par défaut à 0)</label>
                    <input type="number" class="form-control" id="hours_worked" name="hours_worked" value="{{ old('hours_worked', $professor->hours_worked) }}">
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">Date de naissance (optionnelle)</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate', $professor->birthdate) }}">
                </div>

                <div class="mb-3">
                    <label for="cin" class="form-label">Numéro de CIN (Carte d'identité nationale) unique et optionnel</label>
                    <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin', $professor->cin) }}">
                </div>

                <div class="mb-3">
                    <label for="Doti" class="form-label">Numéro de DOTI (Document d'ordre des instituteurs) unique et optionnel</label>
                    <input type="text" class="form-control" id="Doti" name="Doti" value="{{ old('Doti', $professor->Doti) }}">
                </div>

                <div class="mb-3">
                    <label for="family_status" class="form-label">Situation de famille</label>
                    <select class="form-select" id="family_status" name="family_status">
                        <option value="">Sélectionnez une situation familiale</option>
                        <option value="Célibataire" {{ old('family_status', $professor->family_status) == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                        <option value="Marié(e)" {{ old('family_status', $professor->family_status) == 'Marié(e)' ? 'selected' : '' }}>Marié(e)</option>
                        <option value="Divorcé(e)" {{ old('family_status', $professor->family_status) == 'Divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
                        <option value="Veuf/Veuve" {{ old('family_status', $professor->family_status) == 'Veuf/Veuve' ? 'selected' : '' }}>Veuf/Veuve</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse (optionnelle)</label>
                    <textarea class="form-control" id="address" name="address">{{ old('address', $professor->address) }}</textarea>
                </div>

                {{-- <div class="mb-3">
                    <label for="code_departements" class="form-label">Départements</label>
                    <select class="form-select" id="code_departements" name="code_departements[]" multiple required>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}" {{ in_array($departement->id, old('code_departements', $professor->departments->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $departement->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
             <!-- Departments -->
        {{-- <div class="mb-3">
            <label for="code_departements" class="form-label">Départements</label>
            <select class="form-select" id="code_departements" name="code_departements[]" multiple required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ in_array($department->id, old('code_departements', $professor->departments->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $department->label }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="mb-3">
            <label for="code_departements" class="form-label">Départements</label>
            <select class="form-select" id="code_departements" name="code_departements[]" multiple required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ in_array($department->id, $selectedDepartments) ? 'selected' : '' }}>
                        {{ $department->label }}
                    </option>
                @endforeach
            </select>
        </div>





        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

@endsection
