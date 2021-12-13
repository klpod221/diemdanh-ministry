<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Login;
use App\Http\Controllers\Staff;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MinistryClass;
use App\Http\Controllers\MinistryStudent;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MinistryCourseMajor;
use App\Http\Controllers\SubjectController;
use App\Http\Middleware\CheckLogout;
use Illuminate\Routing\Route as RoutingRoute;

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('ministry/logout', [Login::class, 'logout'])->name('logout');

    Route::get('ministry', [DashboardController::class, 'index']);
    Route::get('ministry/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('ministry/dashboard/action', [DashboardController::class, 'action']);
    //Ministry Class
    Route::get('ministry/class', [MinistryClass::class, 'index'])->name('classList');
    Route::get('ministry/create-class', [MinistryClass::class, 'create'])->name('classCreate');
    Route::post('ministry/class-create/store', [MinistryClass::class, 'createStore']);
    Route::get('ministry/class-edit/{classId}', [MinistryClass::class, 'edit']);
    Route::post('ministry/class-edit/{classId}/store', [MinistryClass::class, 'editStore']);
    Route::get('ministry/class/delete/{classId}', [MinistryClass::class, 'delete']);
    Route::post('ministry/class/import', [MinistryClass::class, 'classImport'])->name('classImport');
    Route::get('ministry/class/export', [MinistryClass::class, 'classExport'])->name('classExport');

    //Ministry Subject
    Route::get('ministry/subject', [SubjectController::class, 'subjectList'])->name('subjectList');
    Route::post('ministry/subject/insert', [SubjectController::class, 'insert'])->name('subjectInsert');
    Route::post('ministry/subject/edit', [SubjectController::class, 'edit'])->name('subjectEdit');
    Route::post('ministry/subject/import', [SubjectController::class, 'subjectImport'])->name('subjectImport');
    Route::get('ministry/subject/export', [SubjectController::class, 'subjectExport'])->name('subjectExport');
    Route::get('ministry/subject/view-export', [SubjectController::class, 'subjectViewExport'])->name('subjectViewExport');

    //Ministry Course Major
    Route::get('ministry/course-major', [MinistryCourseMajor::class, 'index'])->name('courseMajorList');
    Route::get('ministry/course-major/create-course', [MinistryCourseMajor::class, 'createCourse'])->name('createCourse');
    Route::get('ministry/course-major/create-major', [MinistryCourseMajor::class, 'createMajor'])->name('createMajor');
    Route::post('ministry/course-major/create-major/majorStore', [MinistryCourseMajor::class, 'majorStore'])->name('majorStore');
    Route::get('ministry/major/edit/{majorId}', [MinistryCourseMajor::class, 'majorEdit'])->name('majorEdit');
    Route::post('ministry/major/edit/store', [MinistryCourseMajor::class, 'majorEditStore'])->name('majorEditStore');
    Route::get('ministry/major/delete/{majorId}', [MinistryCourseMajor::class, 'majorDelete'])->name('majorDelete');
    Route::get('ministry/major/export', [MinistryCourseMajor::class, 'majorExport'])->name('majorExport');
    Route::post('ministry/major/import', [MinistryCourseMajor::class, 'majorImport'])->name('majorImport');

    //Ministry Student
    Route::get('ministry/student', [MinistryStudent::class, 'index'])->name('studentList');
    Route::get('ministry/student/create', [MinistryStudent::class, 'create'])->name('createStudent');
    Route::get('ministry/student/create/store', [MinistryStudent::class, 'createStore'])->name('createStudentStore');
    Route::get('ministry/student/edit', [MinistryStudent::class, 'edit'])->name('editStudent');
    Route::get('ministry/student/edit/store', [MinistryStudent::class, 'editStore'])->name('editStudentStore');
    Route::get('ministry/student/delete', [MinistryStudent::class, 'delete'])->name('deleteStudent');
    Route::post('ministry/student/import', [MinistryStudent::class, 'studentImport'])->name('studentImport');
    Route::get('ministry/student/export', [MinistryStudent::class, 'studentExport'])->name('studentExport');

    //Ministry Staff
    Route::get('ministry/list-ministry', [Staff::class, 'ministryList'])->name('ministryList');
    Route::get('ministry/list-teacher', [Staff::class, 'teacherList'])->name('teacherList');
    //Ministry Assignment
    Route::get('ministry/assignment', [AssignmentController::class, 'index'])->name('assignmentList');
    Route::post('ministry/assignment/create', [AssignmentController::class, 'create'])->name('createAssignment');
    Route::post('ministry/assignment/edit', [AssignmentController::class, 'edit'])->name('assignmentEdit');
});

Route::middleware([CheckLogout::class])->group(function () {
    //Ministry
    Route::get('/', function () {
        return redirect('login');
    });
    Route::get('login', [Login::class, 'login'])->name('login');
    Route::post('ministry/login-process', [Login::class, 'loginProcess'])->name('loginProcess');
});
