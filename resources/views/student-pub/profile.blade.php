
@extends("dashboard.public.master");

@section("content")

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Profile</h1>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Personal Information</h3>
                        <hr>
                        <div class="row">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="text-center mb-3">
                        @if (Auth::user()->img)
                            <img src="{{ asset('storage/' . Auth::user()->img) }}" alt="Profile Image" class="img-thumbnail rounded-circle" width="100">
                        @else
                            <p>{{ __('No profile image uploaded.') }}</p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">{{ __('Full Name') }}</label>
                            <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="fullname" value="{{ old('full_name', Auth::user()->fullname) }}" required autofocus>
                            @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="first_name">{{ __('First Name') }}</label>
                            @if (Auth::user()->role === 'superadmin')
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', Auth::user()->superadmin->first_name ?? '') }}" required>
                            @elseif (Auth::user()->role === 'directeur')
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', Auth::user()->directeur->first_name ?? '') }}" required>
                            {{-- Add similar conditions for other user types --}}
                            @elseif (Auth::user()->role === 'student')
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', Auth::user()->student->first_name ?? '') }}" required>
                            @elseif (Auth::user()->role === 'surveillant')
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', Auth::user()->surveillant->first_name ?? '') }}" required>
                            @elseif (Auth::user()->role === 'tuteur')
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', Auth::user()->tuteur->first_name ?? '') }}" required>

                            @elseif (Auth::user()->role === 'caissier')
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', Auth::user()->caissier->first_name ?? '') }}" required>
                            @endif
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            @if (Auth::user()->role === 'superadmin')
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', Auth::user()->superadmin->last_name ?? '') }}" required>
                            @elseif (Auth::user()->role === 'directeur')
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', Auth::user()->directeur->last_name ?? '') }}" required>
                            {{-- Add similar conditions for other user types --}}
                            @elseif (Auth::user()->role === 'student')
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', Auth::user()->student->last_name ?? '') }}" required>
                            @elseif (Auth::user()->role === 'surveillant')
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', Auth::user()->surveillant->last_name ?? '') }}" required>
                            @elseif (Auth::user()->role === 'tuteur')
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', Auth::user()->tuteur->last_name ?? '') }}" required>

                            @elseif (Auth::user()->role === 'caissier')
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', Auth::user()->caissier->last_name ?? '') }}" required>
                            @endif
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



    {{-- ################################################################################################################################################ --}}
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('New Password') }}</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        </div>

                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img">{{ __('Profile Image') }}</label>
                            <input id="img" type="file" class="form-control @error('img') is-invalid @enderror" name="img">
                            @error('img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    });
</script>

@endsection

