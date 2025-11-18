Student Transaction Processing System (TPS) Show Image Show Image Show Image Show Image

📋 Table of Contents Description / Overview Objectives Features / Functionality Installation Instructions Usage Screenshots Code Snippets Database Schema Contributors License 📖 Description / Overview The Student Transaction Processing System (TPS) is a comprehensive web-based application built using the Laravel MVC framework. This system manages student academic records, course catalogs, and enrollment transactions efficiently. It provides a complete solution for educational institutions to handle student information, course management, and enrollment processing with an intuitive user interface.

The system implements full CRUD (Create, Read, Update, Delete) operations across all modules and utilizes Laravel's Eloquent ORM for seamless database relationships between students, courses, and enrollments.

🎯 Objectives The main objectives of this project are:

Implement MVC Architecture: Utilize Laravel's Model-View-Controller pattern for organized and maintainable code Master CRUD Operations: Demonstrate complete Create, Read, Update, and Delete functionality Database Relationships: Implement and showcase Eloquent relationships (One-to-Many, Many-to-Many) User Interface Design: Create an intuitive and responsive interface using Bootstrap 5 Data Validation: Implement robust server-side validation for data integrity Business Logic: Enforce business rules (e.g., prevent duplicate enrollments, require grades for completion) Transaction Management: Process student enrollment transactions efficiently ✨ Features / Functionality 🎓 Student Management Create Students: Add new student records with complete information View Students: Display all students in a paginated list with status indicators Student Details: View comprehensive student profile with enrolled courses Update Students: Edit student information and status (Active, Inactive, Graduated) Delete Students: Remove student records with cascade deletion of enrollments Automatic Full Name: Accessor for combining first and last names 📚 Course Management Create Courses: Add new courses with code, name, description, credits, and department View Courses: Browse course catalog with enrollment statistics Course Details: Display course information with enrolled students list Update Courses: Modify course information and status (Active, Inactive) Delete Courses: Remove courses with cascade deletion of enrollments Credit Tracking: Monitor course credits for academic requirements 📝 Enrollment Management Create Enrollments: Enroll students in courses with enrollment date View Enrollments: Display all enrollments with student and course details Update Enrollments: Edit enrollment status and record grades Delete Enrollments: Remove enrollment records Grade Management: Record and track student grades (0-100%) Status Tracking: Monitor enrollment status (Enrolled, Completed, Dropped) 🔒 Business Rules & Validations Prevent Duplicate Active Enrollments: Students cannot enroll in the same course twice while active Prevent Re-enrollment in Completed Courses: Students cannot re-enroll in courses they've completed Grade Requirement: Grades (0-100%) are required when marking enrollment as "Completed" Allow Re-enrollment of Dropped Courses: Students can re-enroll in courses they previously dropped Data Validation: Comprehensive validation on all input fields Unique Constraints: Enforce unique student IDs, course codes, and email addresses 📊 Dashboard Statistics Overview: Display total counts of students, courses, and enrollments Quick Actions: Fast access to create new records System Status: Real-time system information 🔗 Eloquent Relationships One-to-Many: Student → Enrollments Course → Enrollments Many-to-Many: Student ↔ Course (through enrollments pivot table) Inverse Relationships: Enrollment → Student Enrollment → Course 🛠️ Installation Instructions Prerequisites PHP >= 8.1 Composer MySQL >= 8.0 XAMPP (or similar local server environment) Git (optional) Step-by-Step Installation Clone or Download the Project bash git clone cd student-tps Install Dependencies bash composer install Configure Environment bash

Copy the example environment file
copy .env.example .env

Generate application key
php artisan key:generate Configure Database Edit the .env file with your database credentials: env DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=student_tps_db DB_USERNAME=root DB_PASSWORD= Start XAMPP Open XAMPP Control Panel Start Apache and MySQL services Create Database Open phpMyAdmin (http://localhost/phpmyadmin) Create a new database named student_tps_db Run Migrations bash php artisan migrate Clear Cache (Optional) bash php artisan config:clear php artisan cache:clear php artisan route:clear Start Development Server bash php artisan serve Access the Application Open your browser and navigate to: http://localhost:8000 💻 Usage Basic Workflow

Adding a New Student Navigate to the Dashboard or click "Students" in the navigation menu Click the "Add New Student" button Fill in the required information: Student ID (unique) First Name and Last Name Email (unique) Phone Number Date of Birth Address Status (Active, Inactive, Graduated) Click "Save Student"
Creating a Course Click "Courses" in the navigation menu Click "Add New Course" button Enter course details: Course Code (e.g., CS101) Course Name Description Credits (1-10) Department Status (Active, Inactive) Click "Save Course"
Enrolling a Student in a Course Go to "Enrollments" section Click "Add New Enrollment" Select a student from the dropdown Select a course from the dropdown Set the enrollment date Choose enrollment status: Enrolled: Student is currently taking the course Completed: Course finished (requires grade input) Dropped: Student withdrew from the course If status is "Completed", enter the grade (0-100%) Click "Save Enrollment"
Managing Grades Navigate to "Enrollments" Click "Edit" on the enrollment record Enter or update the grade Change status to "Completed" if finished Click "Update Enrollment"
Viewing Student Details Go to "Students" list Click "View" button next to a student See student information and all enrolled courses Important Notes ⚠️ Students cannot enroll in the same course twice while status is "Enrolled" ⚠️ Students cannot re-enroll in courses marked as "Completed" ⚠️ A grade is required when marking an enrollment as "Completed" ✅ Students can re-enroll in courses they have "Dropped" 📸 Screenshots Dashboard Show Image Main dashboard showing system statistics and quick actions
Student List Show Image Paginated list of all students with action buttons

Add Student Form Show Image Form for creating new student records

Course Management Show Image Course catalog with enrollment statistics

Enrollment Management Show Image Complete enrollment records with grades and status

💾 Code Snippets Student Model with Relationships php

hasMany(Enrollment::class); } // Many-to-Many: Student belongs to many courses public function courses() { return $this->belongsToMany(Course::class, 'enrollments') ->withPivot('enrollment_date', 'grade', 'status') ->withTimestamps(); } // Accessor for full name public function getFullNameAttribute() { return $this->first_name . ' ' . $this->last_name; } } Enrollment Validation Logic php public function store(Request $request) { // Check for duplicate active enrollment if (Enrollment::isStudentAlreadyEnrolled($validated['student_id'], $validated['course_id'])) { return back()->withErrors([ 'enrollment_error' => "Student is already enrolled in this course." ])->withInput(); } // Check for completed course if (Enrollment::hasStudentCompletedCourse($validated['student_id'], $validated['course_id'])) { return back()->withErrors([ 'enrollment_error' => "Student has already completed this course." ])->withInput(); } Enrollment::create($validated); return redirect()->route('enrollments.index')->with('success', 'Enrollment created!'); } Database Migration - Enrollments Table php Schema::create('enrollments', function (Blueprint $table) { $table->id(); $table->foreignId('student_id')->constrained()->onDelete('cascade'); $table->foreignId('course_id')->constrained()->onDelete('cascade'); $table->date('enrollment_date'); $table->decimal('grade', 5, 2)->nullable(); $table->enum('status', ['enrolled', 'completed', 'dropped']); $table->timestamps(); }); Blade Template Example php @extends('layouts.app') @section('content')
Student-TPSStudents List
@foreach($students as $student) @endforeach
Student ID	Name	Email	Status	Actions
{{ $student->student_id }}	{{ $student->full_name }}	{{ $student->email }}	{{ ucfirst($student->status) }}	View Edit
{{ $students->links() }}
📘 Description / Overview
Student-TPS (Task and Performance System) is a simple project designed to help manage student activities, performance records, and progress efficiently. It provides features that allow tracking and organizing tasks for both students and instructors.

🎯 Objectives
To manage student tasks and progress.
To improve record-keeping and monitoring.
To promote efficiency in task submission and evaluation.
⚙️ Features / Functionality
Add, view, and update student records.
Track performance and assignments.
Simple interface for easy navigation.
Local storage support using Git for version control.
🧩 Installation Instructions
Clone the repository:
git clone https://github.com/hardlyrianne/student-tps.git
@endsection 
🗄️ Database Schema Tables Overview students Table Column Type Constraints id BIGINT Primary Key, Auto Inc student_id VARCHAR Unique, Not Null first_name VARCHAR Not Null last_name VARCHAR Not Null email VARCHAR Unique, Not Null phone VARCHAR Not Null date_of_birth DATE Not Null address TEXT Not Null status ENUM active/inactive/graduated created_at TIMESTAMP Auto updated_at TIMESTAMP Auto courses Table Column Type Constraints id BIGINT Primary Key, Auto Inc course_code VARCHAR Unique, Not Null course_name VARCHAR Not Null description TEXT Not Null credits INTEGER Not Null (1-10) department VARCHAR Not Null status ENUM active/inactive created_at TIMESTAMP Auto updated_at TIMESTAMP Auto enrollments Table (Pivot/Junction) Column Type Constraints id BIGINT Primary Key, Auto Inc student_id BIGINT Foreign Key → students course_id BIGINT Foreign Key → courses enrollment_date DATE Not Null grade DECIMAL Nullable (0.00-100.00) status ENUM enrolled/completed/dropped created_at TIMESTAMP Auto updated_at TIMESTAMP Auto Relationships Diagram ┌─────────────┐ ┌──────────────┐ ┌─────────────┐ │ Students │ │ Enrollments │ │ Courses │ │─────────────│ │──────────────│ │─────────────│ │ id (PK) │────────>│ student_id │<────────│ id (PK) │ │ student_id │ 1 * │ course_id │ * 1 │ course_code │ │ first_name │ │ enrollment.. │ │ course_name │ │ last_name │ │ grade │ │ description │ │ email │ │ status │ │ credits │ │ ... │ └──────────────┘ │ ... │ └─────────────┘ └─────────────┘ 



👥 Contributors Developer: Hardly Laranang Student ID: 221-0204-2 Course: BS INFO TECH Institution: DMMMSU Contact: hardlylaranang35@gmail.com 



📄 License This project is developed as part of an academic requirement for [Course Name/Number]. Academic Use License This project is created for educational purposes May be used as reference material for learning Laravel and web development Not licensed for commercial use Free to modify and learn from Copyright © 2025 Hardly Laranang. All rights reserved. 



🙏 Acknowledgments Laravel Framework - For providing an excellent PHP framework Bootstrap - For the responsive UI components Font Awesome - For the beautiful icons Professor/Instructor - For guidance and support throughout the project 



📞 Support For questions or issues: Email: hardlylaranang35@gmail.com 




🔄 Version History v1.0.0 (Current) - Initial release with complete CRUD functionality Student Management Module Course Management Module Enrollment Management Module Dashboard with statistics Full validation and business rules Eloquent relationships implementation Built with ❤️ using Laravel.
