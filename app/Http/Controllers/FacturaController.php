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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function descargarCarta(){
        $pedidos = Pedido::all();
        $bebidas = Bebida::all();

        return view('facturas.index', compact('pedidos', 'bebidas'));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
            $mesa = '\App\Models\Mesa'::find($pedidos[0]->mesa_id);
        else
            return redirect()->route('distribucionmesas.show', $distribucionmesa->id)->with('mensaje', 'No tienes pedidos en la factura');

        if(count($pedidos)!=0) {
            if($distribucionmesa->user_id!=auth()->user()->id || $mesa->distribucion_id != $distribucionmesa->id)
                return redirect()->route('distribucionmesas.show', $distribucionmesa->id)->with('mensaje', '¡Solo puedes acceder a tus facturas!');
            }

        return view('facturas.detalles', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
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

        $mesa = '\App\Models\Mesa'::find($pedidos[0]->mesa_id);

        return redirect()->route('distribucionmesas.show', $mesa->distribucion_id)->with('mensaje', 'Factura borrada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {

    }
}
