@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1><i class="fas fa-users"></i> Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Student
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($students->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->full_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'graduated' ? 'info' : 'secondary') }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info me-1">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $students->links() }}
        @else
            <div class="text-center py-4">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h4>No Students Found</h4>
                <p>Start by adding your first student.</p>
                <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
            </div>
        @endif
    </div>
</div>
@endsection