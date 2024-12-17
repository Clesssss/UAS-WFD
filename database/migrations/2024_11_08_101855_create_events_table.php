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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('image_url', 255);
            $table->dateTime('start_time');
            $table->dateTime('end_time'); 
            $table->string('location', 255);
            $table->text('description');
            $table->enum('event_status', ['ongoing', 'upcoming', 'finished'])
            ->default('upcoming');
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('registrants')->default(0);
            $table->unsignedInteger('price')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
