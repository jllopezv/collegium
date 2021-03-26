<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolParentStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_parent_student', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->foreignId('school_parent_id')->nullable()->references('id')->on('school_parents')->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->references('id')->on('students')->onDelete('cascade');
            $table->string('relationship')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_parent_student');
    }
}
