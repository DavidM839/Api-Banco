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
        Schema::create('consumo_mensual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cuenta');
            $table->unsignedSmallInteger('mes');
            $table->unsignedSmallInteger('anio');
            $table->decimal('monto_retirado', 10, 2);
            $table->decimal('monto_depositado', 10, 2);
            $table->timestamps();
        
            $table->foreign('id_cuenta')
                  ->references('id')
                  ->on('cuentas')
                  ->onDelete('cascade'); // Eliminación en cascada
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumo_mensual');
    }
};
