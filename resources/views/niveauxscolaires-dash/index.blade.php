{{-- @extends('dashboard.master')

@section('content')

    <div class="mb-3" style="width: 75%;margin:4% 10%">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            <div class="mb-3">
                <form method="GET" action="{{ route('dash-niveauxscolaire.index') }}">
                    <label for="department_id" class="font-weight-bold" >Filtrer par Département :</label>
                    <select class="form-control" id="department_id" name="department_id" onchange="this.form.submit()">
                        <option value="">Tous les Départements</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $selectedDepartment == $department->id ? 'selected' : '' }}>
                            {{ $department->label }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>


            <div class="mb-3">
                <a href="{{ route('dash-niveauxscolaire.create') }}" class="btn btn-primary">Créer Nouveau Niveau Scolaire</a>
            </div>



            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr >
                            <th class="text-center text-primary font-weight-bold">Filière</th>
                            <th class="text-center text-primary font-weight-bold">Niveaux scolaire</th>
                            <th class="text-center text-primary font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($niveauxscolaires as $niveauxcolaire)
                        <tr>
                            <td class="text-center font-weight-bold" >{{ $niveauxcolaire->filiere->nom_filiere }}</td>
                            <td class="text-center font-weight-bold" >{{ $niveauxcolaire->label }}</td>
                            <td class="btn-group " style="margin-inline:25%">
                                <a href="{{ route('dash-niveauxscolaire.show', $niveauxcolaire->id) }}" class="btn btn-success btn-sm mr-2">Voir</a>
                                <a href="{{ route('dash-niveauxscolaire.edit', $niveauxcolaire->id) }}" class="btn btn-primary btn-sm mr-2">Modifier</a>
                                <form action="{{ route('dash-niveauxscolaire.destroy', $niveauxcolaire->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn mr-2 ">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>




    <style>
        /* Style for the table */


    /* Style for buttons in the table */
    .btn-group .btn {
        min-width: 75px; /* Set a minimum width for buttons */
    }

    </style>

    <script>
    // JavaScript for confirmation of deletion
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', (event) => {
            const confirmation = confirm('Êtes-vous sûr de vouloir supprimer ce niveau scolaire ?');

            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

    </script>
@endsection --}}

@extends('dashboard.master')

@section('content')
<div class="container mt-4">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <h1 class="mb-4">Liste des Niveaux Scolaires</h1>

      <div class="mb-3">
        <form method="GET" action="{{ route('dash-niveauxscolaire.index') }}">
          <label for="department_id" class="form-label">Filtrer par Département :</label>
          <select class="form-select" id="department_id" name="department_id" onchange="this.form.submit()">
            <option value="">Tous les Départements</option>
            @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ $selectedDepartment == $department->id ? 'selected' : '' }}>
              {{ $department->label }}
            </option>
            @endforeach
          </select>
        </form>
      </div>

      <a href="{{ route('dash-niveauxscolaire.create') }}" class="btn btn-primary mb-3">Créer Nouveau Niveau Scolaire</a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Filière</th>
              <th class="text-center">Niveaux scolaire</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($niveauxscolaires as $niveauxcolaire)
            <tr>
              <td class="text-center">{{ $niveauxcolaire->filiere->nom_filiere }}</td>
              <td class="text-center">{{ $niveauxcolaire->label }}</td>
              <td class="text-center">
                <a href="{{ route('dash-niveauxscolaire.show', $niveauxcolaire->id) }}" class="btn btn-success btn-sm">Voir</a>
                <a href="{{ route('dash-niveauxscolaire.edit', $niveauxcolaire->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                <form action="{{ route('dash-niveauxscolaire.destroy', $niveauxcolaire->id) }}" method="POST" class="d-inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

<style>
  /* General styling */
  body {
    font-family: sans-serif;
  }

  /* Table styling */
  .table {
    width: 100%;
  }

  th, td {
    vertical-align: middle;
    padding: 0.75rem;
  }

  th {
    background-color: #f0f0f0;
    text-align: center;
  }

  /* Button group styling */
  .btn-group {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .btn-group .btn {
    margin-right: 5px; /* Adjust spacing between buttons */
  }

  /* Delete button styling */
  .btn-danger {
    min-width: 80px; /* Ensure adequate width for text */
  }
</style>

<script>
  // JavaScript for confirmation of deletion (unchanged)
  // ...
</script>
