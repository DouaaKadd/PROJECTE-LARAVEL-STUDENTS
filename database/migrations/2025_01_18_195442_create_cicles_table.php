<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclesTable extends Migration
{
    public function up()
    {
        Schema::create('cicles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('codi');
            $table->text('descripcio')->nullable();
            $table->integer('num_cursos');
            $table->string('imatge')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cicles');
    }
}
