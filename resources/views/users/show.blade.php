@extends('dashboard.master', ['title' => 'User Details'])

@section('content')
    <div class="container">

        <h2 class="mt-3 mb-3">User Details</h2>
        
        <div class="card mb-3">
            <div class="card-header">
                <h4>{{ $user->fullname }}</h4>
                <p>{{ $user->email }}</p>
                <p>{{ $user->created_at->format('d F Y') }}</p>
                <p><a href="{{ route('users.index') }}">Back</a></p>
            </div>
        </div>
    </div>
@endsection