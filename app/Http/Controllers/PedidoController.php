<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use App\Models\Factura;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Tapa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PDF;
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
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
    public function store(PedidoRequest $request)
    {
    
        $pedido = new Pedido();
        $pedido->estado_id=$request->estado_id;
        
        if($request->tapa_id!="Selecciona un plato") {
            $arr = explode('|',$request->tapa_id);
            $pedido->tapa_id=$arr[0];
        }else
            $pedido->tapa_id=null;

        if($request->bebida_id!="Selecciona una bebida") 
            $pedido->bebida_id=$request->bebida_id;
        else
            $pedido->bebida_id=null;
        $pedido->cantidad=$request->cantidad;
        $pedido->mesa_id=$request->mesa_id;

        $tapa = DB::table('tapas')->find($pedido->tapa_id);
        $bebida = DB::table('bebidas')->find($pedido->bebida_id);

        if($tapa!=null && $tapa->tipotapa_id==2 && $bebida!=null) {
            return redirect()->back()->with('mensaje', 'Las raciones deben pedirse sin bebida');
        }
        $pedido->total_pedido=0;
        for($i=0;$i<($pedido->cantidad);$i++){
            if($bebida!=null){
                if($bebida->tipobebida_id==1 || $tapa==null){
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio;
                } else {
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio + $tapa->precio;
                }
            } else if($tapa!=null) 
                $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }


        if($pedido->tapa_id == null && $pedido->bebida_id == null){
            return redirect()->back()->with('mensaje', 'Debe seleccionar una bebida o tapa');
        }else
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoRequest $request)
    {
        $pedido = Pedido::find($request->pedido_id);
        $estado_inicial = $pedido->estado_id;
        $precio_inicial = $pedido->total_pedido;

        $pedido->estado_id=$request->estado_id;
        $pedido->cantidad=$request->cantidad;
        $pedido->tapa_id=null;
        $pedido->bebida_id=null;
        if($request->tapa_id=="Selecciona un plato") {
            $pedido->tapa_id=null;
        }else
            $pedido->tapa_id=$request->tapa_id;
        if($request->bebida_id!="Selecciona una bebida") 
            $pedido->bebida_id=$request->bebida_id;

        $pedido->mesa_id=$request->mesa_id;

        $tapa = DB::table('tapas')->find($pedido->tapa_id);
        $bebida = DB::table('bebidas')->find($pedido->bebida_id);

        $pedido->total_pedido=0;
        if($tapa!=null && $tapa->tipotapa_id==2 && $bebida!=null) {
            return redirect()->back()->with('mensaje', 'Las raciones deben pedirse sin bebida');
        }

        for($i=0;$i<($pedido->cantidad);$i++){
            if($bebida!=null){
                if($bebida->tipobebida_id==1 || $tapa==null){
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio;
                } else {
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio + $tapa->precio;
                }
            } else if($tapa!=null) 
                $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }

        $mesa=DB::table('mesas')->find($pedido->mesa_id);
        $factura=DB::table('facturas')->find($mesa->factura_id);
        if($estado_inicial!=4) {
            if($pedido->estado_id==4){
                DB::table('facturas')
                    ->where('id', $factura->id)
                    ->update(['total_factura' => $factura->total_factura + $pedido->total_pedido]);
            }
        } else {
            DB::table('facturas')
                ->where('id', $factura->id)
                ->update(['total_factura' => $factura->total_factura + $pedido->total_pedido - $precio_inicial]);
        }


        if($pedido->tapa_id == null && $pedido->bebida_id == null){
            return redirect()->back()->with('mensaje', 'Debe seleccionar una bebida o tapa');
        }else
            $pedido->update();

        if($pedido->estado_id==4 && $estado_inicial!=4)
            return redirect()->back()->with('mensaje','Pedido actualizado con éxito y enviado a la factura');
        else
            return redirect()->back()->with('mensaje','Pedido actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $mesa=DB::table('mesas')->find($pedido->mesa_id);
        $factura=DB::table('facturas')->find($mesa->factura_id);
        DB::table('facturas')
            ->where('id', $factura->id)
            ->update(['total_factura' => $factura->total_factura - $pedido->total_pedido]);
       
        $pedido->delete();

        return redirect()->back()->with('mensaje', 'Pedido borrado correctamente');
    }

    public function actualizarEstado(PedidoRequest $request, Pedido $pedido)
    {
        $pedido->estado_id=$request->estado_id;
        $pedido->cantidad=$pedido->cantidad;

        $tapa = DB::table('tapas')->find($pedido->tapa_id);

        $pedido->total_pedido=0;
        for($i=0;$i<($pedido->cantidad);$i++){
            $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }

        $pedido->update();

    }

    public function downloadPDF(Factura $factura) {
        $todosPedidos=$factura->pedidos;
        $pedidosT = $todosPedidos->where('estado_id',4)->all();
        $pedidos = array();
        array_push($pedidos, $pedidosT[0]);
        $cont = 0;
        for($i=1; $i<count($pedidosT); $i++) {
            $cont = 0;
            for($z=0; $z<count($pedidos);$z++){
                if($pedidos[$z]->tapa_id==$pedidosT[$i]->tapa_id && $pedidos[$z]->bebida_id==$pedidosT[$i]->bebida_id){
                    $pedidos[$z]->cantidad += $pedidosT[$i]->cantidad;
                    $pedidos[$z]->total_pedido += $pedidosT[$i]->total_pedido;
                    $cont = 1;
                    break;
                }
            }
            if($cont==0)
              array_push($pedidos, $pedidosT[$i]);
        }

        $pdf= PDF::loadview('pdf.pedidos',compact('pedidos','factura'));
        return $pdf->download('factura.pdf');
    }
}
