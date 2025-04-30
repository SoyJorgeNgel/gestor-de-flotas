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
        Schema::create('tractors', function (Blueprint $table) {
            $table->id();
            $table->string('serialNumber');
            $table->foreignId('truck_model_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->string('plate');
            $table->integer('mileage');
            $table->foreignId('user_id')
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
        Schema::dropIfExists('tractors');
    }
};
