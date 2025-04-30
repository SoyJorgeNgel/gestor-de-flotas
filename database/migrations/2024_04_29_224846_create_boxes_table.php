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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_type_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->string('plate');
            $table->foreignId('box_size_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
                $table->foreignId('box_permit_id')
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
        Schema::dropIfExists('boxes');
    }
};
