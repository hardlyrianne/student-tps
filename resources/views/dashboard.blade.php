@extends('layouts.app')

@section('title', 'Dashboard - Student TPS')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-dashboard"></i> Dashboard</h1>
        <p class="text-muted">Welcome to the Student Transaction Processing System</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>{{ $totalStudents }}</h3>
                        <p class="mb-0">Total Students</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('students.index') }}" class="text-white text-decoration-none">
                    View All Students <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>{{ $totalCourses }}</h3>
                        <p class="mb-0">Total Courses</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-book fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('courses.index') }}" class="text-white text-decoration-none">
                    View All Courses <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>{{ $totalEnrollments }}</h3>
                        <p class="mb-0">Total Enrollments</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('enrollments.index') }}" class="text-white text-decoration-none">
                    View All Enrollments <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-plus-circle"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-user-plus"></i><br>
                            Add New Student
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('courses.create') }}" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-book-open"></i><br>
                            Add New Course
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('enrollments.create') }}" class="btn btn-info btn-lg w-100">
                            <i class="fas fa-clipboard-check"></i><br>
                            New Enrollment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity (Optional) -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-clock"></i> System Overview</h5>
            </div>
            <div class="card-body">
                <p>Student Transaction Processing System is running successfully.</p>
                <p><strong>System Status:</strong> <span class="badge bg-success">Online</span></p>
                <p><strong>Last Updated:</strong> {{ date('F d, Y - H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection