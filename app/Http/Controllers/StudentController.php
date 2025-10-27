<?php
// app/Http/Controllers/StudentController.php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // READ: Display all students
    public function index()
    {
        $students = Student::with('courses')->paginate(10);
        return view('students.index', compact('students'));
    }

    // READ: Show single student
    public function show(Student $student)
    {
        $student->load('enrollments.course');
        return view('students.show', compact('student'));
    }

    // CREATE: Show create form
    public function create()
    {
        return view('students.create');
    }

    // CREATE: Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive,graduated'
        ]);

        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    // UPDATE: Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // UPDATE: Update student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive,graduated'
        ]);

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // DELETE: Remove student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}