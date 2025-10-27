<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

// Redirect home directly to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard route
Route::get('/dashboard', function () {
    $totalStudents = \App\Models\Student::count();
    $totalCourses = \App\Models\Course::count();
    $totalEnrollments = \App\Models\Enrollment::count();
    
    return view('dashboard', compact('totalStudents', 'totalCourses', 'totalEnrollments'));
})->name('dashboard');

// Student routes
Route::resource('students', StudentController::class);

// Course routes  
Route::resource('courses', CourseController::class);

// Enrollment routes
Route::resource('enrollments', EnrollmentController::class);