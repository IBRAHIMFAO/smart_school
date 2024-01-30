<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Seance;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Group;
use App\Models\AnneeScolaire;
use Carbon\Carbon;
use DateTime;





class dashAttendanceController extends Controller
{
    public function index()
    {
        // $seances = Seance::latest()->paginate(10); // You might adjust this based on your needs
        $seances = Seance::orderBy('date', 'asc')->paginate(10);
        
        // Call the isAttendanceRecorded() method
        // $isAttendanceRecorded = $seances->isAttendanceRecorded();
         // Check if attendance is recorded for each Seance
        $isAttendanceRecorded = $seances->map(function ($seance) {
            return $seance->isAttendanceRecorded();
        });
        // Add more data retrieval as needed

        return view('attendances-dash.index', compact('seances'));
    
    }
        
        public function showAttendanceList($seanceId)
    {
        $seance = Seance::findOrFail($seanceId);
        $attendanceRecords = Attendance::where('code_seance', $seanceId)->get();


        return view('attendances-dash.list', compact('seance', 'attendanceRecords'));
    }


    // Form create record manual attendance page show 
    public function showRecordForm($seanceId)
    {
           
        // Retrieve the seance by its ID from the database
        
        $seance = Seance::findOrFail($seanceId);
        $students = $seance->group->student;

        $absence=Attendance::where('code_seance', $seanceId)->get();


        // Retrieve attendance records for the given seance
        // $attendanceRecords = Attendance::where('code_seance', $seanceId)->get();
        $StudentdGroup=Student::where('code_group',$seance->code_group)->get();


        return view('attendances-dash.show', compact('seance', 'students','StudentdGroup'));


}
           
            //fonction record manual attendance page show
            public function recordManualAttendance(Request $request, Seance $seance)
            {
                $this->validate($request, [
                    'attendances' => 'required|array',
                    'type_record' => 'required|in:manual',
                    // Add more validation rules if needed
                ]);

                foreach ($request->input('attendances') as $studentId => $attendanceData) {
                    $status = $attendanceData['status'];
                    $motifAbsence = $attendanceData['motif_absence'] ?? null; // Motif Absence is optional

                    // Save attendance record to the database
                    DB::table('attendances')->updateOrInsert(
                        ['code_student' => $studentId, 'code_seance' => $seance->id],
                        ['status' => $status, 'motif_absence' => $motifAbsence ,
                        'attendance_type' => $request->input('type_record'),
                         'created_at' => now(), 
                         'updated_at' => now()]
                    );
                }

                // return redirect()->route('dashboard.attendance.record.form', $seance->id)
                //     ->with('success', 'Attendance recorded successfully.');
                 return redirect()->back()->with('success', 'Attendance recorded successfully.');
            }   
            
            // public function recordManualAttendance(Request $request, Seance $seance)

            // In your Seance model

        
        public function groupAttendanceStatistics($groupId)
        {
            $group = Group::findOrFail($groupId); // Assuming you have a Group model

            // Get all students in the group
            $students = $group->students;

            // Initialize an array to store statistics
            $attendanceStatistics = [];

            foreach ($students as $student) {
                // Get attendance records for the student in the group
                $attendanceRecords = Attendance::where('code_student', $student->id)
                    ->whereIn('code_seance', $group->seances->pluck('id'))
                    ->get();

                // Count attendance details for each student
                $attendanceStatistics[] = [
                    'student' => $student,
                    'totalAttendance' => $attendanceRecords->count(),
                    'attendanceDetails' => $attendanceRecords,
                ];
            }

            return view('attendances-dash.group_statistics', compact('group', 'attendanceStatistics'));
        }

        // ######################################################################

        // Add this method to dashAttendanceController
        // public function groupStatistics($groupId, $AnneeScolaireId)
        // {
        //     $group = Group::findOrFail($groupId);
        //     // $AnneeScolaire = AnneeScolaire::findOrFail($AnneeScolaireId);

        //     // Get all students in the group
        //     // $students = $group->students;
        //     // $students = Student::where('code_group', $groupId)->get();
           
        //     // dd($students);
           
        //     // Get the attendance records for each student
        //     // $studentStatistics = [];
        //     // if ($students) {

        //     //     foreach ($students as $student) {
        //     //         $absenceCount = Attendance::where('code_student', $student->id)
        //     //             ->Andwhere('code_annee_scolaire', $AnneeScolaireId)
        //     //             ->where('status', 'absent')
        //     //             ->count();

        //     //         // Fetch monthly absence counts for each student
        //     //         $monthlyAbsenceCounts = $this->getMonthlyAbsenceCounts($student->id);

        //     //         $studentStatistics[] = [
        //     //             'student' => $student,
        //     //             'absenceCount' => $absenceCount,
        //     //             'monthlyAbsenceCounts' => $monthlyAbsenceCounts,
        //     //         ];
        //     //     }
        //     // }
          
        //     // foreach ($students as $student) {
        //     //          $absenceCounts = Attendance::where('code_student', $student->id)
        //     //         ->where('student->group->niveauxscolaire->filiere->departement->ecole->code_annee_scolaire', $AnneeScolaireId)
        //     //         ->where('status', 'absent')
        //     //         ->get();

                    
        //     //     $monthlyAbsenceCounts = [];
        
        //     //     // Assuming your attendance records have a date field
        //     //     $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        //     //     foreach ($months as $month) {
        //     //         $monthlyCount = $absenceCounts->where('date', 'like', '%' . $month . '%')->count();
        //     //         $monthlyAbsenceCounts[$month] = $monthlyCount;
        //     //     }
        
        //     //     $studentStatistics[] = [
        //     //         'student' => $student,
        //     //         'absenceCount' => $absenceCounts->count(),
        //     //         'totalHoursAbsent' => 0, // You can calculate this based on your actual logic
        //     //         'monthlyAbsenceCounts' => $monthlyAbsenceCounts,
        //     //     ];
        //     // }

        //      // Fetch the attendance records for each student and count monthly absences
          
          
        //      // Get the start and end dates for the school year
        //     $schoolYear = AnneeScolaire::findOrFail($AnneeScolaireId);
        //     $startDate = $schoolYear->start_date;
        //     $endDate = $schoolYear->end_date;

        //     // Fetch all students in the group
        //     // $students = $group->students;
        //     $students = Student::where('code_group', $groupId)->get();

        //     $studentStatistics = [];

        //     foreach ($students as $student) {
        //         // Fetch the monthly absence counts for each student
        //         $monthlyAbsenceCounts = $this->getMonthlyAbsenceCounts($student, $groupId, $AnneeScolaireId, $startDate, $endDate);

        //         // Calculate the total hours absent (you can adjust this based on your data structure)
        //         $totalHoursAbsent = array_sum($monthlyAbsenceCounts);

        //         // Store the statistics for each student
        //         $studentStatistics[] = [
        //             'student' => $student,
        //             'absenceCount' => array_sum($monthlyAbsenceCounts),
        //             'totalHoursAbsent' => $totalHoursAbsent,
        //             'monthlyAbsenceCounts' => $monthlyAbsenceCounts,
        //         ];
        //     }

        //     dd($studentStatistics);

            


        //     return view('attendances-dash.group_statistics', compact('group', 'studentStatistics'));
        // }



        // Helper function to get monthly absence counts for a student in a specific group and school year
        // private function getMonthlyAbsenceCounts($student, $groupId, $AnneeScolaireId, $startDate, $endDate)
        // {
        //     // dd($student, $groupId, $AnneeScolaireId, $startDate, $endDate);
        //     // Here's a placeholder logic, you should adjust it based on your database structure
        //     $monthlyAbsenceCounts = [];
        //     // Before your query
        //     //  \DB::enableQueryLog();

        //     // Fetch the attendance records for the student, group, and school year
        //     $attendanceRecords = Attendance::where('code_student', $student->id)
        //         ->whereHas('seance.group', function ($query) use ($groupId) {
        //             $query->where('id', $groupId);
        //         })
        //         ->whereHas('seance.group.niveauxscolaire.filiere.departement.ecole.anneeScolaire', function ($query) use ($AnneeScolaireId) {
        //             $query->where('id', $AnneeScolaireId);
        //         })
        //         ->where('status', 'absent') // Added condition to count only absences
        //         ->whereBetween('created_at', [$startDate, $endDate])
        //         ->get();
                               
        //     // Debugging: Print the SQL query and bindings
                
               


        //         dd($attendanceRecords); 
                 
        //     // Placeholder logic to count monthly absences
        //     foreach ($attendanceRecords as $attendance) {
        //         $attendanceDate = $attendance->seance->date;

        //         // Check if the attendance date is within the school year period
        //         if ($attendanceDate >= $startDate && $attendanceDate <= $endDate) {
        //             // Assuming 'date' is a field in the 'seances' table
        //             $month = date('F', strtotime($attendanceDate));

        //             // Count the absence for the specific month
        //             $monthlyAbsenceCounts[$month] = ($monthlyAbsenceCounts[$month] ?? 0) + 1;
        //         }
        //     }
           
        //     return $monthlyAbsenceCounts;
        // }


        // ######################################################################
        //accedere from group page 

         public function groupStatistics($groupId, $AnneeScolaireId)
        {
            $group = Group::findOrFail($groupId);
            
            // Get the start and end dates for the school year
            $AnneeScolaire = AnneeScolaire::findOrFail($AnneeScolaireId);
                $startDate = $AnneeScolaire->start_date;
                $endDate = $AnneeScolaire->end_date;

            // Get all students in the group
            // $students = $group->students;
            $students = Student::where('code_group', $groupId)->get();
           
            // dd($students);
           
            // Get the attendance records for each student
            $studentStatistics = [];

                    



            if ($students) {

                foreach ($students as $student) {
                    $absenceCount = Attendance::where('code_student', $student->id)
                        // ->Andwhere('code_annee_scolaire', $AnneeScolaireId)
                        ->whereHas('seance.group', function ($query) use ($groupId) {
                            $query->where('id', $groupId);
                        })
                        ->whereHas('seance.group.niveauxscolaire.filiere.departement.ecole.anneeScolaire', function ($query) use ($AnneeScolaireId) {
                            $query->where('id', $AnneeScolaireId);
                        })

                        ->where('status', 'absent')
                        // ->count();
                        ->select("code_seance")
                        ->get();
                    // dd($absenceCount);
                    // Fetch monthly absence counts for each student
                    $monthlyAbsenceCounts = $this->getMonthlyAbsenceCounts($student->id , $startDate , $endDate) ;

                    $absenceDetails = $this->getAbsenceDetails($student->id, $startDate, $endDate);

                    // Calculate total hours of absence for the student
                    $totalHoursAbsent = $this->calculateTotalHoursAbsent($absenceDetails);



                    $studentStatistics[] = [
                        'student' => $student,
                        'absenceCount' => $absenceCount,
                        'monthlyAbsenceCounts' => $monthlyAbsenceCounts,
                        'totalHoursAbsent' => $totalHoursAbsent,

                    ];
                }
                // var_dump($absenceCount);
                // var_dump($totalHoursAbsent);
            }

            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
           
              // Calculate first and last day of the month for the entire range
            $firstDayOfMonth = $startDate->copy()->startOfMonth();
            $lastDayOfMonth = $endDate->copy()->endOfMonth();

            // Fetch month names for the header
            $monthNames = [];
            for ($index = 0; $index <= $firstDayOfMonth->diffInMonths($lastDayOfMonth); $index++) {
                $monthNames[] = $firstDayOfMonth->copy()->addMonths($index)->format('F');
            }
            
            //  Fetch the attendance records for each student and count monthly absences
          
            // dd($studentStatistics);

            return view('attendances-dash.group_statistics', compact('group', 'studentStatistics','monthNames' ));
        }

            // Helper method to get monthly absence counts for a student          
            private function getMonthlyAbsenceCounts($studentId, $startDate, $endDate)
            {
                $monthlyAbsenceCounts = [];

                // Convert start and end dates to Carbon objects
                $startDate = Carbon::parse($startDate);
                $endDate = Carbon::parse($endDate);

                // Get the month numbers  format(n)
                $indexStartDate = $startDate->format('m');
                $indexEndDate = $endDate->format('m');

                $monthNames = [
                    1 => 'January',
                    2 => 'February',
                    3 => 'March',
                    4 => 'April',
                    5 => 'May',
                    6 => 'June',
                    7 => 'July',
                    8 => 'August',
                    9 => 'September',
                    10 => 'October',
                    11 => 'November',
                    12 => 'December',
                ];

                // Loop from September to December of the starting year
                for ($month = $indexStartDate; $month <= 12; $month++) {
                    $monthName = $monthNames[$month];
                    $absenceCount = $this->getAbsenceCountForMonth($studentId, $startDate, $month);
                    $monthlyAbsenceCounts[$monthName] = $absenceCount;
                }

                // Loop from January to June of the ending year
                for ($month = 1; $month <= $indexEndDate; $month++) {
                    $monthName = $monthNames[$month];
                    $absenceCount = $this->getAbsenceCountForMonth($studentId, $endDate, $month);
                    $monthlyAbsenceCounts[$monthName] = $absenceCount;
                }

                // var_dump($monthlyAbsenceCounts);

                // Return the array of monthly absence counts
                return $monthlyAbsenceCounts;
            }

            private function getAbsenceCountForMonth($studentId, $date, $month)
            {
                $absenceCount = Attendance::where('code_student', $studentId)
                    ->join('seances', 'seances.id', '=', 'attendances.code_seance')
                    ->where('attendances.status', 'absent')
                    ->whereYear('date', $date->year)
                    ->whereMonth('date', $month)
                    ->count();

                return $absenceCount;
            }


            // Helper method to get detailed absence information for a student
            private function getAbsenceDetails($studentId, $startDate, $endDate)
            {
                $absenceDetails = Attendance::where('code_student', $studentId)
                    ->join('seances', 'seances.id', '=', 'attendances.code_seance')
                    ->where('attendances.status', 'absent')
                    ->whereBetween('date', [$startDate, $endDate])
                    ->select('attendances.code_seance', 'seances.heure_debut', 'seances.heure_fin', 'date')
                    ->get();

                return $absenceDetails;
            }

            // Helper method to calculate total hours of absence for a student
            private function calculateTotalHoursAbsent($absenceDetails)
            {
                $totalHoursAbsent = 0;

                foreach ($absenceDetails as $absence) {

                    // var_dump($absenceDetails);
                    // Calculate the difference between heure_fin and heure_debut
                    // $heureDebut = Carbon::parse($absence->seance->date . ' ' . $absence->seance->heure_debut);
                    $heureDebut = Carbon::parse($absence->date . ' ' . $absence->heure_debut);
                    $heureFin = Carbon::parse($absence->date . ' ' . $absence->heure_fin);

                    $hoursDiff = $heureFin->diffInHours($heureDebut);
                    // var_dump($hoursDiff);

                    // Add the difference to the total
                    $totalHoursAbsent += $hoursDiff;
                }

                return $totalHoursAbsent;
            }
           


            // Add this method to your controller
            // ... Your existing code ...

            public function getAbsenceshow($studentId)
            {
                // Fetch absence details for the selected student (modify this query based on your database structure)
                $absenceDetails = Attendance::where('code_student', $studentId)
                    ->with('seance') // Assuming you have a relationship with the 'seance' model
                    ->where('status', 'absent')
                    ->get();
            
                // Return the view with the fetched data
                return view('attendances-dash.absence_details', compact('absenceDetails'));
            }

            




        


            private function getMonthlyAbsenceCountsee($studentId, $startDate, $endDate)
            {
                $monthlyAbsenceCounts = [];

                // Convert start and end dates to Carbon objects
                $startDate = Carbon::parse($startDate)->format('Y-m-d');
                $endDate = Carbon::parse($endDate)->format('Y-m-d');
                
                $IndexStartDate = Carbon::parse($startDate)->format('m');
                $IndexEndDate = Carbon::parse($endDate)->format('m');
                // dd($IndexStartDate  , $IndexEndDate );
   
                $month = [1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',
                                8=>'auget',9=>'September',10=>'October',11=>'November',12=>'December'];
                for ($month = $IndexStartDate; $month <= $IndexEndDate ; $month++) {

                // Loop through months and fetch absence counts
                // for ($month = 1; $month <= 12; $month++) {
                // for ($month = $IndexStartDate; $month <= $IndexEndDate ; $month++) {
                    // Calculate first and last day of the month
                     var_dump($month);

                     // $firstDayOfMonth = $startDate->copy()->startOfMonth();
                    // $lastDayOfMonth = $endDate->copy()->endOfMonth();

                    // Fetch absences for the specific month based on the seance date
                    // $absenceCount = $student->attendances
                    $absenceCount = Attendance::where('code_student', $studentId)
                        // ->where('status', 'absent')
                        // ->whereMonth('seance.date', $month)
                        ->join('seances', 'seances.id', '=', 'attendances.code_seance')
                        ->where('attendances.status', 'absent')
                        ->whereBetween( 'date' , [$startDate, $endDate])
                        ->whereMonth('date', $month)
                        // ->select('date')
                        // ->get();
                        ->count();

                

                    // Store the absence count for the month
                    $monthlyAbsenceCounts[$month] = $absenceCount;
                }
                dd($monthlyAbsenceCounts);

                // Return the array of monthly absence counts
                return $monthlyAbsenceCounts;
            }




      






















    //     public function recordManualAttendance(Request $request, Seance $seance)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'students' => 'required|array',
    //         'students.*.code_student' => 'required|exists:students,id',
    //         'students.*.status' => 'required|in:present,tardy,absent',
    //         'students.*.motif_absence' => 'nullable|string',

    //         'students.*.code_seance' => 'required|exists:seances,id',
    //         'students.*.attendance_type' => 'required|in:manual,automatic',
    //     ]);

    //     $seance = Seance::findOrFail($seance->id);

    //     foreach ($request->students as $studentData) {
    //         // Create or update attendance records
    //         Attendance::updateOrCreate(
    //             [
    //                 'code_student' => $studentData['code_student'],
    //                 'code_seance' => $seance,
    //             ],
    //             [
    //                 'status' => $studentData['status'],
    //                 'motif_absence' => $studentData['motif_absence'],
    //                 'attendance_type' => 'manual',
    //             ]
    //         );
    //     }

    //     return redirect()->route('dashboard.attendance.record.form', $seance->id)
    //         ->with('success', 'Attendance recorded successfully.');
    // }


    // public function recordManualAttendance(Request $request, $seanceId)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'students' => 'required|array',
    //         'students.*.code_student' => 'required|exists:students,id',
    //         'students.*.status' => 'required|in:present,tardy,absent',
    //         'students.*.motif_absence' => 'nullable|string',
    //     ]);

    //     $seance = Seance::findOrFail($seanceId);

    //     foreach ($request->students as $studentData) {
    //         // Create or update attendance records
    //         Attendance::updateOrCreate(
    //             [
    //                 'code_student' => $studentData['code_student'],
    //                 'code_seance' => $seanceId,
    //             ],
    //             [
    //                 'status' => $studentData['status'],
    //                 'motif_absence' => $studentData['motif_absence'],
    //                 'attendance_type' => 'manual',
    //             ]
    //         );
    //     }

    //     return redirect()->route('dashboard.attendance.show', $seanceId)->with('success', 'Manual attendance recorded successfully');
    // }

    // public function recordAutomaticAttendance($seanceId)
    // {
    //     $seance = Seance::findOrFail($seanceId);

    //     // Logic for automatic attendance recording goes here
    //     // ...

    //     // Example: Mark all students as present for simplicity
    //     $students = $seance->group->students;
    //     foreach ($students as $student) {
    //         Attendance::updateOrCreate(
    //             [
    //                 'code_student' => $student->id,
    //                 'code_seance' => $seanceId,
    //             ],
    //             [
    //                 'status' => 'present',
    //                 'attendance_type' => 'automatic',
    //             ]
    //         );
    //     }

    //     return redirect()->route('dashboard.attendance.show', $seanceId)->with('success', 'Automatic attendance recorded successfully');
    // }

}
