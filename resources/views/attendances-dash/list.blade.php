{{-- 

@extends('dashboard.master')

@section('content')

    <div class="container mt-4">
        <h2>Liste de présence pour le {{ $seance->date }} - {{ $seance->heure_debut }}->{{ $seance->heure_fin }} </h2>
        <h3>Groupe : {{ $seance->group->nom_group }}</h3>
       
        <h4>Liste de présence pour le {{ $seance->date }}  / {{ \Carbon\Carbon::parse($seance->heure_debut)->format('H:i') }} h->{{ \Carbon\Carbon::parse($seance->heure_fin)->format('H:i') }} h</h4>
        <p>Groupe : {{ $seance->group->nom_group }}</p>
        <p>Matière : {{ $seance->matiere->label }}</p>


        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nom de l'étudiant</th>
                        <th>Statut de présence</th>
                        <th>Motif d'absence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceRecords as $record)
                    <tr>
                        <td>{{ $record->student->first_name }} {{ $record->student->last_name }}</td>
                        <td>{{ $record->status }}</td>
                        <td>{{ $record->motif_absence ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>






        <style>
            /* General styling */
            .container {
                font-family: sans-serif;
                color: black;
            }

            /* Table styling */
            .table {
                width: 100%;
                font-family: sans-serif;
                color: black;
            }

            th, td {
                vertical-align: middle;
                padding: 0.75rem;
            }

            th {
                background-color: #f0f0f0;
                text-align: center;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('.table').DataTable({
                    "order": [], // Initialise le tri sans ordre par défaut
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr.json" // Pour la traduction française
                    }
                });
            });
            $('.table tbody tr').hover(function() {
                $(this).addClass('table-row-hover');
            }, function() {
                $(this).removeClass('table-row-hover');
            });

            $(document).ready(function() {
                $('.table').on('click', '.btn-export', function() {
                    // Obtenez les données de la table
                    var data = $('.table').DataTable().rows().data();

                    // Créez un objet JSON contenant les données
                    var jsonData = {
                        data: data
                    };

                    // Exportez les données au format CSV
                    if ($(this).hasClass('btn-export-csv')) {
                        var csv = $.toCSV(jsonData);
                        var filename = 'liste-de-presence.csv';
                        download(csv, filename);
                    }

                    // Exportez les données au format Excel
                    else if ($(this).hasClass('btn-export-excel')) {
                        var xlsx = XLSX.write(jsonData, {
                            sheetName: 'Liste de présence'
                        });
                        var filename = 'liste-de-presence.xlsx';
                        download(xlsx, filename);
                    }
                });
            });
        </script>



@endsection --}}


@extends('dashboard.master')

@section('content')
    <div class="card-header">
         <h4>Liste de présence pour le {{ $seance->date }}  / {{ \Carbon\Carbon::parse($seance->heure_debut)->format('H:i') }} h->{{ \Carbon\Carbon::parse($seance->heure_fin)->format('H:i') }} h</h4>
        <p>Groupe : {{ $seance->group->nom_group }}</p>
        <p>Matière : {{ $seance->matiere->label }}</p>    
    </div>    

    <div class="container mt-4">
       

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-black">Nom de l'étudiant</th>
                        <th class="text-black">Statut de présence</th>
                        <th class="text-black">Motif d'absence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceRecords as $record)
                    <tr>
                        <td class="text-black">{{ $record->student->first_name }} {{ $record->student->last_name }}</td>
                        <td class="text-black">{{ $record->status }}</td>
                        <td class="text-black">{{ $record->motif_absence ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Add Download Buttons -->
        <div class="mt-3">
            <button class="btn btn-primary btn-export btn-export-csv">Export CSV</button>
            <button class="btn btn-success btn-export btn-export-excel">Export Excel</button>
        </div>


    </div>

    
<style>
    /* General styling */
    .container {
        font-family: sans-serif;
        color: black;
    }

    /* Table styling */
    .table {
        width: 100%;
        font-family: sans-serif;
        color: black;
    }

    th, td {
        vertical-align: middle;
        padding: 0.75rem;
    }

    th {
        background-color: #f0f0f0;
        text-align: center;
    }
</style>

@endsection



<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<!-- Include DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "order": [], // Initialise le tri sans ordre par défaut
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr.json" // Pour la traduction française
            }
        });
    });

    $('.table tbody tr').hover(function() {
        $(this).addClass('table-row-hover');
    }, function() {
        $(this).removeClass('table-row-hover');
    });
    
    $(document).ready(function() {
        $('.table').on('click', '.btn-export', function() {
            // Obtenez les données de la table
            var data = $('.table').DataTable().rows().data();

            // Créez un objet JSON contenant les données
            var jsonData = {
                data: data
            };

            // Exportez les données au format CSV
            if ($(this).hasClass('btn-export-csv')) {
                var csv = $.toCSV(jsonData);
                var filename = 'liste-de-presence.csv';
                download(csv, filename);
            }

            // Exportez les données au format Excel
            else if ($(this).hasClass('btn-export-excel')) {
                var xlsx = XLSX.write(jsonData, {
                    sheetName: 'Liste de présence'
                });
                var filename = 'liste-de-presence.xlsx';
                download(xlsx, filename);
            }
        });
    });
</script>