<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_news', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string("title")->default('');
            $table->string('image')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('top')->default(false);
            $table->boolean('fixed')->default(false);
            $table->boolean('starred')->default(false);
            $table->bigInteger('showed')->default(0);
            $table->longText('body');
            $table->foreignId('website_news_cat_id')->references('id')->on('website_news_cats');
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
        Schema::dropIfExists('website_news');
    }
}
