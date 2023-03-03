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
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('invoice_id')
                ->constrained('invoices')
                ->restrictOnUpdate()->nullOnDelete();
            $table->boolean('recurring_status')->default(false)->after('status');
            $table->integer('recurring_cycle')->nullable()->after('recurring_status');
            $table->date('last_recurring_on')->nullable()->after('recurring_cycle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
            $table->dropColumn('recurring_status');
            $table->dropColumn('recurring_cycle');
            $table->dropColumn('last_recurring_on');
        });
    }
};
