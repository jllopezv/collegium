<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteAdvertisementCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_advertisement_cats', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string("category")->unique();
            $table->unsignedBigInteger('priority')->default(1);
            $table->foreignId('color_id')->references('id')->on('colors');
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
        Schema::dropIfExists('website_advertisement_cats');
    }
}
