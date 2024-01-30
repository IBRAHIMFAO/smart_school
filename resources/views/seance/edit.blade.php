@extends('layouts')

@section("content")
        {{-- <!-- resources/views/seance/edit.blade.php -->

        <!-- Add your HTML structure and styling as needed -->
        <h1>Edit Seance</h1>

        <!-- Edit the form to update the seance -->
        <form method="POST" action="{{ route('seance.update', $seance->id) }}">
            @csrf
            @method('PUT')
            <!-- Populate input fields with existing seance attributes -->
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ $seance->date }}" required>

            <!-- Add other input fields for seance attributes -->

            <button type="submit">Update Seance</button>
        </form> --}}

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-center">Edit Seance</h1>

    <form method="POST" action="{{ route('crud.update', $seance->id) }}" class="needs-validation">
        @csrf
        @method('PUT')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="group">Group:</label>
                        <select class="form-control" id="group" name="group" required>
                            <option value="">Select Group</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">
                                    {{ $group->nom_group }}->{{ $group->niveauxscolaire->niveauxscolaire }}->{{ $group->filiere->nom_filiere }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rest of the form fields -->

                    <button type="submit" class="btn btn-primary">Update Seance</button>
                </div>
            </div>
        </div>
    </form>

@endsection
