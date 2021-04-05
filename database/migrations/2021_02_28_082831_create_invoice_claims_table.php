<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_claim_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_invoice_id');
            // $table->integer('nomor');
            $table->timestamps();

            $table->foreign('credit_invoice_id')->references('id')->on('credit_invoices')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_claim_details');
    }
}
