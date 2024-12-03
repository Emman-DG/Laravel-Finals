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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');
            $table->integer('room_number');
            $table->string('room_type');
            $table->string('description');
            $table->integer('capacity');
            $table->decimal('price_per_night', 12, 2);
            $table->boolean('availability_status');
            $table->text('image_path')->nullable(); 
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
