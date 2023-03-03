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
        Schema::create('invoice-settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('template_name');
            $table->string('template_color');
            $table->timestamps();
        });

        $input = \App\Models\Setting::INVOICE__TEMPLATE_ARRAY;
        foreach ($input as $key => $value) {
            \App\Models\InvoiceSetting::create(['key' => $key, 'template_name' => $value,
                'template_color' => '#000000',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice-settings');
    }
};
