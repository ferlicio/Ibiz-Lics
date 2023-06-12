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
        Schema::create('lics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nu_fase');
            $table->string('nu_edital', 80);//poderia ser varchar
            $table->string('modalidade', 255);
            $table->timestamp('data_abertura');
            $table->string('nome_licitador', 512)->nullable();
            $table->string('cnpj_licitador', 25)->nullable();
            $table->smallInteger('prioridade');
            $table->text('objeto');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lics');
    }
};
