<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_banners', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('banner')->unique();
            $table->unsignedInteger('width')->default(config('lopsoft.banners_default_width'));
            $table->unsignedInteger('height')->default(config('lopsoft.banners_default_height'));
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
        Schema::dropIfExists('website_banners');
    }
}
