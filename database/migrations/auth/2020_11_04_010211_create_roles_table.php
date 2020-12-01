<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('role')->unique();
            $table->unsignedInteger('level')->default( config('lopsoft.maxlevelVIPUsers') );
            $table->string('dashboard')->default('user');
            $table->unsignedBigInteger('quota')->default(10000000);
            $table->boolean('unlimited_quota')->default(false);
            $table->foreignId('color_id')->references('id')->on('colors');
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
