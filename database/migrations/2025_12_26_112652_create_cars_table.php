<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //creates car table
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); //primary key
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->string('color');
            $table->integer('seats');
            $table->string('transmission');
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    //drops table
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
