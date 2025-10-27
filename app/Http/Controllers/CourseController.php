<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('students')->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load('enrollments.student');
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:courses',
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
            'credits' => 'required|integer|min:1|max:10',
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
            'credits' => 'required|integer|min:1|max:10',
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}