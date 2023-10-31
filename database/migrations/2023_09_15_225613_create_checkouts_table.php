<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('camp_id');
            $table->string('payment_status',100)->default('waiting');
            $table->string('midtrans_url')->nullable();
            $table->string('midtrans_booking_code')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('camp_id')->on('camps')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
