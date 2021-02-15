<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomToCreditAplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_aplications', function (Blueprint $table) {
            $table->unsignedBigInteger('credit_partner_id');

            $table->foreign('credit_partner_id')->references('id')->on('credit_partners')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_aplications', function (Blueprint $table) {
            //
        });
    }
}
