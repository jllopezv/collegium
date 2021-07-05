<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->string('ref')->unique();
            $table->string('serie')->default('');
            $table->date('invoice_date')->nullable();
            $table->date('invoice_due')->nullable();
            $table->string('description')->default('');
            $table->foreignId('currency_id')->nullable()->refenrences('id')->on('currencies')->onDelete('set null');
            $table->string('source_code')->default('');
            $table->string('source_source')->default('');
            $table->string('source_rnc')->default('');
            $table->string('source_address1')->default('');
            $table->string('source_address2')->default('');
            $table->string('source_city')->default('');
            $table->string('source_state')->default('');
            $table->string('source_pbox')->default('');
            $table->foreignId('country_id')->nullable()->references('id')->on('countries')->onDelete('set null');
            $table->longText('notes_ext')->default('');
            $table->longText('notes_int')->default('');
            $table->double('discount')->default(0.0);
            $table->boolean('discount_percent')->default(false);
            $table->double('latefee')->default(0.0);
            $table->double('taxes')->default(0.0);
            $table->double('subtotal')->default(0.0);
            $table->double('total')->default(0.0);
            $table->double('paid')->default(0.0);
            $table->double('pending')->default(0.0);
            $table->integer('status')->default('2'); // 1 = VENCIDA, 2 = PENDIENTE, 3 = PARCIAL, 4 = PAGADA,
            $table->nullableMorphs('invoiceable');
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
        Schema::dropIfExists('invoices');
    }
}
