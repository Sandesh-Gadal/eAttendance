<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseTables extends Migration
{
    public function up()
    {
        // Admins Table
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id'); // Primary Key
            $table->string('admin_username');
            $table->string('admin_password');
            $table->timestamps();
        });

        // Shifts Table
        Schema::create('shifts', function (Blueprint $table) {
            $table->id('shift_id'); // Primary Key
            $table->string('shift_name');
            $table->time('shift_start_time');
            $table->time('shift_end_time');
            $table->timestamps();
        });

        // Faculties Table
        Schema::create('faculties', function (Blueprint $table) {
            $table->id('faculty_id'); // Primary Key
            $table->string('faculty_name');
            $table->timestamps();
        });

        // Students Table
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedBigInteger('student_nfc_id'); // Primary Key but not auto-increment
            $table->primary('student_nfc_id');
            $table->string('student_name');
            $table->string('student_rollno')->unique();
            $table->date('student_dob');
            $table->string('student_semester');
            $table->string('student_section');
            $table->foreignId('faculty_id')->constrained('faculties', 'faculty_id'); // Foreign Key
            $table->foreignId('shift_id')->constrained('shifts', 'shift_id'); // Foreign Key
            $table->string('student_contact');
            $table->string('student_address');
            $table->string('student_guardian_phno');
            $table->timestamps();
        });

        // Attendance Table
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('attendance_id'); // Primary Key
            $table->foreignId('student_nfc_id')->constrained('students', 'student_nfc_id'); // Foreign Key
            $table->time('attendance_entry_time');
            $table->date('attendance_date');
            $table->timestamps();
        });

        // Student Count Table
        Schema::create('student_counts', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->foreignId('faculty_id')->constrained('faculties', 'faculty_id'); // Foreign Key
            $table->integer('semester_level');
            $table->string('section');
            $table->integer('student_number');
            $table->timestamps();
        });
    }

    
        public function down()
        {
            Schema::dropIfExists('student_counts');
            Schema::dropIfExists('attendances'); // Fixed table name 'attendances'
            Schema::dropIfExists('students');
            Schema::dropIfExists('shifts');
            Schema::dropIfExists('faculties');
        }
    }


