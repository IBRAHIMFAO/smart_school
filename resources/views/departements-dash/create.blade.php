@extends('dashboard.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Departement') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dash-departement.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="code_ecole">{{ __('Ecole') }}</label>
                            <select class="form-control @error('code_ecole') is-invalid @enderror" id="code_ecole" name="code_ecole" required>
                                <option value="">Select Ecole</option>
                                @foreach($ecoles as $ecole)
                                    <option value="{{ $ecole->id }}" {{ old('code_ecole') == $ecole->id ? 'selected' : '' }}>
                                        {{ $ecole->nom_ecole }}
                                    </option>
                                @endforeach
                            </select>
                            @error('code_ecole')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="label">{{ __('Label') }}</label>
                            <input id="label" type="text" class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label') }}" required>
                            @error('label')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
