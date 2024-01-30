@extends('dashboard.pdf')
{{--
@section('content')
<style>
    /* Custom CSS for rectangular invoice */
    .invoice {
        border: 2px solid #007BFF;
        padding: 20px;
        border-radius: 10px;
        max-width: 800px; /* Adjust the maximum width as needed */
        background-color: #FFF;
        font-family: Arial, sans-serif;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .invoice h2 {
        margin-top: 0;
        color: #007BFF;
    }

    .invoice .row {
        margin: 0 -15px;
    }

    .invoice .school-info,
    .invoice .student-info,
    .invoice .caissier-info,
    .invoice .payment-details,
    .invoice .description,
    .invoice .total-amount,
    .invoice .monthly-details,
    .invoice .signature {
        padding: 15px;
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .invoice table th,
    .invoice table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .invoice table th {
        background-color: #f5f5f5;
    }

    .invoice .total-amount,
    .invoice .monthly-details {
        margin-top: 10px;
        text-align: right;
    }

    .invoice .signature {
        margin-top: 20px;
    }
</style>

<div class="invoice">
    <!-- School and Student Information -->
    <div class="row">
        <!-- School Info -->
        <div class="col-md-6">
            <div class="school-info">


               <img src="{{ $pic }}" alt="School Logo" width="200px">

                <h2>{{ $ecole->nom_ecole }}</h2>
                <p>{{ $ecole->adresse }}</p>
                <p>Téléphone: {{ $ecole->phone }}</p>
            </div>
        </div>
        <!-- Student Info -->
        <div class="col-md-6">
            <div class="student-info">
                <h3>Informations de l'Élève</h3>
                <p>Nom de l'Élève: {{ $student->first_name }} {{ $student->last_name }}</p>
                <p>CNE de l'Élève: {{ $student->cne }}</p>
                <p>Adresse de l'Élève: {{ $student->address }}</p>
            </div>
        </div>
    </div>

    <!-- Caissier Information -->
    <div class="caissier-info">
        <h3>Informations du Caissier</h3>
        <p>Nom du Caissier: {{ $caissier->first_name }} {{ $caissier->last_name }}</p>
    </div>

    <!-- Payment Details -->
    <div class="payment-details">
        <h3>Détails du Paiement</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant ({{ $payment->currency }})</th>
                    <th>Mois de Paiement</th>
                    <th>Type de Paiement</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ now()->format('d F Y') }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->payment_month }}</td>
                    <td>{{ $payment->payment_type }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Description -->
    <div class="description">
        <h3>Description</h3>
        <p>{{ $payment->payment_description }}</p>
    </div>

    <!-- Total Amount -->
    <div class="total-amount">
        <p><strong>Montant Total: {{ $payment->amount }} {{ $payment->currency }}</strong></p>
    </div>

    <!-- Monthly Fee, Payment, Remaining Amount -->
    <div class="monthly-details">
        <p><strong>Frais Mensuels (Monthly Fee): {{ $student->monthly_fee }} {{ $payment->currency }}</strong></p>
        <p><strong>Paiement : {{ $payment->amount }} {{ $payment->currency }}</strong></p>
        <p><strong>Montant Restant : {{ $payment->remaining_amount }} {{ $payment->currency }}</strong></p>
    </div>

    <!-- Signature Area -->
    <div class="signature">
        <p>Signature de l'Élève: _______________________________________</p>
        <p>Signature du Caissier: _____________________________________</p>
    </div>
</div>
</div>
@endsection --}}




@section('content')


<style>
    /* Invoice CSS */
    .invoice {
        border: 1px solid #101011;
        border-radius: 0;
        max-width: 794px; /* Adjust this width as needed for A4 or your preferred page size */
        background-color: #FFF;
        font-family: Arial, sans-serif;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 0 auto; /* Center the invoice on the page */
    }

    .invoice h2 {
        margin-top: 0;
        color: #007BFF;
        font-size: 20px;
    }

    .invoice .row {
        /* margin: 0 -15px; */
    }

    .invoice .school-info,
    .invoice .student-info,
    .invoice .caissier-info {
        /* padding: 15px; */
    }

    .invoice .payment-details {
        /* padding: 35px; */
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        /* margin-top: 20px; */
    }

    /* .invoice table th,
    .invoice table td */
    .invoice .table-payment table th,
    .invoice .table-payment table td
     {
        border: 1px solid #ddd;
        padding: 3px;
        text-align: left;
    }

    .invoice .table-payment th {
        background-color: #f5f5f5;
    }

    .invoice .total-amount,
    .invoice .monthly-details {
        /* margin-top: 10px; */
        /* text-align: right; */
        /* padding-right: 30%; */
        margin-left: 65%;
    }

    .invoice .signature {
        /* margin-top: 20px; */
    }

    /* Apply text-dark to all text and make font sizes consistent */
    /* .invoice h4, .invoice p, .invoice strong {
        color: #3a4034 !important;
        font-size: 16px;
    } */
    .invoice h4, {
        color: #3a4034 !important;
        font-size: 14px;
    }
    .invoice strong {
        color: #040403 !important;
        font-size: 13px;
    }

    .invoice  th, .invoice td {
        /* padding: 8px; */
        text-align: left;
        font-size: 14px;
    }

    .invoice .table-payment th, .invoice .table-payment td {
        border: 1px solid #ddd;
        /* padding: 8px; */
        text-align: left;
        font-size: 14px;
    }

    .invoice h3 {
        font-size: 14px;
        color: #000;
    }
</style>

<div class="container">

    <div class="card invoice" style="padding: 2%">

        <div class="invoice-header">
                <table style="margin-bottom: 15px">
                    <tr style="border: 1px solid #050505">
                        <td class="text-center fw-bold">N° Facture: B00 {{ $payment->id }}</td>
                        <td class="text-center fw-bold">Facture de Paiement</td>
                        <td class="text-center fw-bold">Date: {{ now()->format('d F Y') }}</td>
                    </tr>
                </table>
        </div>

        <img src="{{ $pic }}" alt="School Logo" width="200px">
        <table style="margin-top: 15px">
            <thead>
                <tr>
                    <th class="text-center fw-bold">{{ $ecole->nom_ecole }} </th>
                    <th class="text-center fw-bold">Informations de l'Élève </th>
                </tr>
            </thead>
            <tbody style="padding-top: 0px">
                <tr>
                    <td>

                            <div class="school-info">
                                <p><strong>Adresse :</strong><br>{!! $formatAdressEcole !!}</p>
                                <p><strong> Tel : </strong>{{ $ecole->phone }}</p>
                                <p><strong>Email : </strong>{{ $ecole->email }} </p>
                            </div>
                    </td>
                    <td>
                            <div class="student-info" >
                                <p><strong>Nom :</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                                <p><strong>CNE :</strong> {{ $student->cne }}</p>
                                <p><strong>Adresse :</strong><br>{!! $formatAdressStudent !!}</p>
                            </div>
                    </td>
                </tr>
            </tbody>
        </table>


        <table>
            <thead>
                <tr>
                    <th class="text-center fw-bold"> Informations du Caissier :</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="caissier-info">
                            <p><strong>Nom :</strong> {{ $caissier->first_name }} {{ $caissier->last_name }}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>





        <div class="payment-details">
            <h3 class="fw-bold">Détails du Paiement :</h3>
                <div class="table-payment">
                    <table class="table ">
                        <thead >
                            <tr>
                                <th class="text-center">Description :</th>
                                <th class="text-center">Montant ({{ $payment->currency }})</th>
                                <th class="text-center">Mois de Paiement</th>
                                <th class="text-center">Type de Paiement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $payment->payment_description }}</td>
                                <td class="text-center">{{ $payment->amount }}</td>
                                <td class="text-center">{{ $payment->payment_month }}</td>
                                <td class="text-center">{{ $payment->payment_type }}
                                </td>
                            </tr>
                            </tbody>
                    </table >
                    <table  style="width: 50%;margin-top:8px ;margin-left:50%">
                            <tr>
                                <td >Frais Mensuels:</td>
                                <td >{{ $student->monthly_fee }} {{ $payment->currency }}</td>
                            </tr>
                            <tr>
                                <td >Paiement :</td>
                                <td >{{ $payment->amount }} {{ $payment->currency }}</td>
                            </tr>
                            <tr>
                                <td >Montant Restant :</td>
                                <td >{{ $payment->remaining_amount }} {{ $payment->currency }}</td>
                            </tr>
                    </table>
                </div>
            </div>

        {{-- <div class="monthly-details">
            <p><strong>Frais Mensuels: {{ $student->monthly_fee }} {{ $payment->currency }}</strong></p>
            <p><strong>Paiement : {{ $payment->amount }} {{ $payment->currency }}</strong></p>
            <p><strong>Montant Restant : {{ $payment->remaining_amount }} {{ $payment->currency }}</strong></p>
        </div> --}}

        <div class="signature" style="margin: 5% ">
            <p > Signature :</p>
            <p style="margin-left: 10%">.      .  .  .  .  .  .  .  .  .</p>
        </div>
    </div>
</div>

</div>


@endsection






{{--
<!-- Mettez ici la structure de votre facture PDF en fonction de la langue choisie -->
@if ($lang === 'fr')
    <!-- Contenu en Français -->
@elseif ($lang === 'ar')
    <!-- Contenu en Arabe -->
@endif --}}
