<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_phones', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('phone')->default('');
            $table->string('description')->default('');
            $table->foreignId('employee_id')->nullable()->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('parent_phones');
    }
}
