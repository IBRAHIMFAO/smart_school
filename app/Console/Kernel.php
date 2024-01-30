<?php

namespace App\Console;

use App\Models\Attendance;
use App\Models\Seance;
use App\Models\Student;
use App\Models\Tuteur;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Vonage\SMS\Message\SMS;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
       // Retrieve the current session
    $currentSessions = Seance::where('date', '=', Carbon::now()->format("Y-m-d"))
    ->where('heure_debut', '<=', date('H:i:s', time()))
    ->where('heure_fin', '>=', date('H:i:s', time()))
    // ->first();
    ->get();
    foreach ($currentSessions as $currentSession) {

        // If there's a current session, register absence for students who haven't checked in after 4 minutes
        if ($currentSession) {
            $group_id = $currentSession->code_group;
            $students = Student::where('code_group', $group_id)->get();

            foreach ($students as $student) {
                $attendance = Attendance::where('code_student', $student->id)
                ->where('code_seance', $currentSession->id)
                    ->first();

                if (!$attendance) {
                    // Check if the student is absent
                    $current_time = Carbon::now();
                    $seance_start_time = Carbon::parse($currentSession->heure_debut);
                    $minutes_since_seance_start = $current_time->diffInMinutes($seance_start_time, true);

                    if ($minutes_since_seance_start > 4) {
                        Attendance::create([
                            'code_student' => $student->id,
                            'code_seance' => $currentSession->id,
                            'date' => date('Y-m-d'),
                            'status' => 'absent'
                        ]);

                        // Send an SMS to the student's tutor
                        // $tutor_phone = $student->code_tuteur->numero_tel;
                        $tutor_phone = $student->tuteur->numero_tel;
                        if (!empty($tutor_phone)) {
                            // $basic = new Basic('5fb0aaf0','ujnDxTWw6e2iPyaO');
                            // $client = new Client($basic);

                            // $message = $client->sms()->send( new SMS($tutor_phone,'institution albita', sprintf("Your student %s was absent from %s class on %s from %s to %s. At prof Mr %s.",
                            //     $student->nom,
                            //     $currentSession->matiere,
                            //     $currentSession->date,
                            //     $currentSession->heure_debut,
                            //     $currentSession->heure_fin,
                            //     $currentSession->prof
                            // )));

// ######################################################################################################################
                            // $basic  = new Basic("5fb0aaf0", "ujnDxTWw6e2iPyaO"); ibrahim
                            // $client = new Client($basic);
                            $basic  = new Basic("d822ccbc", "407elJshxq7ebx0f");
                            $client = new Client($basic);
                            $response = $client->sms()->send(
                                new SMS(
                                $tutor_phone, 'institution albita',  sprintf("Your student %s was absent from %s class on %s from %s to %s. At prof Mr %s.",
                                $student->nom,
                                $currentSession->matiere,
                                $currentSession->date,
                                $currentSession->heure_debut,
                                $currentSession->heure_fin,
                                $currentSession->prof
                                )));
                            // ;
                            // // $response = $client->message()->send($message);
                            // $response = $message-> current();
                            // if ($response->getStatus() == 0) {
                            //     echo "The message was sent successfully\n";
                            // } else {
                            //     echo "The message failed with status: " . $message->getStatus() . "\n";
                            // }
// ################################ ##############################################################################
                            //   $response = $client->message()->send($message);
                            $message= $response-> current();
                            if ($message->getStatus() == 0) {
                                echo sprintf("Message sent to %s.\n", $tutor_phone);
                            } else {
                                echo sprintf("Error sending message to %s: %s\n", $tutor_phone, $message->getStatus());
                            }
                        }
                    }
                }
            }
        }

// Run the attendance command every minute
}
$schedule->command('attendance')->everyMinute();
}

/**
 * Register the commands for the application.
 *
 * @return void
 */
protected function commands()
{
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}


