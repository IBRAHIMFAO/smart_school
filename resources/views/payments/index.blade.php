
@extends('dashboard.master')
{{--
@section('content')




    <div class="invoice">
        <div class="header">
            <h1>Invoice</h1>
        </div>
        <div class="from">
            <p>From:</p>
            <address>
                Your Company<br>
                Address Line 1<br>
                Address Line 2<br>
                City, Zip Code<br>
                Phone: (123) 456-7890
            </address>
        </div>
        <div class="to">
            <p>To:</p>
            <address>
                Customer Name<br>
                Customer Address Line 1<br>
                Customer Address Line 2<br>
                City, Zip Code<br>
                Email: customer@example.com
            </address>
        </div>
        <div class="details">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product 1</td>
                        <td>2</td>
                        <td>$50.00</td>
                        <td>$100.00</td>
                    </tr>
                    <tr>
                        <td>Product 2</td>
                        <td>1</td>
                        <td>$75.00</td>
                        <td>$75.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="total">
            <p><strong>Total: $175.00</strong></p>
        </div>
    </div>





    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            margin: 0 auto;
            width: 80%;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
        }
        .from, .to {
            width: 50%;
            display: inline-block;
            vertical-align: top;
        }
        .from {
            float: left;
        }
        .to {
            float: right;
        }
        .details {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .total {
            float: right;
            margin-top: 20px;
        }
    </style>

@endsection --}}
{{--
@section('content')


    <div class="container bg-custom"> <!-- Apply a background color and styles to the content section -->
        <h1 class="mb-4">{{ __('Liste des Paiements') }}</h1>

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

        <div style="margin-right: 7%">
            <a href="{{ route('payment.create') }}" class="btn btn-success mb-3">Ajouter</a> <!-- Add this button -->
            <table class="table table-bordered table-responsive-lg table-striped"> <!-- Increase table width -->
                @php
                use Carbon\Carbon;
                @endphp
                <thead>
                    <tr>
                        <th scope="col">Étudiant</th>
                        <th scope="col">Frais Mensuels</th>
                        <th scope="col">Mois de Paiement</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Montant Restant</th>
                        <th scope="col">Type de Paiement</th>
                        <th scope="col">Date de Paiement</th>
                        <th scope="col">Description de Paiement</th>
                        <th scope="col">Caissier</th>
                        <th scope="col">École</th>
                        <th scope="col">Année de Paiement</th>
                        <th scope="col">Temps Écoulé</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                        <td>{{ $payment->student->monthly_fee }} MAD</td>
                        <td>{{ $payment->payment_month }}</td>
                        <td>{{ $payment->amount }} {{ $payment->currency }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->remaining_amount }} {{ $payment->currency }}</td>
                        <td>{{ $payment->payment_type }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->payment_description }}</td>
                        <td>{{ $payment->caissier->first_name }} {{ $payment->caissier->last_name }}</td>
                        <td>{{ $payment->ecole->nom_ecole }}</td>
                        <td>{{ Carbon::parse($payment->ecole->anneeScolaire->start_date)->format('Y') }} / {{ Carbon::parse($payment->ecole->anneeScolaire->end_date)->format('Y') }}</td>
                        <td>
                            <span class="badge badge-success">{{ Carbon::parse($payment->created_at)->diffForHumans() }}</span>
                        </td>


                        <td>
                            <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-primary btn-sm">Voir</a>
                            <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                            <a href="{{ route('invoice.print', $payment->id) }}" class="btn btn-info btn-sm">Imprimer</a> <!-- Button to print invoice -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


        <style>
            /* styles.css */
            .bg-custom {
                background-color: #f0f0f0; /* Set your desired background color here */
                padding: 20px; /* Add padding for spacing */
                border-radius: 10px; /* Optionally, add rounded corners */
            }

        </style>


@endsection --}}



@section('content')
<div class="container-fluid bg-custom " style="margin-top: 10% ;margin-right:20%" > <!-- Use a fluid container and add padding -->
    <h1 class="mb-4">{{ __('Liste des Paiements') }}</h1>

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

    <div class="table-responsive-lg" > <!-- Make the table responsive -->
        <a href="{{ route('payment.create') }}" class="btn btn-success mb-3">Ajouter</a>
        {{-- <a href="{{ route('invoice.print', $payment->id) }}" class="btn btn-info mb-3 float-right">Imprimer Facture</a> --}}
        <a href="" class="btn btn-info mb-3 float-right">Imprimer Facture</a>

        <table class="table table-bordered table-responsive" > <!-- Remove the margin and increase spacing -->
            @php
            use Carbon\Carbon;
            @endphp
            <thead>
                <tr>
                    <th scope="col">Étudiant</th>
                    <th scope="col">Frais Mensuels</th>
                    <th scope="col">Mois de Paiement</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Montant Restant</th>
                    <th scope="col">Type de Paiement</th>
                    <th scope="col">Date de Paiement</th>
                    <th scope="col">Description de Paiement</th>
                    <th scope="col">Caissier</th>
                    <th scope="col">École</th>
                    <th scope="col">Année de Paiement</th>
                    <th scope="col">Temps Écoulé</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                    <td>{{ $payment->student->monthly_fee }} MAD</td>
                    <td>{{ $payment->payment_month }}</td>
                    <td>{{ $payment->amount }} {{ $payment->currency }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->remaining_amount }} {{ $payment->currency }}</td>
                    <td>{{ $payment->payment_type }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->payment_description }}</td>
                    <td>{{ $payment->caissier->first_name }} {{ $payment->caissier->last_name }}</td>
                    <td>{{ $payment->ecole->nom_ecole }}</td>
                    <td>{{ Carbon::parse($payment->ecole->anneeScolaire->start_date)->format('Y') }} / {{ Carbon::parse($payment->ecole->anneeScolaire->end_date)->format('Y') }}</td>
                    <td>
                        <span class="badge badge-success">{{ Carbon::parse($payment->created_at)->diffForHumans() }}</span>
                    </td>

                    <td>
                        <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-primary btn-sm">Voir</a>
                        <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                        <a href="{{ route('factures.show', $payment->id) }}" class="btn btn-info btn-sm">Imprimer</a>
                        {{-- <a href="{{ route('generate-pdf', $payment->id) }}" class="btn btn-info btn-sm">Imprimer</a> --}}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* styles.css */
    .bg-custom {
        background-color: #f0f0f0; /* Set your desired background color here */
        border-radius: 10px; /* Optionally, add rounded corners */
    }
</style>

@endsection
































