<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_emails', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('email')->default('');
            $table->string('description')->default('');
            $table->boolean('notif')->default(1);   // email to notifications
            $table->foreignId('supplier_id')->nullable()->references('id')->on('suppliers')->onDelete('cascade');
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
        Schema::dropIfExists('supplier_emails');
    }
}
