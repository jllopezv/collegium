<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('settingkey')->unique();
            $table->string('settingdesc')->default('');
            $table->string('settingvalue')->default('');
            $table->enum( 'type', ['text', 'number', 'boolean', 'image'] )->default('text');
            $table->integer('level')->default(config('lopsoft.maxlevelVIPUsers'));
            $table->foreignId('page_id')->references('id')->on('app_setting_pages')->onDelete('cascade');
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
        Schema::dropIfExists('app_settings');
    }
}
