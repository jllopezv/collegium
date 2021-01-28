<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->after('id')->default(1);
            $table->string('username')->after('name')->unique();

            $table->unsignedInteger('level')->nullable()->default( config('lopsoft.maxlevelVIPUsers') );

            $table->string('dateformat');
            $table->foreignId('timezone_id')->nullable()->references('id')->on('timezones')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->references('id')->on('countries')->onDelete('set null');
            $table->foreignId('language_id')->nullable()->references('id')->on('languages')->onDelete('set null');
            $table->nullableMorphs('profile');
            // Owner
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['active']);
            $table->dropColumn(['username']);
            $table->dropColumn(['created_by']);
            $table->dropColumn(['updated_by']);
        });
    }
}
