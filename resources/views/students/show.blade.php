@extends('layouts.app')

@section('title', 'Student Details - ' . $student->full_name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-user"></i> Student Details</h4>
                <div>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                        <p><strong>First Name:</strong> {{ $student->first_name }}</p>
                        <p><strong>Last Name:</strong> {{ $student->last_name }}</p>
                        <p><strong>Email:</strong> {{ $student->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Phone:</strong> {{ $student->phone }}</p>
                        <p><strong>Date of Birth:</strong> {{ $student->date_of_birth->format('F d, Y') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'graduated' ? 'info' : 'secondary') }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Address:</strong></p>
                        <p>{{ $student->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-book"></i> Enrolled Courses</h5>
            </div>
            <div class="card-body">
                @if($student->enrollments->count() > 0)
                    @foreach($student->enrollments as $enrollment)
                        <div class="mb-2 p-2 border rounded">
                            <strong>{{ $enrollment->course->course_code }}</strong><br>
                            <small>{{ $enrollment->course->course_name }}</small><br>
                            <small class="text-muted">
                                Status: {{ ucfirst($enrollment->status) }}
                                @if($enrollment->grade)
                                    | Grade: {{ $enrollment->grade }}%
                                @endif
                            </small>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No courses enrolled yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection