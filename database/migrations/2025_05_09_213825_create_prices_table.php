<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();


            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->decimal('price_day', 10, 2)->nullable();
            $table->boolean('used')->default(false); // 1: used, 0: new
            $table->integer('status')->default(1); // 1: active, 0: inactive
          
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
