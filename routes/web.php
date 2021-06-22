<?php

use App\Http\Controllers\Login;
use App\Http\Controllers\Staff;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MinistryClass;
use App\Http\Controllers\MinistryStudent;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MinistryCourseMajor;
use Illuminate\Routing\Route as RoutingRoute;

//Ministry
Route::get('/', function () {
    return redirect('login');
});
Route::get('login',[Login::class, 'login'])->name('login');
Route::post('ministry/login-process',[Login::class, 'loginProcess'])->name('loginProcess');
Route::get('ministry/dashboard',[DashboardController::class, 'index'])->name('dashboard');
Route::post('ministry/dashboard/action',[DashboardController::class, 'action']);
//Ministry Class
Route::get('ministry/class',[MinistryClass::class, 'index'])->name('classList');
Route::get('ministry/create-class',[MinistryClass::class, 'create'])->name('classCreate');
Route::post('ministry/class-create/store',[MinistryClass::class, 'createStore']);
Route::get('ministry/class-edit/{classId}',[MinistryClass::class, 'edit']);
Route::post('ministry/class-edit/{classId}/store',[MinistryClass::class, 'editStore']);
Route::get('ministry/class/delete/{classId}',[MinistryClass::class, 'delete']);
//Ministry Course Major
Route::get('ministry/course-major',[MinistryCourseMajor::class, 'index'])->name('courseMajorList');
Route::get('ministry/course-major/create-course',[MinistryCourseMajor::class, 'createCourse'])->name('createCourse');
Route::get('ministry/course-major/create-major',[MinistryCourseMajor::class, 'createMajor'])->name('createMajor');
Route::post('ministry/course-major/create-major/majorStore',[MinistryCourseMajor::class, 'majorStore'])->name('majorStore');
Route::get('ministry/major/edit/{majorId}',[MinistryCourseMajor::class, 'majorEdit'])->name('majorEdit');
Route::post('ministry/major/edit/store',[MinistryCourseMajor::class, 'majorEditStore'])->name('majorEditStore');
Route::get('ministry/major/delete/{majorId}',[MinistryCourseMajor::class, 'majorDelete'])->name('majorDelete');
//Ministry Student
Route::get('ministry/student',[MinistryStudent::class, 'index'])->name('studentList');
Route::get('ministry/student/create',[MinistryStudent::class, 'create'])->name('createStudent');
Route::get('ministry/student/create/store',[MinistryStudent::class, 'createStore'])->name('createStudentStore');
Route::get('ministry/student/edit',[MinistryStudent::class, 'edit'])->name('editStudent');
Route::get('ministry/student/edit/store',[MinistryStudent::class, 'editStore'])->name('editStudentStore');
Route::get('ministry/student/delete',[MinistryStudent::class, 'delete'])->name('deleteStudent');
//Ministry Staff
Route::get('ministry/list-ministry',[Staff::class, 'ministryList'])->name('ministryList');