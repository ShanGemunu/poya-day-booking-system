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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poya_day_id')->constrained('poya_days');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('notes');
            $table->enum('status',['pending','approved','rejected']);
            $table->timestamp('created_at');
        });

        Schema::table('poya_days', function (Blueprint $table) {
            $table->foreignId('booking_id')->nullable()->constrained('bookings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('poya_days', 'booking_id')){
            Schema::table('poya_days', function (Blueprint $table)
            {
                $table->dropForeign('poya_days_booking_id_foreign');
                $table->dropColumn('booking_id');
            });
        }

        Schema::dropIfExists('bookings');
    }
};
