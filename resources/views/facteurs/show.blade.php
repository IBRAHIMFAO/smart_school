{{--
@extends('dashboard.master')


@section('content')
<div class="container">
    <div class="invoice">
        <!-- School and Student Information -->
        <div class="row">
            <!-- School Info -->
            <div class="col-md-6">
                <div class="school-info">
                    <img src="{{ asset('storage/' . $ecole->logo) }}" alt="School Logo" width="250px">
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
                        <th>Description</th>
                        <th>Montant ({{ $payment->currency }})</th>
                        <th>Mois de Paiement</th>
                        <th>Type de Paiement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ now()->format('d F Y') }}</td>
                        <td>{{ $payment->payment_description }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->payment_month }}</td>
                        <td>{{ $payment->payment_type }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Total Amount -->
        <div class="total-amount">
            <p><strong>Montant Total: {{ $payment->amount }} {{ $payment->currency }}</strong></p>
        </div>
    </div>
</div>
@endsection --}}

{{--
@extends('dashboard.master')

    @section('content')
    <style>
        /* Facture CSS */
        .invoice {
            border: 1px solid #000;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice h2 {
            margin-top: 0;
        }

        .invoice .row {
            margin: 0 -15px;
        }

        .invoice .school-info,
        .invoice .student-info,
        .invoice .caissier-info {
            padding: 15px;
        }

        .invoice .payment-details {
            padding: 15px;
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
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

        .invoice .total-amount {
            margin-top: 10px;
            text-align: right;
        }

        .invoice .monthly-details {
            margin-top: 10px;
            text-align: right;
        }

        .invoice .signature {
            margin-top: 20px;
        }
    </style>

    <div class="container">
        <div class="card invoice">
            <!-- School and Student Information -->
            <div class="row">
                <!-- School Info -->
                <div class="col-md-6">
                    <div class="school-info">
                        <img src="{{ asset('storage/' . $ecole->logo) }}" alt="School Logo" width="250px">
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

    {{-- ##################################################################################### --}}


{{-- @extends('dashboard.master')
section('content')
    <style>

    @ /* Facture CSS */
        .invoice {
            border: 2px solid #007BFF; /* Border color */
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 800px;
            background-color: #FFF;
            font-family: Arial, sans-serif; /* Font */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice h2 {
            margin-top: 0;
            color: #007BFF; /* Header color */
        }

        .invoice .row {
            margin: 0 -15px;
        }

        .invoice .school-info,
        .invoice .student-info,
        .invoice .caissier-info {
            padding: 15px;
        }

        .invoice .payment-details {
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

    <div class="container">
        <div class="card invoice">
            <!-- School and Student Information -->
            <div class="row">
                <!-- School Info -->
                <div class="col-md-6">
                    <div class="school-info">
                        <img src="{{ asset('storage/' . $ecole->logo) }}" alt="School Logo" width="250px">


                        <h4>{{ $ecole->nom_ecole }}</h4>
                        <p>{{ $ecole->adresse }}</p>
                        <p>Téléphone: {{ $ecole->phone }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="student-info">
                        <h4>Facture N°: {{ $payment->id }}</h4>
                        <p>Date: {{ now()->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Caissier Information -->
                    <div class="caissier-info">
                        <h3>Informations du Caissier</h3>
                        <p>Nom du Caissier: {{ $caissier->first_name }} {{ $caissier->last_name }}</p>
                    </div>
                </div>

                <!-- Student Info -->
                <div class="col-md-6" style="margin-top: 20%">
                    <div class="student-info">
                        <h3>Informations de l'Élève</h3>
                        <p>Nom de l'Élève: {{ $student->first_name }} {{ $student->last_name }}</p>
                        <p>CNE de l'Élève: {{ $student->cne }}</p>
                        <p>Adresse de l'Élève: {{ $student->address }}</p>
                    </div>
                </div>
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


    <div class="text-center mt-4">

        <div class="text-center mt-4">
            <a href="{{ route('generate-pdf', ['paymentId' => $payment->id]) }}" class="btn btn-primary">Télécharger PDF</a>
        </div>


    </div>



@endsection --}}


    {{-- ##################################################################################### --}}

    {{--
@extends('dashboard.master')

@section('content')
    <style>
        /* Invoice CSS */
        .invoice {
            border: 5px solid #000;
            padding: 20px;
            border-radius: 0;
            max-width: 800px;
            background-color: #FFF;
            font-family: Arial, sans-serif;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
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
        .invoice .caissier-info {
            padding: 15px;
        }

        .invoice .payment-details {
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

        .invoice h4 {
            font-weight: bold;
        }

        .invoice .col-md-6 {
            margin-bottom: 15px;
        }

        .student-info {
            margin-top: 10%;
        }
    </style>

    <div class="container">
        <div class="card invoice">
            <div class="invoice-header">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-center fw-bold">Facture de Paiement</h2>
                    </div>
                    <div class="col-md-6 text-end">
                        <p class="fw-bold text-dark">N° Facture: B00 {{ $payment->id }}</p>
                        <p class="fw-bold text-dark">Date: {{ now()->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="school-info">
                        <img src="{{ asset('storage/' . $ecole->logo) }}" alt="School Logo" width="250px">
                        <h4 class="text-dark">{{ $ecole->nom_ecole }}</h4>
                        <p>{{ $ecole->adresse }}</p>
                        <p>Téléphone: {{ $ecole->phone }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="student-info">
                        <h4>Informations de l'Élève</h4>
                        <p>Nom de l'Élève: {{ $student->first_name }} {{ $student->last_name }}</p>
                        <p>CNE de l'Élève: {{ $student->cne }}</p>
                        <p>Adresse de l'Élève: {{ $student->address }}</p>
                    </div>
                </div>
            </div>

            <div class="caissier-info">
                <h4>Informations du Caissier</h4>
                <p>Nom du Caissier: {{ $caissier->first_name }} {{ $caissier->last_name }}</p>
            </div>

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

            <div class="total-amount">
                <p><strong>Montant Total: {{ $payment->amount }} {{ $payment->currency }}</strong></p>
            </div>

            <div class="monthly-details">
                <p><strong>Frais Mensuels (Montant Mensuel): {{ $student->monthly_fee }} {{ $payment->currency }}</strong></p>
                <p><strong>Paiement : {{ $payment->amount }} {{ $payment->currency }}</strong></p>
                <p><strong>Montant Restant : {{ $payment->remaining_amount }} {{ $payment->currency }}</strong></p>
            </div>

            <div class="signature">
                <p>Signature du Tuteur: _______________________________</p>
                <p>Signature du Caissier: ______________________________</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('generate-pdf', ['paymentId' => $payment->id]) }}" class="btn btn-primary" id="downloadBtn">Télécharger le PDF</a>
    </div>

    <script>
        // Add JavaScript to handle the download button click event
        const downloadBtn = document.getElementById('downloadBtn');
        downloadBtn.addEventListener('click', () => {
            // Implement your PDF download logic here
            alert('Downloading PDF...');
        });
    </script>

@endsection --}}

    {{-- ################################################################################## --}}
    {{--
@extends('dashboard.master')

@section('content')
        <style>
            /* Invoice CSS */
            .invoice {
                border: 5px solid #000;
                /* padding: 20px; */
                border-radius: 0;
                max-width: 800px;
                background-color: #FFF;
                font-family: Arial, sans-serif;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                /* margin: 20px auto; */
            }



            .invoice h2 {
                margin-top: 0;
                color: #007BFF;
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
                /* padding: 15px; */
            }

            .invoice table {
                width: 100%;
                border-collapse: collapse;
                /* margin-top: 20px; */
            }

            .invoice table th,
            .invoice table td {
                border: 1px solid #ddd;
                /* padding: 8px; */
                text-align: left;
            }

            .invoice table th {
                background-color: #f5f5f5;
            }

            .invoice .total-amount,
            .invoice .monthly-details {
                /* margin-top: 10px; */
                text-align: right;
            }

            .invoice .signature {
                /* margin-top: 20px; */
            }

            /* Apply text-dark to all text and make font sizes consistent */
            .invoice h4, .invoice p, .invoice strong {
                color: #343a40 !important;
                font-size: 16px;
            }

            .invoice th, .invoice td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
                font-size: 14px;
            }

            .invoice h3 {
                font-size: 18px;
            }

            .invoice img {
                max-width: 100%;
            }
        </style>

        <div class="container">
            <div class="card invoice">
                <div class="invoice-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-center fw-bold">Facture de Paiement</h2>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="fw-bold text-dark">N° Facture: B00 {{ $payment->id }}</p>
                            <p class="fw-bold text-dark">Date: {{ now()->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>


                <img src="{{ asset('storage/' . $ecole->logo) }}" alt="School Logo" width="200px">
                <div class="row">
                    <div class="col-md-6">
                        <div class="school-info">
                            <h4 class="fw-bold">{{ $ecole->nom_ecole }}</h4>
                            <p>{{ $ecole->adresse }}</p>
                            <p>Téléphone: {{ $ecole->phone }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="student-info">
                            <h4 class="fw-bold" >Informations de l'Élève </h4>
                            <p><strong>Nom de l'Élève :</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                            <p><strong>CNE de l'Élève :</strong> {{ $student->cne }}</p>
                            <p><strong>Adresse de l'Élève :</strong> {{ $student->address }}</p>
                        </div>
                    </div>
                </div>

                <div class="caissier-info">
                    <h4 class="fw-bold" >Informations du Caissier</h4>
                    <p><strong>Nom :</strong> {{ $caissier->first_name }} {{ $caissier->last_name }}</p>
                </div>

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


                <div class="row">
                    <div class="col-md-6">
                        <div class="monthly-details ">
                            <table class="text-end" style="border: 1px solid #000;">
                                <tr>
                                    <td>
                                        <p><strong>Frais Mensuels: {{ $student->monthly_fee }} {{ $payment->currency }}</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><strong>Paiement : {{ $payment->amount }} {{ $payment->currency }}</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><strong>Montant Restant : {{ $payment->remaining_amount }} {{ $payment->currency }}</strong></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="signature text-end">
                    <p>Signature : .  .  .  .  .  .  .  .  .  .  .  .  .  .  .  .  .</p>

                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('generate-pdf', ['paymentId' => $payment->id]) }}" class="btn btn-primary" id="downloadBtn">Télécharger le PDF</a>
        </div>

        <script>
            // Add JavaScript to handle the download button click event
            const downloadBtn = document.getElementById('downloadBtn');
            downloadBtn.addEventListener('click', () => {
                // Implement your PDF download logic here
                alert('Downloading PDF...');
            });
        </script>

@endsection --}}




@extends('dashboard.master')

@section('content')
<style>
    /* Invoice CSS */
    .invoice {
        border: 5px solid #000;
        border-radius: 0;
        /* max-width: 800px; */
        /* max-width: 1100px; */
        /* max-width: 100%; */
        max-width: 794px !important;
        background-color: #FFF;
        font-family: Arial, sans-serif;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        padding: 35px;
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        /* margin-top: 20px; */
    }

    .invoice table th,
    .invoice table td {
        border: 1px solid #ddd;
        /* padding: 8px; */
        text-align: left;
    }

    .invoice table th {
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
    .invoice h4, .invoice p, .invoice strong {
        color: #3a4034 !important;
        font-size: 16px;
    }

    .invoice th, .invoice td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        font-size: 14px;
    }

    .invoice h3 {
        font-size: 18px;
    }

    .invoice img {
        max-width: 100%;
    }
</style>

<div class="container" >
    <div class="card invoice"  style="padding: 03%">
        <div class="invoice-header">
            <div class="row">
                <div class="col-md-4 text-start">
                    <p class="fw-bold text-dark">N° Facture: B00 {{ $payment->id }}</p>
            </div>
            <div class="col-md-4">
                <h2 class="text-center fw-bold">Facture de Paiement</h2>
            </div>
            <div class="col-md-4 text-end">
                <p class="fw-bold text-dark">Date: {{ now()->format('d F Y') }}</p>
            </div>
        </div>

        <!-- École et Adresse de l'Élève -->
        <div class="invoice-info row">
            <div class="col-md-6">
                <div class="school-info">
                    <img src="{{ asset('storage/' . $ecole->logo) }}" alt="School Logo" width="200px">
                    <h4 class="fw-bold">{{ $ecole->nom_ecole }}</h4>
                    {{-- <p><strong>Adresse : <br> </strong>  {!! nl2br(e($ecole->adresse)) !!}</p> --}}
                    <p><strong>Adresse : <br> </strong>  {!! $formatAdressEcole !!}</p>
                    <p><strong> Tel :</strong> {{ $ecole->phone }}</p>
                    <p><strong>Email : </strong> {{ $ecole->email }} </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="student-info" style="margin-top: 20%">
                    <h4 class="fw-bold">Informations de l'Élève</h4>
                    <p><strong>Nom :</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                    <p><strong>CNE :</strong> {{ $student->cne }}</p>
                    {{-- <p><strong>Adresse  :</strong><br>{!! nl2br(e($student->address)) !!}</p> --}}
                    <p><strong>Adresse :</strong><br>{!! $formatAdressStudent !!}</p>
                </div>
            </div>
        </div>

        <div class="caissier-info">
            <h4 class="fw-bold">Informations du Caissier</h4>
            <p><strong>Nom :</strong> {{ $caissier->first_name }} {{ $caissier->last_name }}</p>
        </div>



        <div class="payment-details">
            <h3 class="fw-bold">Détails du Paiement</h3>
            <table class="table">
                <thead >
                    <tr>
                        <th class="text-center">Date</th>
                        <th class="text-center">Montant ({{ $payment->currency }})</th>
                        <th class="text-center">Mois de Paiement</th>
                        <th class="text-center">Type de Paiement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ now()->format('d F Y') }}</td>
                        <td class="text-center">{{ $payment->amount }}</td>
                        <td class="text-center">{{ $payment->payment_month }}</td>
                        <td class="text-center">{{ $payment->payment_type }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="monthly-details">
            <p><strong>Frais Mensuels: {{ $student->monthly_fee }} {{ $payment->currency }}</strong></p>
            <p><strong>Paiement : {{ $payment->amount }} {{ $payment->currency }}</strong></p>
            <p><strong>Montant Restant : {{ $payment->remaining_amount }} {{ $payment->currency }}</strong></p>
        </div>

        {{-- <div class="signature text-end" style="margin: 05% 10%"> --}}
            <div class="signature" style="margin: 05% 10%">
            <p>Signature : .  .  .  .  .  .  .  .  .  .  .  .  .  .  .  .  .</p>
        </div>
    </div>
</div>

</div>


<div class="text-center mt-4">
    {{-- <a href="{{ route('generate-pdf', ['paymentId' => $payment->id]) }}" class="btn btn-primary" id="downloadBtn">Télécharger le PDF</a> --}}
    <a href="{{ route('generate-pdf', ['paymentId' => $payment->id, 'lang' => 'fr']) }}" class="btn btn-primary">Télécharger le PDF (Français)</a>
    <a href="{{ route('generate-pdf', ['paymentId' => $payment->id, 'lang' => 'ar']) }}" class="btn btn-primary">تحميل ملف PDF (العربية)</a>

</div>





<script>
    // Fonction pour télécharger le PDF
    function downloadPDF() {
        // Ici, vous pouvez implémenter la logique de téléchargement du PDF
        alert('Téléchargement du PDF en cours...');
    }

    // Attachez l'événement de clic au bouton de téléchargement
    const downloadBtn = document.getElementById('downloadBtn');
    downloadBtn.addEventListener('click', downloadPDF);
</script>
@endsection
