<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_application_id');
            // $table->unsignedBigInteger('product_id');
            $table->integer('harga');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('credit_application_id')->references('id')->on('credit_applications')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_invoices');
    }
}
