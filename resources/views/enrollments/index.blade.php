@extends('layouts.app')

@section('title', 'Enrollments List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1><i class="fas fa-clipboard-list"></i> Enrollments</h1>
    <a href="{{ route('enrollments.create') }}" class="btn btn-info">
        <i class="fas fa-plus"></i> Add New Enrollment
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($enrollments->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Enrollment Date</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td><strong>{{ $enrollment->student->student_id }}</strong></td>
                            <td>{{ $enrollment->student->full_name }}</td>
                            <td><strong>{{ $enrollment->course->course_code }}</strong></td>
                            <td>{{ $enrollment->course->course_name }}</td>
                            <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                            <td>
                                @if($enrollment->grade)
                                    <span class="badge bg-{{ $enrollment->grade >= 75 ? 'success' : ($enrollment->grade >= 60 ? 'warning' : 'danger') }}">
                                        {{ $enrollment->grade }}%
                                    </span>
                                @else
                                    <span class="text-muted">Not graded</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $enrollment->status == 'enrolled' ? 'primary' : ($enrollment->status == 'completed' ? 'success' : 'secondary') }}">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $enrollments->links() }}
        @else
            <div class="text-center py-4">
                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                <h4>No Enrollments Found</h4>
                <p>Start by enrolling students in courses.</p>
                <a href="{{ route('enrollments.create') }}" class="btn btn-info">
                    <i class="fas fa-plus"></i> Add Enrollment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection