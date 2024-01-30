@extends('dashboard.master')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('dash-filiere.create') }}" class="btn btn-primary">Créer Nouvelle Filière</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th class="text-center">Département</th>
                    <th class="text-center">Nom Filière</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filieres as $filiere)
                <tr>
                    <td class="text-center">{{ $filiere->departement->label }}</td>
                    <td class="text-center">{{ $filiere->nom_filiere }}</td>
                    <td class="text-center">{{ $filiere->description }}</td>
                    <td class="btn-group text-center">
                        <a href="{{ route('dash-filiere.show', $filiere->id) }}" class="btn btn-success btn-sm mr-2">Voir</a>
                        <a href="{{ route('dash-filiere.edit', $filiere->id) }}" class="btn btn-primary btn-sm mr-2">Modifier</a>
                        <form action="{{ route('dash-filiere.destroy', $filiere->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm delete-btn mr-2">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Ajoutez ici vos styles personnalisés */
    .table th,
    .table td {
        vertical-align: middle; /* Centrez verticalement le contenu des cellules */
    }

    .btn-group {
        display: flex;
        justify-content: center; /* Centrez horizontalement les boutons dans la colonne 'Action' */
    }

    .delete-form {
        display: inline-block; /* Pour afficher le formulaire de suppression en ligne */
    }
    .container {
        height: 100%;
        margin-top: 50px;
        margin-bottom: 100px;
    }
</style>

<script>
    // Code JavaScript pour confirmation de suppression
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', (event) => {
            const confirmation = confirm('Êtes-vous sûr de vouloir supprimer cette filière ?');

            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

    // Code JavaScript pour rendre les boutons de la même taille
    const btns = document.querySelectorAll('.btn-group .btn');
    let maxBtnWidth = 0;

    btns.forEach(btn => {
        const btnWidth = btn.offsetWidth;
        if (btnWidth > maxBtnWidth) {
            maxBtnWidth = btnWidth;
        }
    });

    btns.forEach(btn => {
        btn.style.width = maxBtnWidth + 'px';
    });
</script>
@endsection
