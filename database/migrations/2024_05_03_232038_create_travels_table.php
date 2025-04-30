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
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->date('invoiceDate')->nullable();
            $table->date('departureDate')->nullable();
            $table->time('departureTime')->nullable();
            $table->date('returnDate')->nullable();
            $table->time('returnTime')->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('tractor_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('box_cargo_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('box_type_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('box_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->decimal('quantity', 10, 2)->nullable(); // Para 2 decimales en cantidades de toneladas
            $table->decimal('freightCost', 12, 2)->nullable(); // Para 2 decimales en costos de flete
            $table->decimal('boothCost', 12, 2)->nullable(); // Para 2 decimales en costos de caseta
            $table->decimal('expense', 12, 2)->nullable(); // Para 2 decimales en gastos
            $table->decimal('kmTraveled', 12, 2)->nullable(); // Para 2 decimales en kilómetros recorridos
            $table->foreignId('status_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};
