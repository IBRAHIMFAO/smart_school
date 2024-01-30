{{-- @extends("dashboard.master")

@section('content')
    <div class="container">
        <h1>Liste des Séances</h1>
        <a href="{{ route('dash-seance.create') }}" class="btn btn-primary mb-2">Ajouter une Séance</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure de Début</th>
                        <th>Heure de Fin</th>
                        <th>Statut</th>
                        <th>Type</th>
                        
                        <th>Niveauxscolaire</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seances as $seance)
                        <tr>
                            <td>{{ $seance->date }}</td>
                            
                            <td>{{ \Carbon\Carbon::parse($seance->heure_debut)->format('H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($seance->heure_fin)->format('H:i:s') }}</td>

                            <td>{{ $seance->status }}</td>
                            <td>{{ $seance->type }}</td>
                            <td>{{ $seance->group->niveauxscolaire->label }}</td>
                            <td>{{ $seance->group->nom_group }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('dash-seance.show', $seance->id) }}" class="btn btn-success btn-sm" style="margin: 2%"  >
                                    <i class="fas fa-eye"></i> Voir
                                </a>

                                <a href="{{ route('dash-seance.edit', $seance->id) }}" class="btn btn-primary btn-sm" style="margin:2%">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('dash-seance.destroy', $seance->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="margin:2%">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('elements.pagination', ['seances' => $seances])
@endsection --}}


@extends("dashboard.master")

@section('content')
  <div class="container mt-4">
    <h1 class="mb-4">Liste des Séances</h1>
    <a href="{{ route('dash-seance.create') }}" class="btn btn-primary">Ajouter une Séance</a>

    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Date</th>
            <th>Heure de Début</th>
            <th>Heure de Fin</th>
            <th>Statut</th>
            <th>Type</th>
            <th>Niveaux Scolaire</th>
            <th>Group</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($seances as $seance)
            <tr>
              <td>{{ $seance->date }}</td>
              <td>{{ \Carbon\Carbon::parse($seance->heure_debut)->format('H:i:s') }}</td>
              <td>{{ \Carbon\Carbon::parse($seance->heure_fin)->format('H:i:s') }}</td>
              <td>{{ $seance->status }}</td>
              <td>{{ $seance->type }}</td>
              <td>{{ $seance->group->niveauxscolaire->label }}</td>
              <td>{{ $seance->group->nom_group }}</td>
              <td class="text-center">
                <a href="{{ route('dash-seance.show', $seance->id) }}" class="btn btn-success btn-sm">
                  <i class="fas fa-eye"></i> Voir
                </a>
                <a href="{{ route('dash-seance.edit', $seance->id) }}" class="btn btn-primary btn-sm">
                  <i class="fas fa-edit"></i> Modifier
                </a>
                <form action="{{ route('dash-seance.destroy', $seance->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Supprimer
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @include('elements.pagination', ['seances' => $seances])
  </div>
@endsection

