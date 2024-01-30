<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Seance;
use App\Models\Attendance;
use App\Models\Group;
use Carbon\Carbon;

class AttendanceController3 extends Controller
{

    public function store3($code)
    {
        $student = Student::where('codeRFID', $code)->first();
        $group_id=$student->code_group;
        // If the student doesn't exist, return an error response
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

    // Retrieve the current session for the student's group
    $currentSession = Seance::where('code_group', $group_id)
        ->whereDate('date', '=', Carbon::now()->toDateString())
        ->where('heure_debut', '<=', Carbon::now())
        ->where('heure_fin', '>=', Carbon::now())
        ->first();

    // If there's no current session, find the next session for the student's group
    if (!$currentSession) {
        $nextSession = Seance::where('code_group', $group_id)
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->orderBy('heure_debut', 'asc')
            ->first();

        // If there's no next session, return an error response
        if (!$nextSession) {
            return response()->json(['error' => 'No upcoming session found for the student\'s group'], 404);
        }

        // Return a success response with the next session information
        return response()->json(['success' => true, 'next_session' => $nextSession->date
                                                .'at' .$nextSession-> heure_debut .'fin'.$nextSession->heure_fin]);

    }

    // Check if the session has started
    $seance_start_time = Carbon::createFromFormat('Y-m-d H:i:s', $currentSession->date . ' ' . $currentSession->heure_debut);
    $minutes_since_seance_start = Carbon::now()->diffInMinutes($seance_start_time, true);
    //    return $minutes_since_seance_start ;
    // If the student is present, record the attendance
    if ($minutes_since_seance_start <= 2) {
        $attendance_status = 'present';
    }
    // If the student is tardy, record the attendance
    else if ($minutes_since_seance_start <= 4) {
        $attendance_status = 'tardy';

    }
    // If the student is absent, record the attendance for all students in the group
    else {
        $attendance_status = 'absent';
        // $group = Group::find($group_id);
        // $students = Student::where('code_group','$group_id');
        $students=Student::where($currentSession->seance,'code_group')->get();
          return $students ;
        // $attendance = Attendance::where('code_student', $student->id)
        //     ->where('code_seance', $currentSession->id)
        //     ->first();
        foreach ($students as $s) {
            Attendance::create([
                'code_student' => $s->id,
                'code_seance' => $currentSession->id,
                'date'=>date('Y-m-d'),
                'status' => 'absent'
            ]);
        }
    }

    // Record the attendance for the student
    Attendance::create([
        'code_student' => $student->id,
        'code_seance' => $currentSession->id,
         'date'=>date('Y-m-d'),
        'status' => $attendance_status
    ]);



    // Return a success response
    return response()->json(['success' => 'student is  '. $attendance_status]);




// ####################################################################
    //  // Get all the students in the current session's group
    // $students = Student::where('code_group', $group_id)->get();

    //  // Iterate through the students and create attendance records if necessary
    // foreach ($students as $s) {
    //      // Check if the student has already attended the current session
    //      $attendance = Attendance::where('code_student', $s->id)
    //         ->where('code_seance', $currentSession->id)
    //         ->first();

    //      // If the student has already attended, move on to the next student
    //     if ($attendance) {
    //         continue;
    //     }

    //      // Determine the status of the student based on whether they scanned their RFID badge
    //     $status = 'absent';
    //     if ($s->codeRFID == $code) {
    //         $now = Carbon::now();
    //         $start = Carbon::parse($currentSession->heure_debut);
    //         $timeDiff = $now->diffInMinutes($start);

    //         if ($timeDiff <= 15) {
    //             $status = 'present';
    //         } elseif ($timeDiff <= 30) {
    //             $status = 'tardy';
    //         }
    //     }

    //      // Create a new attendance record for the student
    //     $attendance = new Attendance;
    //     $attendance->code_seance = $currentSession->id;
    //     $attendance->code_student = $s->id;
    //     $attendance->status = $status;
    //     $attendance->date = date('Y-m-d');
    //     $attendance->save();
    // }

     // Return a success response
// ##################################################################################
    // // Check if the student has already attended the current session
    // $attendance = Attendance::where('code_student', $student->id)
    //     ->where('code_seance', $currentSession->id)
    //     ->first();

    // // If the student has already attended, return a success response with the attendance record
    // if ($attendance) {
    //     return response()->json(['success' => true, 'attendance' => $attendance]);
    // }

    // // Determine the status of the student based on the current time
    // $now = Carbon::now();
    // $start = Carbon::parse($currentSession->heure_debut);
    // $timeDiff = $now->diffInMinutes($start);

    // if ($timeDiff <= 15) {
    //     $status = 'present';
    // } elseif ($timeDiff <= 30) {
    //     $status = 'tardy';
    // } else {
    //     $status = 'absent';
    // }

    // // If the student hasn't attended, create a new attendance record
    // $attendance = new Attendance;
    // $attendance->code_seance = $currentSession->id;
    // $attendance->code_student = $student->id;
    // $attendance->status = $status;
    // $attendance->date = date('Y-m-d');
    // $attendance->save();

    // // Return a success response with the new attendance record
    // return response()->json(['success' => true, 'attendance' => $attendance]);

}

}
