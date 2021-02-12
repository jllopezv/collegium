<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoSchoolBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anno_school_batch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anno_id')->constrained('annos')->cascadeOnDelete();
            $table->foreignId('school_batch_id')->constrained('school_batches')->cascadeOnDelete();
            $table->unsignedBigInteger('priority')->default(1);
            $table->boolean('available')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anno_school_batch');
    }
}
