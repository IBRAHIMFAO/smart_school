{{-- @extends('dashboard.master')

@section('content')

    @php
         use Carbon\Carbon;
    @endphp


   <div class="container">
        <h1>{{ __('Payment Details') }}</h1>

        <table class="table">
            <tr>
                <th>{{ __('Field') }}</th>
                <td>{{ __('Value') }}</td>
            </tr>

            <tr>
                <th>{{ __('Année de Paiement') }}</th>
                <td>{{ Carbon::parse($payment->ecole->anneeScolaire->start_date)->format('Y') }} / {{ Carbon::parse($payment->ecole->anneeScolaire->end_date)->format('Y') }}</td>

            </tr>
            <tr>
                <th>{{ __('École') }}</th>
                <td>{{ $payment->ecole->nom_ecole }}</td>
            </tr>

            <tr>
                <th>{{ __('Student') }}</th>
                <td>{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
            <tr>
                <th>{{ __('Monthly Fee') }}</th>
                <td>{{ $payment->student->monthly_fee }}</td>
            </tr>
            <tr>
                <th>{{ __('Payment Month') }}</th>
                <td>{{ $payment->payment_month }}</td>
            </tr>
            <tr>
                <th>{{ __('Amount') }}</th>
                <td>{{ $payment->amount }} {{ $payment->currency }}</td>
            </tr>
            <tr>
                <th>{{ __('Status') }}</th>
                <td>{{ $payment->status }}</td>
            </tr>
            <tr>
                <th>{{ __('Remaining Amount') }}</th>
                <td>{{ $payment->remaining_amount }} {{ $payment->currency }}</td>
            </tr>
            <tr>
                <th>{{ __('Payment Type') }}</th>
                <td>{{ $payment->payment_type }}</td>
            </tr>
            <tr>
                <th>{{ __('Payment Date') }}</th>
                <td>{{ $payment->payment_date }}</td>
            </tr>
            <tr>
                <th>{{ __('Payment Description') }}</th>
                <td>{{ $payment->payment_description }}</td>
            </tr>
            <tr>
                <th>{{ __('Caissier') }}</th>
                <td>{{ $payment->caissier->first_name }} {{ $payment->caissier->last_name }}</td>
            </tr>

            <tr>
                <th>{{ __('Created At') }}</th>
                <td>{{ $payment->created_at }}</td>
            </tr>
            <tr>
                <th>{{ __('Updated At') }}</th>
                <td>{{ $payment->updated_at }}</td>
            </tr>
        </table>

        <a href="{{ route('payment.index') }}" class="btn btn-primary">{{ __('Back to Payments') }}</a>
    </div>
@endsection --}}


@extends('dashboard.master')

@section('content')
@php
use Carbon\Carbon;
@endphp

<div class="container">
    {{-- <h1>{{ __('Détails du paiement') }}</h1> --}}

    <div class="card bg-light">
        <div class="card-body">
            <h1 class="payment-details-heading">{{ __('Détails du paiement') }}</h1>

            <table class="table table-bordered">
                <tr>
                    <th>{{ __('Champ') }}</th>
                    <td>{{ __('Valeur') }}</td>
                </tr>

                <tr>
                    <th>{{ __('Année de Paiement') }}</th>
                    <td>{{ Carbon::parse($payment->ecole->anneeScolaire->start_date)->format('Y') }} / {{ Carbon::parse($payment->ecole->anneeScolaire->end_date)->format('Y') }}</td>
                </tr>
                <tr>
                    <th>{{ __('École') }}</th>
                    <td>{{ $payment->ecole->nom_ecole }}</td>
                </tr>

                <tr>
                    <th>{{ __('Étudiant') }}</th>
                    <td>{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                <tr>
                    <th>{{ __('Frais Mensuels') }}</th>
                    <td>{{ $payment->student->monthly_fee }}</td>
                </tr>
                <tr>
                    <th>{{ __('Mois de Paiement') }}</th>
                    <td>{{ $payment->payment_month }}</td>
                </tr>
                <tr>
                    <th>{{ __('Montant') }}</th>
                    <td>{{ $payment->amount }} {{ $payment->currency }}</td>
                </tr>
                <tr>
                    <th>{{ __('Statut') }}</th>
                    <td>{{ $payment->status }}</td>
                </tr>
                <tr>
                    <th>{{ __('Montant Restant') }}</th>
                    <td>{{ $payment->remaining_amount }} {{ $payment->currency }}</td>
                </tr>
                <tr>
                    <th>{{ __('Type de Paiement') }}</th>
                    <td>{{ $payment->payment_type }}</td>
                </tr>
                <tr>
                    <th>{{ __('Date de Paiement') }}</th>
                    <td>{{ $payment->payment_date }}</td>
                </tr>
                <tr>
                    <th>{{ __('Description de Paiement') }}</th>
                    <td>{{ $payment->payment_description }}</td>
                </tr>
                <tr>
                    <th>{{ __('Caissier') }}</th>
                    <td>{{ $payment->caissier->first_name }} {{ $payment->caissier->last_name }}</td>
                </tr>

                <tr>
                    <th>{{ __('Créé le') }}</th>
                    <td>{{ $payment->created_at }}</td>
                </tr>
                <tr>
                    <th>{{ __('Modifié le') }}</th>
                    <td>{{ $payment->updated_at }}</td>
                </tr>

            </table>
        </div>
    </div>

    <a href="{{ route('payment.index') }}" class="btn btn-primary mt-3 payment-details-button">{{ __('Retour aux paiements') }}</a>
</div>

<style>
    /* Additional CSS styles */
    .card {
        border: 2px solid #007BFF;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .table th {
        background-color: #007BFF;
        color: #fff;
    }

    .payment-details-heading {
        background-color: #007BFF;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
    .payment-details-button {
        background-color: #007BFF;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .payment-details-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }
</style>

@endsection
