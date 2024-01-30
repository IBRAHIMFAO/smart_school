<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Seance;
use App\Models\Attendance;
use App\Models\Group;
use Carbon\Carbon;
use App\Models\Tuteur;
use App\Console\Kernel;

class AttendanceController4 extends Controller
{
    public function store4($code)
    {


        $student = Student::where('codeRFID', $code)->first();
         // If the student doesn't exist, return an error response
         if (!$student) {
            return response()->json(['error' => 'Etudiant        introuvable'], 405); // 404 not found
        }

        $group_id = $student->code_group;


        // Retrieve the current session for the student's group
        $currentSession = Seance::where('code_group', $group_id)
            ->whereDate('date', '=', Carbon::now()->format("Y-m-d"))
            ->where('heure_debut', '<=', date('H:i:s', time()))
            ->where('heure_fin', '>=', date('H:i:s', time()))
            ->first();
// return date('H:i:s', time());
        // If there's no current session, find the next session for the student's group
        if (!$currentSession) {
            $nextSession = Seance::where('code_group', $group_id)
                ->where('date', '>=', Carbon::now()->format('Y-m-d'))
                ->orderBy('date', 'asc')
                ->orderBy('heure_debut', 'asc')
                ->first();

            // If there's no next session, return an error response
            if (!$nextSession) {
                return response()->json(['error' => 'Aucune seance a venir trouvee'], 404);  //No upcoming session found for the students group

                    // return response()->setContent("No upcoming session");


            }

            // Return a success response with the next session information
            return response()->json([ 'next_session' => $nextSession->date
                                                    .' at ' .$nextSession->heure_debut .' fin '.$nextSession->heure_fin], 406);
        // 'success' => true,
        }

            // Check if the student has already been marked present or tardy for the current session
            $attendance = Attendance::where('code_student', $student->id)
            ->where('code_seance', $currentSession->id)
            ->where('date', date('Y-m-d'))
            ->first();

            if ($attendance) {
                // If the attendance record already exists, return an error response
                return response()->json(['error' => 'Vous avez deja  ete enregistre   status :'.$attendance->status], 409);//You have already been registered
            }

        $current_time = Carbon::now();
        $seance_start_time = Carbon::parse($currentSession->heure_debut);
        $minutes_since_seance_start = $current_time->diffInMinutes($seance_start_time, true);


        // Check if the session has started
        // $seance_start_time = Carbon::createFromFormat('Y-m-d H:i:s', $currentSession->date . ' ' . $currentSession->heure_debut);
        // ...$seance_start_time = Carbon::parse($currentSession->heure_debut)->format("H:m:s");
        // $minutes_since_seance_start = Carbon::now()->diffInMinutes($seance_start_time, false);
        // ...$minutes_since_seance_start = date('H:i:s', time()) - date('H:m:s',  $seance_start_time) ;
            // return "start=".$seance_start_time." minutes_since_seance_start ".$minutes_since_seance_start;
        // If the student is present, record the attendance
        if ($minutes_since_seance_start <= 2) {
            $attendance_status = 'present';
            // return "present";
            // return response()->json(['success' => 'present'], 200);

        }
        // If the student is tardy, record the attendance
        else if ($minutes_since_seance_start <= 4) {
            $attendance_status = 'tardy';
            // return "tardy";
            // return response()->json(['MESS' => 'Tardy'], 200);
        }
        //   // If the student is absent, record the attendance for all students in the group
        //   else {
        //     $attendance_status = 'absent';
        //     $this->registerAbsenceForGroup($group_id, $currentSession->id);

        // }



        // Record the attendance for the student
        Attendance::create([
            'code_student' => $student->id,
            'code_seance' => $currentSession->id,
            'date' => date('Y-m-d'),
            'status' => $attendance_status
        ]);

        // Return a success response
        return response()->json(['success' => 'Etudiant est '. $attendance_status],200);
    }


    // fct2
    // public function registerAbsenceForGroup($group_id, $seance_id)
    // {
    //     // Get all the students in the group
    //     $students = Student::where('code_group', $group_id)->get();

    //     // Loop through the students and record absence for those who didn't register for attendance
    //     foreach ($students as $student) {
    //         $attendance = Attendance::where('code_student', $student->id)
    //             ->where('code_seance', $seance_id)
    //             ->first();

    //         if (!$attendance) {
    //             Attendance::create([
    //                 'code_student' => $student->id,
    //                 'code_seance' => $seance_id,
    //                 'date' => date('Y-m-d'),
    //                 'status' => 'absent'
    //             ]);
    //         }
    //     }
    // }

// ###################################################################################################














    // ##########################################################################################

    public function getSessions(){
        $sessions = Seance::all();
        // $students =Attendance::where('code_seance',)->with('student')->get();
        return response()->json($sessions);
    }

    public function show($id){
        $session = Seance::find($id);
        $students=Attendance::where('code_seance', $id)->with('student')->get();

        $data =[
            'session'=>$session,
            'students'=>$students
        ];
        // return response()->json($data);
        return view('show', $data);
    }

}
