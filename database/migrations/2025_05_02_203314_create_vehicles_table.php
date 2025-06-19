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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('plate')->unique();
            $table->string('model');
            $table->foreignId('type_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('color')->nullable();
            $table->string('year')->nullable();
            $table->string('engine_number')->unique()->nullable();
            $table->string('chassis_number')->unique()->nullable();
           /*  $table->decimal('price_hour',10,2)->nullable();
            $table->decimal('price_day', 10, 2)->nullable();
            $table->decimal('mileage', 10, 2)->nullable();*/
            $table->string('transmission')->nullable();
            $table->integer('seats')->nullable();
            $table->string('fuel')->nullable(); // combustible 
     
            $table->text('description')->nullable();
            $table->string('image_patch')->nullable();
            $table->integer('status')->default(1);     


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
