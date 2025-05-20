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
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('codi')->unique();
            $table->string('descripcio');
            $table->integer('total_hores');
            $table->string('imatge')->nullable();
            $table->foreignId('cicle_id')
                ->nullable()
                ->constrained('cicles')
                ->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
