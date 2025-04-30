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
        Schema::create('route_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_id')
                ->nullable()
                ->constrained('travels')
                ->onDelete('set null');
            $table->string('numberShipment');
            $table->foreignId('destination_id')
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
        Schema::dropIfExists('route_logs');
    }
};
