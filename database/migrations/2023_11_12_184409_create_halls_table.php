<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * $table->integer('session_id');
     * $table->integer('movie_id');
     */
    public function up(): void
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('New hall');
            $table->unsignedInteger('rows')->default(4);
            $table->unsignedInteger('cols')->default(5);
            $table->unsignedInteger('price')->default(100);
            $table->unsignedInteger('vip_price')->default(200);
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
