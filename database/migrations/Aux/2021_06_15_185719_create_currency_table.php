<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('currency')->unique();
            $table->boolean('current')->default(false);
            $table->string('symbol')->default('');
            $table->string('code')->default('');
            $table->boolean('left')->default(true); // true symbol at left, false symbol at right
            $table->integer('spaces')->default(2);
            $table->integer('decimals')->default(2);
            $table->string('decimals_separator')->default('');
            $table->string('thousands_separator')->default('');
            $table->double('rate')->default(0);
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
        Schema::dropIfExists('currencies');
    }
}
