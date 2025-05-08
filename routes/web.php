<?php
use App\Http\Controllers\Admin\ClassProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Teacher\ClassTeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherProfileController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\teacher\QuestionOptionController;
use App\Http\Controllers\StudentQuizAnswerController;
use App\Http\Controllers\teacher\TeacherController;
use App\Http\Controllers\Teacher\QuizController;
use App\Http\Controllers\Teacher\QuizQuestionController;
use App\Http\Controllers\Teacher\ProfileTeacherController;
use  App\Http\Controllers\Student\QuizStudentController;
use App\Http\Controllers\Student\StudentAssignmentController;
use App\Http\Controllers\Student\StudentController as StudentStudentController;
use App\Http\Controllers\Student\StudentCourseController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentSubjectController;
use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Teacher\TeacherCourseController;
use App\Http\Controllers\Teacher\TeacherMarkController;
use App\Http\Controllers\Admin\TeacherAssignmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('signin');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



Route::middleware(['auth', 'role:admin'])->group(function () {
  
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
             ->middleware(middleware: 'throttle:6,1')
            ->name('verification.send');
        Route::get('password/edit', [PasswordController::class, 'editAdmin'])->name('password.edit');
    Route::put('password/update', [PasswordController::class, 'updateAdmin'])->name('password.update');

        Route::get('/students/trashed', [AdminStudentController::class, 'trashed'])
            ->name('students.trashed');   
        Route::post('/students/{national_id}/restore', [AdminStudentController::class, 'restore'])
            ->name('students.restore');
        Route::delete('/students/{national_id}/force-delete', [AdminStudentController::class, 'forceDelete'])
            ->name('students.force-delete');

        Route::resource('users', UserController::class);
        Route::resource('students', AdminStudentController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('grades', GradeController::class);
        Route::get('/grades/{grade}/class-profiles', [ClassProfileController::class, 'showByGrade'])->name('grades.class_profiles');
        Route::get('/class-profiles/{id}/teachers', [ClassProfileController::class, 'showTeachers'])->name('class_profiles.teachers');
        Route::get('/class-profiles/{id}/students', [ClassProfileController::class, 'showStudents'])->name('class_profiles.students');
        Route::get('/class-profiles/{id}/students/pdf', [ClassProfileController::class, 'downloadStudentsPdf'])
    ->name('class_profiles.students.pdf');
        Route::resource('teacher_profiles', TeacherProfileController::class);
        Route::resource('class_profiles', ClassProfileController::class);

       
Route::get('/class/{class}/assign-teacher', [TeacherAssignmentController::class, 'create'])
->name('class.assign-teacher');

Route::post('/class/{class}/assign-teacher', [TeacherAssignmentController::class, 'store'])
->name('class.assign-teacher.store');
           
            Route::get('/subject/{subject}/teachers', [TeacherAssignmentController::class, 'getTeachersBySubject'])
    ->name('.subject.teachers');

Route::post('/class/{class}/assign-teacher/ajax', [TeacherAssignmentController::class, 'ajaxAssign'])
    ->name('class.assign-teacher.ajax');
    Route::delete('/class/{class}/unassign-teacher/{teacher}', [TeacherAssignmentController::class, 'unassign'])
    ->name('class.assign-teacher.unassign');

  
});
});


  
Route::middleware(['auth', 'role:teacher'])->group(function () {
  
    Route::get('/teacher/dashboard', [TeacherController::class, 'index']);
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');

    Route::get('/teacher/classes', [ClassTeacherController::class,  'index'])->name('teacher.classes.index');
    Route::get('/teacher/classes/{course}/students/pdf', [ClassTeacherController::class, 'downloadStudentsPdf'])->name('teacher.classes.students.pdf');


    Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/profile', [ProfileTeacherController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileTeacherController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileTeacherController::class, 'destroy'])->name('profile.destroy');     
     
    Route::put('/change-password', [PasswordController::class, 'updateTeacher'])->name('password.update');
    Route::get('/change-password', [PasswordController::class, 'editTeacher'])->name('password.edit');
        
    
       
Route::resource('quizzes', QuizController::class);
Route::resource('quizzes.questions', QuizQuestionController::class);
Route::resource('questions.options', QuestionOptionController::class);
Route::get('/teacher/quizzes/{quiz}/questions/{question}',[QuizQuestionController::class, 'show'])->name('quizzes.questions.show');

Route::post('student-quiz-answers', [StudentQuizAnswerController::class, 'store']);
Route::get('student-quiz-answers/{studentId}/{quizId}', [StudentQuizAnswerController::class, 'show']);
Route::get('/marks', [TeacherMarkController::class, 'index'])->name('marks.index');
Route::post('/marks/update', [TeacherMarkController::class, 'update'])->name('marks.update');

Route::resource('assignments', AssignmentController::class);
Route::get('/assignments/{id}/submissions', [AssignmentController::class, 'submissions'])->name('assignments.submissions');
Route::put('teacher/submissions/{submission}/mark', [AssignmentController::class, 'updateMark'])->name('assignments.submissions.mark');



    });   
 });
 



 Route::prefix('student')->name('student.')->middleware(['auth', 'role:student'])->group(function () {

    
    Route::get('/dashboard', [StudentStudentController::class, 'index']);
    Route::get('/dashboard', [StudentStudentController::class, 'index'])->name('dashboard');

    Route::get('/profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');

    

    Route::get('password/edit', [PasswordController::class, 'editStudent'])->name('password.edit');
    Route::put('password/update', [PasswordController::class, 'updateStudent'])->name('password.update');

    Route::get('/courses', [StudentSubjectController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [StudentSubjectController::class, 'showCourse'])->name('courses.show');


    Route::get('/quizzes', [QuizStudentController::class, 'index'])->name('quizzes.index');
    Route::get('/quiz/{id}', [QuizStudentController::class, 'show'])->name('quizzes.show');
    Route::post('/quiz/{id}/submit', [QuizStudentController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quiz/{id}/result', [QuizStudentController::class, 'result'])->name('quizzes.results');

    Route::get('/assignments', [StudentAssignmentController::class, 'index'])->name('assignments.index');
    Route::post('/assignments/{id}/submit', [StudentAssignmentController::class, 'submit'])->name('assignments.submit');
    Route::delete('/student/assignments/submission/{id}', [StudentAssignmentController::class, 'destroySubmission'])->name('assignments.submission.delete');



});
 
require __DIR__.'/auth.php';
