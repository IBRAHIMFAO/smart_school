<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Seance;
use App\Models\Attendance;
use App\Models\Group;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function store($code)
    {
        $student = Student::where('codeRFID', $code)->first();

        // If the student doesn't exist, return an error response
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        // Retrieve the current session for the student's group
        $currentSession = Seance::where('code_group', $student->code_group)
            // ->whereDate('date', '=', Carbon::now()->toDateString())
            ->where('heure_debut', '<=', Carbon::now())
            ->where('heure_fin', '>=', Carbon::now())
            ->first();

        // If there's no current session, find the next session for the student's group
        if (!$currentSession) {
            $nextSession = Seance::where('code_group', $student->code_group)
                // ->where('heure_debut', '>', Carbon::now())
                ->where('date', '>', Carbon::now()->format('Y-m-d'))

                ->orderBy('date', 'asc')
                ->orderBy('heure_debut', 'asc')
                // ->get()
                ->first();

            // If there's no next session, return an error response
            if (!$nextSession) {
                return response()->json(['error' => 'No upcoming session found for the student\'s group'], 404);
            }

            // Return a success response with the next session information
            return response()->json(['success' => true, 'next_session' => $nextSession->date
                                                    .'at' .$nextSession-> heure_debut .'fin'.$nextSession->heure_fin]);

        }

        // Check if the student has already attended the current session
        $attendance = Attendance::where('code_student', $student->id)
            ->where('code_seance', $currentSession->id)
            ->first();

        // If the student has already attended, return a success response with the attendance record
        if ($attendance) {
            return response()->json(['success' => true, 'attendance' => $attendance]);
        }

        // If the student hasn't attended, create a new attendance record
        $attendance = new Attendance;
        $attendance->code_seance = $currentSession->id;
        $attendance->code_student = $student->id;
        $attendance->status = 'present';
        $attendance->date = date('Y-m-d');
        $attendance->created_at = Carbon::now();
        $attendance->updated_at = Carbon::now();
        $attendance->save();

        // Return a success response with the new attendance record
        return response()->json(['success' => true, 'attendance' => $attendance]);
}
}
