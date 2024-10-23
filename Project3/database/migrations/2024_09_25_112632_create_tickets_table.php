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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('cascade');
            $table->foreignId('conference_id')->nullable()->constrained('annual_conferences')->onDelete('cascade');
            $table->string('ticket_type');
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(0);
            $table->integer('available')->default(0);
            $table->string('ticket_name');
            $table->date('ticket_date');
            $table->string('place');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
