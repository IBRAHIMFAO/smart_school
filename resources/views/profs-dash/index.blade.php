@extends('dashboard.master')

@section('content')
{{--
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error') )
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
{{--
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif --}}


<div class="m-5">
    <h1 class="my-4">Liste des Professeurs</h1>

    <div class="mb-3">
        <a href="{{ route('dash-prof.create') }}" class="btn btn-primary">Ajouter un Professeur</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Utilisateur</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Doti</th>
                    <th>Date de naissance</th>
                    <th>CIN</th>
                    <th>Heures travaillées</th>
                    <th>Situation familiale</th>
                    <th>Adresse</th>
                    <th>Genre</th>
                    <th>Statut</th>
                    <th>Département(s)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profs as $prof)
                <tr>
                    <td>
                        @if ($prof->user->img)
                            <img src="{{ asset('storage/' . $prof->user->img) }}" alt="Professeur Image" width="100" height="100">
                        @else
                            <p>Aucune image</p>
                        @endif
                    </td>
                    <td>{{ $prof->user->fullname }}</td>
                    <td>{{ $prof->first_name }}</td>
                    <td>{{ $prof->last_name }}</td>
                    <td>{{ $prof->user->email }}</td>
                    <td>{{ $prof->Doti }}</td>
                    <td>{{ $prof->birthdate }}</td>
                    <td>{{ $prof->cin }}</td>
                    <td>{{ $prof->hours_worked }}</td>
                    <td>{{ $prof->family_status }}</td>
                    <td>{{ $prof->address }}</td>
                    <td>{{ $prof->user->gender }}</td>
                    <td>
                        @if ($prof->user->is_active)
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-danger">Inactif</span>
                        @endif
                    </td>
                    <td>
                        <ul>
                            @foreach ($prof->departements as $departement)
                            <li>{{ $departement->label }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('dash-prof.show', $prof->id) }}" class="btn btn-primary">Voir</a>
                            <a href="{{ route('dash-prof.edit', $prof->id) }}" class="btn btn-warning ml-2">Modifier</a>

                            <form action="{{ route('dash-prof.destroy', $prof->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger show-modal">Supprimer</button>
                            </form>


                            <form action="{{ route('dash-prof.toggle', $prof->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    {{ $prof->user->is_active ? 'Désactiver' : 'Activer' }}
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelButton">Annuler</button>
                <button type="button" class="btn btn-danger delete-confirmed">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for confirmation modal
    const modalButtons = document.querySelectorAll('.show-modal');
    const deleteConfirmedButtons = document.querySelectorAll('.delete-confirmed');
    const cancelButton = document.getElementById('cancelButton');
    const confirmationModal = document.getElementById('confirmationModal');

    modalButtons.forEach((button, index) => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the form submission
            $(confirmationModal).modal('show');

            deleteConfirmedButtons[index].addEventListener('click', () => {
                $(confirmationModal).modal('hide');
                // Trigger the form submission when "Supprimer" in the modal is clicked
                deleteForms[index].submit();
            });

            cancelButton.addEventListener('click', () => {
                $(confirmationModal).modal('hide');
            });
        });
    });
</script>


@endsection
