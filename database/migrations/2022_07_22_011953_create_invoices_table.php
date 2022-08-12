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
            $table->engine = 'InnoDB';
            $table->string('invoice_id', 255)->index()->primary();
            $table->date('createdAt')->nullable();
            $table->date('paymentDue')->nullable();
            $table->string('description')->nullable();
            $table->integer('paymentTerms')->nullable();
            $table->string('clientName')->nullable();
            $table->string('clientEmail')->nullable();
            $table->string('status');
            $table->string('senderAddressStreet')->nullable();
            $table->string('senderAddressCity')->nullable();
            $table->string('senderAddressPostCode')->nullable();
            $table->string('senderAddressCountry')->nullable();
            $table->string('clientAddressStreet')->nullable();
            $table->string('clientAddressCity')->nullable();
            $table->string('clientAddressPostCode')->nullable();
            $table->string('clientAddressCountry')->nullable();
            $table->float('total');
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
        Schema::dropIfExists('invoices');
    }
}
