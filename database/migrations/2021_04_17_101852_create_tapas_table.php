<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tapas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',60);
            $table->double('precio',8,2)->default(1.5);
            $table->ForeignId('tipotapa_id');
            $table->foreign('tipotapa_id')->references('id')
            ->on('tipotapas')
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
        Schema::dropIfExists('tapas');
    }
}
