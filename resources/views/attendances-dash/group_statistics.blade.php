{{-- @extends('dashboard.master')

@section('content')

<div class="container ">
    <h1>Groupe Statistics - {{ $group->nom_group }}</h1>

   

    <div class="cadre-table-scroll">
        <table class="table table-bordered table-scroll" >
            <thead>
                <tr>
                        <th colspan="3" class="text-center">inf Student</th>
                        <th colspan="10" class="text-center" >Nombre d'Absence sur séance pour chaque Mois</th>
                        <th rowspan="2" class="text-center">Action</th>
                </tr>    
                <tr>
                        <td>Student Name</td>
                        <td>Absence Count</td>
                        <td>Total Hours Absent</td>
        
                        <td>september</td>
                        <td>october</td>
                        <td>november</td>
                        <td>december</td>
                        <td>janvary</td>
                        <td>february</td>
                        <td>march</td>
                        <td>april</td>
                        <td>may</td>
                        <td>june</td>  
                </tr>
                
                
            </thead>
            <tbody>
                    
                        <!-- Your code for each student goes here -->
                        @foreach ($studentStatistics as $stats)
                        <tr>
                            <td>{{ $stats['student']->first_name}}</td> 
                            <td>{{ $stats['absenceCount'] }}</td>
                            
                            
                            @foreach ($stats['monthlyAbsenceCounts'] as $monthlyCount)
                                <td>{{ $monthlyCount }}</td>
                            @endforeach
                            
                            <td> 
                                <a href="#" class="btn btn-primary"> voir</a>
                            </td>
                        </tr>
                    @endforeach
            
            
            </tbody>
        </table>
    </div>
    <a href="#" class="btn btn-primary">Back to Attendance</a>

    </div>

    <style>
        

        /*-- pour scroll actif --*/
        .cadre-table-scroll {
        display: inline-block;
        height: 40em;
        overflow-y: scroll;
        width: 100%;
        overflow-x: scroll;

        }
        /*-- fin pour scroll actif --*/

        .table-scroll thead {
        position: sticky;
        top: 0;
        }
        .table-scroll tfoot td {
        position: sticky;
        bottom: 0;
        }
        
        .table thead th {
        border-top: 0;
        background-color: #f8f9fa;
        }
      
        .table thead tr th {
        border-bottom: 2px solid #dee2e6;
        background-color: rgb(0, 102, 255);
        color: white;

        }
        .table thead tr td {
        border-bottom: 2px solid #dee2e6;
        background-color: #3d7ec0;
        color: white;
        }

        .table thead tr, .table tbody tr{
            height: 10px;
            width: 10px;
        }


        

        
    </style>

@endsection --}}



@extends('dashboard.master')

@section('content')
{{-- 
<!-- Add a modal to display detailed information -->
<div class="modal fade" id="absenceDetailsModal" tabindex="-1" role="dialog" aria-labelledby="absenceDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="absenceDetailsModalLabel">Absence Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display detailed absence information here -->
                <div id="absenceDetailsContent"></div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container ">
    <h1>Statistiques du Groupe - {{ $group->nom_group }}</h1>

    <div class="cadre-table-scroll">
        <table class="table table-bordered table-scroll">
            <thead>
                <tr>
                    <th colspan="3" class="text-center">inf Student</th>
                    <th colspan="10" class="text-center">Nombre d'Absence sur séance pour chaque Mois</th>
                    <th rowspan="2" class="text-center">Action</th>
                </tr>
                <tr>
                    <td>Student Name</td>
                    <td>Absence Count</td>
                    <td>Total Hours Absent</td>

                    @foreach ($monthNames as $monthName)
                        <td>{{ $monthName }}</td>
                    @endforeach
                     
                    {{-- <td>acc</td>   --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($studentStatistics as $stats)
                    <tr>
                        <td>{{ $stats['student']->first_name }}</td>
                        <td>{{ $stats['absenceCount'] }}</td>
                        <td>{{ $stats['totalHoursAbsent'] }}</td>
                        {{-- <td> test heure </td> --}}

                       <!-- ... Existing data rows ... -->
                        <!-- Add data rows for each month -->
                        @foreach ($stats['monthlyAbsenceCounts'] as $monthlyCount)
                            <td>{{ $monthlyCount }}</td>
                        @endforeach
                         
                        <td>
                            <!-- Correct the route function call -->
                            <a href="{{ route('getAbsenceshow.student', ['studentId' => $stats['student']->id]) }}" class="btn btn-primary">voir</a>
                        </td>

                        <!-- ... Existing data rows ... -->
                     
                        {{-- <td>
                            <a href="#" class="btn btn-primary">voir</a>
                                <a href="{{ route('attendances.show', $stats['absenceCount'][0]->code_seance) }}" class="btn btn-primary">voir</a>                     
                            
                        </td> --}}

                          
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="#" class="btn btn-primary">Back to Attendance</a>
</div>

            <script>
                // JavaScript function to show absence details modal
                function showAbsenceDetails(studentId) {
                    // Fetch absence details for the selected student using AJAX
                    $.ajax({
                        url: '/getAbsenceDetails/' + studentId,
                        type: 'GET',
                        success: function (data) {
                            // Update the modal content with the fetched data
                            $('#absenceDetailsContent').html(data);
                            // Show the modal
                            $('#absenceDetailsModal').modal('show');
                        },
                        error: function (error) {
                            console.error('Error fetching absence details:', error);
                        }
                    });
                }
            </script>




<style>
    /*-- pour scroll actif --*/
    .cadre-table-scroll {
        display: inline-block;
        height: 40em;
        overflow-y: scroll;
        width: 100%;
        overflow-x: scroll;
    }

    /*-- fin pour scroll actif --*/

    .table-scroll thead {
        position: sticky;
        top: 0;
    }

    .table-scroll tfoot td {
        position: sticky;
        bottom: 0;
    }

    .table thead th {
        border-top: 0;
        background-color: #f8f9fa;
    }

    .table thead tr th {
        border-bottom: 2px solid #dee2e6;
        background-color: rgb(0, 102, 255);
        color: white;
    }

    .table thead tr td {
        border-bottom: 2px solid #dee2e6;
        background-color: #3d7ec0;
        color: white;
    }

    .table thead tr,
    .table tbody tr {
        height: 10px;
        width: 10px;
    }
</style>

@endsection



