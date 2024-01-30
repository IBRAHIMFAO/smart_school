@extends('dashboard.master')

@section('content')
<div class="container" style="margin-top: 10%">
    <h1>Modifier le groupe</h1>

    <form method="POST" action="{{ route('dash-groupe.update', $group->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom_group">Nom du groupe</label>
            <input type="text" name="nom_group" id="nom_group" class="form-control" value="{{ $group->nom_group }}">
        </div>

        <div class="form-group">
            <label for="niveau_scolaire_id">Niveau Scolaire</label>
            <select name="niveau_scolaire_id" id="niveau_scolaire_id" class="form-control">
                @foreach ($niveauxScolaires as $niveauScolaire)
                    <option value="{{ $niveauScolaire->id }}" {{ $niveauScolaire->id == $group->niveau_scolaire_id ? 'selected' : '' }}>
                        {{ $niveauScolaire->label }}
                    </option>
                @endforeach
            </select>
        </div>
      
        <div class="form-group row">
            <div class="col-md-4 ">
                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
            </div>
           
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{  route('dash-groupe.index') }}" class="btn btn-secondary">Retour</a>
            </div>
           
        </div>


       

      
    </form>

    
</div>


@endsection





<style>
    /* Edit Page Styles */
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
}

/* Form Input Styles */
input[type="text"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Submit Button Style */
button[type="submit"] {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

/* "Retour" (Back) Button Style */
.btn-secondary {
    background-color: #6c757d;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
}

/* Add some spacing */
.mb-2 {
    margin-bottom: 20px;
}

/* Error Message Style */
.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

/* Success Message Style */
.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}
/* CSS for Inline Buttons */
/* .form-group.row .btn {
    display: inline-block;
   
} */

</style>