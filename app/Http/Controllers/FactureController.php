<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Ecole;
use Illuminate\Support\Facades\View;
// use Illuminate\Support\Facades\PDF;
use App\Models\Facture;
use Illuminate\Support\Str; // Import the Str class
use PDF;
use Illuminate\Support\Facades\Storage;


class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $factures = Facture::all();

    //     return view('factures.index', compact('factures'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



     public function show($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $ecole = $payment->ecole;
        $student = $payment->student;
         $caissier = $payment->caissier;

         // Call the splitAddress function to format the student's address
        $formatAdressStudent = $this->splitAddress($student->address);
        $formatAdressEcole = $this->splitAddress($ecole->adresse);

         return view('facteurs.show', compact('ecole', 'student', 'caissier', 'payment', 'formatAdressStudent', 'formatAdressEcole'));
     }



    public function generatePdf($paymentId, $lang)
    {
        // Définir la langue de l'application en fonction de $lang (par exemple, 'ar' ou 'en')
        app()->setLocale($lang);

        // ini_set('max_execution_time', 300);
        $payment = Payment::findOrFail($paymentId);
        $ecole = $payment->ecole;
        $student = $payment->student;
        $caissier = $payment->caissier;

          // Call the splitAddress function to format the student's address
        $formatAdressStudent = $this->splitAddress($student->address);
        $formatAdressEcole = $this->splitAddress($ecole->adresse);

###################################################################################################"
            // $path =base_path('http://127.0.0.1:8000/storage/logos/JMVtVlQjWnSJPxxMgxCEdRFW0I19EDCuzx1h1ANa.png');
            // $type= pathinfo($path ,PATHINFO_EXTENSION);
            // $data =file_get_contents($path);
            // $pic = 'data:image/'.$type.';base64,' .base64_encode($data);

            // $pic = ''; // Initialize $pic with an empty string
            // $data = ''; // Initialize $data with an empty string


            // $path = public_path('storage/' . $ecole->logo);

            // if (file_exists($path)) {
            //     $type = pathinfo($path, PATHINFO_EXTENSION);

            //     $data = file_get_contents($path);

            //     $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // }
            
            // Set $pic to the base64-encoded image data
            $pic = 'data:image/png;base64,' . base64_encode(Storage::get($ecole->logo));

            // Add this line to ensure that $pic is always defined
            // $pic = $pic ?? '';
            


        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('facteurs.pdf', compact('ecole', 'student', 'caissier', 'payment' , 'pic', 'formatAdressStudent', 'formatAdressEcole'))
                // ->setOptions(['defaultFont' => 'sans-serif']);
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true,

                ]);
                // ->setFont('Arial');
                // ->setPaper([0, 0, 940, 1005], 'landscape'); // Adjust width (340) as needed


        return $pdf->stream($payment->student->last_name . '.pdf');

    }


    //     public function splitAddress($address, $maxLength = 20)
    // {
    //     // Use Laravel's Str::limit function to split the address
    //     return Str::limit($address, $maxLength, '<br>');
    // }

    public function splitAddress($address, $maxCharactersPerLine = 26)
    {
        $words = explode(' ', $address);
        $lines = [];
        $currentLine = '';

        foreach ($words as $word) {
            if (mb_strlen($currentLine . ' ' . $word) <= $maxCharactersPerLine) {
                $currentLine .= ' ' . $word;
            } else {
                $lines[] = trim($currentLine);
                $currentLine = $word;
            }
        }

        if (!empty($currentLine)) {
            $lines[] = trim($currentLine);
        }

        return implode('<br>', $lines);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}



