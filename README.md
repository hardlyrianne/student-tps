Student Transaction Processing System (TPS)
Show Image
Show Image
Show Image
Show Image

📋 Table of Contents
Description / Overview
Objectives
Features / Functionality
Installation Instructions
Usage
Screenshots
Code Snippets
Database Schema
Contributors
License
📖 Description / Overview
The Student Transaction Processing System (TPS) is a comprehensive web-based application built using the Laravel MVC framework. This system manages student academic records, course catalogs, and enrollment transactions efficiently. It provides a complete solution for educational institutions to handle student information, course management, and enrollment processing with an intuitive user interface.

The system implements full CRUD (Create, Read, Update, Delete) operations across all modules and utilizes Laravel's Eloquent ORM for seamless database relationships between students, courses, and enrollments.

🎯 Objectives
The main objectives of this project are:

Implement MVC Architecture: Utilize Laravel's Model-View-Controller pattern for organized and maintainable code
Master CRUD Operations: Demonstrate complete Create, Read, Update, and Delete functionality
Database Relationships: Implement and showcase Eloquent relationships (One-to-Many, Many-to-Many)
User Interface Design: Create an intuitive and responsive interface using Bootstrap 5
Data Validation: Implement robust server-side validation for data integrity
Business Logic: Enforce business rules (e.g., prevent duplicate enrollments, require grades for completion)
Transaction Management: Process student enrollment transactions efficiently
✨ Features / Functionality
🎓 Student Management
Create Students: Add new student records with complete information
View Students: Display all students in a paginated list with status indicators
Student Details: View comprehensive student profile with enrolled courses
Update Students: Edit student information and status (Active, Inactive, Graduated)
Delete Students: Remove student records with cascade deletion of enrollments
Automatic Full Name: Accessor for combining first and last names
📚 Course Management
Create Courses: Add new courses with code, name, description, credits, and department
View Courses: Browse course catalog with enrollment statistics
Course Details: Display course information with enrolled students list
Update Courses: Modify course information and status (Active, Inactive)
Delete Courses: Remove courses with cascade deletion of enrollments
Credit Tracking: Monitor course credits for academic requirements
📝 Enrollment Management
Create Enrollments: Enroll students in courses with enrollment date
View Enrollments: Display all enrollments with student and course details
Update Enrollments: Edit enrollment status and record grades
Delete Enrollments: Remove enrollment records
Grade Management: Record and track student grades (0-100%)
Status Tracking: Monitor enrollment status (Enrolled, Completed, Dropped)
🔒 Business Rules & Validations
Prevent Duplicate Active Enrollments: Students cannot enroll in the same course twice while active
Prevent Re-enrollment in Completed Courses: Students cannot re-enroll in courses they've completed
Grade Requirement: Grades (0-100%) are required when marking enrollment as "Completed"
Allow Re-enrollment of Dropped Courses: Students can re-enroll in courses they previously dropped
Data Validation: Comprehensive validation on all input fields
Unique Constraints: Enforce unique student IDs, course codes, and email addresses
📊 Dashboard
Statistics Overview: Display total counts of students, courses, and enrollments
Quick Actions: Fast access to create new records
System Status: Real-time system information
🔗 Eloquent Relationships
One-to-Many:
Student → Enrollments
Course → Enrollments
Many-to-Many:
Student ↔ Course (through enrollments pivot table)
Inverse Relationships:
Enrollment → Student
Enrollment → Course

👥 Contributors
Developer: Hardly Laranang

Student ID: 221-0204-2
Course: BS Info Tech
Institution: DMMMSU
Contact: hardlylaranang35@gmail.com
Partner/Team Member: John Vincent Marzan

Academic Use License

This project is created for educational purposes
May be used as reference material for learning Laravel and web development
Not licensed for commercial use
Free to modify and learn from
Copyright © 2025 Hardly Laranang. All rights reserved.

🙏 Acknowledgments
Laravel Framework - For providing an excellent PHP framework
Bootstrap - For the responsive UI components
Font Awesome - For the beautiful icons
Professor/Instructor - For guidance and support throughout the project
📞 Support
For questions or issues:

Email: hardlylaranang35@gmail.com
GitHub Issues: **[Repository Issues URL]**
🔄 Version History
v1.0.0 (Current) - Initial release with complete CRUD functionality
Student Management Module
Course Management Module
Enrollment Management Module
Dashboard with statistics
Full validation and business rules
Eloquent relationships implementation
Built with ❤️ using Laravel and Bootstrap

Last Updated: [Current Date]

