@extends('dashboard.master')

@section('content')

    <h1 class="text-info mb-4" style="margin: 2%">Tableau de présence </h1>

    <!-- Import Excel -->
    <div class="container card mb-4">
        <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row justify-content-center" style="margin-top: 3%">
                <div class="col-auto">
                    <label class="sr-only" for="import_file">Choose file</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="import_file" name="import_file"
                            accept=".xlsx, .xls">
                        <label class="custom-file-label" for="import_file">Choose file</label>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container-fluid">
        <div class="card shadow">
            <div class="form-row card-header py-3">
                <p class="text-primary m-1 fw-bold" style="font-size: 20px">Information de présence </p>
                <a href="{{ route('export-excel') }}" class="btn btn-success">Export to Excel</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                            <label class="form-label">Show&nbsp;<select
                                    class="d-inline-block form-select form-select-sm">
                                    <option value="10" selected="">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>&nbsp;</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label
                                class="form-label"><input type="search" class="form-control form-control-sm"
                                    aria-controls="dataTable" placeholder="Search"></label></div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                    aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead class="thead-light text-uppercase" >
                            <tr class="text-center"  >
                                <th class="font-weight-bold">Image</th>
                                <th class="font-weight-bold">Nom et Prénom</th>
                                <th class="font-weight-bold">Date</th>
                                <th class="font-weight-bold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $imgs = [
                                    "https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500",
                                    "https://images.pexels.com/photos/3779448/pexels-photo-3779448.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500",
                                    "https://images.pexels.com/photos/3765114/pexels-photo-3765114.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940",
                                    "https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                ];
                                $icons = [
                                    'absent' => 'fas fa-times-circle text-danger fa-lg',
                                    'present' => 'fas fa-check-circle text-success fa-lg',
                                    'tardy' => 'fas fa-clock text-warning fa-lg'
                                ];
                            @endphp

                            @foreach ($attendance as $index => $record)
                                @php
                                    $imgIndex = $index % count($imgs);
                                    $statusColor = $record->status === 'absent' ? 'rgb(249, 105, 90)' : ($record->status === 'tardy' ? 'orange' : 'inherit');
                                @endphp

                                <tr class="text-center">
                                    <td >
                                        <img src="{{ $imgs[$imgIndex] }}" class="rounded-circle img-thumbnail"
                                            alt="" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $record->student->firstName }} {{ $record->student->lastName }}</td>
                                    <td>{{ $record->date }}</td>
                                    {{-- <td   style="background-color: {{ $statusColor }}; color: black;">{{ $record->status }} --}}
                                    <td>
                                        <i class="{{ $icons[$record->status] }}" ></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ########################### Prameters ################################ --}}
                 <div class="text-center small mt-4">
                    <span class="me-4">
                        <i class="fas fa-square  text-success"></i>
                        <span>Presence</span>
                    </span>
                    <span class="me-4">
                        <i class="fas fa-square  text-orange" style="color: rgb(236, 148, 15);"></i>
                        <span>Retard</span>
                    </span>
                    <span class="me-4">
                        <i class="fas fa-square  text-danger"></i>
                        <span>Absence</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

@endsection
