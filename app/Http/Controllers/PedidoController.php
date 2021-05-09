<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Tapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Mesa $mesa)
    {
        return view('pedidos.create', compact('mesa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Mesa $mesa)
    {
        /*$request->validate([
            'estado_id' => ['required'],
            'mesa_id'=> 'required',
            'total_pedido' => 'required',
            'tapa_id' => 'required'
        ]);*/

        $tapa_ids= $request->tapa_id;

        /*foreach($tapa_ids as $tapa_id) {
            $pedido = new Pedido();
            $pedido->mesa_id=$request->mesa_id;
            $pedido->estado_id=$request->estado_id;
            $pedido->tapa_id=$request->mesa_id;
        }*/
        $pedido = new Pedido();
        $pedido->mesa_id=$request->mesa_id;
        $pedido->estado_id=1;
        $pedido->tapa_id=$request->tapa_id;
        $pedido->cantidad=$request->cantidad;
        $pedido->mesa_id=$mesa->id;


        $total_pedido= 0;
        $tapa = DB::table('tapas')->find($pedido->tapa_id);

        for($i=0;$i<($pedido->cantidad);$i++){
            $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }

        $pedido->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->estado_id=$request->estado_id;
        $pedido->cantidad=$request->cantidad;

        $tapa = DB::table('tapas')->find($pedido->tapa_id);

        $pedido->total_pedido=0;
        for($i=0;$i<($pedido->cantidad);$i++){
            $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }

        if($pedido->estado_id==4){
            $mesa=DB::table('mesas')->find($pedido->mesa_id);
            $factura=DB::table('facturas')->find($mesa->factura_id);
            DB::table('facturas')
                ->where('id', $factura->id)
                ->update(['total_factura' => $pedido->total_pedido]);
        }

        $pedido->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
    }

    public function actualizarEstado(Request $request, Pedido $pedido)
    {
        $pedido->estado_id=$request->estado_id;
        $pedido->cantidad=$pedido->cantidad;

        $tapa = DB::table('tapas')->find($pedido->tapa_id);

        $pedido->total_pedido=0;
        for($i=0;$i<($pedido->cantidad);$i++){
            $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }

        $pedido->update();

        return redirect()->back();
    }
}
