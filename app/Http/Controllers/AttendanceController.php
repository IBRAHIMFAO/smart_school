<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function scanCard($code)
    {
        $student = Student::where('codeRFID', $code)->first();

        if (!$student) {
            return response()->json([
                'error' => 'Invalid card number',
            ], 400);
        }

           $classStartTime = Carbon::parse('10:30 AM'); // Set class start time
           $classEndTime = Carbon::parse('11:30 AM'); // Set class end time
           $now = Carbon::now();
           $tardyThreshold = $classStartTime->copy()->addMinutes(15); // Set threshold for "tardy" attendance
           $absentThreshold = $classStartTime->copy()->addMinutes(30); // Set threshold for "absent" attendance

        if ($now < $classStartTime || $now > $classEndTime) {
            return response()->json([
                'error' => 'Attendance can only be recorded during class hours',
            ], 400);
        }

        $status = 'present';

        if ($now->gt($tardyThreshold) && $now->lt($absentThreshold)) {
            $status = 'tardy';
        } elseif ($now->gt($absentThreshold)) {
            $status = 'absent';

        }

        $attendance = new Attendance([
            'date' => $now,
            'status' => $status,
        ]);

        $student->attendance()->save($attendance);

        return response()->json([
            'message' => 'Attendance recorded for ' . $student->name,

        ]);

    }

}

