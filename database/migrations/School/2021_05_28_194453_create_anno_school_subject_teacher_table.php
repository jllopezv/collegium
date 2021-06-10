<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoSchoolSubjectTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anno_school_subject_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anno_id')->nullable()->constrained('annos')->cascadeOnDelete();
            $table->foreignId('school_subject_id')->nullable()->constrained('school_subjects')->cascadeOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->cascadeOnDelete();
            $table->boolean('coordinator')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anno_school_subject_teacher');
    }
}
