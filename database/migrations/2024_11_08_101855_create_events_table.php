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
            $table->id('event_id');
            $table->string('title', 100);
            $table->string('image_url', 255);
            $table->dateTime('datetime');
            $table->string('location', 255);
            $table->text('description');
            $table->enum('event_status', ['ongoing', 'upcoming', 'finished']);
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('registrants')->default(0);
            $table->decimal('price', 10, 2);
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
