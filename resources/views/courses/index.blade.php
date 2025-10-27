@extends('layouts.app')

@section('title', 'Courses List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1><i class="fas fa-book"></i> Courses</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add New Course
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($courses->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Department</th>
                            <th>Credits</th>
                            <th>Status</th>
                            <th>Enrolled Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td><strong>{{ $course->course_code }}</strong></td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->department }}</td>
                            <td>{{ $course->credits }}</td>
                            <td>
                                <span class="badge bg-{{ $course->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
                            <td>{{ $course->students->count() }}</td>
                            <td>
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info me-1">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $courses->links() }}
        @else
            <div class="text-center py-4">
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h4>No Courses Found</h4>
                <p>Start by adding your first course.</p>
                <a href="{{ route('courses.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Course
                </a>
            </div>
        @endif
    </div>
</div>
@endsection