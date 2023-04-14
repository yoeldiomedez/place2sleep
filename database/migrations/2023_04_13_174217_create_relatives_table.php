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
        Schema::create('relatives', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('surnames');
            $table->enum('document_type', ['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO'])->comment('EXT.(EXTRANJERIA) P. NAC.(PARTIDA DE NACIMIENTO)');
            $table->char('document_numb', 15)->unique();
            $table->char('cellphone_numb', 9)->unique();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatives');
    }
};
