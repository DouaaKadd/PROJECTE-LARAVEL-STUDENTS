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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); 
            $table->text('address');
            $table->date('birth_date'); 
            $table->string('num_telefon')->nullable(); 
            $table->enum('genere', ['home', 'dona'])->nullable();
            $table->timestamps();
            
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate(); 

          $table->foreignId('cicle_id')
                ->nullable()
                ->constrained('cicles')
                ->onDelete('set null'); 
                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
