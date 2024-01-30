@extends('dashboard.master')

@section('content')


<div class="m-5 " >
    <h1 class="my-4">Liste des Caissiers</h1>

    <div class="mb-3">
        <a href="{{ route('dash-caissier.create') }}" class="btn btn-primary">Ajouter Caissier</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Image</th> <!-- Add a table header for the image -->
                    <th>Utilisateur</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>NIF</th>
                    <th>Date de naissance</th>
                    <th>CIN</th>
                    <th>Salaire</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($caissiers as $caissier)
                    <tr>
                        <!-- ... (your table data) ... -->
                        <td>
                            @if ($caissier->user->img)
                                <img src="{{ asset('storage/images/profile_images/' . $caissier->user->img) }}" alt="Caissier Image" width="100" height="100">
                            @else
                                <p>No Image</p>
                            @endif
                        </td>
                        <td>{{ $caissier->user->fullname }}</td>
                        <td>{{ $caissier->first_name }}</td>
                        <td>{{ $caissier->last_name }}</td>
                        <td>{{ $caissier->user->email }}</td>
                        <td>{{ $caissier->NIF }}</td>
                        <td>{{ $caissier->birthdate }}</td>
                        <td>{{ $caissier->cin }}</td>
                        <td>{{ $caissier->salary }}</td>
                        <td>
                            @if ($caissier->user->is_active)
                                <span class="badge badge-success">Actif</span>
                            @else
                                <span class="badge badge-danger">Inactif</span>
                            @endif
                        </td>

                        <td>
                            <div class="btn-group">
                                <a href="{{ route('dash-caissier.show', $caissier->id) }}" class="btn btn-primary">Voir</a>
                                <a href="{{ route('dash-caissier.edit', $caissier->id) }}" class="btn btn-warning ml-2">Modifier</a>
                                <form action="{{ route('dash-caissier.destroy', $caissier->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger show-modal">Supprimer</button>
                                </form>
                                <form action="{{ route('dash-caissier.toggle', $caissier->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        {{ $caissier->user->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet élément ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelButton" >Annuler</button>
                <button type="button" class="btn btn-danger delete-confirmed">Supprimer</button>
            </div>
        </div>
    </div>
</div>

@endsection
















<script>
    // Show/Delete Modal
    const modalButtons = document.querySelectorAll('.show-modal');
    const deleteConfirmedButtons = document.querySelectorAll('.delete-confirmed');
    const cancelButton = document.getElementById('cancelButton'); // Add this line


    modalButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            $('#confirmationModal').modal('show');

            // Handle delete confirmation
            deleteConfirmedButtons[index].addEventListener('click', () => {
                $('#confirmationModal').modal('hide');
                // Now, submit the form
                deleteForms[index].submit();
            });
             // Handle cancel button
             cancelButton.addEventListener('click', () => {
                $('#confirmationModal').modal('hide');
            });
        });
    });
</script>
