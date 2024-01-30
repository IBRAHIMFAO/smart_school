
@extends('dashboard.master')

@section('content')
   <!-- Updated HTML with CSS classes -->
        <div class="container bg-primary">
            <h1 class="text-center fs-1 fw-bold mb-3">{{ __('Créer un paiement') }} </h1>

            <!-- Check for success message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Check for error message -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif



    <div class="card">

            <!-- Partie supérieure pour les informations de l'étudiant -->
            <div class="student-info">
                <h2 class="fs-2 fw-bold">{{ __('Informations sur l\'étudiant') }}</h2>
                <div class="form-group">
                    <label for="student_search">{{ __('Recherchez un étudiant par CNE') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="student_search" name="student_search" placeholder="{{ __('Entrez le CNE de l\'étudiant') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="search_student">{{ __('Rechercher') }}</button>
                        </div>
                    </div>
                </div>
                <!-- Affichage des informations de l'étudiant après la recherche -->
                <div id="student_info_display" class="student-info-display">
                    <!-- Les informations de l'étudiant seront affichées ici -->
                </div>
            </div>

    </div>
    <div class="card-body bg-primary">

            <!-- Partie inférieure pour les informations de paiement -->
            <div class="payment-info">
                <h2 class="fs-2 fw-bold ">{{ __('Informations de paiement') }}</h2>
                <form method="POST" action="{{ route('payment.store') }}">
                    @csrf

                
                    <div class="row">
                        <!-- Hidden input field for student ID -->
                        <input type="hidden" id="student_id" name="student_id">

                        <div class="col-md-6">
                            <!-- Champ last_name -->
                            <div class="form-group">
                                <label for="last_name">{{ __('Nom de l\'étudiant') }}</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Champ first_name -->
                            <div class="form-group">
                                <label for="first_name">{{ __('Prénom de l\'étudiant') }}</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" disabled>
                            </div>
                        </div>
                    </div>
                    
                    
                
                
                
                
                <div class="row">
                    <div class="col-md-6">
                           <!-- Année de paiement -->
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
                    </div>
                 
                     <!-- Mois de paiement -->
                     <div class="col-md-6">
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
                        </div>
                
                </div>
                    
                <div class="row">
                    <div class="col-md-6">   
                        <!-- Autres champs de paiement -->
                        <div class="form-group">
                            <label for="amount">{{ __('Montant') }}</label>
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="{{ __('Entrez le montant') }}" required>
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>    
                         <!-- Devise -->
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="currency">{{ __('Devise') }}</label>
                            <input type="text" class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" value="{{ old('currency', 'MAD') }}" placeholder="{{ __('Entrez la devise') }}">
                            @error('currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                </div>    
                  
             

                <div class="row">
                    <div class="col-md-6">   
                          <!-- Statut -->
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
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_type">{{ __('Type de paiement') }}</label>
                            <select class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type" required>
                                <option value="cash" {{ old('payment_type') === 'cash' ? 'selected' : '' }}>{{ __('Espèces') }}</option>
                                <option value="visa" {{ old('payment_type') === 'visa' ? 'selected' : '' }}>{{ __('Visa') }}</option>
                                <option value="cheque" {{ old('payment_type') === 'cheque' ? 'selected' : '' }}>{{ __('Chèque') }}</option>
                                <option value="autre" {{ old('payment_type') === 'autre' ? 'selected' : '' }}>{{ __('Autre') }}</option>
                            </select>
                            @error('payment_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                </div>  
                 
                

                <div class="row">
                   
                    <!-- Montant Restant -->
                    <div class="col-md-6">    
                        <div class="form-group">
                            <label for="remaining_amount">{{ __('Montant Restant') }}</label>
                            <input type="text" class="form-control @error('remaining_amount') is-invalid @enderror" id="remaining_amount" name="remaining_amount" value="{{ old('remaining_amount') }}" disabled>
                            @error('remaining_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>        
                    <div class="col-md-6">    
                          <!-- Date de paiement -->
                            <div class="form-group">
                                <label for="payment_date">{{ __('Date de paiement') }}</label>
                                <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', \Carbon\Carbon::now()->toDateString()) }}" required>
                                @error('payment_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                
                    </div>   
                </div> 
                
                <div class="row">
                   
                        <!-- Description du paiement -->
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="payment_description">{{ __('Description du paiement') }}</label>
                                <textarea class="form-control @error('payment_description') is-invalid @enderror" id="payment_description" name="payment_description" rows="4">{{ old('payment_description') }}</textarea>
                                @error('payment_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="code_caissier">{{ __('Caissier') }}</label>
                            <select class="form-control" id="code_caissier" name="code_caissier" required>
                                @foreach($caissiers as $caissier)
                                    <option value="{{ $caissier->id }}">{{ $caissier->first_name }} {{ $caissier->last_name }}</option>
                                @endforeach
                            </select>
                        </div>                        
                </div>
               


            {{-- ##################################################################################################### --}}
            <div class="form-group">
                <label for="code_ecole">{{ __('École') }}</label>
                <select class="form-control" id="code_ecole" name="code_ecole" required>
                    @foreach($ecoles as $ecole)
                        <option value="{{ $ecole->id }}">{{ $ecole->nom_ecole }}</option>
                    @endforeach
                </select>
            </div>
            
               
               
               
                <div class="text-center m-5">
                    <button type="submit" class="btn btn-primary">{{ __('Créer le paiement') }}</button>
                </div>
    </div>
                </form>
            </div>
        </div>





            <!-- Add the following styles inside your HTML file, or link to an external CSS file -->

        <style>
                /* Style for the container */
                .container {
                    max-width: 1200px;
                    margin: 0 auto;
                    padding: 20px;
                }

                /* Style for the section headers */
                h1, h2 {
                    color: #333;
                    font-family: Arial, sans-serif;
                }

                /* Style for the student info and payment info sections */
                .student-info, .payment-info {
                    border: 1px solid #ddd;
                    padding: 20px;
                    /* margin-bottom: 20px; */
                    background-color: #f9f9f9;
                }

                /* Style for form labels */
                label {
                    font-weight: bold;
                    margin-bottom: 5px;
                }

                /* Style for form inputs */
                .form-control {
                    width: 100%;
                    padding: 07px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    margin-bottom: 10px;
                }
              

                /* Style for the search button */
                .btn-primary {
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                }

                /* Style for form errors */
                .invalid-feedback {
                    color: #dc3545;
                }

                /* Style for the submit button */
                button[type="submit"] {
                    background-color: #28a745;
                    color: #fff;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 4px;
                    cursor: pointer;
                }

                /* Style for the student information display */
            .student-info-display {
                border: 1px solid #ddd;
                padding: 10px;
                margin-top: 10px;
            }

            /* Style for the student information variables on the same line */
            .student-info-display p {
                display: inline-block;
                margin-right: 20px; /* Add spacing between variables */
            }

        </style>


@endsection



    @section('scripts') <!-- Correction ici : utilisez 'scripts' au lieu de 'script' -->
        <script>
            $(document).ready(function () {
                // DOM elements
                const studentSearchInput = $('#student_search');
                const searchStudentButton = $('#search_student');
                const studentInfoDisplay = $('#student_info_display');

            // Add a variable to store the student ID
            let studentId = null;

                // Function to fetch and display student information
                const displayStudentInfo = function (cne) {
                    $.ajax({
                        url: `/students/by-cne/${cne}`,
                        method: 'GET',
                        success: function (data) {
                        // Store the student ID
                        
                        studentId = data.id;
                        // Mettre à jour les champs last_name et first_name avec les données de l'étudiant
                            $('#last_name').val(data.last_name);
                            $('#first_name').val(data.first_name);
                            $('#student_id').val(studentId);

                            // Le reste de votre code...
            
                            // Display student information
                            studentInfoDisplay.html(`
                                <p><strong>{{ __('Prénom') }}:</strong> ${data.first_name}</p>
                                <p><strong>{{ __('Nom') }}:</strong> ${data.last_name}</p>
                                <p><strong>{{ __('Date de naissance') }}:</strong> ${data.birthdate}</p>
                                <p><strong>CNE:</strong> ${data.cne}</p>
                                <p><strong>{{ __('Frais mensuels') }}:</strong> ${data.monthly_fee}</p>
                                <p><strong>{{ __('Groupe') }}:</strong> ${data.group.nom_group}</p>
                                <p><strong>{{ __('Niveau scolaire') }}:</strong> ${data.group.niveauxscolaire.label}</p>
                                <p><strong>{{ __('ID') }}:</strong> ${data.id}</p> 
                            `);

                             // Now, you can use studentId when creating the Payment model
                                const paymentData = {
                                    payment_year: validatedData.payment_year,
                                    payment_month: validatedData.payment_month,
                                    amount: validatedData.amount,
                                    currency: validatedData.currency,
                                    status: validatedData.status,
                                    payment_type: validatedData.payment_type,
                                    payment_date: validatedData.payment_date,
                                    payment_description: validatedData.payment_description,
                                    remaining_amount: validatedData.remaining_amount,
                                    code_student: studentId, // Use the defined studentId here
                                };

                                // Perform the AJAX request to create the payment
                                createPayment(paymentData);


                        },
                        error: function (error) {
                            // Handle errors
                            studentInfoDisplay.html(`<p>${error.responseJSON.error}</p>`);
                        }
                    });
                };

                // Add an event listener to the search button
                searchStudentButton.click(function () {
                    const cne = studentSearchInput.val();
                    displayStudentInfo(cne);
                });
            });


            // Function to create the payment
            const createPayment = function (paymentData) {
                $.ajax({
                    url: '/payment/store', // Adjust the URL as needed
                    method: 'POST',
                    data: paymentData,
                    success: function (response) {
                        // Handle success (e.g., display a success message)
                        console.log('Payment created successfully');
                    },
                    error: function (error) {
                        // Handle errors (e.g., display an error message)
                        console.error('Failed to create payment:', error.responseJSON.message);
                    }
                });
            };

        </script>



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
    @endsection





