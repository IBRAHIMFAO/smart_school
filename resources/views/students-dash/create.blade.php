@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>Créer un Étudiant</h1>
    <form method="POST" action="{{ route('dash-student.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <!-- Left Column -->
                <div class="form-group">
                    <label for="fullname">Nom complet</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <!-- Add other left column fields here -->
            </div>
            <div class="col-md-6">
                <!-- Right Column -->
                <div class="form-group">
                    <label for="img">Image</label>
                    <input type="file" class="form-control-file" id="img" name="img" accept="image/*" required>
                </div>
                <!-- Add other right column fields here -->
            </div>
        </div>
        <!-- Add other form rows as needed, split them into left and right columns -->

        <button type="submit" class="btn btn-primary">Créer Étudiant</button>
    </form>
</div>



<style>/* Add this CSS to your existing stylesheet or in a <style> tag in your HTML file */

    /* Style for the form container */
    .container {
        margin-top: 20px;
    }

    /* Style for the image preview */
    #img-preview {
        max-width: 100%;
        max-height: 200px;
        display: none;
        margin-top: 10px;
    }

    /* Style for form rows and columns */
    .row {
        margin-bottom: 20px;
    }

    /* Style for form fields */
    .form-control {
        width: 100%;
    }

    /* Style for the submit button */
    .btn-primary {
        margin-top: 10px;
    }
</style>



<script>
    // Image Preview
    const imgInput = document.getElementById('img');
    const imgPreview = document.getElementById('img-preview');

    imgInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imgPreview.src = e.target.result;
                imgPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>



@endsection
