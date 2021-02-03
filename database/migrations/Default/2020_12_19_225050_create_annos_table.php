<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annos', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('anno')->unique();
            $table->boolean('current')->default(false);
            $table->date('anno_start')->nullable();
            $table->date('anno_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annos');
    }
}
