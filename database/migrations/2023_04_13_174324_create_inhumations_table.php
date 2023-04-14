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
        Schema::create('inhumations', function (Blueprint $table) {
            $table->id();
            $table->morphs('buriable');	// Niche or Mausoleum
            $table->unsignedBigInteger('deceased_id'); 
            $table->unsignedBigInteger('relative_id');
            $table->string('ric')->comment('Registro de Ingreso a Caja');
            $table->enum('agreement', ['C', 'R', 'I', 'E'])->comment('Compra, Renovación, Traslado Interno, Traslado Externo');
            $table->decimal('amount', 8, 2);	
            $table->decimal('discount', 8, 2)->default(0);	
            $table->decimal('additional', 8, 2)->default(0);
            $table->text('notes')->nullable(); 
            $table->timestamps();
            $table->foreign('deceased_id')->references('id')->on('deceaseds')->onDelete('cascade');
            $table->foreign('relative_id')->references('id')->on('relatives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inhumations');
    }
};
