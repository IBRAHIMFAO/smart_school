@extends('dashboard.master')

@section('title', 'Créer un post')



@section('content')

<div class=" ">    
    <div class="d-flex flex-row">
        <div class="p-2"><a href="{{ route('post.create') }}" > create poste  </a> </div>
        <div class="p-2"><a  href="{{ route('post.index') }}"> Liste des Posts </a> </div>
    </div>
</div>

@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error') )
        <div class="alert alert-error " style="color: black;">
            {{ session('error') }}
        </div>
    @endif


<div class="container">

    <h1>Créer un nouveau post</h1>
    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="type">Type de post</label>
            <select name="type" id="type" class="form-control">
                <option value="text">Texte</option>
                <option value="image">Image</option>
                <option value="file">Fichier (PDF, Word, Excel, etc.)</option>
                <option value="link">Lien</option>
            </select>
        </div>

        <div class="form-group" id="content-field">
            <label for="content">Contenu du post</label>
            <textarea name="content" id="content-content" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group" id="file-path-field" style="display: none;">
            <label for="file_path">Importez un fichier (PDF, Word, Excel, etc.)</label>
            <input type="file" name="file_path" id="file_path" class="form-control">
        </div>

        <div class="form-group" id="image-paths-field" style="display: none;">
            <label for="image_path">Importez des images (maintenez Ctrl/Commande pour en sélectionner plusieurs)</label>
            {{-- <input type="file" name="image_paths[]" id="image_paths" class="form-control" multiple> --}}
            <input type="file" name="image_path" id="image_path" class="form-control" >
        </div>

        <div class="form-group" id="link-field" style="display: none;">
            <label for="link">Lien</label>
            <input type="text" name="link" id="link" class="form-control" placeholder="Entrez un lien">
        </div>

        <div class="form-group">
            <label for="code_group">Groupe(s)</label>
            <select name="code_group[]" id="code_group" class="form-control" multiple>
                <option value="0">Tous les groupes</option>
                @foreach($groups as $groupe)
                    <option value="{{ $groupe->id }}">{{ $groupe->nom_group }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="code_matiere">Matière</label>
            <select name="code_matiere" id="code_matiere" class="form-control">
                <option value="">Sélectionnez une matière (facultatif)</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}">{{ $matiere->label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer le post</button>
    </form>
</div>

<style>
    /* Style CSS personnalisé pour le formulaire */
    .container {
        margin-top: 20px;

        max-width: 900px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Optionnel : style personnalisé pour le champ "Contenu du post" */
    #content {
        resize: vertical;
    }
    /* Styles pour les étiquettes */
    label {
        font-weight: bold;
        font-size: 1.1em;
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Affiche ou masque les champs en fonction du type de post sélectionné
        const typeField = document.getElementById('type');
        const contentField = document.getElementById('content-field');
        const filePathField = document.getElementById('file-path-field');
        const imagePathsField = document.getElementById('image-paths-field');
        const linkField = document.getElementById('link-field');

        typeField.addEventListener('change', function () {
            if (typeField.value === 'text') {
                contentField.style.display = 'block';
                filePathField.style.display = 'none';
                imagePathsField.style.display = 'none';
                linkField.style.display = 'none';
            } else if (typeField.value === 'image') {
                contentField.style.display = 'block';
                filePathField.style.display = 'none';
                imagePathsField.style.display = 'block';
                linkField.style.display = 'none';
            } else if (typeField.value === 'file') {
                contentField.style.display = 'block';
                filePathField.style.display = 'block';
                imagePathsField.style.display = 'none';
                linkField.style.display = 'none';
            } else if (typeField.value === 'link') {
                contentField.style.display = 'block';
                filePathField.style.display = 'none';
                imagePathsField.style.display = 'none';
                linkField.style.display = 'block';
            }
        });
    });
</script>
@endsection











