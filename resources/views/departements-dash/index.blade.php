@extends('dashboard.master');



@section('content')
@if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="mb-3">
        <a href="{{ route('dash-departement.create') }}" class="btn btn-primary">Create New Departement</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Code Ecole</th>
                <th>Label</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departements as $departement)
            <tr>
                <td>{{ $departement->ecole->nom_ecole }}</td>
                <td>{{ $departement->label }}</td>
                <td>{{ $departement->description }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('dash-departement.show', $departement->id) }}" class="btn btn-success mr-2">Show</a>
                        <a href="{{ route('dash-departement.edit', $departement->id) }}" class="btn btn-primary mr-2">Edit</a>
                        <form action="{{ route('dash-departement.destroy', $departement->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn mr-1">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/scripts.js') }}"></script>
@endsection








    <script>
        // scripts.js
        $(document).ready(function () {
            $('.delete-btn').on('click', function () {
                return confirm('Are you sure you want to delete this departement?');
            });
        });

       
    document.addEventListener('DOMContentLoaded', function () {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 5000); // Hide the message after 5 seconds (adjust as needed)
        }
    });



    </script>

        <style>
            /* styles.css */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .btn-group {
            margin-right: 10px;
        }

        .btn {
            padding: 5px 10px;
        }

        </style>
