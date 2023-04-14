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
        Schema::create('exhumations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inhumation_id'); 
            $table->string('ric')->comment('Registro de Ingreso a Caja');
            $table->string('doc')->comment('Documento de Referencia');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('inhumation_id')->references('id')->on('inhumations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhumations');
    }
};
