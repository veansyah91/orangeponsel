<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditInvoiceToInterOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inter_outlets', function (Blueprint $table) {
            $table->unsignedBigInteger('credit_invoice_id')->nullable();

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
        Schema::table('inter_outlets', function (Blueprint $table) {
            //
        });
    }
}
