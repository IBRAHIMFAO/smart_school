@extends('dashboard.master')

@section('content')

<h1 class="text-info mb-4" style="margin:2%">Les Groupes</h1>



        <!-- Import Excel -->
        <div class="container  card mb-4 ">
            <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row justify-content-center" style="margin-top: 03%">
                    <div class="col-auto">
                        <label class="sr-only" for="import_file">Choose file</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import_file" name="import_file" accept=".xlsx, .xls">
                            <label class="custom-file-label" for="import_file">Choose file</label>
                        </div>
                    </div>
                    <div class="col-auto"  >
                        <button type="submit" class="btn btn-primary"  >Import</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="container-fluid">
            <div class="card shadow">
                <div class="form-row card-header py-3" >
                    <p class="text-primary m-1 fw-bold" style="font-size: 20px">Informations sur les groupes</p>

                <a href="{{ route('export-excel') }}" class="btn btn-success" >Export to Excel</a>
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
                            </select>&nbsp;</label></div>
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
                    <thead class="thead-light text-uppercase">
                        <tr >
                            <th class="font-weight-bold">Nom du groupe</th>
                            <th class="font-weight-bold"> Niveaux Scolaire </th>
                            <th class="font-weight-bold"> Filière </th>
                            {{-- <th>departement</th>
                            <th>lecole</th> --}}
                            <th class="font-weight-bold">Étudiants</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->nom_group }}</td>
                            <td>{{ $group->niveauxscolaire->niveauxscolaire }}</td>
                            <td>{{ $group->filiere->nom_filiere }}</td>
                            <td>
                                <a href="{{ route('dash-groupe.show', $group) }}" class="btn btn-success">View Students</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>


            @include("elements.pagination", ['seances' => $groups])


        </div>
    </div>
</div>






@endsection
