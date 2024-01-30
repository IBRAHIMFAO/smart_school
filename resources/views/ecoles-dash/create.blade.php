@extends('dashboard.master');


@section('content')
<div class="container">
    <h2>Create New Ecole</h2>
    <form method="POST" action="{{ route('dash-ecole.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nom_ecole" class="form-label">Nom Ecole</label>
            <input type="text" class="form-control @error('nom_ecole') is-invalid @enderror" id="nom_ecole" name="nom_ecole" value="{{ old('nom_ecole') }}" required>
            @error('nom_ecole')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
            @error('adresse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lien_facebook" class="form-label">Lien Facebook</label>
            <input type="text" class="form-control @error('lien_facebook') is-invalid @enderror" id="lien_facebook" name="lien_facebook" value="{{ old('lien_facebook') }}">
            @error('lien_facebook')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lien_instagram" class="form-label">Lien Instagram</label>
            <input type="text" class="form-control @error('lien_instagram') is-invalid @enderror" id="lien_instagram" name="lien_instagram" value="{{ old('lien_instagram') }}">
            @error('lien_instagram')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
{{-- ############################################################################################## --}}
        {{-- <div class="mb-3">
            <label for="map_iframe" class="form-label">Map Iframe</label>
            <textarea class="form-control @error('map_iframe') is-invalid @enderror" id="map_iframe" name="map_iframe">{{ old('map_iframe') }}</textarea>
            @error('map_iframe')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}
        {{-- <div class="mapouter">
            <div class="gmap_canvas">
                <iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=OULED TEIMA&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                <a href="https://gachanymph.com/">Gacha Nymph</a>
            </div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style>
        </div> --}}

        <div class="mb-3">
            <label for="map_iframe" class="form-label">Map Iframe</label>
            <textarea class="form-control @error('map_iframe') is-invalid @enderror" id="map_iframe" name="map_iframe" rows="3">{{ old('map_iframe') }}</textarea>
            <small class="form-text text-muted">Embed the map iframe code here.</small>
            @error('map_iframe')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>





{{-- ##################################################################################################### --}}

        <div class="mb-3">
            <label for="code_directeur" class="form-label">Directeur</label>
            <select class="form-select @error('code_directeur') is-invalid @enderror" id="code_directeur" name="code_directeur" required>
                <option value="" disabled selected>Select Directeur</option>
                @foreach ($directeurs as $directeur)
                    <option value="{{ $directeur->id }}" {{ old('code_directeur') == $directeur->id ? 'selected' : '' }}>
                        {{ $directeur->first_name }} {{ $directeur->last_name }}
                    </option>
                @endforeach
            </select>
            @error('code_directeur')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

