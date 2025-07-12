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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjual_id')->constrained('penjual')->onDelete('cascade');
            $table->string('kode_pemesanan')->unique();
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('status', ['pending', 'dibayar', 'dikirim', 'selesai', 'batal'])->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
