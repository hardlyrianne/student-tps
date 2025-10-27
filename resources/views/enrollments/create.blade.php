@extends('layouts.app')

@section('title', 'Add New Enrollment')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-clipboard-check"></i> Add New Enrollment</h4>
            </div>
            <div class="card-body">
                <!-- Display enrollment errors -->
                @if($errors->has('enrollment_error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Enrollment Not Allowed!</strong><br>
                        {{ $errors->first('enrollment_error') }}
                    </div>
                @endif

                <form action="{{ route('enrollments.store') }}" method="POST" id="enrollmentForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">Select Student</label>
                            <select class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                <option value="">Choose a student...</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->student_id }} - {{ $student->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label">Select Course</label>
                            <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                                <option value="">Choose a course...</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->course_code }} - {{ $course->course_name }} ({{ $course->credits }} credits)
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="enrollment_date" class="form-label">Enrollment Date</label>
                            <input type="date" class="form-control @error('enrollment_date') is-invalid @enderror" 
                                   id="enrollment_date" name="enrollment_date" 
                                   value="{{ old('enrollment_date', date('Y-m-d')) }}" required>
                            @error('enrollment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Enrollment Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="enrolled" {{ old('status', 'enrolled') == 'enrolled' ? 'selected' : '' }}>Enrolled</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="dropped" {{ old('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3" id="gradeField" style="display: none;">
                        <label for="grade" class="form-label">
                            Grade (%) <span class="text-danger" id="gradeRequired">*</span>
                        </label>
                        <input type="number" class="form-control @error('grade') is-invalid @enderror" 
                               id="grade" name="grade" 
                               value="{{ old('grade') }}" 
                               min="0" max="100" step="0.01"
                               placeholder="Enter grade (0-100)">
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Grade is required when status is "Completed".</div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        <strong>Enrollment Rules:</strong> 
                        <ul class="mb-0 mt-2">
                            <li><strong>Cannot enroll twice:</strong> Students cannot be enrolled in the same course if already enrolled</li>
                            <li><strong>Cannot re-enroll completed courses:</strong> Students cannot enroll in courses they have already completed</li>
                            <li><strong>Grade required for completion:</strong> A grade (0-100) must be entered when status is "Completed"</li>
                            <li><strong>Can re-enroll dropped courses:</strong> Students can enroll again in courses they have dropped</li>
                        </ul>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-info" {{ ($students->count() == 0 || $courses->count() == 0) ? 'disabled' : '' }}>
                            <i class="fas fa-save"></i> Save Enrollment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const gradeField = document.getElementById('gradeField');
        const gradeInput = document.getElementById('grade');
        const gradeRequired = document.getElementById('gradeRequired');

        function toggleGradeField() {
            if (statusSelect.value === 'completed') {
                gradeField.style.display = 'block';
                gradeInput.required = true;
                gradeRequired.style.display = 'inline';
            } else {
                gradeField.style.display = 'none';
                gradeInput.required = false;
                gradeRequired.style.display = 'none';
            }
        }

        // Initial check
        toggleGradeField();

        // Listen for changes
        statusSelect.addEventListener('change', toggleGradeField);
    });
</script>
@endsection