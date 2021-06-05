<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\Distribucion;
use App\Models\Factura;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura, Distribucion $distribucionmesa)
    {

        $todosPedidos=$factura->pedidos;
        $pedidos = $todosPedidos->where('estado_id',4)->all();

        if(count($pedidos)!=0)
            $mesa = '\App\Models\Mesa'::find($pedidos[array_key_first($pedidos)]->mesa_id);
        else
            return redirect()->route('distribucionmesas.show', $distribucionmesa->id)->with('mensaje', 'No tienes pedidos en la factura');

        if(count($pedidos)!=0) {
            if($distribucionmesa->user_id!=auth()->user()->id || $mesa->distribucion_id != $distribucionmesa->id)
                return redirect()->route('distribucionmesas.show', $distribucionmesa->id)->with('mensaje', '¡Solo puedes acceder a tus facturas!');
            }

        return view('facturas.detalles', compact('factura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        $pedidos=$factura->pedidos;

        foreach($pedidos as $ped){
            DB::table('pedidos')->where('id',$ped->id)->delete();
        }

        $factura->total_factura=0;
        $factura->update();

        $mesa = '\App\Models\Mesa'::find($pedidos[array_key_first($pedidos)]->mesa_id);

        return redirect()->route('distribucionmesas.show', $mesa->distribucion_id)->with('mensaje', 'Factura borrada correctamente');
    }
}
