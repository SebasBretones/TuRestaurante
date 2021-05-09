<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->boolean('ocupada')->default(false);
            $table->integer('num_asientos');

            $table->ForeignId('distribucion_id');
            $table->foreign('distribucion_id')->references('id')
            ->on('distribucions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->ForeignId('factura_id')->nullable();
            $table->foreign('factura_id')->references('id')
            ->on('facturas')
            ->onUpdate('cascade')
            ->onDelete('set null');
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
        Schema::dropIfExists('mesas');
    }
}
