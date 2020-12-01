<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allow_actions', function (Blueprint $table) {
            $table->id('id');
            $table->boolean('allowShow')->default(true);
            $table->boolean('allowEdit')->default(true);
            $table->boolean('allowDelete')->default(true);
            $table->boolean('allowLock')->default(true);
            $table->morphs('allowable');
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
        Schema::dropIfExists('allow_actions');
    }
}
