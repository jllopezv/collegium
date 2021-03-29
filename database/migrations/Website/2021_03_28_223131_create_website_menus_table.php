<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_menus', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('menu')->unique();
            $table->string('label')->default();
            $table->unsignedBigInteger('priority')->default(1);
            $table->string('link')->default('');
            $table->foreignId('website_page_id')->nullable()->references('id')->on('website_pages')->onDelete('set null');
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->onDelete('set null');
            // Parents
            $table->foreignId('parent_id')->nullable()->constrained('website_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_menus');
    }
}
