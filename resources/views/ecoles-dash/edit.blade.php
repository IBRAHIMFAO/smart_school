@extends('dashboard.master')

@section('content')
<div class="container">
    <h2>Edit Ecole</h2>
    <form action="{{ route('dash-ecole.update', $ecole->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo">
            @error('logo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> --}}
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo">
            @error('logo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if ($ecole->logo)
                <img src="{{ asset('storage/' . $ecole->logo) }}" alt="Ecole Logo" class="img-thumbnail mt-2" style="max-width: 150px;">
            @endif
        </div>



        <div class="form-group">
            <label for="nom_ecole">Nom Ecole</label>
            <input type="text" class="form-control @error('nom_ecole') is-invalid @enderror" id="nom_ecole" name="nom_ecole" value="{{ old('nom_ecole', $ecole->nom_ecole) }}" required>
            @error('nom_ecole')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse', $ecole->adresse) }}" required>
            @error('adresse')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Add similar fields for other attributes -->

        <div class="form-group">
            <label for="code_directeur">Directeur</label>
            <select class="form-control @error('code_directeur') is-invalid @enderror" id="code_directeur" name="code_directeur" required>
                <option value="">Select Directeur</option>
                @foreach($directeurs as $directeur)
                    <option value="{{ $directeur->id }}" {{ old('code_directeur', $ecole->code_directeur) == $directeur->id ? 'selected' : '' }}>
                        {{ $directeur->first_name }} {{ $directeur->last_name }}
                    </option>
                @endforeach
            </select>
            @error('code_directeur')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $ecole->phone) }}">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $ecole->email) }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="lien_facebook">Lien Facebook</label>
            <input type="text" class="form-control @error('lien_facebook') is-invalid @enderror" id="lien_facebook" name="lien_facebook" value="{{ old('lien_facebook', $ecole->lien_facebook) }}">
            @error('lien_facebook')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="lien_instagram">Lien Instagram</label>
            <input type="text" class="form-control @error('lien_instagram') is-invalid @enderror" id="lien_instagram" name="lien_instagram" value="{{ old('lien_instagram', $ecole->lien_instagram) }}">
            @error('lien_instagram')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="map_iframe">Map Iframe</label>
            <textarea class="form-control @error('map_iframe') is-invalid @enderror" id="map_iframe" name="map_iframe">{{ old('map_iframe', $ecole->map_iframe) }}</textarea>
            @error('map_iframe')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
