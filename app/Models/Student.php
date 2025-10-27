<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'email', 
        'phone', 'date_of_birth', 'address', 'status'
    ];

    protected $dates = ['date_of_birth'];

    // Relationship: Student has many enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Relationship: Student belongs to many courses through enrollments
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('enrollment_date', 'grade', 'status')
                    ->withTimestamps();
    }

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Additional helper methods for better functionality
    
    // Get active enrollments only
    public function activeEnrollments()
    {
        return $this->enrollments()->where('status', 'enrolled');
    }

    // Get completed courses
    public function completedCourses()
    {
        return $this->courses()->wherePivot('status', 'completed');
    }

    // Get current courses (enrolled status)
    public function currentCourses()
    {
        return $this->courses()->wherePivot('status', 'enrolled');
    }

    // Calculate total credits enrolled
    public function getTotalCreditsAttribute()
    {
        return $this->currentCourses()->sum('credits');
    }

    // Get GPA (Grade Point Average)
    public function getGpaAttribute()
    {
        $completedEnrollments = $this->enrollments()
            ->where('status', 'completed')
            ->whereNotNull('grade')
            ->get();

        if ($completedEnrollments->count() === 0) {
            return null;
        }

        return round($completedEnrollments->avg('grade'), 2);
    }

    // Check if student is currently enrolled in a specific course
    public function isEnrolledIn($courseId)
    {
        return $this->enrollments()
            ->where('course_id', $courseId)
            ->where('status', 'enrolled')
            ->exists();
    }

    // Get enrollment status for a specific course
    public function getEnrollmentStatus($courseId)
    {
        $enrollment = $this->enrollments()
            ->where('course_id', $courseId)
            ->first();
            
        return $enrollment ? $enrollment->status : null;
    }

    // Scope for active students only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for graduated students only
    public function scopeGraduated($query)
    {
        return $query->where('status', 'graduated');
    }
}