<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Group;
use App\Models\Tuteur;

use Illuminate\Http\Request;

class dashStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::all();
        $groups  =Group::all();
        $tuteurs = Tuteur::all();


        return view ('students-dash.index', compact('students','groups','tuteurs'));
    }

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
    public function show(Request $request)
    {

        $studentId = $request->route('studentId');

        // Get the student details from the database
        $student = Student::find($studentId);
        // Récupérez l'étudiant en fonction de l'ID
        // $student = Student::find($id);

        // Vérifiez si l'étudiant existe
        if (!$student) {
            // Gérez le cas où l'étudiant n'est pas trouvé (par exemple, renvoyez une réponse 404)
            abort(404);
        }

        // Retournez une vue partielle contenant les détails de l'étudiant au format JSON
        return response()->json([
            'img_url' => asset('storage/' . $student->user->img),
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'birthdate' => $student->birthdate,
            'group' => [
                'nom_group' => $student->group->nom_group,
                'niveauxscolaire' => [
                    'label' => $student->group->niveauxscolaire->label,
                ],
            ],
        ]);
    }

    public function getStudentDetails($id)
    {
        // Retrieve the student details by ID
        $student = Student::find($id);

        // Check if the student was found
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        // Return the student details as JSON
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $groups = Group::all(); // Fetch all groups from the database

        return view('students-dash.edit', compact('student', 'groups'));
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
        $student = Student::findOrFail($id);

        $student->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'group_id' => $request->input('group_id'),
            'codeRFID' => $request->input('codeRFID'),
        ]);

        // Update tuteur information if provided
        if ($student->tuteur) {
            $student->tuteur->update([
                'firstName' => $request->input('tuteur_firstName'),
                'lastName' => $request->input('tuteur_lastName'),
                'numero_tel' => $request->input('tuteur_numero_tel'),
            ]);
        }

        return redirect()->route('dash-student.index')->with('success', 'Étudiant modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('dash-student.index')->with('success', 'Étudiant supprimé avec succès');
    }

   










}
