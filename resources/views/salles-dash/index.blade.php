
{{-- @extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4">Salles</h1>
    <a href="{{ route('dash-salle.create') }}" class="btn btn-primary mb-3">Ajouter une salle</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Status</th>
                    <th>Pavilion</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salles as $salle)
                <tr>
                    <td>{{ $salle->label }}</td>
                    <td>{{ $salle->status }}</td>
                    <td>{{ $salle->pavilion->label }}</td>
                    <td>{{ $salle->description ?: 'Aucune description disponible' }}</td>
                    <td>
                        <a href="{{ route('dash-salle.show', $salle->id) }}" class="btn btn-primary btn-sm">Voir</a>
                        <a href="{{ route('dash-salle.edit', $salle->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('dash-salle.destroy', $salle->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection --}}

@extends('dashboard.master')

@section('content')
<div class="mt-4">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h1 class="mb-4">Salles</h1>

      <a href="{{ route('dash-salle.create') }}" class="btn btn-primary mb-3">Ajouter une salle</a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped table-responsive">
          <thead>
            <tr>
              <th class="col-sm-6">Label</th>
              <th class="col-sm-6">Status</th>
              <th class="col-sm-12">Pavilion</th>
              <th class="col-sm-6">Description</th>
              <th class="col-sm-6">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($salles as $salle)
            <tr>
              <td>{{ $salle->label }}</td>
              <td>{{ $salle->status }}</td>
              <td>{{ $salle->pavilion->label }}</td>
              <td>{{ $salle->description ?: 'Aucune description disponible' }}</td>
              <td>
                <a href="{{ route('dash-salle.show', $salle->id) }}" class="btn btn-primary btn-sm">Voir</a>
                <a href="{{ route('dash-salle.edit', $salle->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                <form action="{{ route('dash-salle.destroy', $salle->id) }}" method="POST" class="d-inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?')">Supprimer</button>
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


