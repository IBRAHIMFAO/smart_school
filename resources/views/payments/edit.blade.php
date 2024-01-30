@extends('dashboard.master')

@section('content')
<div class="container">
    <h1>{{ __('Modifier le Paiement') }}</h1>

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

    <form method="POST" action="{{ route('payment.update', $payment->id) }}">
        @csrf
        @method('PUT')

            <!-- Student Information -->
            <div class="row">
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id">{{ __('Étudiant') }}</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $payment->student->first_name }} {{ $payment->student->last_name }}" disabled>
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id">{{ __('Étudiant') }}</label>
                        <input type="text" class="form-control" id="student_id_display" value="{{ $payment->student->first_name }} {{ $payment->student->last_name }}" disabled>
                        <input type="hidden" id="student_id" name="student_id" value="{{ $payment->student->id }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="monthly_fee">{{ __('Frais Mensuels') }}</label>
                        <input type="text" class="form-control" id="monthly_fee" name="monthly_fee" value="{{ $payment->student->monthly_fee }}" disabled>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount">{{ __('Montant') }}</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $payment->amount) }}" required>
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="currency">{{ __('Devise') }}</label>
                        <input type="text" class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" value="{{ old('currency', $payment->currency) }}" placeholder="{{ __('Entrez la devise') }}">
                        @error('currency')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- More Payment Details -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">{{ __('Statut') }}</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status', $payment->status) }}">
                            <option value="complet" {{ $payment->status == 'complet' ? 'selected' : '' }}>{{ __('Complet') }}</option>
                            <option value="partiel" {{ $payment->status == 'partiel' ? 'selected' : '' }}>{{ __('Partiel') }}</option>
                            <option value="en_attente" {{ $payment->status == 'en_attente' ? 'selected' : '' }}>{{ __('En Attente') }}</option>
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
                        <select class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type" value="{{ old('payment_type', $payment->payment_type) }}" required>
                            <option value="cash" {{ $payment->payment_type == 'cash' ? 'selected' : '' }}>{{ __('Espèces') }}</option>
                            <option value="visa" {{ $payment->payment_type == 'visa' ? 'selected' : '' }}>{{ __('Visa') }}</option>
                            <option value="cheque" {{ $payment->payment_type == 'cheque' ? 'selected' : '' }}>{{ __('Chèque') }}</option>
                            <option value="autre" {{ $payment->payment_type == 'autre' ? 'selected' : '' }}>{{ __('Autre') }}</option>
                        </select>
                        @error('payment_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Remaining Payment Details -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="remaining_amount">{{ __('Montant Restant') }}</label>
                        <input type="text" class="form-control @error('remaining_amount') is-invalid @enderror" id="remaining_amount" name="remaining_amount" value="{{ old('remaining_amount', $payment->remaining_amount) }}" disabled>
                        @error('remaining_amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment_date">{{ __('Date de paiement') }}</label>
                        <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', $payment->payment_date) }}" required>
                        @error('payment_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Payment Description -->
            <div class="form-group">
                <label for="payment_description">{{ __('Description du paiement') }}</label>
                <textarea class="form-control @error('payment_description') is-invalid @enderror" id="payment_description" name="payment_description" rows="4">{{ old('payment_description', $payment->payment_description) }}</textarea>
                @error('payment_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

                <!-- Caissier -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code_caissier">{{ __('Caissier') }}</label>
                        <select class="form-control" id="code_caissier" name="code_caissier" required>
                            @foreach($caissiers as $caissier)
                                <option value="{{ $caissier->id }}" {{ $caissier->id == $payment->code_caissier ? 'selected' : '' }}>{{ $caissier->first_name }} {{ $caissier->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

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
                                <option value="{{ $month }}" {{ old('payment_month', $payment->payment_month ?? '') == $month ? 'selected' : '' }}>{{ __($month) }}</option>
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


              <!-- École -->
            <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                        <label for="code_ecole">{{ __('École') }}</label>
                        <select class="form-control" id="code_ecole" name="code_ecole" required>
                            @foreach($ecoles as $ecole)
                                <option value="{{ $ecole->id }}" {{ $ecole->id == $payment->code_ecole ? 'selected' : '' }}>{{ $ecole->nom_ecole }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <!-- Année de Paiement -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment_year">{{ __('Année de paiement') }}</label>
                        <select class="form-control @error('payment_year') is-invalid @enderror" id="payment_year" name="payment_year" required>
                            @foreach($ecoles as $ecole)
                                <option value="{{ $ecole->id }}" {{ $ecole->id == $payment->code_ecole ? 'selected' : '' }}>
                                    {{ Carbon\Carbon::parse($ecole->anneeScolaire->start_date)->format('Y') }} / {{ Carbon\Carbon::parse($ecole->anneeScolaire->end_date)->format('Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{ __('Mettre à Jour le Paiement') }}</button>
        </div>
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
@endsection
