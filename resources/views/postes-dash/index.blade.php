@extends('dashboard.master');

@section('title', 'show post')



@section('content')

   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Gestion des Posts</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" href="{{ route('post.create') }}">Créer un Post</a>
            <a class="nav-link active" href="{{ route('post.index') }}">Liste des Posts</a>
          </div>
        </div>
      </nav>

    <div class="container my-3">
        <h4>Liste des Posts</h4>
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
      {{-- </div> --}}
      
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Type</th>
              <th>Contenu</th>
              <th>Fichier</th>
              <th>Images</th>
              <th>Lien</th>
              <th>Groupe</th>
              <th>Matière</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
              <tr>
                <td>{{ $post->type }}</td>
                <td class="text-truncate" style="max-width: 150px;">{{ $post->content }}</td>


              {{-- <td style="@if (strlen($post->content) > 20) white-space: pre-line; @endif" class="text-td">
                  {{ $post->content }}
              </td> --}}
                <td>   
                  @if ($post->file_path)
                    <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank">Voir Fichier</a>
                  @endif
                </td>
                <td>
                  @if ($post->type === 'image')
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="image" class="img-thumbnail" height="50px" width="50px">
                  @else
                    <p>Pas d'image</p>
                  @endif
                </td>
                <td>{{ $post->link }}</td>
                <td>
                  @if ($post->groups->count() > 0)
                    @foreach ($post->groups as $group)
                      {{ $group->nom_group }} <br>
                    @endforeach
                  @else
                    Tous les groupes
                  @endif
                </td>
                <td>
                  @if ($post->code_matiere == 0)
                    Général
                  @else
                    {{ $post->matiere->label }}
                  @endif
                </td>
                <td>
                  <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                    <form action="{{ route('post.delete', $post->id) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      {{-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce post ?')">Supprimer</button> --}}
                        {{-- <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $post->id }})">Supprimer</button> --}}
                      <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce post ?')">Supprimer</button>
                    </form>
                  {{-- <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $post->id }})">Supprimer</button> --}}
                  {{-- <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                  <a class="btn btn-danger btn-sm" onclick="confirmDelete({{ $post->id }})">Supprimer</a>
                   --}}
                   
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
           
      
            <div class="d-flex justify-content-center">
                {{-- {{ $posts->links() }} --}}
            </div>
    </div>

    <style>
      .w-5{
        display: none;
      }
      
      table{
        text-align: center;
      }
      table tr th , table tr td {
        text-align: center;

      }
      table thead tr th  {
        /* font-size: 20px;
        font-weight: bold; */
        }
      table   {
       
        border: 2px solid rgb(0, 0, 0);
      }

      /* table .text-td{
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 0px;
      } */


    </style>
    
{{--     
    <script>
      function confirmDelete(id) {
        if (confirm('Voulez-vous vraiment supprimer ce post ?')) {
          document.getElementById('delete-form-' + id).submit();
        }
      }
    </script> --}}


@endsection

