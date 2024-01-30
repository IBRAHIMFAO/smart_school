{{-- @extends('dashboard.master')

@section('content')

<div class="container">
    <h2 class="mt-3">Attendance Dashboard (Seance) </h2>

    <table class="table">
        <thead>
            <tr>
                //<th><a href="{{ route('dashboard.attendance.index', ['sort' => 'date', 'order' => 'asc']) }}">Seance Date</a></th>
                <th>Seance Date</th>
                <th>heure de seance</th>
                <th>Group</th>
                <th>matiere</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seances as $seance)
                <tr>
                    <td>{{ $seance->date }} </td>
                    <td>{{ $seance->heure_debut->format('H:i:s') }}->{{ $seance->heure_fin->format('H:i:s') }}</td>
                    <td>{{ $seance->group->nom_group }}</td>
                    <td>{{ $seance->matiere->label }}</td>
                    <td>
                        <a href="{{ route('dashboard.attendance.record.form', $seance->id) }}" class="btn btn-primary">Record Attendance</a>

                        <a href="{{ route('dashboard.attendance.list', $seance->id) }}" class="btn btn-{{ $seance->isAttendanceRecorded() ? 'warning' : 'success' }}">View Attendance List</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $seances->links() }}
</div>

 <style>
        .w-5{
            display: none;
        }
        . page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #1e7e34;
            border-color: #1e7e34;
        }

        .page-link {
            color: #1e7e34;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .page-link:hover {
            color: #fff;
            background-color: #1e7e34;
            border-color: #1e7e34;
        }

</style>


@endsection --}}

@extends('dashboard.master')

@section('content')

<div class="container">
    <h2 class="mt-3">Tableau de bord des présences (Séance)</h2>

    <table class="table" id="attendanceTable">
        <thead>
            <tr>
                <th>@lang('Date de la séance')</th>
                <th>@lang('Heure de la séance')</th>
                <th>@lang('Groupe')</th>
                <th>@lang('Matière')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seances as $seance)
                <tr>
                    <td>{{ $seance->date }}</td>
                    <td>{{ $seance->heure_debut->format('H:i:s') }} - {{ $seance->heure_fin->format('H:i:s') }}</td>
                    <td>{{ $seance->group->nom_group }}</td>
                    <td>{{ $seance->matiere->label }}</td>
                    <td>
                        <a href="{{ route('dashboard.attendance.record.form', $seance->id) }}" class="btn btn-primary">@lang('Enregistrer la présence')</a>

                        <a href="{{ route('dashboard.attendance.list', $seance->id) }}" class="btn btn-{{ $seance->isAttendanceRecorded() ? 'warning' : 'success' }}">@lang('Voir la liste de présence')</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $seances->links() }}
</div>

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#attendanceTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json" // French language file
                }
            });
        });
    </script>
@endsection

<style>
    /* Add your custom styles here */
    .table th, .table td {
        text-align: center;
    }
</style>

@endsection
