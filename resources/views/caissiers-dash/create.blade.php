
 @extends('dashboard.master')

 @section('content')




<div class="container" style="margin-bottom: 05%">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif



    <h1 class="text-center">Créer un Caissier</h1>
    <form method="POST" action="{{ route('dash-caissier.store') }}" class="user-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">

            <div class="row">
                <div class="col-md-6">
                    {{-- <div class="form-group"> --}}
                        <div class="form-group">
                            <label for="img">Image</label>
                            <input type="file" class="form-control-file" id="img" name="img" required>
                        </div>

                </div>
                <div class="col-md-6">
                        <div class="form-group">
                                <label for="fullname">Nom Complet</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                        </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Nom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name_ar" >Prénom (Arabe)</label>
                        <input type="text" class="form-control" id="first_name_ar" name="first_name_ar" placeholder="الاسم الأول">
                        <button type="button" class="btn btn-primary show-keyboard" data-target="first_name_ar">
                            <i class="fa fa-keyboard"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name_ar" >Nom (Arabe)</label>
                        <input type="text" class="form-control" id="last_name_ar" name="last_name_ar" placeholder="الاسم الأخير">
                        <button type="button" class="btn btn-primary show-keyboard" data-target="last_name_ar">
                            <i class="fa fa-keyboard"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cin">CIN</label>
                        <input type="text" class="form-control" id="cin" name="cin">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">Genre</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male">Masculin</option>
                        <option value="female">Féminin</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="NIF">NIF</label>
                    <input type="text" class="form-control" id="NIF" name="NIF">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="salary">Salaire</label>
                    <input type="text" class="form-control" id="salary" name="salary">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="role">Rôle</label>
                    <input type="text" class="form-control" id="role" name="role" value="caissier" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="is_active" >Actif</label> <br>
                    <input type="checkbox" style="margin-inline: 05%" class="form-check-input"  id="is_active" name="is_active" value="1">
                </div>
            </div>
        </div>


    <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary">Créer un Caissier</button>
    </div>

    </form>
</div>


                <style>
                        /* Style pour le formulaire */
                    .user-form {
                        background-color: #f9f9f9;
                        border: 1px solid #ccc;
                        padding: 20px;
                        border-radius: 10px;
                        margin-top: 20px;
                    }

                    /* Style pour l'image utilisateur */
                    .user-image img {
                        width: 100px;
                        height: 100px;
                        object-fit: cover;
                        border-radius: 50%; /* Crée un cercle pour l'image */
                        margin-right: 20px;
                        border: 2px solid #333;
                        background-color: #fff;
                        padding: 5px;
                        float: left;
                    }

                    /* Style pour les détails de l'utilisateur */
                    .user-details {
                        float: left;
                        width: calc(100% - 120px); /* Réduit la largeur pour s'adapter à l'image */
                    }

                    /* Style pour le formulaire et les champs */
                    .form-group {
                        margin-bottom: 15px;
                    }

                    /* Style pour le bouton */
                    .btn-primary {
                        background-color: #007bff;
                        border: none;
                    }

                    .btn-primary:hover {
                        background-color: #0056b3;
                    }

            </style>



 @endsection

{{--

 <script>
    $(document).ready(function () {
        // Initialize virtual keyboard for the first_name_ar input
        $('#first_name_ar').keyboard({
            layout: 'custom',
            customLayout: {
                'default': [
                    'ض ص ث ق ف غ ع ه خ ح ج',
                    'ش س ي ب ل ا ت ن م ك',
                    'ظ ط ذ د ز ر و ة ى',
                    '{accept} {space} {cancel}'
                ]
            },
            usePreview: false,
            autoAccept: true,
        });

        // Initialize virtual keyboard for the last_name_ar input
        $('#last_name_ar').keyboard({
            layout: 'custom',
            customLayout: {
                'default': [
                    'ض ص ث ق ف غ ع ه خ ح ج',
                    'ش س ي ب ل ا ت ن م ك',
                    'ظ ط ذ د ز ر و ة ى',
                    '{accept} {space} {cancel}'
                ]
            },
            usePreview: false,
            autoAccept: true,
        });

        // Show/hide keyboard when the buttons are clicked
        $('.show-keyboard').click(function () {
            var targetInputId = $(this).data('target');
            var keyboard = $('#' + targetInputId).getkeyboard();

            if (keyboard.isVisible()) {
                keyboard.close(true); // Hide the keyboard
            } else {
                keyboard.reveal(); // Show the keyboard
            }
        });
    });
    </script>
 --}}









   {{-- ########### 2eme methode ############## 2 inputs ########### keyboard js ########### --}}

    {{--
    @section('content')

    <div class="container">
        <h1 class="text-center">Créer un Caissier</h1>
        <form method="POST" action="{{ route('dash-caissier.store') }}" class="user-form">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- ... Other form fields ... -->

                    <!-- Prénom (Arabe) -->
                    <div class="form-group">
                        <label for="first_name_ar">Prénom (Arabe)</label>
                        <input type="text" class="form-control" id="first_name_ar" name="first_name_ar" placeholder="الاسم الأول">
                        <button type="button" class="btn btn-primary show-keyboard" data-target="first_name_ar">
                            <i class="fa fa-keyboard"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- ... Other form fields ... -->

                    <!-- Nom (Arabe) -->
                    <div class="form-group">
                        <label for="last_name_ar">Nom (Arabe)</label>
                        <input type="text" class="form-control" id="last_name_ar" name="last_name_ar" placeholder="الاسم الأخير">
                        <button type="button" class="btn btn-primary show-keyboard" data-target="last_name_ar">
                            <i class="fa fa-keyboard"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- ... Other form fields ... -->
        </form>
    </div>


    <style>
        /* Style pour le formulaire */
        .user-form {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        /* ... Other styles ... */
    </style>

    <script>
        $(document).ready(function () {
            // Initialize virtual keyboard for the first_name_ar input
            var keyboard= $('#first_name_ar').keyboard({
                layout: 'custom',
                customLayout: {
                    'default': [
                        'ض ص ث ق ف غ ع ه خ ح ج',
                        'ش س ي ب ل ا ت ن م ك',
                        'ظ ط ذ د ز ر و ة ى',
                        '{accept} {space} {cancel}'
                    ]
                },
                usePreview: false,
                autoAccept: true,
            });

            // Initialize virtual keyboard for the last_name_ar input
            var keyboard=   $('#last_name_ar').keyboard({
                layout: 'custom',
                customLayout: {
                    'default': [
                        'ض ص ث ق ف غ ع ه خ ح ج',
                        'ش س ي ب ل ا ت ن م ك',
                        'ظ ط ذ د ز ر و ة ى',
                        '{accept} {space} {cancel}'
                    ]
                },
                usePreview: false,
                autoAccept: true,
            });

            // Show/hide keyboard when the buttons are clicked
            $('.show-keyboard').click(function () {
                var targetInputId = $(this).data('target');
                var keyboard = $('#' + targetInputId).getkeyboard();

                if (keyboard.isVisible()) {
                    keyboard.close(true); // Hide the keyboard
                } else {
                    keyboard.reveal(); // Show the keyboard
                }
            });
        });

    </script>

    @endsection --}}


{{-- ###################### End Method #################################"" --}}




























