<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Student;
use App\Models\Caissier;
use App\Models\Ecole;
use App\Models\Payment;



class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // public function index()
    // {
    //     $payments = Payment::with(['student', 'caissier', 'ecole'])->get();
    //     return view('payments.index', compact('payments'));
    // }

    public function index()
    {
        // Fetch payments and order them by the creation date in descending order
        $payments = Payment::with('student') // Load the student relationship
            ->orderBy('created_at', 'desc')
            ->get();

        return view('payments.index', ['payments' => $payments]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $caissiers = Caissier::all();
        $ecoles = Ecole::with('anneeScolaire')->get();
        return view('payments.create', compact('students', 'caissiers', 'ecoles'));
    }
        // $ecoles = Ecole::with('student.niveauxscolaire.filiere.departement.ecole.anneeScolaire')->get();

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         try {
             // Validate the form data
             $validatedData = $request->validate([
                 'payment_year' => 'required',
                 'payment_month' => 'required',
                 'amount' => 'required|numeric',
                 'currency' => 'required',
                 'status' => 'required',
                 'payment_type' => 'required',
                 'payment_date' => 'required|date',
                 'payment_description' => 'nullable',
                 'remaining_amount' => 'nullable|numeric',
                 'code_caissier' => 'required|exists:caissiers,id', // Validate the Caissier ID exists in the 'caissiers' table
                 'student_id' => 'required|exists:students,id', // Make sure the student ID exists in the 'students' table
                 'code_ecole' => 'required|exists:ecoles,id',

             ]);

             // Get the student's ID based on your implementation (e.g., from the input search)

             // Create a new Payment instance with the validated data
             $payment = new Payment([
                 'payment_year' => $validatedData['payment_year'],
                 'payment_month' => $validatedData['payment_month'],
                 'amount' => $validatedData['amount'],
                 'currency' => $validatedData['currency'],
                 'status' => $validatedData['status'],
                 'payment_type' => $validatedData['payment_type'],
                 'payment_date' => $validatedData['payment_date'],
                 'payment_description' => $validatedData['payment_description'],
                //  'remaining_amount' => $validatedData['remaining_amount'],
                'remaining_amount' => empty($validatedData['remaining_amount']) ? 0 : $validatedData['remaining_amount'],
                //  'code_student' => $studentId, // Replace with the actual student ID retrieval  studentId = data.id;
                'code_caissier' => $validatedData['code_caissier'],
                'code_student' => $validatedData['student_id'],
                'code_ecole' => $validatedData['code_ecole'], // Include the ecole field

            ]);

             // Save the Payment instance to the database
             $payment->save();

             // Redirect to a success page with a success message
             return redirect()->route('payment.index')->with('success', 'Payment created successfully');
         } catch (\Exception $e) {
             // Handle any exceptions that may occur during the payment creation
             return redirect()->back()->with('error', 'Failed to create payment: ' . $e->getMessage())->withInput();
         }
     }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the payment record with the given ID
        $payment = Payment::findOrFail($id);

        // Return the view with the payment data
        return view('payments.show', compact('payment'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  public function edit($id)
    // {
    //     // Find the payment record by its ID
    //     $payment = Payment::findOrFail($id);

    //     // You may need to load related data like students, caissiers, and ecoles if not eager-loaded

    //     // Load related data if not eager-loaded
    //     $payment->load('student', 'caissier', 'ecole');

    //     // Return the edit view with the payment record
    //     return view('payments.edit', compact('payment'));
    // }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id); // Fetch the payment record by ID
        $caissiers = Caissier::all(); // Replace with your Caissier model and query
        $ecoles = Ecole::all(); // Replace with your Ecole model and query

        return view('payments.edit', compact('payment', 'caissiers', 'ecoles'));
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
         try {
             // Validate the form data, similar to your store function
             $validatedData = $request->validate([
                 'payment_year' => 'required',
                 'payment_month' => 'required',
                 'amount' => 'required|numeric',
                 'currency' => 'required',
                 'status' => 'required',
                 'payment_type' => 'required',
                 'payment_date' => 'required|date',
                 'payment_description' => 'nullable',
                 'remaining_amount' => 'nullable|numeric',
                 'student_id' => 'required|exists:students,id',
                 'code_caissier' => 'required|exists:caissiers,id', // Add validation for caissier
                 'code_ecole' => 'required|exists:ecoles,id', // Add validation for ecole
             ]);

             // Find the payment by ID
             $payment = Payment::findOrFail($id);

             // Update the payment with the validated data
            $payment->update([
                'payment_year' => $validatedData['payment_year'],
                'payment_month' => $validatedData['payment_month'],
                'amount' => $validatedData['amount'],
                'currency' => $validatedData['currency'],
                'status' => $validatedData['status'],
                'payment_type' => $validatedData['payment_type'],
                'payment_date' => $validatedData['payment_date'],
                'payment_description' => $validatedData['payment_description'],
                 'remaining_amount' => empty($validatedData['remaining_amount']) ? 0 : $validatedData['remaining_amount'], // Update the remaining_amount
                'code_student' => $validatedData['student_id'] ,
                'code_caissier' => $validatedData['code_caissier'],
                'code_ecole' => $validatedData['code_ecole'],
            ]);

             // Redirect to a success page with a success message
             return redirect()->route('payment.index')->with('success', 'Payment updated successfully');
        } catch (\Exception $e) {
             // Handle any exceptions that may occur during the payment update
             return redirect()->back()->with('error', 'Failed to update payment: ' . $e->getMessage())->withInput();
        }
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


     /**
     * Search for a student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     // Recherche d'un étudiant in page create.blade.php (Filter students by name, CIN, CNE, or group)
        public function search(Request $request)
    {
         $search = $request->input('search');

         $students = Student::where('first_name', 'like', "%$search%")
             ->orWhere('last_name', 'like', "%$search%")
             ->orWhere('cin', 'like', "%$search%")
             ->orWhere('cne', 'like', "%$search%")
             ->get();

         return response()->json($students);
    }


    //  hiya bach khdam f form create
     public function getByCNE($cne)
        {
            //  $student = Student::where('cne', $cne)->first();
            $student = Student::where('cne', $cne)
            ->with('group.niveauxscolaire')
            ->first();

            if ($student) {
                $student->id;
                return response()->json($student);
            }

            return response()->json(['error' => 'Étudiant non trouvé'], 404);
        }




    }
