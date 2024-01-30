
@extends('dashboard.master')

@section('content')
<div class="mr-5">
    <h1>Students</h1>
    <table class="table table-responsive table-striped table-hover bg-light">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>First Name (Arabic)</th>
                <th>Last Name (Arabic)</th>
                <th>Birthdate</th>
                <th>Birthplace</th>
                <th>Address</th>
                <th>CNE</th>
                <th>Code RFID</th>
                <th>CIN</th>
                <th>Monthly Fee</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Phone</th>
                <th>Nom Group</th>
                <th>Niveauxscolaire</th>
                <th>First Name (Tuteur)</th>
                <th>Last Name (Tuteur)</th>
                <th>Type (Tuteur)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td><img src="{{ asset('storage/' . $student->user->img) }}" alt="Student Image" width="50"></td>
                    <td>{{ $student->first_name_ar }}</td>
                    <td>{{ $student->last_name_ar }}</td>
                    <td>{{ $student->birthdate }}</td>
                    <td>{{ $student->birthplace }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->cne }}</td>
                    <td>{{ $student->codeRFID }}</td>
                    <td>{{ $student->cin }}</td>
                    <td>{{ $student->monthly_fee }}</td>
                    <td>{{ $student->user->fullname }}</td>
                    <td>{{ $student->user->gender }}</td>
                    <td>{{ $student->user->role }}</td>
                    <td>{{ $student->user->phone }}</td>
                    <td>{{ $student->group->nom_group }}</td>
                    <td>{{ $student->group->niveauxscolaire->label }}</td>
                    <td>{{ $student->tuteur->firstName }}</td>
                    <td>{{ $student->tuteur->lastName }}</td>
                    <td>{{ $student->tuteur->type }}</td>
                    <td>
                        {{-- <a href="#" class="btn btn-primary view-btn" data-student-id="{{ $student->id }}">Voir</a> --}}
                        <button class="btn btn-primary view-btn" data-student-id="{{ $student->id }}">Voir</button>


                        {{-- <a href="{{ route('dash-student.getStudentDetails',$student->id) }}" class="btn btn-primary view-btn" data-student-id="{{ $student->id }}">Voir</a> --}}

                        <a href="{{ route('dash-student.edit', $student->id) }}" class="btn btn-warning edit-btn">Modifier</a>
                        <button type="button" class="btn btn-danger delete-btn" data-student-id="{{ $student->id }}" data-toggle="modal" data-target="#deleteModal">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{--
<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Détails de l'étudiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content for viewing student details will be displayed here -->
            </div>
        </div>
    </div>
</div> --}}


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet étudiant ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger delete-confirmed">Supprimer</button>
            </div>
        </div>
    </div>
</div>


        <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Détails de l'étudiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="" alt="Student Image" width="100" id="student-image">
                    </div>
                    <div class="col-md-8">
                        <p><strong>First Name:</strong> <span id="student-first-name"></span></p>
                        <p><strong>Last Name:</strong> <span id="student-last-name"></span></p>
                        <p><strong>Birthdate:</strong> <span id="student-birthdate"></span></p>
                        <p><strong>Nom Group:</strong> <span id="student-nom-group"></span></p>
                        <p><strong>Niveauxscolaire:</strong> <span id="student-niveauxscolaire"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

















   <!-- Your existing scripts here -->
    <script>
            // JavaScript code for actions


            $(document).ready(function() {
                $('.view-btn').click(function() {
                    var studentId = $(this).data('student-id');
                    // Here, you can use AJAX to retrieve and display student details in the view modal
                    // Example: $.get('/students/' + studentId, function(data) { $('#viewModal .modal-body').html(data); });

                    // For demonstration purposes, we'll display a sample message
                    $('#viewModal .modal-body').html('<p>Student details for ID ' + studentId + '</p>');
                    $('#viewModal').modal('show');
                });

                $('.edit-btn').click(function() {
                    var studentId = $(this).data('student-id');
                    // Redirect to the edit page for the selected student
                    window.location.href = '/students/' + studentId + '/edit';
                });

                $('.delete-btn').click(function() {
                    var studentId = $(this).data('student-id');
                    $('.delete-confirmed').data('student-id', studentId);
                });

                $('.delete-confirmed').click(function() {
                    var studentId = $(this).data('student-id');
                    // Here, you can use AJAX to send a request to delete the student with this ID
                    // Example: $.post('/students/' + studentId, {_method: 'DELETE'}, function(data) {});

                    // For demonstration purposes, we'll display a confirmation message
                    alert('Student with ID ' + studentId + ' deleted successfully');
                    $('#deleteModal').modal('hide');
                });




            $('.view-btn').click(function() {
                    var studentId = $(this).data('student-id');

                    // Utilisez AJAX pour récupérer les détails de l'étudiant
                    $.get('/dash-student/' + studentId, function(data) {
                        // Remplissez les éléments du modal avec les données de l'étudiant
                        $('#student-image').attr('src', data.img_url); // Remplacez 'data.img_url' par l'URL de l'image de l'étudiant
                        $('#student-first-name').text(data.first_name);
                        $('#student-last-name').text(data.last_name);
                        $('#student-birthdate').text(data.birthdate);
                        $('#student-nom-group').text(data.nom_group);
                        $('#student-niveauxscolaire').text(data.niveauxscolaire);

                        $('#viewModal').modal('show');
                    });
                });



        });
    </script>
