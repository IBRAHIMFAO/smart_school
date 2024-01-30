@extends('dashboard.pdf')

@section('content')
<style>
    /* Add your custom CSS styles here */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f5f5f5;
    }

    /* Add more styles as needed */
</style>

<h1>Liste des Professeurs</h1>

<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($profs as $prof)
            <tr>
                <td>{{ $prof->firstName }}</td>
                <td>{{ $prof->lastName }}</td>
                <td>{{ $prof->email_prof }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
