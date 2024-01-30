@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>{{ __('Créer un paiement') }}</h1>
    <form method="POST" action="{{ route('payment.store') }}">
        @csrf


        <div class="form-group">
            <label for="code_student">{{ __('Student') }}</label>
            <input type="text" class="form-control" id="student_search" name="student_search" placeholder="{{ __('Search for a student by name, CIN, or CNE') }}">
            <select class="form-control" id="code_student" name="code_student" required>
                
            </select>
        </div>



        {{-- <div class="form-group">
            <label for="code_student">{{ __('Étudiant') }}</label>
            <select class="form-control" id="code_student" name="code_student" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group">
            <label for="code_caissier">{{ __('Caissier') }}</label>
            <select class="form-control" id="code_caissier" name="code_caissier" required>
                @foreach($caissiers as $caissier)
                    <option value="{{ $caissier->id }}">{{ $caissier->first_name }} {{ $caissier->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="code_ecole">{{ __('École') }}</label>
            <select class="form-control" id="code_ecole" name="code_ecole" required>
                @foreach($ecoles as $ecole)
                    <option value="{{ $ecole->id }}">{{ $ecole->nom_ecole }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="payment_type">{{ __('Type de paiement') }}</label>
            <select class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type" required>
                <option value="cash">{{ __('Espèces') }}</option>
                <option value="visa">{{ __('Visa') }}</option>
                <option value="cheque">{{ __('Chèque') }}</option>
                <option value="autre">{{ __('Autre') }}</option>
            </select>
            @error('payment_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

{{-- ########################################################################################################################## --}}

        
        
        <!-- Autres champs de paiement -->
        <div class="form-group">
            <label for="amount">{{ __('Montant') }}</label>
            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="{{ __('Entrez le montant') }}" require>
            @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        


        <div class="form-group">
            <label for="status">{{ __('Statut') }}</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}">
                <option value="complet">{{ __('Complet') }}</option>
                <option value="partiel">{{ __('Partiel') }}</option>
                <option value="en_attente">{{ __('En Attente') }}</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="remaining_amount">{{ __('Montant Restant') }}</label>
            <input type="text" class="form-control @error('remaining_amount') is-invalid @enderror" id="remaining_amount" name="remaining_amount" value="{{ old('remaining_amount') }}" >
            @error('remaining_amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        



{{-- ############################################################################################################# --}}
       
<div class="form-group">
            <label for="payment_date">{{ __('Date de paiement') }}</label>
            <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', \Carbon\Carbon::now()->toDateString()) }}" required>
            @error('payment_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>




        <div class="form-group">
            <label for="payment_description">{{ __('Description du paiement') }}</label>
            <input type="text" class="form-control @error('payment_description') is-invalid @enderror" id="payment_description" name="payment_description" value="{{ old('payment_description') }}" placeholder="{{ __('Entrez la description du paiement') }}">
            @error('payment_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="currency">{{ __('Devise') }}</label>
            <input type="text" class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" value="{{ old('currency', 'MAD') }}" placeholder="{{ __('Entrez la devise') }}">
            @error('currency')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group">
            <label for="payment_month">{{ __('Mois de paiement') }}</label>
            <select class="form-control @error('payment_month') is-invalid @enderror" id="payment_month" name="payment_month" required>
                @php
                    $months = [
                        'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
                        'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                    ];
                @endphp
                @foreach($months as $month)
                    <option value="{{ $month }}" {{ old('payment_month') == $month ? 'selected' : '' }}>{{ __($month) }}</option>
                @endforeach
            </select>
            @error('payment_month')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        <div class="form-group">
            <label for="payment_year">{{ __('Année de paiement') }}</label>
            <select class="form-control @error('payment_year') is-invalid @enderror" id="payment_year" name="payment_year" value="{{ old('payment_year') }}" required>
                @php
                    use Carbon\Carbon;
                @endphp
                @foreach($ecoles as $ecole)
                    <option value="{{ $ecole->id }}">{{ Carbon::parse($ecole->anneeScolaire->start_date)->format('Y') }} / {{ Carbon::parse($ecole->anneeScolaire->end_date)->format('Y') }}</option>
                @endforeach
            </select>
            @error('payment_year')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Créer le paiement') }}</button>
    </form>
</div>



@endsection


@section('scripts')
<script>
    $(document).ready(function () {
        // Au chargement de la page, vérifiez le statut initial
        checkStatus();

        // Écoutez les changements de la sélection du statut
        $("#status").change(function () {
            // Vérifiez le statut à chaque changement
            checkStatus();
        });

        // Fonction pour vérifier et gérer l'état de l'input "Montant Restant"
        function checkStatus() {
            var selectedStatus = $("#status").val();
            var remainingAmountInput = $("#remaining_amount");

            if (selectedStatus === "partiel") {
                // Si le statut est "Partiel", activez l'input "Montant Restant"
                remainingAmountInput.prop("disabled", false);
                remainingAmountInput.val('');
                // Add a placeholder when enabling
                remainingAmountInput.attr("placeholder", "{{ __('Entrez le montant restant') }}");
            
            } else {
                // Sinon, désactivez l'input "Montant Restant" et réinitialisez sa valeur
                remainingAmountInput.prop("disabled", true);
                remainingAmountInput.val(0);
            }
        }
    });
</script>





<script>
    // DOM elements
    const studentSearchInput = document.getElementById('student_search');
    const studentSelect = document.getElementById('code_student');

    // Function to fetch and populate students
    const populateStudents = async (searchTerm) => {
        try {
            const response = await fetch(`/students/search?search=${searchTerm}`);
            const students = await response.json();

            // Clear existing options
            studentSelect.innerHTML = '';

            // Create and append new options
            students.forEach((student) => {
                const option = document.createElement('option');
                option.value = student.id;
                option.textContent = `${student.first_name} ${student.last_name}`;
                studentSelect.appendChild(option);
            });
        } catch (error) {
            console.error(error);
        }
    };

    // Add an event listener to the search input
    studentSearchInput.addEventListener('input', () => {
        const searchTerm = studentSearchInput.value;
        populateStudents(searchTerm);
    });
</script>
@endsection
