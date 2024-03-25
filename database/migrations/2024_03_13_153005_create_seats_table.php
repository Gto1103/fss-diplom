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
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id');
            $table->json('seance_seats')->nullable();
            $table->json('selected_seats')->nullable();
            //$table->date('date')->default(new Date);
            //$table->json('selected_seats')->default(new Expression('(JSON_ARRAY())'));
            //$table->json('seance_seats')->default(new Expression('(JSON_ARRAY())'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
