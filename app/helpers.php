<?php
namespace App\Models;
use Carbon\Carbon;
 function record_attendance_for_absent_student($code){
    $students = Student::where('code_group', $code)->get();

    // If there are no students in the group, return an error response
    if ($students->isEmpty()) {
        return response()->json(['error' => 'No students found in the group'], 404);
    }

    // Retrieve the current session for the group
    $currentSession = Seance::where('code_group', $code)
        ->whereDate('date', '=', Carbon::now()->toDateString())
        ->where('heure_debut', '<=', Carbon::now())
        ->where('heure_fin', '>=', Carbon::now())
        ->first();

    // If there's no current session, find the next session for the group
    if (!$currentSession) {
        $nextSession = Seance::where('code_group', $code)
            ->where('date', '>', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->orderBy('heure_debut', 'asc')
            ->first();

        // If there's no next session, return an error response
        if (!$nextSession) {
            return response()->json(['error' => 'No upcoming session found for the group'], 404);
        }

        // Return a success response with the next session information
        return response()->json(['success' => true, 'next_session' => $nextSession->date
                                                .'at' .$nextSession-> heure_debut .'fin'.$nextSession->heure_fin]);

    }

    // Loop through all students in the group and record attendance
    foreach ($students as $student) {
        // Check if the student has already attended the current session
        $attendance = Attendance::where('code_student', $student->id)
            ->where('code_seance', $currentSession->id)
            ->first();

        // If the student has already attended, move on to the next student
        if ($attendance) {
            continue;
        }

        // Determine the student's attendance status based on the current time and session start time
        $now = Carbon::now();
        $start = Carbon::parse($currentSession->heure_debut);
        $timeDiff = $now->diffInMinutes($start);

        if ($timeDiff <= 15) {
            $status = 'present';
        } elseif ($timeDiff <= 30) {
            $status = 'tardy';
        } else {
            $status = 'absent';
        }

        // Create a new attendance record for the student
        $attendance = new Attendance;
        $attendance->code_seance = $currentSession->id;
        $attendance->code_student = $student->id;
        $attendance->status = $status;
        $attendance->date = date('Y-m-d');
        $attendance->save();
    }

    // Calculate the total attendance time for each student
    foreach ($students as $student) {
        $attendanceTime = Attendance::where('code_student', $student->id)
            ->where('code_seance', $currentSession->id)
            ->sum('attendance_time');

        // Update the student's attendance time in the attendance record
        $attendance = Attendance::where('code_student', $student->id)
            ->where('code_seance', $currentSession->id)
            ->first();
        $attendance->attendance;
}

}
