<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBebidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bebidas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',120);
            $table->double('precio',8,2)->default(3);
            $table->boolean('disponible')->default(true);
            $table->ForeignId('tipobebida_id');
            $table->foreign('tipobebida_id')->references('id')
            ->on('tipobebidas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->ForeignId('user_id');
            $table->foreign('user_id')->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bebidas');
    }
}
