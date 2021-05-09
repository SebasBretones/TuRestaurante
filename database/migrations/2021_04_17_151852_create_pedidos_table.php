<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->double('total_pedido',8,2);
            $table->integer('cantidad')->default(1);

            $table->ForeignId('tapa_id');
            $table->foreign('tapa_id')->references('id')
            ->on('tapas')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->ForeignId('bebida_id');
            $table->foreign('bebida_id')->references('id')
            ->on('bebidas')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->ForeignId('estado_id');
            $table->foreign('estado_id')->references('id')
            ->on('estados')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->ForeignId('mesa_id')->nullable();
            $table->foreign('mesa_id')->references('id')
            ->on('mesas')
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
        Schema::dropIfExists('pedidos');
    }
}
