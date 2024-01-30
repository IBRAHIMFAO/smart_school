@extends('dashboard.master')

@section('title', 'Modifier un post')

@section('content')




<div class="container">
    <h4 class="text-center">Modifier un post </h4>


    <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="type">Type de post :</label>
            <select name="type" id="type" class="form-control">
                <option value="text" {{ $post->type === 'text' ? 'selected' : '' }}>Texte</option>
                <option value="image" {{ $post->type === 'image' ? 'selected' : '' }}>Image</option>
                <option value="file" {{ $post->type === 'file' ? 'selected' : '' }}>Fichier (PDF, Word, Excel, etc.)</option>
                <option value="link" {{ $post->type === 'link' ? 'selected' : '' }}>Lien</option>
            </select>
        </div>

        {{-- <div class="form-group" id="content-field">
            <label for="content">Contenu du post</label>
            <textarea name="content" id="content" class="form-control" rows="4">{{ $post->content }}</textarea>
        </div> --}}
        
            <div class="form-group" id="content-field-post" style="max-height: 200px; overflow-y: auto;">
                <label for="content">Contenu du post</label>
                <textarea name="content" id="content-post" class="form-control" rows="4" style="max-height: 150px;"  >{{ $post->content }}</textarea>
            </div>
        
        

        <div class="form-group" id="file-path-field" style="display: none;">
            <label for="file_path">Importez un fichier (PDF, Word, Excel, etc.) :</label>
            <input type="file" name="file_path" id="file_path" class="form-control">
        </div>

        <div class="form-group" id="image-path-field" style="display: none;">
            <label for="image_path">Importez une image :</label>
            <input type="file" name="image_path" id="image_path" class="form-control">
        </div>

        <div class="form-group" id="link-field" style="display: none;">
            <label for="link">Lien</label>
            <input type="text" name="link" id="link" class="form-control" value="{{ $post->link }}">
        </div>

        <div class="form-group">
            <label for="code_group">Groupe(s) :</label>
            <select name="code_group[]" id="code_group" class="form-control" multiple>
                <option value="0" {{ in_array(0, $selectedGroups) ? 'selected' : '' }}>Tous les groupes</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ in_array($group->id, $selectedGroups) ? 'selected' : '' }}>
                        {{ $group->nom_group }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group">
            <label for="code_matiere">Matière</label>
            <select name="code_matiere" id="code_matiere" class="form-control">
                <option value="" {{ is_null($post->code_matiere) ? 'selected' : '' }}>Sélectionnez une matière (facultatif)</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $post->code_matiere === $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->label }}
                    </option>
                @endforeach
            </select>
        </div> --}}
        
        {{-- <div class="form-group">
            <label for="code_matiere">Matière</label>
            <select name="code_matiere" id="code_matiere" class="form-control">
                <option value="" {{ is_null(old('code_matiere', $post->code_matiere)) ? 'selected' : '' }}>
                    Sélectionnez une matière (facultatif)
                </option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ old('code_matiere', $post->code_matiere) == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->label }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group">
            <label for="code_matiere">Matière :</label>
            <select name="code_matiere" id="code_matiere" class="form-control">
                <option value="">Sélectionnez une matière (facultatif)</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $post->code_matiere == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->label }}
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="row  row-button" >
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enregistrer les modifications </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <a href="{{ route('post.index') }}" class="btn btn-primary">Annuler</a>
                </div>
            </div>
        </div>
            
        


           {{-- <div class="btn-bottom mb-3 mt-3">
            <a href="{{ route('post.index') }}" class="btn btn-success">Retour à la liste des posts </a>
        </div> --}}

    </form>
    
</div>



<style>
    /* Style CSS personnalisé pour le formulaire */
    .container {
        margin-top: 20px;

        max-width: 1200px;
        padding: 20px;
        /* border: 1px solid #ccc; */
        border: #0d6efd 1px solid;
        border-radius: 5px;
    }
    
    .row-button {
        /* display: flex;
        justify-content: center; */
        margin-left: 10%;
        margin-top: 05%;
    }
    
    h4 {
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 20px;
        text-decoration: underline;
        color: #0d6efd;
        

    }

    /* Optionnel : style personnalisé pour le champ "Contenu du post" */
    /* #content {
        resize: vertical;
    } */
    /* Styles pour les étiquettes */
    label {
        font-weight: bold;
        font-size: 1.1em;
        color: #070707;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
        /* text-decoration: wavy; */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Affiche ou masque les champs en fonction du type de post sélectionné
        const typeField = document.getElementById('type');
        const contentField = document.getElementById('content-field');
        const filePathField = document.getElementById('file-path-field');
        const imagePathField = document.getElementById('image-path-field');
        const linkField = document.getElementById('link-field');

        typeField.addEventListener('change', function () {
            if (typeField.value === 'text') {
                contentField.style.display = 'block';
                filePathField.style.display = 'none';
                imagePathField.style.display = 'none';
                linkField.style.display = 'none';
            } else if (typeField.value === 'image') {
                contentField.style.display = 'block';
                filePathField.style.display = 'none';
                imagePathField.style.display = 'block';
                linkField.style.display = 'none';
            } else if (typeField.value === 'file') {
                contentField.style.display = 'block';
                filePathField.style.display = 'block';
                imagePathField.style.display = 'none';
                linkField.style.display = 'none';
            } else if (typeField.value === 'link') {
                contentField.style.display = 'block';
                filePathField.style.display = 'none';
                imagePathField.style.display = 'none';
                linkField.style.display = 'block';
            }
        });
    });
</script>

@endsection
