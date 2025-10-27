<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'enrollment_date', 'grade', 'status'
    ];

    protected $dates = ['enrollment_date'];

    // Relationship: Enrollment belongs to a student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship: Enrollment belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Check if student is already enrolled in course with active status
    public static function isStudentAlreadyEnrolled($studentId, $courseId)
    {
        return self::where('student_id', $studentId)
                   ->where('course_id', $courseId)
                   ->where('status', 'enrolled')
                   ->exists();
    }

    // Check if student has already completed this course
    public static function hasStudentCompletedCourse($studentId, $courseId)
    {
        return self::where('student_id', $studentId)
                   ->where('course_id', $courseId)
                   ->where('status', 'completed')
                   ->exists();
    }

    // Check if student can enroll (not enrolled and not completed)
    public static function canStudentEnroll($studentId, $courseId)
    {
        return !self::where('student_id', $studentId)
                   ->where('course_id', $courseId)
                   ->whereIn('status', ['enrolled', 'completed'])
                   ->exists();
    }

    // Get existing enrollment for student and course
    public static function getExistingEnrollment($studentId, $courseId)
    {
        return self::where('student_id', $studentId)
                   ->where('course_id', $courseId)
                   ->whereIn('status', ['enrolled', 'completed'])
                   ->first();
    }

    // Scope for active enrollments
    public function scopeActive($query)
    {
        return $query->where('status', 'enrolled');
    }
}