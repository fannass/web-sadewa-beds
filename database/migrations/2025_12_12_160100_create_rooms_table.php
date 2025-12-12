<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room_type')->default('Reguler'); // VIP, VVIP, Kelas 1, Kelas 2, Kelas 3, Reguler
            $table->enum('status', ['tersedia', 'terisi', 'dibersihkan'])->default('tersedia');
            $table->integer('floor')->nullable();
            $table->integer('bed_count')->default(1);
            $table->text('facilities')->nullable(); // JSON or comma-separated
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
