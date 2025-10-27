@extends('layouts.app')

@section('title', 'Course Details - ' . $course->course_name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-book"></i> Course Details</h4>
                <div>
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit Course
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Course Code:</strong> {{ $course->course_code }}</p>
                        <p><strong>Course Name:</strong> {{ $course->course_name }}</p>
                        <p><strong>Department:</strong> {{ $course->department }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Credits:</strong> {{ $course->credits }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $course->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </p>
                        <p><strong>Enrolled Students:</strong> {{ $course->students->count() }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Description:</strong></p>
                        <p>{{ $course->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-users"></i> Enrolled Students</h5>
            </div>
            <div class="card-body">
                @if($course->enrollments->count() > 0)
                    @foreach($course->enrollments as $enrollment)
                        <div class="mb-2 p-2 border rounded">
                            <strong>{{ $enrollment->student->student_id }}</strong><br>
                            <small>{{ $enrollment->student->full_name }}</small><br>
                            <small class="text-muted">
                                Status: {{ ucfirst($enrollment->status) }}
                                @if($enrollment->grade)
                                    | Grade: {{ $enrollment->grade }}%
                                @endif
                            </small>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No students enrolled yet.</p>
                    <a href="{{ route('enrollments.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Enrollment
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection