@extends('layouts.app')

@section('title', 'Edit Course - ' . $course->course_name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-book-open"></i> Edit Course</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('courses.update', $course) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course_code" class="form-label">Course Code</label>
                            <input type="text" class="form-control @error('course_code') is-invalid @enderror" 
                                   id="course_code" name="course_code" value="{{ old('course_code', $course->course_code) }}" 
                                   placeholder="e.g., CS101" required>
                            @error('course_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $course->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control @error('course_name') is-invalid @enderror" 
                               id="course_name" name="course_name" value="{{ old('course_name', $course->course_name) }}" 
                               placeholder="e.g., Introduction to Computer Science" required>
                        @error('course_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" 
                                   id="department" name="department" value="{{ old('department', $course->department) }}" 
                                   placeholder="e.g., Computer Science" required>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" class="form-control @error('credits') is-invalid @enderror" 
                                   id="credits" name="credits" value="{{ old('credits', $course->credits) }}" 
                                   min="1" max="10" required>
                            @error('credits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Course description and objectives..." required>{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Update Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection