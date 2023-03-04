<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id')->nullable();
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->timestamps();

            $table->foreign('quote_id')->references('id')->on('quotes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_taxes');
    }
};
