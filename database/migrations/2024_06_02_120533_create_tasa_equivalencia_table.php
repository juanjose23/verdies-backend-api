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
        Schema::create('tasa_equivalencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productos_id')->references('id')->on('productos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('verdcoins_id')->references('id')->on('verdcoins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('cantidad');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasa_equivalencia');
    }
};
