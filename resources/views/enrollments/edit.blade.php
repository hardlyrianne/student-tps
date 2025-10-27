@extends('layouts.app')

@section('title', 'Edit Enrollment')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Edit Enrollment</h4>
            </div>
            <div class="card-body">
                <!-- Enrollment Info Display -->
                <div class="alert alert-light border">
                    <h6><i class="fas fa-info-circle"></i> Enrollment Details:</h6>
                    <p class="mb-1"><strong>Student:</strong> {{ $enrollment->student->student_id }} - {{ $enrollment->student->full_name }}</p>
                    <p class="mb-1"><strong>Course:</strong> {{ $enrollment->course->course_code }} - {{ $enrollment->course->course_name }}</p>
                    <p class="mb-0"><strong>Enrollment Date:</strong> {{ $enrollment->enrollment_date->format('F d, Y') }}</p>
                </div>

                <form action="{{ route('enrollments.update', $enrollment) }}" method="POST" id="editEnrollmentForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="grade" class="form-label">
                                Grade (%) <span class="text-danger" id="gradeRequired" style="display: none;">*</span>
                            </label>
                            <input type="number" class="form-control @error('grade') is-invalid @enderror" 
                                   id="grade" name="grade" 
                                   value="{{ old('grade', $enrollment->grade) }}" 
                                   min="0" max="100" step="0.01"
                                   placeholder="Enter grade (0-100)">
                            @error('grade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text" id="gradeHelp">Grade is required when status is "Completed".</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Enrollment Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="enrolled" {{ old('status', $enrollment->status) == 'enrolled' ? 'selected' : '' }}>Enrolled</option>
                                <option value="completed" {{ old('status', $enrollment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="dropped" {{ old('status', $enrollment->status) == 'dropped' ? 'selected' : '' }}>Dropped</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Important:</strong> A grade (0-100) must be entered when changing status to "Completed".
                        Students cannot re-enroll in completed courses.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update Enrollment
                        </button>
                    </div>
                </form>

                <!-- Quick Links -->
                <div class="mt-4 pt-3 border-top">
                    <h6>Quick Links:</h6>
                    <a href="{{ route('students.show', $enrollment->student) }}" class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-user"></i> View Student Profile
                    </a>
                    <a href="{{ route('courses.show', $enrollment->course) }}" class="btn btn-sm btn-outline-success">
                        <i class="fas fa-book"></i> View Course Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const gradeInput = document.getElementById('grade');
        const gradeRequired = document.getElementById('gradeRequired');
        const gradeHelp = document.getElementById('gradeHelp');

        function toggleGradeRequired() {
            if (statusSelect.value === 'completed') {
                gradeInput.required = true;
                gradeRequired.style.display = 'inline';
                gradeHelp.style.display = 'block';
                gradeInput.focus();
            } else {
                gradeInput.required = false;
                gradeRequired.style.display = 'none';
                gradeHelp.style.display = 'block';
            }
        }

        // Initial check
        toggleGradeRequired();

        // Listen for changes
        statusSelect.addEventListener('change', toggleGradeRequired);
    });
</script>
@endsection