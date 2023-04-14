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
        Schema::create('mausoleums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pavilion_id'); 
            $table->string('name');
            $table->string('location');
            $table->string('doc')->comment('Documento de Referencia');
            $table->unsignedTinyInteger('size');
            $table->unsignedTinyInteger('availability');
            $table->unsignedTinyInteger('extensions');
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
        Schema::dropIfExists('mausoleums');
    }
};
