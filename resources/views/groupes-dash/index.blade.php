@extends('dashboard.master')

@section('content')


    <div class="container">

        <div class="Alert" >
            @if($groups->isEmpty())
            <div class="alert alert-warning">
                Aucun groupe trouvé.
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>



        <p>Groupes</p>
        <div class="card">
            <form method="GET" action="{{ route('dash-groupe.index') }}" class="mb-3">
                @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="annee_scolaire">Année Scolaire</label>
                                
                                <select name="annee_scolaire" id="annee_scolaire" class="form-control" >
                                {{-- onchange="handleAnneeScolaireChange(this)"> --}}
                                    {{-- <option value="">Sélectionnez une année scolaire</option> --}}
                                    {{-- @foreach ($anneeScolaires as $anneeScolaire)
                                        <option value="{{ $anneeScolaire->id }}" {{ $anneeScolaire->id == $selectedAnneeScolaire ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                                        </option>
                                   @endforeach --}}
                                  
                                  
                                   {{-- @foreach ($anneeScolaires as $anneeScolaire)
                                        <option value="{{ $anneeScolaire->id }}" {{ $anneeScolaire->start_date <= now() && now() <= $anneeScolaire->end_date ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                                        </option>
                                    @endforeach --}}

                                    {{-- <option value="">Sélectionnez une année scolaire</option>

                                       @foreach ($anneeScolaires as $anneeScolaire)
                                        <option value="{{ $anneeScolaire->id }}" {{$id= $anneeScolaire->start_date <= now() && now() <= $anneeScolaire->end_date ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                                        </option>
                                    
                                    @endforeach --}}
                                    <option value="">Sélectionnez une année scolaire</option>
                                    @foreach ($anneeScolaires as $anneeScolaire)
                                        <option value="{{ $anneeScolaire->id }}" {{ $id = $anneeScolaire->start_date <= now() && now() <= $anneeScolaire->end_date ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                                        </option>
                                    @endforeach
                                    
          
                                </select>
                            </div>
                        </div>
                                        {{-- @foreach ($anneeScolaires as $anneeScolaire)
                                            {{ $id= $anneeScolaire->start_date <= now() && now() <= $anneeScolaire->end_date ? $anneeScolaire->id: '' }} 
                                       @endforeach
                                       <h1>{{ $id }}</h1> --}}
                    




                       
                        {{-- <select name="annee_scolaire" id="annee_scolaire" class="form-control">
                            <option value="">Sélectionnez une année scolaire</option>
                                @foreach ($anneeScolaires as $anneeScolaire)
                                    <option value="{{ $anneeScolaire->id }}" {{ isset($selectedAnneeScolaire) && $selectedAnneeScolaire == $anneeScolaire->id ? 'selected' : ($anneeScolaire->start_date <= now() && now() <= $anneeScolaire->end_date ? 'selected' : '') }}>
                                        {{ \Carbon\Carbon::parse($anneeScolaire->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($anneeScolaire->end_date)->format('Y') }}
                                    </option>
                                @endforeach
                        </select> --}}
                                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ecole">École</label>
                                <select name="ecole" id="ecole" class="form-control">
                                    <option value="">Sélectionnez une école</option>
                                    @foreach ($ecoles as $ecole)
                                        <option value="{{ $ecole->id }}" {{ $ecole->id == $selectedEcole ? 'selected' : '' }}>
                                            {{ $ecole->nom_ecole }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="departement">Département</label>
                                <select name="departement" id="departement" class="form-control">
                                    <option value="">Sélectionnez un département</option>
                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->id }}" {{ $departement->id == $selectedDepartement ? 'selected' : '' }}>
                                            {{ $departement->label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filiere">Filière</label>
                                <select name="filiere" id="filiere" class="form-control">
                                    <option value="">Sélectionnez une filière</option>
                                    @foreach ($filieres as $filiere)
                                        <option value="{{ $filiere->id }}" {{ $filiere->id == $selectedFiliere ? 'selected' : '' }}>
                                            {{ $filiere->nom_filiere }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                <div class="text-center ">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </div>
            </form>
        </div>
        <!-- Your table goes here -->


        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('dash-groupe.create') }}" class="btn btn-success">Ajouter</a>
            </div>
            <div class="col-md-3 position-absolute  end-0">
                <a href="{{ route('export-groups') }}" class="btn btn-primary">Export to Excel</a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered " >
                <thead>
                    
                        <th>Nom du groupe</th>
                        <th>Niveau Scolaire</th>
                        <th>Actions</th>
                    
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->nom_group }}</td>
                            <td>{{ $group->niveauxscolaire->label }}</td>
                            <td>
                                <a href="{{ route('dash-groupe.show', $group->id) }}" class="btn btn-success btn-sm">Voir</a>
                                <a href="{{ route('dash-groupe.edit', $group->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                {{-- <a href="{{ route('dashboard.attendance.group',['groupId' => $group->id, 'AnneeScolaireId' => $id ? 'selected' : $anneeScolaire->id]) }}" class="btn btn-success btn-sm">Presence </a> --}}
                                {{-- <a href="{{ route('dashboard.attendance.group', ['groupId' => $group->id, 'AnneeScolaireId' => $selectedAnneeScolaire]) }}" class="btn btn-success btn-sm">Presence </a> --}}
                                {{-- <a href="{{ route('dashboard.attendance.group', ['groupId' => $group->id, 'AnneeScolaireId' => '']) }}" class="btn btn-success btn-sm btn-presence">Presence</a> --}}
                                <!-- Other action buttons... -->
                                {{-- <a href="{{ route('dashboard.attendance.group', ['groupId' => $group->id, 'AnneeScolaireId' => $selectedAnneeScolaire]) }}"
                                    class="btn btn-success btn-sm btn-presence" data-group-id="{{ $group->id }}">Presence</a>
                                 --}}
                                    <!-- Other action buttons... -->
                                    {{-- <a href="{{ route('dashboard.attendance.group', ['groupId' => $group->id ,'AnneeScolaireId'=> $anneeScolaire->id ]) }}" class="btn btn-success btn-sm btn-presence" >Presence</a> --}}
                                    <a href="{{ route('dashboard.attendance.group', ['groupId' => $group->id ,'AnneeScolaireId'=> 1 ]) }}" class="btn btn-success btn-sm btn-presence" >Presence</a>


                                {{-- @php
                                    dd(['groupId' => $group->id, 'AnneeScolaireId' => $id ? $anneeScolaire->id: 'selected'  ]);
                                @endphp --}}
                                
                                <form action="{{ route('dash-groupe.destroy', $group->id) }}" method="POST" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ">Supprimer</button>
                                </form>
                                <!-- Add your "Ajouter" button here -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include("elements.pagination", ['seances' => $groups])

    </div>



    

    <style>
        .card {
            padding: 10px;
            margin-bottom: 20px;
        }
        .card  form select{
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #9f9f9aab;
        }
        
        .card  form label{
            font-weight: bold;
        }
        
        p{
            font-weight: bold;
            font-size: 20px;
        }

        form select{
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #9f9f9aab;        }

        .table thead tr th {
            border-bottom: 2px solid #dee2e6;
            background-color: rgb(0, 102, 255);
            color: white;

        }
        .table thead tr td {
            border-bottom: 2px solid #dee2e6;
            background-color: #3d7ec0;
        }
        .table thead tr, .table tbody tr{
            height: 10px;
            width: 10px;
        }

    </style>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
        <!-- Add similar code for other select elements (ecole, departement, filiere) with their respective onchange events -->
{{-- 
<script>
    // Add this JavaScript code
    function handleAnneeScolaireChange(selectElement) {
        // Get the selected value
        var selectedAnneeScolaireId = selectElement.value;

        // Loop through each row in the table
        $('.btn-presence').each(function () {
            // Get the groupId from the data attribute
            var groupId = $(this).data('group-id');

            // Construct the full URL with the selected values
            var presenceLink = "{{ route('dashboard.attendance.group', ['groupId' => ':groupId', 'AnneeScolaireId' => ':anneeScolaireId']) }}";

            // Replace the placeholders with the selected values
            presenceLink = presenceLink.replace(':groupId', groupId);
            presenceLink = presenceLink.replace(':anneeScolaireId', selectedAnneeScolaireId);

            // Update the href attribute of the Presence link
            $(this).attr('href', presenceLink);
        });
    }
</script> --}}









 

{{-- 
<script>
    // Code JavaScript pour confirmation de suppression
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', (event) => {
            const confirmation = confirm('Êtes-vous sûr de vouloir supprimer ce groupe ?');

            if (!confirmation) {
                event.preventDefault();
            }
        });
    });
</script> --}}





@endsection
