<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->paginate(15);
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        // Custom validation rules
        $rules = [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:enrolled,completed,dropped',
            'grade' => 'nullable|numeric|min:0|max:100'
        ];

        // If status is 'completed', grade is required
        if ($request->status === 'completed') {
            $rules['grade'] = 'required|numeric|min:0|max:100';
        }

        $validated = $request->validate($rules, [
            'grade.required' => 'Grade is required when status is "Completed".',
            'grade.numeric' => 'Grade must be a number.',
            'grade.min' => 'Grade cannot be less than 0.',
            'grade.max' => 'Grade cannot be greater than 100.',
        ]);

        // Get student and course for error messages
        $student = Student::find($validated['student_id']);
        $course = Course::find($validated['course_id']);

        // Check if student is already enrolled in this course
        if (Enrollment::isStudentAlreadyEnrolled($validated['student_id'], $validated['course_id'])) {
            return back()
                ->withErrors([
                    'enrollment_error' => "Student {$student->full_name} is already enrolled in {$course->course_code} - {$course->course_name}. Cannot enroll in the same course twice while active."
                ])
                ->withInput();
        }

        // Check if student has already completed this course
        if (Enrollment::hasStudentCompletedCourse($validated['student_id'], $validated['course_id'])) {
            return back()
                ->withErrors([
                    'enrollment_error' => "Student {$student->full_name} has already completed {$course->course_code} - {$course->course_name}. Students cannot re-enroll in completed courses."
                ])
                ->withInput();
        }

        Enrollment::create($validated);
        
        $message = "Successfully enrolled {$student->full_name} in {$course->course_code} - {$course->course_name}";
        if ($validated['status'] === 'completed') {
            $message .= " with grade: {$validated['grade']}%";
        }
        
        return redirect()->route('enrollments.index')->with('success', $message . '!');
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        // Custom validation rules
        $rules = [
            'status' => 'required|in:enrolled,completed,dropped',
            'grade' => 'nullable|numeric|min:0|max:100'
        ];

        // If status is 'completed', grade is required
        if ($request->status === 'completed') {
            $rules['grade'] = 'required|numeric|min:0|max:100';
        }

        $validated = $request->validate($rules, [
            'grade.required' => 'Grade is required when status is "Completed".',
            'grade.numeric' => 'Grade must be a number.',
            'grade.min' => 'Grade cannot be less than 0.',
            'grade.max' => 'Grade cannot be greater than 100.',
        ]);

        $enrollment->update($validated);
        
        $message = 'Enrollment updated successfully';
        if ($validated['status'] === 'completed') {
            $message .= " - Course completed with grade: {$validated['grade']}%";
        }
        
        return redirect()->route('enrollments.index')->with('success', $message . '!');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        
        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully!');
    }
}