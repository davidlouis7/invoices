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
        Schema::create('quote_item_taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_item_id');
            $table->foreign('quote_item_id')->references('id')
                ->on('quote_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('tax_id');
            $table->float('tax')->nullable();
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
        Schema::dropIfExists('quote_item_taxes');
    }
};
