@extends('dashboard.master')

@section('content')

    <!-- show.blade.php -->
    <h1 class="text" style="margin: 05%">{{ $group->nom_group }}</h1>
    <div class="container">
        <div class="table-responsive" style="width: 100%; height: 700px; overflow-y: auto;">
            <table class="table table-bordered table-striped table-hover" id="myTable">
                <thead>
                    <tr style="background-color: #007bff; color: #fff;">
                        <th scope="col" class="text-center">Prénom</th>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col" class="text-center">Nombre d'absences</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td class="text-center">{{ $student->firstName }}</td>
                            <td class="text-center">{{ $student->lastName }}</td>
                            <td class="text-center">{{ $student->attendance->where('status', 'absent')->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
