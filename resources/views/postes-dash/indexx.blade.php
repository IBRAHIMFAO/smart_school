
@extends('dashboard.master');

@section('title', 'show post')


{{--
@section('content')
    <div class="container">
        <h1>Liste des Posts</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
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
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->type }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->file_path }}</td>
                        <td>{{ $post->image_paths }}</td>
                        <td>{{ $post->link }}</td>
                        <td>{{ $post->code_group->group->nom_group }}? :Tout les group</td>
                        <td>{{ $post->code_matiere->matiere->label }}? :gereral </td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Voir</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Éditer</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}


@section('content')

   
   
      
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
                <td>{{ $post->content }}</td>
                <td>
                  @if ($post->file_path)
                    <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank">Voir Fichier</a>
                  @endif
                </td>
                <td>
                  @if ($post->type === 'image')
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="image" class="img-thumbnail">
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
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    
    
    
    
    
    
    <div class=" ">    
        <div class="d-flex flex-row">
            <div class="p-2"><a href="{{ route('post.create') }}" > create poste  </a> </div>
            <div class="p-2"><a  href="{{ route('post.index') }}"> Liste des Posts </a> </div>
        </div>
    </div>

    <div class="container">
        {{-- <img src="{{ asset('storage/images/images_post/Yw6UBS95TyXHlXlpMPfuaDdXkh04KRfcyvtsM7g7.jpg' ) }}" alt="image" width="100px" height="100px"> --}}
        <h1>Liste des Posts</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <div class="table-responsive">
        <table class="table"  >
            <thead>
                <tr>
                    {{-- <th>Titre</th> --}}
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
                        {{-- <td>{{ $post->title }}</td> --}}
                        <td>{{ $post->type }}</td>
                        <td style="@if (strlen($post->content) > 20) white-space: pre-line; @endif">
                            {{ $post->content }}
                        </td>
                        <td >
                            @if ($post->file_path)
                                <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank">Voir Fichier</a>
                            @endif
                        </td>
                        <td>

                            @if ($post->type === 'image')
                                {{-- <img src="{{ asset('storage/images/images_post/' . $post->image_paths) }}" alt="image" width="100px" height="100px"> --}}
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="image" width="100px" height="100px">
                            @else
                                <p>Invalid image_paths data</p>
                            @endif


                        </td>
                        <td>{{ $post->link }}</td>
                        <td>
                            @if ($post->groups->count() > 0)
                                @foreach ($post->groups as $group)
                                    {{ $group->nom_group }} <br>
                                @endforeach
                            @else
                                Tout les groupes
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
                            {{-- <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Voir</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Éditer</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post?')">Supprimer</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- 
    <style>
        .container{
            width: 80%;
            margin: 0 auto;

        }

        .table{
            width: 100%;
            margin: 0 auto;
            border: 1px solid #9f9f9aab;
            border-collapse: collapse;
        }
        .table th,tr,td{
            border: 1px solid #9f9f9aab;
            padding: 5px;
        }
        .table th{
            background-color: #eeee3dab;
        }


    </style> --}}


@endsection

