<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('employee')->default('');
            $table->text('profile_photo_path')->nullable();
            $table->string('address1')->nullable()->default('');
            $table->string('address2')->nullable()->default('');
            $table->string('city')->nullable()->default('');
            $table->string('state')->nullable()->default('');
            $table->string('pbox')->nullable()->default('');
            $table->text('notes')->nullable();
            $table->decimal('salary')->default(0.0);
            $table->string('degree')->default('');
            $table->date('hired')->nullable();
            $table->date('birth')->nullabel();
            $table->foreignId('employee_type_id')->nullable()->references('id')->on('employee_types')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->references('id')->on('countries')->onDelete('set null');
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
        Schema::dropIfExists('employees');
    }
}
