<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUserAboutsTable extends Migration
{
    public function up()
    {
        Schema::create('user_abouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('surname');
            $table->text('bio');
            $table->string('title');
            $table->string('phone');
            $table->string('city');
            $table->string('country');
            $table->string('cv_upload');
            $table->string('photo_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_abouts');
    }
};
