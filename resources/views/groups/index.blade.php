@extends('layouts')

@section('content')

        <!-- index.blade.php -->
            <h1 class="text-center">Groups</h1>

        <div class="container">
            <!-- Export button -->
        <a href="{{ route('export-excel') }}" class="btn btn-success">Export to Excel</a><br><br>

            <table class="table table-striped table-hover" id="tableindex" >
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Niveaux Scolaire </th>
                        <th> Filiere </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->nom_group }}</td>
                        <td>{{$group ->niveauxscolaire -> niveauxscolaire  }}</td>
                        <td>{{$group ->filiere -> nom_filiere  }}</td>
                        <td><a href="{{ route('groups.show', $group) }}">
                            {{-- groups.show --}}
                            <button class="btn btn-success">View Students</button>
                        </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Import Excel -->
        <div class="container card mb-4">
            <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                @csrf

                <div class="form-group">
                    <input type="file" name="import_file" accept=".xlsx, .xls" class="form-control-file">
                </div> <br>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
@endsection
