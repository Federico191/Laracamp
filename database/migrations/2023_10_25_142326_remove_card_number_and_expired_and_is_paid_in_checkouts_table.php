<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn('card_number');
            $table->dropColumn('expired');
            $table->dropColumn('cvc');
            $table->dropColumn('is_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('card_number',20);
            $table->date('expired');
            $table->string('cvc',3);
            $table->boolean('is_paid')->default(false);
        });
    }
};
