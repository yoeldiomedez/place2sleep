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
        Schema::create('niches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pavilion_id'); 
            $table->char('row_x', 1);
            $table->char('col_y', 2);
            $table->enum('category', ['A', 'P', 'O', 'D', 'Z'])->comment('Adulto, Parvulo, Osario, Dorado, Z=Otro');
            $table->enum('state', ['D', 'O'])->comment('Disponible, Ocupado');
            $table->decimal('price', 8, 2);	
            $table->timestamps();
            $table->foreign('pavilion_id')->references('id')->on('pavilions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niches');
    }
};
