<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\HomeController;



use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceController3;
use App\Http\Controllers\AttendanceController4;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dashSeanceController;
use App\Http\Controllers\dashGroupeController;
use App\Http\Controllers\dashStudentController;
use App\Http\Controllers\dashFiliereController;
use App\Http\Controllers\dashNiveauxscolaireController;
use App\Http\Controllers\dashMatiereController;
use App\Http\Controllers\dashProfController;
use App\Http\Controllers\dashPavilionController;
use App\Http\Controllers\dashSalleController;
use App\Http\Controllers\dashDepartementController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\EmploiDuTempsSalleController;
use App\Http\Controllers\EmploiDuTempsProfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\DashEcoleController;
use App\Http\Controllers\DashCaissierController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\dashPostController;
use App\Http\Controllers\dashAttendanceController;
use App\Http\Controllers\UserController;




//Route page student
use App\Http\Controllers\PublicHomeController;
use App\Http\Controllers\PublicTimeTableController;
// end route page student


use Carbon\Carbon;
use App\Exports\GroupExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Attendance;
use App\Models\Seance;
use App\Models\Student;
use App\Http\Controllers\PostController;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// In your routes file (web.php)
Route::middleware(['CheckRole:student,tuteur'])->group(function () {
    // Routes that should be restricted for students and parents
    Route::get('/student/home', [PublicHomeController::class, 'studentHome'])->name('student.home');


});

Route::middleware(['CheckRole:admin,directeur'])->group(function () {
    // Routes that should be restricted to admin and directeur roles
    Route::resource('/dashboard/users',UserController::class);


});
// Route::middleware(['guest', 'role:student,tuteur'])->group(function () {
//     Route::get('/student/home', [PublicHomeController::class, 'studentHome'])->name('student.home');

// });

// Route::middleware(['guest', 'role:admin,directeur'])->group(function () {
//     Route::resource('/dashboard/users',UserController::class);

// });
// Route::resource('/dashboard/users',UserController::class);



Route::get('/export-excel',[GroupController::class,'export'])->name('export-excel');
Route::post('/import-excel',[GroupController::class,'import'])->name('import-excel');

Route::resource('crud', CRUDController::class);
Route::get('/crud/seance/{id}/attendance',[CRUDController::class,'attendance'])->name('crud.attendance');
Route::resource('groups', GroupController::class);


//###############dashboard#########################################"

Route::resource('/dash-seance',dashSeanceController::class);

Route::get('/get-salles/{pavillon}',[dashSeanceController::class ,'getSalles']); // Replace with your controller and method

Route::get('/get-ecoles',[dashSeanceController::class , 'getEcoles']);
Route::get('/get-departements',[dashSeanceController::class , 'getDepartements']);
Route::get('/get-filieres',[dashSeanceController::class, 'getFilieres' ] );
Route::get('/get-niveaux-scolaires',[dashSeanceController::class, 'getNiveauxScolaires' ] );
Route::get('/get-groups',[dashSeanceController::class,'getGroups'] );








// Route::resource('/dashboard/users',UserController::class);
Route::resource('/dash-groupe',dashGroupeController::class);
Route::resource('/dash-student',dashStudentController::class);
Route::resource('/dash-filiere', dashFiliereController::class);
Route::resource('/dash-niveauxscolaire', dashNiveauxscolaireController::class);
Route::resource('/dash-matiere', dashMatiereController::class);
Route::resource('/dash-prof', dashProfController::class);
Route::get('/profs-dash/pdf', [dashProfController::class, 'generatePdf'])->name('profs-dash.pdf');
// Route::get('/dash-prof/destroy/{id}',[dashProfController::class,'destroy'] )->name('dash-prof.destroy');

Route::resource('/dash-salle', dashSalleController::class);
Route::resource('/dash-ecole', dashEcoleController::class);
Route::resource('dash-departement', dashDepartementController::class);
Route::resource('dash-caissier', dashCaissierController::class);
Route::resource('factures', FactureController::class);

Route::resource('/dash-pavilion', dashPavilionController::class);


// Route::get('/generate-pdf/{paymentId}', [FactureController::class, 'generatePDF'])->name('generate-pdf');
Route::get('/generate-pdf/{paymentId}/{lang}', [FactureController::class, 'generatePdf'])->name('generate-pdf') ;


Route::post('/dash-caissier/toggle/{id}', [DashCaissierController::class, 'toggleAccountStatus'])->name('dash-caissier.toggle');
Route::post('/dashboard/user/toggle/{id}', [UserController::class,'toggleAccountStatus'])->name('dashboard.user.toggle');


Route::post('/dash-prof/toggle/{id}', [dashProfController::class,'toggleAccountStatus'])->name('dash-prof.toggle');

Route::resource('payment',paymentController::class);


// ########### START Ajax code ##############################################################

Route::get('/fetch-filieres/{department}', [dashNiveauxscolaireController::class,'fetchFilieres']);
// Route::get('/get-niveaux-scolaires',[dashGroupeController::class,'getNiveauxScolaires'])->name('get-niveaux-scolaires');

Route::get('/fetch-departements',[dashGroupeController::class,'fetchDepartements'])->name('fetch-departements');
Route::get('/fetch-filieres/{departement}',[dashGroupeController::class,'fetchFilieres'])->name('fetch-filieres');
Route::get('/fetch-niveaux-scolaires/{filiere}',[dashGroupeController::class,'fetchNiveauxScolaires'])->name('fetch-niveaux-scolaires');




Route::get('/dash-student/{id}', [dashStudentController::class, 'getStudentDetails'])->name('dash-student.getStudentDetails');
Route::get('/students/search',[paymentController::class, 'search'])->name('students.search');


Route::get('/students/by-cne/{cne}', [paymentController::class, 'getByCNE']);


// ######################### END AJAX CODE #####################################################
Route::get('/export-groups',[dashGroupeController::class,'export'])->name('export-groups');




Route::get('/profile/{role}', [ProfileController::class,'showProfileForm'])->name('profile');
Route::post('/profile/update', [ProfileController::class,'updateProfile'])->name('profile.update');


Route::get('/seances-dash/{id}/attendance',[dashSeanceController::class,'attendance'])->name('dash.attendance');

 // start Routes for attendance recording
 Route::get('/dashboard/attendance/record/{seance}', [dashAttendanceController::class, 'showRecordForm'])->name('dashboard.attendance.record.form');
//  Route::post('/dashboard/attendance/record/manual/{seance}', [dashAttendanceController::class, 'recordManualAttendance'])->name('dashboard.attendance.record.manual');
 // Routes for attendance recording
 Route::match(['get', 'post'], '/dashboard/attendance/record/manual/{seance}', [dashAttendanceController::class, 'recordManualAttendance'])
 ->name('dashboard.attendance.record.manual');
 Route::get('/dashboard/attendance/seances', [dashattendanceController::class,'index'])->name('attendance.index');
 Route::get('/dashboard/attendance/list/{seance}', [dashAttendanceController::class, 'showAttendanceList'])->name('dashboard.attendance.list');

 Route::post('/dashboard/attendance/record/automatic/{seance}', [dashAttendanceController::class, 'recordAutomaticAttendance'])->name('dashboard.attendance.record.automatic');

 //end Routes for attendance recording

Route::get('/emploi-du-temps', [EmploiDuTempsController::class, 'index'])->name('emploi-du-temps.index');
Route::get('/download-pdf/group', [EmploiDuTempsController::class, 'downloadPdf'])->name('download-pdf.group');

Route::get('/emploi-du-temps/salle', [EmploiDuTempsSalleController::class, 'index'])->name('emploi-du-temps.salle.index');
Route::get('/download-pdf', [EmploiDuTempsSalleController::class, 'downloadPdf'])->name('download-pdf');
Route::get('/export-excelsalle',[EmploiDuTempsSalleController::class, 'exportExcel'])->name('export.excelsalle');




Route::get('/emploi-du-temps/prof', [EmploiDuTempsProfController::class, 'index'])->name('emploi-du-temps.prof.index');
Route::get('/get-prof-by-department', [EmploiDuTempsProfController::class, 'getProfByDepartment'])->name('get-prof-by-department');
// Route::get('/download-pdf/prof', [EmploiDuTempsProfController::class, 'downloadPdf'])->name('download-pdf.prof');
Route::get('/download-pdf/prof', [EmploiDuTempsProfController::class, 'downloadPdf'])->name('download-pdf.prof');

// Route::get('emploi-du-temps/prof', [EmploiDuTempsProfController::class, 'index'])->name('emploi-du-temps.prof.index');
// Route::get('/emploi-du-temps/prof/export-pdf',[EmploiDuTempsProfController::class, 'exportPdf'])->name('emploi-du-temps.prof.export.pdf');

// Route::get('/download-timetable', [EmploiDuTempsProfController::class,'downloadTimetable'])->name('download-timetable');



// #################################################################
Route::get('/dd', function () {
    return view('welcome');
});

// Route::get('/dash', function () {
//     return view('dashcontent');
// });


Route::get('/check4/{code}', [AttendanceController4::class,'store4']);
Route::get('/check3/{code}', [AttendanceController3::class, 'store3']);

// Route::get("/getSessions", [AttendanceController4::class, 'getSessions']);
// Route::get("/session/{id}/get", [AttendanceController4::class, 'show']);












Auth::routes();



Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/login', [Auth\LoginController::class,'showLoginForm'])->name('login'); 




// Route::get('/student/home', [PublicHomeController::class, 'studentHome'])->name('student.home')->middleware('auth');
 Route::get('/', [DashboardController::class, 'index'])->name('/')->middleware('auth');

//  ################################# gere post #############################################

        // Route for liking a post
    // Route::post('/post/like/{post}', [PostController::class, 'like'])->name('post.like');

    // Route for commenting on a post
    // Route::post('/post/comment/{post}', [PostController::class, 'comment'])->name('post.comment');

    // Dashboard Post
    Route::get('/post/create', [dashPostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [dashPostController::class, 'store'])->name('post.store');
    Route::get('/post/index', [dashPostController::class, 'index'])->name('post.index');
    Route::get('/post/edit/{id}', [dashPostController::class, 'edit'])->name('post.edit');
    Route::put('/post/update/{id}', [dashPostController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{id}', [dashPostController::class, 'destroy'])->name('post.delete');
    
    // page student
     // code script Ajax  home.blade.php
    Route::post('/post/comment', [PublicHomeController::class, 'addComment'])->name('post.comment');
    Route::post('/post/like', [PublicHomeController::class, 'likePost'])->name('post.like');
    Route::delete('/comment/delete/{id}', [PublicHomeController::class, 'deleteComment'])->name('comment.delete');

    //end code Ajax

    Route::get('/student/timetable',[PublicTimeTableController::class,'index'])->name('student.timetable.index');
    // Route::get('/student/pofile',[ProfileController::class,'showProfileForm' ] )->name('student.profile');

    //end page student



    




    // ##########################################################################################

// Route::get('/student/home', [PublicHomeController::class, 'studentHome'])
//     ->name('student.home')
//     ->middleware('checkUserRole'); // Apply the middleware here


// For student and tuteur
// Route::middleware(['guest', 'role:student,tuteur'])->group(function () {
//     Route::get('/student/home', [PublicHomeController::class, 'studentHome'])->name('student.home');
// });

// // For superadmin, directeur, and surveillant
// Route::middleware(['guest', 'role:admin,directeur,surveillant'])->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('/');
// });

// ######################################################################################
